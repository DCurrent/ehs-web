<?php 

	require('../../libraries/php/classes/config.php'); //Basic configuration file.
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
	$type_list 		= new list_populate('tbl_incident_type_list');		// Types.
	$agent_list 	= new list_populate('tbl_incident_agent_list');		// Agents.
	$nature_list	= new list_populate('tbl_incident_nature_list'); 	// Nature.
	$body_list 		= new list_populate('tbl_incident_body_list');		// Body.	

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
                    <p>Use the criteria below to determine what items from incident database you would like to see. When ready, press create report and your report will be generated.</p>
                                        
                    <form method="post" name="main" id="main" action="../incident - Copy/report_out.php" target="_new">
                        <fieldset id="fs_time_range">
                            <legend>Time Range</legend>
                            <p>Select the time range. Default range will include all items up to the present moment.</p>
                            <?php
                                $query->set_sql("SELECT TOP 1 time FROM tbl_incident WHERE time IS NOT NULL ORDER BY time");
                                $query->query();
                                $query->get_line_params()->set_class_name('class_incident');
                            ?>
                            <label for="time_range_start">Start</label>
                            <input type="date" name="time_range_start" id="time_range_start" value="<?php echo date(DATE_FORMAT, $query->get_line_object()->get_time()->getTimestamp()); ?>"  class="date_entry" placeholder="yyyy-mm-dd hh:mm:ss" readonly />
                            
                            <label for="time_range_end">End</label>
                            <input type="date" name="time_range_end" id="time_range_end" value="<?php echo date('Y-m-d h:m:s'); ?>" class="date_entry" placeholder="yyyy-mm-dd hh:mm:ss" readonly />
                        </fieldset>
                    
                        <fieldset class="center">
                            <legend>Type</legend>
                                                         
                            <p>Check incident types, or leave blank to include all types.</p>
                                        
                            <ul class="checkbox"> 
                                
                                <?php 
                                    // Iterate over each item.
                                    foreach ($type_list->result() as $type_row)
                                    {
                                        // Concatenate the data member name.
                                        $prop = 'type_'.$type_row->get_id();											                                            
                                ?>		
                                        <li>
                                            <input type="checkbox" 
                                                name="type[]" 
                                                id="<?php echo $prop; ?>" 
                                                value="<?php echo $type_row->get_id(); ?>" 
                                                <?php if($post->$prop) echo "checked"; ?> />
                                            <label for="<?php echo $prop ?>"><?php echo $type_row->get_label(); ?></label>
                                        </li> 
                                <?php
                                    }
                                ?>                                         	
                            </ul>
                                                            
                        </fieldset>
                        
                        <fieldset>
                            <legend>Identity</legend>
                                
                                <p>You may use these fields to filter results by a specfic name, account, email, and so on. Leave blank to include all items from a given field.</p>
                                
                                <label for="name_f">First Name</label>
                                <input type="text" name="name_f" id="name_f" value="<?php echo $post->get_name_f(); ?>" placeholder="First Name" />
                                
                                <label for="name_l">Last Name</label>
                                <input type="text" name="name_l" id="name_l" value="<?php echo $post->get_name_l(); ?>" placeholder="Last Name"  />
                                
                                <label for="account">Account</label>
                                <input type="text" name="account" id="account" value="<?php echo $post->get_account(); ?>" placeholder="Link Blue Account" />
                                
                                <label for="email">E-Mail</label>
                                <input type="email" name="email" id="email" value="<?php echo $post->get_email(); ?>" placeholder="E-Mail Address"  />
                                
                                                               
                            
                                <div>                                  
                                    <span class="label">Wants to be contacted.</span>
                                    <div class="fieldset_box">   
                                        <ul class="checkbox">				
                                            <li>
                                                <input type="checkbox" 
                                                    name="contact[]" 
                                                    id="contact_<?php echo CONSTANTS::YES ?>" 
                                                    value="<?php echo CONSTANTS::YES ?>" />
                                                <label for="contact_<?php echo CONSTANTS::YES ?>">Yes</label>
                                            </li>  
                                            
                                            <li>
                                                <input type="checkbox" 
                                                    name="contact[]" 
                                                    id="contact_<?php echo CONSTANTS::NO ?>" 
                                                    value="<?php echo CONSTANTS::NO ?>" />
                                                <label for="contact_<?php echo CONSTANTS::NO ?>">No</label>
                                            </li>                                                                                       	
                                        </ul><!--.checkbox-->                                                    
                                    </div>
                                </div>
                                            
                            
                        </fieldset>
                        
                        <fieldset id="fs_department">
                            <legend>Department</legend>
                            <p>Select departments to include here. If using Windows, hold Ctrl to make multiple selections. If using Mac, hold Cmd. You may choose many as you like. If no selections are made, all departments will be included.</p>
                            
                            <div>
                                <p id="department_progress" class="load color_red center">
                                    Loading departments...
                                    <img id="img_department_load_progress" 
                                        src="../../media/image/meter_bar.gif" 
                                        alt="Loading items... " 
                                        title="Loading items..." />
                                </p>
                                <label for="department">Department</label>
                                <select multiple name="department[]"
                                    size="10" 
                                    id="department" 
                                    data-current="<?php echo $post->get_department(); ?>" 
                                    data-source-url="../../libraries/inserts/department.php" 
                                    data-extra-options='<option value="-1">No UK Affiliation</option>'
                                    data-grouped="0"> 
                                        <!--This option is for valid HTML5; it is overwritten on load.--> 
                                        <option value="0">Select Department</option>                                                                      
                                        <!--Options will be populated on load via jquery.-->								
                                </select>
                            </div>
                        </fieldset>
                        
                        <fieldset>
                            <legend>Location</legend>
                            
                            <p class="instructions">Select locations to include by first selecting facilities, then specific rooms/areas. If using Windows, hold Ctrl to make multiple selections. If using Mac, hold Cmd. You may choose as many items as you like in either field. Making no selections in the Facility or Room field will result in all facilities or rooms/areas being included respectively.</p>              
            
                            <div>
                                <p id="facility_progress" class="load color_red center">
                                    Loading facilities...
                                    <img id="img_facility_load_progress" 
                                        src="../../media/image/meter_bar.gif" 
                                        alt="Loading items... " 
                                        title="Loading items..." />
                                </p>
                                <label for="facility">Facility</label>
                                <select multiple size="10" 
                                    name="facility[]" 
                                    id="facility" 
                                    data-current="<?php echo $post->get_facility(); ?>" 
                                    data-source-url="../../libraries/inserts/facility.php" 
                                    data-extra-options=''
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
                                <label for="area">Room</label>
                                <select multiple
                                    size="10"
                                    name="area[]" 
                                    id="area" 
                                    data-current="<?php echo $post->get_area(); ?>" 
                                    data-source-url="../../libraries/inserts/room.php" 
                                    data-grouped="1" 
                                    data-extra-options='<option value="<?php echo CONSTANTS::AREA_OUTSIDE; ?>">Outside</option>' 
                                    class="disable" 
                                    disabled>
                                        <!--This option is for valid HTML5; it is overwritten on load.--> 
                                        <option value="1">Select Room/Area/Lab</option>                                  							
                                </select>                                    
                            </div>                                                                	
                        </fieldset>
                        
                        
                                           
                        
                        <fieldset>
                            <legend>Agents</legend>
                            
                            <p>Check agent items. Leave blank if you wish to include all agents.</p>
                                        
                            <ul class="checkbox">                 
                                
                                <?php 
                                    // Iterate over each item.
                                    foreach ($agent_list->result() as $agent)
                                    {
                                        // Concatenate the data member name with id.
                                        $prop = 'agent_'.$agent->get_id();											                                            
                                ?>		
                                        <li>
                                            <input type="checkbox" 
                                                name="agent[]" 
                                                id="<?php echo $prop; ?>" 
                                                value="<?php echo $agent->get_id(); ?>" 
                                                <?php if($post->$prop) echo "checked"; ?> />
                                            <label for="<?php echo $prop ?>"><?php echo $agent->get_label(); ?></label>
                                        </li> 
                                <?php
                                    }
                                ?>                                         	
                            </ul>
                            
                        </fieldset>
                        
                        <fieldset>
                            <legend>Location of Injury</legend>
                            
                            <p>Check injury items. Leave blank if you wish to include all injury locations.</p>
                                        
                            <ul class="checkbox"> 
                                
                                <?php 
                                    // Iterate over each item.
                                    foreach ($body_list->result() as $body)
                                    {
                                        // Concatenate the data member name.
                                        $prop = 'body_'.$body->get_id();                                         
                                ?>		
                                        <li>
                                            <input type="checkbox" 
                                                name="body[]" 
                                                id="<?php echo $prop; ?>" 
                                                value="<?php echo $body->get_id(); ?>" 
                                                <?php if($post->$prop) echo "checked"; ?> />
                                            <label for="<?php echo $prop ?>"><?php echo $body->get_label(); ?></label>
                                        </li> 
                                <?php
                                    }
                                ?>                                         	
                            </ul>                                
                        </fieldset>
                        
                        <fieldset>
                            <legend>Nature</legend>
                            
                            <p>Check nature items. Leave blank if you wish to include all injury nature items.</p>
                                        
                            <ul class="checkbox"> 
                                
                                <?php 
                                    // Iterate over each item.
                                    foreach ($nature_list->result() as $nature)
                                    {
                                        // Concatenate the data member name.
                                        $prop = 'nature_'.$nature->get_id();
                                ?>		
                                        <li>
                                            <input type="checkbox" 
                                                name="nature[]" 
                                                id="<?php echo $prop; ?>" 
                                                value="<?php echo $nature->get_id(); ?>" 
                                                <?php if($post->$prop) echo "checked"; ?> />
                                            <label for="<?php echo $prop; ?>"><?php echo $nature->get_label(); ?></label>
                                        </li> 
                                <?php
                                    }
                                ?>                                         	
                            </ul>                                
                        </fieldset>                         
                        
                        <button type="submit" name="submit" id="submit" value="<?php echo CONSTANTS::SUBMIT_TRUE; ?>">Create Report</button>
                    </form>
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
			 var $temp_int = 0;
			
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
				$( '.date_entry' ).datetimepicker({dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss', changeYear: true, constrainInput: true});
			});
		
        	$(document).ready(function(event) {		
				//options_update(event, null, '#agent');
				options_update(event, null, '#department');	
				options_update(null, null, '#facility');				
			});
        
			function ec_append($temp_int)
		{
			$(".ec").append(
				'<fieldset>'
					+'<legend>'
						+'<a href="#" title="Remove this item." class="ec_edit cmd_remove_ec"><img src="/media/image/icon_minus.ico" alt="-" title="Remove this item." style="border:none; margin:0px 0px 0px 0px; padding: 0px 0px 0px 0px"></a>'
					+'</legend>'
				
				);
				
				//options_update(null, null, '#department');
		}
		
		// Add new input with associated 'remove' link when 'add' button is clicked.
		$('.cmd_add_ec').click(function(e) {
			e.preventDefault();			
			ec_append($temp_int);		
			$temp_int++;
		});
		
		// Remove parent of 'remove' link when link is clicked.
		$('.ec').on('click', '.cmd_remove_ec', function(e) {
			e.preventDefault();
		
			$(this).parent().parent().remove();
		});
		
        </script>
    </body>
</html>