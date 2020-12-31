<?php 

	require('../../libraries/config.php'); //Basic configuration file.
	require('../../libraries/php/classes/database/main.php'); 	// Database class.
	require('source/main.php');
	
	$cLRoot		= $cDocroot."ohs/";
			
	// Post data.			
	class post extends class_incident
	{		
		public function __construct()
		{		
			// Interate through each class variable.
       		foreach($this as $key => $value) 
			{			
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the post value. 
				if(isset($_POST[$key]))
				{					
					$this->$key = $_POST[$key];           						
				}
			}	
	 	}		
	}
	
	// Verify login.
	$oAcc->access_verify();
		
	// Initialize post vars object.
	$post = new post();
	
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
	$type_list 		= new list_populate('tbl_incident_type_list');		// Types.
	$agent_list 	= new list_populate('tbl_incident_agent_list');		// Agents.
	$nature_list	= new list_populate('tbl_incident_nature_list'); 	// Nature.
	$body_list 		= new list_populate('tbl_incident_body_list');		// Body.
	
	// Is this a submission?
	if($post->submit == CONSTANTS::SUBMIT_TRUE)
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
			&$post->type,
			&$post->contact,
			&$post->name_f, 
			&$post->name_l,
			&$post->account,
			&$post->email,
			&$post->department,
			&$post->phone,
			&$post->time,
			&$post->facility,
			&$post->room,
			&$post->desc,
			&$time,
			$oAcc->get_account(),
			$oAcc->get_ip()));
		
		$query->query();
		
		// Get id of the new primary record we just created.
		$inserted = $query->get_line_object();
		
		// Insert agent records.		
		// Set up base sql string and empty parameter array.
		$sql = 'INSERT INTO tbl_incident_agent (fk_id, item) VALUES ';
		$params = array();
		
		// Loop through all table items.
		foreach($agent_list->result() as $agent)
		{
			// First let's concatenate the new keyname. We'll use this to 
			// create a data member and attempt to populate it with
			// a matched $_POST value.
			$keyname = 'a_'.$agent->id;
			
			// Is there a $_POST that matches our key name?
			if(isset($_POST[$keyname]))
			{	
				// Create data member. Value is from matched $_POST.			
				$post->$keyname = $_POST[$keyname];
				
				// Add parameter input to SQL string.
				$sql .= ' (?, ?),';
				
				// Insert values into parameter array.
				$params[] = &$inserted->id;		
				$params[] = &$post->$keyname;
			}
			else
			{
				// We didn't have a $_POST for this key name,
				// so create an empty data member instead.
				$post->$keyname = NULL;
			}			
		}
		
		// Trim off the trailing comma.
		$sql = trim($sql, ',');
		
		// Ensure there are values to insert.
		if(count($params))
		{		
			// Run the insert query.
			$query->set_sql($sql);
			$query->set_params($params);
			$query->query();
		}
		
		// Insert body records.		
		// Set up base sql string and empty parameter array.
		$sql = 'INSERT INTO tbl_incident_body (fk_id, item) VALUES ';
		$params = array();
		
		// Loop through all table items.
		foreach($body_list->result() as $body)
		{
			// First let's concatenate the new keyname. We'll use this to 
			// create a data member and attempt to populate it with
			// a matched $_POST value.
			$keyname = 'b_'.$body->id;
			
			// Is there a $_POST that matches our key name?
			if(isset($_POST[$keyname]))
			{	
				// Create data member. Value is from matched $_POST.			
				$post->$keyname = $_POST[$keyname];
				
				// Add parameter input to SQL string.
				$sql .= ' (?, ?),';
				
				// Insert values into parameter array.
				$params[] = &$inserted->id;		
				$params[] = &$post->$keyname;
			}
			else
			{
				// We didn't have a $_POST for this key name,
				// so create an empty data member instead.
				$post->$keyname = NULL;
			}			
		}
		
		// Trim off the trailing comma.
		$sql = trim($sql, ',');
		
		// Ensure there are values to insert.
		if(count($params))
		{		
			// Run the insert query.
			$query->set_sql($sql);
			$query->set_params($params);
			$query->query();
		}
		
		// Insert nature records.		
		// Set up base sql string and empty parameter array.
		$sql = 'INSERT INTO tbl_incident_nature (fk_id, item) VALUES ';
		$params = array();
		
		// Loop through all table items.
		foreach($nature_list->result() as $nature)
		{
			// First let's concatenate the new keyname. We'll use this to 
			// create a data member and attempt to populate it with
			// a matched $_POST value.
			$keyname = 'n_'.$nature->id;
			
			// Is there a $_POST that matches our key name?
			if(isset($_POST[$keyname]))
			{	
				// Create data member. Value is from matched $_POST.			
				$post->$keyname = $_POST[$keyname];
				
				// Add parameter input to SQL string.
				$sql .= ' (?, ?),';
				
				// Insert values into parameter array.
				$params[] = &$inserted->id;		
				$params[] = &$post->$keyname;
			}
			else
			{
				// We didn't have a $_POST for this key name,
				// so create an empty data member instead.
				$post->$keyname = NULL;
			}			
		}
		
		// Trim off the trailing comma.
		$sql = trim($sql, ',');
		
		// Ensure there are values to insert.
		if(count($params))
		{		
			// Run the insert query.
			$query->set_sql($sql);
			$query->set_params($params);
			$query->query();
		}
	
		// Set up and send email alert.		
		$subject = MAILING::SUBJECT;
		$body = 'Incident posted. <a href="http://ehs.uky.edu/apps/incident/details.php?&id='.$inserted->id.'">Click here</a> to view.';
	
		$headers   = array();
		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-type: text/html; charset=iso-8859-1";
		if(MAILING::FROM)	$headers[] = "From: ".MAILING::FROM;
		if(MAILING::BCC)	$headers[] = "Bcc: ".MAILING::BCC;
		if(MAILING::CC) 	$headers[] = "Cc: ".MAILING::CC;
					
		// Run mail function.
		mail(MAILING::TO, MAILING::SUBJECT, $body, implode("\r\n", $headers));	
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
				
			 	-webkit-column-count: 4;  				
				-moz-column-count: 4;				
			  column-count: 4;			 
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
					if($post->submit == CONSTANTS::SUBMIT_TRUE)
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
                                    // Iterate over each item.
                                    foreach ($type_list->result() as $type_row)
                                    {																					                                            
                                ?>
                                    	<span style="white-space:nowrap;">		
                                            <input type="radio" 
                                                name="type" 
                                                id="type_<?php echo $type_row->id; ?>" 
                                                value="<?php echo $type_row->id; ?>" required />
                                            <label for="type_<?php echo $type_row->id; ?>"><?php echo $type_row->label; ?></label>
                                        </span>                                  
                                        
                                <?php
                                    }
                                ?>                                              
                            </fieldset>
                            
                            <fieldset>
                            	<legend>Identity</legend>
                                	
                                    <p>Please use these fields to identify the accident/near miss victim or person discovering a hazardous condition.</p>
                                    
                                    <label for="name_f">First Name</label>
                                	<input type="text" name="name_f" id="name_f" value="<?php echo $post->name_f; ?>" placeholder="First Name" required />
                                    
                                    <label for="name_l">Last Name</label>
                                	<input type="text" name="name_l" id="name_l" value="<?php echo $post->name_l; ?>" placeholder="Last Name" required />
                                    
                                    <label for="account">Account</label>
                                	<input type="text" name="account" id="account" value="<?php echo $post->account; ?>" placeholder="Link Blue Account" />
                                    
                                    <label for="email">E-Mail</label>
                                	<input type="email" name="email" id="email" value="<?php echo $post->email; ?>" placeholder="E-Mail Address" required />
                                    
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
                                            data-current="<?php echo $post->department; ?>" 
                                            data-source-url="../../libraries/inserts/department.php" 
                                            data-extra-options='<option value="">Select Department</option><option value="-1">No UK Affiliation</option>'
                                            data-grouped="0"> 
                                            	<!--This option is for valid HTML5; it is overwritten on load.--> 
                                        		<option value="0">Select Department</option>                                                                      
                                                <!--Options will be populated on load via jquery.-->								
                                        </select>
                                    </div>
                                    
                                    <label for="phone">Phone</label>
                                	<input type="tel" name="phone" id="phone" value="<?php echo $post->phone; ?>" placeholder="xxx-xxx-xxxx" required />
                                
                                	<div>                                  
                                        <span class="label">Would you like to be contacted?</span>
                                        <div class="fieldset_box">   
                                            
                                            <input type="radio" 
                                            	name="contact" 
                                                id="contact_<?php echo CONSTANTS::NO ?>" 
                                                value="<?php echo CONSTANTS::NO ?>" 
                                                required <?php if(!$post->status) echo 'checked'; ?> />
                                            <label for="contact_<?php echo CONSTANTS::NO ?>">No</label>
                                                                                            
                                            <span style="white-space:nowrap;">
                                            	<input type="radio" 
                                                    name="contact" 
                                                    id="contact_<?php echo CONSTANTS::YES ?>" 
                                                    value="<?php echo CONSTANTS::YES ?>" 
                                                    required <?php if($post->status) echo 'checked'; ?> />
                                                <label for="contact_<?php echo CONSTANTS::YES ?>">Yes</label>
                                            </span>                        
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
                                        data-current="<?php echo $post->facility; ?>" 
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
                                    <p id="room_progress" class="load color_red center display_none">
                                        Loading rooms...
                                        <img id="img_room_load_progress" 
                                            src="../../media/image/meter_bar.gif" 
                                            alt="Loading items... " 
                                            title="Loading items..." />                               
                                    </p>
                                    <label for="room">Room</label>
                                    <select name="room" 
                                        id="room" 
                                        data-current="<?php echo $post->room; ?>" 
                                        data-source-url="../../libraries/inserts/room.php" 
                                        data-grouped="1" 
                                        data-extra-options='<option value="">Select Room/Area/Lab</option><option value="-2">Outside</option>' 
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
                                        // Iterate over each item.
                                        foreach ($agent_list->result() as $agent)
                                        {
											// Concatenate the data member name.
											$prop = 'a_'.$agent->id;											                                            
                                    ?>		
                                            <li>
                                                <input type="checkbox" 
                                                    name="<?php echo $prop; ?>" 
                                                    id="<?php echo $prop; ?>" 
                                                    value="<?php echo $agent->id; ?>" 
                                                    <?php if($post->$prop) echo "checked"; ?> />
                                                <label for="<?php echo $prop ?>"><?php echo $agent->label; ?></label>
                                            </li> 
                                    <?php
                                        }
                                    ?>                                         	
                                </ul>
                                
                            </fieldset>
                            
                            <fieldset>
                            	<legend>Location of Injury</legend>
                                
                                <p>Please check all injured locations on body.</p>
                                            
                                <ul class="checkbox"> 
                                    
                                    <?php 
                                        // Iterate over each item.
                                        foreach ($body_list->result() as $body)
                                        {
											// Concatenate the data member name.
											$prop = 'b_'.$body->id;                                         
                                    ?>		
                                            <li>
                                                <input type="checkbox" 
                                                    name="<?php echo $prop; ?>" 
                                                    id="<?php echo $prop; ?>" 
                                                    value="<?php echo $body->id; ?>" 
                                                    <?php if($post->$prop) echo "checked"; ?> />
                                                <label for="<?php echo $prop ?>"><?php echo $body->label; ?></label>
                                            </li> 
                                    <?php
                                        }
                                    ?>                                         	
                                </ul>                                
                            </fieldset>
                            
                            <fieldset>
                            	<legend>Nature</legend>
                                
                                <p>Please indicate the nature of any injuries. Check all that apply.</p>
                                            
                                <ul class="checkbox"> 
                                    
                                    <?php 
                                        // Iterate over each item.
                                        foreach ($nature_list->result() as $nature)
                                        {
											// Concatenate the data member name.
											$prop = 'n_'.$nature->id;
                                    ?>		
                                            <li>
                                                <input type="checkbox" 
                                                    name="<?php echo $prop; ?>" 
                                                    id="<?php echo $prop; ?>" 
                                                    value="<?php echo $nature->id; ?>" 
                                                    <?php if($post->$prop) echo "checked"; ?> />
                                                <label for="<?php echo $prop; ?>"><?php echo $nature->label; ?></label>
                                            </li> 
                                    <?php
                                        }
                                    ?>                                         	
                                </ul>                                
                            </fieldset>                     
                            
                            <fieldset>
                            	<legend>Details</legend>
                                
                                <p>Please indicate the time of incident and provide a short description.</p>
                                
                                <label for="time">Time</label>
                                <input type="datetime" name="time" id="time" value="<?php //echo $post->phone; ?>" class="date_entry" readonly />
                            
                            	<label for="desc">Description</label>
                                <textarea name="desc" id="desc" cols="50" required></textarea>                                                            
                            </fieldset>
                            
                            <button type="submit" name="submit" id="submit" value="<?php echo CONSTANTS::SUBMIT_TRUE; ?>">Send Report</button>
                        </form>
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
        </div><!--#constainer-->
        
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
				options_update(event, null, '#room');	
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