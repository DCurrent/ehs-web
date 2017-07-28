<?php 
	
	
	
	// Just to avoid lots of retpying.
	
	require(__DIR__.'/source/main.php');
	
	// Page caching.
	$page_obj = new class_page_cache();
	ob_start();
			
	// Main navigaiton.
	$obj_navigation_main = new class_navigation();
	$obj_navigation_main->generate_markup_nav();
	$obj_navigation_main->generate_markup_footer();	
				
	// Set up database.
	$db_conn_set = new class_db_connect_params();
	$db_conn_set->set_name(DATABASE::NAME);
	
	$db = new class_db_connection($db_conn_set);
	$query = new class_db_query($db);		
			
	// Record navigation.
	$obj_navigation_rec = new class_record_nav();	
	
	// Prepare redirect url with variables.
	$url_query	= new url_query;
	$url_query->set_data('action', $obj_navigation_rec->get_action());
	$url_query->set_data('id', $obj_navigation_rec->get_id());
	
	// User access.
	$access_obj = new class_access_status();
	$access_obj->get_settings()->set_authenticate_url(APPLICATION_SETTINGS::AUTHENTICATE_URL);
	$access_obj->set_redirect($url_query->return_url());
		
	$access_obj->verify();
	$access_obj->action();
	
	
	// Initialize our data objects. This is just in case there is no table
	// data for any of the navigation queries to find, we are making new
	// records, or copies of records. It also has the side effect of enabling 
	// IDE type hinting.
	$_main_data = new class_fire_alarm_data();	
		
	// Ensure the main data ID member is same as navigation object ID.
	$_main_data->set_id($obj_navigation_rec->get_id());
			
	switch($obj_navigation_rec->get_action())
	{		
	
		default:		
		case RECORD_NAV_COMMANDS::NEW_BLANK:
		
			//$_main_data->set_account($access_obj->get_account());
			$_main_data->set_status(1);
			break;
			
		case RECORD_NAV_COMMANDS::NEW_COPY:			
			
			// Populate the object from post values.			
			$_main_data->populate_from_request();			
			break;
			
		case RECORD_NAV_COMMANDS::LISTING:
			
			// Direct to listing.				
			header('Location: alarm_list.php');
			break;
			
		case RECORD_NAV_COMMANDS::DELETE:						
			
			// Populate the object from post values.			
			$_main_data->populate_from_request();
				
			// Call and execute delete SP.
			$query->set_sql('{call fire_alarm_delete(@id = ?)}');			
			
			$query->set_params(array(array($_main_data->get_id(), SQLSRV_PARAM_IN)));
			$query->query();
			
			// Refrsh page to the previous record.				
			header('Location: '.$_SERVER['PHP_SELF']);			
				
			break;				
					
		case RECORD_NAV_COMMANDS::SAVE:
			
			// Stop errors in case someone tries a direct command link.
			if($obj_navigation_rec->get_command() != RECORD_NAV_COMMANDS::SAVE) break;
			
			$file_name = NULL;
			
			// Save the record. Saving main record is straight forward. We’ll run the populate method on our 
			// main data object which will gather up post values. Then we can run a query to merge the values into 
			// database table. We’ll then get the id from saved record (since we are using a surrogate key, the ID
			// should remain static unless this is a brand new record). 
			
			// If necessary we will then save any sub records (see each for details).
			
			// Finally, we redirect to the current page using the freshly acquired id. That will ensure we have 
			// always an up to date ID for our forms and navigation system.			
		
			// Populate the object from post values.			
			$_main_data->populate_from_request();
			
			$_main_data_label = $_main_data->get_label(); 
		
			// Call update stored procedure.
			$query->set_sql('{call fire_alarm_update(@id 			= ?,														 
													@label 			= ?,
													@details 		= ?,
													@log_update 	= ?, 
													@log_update_by 	= ?, 
													@log_update_ip 	= ?,
													@building_code 	= ?,
													@room_code 		= ?,																										 
													@time_reported 	= ?,
													@time_silenced	= ?,
													@time_reset		= ?,
													@report_device_pull 		= ?,
													@report_device_sprinkler 	= ?,
													@report_device_smoke 		= ?,
													@report_device_stove		= ?,
													@cause			= ?,
													@occupied		= ?,
													@evacuated		= ?,
													@notified		= ?,
													@fire			= ?,
													@extinguisher	= ?,
													@injuries		= ?,
													@fatalities		= ?,
													@injury_desc	= ?,
													@property_damage = ?,
													@responsible_party = ?,
													@public_details = ?,
													@status			= ?)}');
						
												
			$params = array(array($_main_data->get_id(), 		SQLSRV_PARAM_IN),
						array($_main_data->get_label(), 		SQLSRV_PARAM_IN),						
						array($_main_data->get_details(), 		SQLSRV_PARAM_IN),
						array(date('Y-m-d H:i:s'), 					SQLSRV_PARAM_IN),
						array($access_obj->get_account(), 		SQLSRV_PARAM_IN),
						array($access_obj->get_ip(), 			SQLSRV_PARAM_IN),
						array($_main_data->get_building_code(), SQLSRV_PARAM_IN),
						array($_main_data->get_room_code(), 	SQLSRV_PARAM_IN),
						array($_main_data->get_time_reported(),	SQLSRV_PARAM_IN),
						array($_main_data->get_time_silenced(),	SQLSRV_PARAM_IN),
						array($_main_data->get_time_reset(),	SQLSRV_PARAM_IN),
						array($_main_data->get_report_device_pull(),		SQLSRV_PARAM_IN),
						array($_main_data->get_report_device_sprinkler(),	SQLSRV_PARAM_IN),
						array($_main_data->get_report_device_smoke(), 		SQLSRV_PARAM_IN),
						array($_main_data->get_report_device_stove(),		SQLSRV_PARAM_IN),
						array($_main_data->get_cause(),			SQLSRV_PARAM_IN),
						array($_main_data->get_occupied(),		SQLSRV_PARAM_IN),
						array($_main_data->get_evacuated(),		SQLSRV_PARAM_IN),
						array($_main_data->get_notified(),		SQLSRV_PARAM_IN),
						array($_main_data->get_fire(),			SQLSRV_PARAM_IN),
						array($_main_data->get_extinguisher(),	SQLSRV_PARAM_IN),
						array($_main_data->get_injuries(),		SQLSRV_PARAM_IN),
						array($_main_data->get_fatalities(),	SQLSRV_PARAM_IN),
						array($_main_data->get_injury_desc(),	SQLSRV_PARAM_IN),
						array($_main_data->get_property_damage(),	SQLSRV_PARAM_IN),
						array($_main_data->get_responsible_party(),	SQLSRV_PARAM_IN),
						array($_main_data->get_public_details(),	SQLSRV_PARAM_IN),
						array($_main_data->get_status(),		SQLSRV_PARAM_IN));
			
			$query->set_params($params);			
			$query->query();
			
			// Repopulate main data object with results from merge query.
			$query->get_line_params()->set_class_name('class_fire_alarm_data');
			$_main_data = $query->get_line_object();
					
			// Refrsh page to reload the record.				
			//header('Location: '.$_SERVER['PHP_SELF'].'?id='.$_main_data->get_id());
			
			break;			
	}
	
	// Last thing to do before moving on to main html is to get data to populate objects that
	// will then be used to generate forms and subforms. This may have already been done, 
	// such as when making copies of a record, but normally only a only blank object 
	// will exist at this point. We run a basic select query from our current ID and 
	// if a row is found overwrite whatever is in the main data object. If needed, we
	// repeat the process for any sub queries and forms.
	//
	// If there is no row at all found, nothing will be done - this is intended behavior because
	// there could be several reasons why no record is found here and we don't want to have 
	// overly complex or repetitive logic, but that does mean we have to make sure there
	// has been an object established at some point above.
	
	//////
	$query->set_sql('{call fire_alarm_detail(@id = ?,														 
								@sort_field 	= ?,
								@sort_order 	= ?,
								@nav_first		= ?,
								@nav_previous	= ?,
								@nav_next		= ?,
								@nav_last		= ?)}');	
	$nav_first 		= NULL;
	$nav_previous	= NULL;
	$nav_next		= NULL;
	$nav_last 		= NULL;
					
	$params = array(array($obj_navigation_rec->get_id(), 	SQLSRV_PARAM_IN),
					array(NULL, 		SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_INT),
					array(NULL, 		SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_INT),
					array($nav_first,	SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_INT),
					array($nav_previous, SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_INT),
					array($nav_next, 	SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_INT),
					array($nav_last, 	SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_INT));

	$query->set_params($params);
	$query->query();
	
	
	
	$query->get_line_params()->set_class_name('class_fire_alarm_data');
	
	if($query->get_row_exists() === TRUE) $_main_data = $query->get_line_object();
	
	if($_main_data->get_building_code())
	{
		// Generate building list here
	}
	
	if($_main_data->get_room_code())
	{
		// Generate room list here
	}
	
	// Datalist list generation.
	// Cause.
	$_obj_data_list_facility_list = NULL;
	
	$query->set_sql('{call facility_list}');
		
	$query->query();
	$query->get_line_params()->set_class_name('class_facility_data');
	
	$_obj_data_list_facility_list = $query->get_line_object_list();
	
	// Cause.
	$_obj_data_list_cause_list = NULL;
	
	$query->set_sql('{call fire_alarm_cause_list}');
		
	$query->query();
	$query->get_line_params()->set_class_name('class_common_data');
	
	// Populate data object array with results, or a single object if no
	// rows were found.
	$_obj_data_list_cause_list = $query->get_line_object_list();
	
	// Party.
	$_obj_data_list_party_list = NULL;
	
	$query->set_sql('{call fire_alarm_party_list}');
		
	$query->query();
	$query->get_line_params()->set_class_name('class_common_data');
	
	// Populate data object array with results, or a single object if no
	// rows were found.
	$_obj_data_list_party_list = $query->get_line_object_list();
	
	// Type.
	$_obj_data_list_type_list = NULL;
	
	$query->set_sql('{call fire_alarm_type_list}');
		
	$query->query();
	$query->get_line_params()->set_class_name('class_common_data');
	
	// Populate data object array with results, or a single object if no
	// rows were found.
	$_obj_data_list_type_list = $query->get_line_object_list();	
			
	// Populate main navigation with ID's from main data stored procedure.
	$obj_navigation_rec->set_id_first($nav_first);
	$obj_navigation_rec->set_id_previous($nav_previous);
	$obj_navigation_rec->set_id_next($nav_next);
	$obj_navigation_rec->set_id_last($nav_last);

	$obj_navigation_rec->generate_button_list();
