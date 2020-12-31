<?php 

	require('../../libraries/config.php'); //Basic configuration file.
	require('../../libraries/php/classes/database/main.php'); 	// Database class.
	require('source/main.php');
	
	$cLRoot		= $cDocroot."ohs/";
	
	// Verify login.
	$oAcc->access_verify();
		
	// Initialize post vars object.
	$post = new class_incident();
	$post->populate_from_post();
	
	$sql 	= NULL;	// SQL string placeholder.
	$params = NULL;	// Parameter array palceholder.
	$keyname = NULL; // Data member and post array key name placeholder.
	$body 	= NULL;	// Body list row.
	$agent	= NULL;	// Agent list row.
	$nature = NULL;	// Nature list row.
	$type 	= NULL;	// Type list row.
	$time 	= date(DATE_FORMAT);	// Current date/time.
	
	// Initialize DB connection and query objects.
	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);
	
	// Populkate list object arrays.
	$check_list	= new class_check_list();	
		
	// Is this a submission?
	if($post->get_submit() == CONSTANTS::SUBMIT_TRUE)
	{
		// Insert primary record.
		$query->set_sql('INSERT INTO tbl_incident 
			(type,
			contact,
			name_f, 
			name_l,
			account,
			email,
			department,
			phone,
			time,
			facility,
			area,
			description,
			log_update,
			log_update_account,
			log_update_ip) OUTPUT INSERTED.id VALUES 
			(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
		
		$query->set_params(array(			
			$post->get_type(),
			$post->get_contact(),
			$post->get_name_f(), 
			$post->get_name_l(),
			$post->get_account(),
			$post->get_email(),
			$post->get_department(),
			$post->get_phone(),
			$post->get_time(),
			$post->get_facility(),
			$post->get_area(),
			$post->get_description(),
			&$time,
			$oAcc->get_account(),
			$oAcc->get_ip()));
		
		$query->query();
		
		// Get id of the new primary record we just created.
		$inserted = $query->get_line_object();
		
		// Insert agent items to subtable.		
		if(is_array($post->get_agent()))
		{	
			// Clear foreign value.
			$f_value = NULL;				
			
			// Create a prepared query and bind parameters.
			$query->set_sql('INSERT INTO tbl_incident_agent (fk_id, item) VALUES (?, ?)');
			$query->set_params(array(&$inserted->id, &$f_value));
			$query->prepare();
			
			// Loop over each agent item from the agent post array.
			// Each cycle updates our bound foreign value parameter.
			foreach($post->get_agent() as $f_value)
			{				
				// Execute prepared query.
				$query->execute();
			}			
		}		
		
		// Insert body items to subtable. Refer to agent code above for details.				
		if(is_array($post->get_body()))
		{			
			$f_value = NULL;			
			
			$query->set_sql('INSERT INTO tbl_incident_body (fk_id, item) VALUES (?, ?)');
			$query->set_params(array(&$inserted->id, &$f_value));
			$query->prepare();			
			
			foreach($post->get_body() as $f_value)
			{			
				$query->execute();
			}			
		}	
		
		// Insert nature items to subtable. Refer to agent code above for details.				
		if(is_array($post->get_nature()))
		{			
			$f_value = NULL;			
			
			$query->set_sql('INSERT INTO tbl_incident_nature (fk_id, item) VALUES (?, ?)');
			$query->set_params(array(&$inserted->id, &$f_value));
			$query->prepare();			
			
			foreach($post->get_nature() as $f_value)
			{			
				$query->execute();
			}			
		}
			
		// Set up and send email alert.		
		$subject = MAILING::SUBJECT;
		$body = 'Incident posted. <a href="https://ehs.uky.edu/apps/incident/details.php?&id='.$inserted->id.'">Click here</a> to view.';
	
		$address = $post->get_email();
		$headers   = array();
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-type: text/html; charset=iso-8859-1";
		if(MAILING::FROM)	$headers[] = "From: ".MAILING::FROM;
		if(MAILING::BCC)	$headers[] = "Bcc: ".MAILING::BCC;
		if(MAILING::CC) 	$headers[] = "Cc: ".MAILING::CC;
		
		// Set up mail to addresses.
		$mail_to = MAILING::TO;
		$mail_to .= ', '.$oAcc->get_account().'@uky.edu';
		if($address && filter_var($address, FILTER_VALIDATE_EMAIL)) $mail_to .= ', '.$address;
					
		// Run mail function.
		mail($mail_to, MAILING::SUBJECT, $body, implode("\r\n", $headers));	
		
	}	

?>

<!DOCtype html>
    <head>
        <title>UK - Occupational Health &amp; Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        
        <link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
        <script src="../../libraries/javascript/jquery_ui_timepicker_addon.js"></script>
        <script src="../../libraries/javascript/options_update.js"></script>    
    	
        <style>
						
			.incident {
				font-size:larger;			
			}
			
			ul.checkbox  { 
				
			 	-webkit-column-count: auto;  				
				-moz-column-count: auto;				
			  column-count: auto;			 
			  margin: 0; 
			  padding: 0; 
			  margin-left: 20px; 
			  list-style: none;			  
			} 
			
			ul.checkbox li input { 
			  margin-right: .25em; 
			  cursor:pointer;
			} 
			
			ul.checkbox li { 
			  border: 1px transparent solid; 
			  display:inline-block;
			  width:12em;			  
			} 
			
			ul.checkbox li label { 
			  margin-left: ;
			  cursor:pointer;			  
			} 
			ul.checkbox li:hover, 
			ul.checkbox li.focus  { 
			  background-color: lightyellow; 
			  border: 1px gray solid; 
			  width: 12em; 
			}
		</style>
    
    </head>
    
    <body>    
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div>
            <div id="subContainer">
                <div id="banner_container" class="banner_container">	
                    <div id="banner_content" class="banner">
                        University of Kentucky
                        <h1>Incident Reporting</h1>
                        <div id="banner_slogan" class="slogan">
                            UK Safety Begins with You!
                        </div><!--#banner_slogan-->
                    </div><!--#banner_content-->
                </div><!--#banner_container-->
                <div id="subNavigation">
                    <?php include($cLRoot."a_subnav_0001.php"); ?> 
                </div>
                <div id="content">
                	<?php
					if($post->get_submit() == CONSTANTS::SUBMIT_TRUE)
					{
					?>
                    	<h3 class="color_green">Your incident report has been posted, thank you. If you opted to receive a follow up, a member of our staff will contact you shortly. </h3> 
                    <?php
					}
					else
					{
					?>
                    	Use this below to tell us about the incident. When you are finished, click the <span style="font-style:italic">Send Report</span> button below and your report will be processed.
                        
                        <h5>Definitions and examples for differing types of incidents:</h5>
                        <ul>
                            <li>Accident: A potentially injurious event occurred, even if no injury was involved. <span style="font-style:italic">“I slipped on some ice and fell, but wasn’t hurt.”</span></li>
                            <li>Near Miss: An accident nearly occurred but was avoided. <span style="font-style:italic">“I stepped on some ice and slipped a little, but I didn’t fall.”</span></li>
                            <li>Hazardous Condition: A condition was noted that may contribute to accidents or injury. <span style="font-style:italic">“I noticed some ice on the stairway.”</span></li>
                        </ul>
                    
                    	<form method="post" name="main" id="main">
                        	<fieldset class="center">
                            	<legend>Type</legend>
                                                                                              
									<?php 
                                        $check_list->set_name('type');
                                        $check_list->item_list_from_table();
                                        echo $check_list->generate_radio_markup();							
                                    ?>                                          
                            </fieldset>
                            
                            <fieldset>
                            	<legend>Identity</legend>
                                	
                                    <p>Please use these fields to identify the accident/near miss victim or person discovering a hazardous condition.</p>
                                    
                                    <label for="name_f">First Name</label>
                                	<input type="text" name="name_f" id="name_f" value="<?php echo $post->get_name_f(); ?>" placeholder="First Name" required />
                                    
                                    <label for="name_l">Last Name</label>
                                	<input type="text" name="name_l" id="name_l" value="<?php echo $post->get_name_l(); ?>" placeholder="Last Name" required />
                                    
                                    <label for="account">Account</label>
                                	<input type="text" name="account" id="account" value="<?php echo $post->get_account(); ?>" placeholder="Link Blue Account" />
                                    
                                    <label for="email">E-Mail</label>
                                	<input type="email" name="email" id="email" value="<?php echo $post->get_email(); ?>" placeholder="E-Mail Address" required />
                                    
                                    <div>
                                        <p id="department_progress" class="load color_red center">
                                            Loading departments...
                                            <img id="img_department_load_progress" 
                                                src="../../media/image/meter_bar.gif" 
                                                alt="Loading items... " 
                                                title="Loading items..." />
                                        </p>
                                        <label for="department">Department</label>
                                        <select name="department" 
                                            id="department" 
                                            data-current="<?php echo $post->get_department(); ?>" 
                                            data-source-url="../../libraries/inserts/department.php" 
                                            data-extra-options='<option value="">Select Department</option><option value="-1">No UK Affiliation</option>'
                                            data-grouped="0"> 
                                            	<!--This option is for valid HTML5; it is overwritten on load.--> 
                                        		<option value="0">Select Department</option>                                                                      
                                                <!--Options will be populated on load via jquery.-->								
                                        </select>
                                    </div>
                                    
                                    <label for="phone">Phone</label>
                                	<input type="tel" name="phone" id="phone" value="<?php echo $post->get_phone(); ?>" placeholder="xxx-xxx-xxxx" required />
                                
                                	<div>                                  
                                        <span class="label">Would you like to be contacted?</span>
                                        <div class="fieldset_box">   
                                                                                        
                                            <?php 
											
												$check_list->set_name('contact');
												$check_list->item_list_from_array(array('Yes' => CONSTANTS::YES, 'No' => CONSTANTS::NO));
												$check_list->set_default(CONSTANTS::NO);
												echo $check_list->generate_radio_markup();							
											?>
                                                                                                        
                                        </div>
                                    </div>
                                                
                                
                            </fieldset>
                            
                            <fieldset>
                            	<legend>Location</legend>
                                
                                <p class="instructions">Select a facility first, then choose the area where incident or condition occurred. If the incident was outside, choose the nearest facility and select <span style="font-style:italic">Outside</span> in the Room field.</p>              
                
                                <div>
                                    <p id="facility_progress" class="load color_red center">
                                        Loading facilities...
                                        <img id="img_facility_load_progress" 
                                            src="../../media/image/meter_bar.gif" 
                                            alt="Loading items... " 
                                            title="Loading items..." />
                                    </p>
                                    <label for="facility">Facility</label>
                                    <select name="facility" 
                                        id="facility" 
                                        data-current="<?php echo $post->get_facility(); ?>" 
                                        data-source-url="../../libraries/inserts/facility.php" 
                                        data-extra-options='<option value="">Select Facility</option>'
                                        data-grouped="1"
                                        class="room_search">
                                        	<!--This option is for valid HTML5; it is overwritten on load.--> 
                                        	<option value="0">Select Facility</option>                                    
                                            <!--Options will be populated on load via jquery.-->                                 
                                    </select>
                                </div>
                    
                                <div>
                                    <p id="area_progress" class="load color_red center display_none">
                                        Loading rooms/areas...
                                        <img id="img_area_load_progress" 
                                            src="../../media/image/meter_bar.gif" 
                                            alt="Loading items... " 
                                            title="Loading items..." />                               
                                    </p>
                                    <label for="area">Area</label>
                                    <select name="area" 
                                        id="area" 
                                        data-current="<?php echo $post->get_area(); ?>" 
                                        data-source-url="../../libraries/inserts/room.php" 
                                        data-grouped="1" 
                                        data-extra-options='<option value="">Select Room/Area/Lab</option><option value="<?php echo CONSTANTS::AREA_OUTSIDE; ?>">Outside</option>' 
                                        class="disable" 
                                        disabled required>
                                        	<!--This option is for valid HTML5; it is overwritten on load.--> 
                                        	<option value="1">Select Room/Area/Lab</option>
                                            <!--Options will be populated/replaced on load via jquery.-->
                                            <option value="">Select Room/Area/Lab</option>                                  							
                                    </select>                                    
                                </div>                                    	
                            </fieldset>                   
                            
                            <fieldset>
                            	<legend>Agents</legend>
                                
                                <p>Please check all agents that caused injury, near miss or hazardous condition. You must choose at least one.</p>
                                            
                                <ul class="checkbox">    
                                   
									<?php 
                                        $check_list->set_name('agent');
                                        $check_list->item_list_from_table();
                                        echo $check_list->generate_check_markup();							
                                    ?>
                                    
                                </ul>
                                
                            </fieldset>
                            
                            <fieldset>
                            	<legend>Location of Injury</legend>
                                
                                <p>Please check all injured locations on body.</p>
                                            
                                <ul class="checkbox">    
                                   
									<?php 
                                        $check_list->set_name('body');
                                        $check_list->item_list_from_table();
                                        echo $check_list->generate_check_markup();							
                                    ?>
                                    
                                </ul>
                                                           
                            </fieldset>
                            
                            <fieldset>
                            	<legend>Nature</legend>
                                
                                <p>Please indicate the nature of any injuries. Check all that apply.</p>
                                            
                                <ul class="checkbox">    
                                   
									<?php 
                                        $check_list->set_name('nature');
                                        $check_list->item_list_from_table();
                                        echo $check_list->generate_check_markup();							
                                    ?>
                                    
                                </ul>
                                                               
                            </fieldset>                     
                            
                            <fieldset>
                            	<legend>Details</legend>
                                
                                <p>Please indicate the time of incident and provide a short description.</p>
                                
                                <label for="time">Time</label>
                                <input type="datetime" name="time" id="time" value="" class="date_entry" readonly />
                            
                            	<label for="desc">Description</label>
                                <textarea name="description" id="description" cols="50" required></textarea>                                                            
                            </fieldset>
                            
                            <button type="submit" name="submit" id="submit" value="<?php echo CONSTANTS::SUBMIT_TRUE; ?>">Send Report</button>
                        </form>
                         &nbsp;
                	<?php
					}
					?>                            
                </div><!--#content-->       
            </div><!--#subContainer-->    
            <div id="sidePanel">		
                <?php include($cLRoot."a_sidepanel_0001.php"); ?>		
            </div><!--#sidePanel-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--#footer-->
            &nbsp;<span style="font-size:xx-small"><a href="report.php">Administration</a></span>
        </div><!--#container-->
        
        <div id="footerPad">
            <?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--#footerPad-->
        
        <script>	
		    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            
            ga('create', 'UA-40196994-1', 'uky.edu');
            ga('send', 'pageview');    
        
			$('.room_search').change(function(event)
			{	
				options_update(event, null, '#area');	
			});
		
			$(function(){
						$( '#time' ).datetimepicker({dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss', changeYear: true, constrainInput: true});
					});
		
        	$(document).ready(function(event) {		
				//options_update(event, null, '#agent');
				options_update(event, null, '#department');	
				options_update(event, null, '#facility');
				//	$("#department").attr('required', '');
				//('#facility').required = true;				
			});
        
        </script>
    </body>
</html>