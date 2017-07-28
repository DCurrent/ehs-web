<?php 
	
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
	$access_obj->get_settings()->set_authenticate_url(APPLICATION_SETTINGS::DIRECTORY_PRIME);
	$access_obj->set_redirect($url_query->return_url());
	
	$access_obj->verify();	
	$access_obj->action();
	
	// Start page cache.
	$page_obj = new class_page_cache();
	ob_start();
	
	// Initialize our data objects. This is just in case there is no table
	// data for any of the navigation queries to find, we are making new
	// records, or copies of records. It also has the side effect of enabling 
	// IDE type hinting.
	$_main_data = new class_role_data();	
		
	// Ensure the main data ID member is same as navigation object ID.
	$_main_data->set_id($obj_navigation_rec->get_id());
			
	switch($obj_navigation_rec->get_action())
	{		
	
		default:		
		case RECORD_NAV_COMMANDS::NEW_BLANK:
		
			break;
			
		case RECORD_NAV_COMMANDS::NEW_COPY:			
			
			// Populate the object from post values.			
			$_main_data->populate_from_request();			
			break;
			
		case RECORD_NAV_COMMANDS::LISTING:
			
			// Direct to listing.				
			header('Location: role_list.php');
			break;
			
		case RECORD_NAV_COMMANDS::DELETE:						
			
			// Populate the object from post values.			
			$_main_data->populate_from_request();
				
			// Call and execute delete SP.
			$query->set_sql('{call role_delete(@id = ?)}');			
			
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
			$query->set_sql('{call role_update(@id = ?,														 
													@label = ?,
													@details = ?,																											 
													@log_update = ?, 
													@log_update_by = ?, 
													@log_update_ip = ?)}');
													
			$params = array(array($_main_data->get_id(), SQLSRV_PARAM_IN),
						array($_main_data->get_label(), SQLSRV_PARAM_IN),						
						array($_main_data->get_details(), SQLSRV_PARAM_IN),
						array(date(APPLICATION_SETTINGS::TIME_FORMAT), SQLSRV_PARAM_IN),
						array($access_obj->get_id(), SQLSRV_PARAM_IN),
						array($access_obj->get_ip(), SQLSRV_PARAM_IN));
			
			$query->set_params($params);			
			$query->query();
			
			// Repopulate main data object with results from merge query.
			$query->get_line_params()->set_class_name('class_role_data');
			$_main_data = $query->get_line_object();
			
						
			// Sub table: access.
			$_obj_data_sub_request = new class_role_access_data();
			$_obj_data_sub_request->populate_from_request();			
				
			// If the sub value id is an array, then we know there are 
			// values to update.
			if(is_array($_obj_data_sub_request->get_id()) === TRUE)
			{						
				// Call update stored procedure.
				$query->set_sql('{call role_sub_access_update(@fk_id = ?,														 
														@xml = ?,
														@log_update = ?,
														@log_update_by = ?,
														@log_update_ip = ?)}');
														
				$params = array(array($_main_data->get_id(), 			SQLSRV_PARAM_IN),
								array($_obj_data_sub_request->xml(), 	SQLSRV_PARAM_IN),
								array(date(APPLICATION_SETTINGS::TIME_FORMAT), 					SQLSRV_PARAM_IN),
								array($access_obj->get_id(),		SQLSRV_PARAM_IN),
								array($access_obj->get_ip(), 			SQLSRV_PARAM_IN));
				
				$query->set_params($params);			
							
				// Execute the merging query.
				$query->query();
			}		
			
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
	$query->set_sql('{call role(@id = ?,							
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
					
	$params = array(array($_main_data->get_id(), SQLSRV_PARAM_IN),
					array(NULL, 		SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_INT),
					array(NULL, 		SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_INT),
					array($nav_first,	SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_INT),
					array($nav_previous, SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_INT),
					array($nav_next, 	SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_INT),
					array($nav_last, 	SQLSRV_PARAM_OUT, SQLSRV_PHPTYPE_INT));

	$query->set_params($params);
	$query->query();
	
	$query->get_line_params()->set_class_name('class_role_data');
	
	if($query->get_row_exists() === TRUE) $_main_data = $query->get_line_object();
	
	// Sub table (access) generation
	$query->get_next_result();
	
	$query->get_line_params()->set_class_name('class_role_access_data');
	
	$_obj_data_sub_arr = array();
	if($query->get_row_exists() === TRUE) $_obj_data_sub_arr = $query->get_line_object_list();
		
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
        <title><?php echo APPLICATION_SETTINGS::NAME; ?>, Role Detail</title>        
        
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
    </head>
    
    <body>    
        <div id="container" class="container">            
            <?php echo $obj_navigation_main->get_markup_nav(); ?>                                                                                
            <div class="page-header">           
                <h1>Role Entry</h1>
                <p>This screen allows for adding and editing individual roles.</p>
            </div>
            
            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">           
           		<?php echo $obj_navigation_rec->get_markup(); ?>  
                
                <div class="form-group">
                	<label class="control-label col-sm-2" for="created">Created:</label>
                	<div class="col-sm-10">
                		<input 
                        	type	="text" 
                            class	="form-control"  
                            name	="created" 
                            id		="created" 
                            placeholder="Time record was created." readonly 
                            value="<?php if(is_object($_main_data->get_log_create())) echo date(APPLICATION_SETTINGS::TIME_FORMAT, $_main_data->get_log_create()->getTimestamp()); ?>">
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
                            value="<?php if(is_object($_main_data->get_log_update())) echo date(APPLICATION_SETTINGS::TIME_FORMAT, $_main_data->get_log_update()->getTimestamp()); ?>">
                	</div>
                </div>
                
                <div class="form-group">
                	<label class="control-label col-sm-2" for="label">Name:</label>
                	<div class="col-sm-10">
                		<input type="text" class="form-control"  name="label" id="label" placeholder="Role name/label" value="<?php echo $_main_data->get_label(); ?>" required>
                	</div>
                </div>
                
                <div class="form-group">
                	<label class="control-label col-sm-2" for="details">Details:</label>
                	<div class="col-sm-10">
                    	<textarea class="form-control" rows="5" name="details" id="details"><?php echo $_main_data->get_details(); ?></textarea>
                	</div>
                </div> 
                
                <div class="form-group">                    	
                        <div class="col-sm-offset-2 col-sm-10">
                        <fieldset>
                			<legend>Access</legend>                    
                            <p>Role access switches.</p>
                                                                                   
                            <table class="table table-striped table-hover" id="POITable"> 
                                <thead>
                                    <tr>
                                        <th colspan="2">Access</th> 
                                    </tr>
                                </thead>
                                <tfoot>
                                </tfoot>
                                <tbody class="ec">                        
                                    <?php                              
                                    if(is_object($_obj_data_sub_arr) === TRUE)
									{        
										// Generate table row for each item in list.
										for($_obj_data_sub_arr->rewind(); $_obj_data_sub_arr->valid(); $_obj_data_sub_arr->next())
										{						
											$_obj_data_sub = $_obj_data_sub_arr->current();
										
											// Blank IDs will cause a database error, so make sure there is a
											// usable one here.
											if(!$_obj_data_sub->get_id()) $_obj_data_sub->set_id(DB_DEFAULTS::NEW_ID);
										?>
											<tr>
												<td>                                                    	
													<input
                                                    	type    ="text"                                                        	 
														name	="sub_access_access[]" 
														id		="sub_access_access_<?php echo $_obj_data_sub->get_id(); ?>" 
														class	="form-control"
                                                        value	="<?php echo $_obj_data_sub->get_access(); ?>" />
												</td> 
																							  
												<td>													
													<input 
														type	="hidden" 
														name	="sub_access_id[]" 
														id		="sub_access_id_<?php echo $_obj_data_sub->get_id(); ?>" 
														value	="<?php echo $_obj_data_sub->get_id(); ?>" />
														
													<button 
														type	="button" 
														class 	="btn btn-danger btn-sm" 
														name	="row_add" 
														id		="row_del_<?php echo $_obj_data_sub->get_id(); ?>" 
														onclick="deleteRowsub(this)"><span class="glyphicon glyphicon-minus"></span></button>        
												</td>
											</tr>                                    
									<?php
										}
									}
                                    ?>                        
                                </tbody>                        
                            </table>                            
                            
                            <button 
                                type	="button" 
                                class 	="btn btn-success" 
                                name	="row_add" 
                                id		="row_add_perm"
                                title	="Add new item."
                                onclick	="insRow()">
                                <span class="glyphicon glyphicon-plus"></span></button>
                        </fieldset>
                        </div>                        
                    </div>
                    
                                        
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
  
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>

	<script>
		 var $temp_int = 0;
		 
		function deleteRowsub(row)
		{
			var i=row.parentNode.parentNode.rowIndex;
			document.getElementById('POITable').deleteRow(i);
		}
		
		// Inserts a new table row on user request.
		function insRow()
		{						
			$(".ec").append(
				'<tr>'
					+'<td>'
						+'<input type="text" name="sub_access_access[]" id="sub_access_access_'+ $temp_int + '" class="form-control" />'												
					+'</td>'					
					+'<td colspan="2">'
						+'<input type="hidden" name="sub_access_id[]" id="sub_access_id_js_'+$temp_int+'" value="<?php echo DB_DEFAULTS::NEW_ID; ?>" />'
						+'<button type="button" class ="btn btn-danger btn-sm" name="row_add" id="row_del_js_'+$temp_int+'" onclick="deleteRowsub(this)"><span class="glyphicon glyphicon-minus"></span></button>'						
					+'</td>'
				+'<tr>');
			
			tinymce.init({
            selector: '#sub_details_'+ $temp_int,
			plugins: [
				"advlist autolink lists link image charmap print preview anchor",
				"searchreplace visualblocks code fullscreen",
				"insertdatetime media table contextmenu paste"
			],
			toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"});
			
			$temp_int++;
		}		 
	</script>
</body>
</html>

<?php
	// Collect and output page markup.
	$page_obj->markup_from_cache();	
	$page_obj->output_markup();
?>