?>

<!DOCtype html>
<html lang="en">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php echo APPLICATION_SETTINGS::NAME; ?>, Alarm Details</title>        
        
         <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="source/css/style.css" />
        <link rel="stylesheet" href="source/css/print.css" media="print" />
        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        
        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        
        <!-- Place inside the <head> of your HTML -->
		<script type="text/javascript" src="http://ehs.uky.edu/libraries/vendor/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"});
        </script>
        <script src="../../libraries/javascript/options_update.js"></script>
    
    	<style>
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
		</style>
    </head>
    
    <body>    
        <div id="container" class="container">            
            <?php echo $obj_navigation_main->get_markup_nav(); ?>                                                                                
            <div class="page-header">           
                <h1>Alarm Entry</h1>
                <p>This screen allows for adding and editing individual alarm entries.</p>
            </div>
            
            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">           
           		<input type="hidden" name="account" id="account" value="<?php echo $_main_data->get_log_update_by(); ?>" />
                
				<?php echo $obj_navigation_rec->get_markup(); ?>         
          
          		<?php
					$lookup = new class_access_lookup;
				
					if($_main_data->get_log_create_by())
					{
						$lookup->lookup($_main_data->get_log_create_by());
					}
					else
					{
						$lookup->lookup($access_obj->get_account());
					}
				?>         		
          
          		<div class="form-group">
                	<label class="control-label col-sm-2" for="created">Created:</label>
                	<div class="col-sm-10">
                		<input 
                        	type	="text" 
                            class	="form-control"  
                            name	="created" 
                            id		="created" 
                            placeholder="Time record was created." readonly 
                            value="<?php if(is_object($_main_data->get_log_create())) echo date('Y-m-d H:i:s', $_main_data->get_log_create()->getTimestamp()); ?>">
                	</div>
                </div>
          
          		<div class="form-group">
                	<label class="control-label col-sm-2" for="create_by">Created by:</label>
                	<div class="col-sm-10">
                		<input type="text" class="form-control"  name="create_by" id="create_by" placeholder="Person creating incident." 
                        value="<?php echo $lookup->get_account_data()->name_proper(); ?>" 
						readonly>
                	</div>
                </div>
                
             	<div class="form-group">       
                    <label class="control-label col-sm-2" for="last_update">Last Update:</label>
                	<div class="col-sm-10">
                		<input 
                        	type	="text" 
                            class	="form-control"  
                            name	="last_update" 
                            id		="last_update" 
                            placeholder="Time record was updated." readonly 
                            value="<?php if(is_object($_main_data->get_log_update())) echo date('Y-m-d H:i:s', $_main_data->get_log_update()->getTimestamp()); ?>">
                	</div>
                </div>
                
                <?php
					if($_main_data->get_log_update_by())
					{
						$lookup->lookup($_main_data->get_log_update_by());
					}
					else
					{
						$lookup->lookup($access_obj->get_account());
					}
				?> 
                
                <div class="form-group">
                	<label class="control-label col-sm-2" for="update_by">Last Update by:</label>
                	<div class="col-sm-10">
                		<input type="text" class="form-control"  name="update_by" id="update_by" placeholder="Person who last updated incident." 
                        value="<?php echo $lookup->get_account_data()->name_proper(); ?>" 
						readonly>
                	</div>
                </div>
                           
                <div class="form-group">
                	<label class="control-label col-sm-2" for="label">Name:</label>
                	<div class="col-sm-10">
                		<input type="text" class="form-control"  name="label" id="label" placeholder="Title of entry." value="<?php echo $_main_data->get_label(); ?>" required>
                	</div>
                </div>
                
                <fieldset id="fs_location">
                	<legend>Location</legend>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="facility">Facility</label>
                        <div class="col-sm-10">
                            <select name="building_code" 
                                id="building_code" 
                                data-current="<?php //echo $post->get_facility(); ?>" 
                                data-source-url="../../libraries/inserts/facility.php" 
                                data-extra-options='<option value="">Select Facility</option>'
                                data-grouped="1"
                                class="room_search form-control">
                                <!--This option is for valid HTML5; it is overwritten on load.--> 
                                    <option value="">Select Facility</option>                                    
                                    <!--Options will be populated on load via jquery.-->
                                <?php
									if(is_object($_obj_data_list_facility_list) === TRUE)
									{
										for($_obj_data_list_facility_list->rewind(); $_obj_data_list_facility_list->valid(); $_obj_data_list_facility_list->next())
										{						
											$_obj_data_list_facility = $_obj_data_list_facility_list->current();
											
											$selected = NULL;
											
											if($_obj_data_list_facility->get_code() == $_main_data->get_building_code())
											{
												$selected = ' selected ';
											}
											?>
												<option 
                                                value = "<?php echo $_obj_data_list_facility->get_code(); ?>" <?php echo $selected; ?>><?php echo $_obj_data_list_facility->get_code(). ' - '.$_obj_data_list_facility->get_label(); ?></option>												                                                    
											<?php										
										}
									}
								?>                               
                            </select>
                        </div>
                    </div> 
                                   
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="room_code">Area</label>
                        <div class="col-sm-10">
                            <select name="room_code" 
                                id="room_code" 
                                data-current="<?php echo $_main_data->get_room_code(); ?>" 
                                data-source-url="../../libraries/inserts/room.php" 
                                data-grouped="1" 
                                data-extra-options='<option value="">Select Room/Area/Lab</option><option value="<?php echo ROOM_SELECT::OUTSIDE; ?>" <?php if ($_main_data->get_room_code() == -1) echo ' selected '; ?>>Outside</option>' 
                                class="room_code_search disable form-control" 
                                disabled>                                        
                                    <!--Options will be populated/replaced on load via jquery.-->
                                    <option value="0">Select Room/Area/Lab</option>                                  							
                            </select> 
                        </div>                                   
                    </div>
              	</fieldset>                
                
                <fieldset id="fs_alarm">
                	<legend>Alarm</legend>
                    
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="time_reported">Time of Incident:</label>
                        <div class="col-sm-10">
                            <input type="text"
                            	class	="form-control"  
                                name	="time_reported" 
                                id		="time_reported"
                                placeholder	="yyyy-mm-dd hh:mm" 
                            	value="<?php if(is_object($_main_data->get_time_reported())) echo date("Y-m-d H:i", $_main_data->get_time_reported()->getTimestamp()); ?>">
                        </div>                        
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="time_silenced">Time Silenced:</label>
                        <div class="col-sm-10">                            
                            <input type="text"
                            	class	="form-control"  
                                name	="time_silenced" 
                                id		="time_silenced"
                                placeholder	="yyyy-mm-dd hh:mm" 
                            	value="<?php if(is_object($_main_data->get_time_silenced())) echo date("Y-m-d H:i", $_main_data->get_time_silenced()->getTimestamp()); ?>">
                        </div>                        
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="time_reset">Time Reset:</label>
                        <div class="col-sm-10">                            
                            <input type="text"
                            	class	="form-control"  
                                name	="time_reset" 
                                id		="time_reset"
                                placeholder	="yyyy-mm-dd hh:mm" 
                            	value="<?php if(is_object($_main_data->get_time_reset())) echo date("Y-m-d H:i", $_main_data->get_time_reset()->getTimestamp()); ?>">
                        </div>                        
                    </div>
                    
                    <div class="form-group">                    	
                        <div class="col-sm-offset-2 col-sm-10">
                            <fieldset>
                                <legend>Report Methods</legend>
                                
                                <p>Toggle reporting devices.</p>
                                            
                                <ul class="checkbox">
                                    <li>
                                        <input 
                                            name="report_device_pull" 
                                            id="report_device_pull" 
                                            value="1" 
                                            type="checkbox" <?php if($_main_data->get_report_device_pull() == TRUE) echo ' checked '; ?>>
                                        <label for="report_device_pull">Pull Station</label>
                                    </li> 
                                        
                                    <li>
                                        <input 
                                            name="report_device_sprinkler" 
                                            id="report_device_sprinkler" 
                                            value="1" 
                                            type="checkbox" <?php if($_main_data->get_report_device_sprinkler() == TRUE) echo ' checked '; ?>>
                                        <label for="report_device_sprinkler">Sprinkler</label>
                                    </li>
                                    
                                    <li>
                                        <input 
                                            name="report_device_smoke" 
                                            id="report_device_smoke" 
                                            value="1" 
                                            type="checkbox" <?php if($_main_data->get_report_device_smoke() == TRUE) echo ' checked '; ?>>
                                        <label for="report_device_smoke">Smoke Detector</label>
                                    </li>
                                    
                                    <li>
                                        <input 
                                            name="report_device_stove" 
                                            id="report_device_stove" 
                                            value="1" 
                                            type="checkbox" <?php if($_main_data->get_report_device_stove() == TRUE) echo ' checked '; ?>>
                                        <label for="report_device_stove">Stove Suppression</label>
                                    </li>                                  
                                </ul>                                    
                            </fieldset>
                        </div>
                    </div>
            
                    
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="occupied">Occupied:</label>
                        <div class="col-sm-10">
                            <!--Occupied: <?php echo $_main_data->get_occupied(); ?>-->
                        
                            <div>
                                <label class="radio-inline">
                                    <input type="radio" name="occupied" value="0" <?php if(!$_main_data->get_occupied()) echo ' checked ';?>>No
                                </label>
                            
                                <label class="radio-inline">
                                    <input type="radio" name="occupied" value="1" <?php if($_main_data->get_occupied() == 1) echo ' checked ';?>>Yes
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="evacuated">Evacuated:</label>
                        <div class="col-sm-10">
                            <!--Occupied: <?php echo $_main_data->get_evacuated(); ?>-->
                        
                            <div>
                                <label class="radio-inline">
                                    <input type="radio" name="evacuated" value="0" <?php if(!$_main_data->get_evacuated()) echo ' checked ';?>>No
                                </label>
                            
                                <label class="radio-inline">
                                    <input type="radio" name="evacuated" value="1" <?php if($_main_data->get_evacuated() == 1) echo ' checked ';?>>Yes
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="notified">Notified:</label>
                        <div class="col-sm-10">
                            <!--Notified: <?php echo $_main_data->get_notified(); ?>-->
                        
                            <div>
                                <label class="radio-inline">
                                    <input type="radio" name="notified" value="0" <?php if(!$_main_data->get_notified()) echo ' checked ';?>>No
                                </label>
                            
                                <label class="radio-inline">
                                    <input type="radio" name="notified" value="1" <?php if($_main_data->get_notified() == 1) echo ' checked ';?>>Yes
                                </label>
                            </div>
                        </div>
                    </div>                
                </fieldset>
                        
                <fieldset id="incident">
                	<legend>Incident</legend>
                    
                    	<div class="form-group">
                            <label class="control-label col-sm-2" for="fire">Type of Incident:</label>
                            <div class="col-sm-10">
                                <!--Occupied: <?php echo $_main_data->get_fire(); ?>-->
                                <div>
                                	<?php
										if(is_object($_obj_data_list_type_list) === TRUE)
										{
											for($_obj_data_list_type_list->rewind(); $_obj_data_list_type_list->valid(); $_obj_data_list_type_list->next())
											{						
												$_obj_data_list_type = $_obj_data_list_type_list->current();
												
												$selected = NULL;
												
												if($_obj_data_list_type->get_id() == $_main_data->get_fire())
												{
													$selected = ' checked ';
												}
												?>
                                                	<label class="radio-inline">
                                                        <input type="radio" name="fire" value="<?php echo $_obj_data_list_type->get_id(); ?>" <?php echo $selected;?>><?php echo $_obj_data_list_type->get_label(); ?>
                                                    </label>                                                    
												<?php										
											}
										}
									?>                                               	
                                </div>
                            </div>
                        </div>
                    
                    	<div class="form-group">
                            <label class="control-label col-sm-2" for="cause">Cause of Incident:</label>
                            <div class="col-sm-10"> 
                                <select class		= "form-control"
                                        name		= "cause" 
                                        id			= "cause">
                                        <option value="0">Select Cause</option>
                                    <?php
                                        if(is_object($_obj_data_list_cause_list) === TRUE)
                                        {
                                            for($_obj_data_list_cause_list->rewind(); $_obj_data_list_cause_list->valid(); $_obj_data_list_cause_list->next())
                                            {						
                                                $_obj_data_list_cause = $_obj_data_list_cause_list->current();
                                                
                                                $selected = NULL;
                                                
                                                if($_obj_data_list_cause->get_id() == $_main_data->get_cause())
                                                {
                                                    $selected = ' selected ';
                                                }
                                                ?>
                                                    <option value="<?php echo $_obj_data_list_cause->get_id(); ?>" <?php echo $selected; ?>><?php echo $_obj_data_list_cause->get_label(); ?></option>
                                                <?php										
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                    	</div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="cause">Responsible Party:</label>
                            <div class="col-sm-10"> 
                                <select class		= "form-control"
                                        name		= "responsible_party" 
                                        id			= "responsible_party">
                                        <option value="0">Select Party</option>
                                    <?php
                                        if(is_object($_obj_data_list_party_list) === TRUE)
                                        {
                                            for($_obj_data_list_party_list->rewind(); $_obj_data_list_party_list->valid(); $_obj_data_list_party_list->next())
                                            {						
                                                $_obj_data_list_party = $_obj_data_list_party_list->current();
                                                
                                                $selected = NULL;
                                                
                                                if($_obj_data_list_party->get_id() == $_main_data->get_responsible_party())
                                                {
                                                    $selected = ' selected ';
                                                }
                                                ?>
                                                    <option value="<?php echo $_obj_data_list_party->get_id(); ?>" <?php echo $selected; ?>><?php echo $_obj_data_list_party->get_label(); ?></option>
                                                <?php										
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="extinguisher">Extinguisher:</label>
                            <div class="col-sm-10">
                                <!--Occupied: <?php echo $_main_data->get_extinguisher(); ?>-->
                            
                                <div>
                                    <label class="radio-inline">
                                        <input type="radio" name="extinguisher" value="0" <?php if(!$_main_data->get_extinguisher()) echo ' checked ';?>>No
                                    </label>
                                    
                                    <label class="radio-inline">
                                        <input type="radio" name="extinguisher" value="1" <?php if($_main_data->get_extinguisher() == 1) echo ' checked ';?>>Yes
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="label">Injuries:</label>
                            <div class="col-sm-3">
                                <input type="number" min="0" step="1" class="form-control"  name="injuries" id="injuries" value="<?php echo $_main_data->get_injuries(); ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="label">Fatalities:</label>
                            <div class="col-sm-3">
                                <!--<?php echo $_main_data->get_fatalities(); ?>-->
                                <input type="number" min="0" step="1" class="form-control"  name="fatalities" id="fatalities" value="<?php echo $_main_data->get_fatalities(); ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="injury_desc">Casualty Description:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" name="injury_desc" id="injury_desc"><?php echo $_main_data->get_injury_desc(); ?></textarea>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="label">Property Damage:</label>
                            <div class="col-sm-3">
                                <!--<?php echo $_main_data->get_property_damage(); ?>-->
                                <input type="text" class="form-control"  name="property_damage" id="property_damage" placeholder="0.0" value="<?php echo $_main_data->get_property_damage(); ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="details">Details:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" name="details" id="details"><?php echo $_main_data->get_details(); ?></textarea>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="public_details">Public Details:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" name="public_details" id="public_details"><?php echo $_main_data->get_public_details(); ?></textarea>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="status">Status:</label>
                            <div class="col-sm-10">
                                <!--Occupied: <?php echo $_main_data->get_status(); ?>-->
                            
                                <div>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="<?php echo STATUS_SELECT::S_PRIVATE; ?>" <?php if(!$_main_data->get_status()) echo ' checked ';?>>Private
                                    </label>
                                
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="<?php echo STATUS_SELECT::S_PUBLIC; ?>" <?php if($_main_data->get_status() == STATUS_SELECT::S_PUBLIC) echo ' checked ';?>>Public
                                    </label>
                                </div>
                            </div>
                        </div>
                    
                </fieldset>
                                        
                <hr />
                <div class="form-group">
                	<div class="col-sm-12">
                		<?php echo $obj_navigation_rec->get_markup_cmd_save_block(); ?>
                	</div>
                </div> 
                             
            </form>
            
            <?php echo $obj_navigation_main->get_markup_footer(); ?>
        </div><!--container-->        
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40196994-1', 'uky.edu');
  ga('send', 'pageview');
  
  $('.room_search').change(function(event){	
		options_update(event, null, '#room_code');	
	});
  
  $(document).ready(function(event){
    	$('[data-toggle="tooltip"]').tooltip();
			
		//options_update(event, null, '#building_code');
		options_update(event, null, '#room_code');
	
	});

</script>

</body>
</html>

<?php
	// Collect and output page markup.
	$page_obj->markup_from_cache();	
	$page_obj->output_markup();
?>