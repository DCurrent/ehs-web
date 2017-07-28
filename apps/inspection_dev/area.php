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
	$_main_data = new blair_class_area_data();	
		
	// Ensure the main data ID member is same as navigation object ID.
	$_main_data->set_code($obj_navigation_rec->get_id());
				
	// Populate main data. 
	$query->set_sql('{call area(@code = ?)}');	
						
	$params = array(array($_main_data->get_code(), SQLSRV_PARAM_IN));

	$query->set_params($params);
	$query->query();	
	
	// Query for primary data.	
	$query->get_line_params()->set_class_name('blair_class_area_data');
	
	if($query->get_row_exists() === TRUE) $_main_data = $query->get_line_object();
	
	// Populate sub table data
	// --Parties
	$query->get_next_result();
	
	$query->get_line_params()->set_class_name('blair_class_account_data');
	
	$_obj_data_sub_party_list = new SplDoublyLinkedList();
	if($query->get_row_exists()) $_obj_data_sub_party_list = $query->get_line_object_list();
	
	// -- Types
	$query->get_next_result();
	
	$query->get_line_params()->set_class_name('blair_class_common_data');
	$_obj_data_sub_type_list = new SplDoublyLinkedList();
	if($query->get_row_exists()) $_obj_data_sub_type_list = $query->get_line_object_list();
			
	// Command action handling.	
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
			header('Location: inspection_list.php');
			break;
			
		case RECORD_NAV_COMMANDS::DELETE:						
			
			// Populate the object from post values.			
			$_main_data->populate_from_request();
				
			// Call and execute delete SP.
			$query->set_sql('{call area_delete(@code = ?)}');			
			
			$query->set_params(array(array($_main_data->get_code(), SQLSRV_PARAM_IN)));
			$query->query();
			
			// Refrsh page to the previous record.				
			header('Location: '.$_SERVER['PHP_SELF']);			
				
			break;				
					
		case RECORD_NAV_COMMANDS::SAVE:
					
			// If this is set to false, data is not saved.
			$valid = TRUE;			
			
			// Stop errors in case someone tries a direct command link.
			if($obj_navigation_rec->get_command() != RECORD_NAV_COMMANDS::SAVE) break;
									
			// Save the record. Saving main record is straight forward. We’ll run the populate method on our 
			// main data object which will gather up post values. Then we can run a query to merge the values into 
			// database table. We’ll then get the id from saved record (since we are using a surrogate key, the ID
			// should remain static unless this is a brand new record). 
			
			// If necessary we will then save any sub records (see each for details).
			
			// Finally, we redirect to the current page using the freshly acquired id. That will ensure we have 
			// always an up to date ID for our forms and navigation system.			
		
			// Populate the object from post values.			
			$_main_data->populate_from_request();
			
			// Not used for accounts.
			//$_main_data_label = $_main_data->get_label(); 
		
			// Call update stored procedure.
			$query->set_sql('{call area_update(@id 					= ?, 
													@log_update_by	= ?, 
													@log_update_ip 	= ?,														 
													@label			= ?,
													@details		= ?)}');
													
			$params = array(array($_main_data->get_code(), 		SQLSRV_PARAM_IN),
						array($access_obj->get_id(), 		SQLSRV_PARAM_IN),
						array($access_obj->get_ip(), 			SQLSRV_PARAM_IN),
						array($_main_data->get_label(), 		SQLSRV_PARAM_IN),						
						array($_main_data->get_details(),		SQLSRV_PARAM_IN));
			
			$query->set_params($params);
			$query->query();
			
			// Repopulate main data object with results from merge query.
			$query->get_line_params()->set_class_name('blair_class_area_data');
			$_main_data = $query->get_line_object();
			
			// Now that save operation has completed, reload page using ID from
			// database. This ensures the ID is always up to date, even with a new
			// or copied record.
			header('Location: '.$_SERVER['PHP_SELF'].'?id='.$_main_data->get_id());
			
			break;			
	}
	
		
	// Populate main navigation with ID's from main data stored procedure.
	//$obj_navigation_rec->set_id_first($nav_first);
	//$obj_navigation_rec->set_id_previous($nav_previous);
	//$obj_navigation_rec->set_id_next($nav_next);
	//$obj_navigation_rec->set_id_last($nav_last);

	$obj_navigation_rec->generate_button_list();

	// List queries
		
		
?>

<!DOCtype html>
<html lang="en">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php echo APPLICATION_SETTINGS::NAME; ?>, Area Details</title>        
        
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
            selector: ".wysiwyg",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"});
        </script>
        
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
			
		</style>
        
    </head>
    
    <body>    
        <div id="container" class="container">            
            <?php echo $obj_navigation_main->get_markup_nav(); ?>                                                                                
            <div class="page-header">           
                <h1>Area Detail
                <?php if($_main_data->get_label()) echo ' - '.$_main_data->get_label(); ?></h1>
                <p>This view allows you to view and modify the details of an individual inspection.</p>
            </div>
                        
            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">           
           		<div class="form-group">
                	<div class="col-sm-12">
                		<?php echo $obj_navigation_rec->get_markup_cmd_save_block(); ?>
                	</div>
                </div>                
                
                <div class="form-group">       
                    <label class="control-label col-sm-2" for="last_update">Last Update:</label>
                    <div class="col-sm-10">
                        <p class="form-control-static"> <a href = "log_list.php&#63;id=<?php echo $_main_data->get_id();  ?>"
                                                            data-toggle	= ""
                                                            title		= "View log for this record."
                                                             target		= "_new" 
                            ><?php if(is_object($_main_data->get_log_update())) echo date(APPLICATION_SETTINGS::TIME_FORMAT, $_main_data->get_log_update()->getTimestamp()); ?></a></p>
                    </div>
                </div> 
                
                <div class="form-group">       
                    <label class="control-label col-sm-2" for="code">Barcode:</label>
                    <div class="col-sm-10">
                        <?php echo $_main_data->get_code(); ?>
                    </div>
                </div> 
                
                <div class="form-group">       
                    <label class="control-label col-sm-2" for="building">Building:</label>
                    <div class="col-sm-10">
                        <?php echo $_main_data->get_building_id().' - '.$_main_data->get_building_name(); ?>
                    </div>
                </div>
                                
                 <div class="form-group">       
                    <label class="control-label col-sm-2" for="floor">Floor:</label>
                    <div class="col-sm-10">
                        <?php echo trim($_main_data->get_floor()); ?>
                    </div>
                </div>
                
                <div class="form-group">       
                    <label class="control-label col-sm-2" for="room">Area/Room:</label>
                    <div class="col-sm-10">
                        <?php echo trim($_main_data->get_room_id()).' - '.$_main_data->get_use_description_short(); ?>
                    </div>
                </div> 
                
                <!--
                <div class="form-group">
                    <label class="control-label col-sm-2" for="room_use_definition">Definition:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" rows="3" name="room_use_definition" id="room_use_definition" disabled><?php //echo $_main_data->get_use_definition(); ?></textarea>
                    </div>
                </div>
                -->
                
                <div class="form-group">       
                    <label class="control-label col-sm-2" for="label">Label:</label>
                    <div class="col-sm-10">
                        <input 
                            type	="text" 
                            class	="form-control"  
                            name	="label" 
                            id		="label" 
                            placeholder="Room label." 
                            value="<?php echo trim($_main_data->get_label()); ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="details">Details:</label>
                    <div class="col-sm-10">
                        <textarea class="form-control wysiwyg" rows="2" name="details" id="details"><?php echo $_main_data->get_details(); ?></textarea>
                    </div>
                </div> 
                
                <div class="form-group">
                	<label class="control-label col-sm-2" for="details">Types:</label>
                    <div class="col-sm-10">
                        <ul class="checkbox">
                        <?php                              
                                if(is_object($_obj_data_sub_type_list) === TRUE)
                                {        
                                    // Generate table row for each item in list.
                                    for($_obj_data_sub_type_list->rewind(); $_obj_data_sub_type_list->valid(); $_obj_data_sub_type_list->next())
                                    {						
                                        $_obj_data_sub_type = $_obj_data_sub_type_list->current();
                                                               
                                    ?>
                                        <li>
                                            
                                            <input 
                                                type	= "checkbox" 
                                                id		= "chk_type_<?php echo $_obj_data_sub_type->get_id(); ?>"
                                                name	= "chk_type" 
                                                value	= "<?php echo $_obj_data_sub_type->get_id(); ?>" />
                                                <label 
                                                    class="radio-inline" 
                                                    for = "chk_type_<?php echo $_obj_data_sub_type->get_id(); ?>"><?php echo $_obj_data_sub_type->get_label(); ?></label>
                                        </li>                                   
                                <?php
                                    }
                                }
                                ?> 
                        </ul>
                    </div>
                </div> 
                
                          
            	                                
                    <table class="table table-striped table-hover" id="tbl_sub_party"> 
                		<caption>Responsible Parties</caption>
                        <thead>
                            <tr>
                                <th>Account</th>
                                <th>Name</th>
                                <th>&nbsp;</th>                            
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody id="tbody_party" class="parties">                        
                            <?php                              
                            if(is_object($_obj_data_sub_party_list) === TRUE)
                            {        
                                // Generate table row for each item in list.
                                for($_obj_data_sub_party_list->rewind(); $_obj_data_sub_party_list->valid(); $_obj_data_sub_party_list->next())
                                {						
                                    $_obj_data_sub_party = $_obj_data_sub_party_list->current();
                                                           
                                ?>
                                    <tr>
                                        <td> 
                                            <?php echo $_obj_data_sub_party->get_account(); ?>
                                        </td>
                                        <td>
                                        	<?php echo $_obj_data_sub_party->get_name_l().', '.$_obj_data_sub_party->get_name_f().' '.$_obj_data_sub_party->get_name_m(); ?>
                                        </td> 
                                        <td class="pull-right">
                                        	<a href 		= "account.php&#63;id=<?php echo $_obj_data_sub_party->get_id();  ?>"
                                                class		= "btn-sm btn-info btn-responsive account_detail" 
                                                data-toggle	= ""
                                                title		= "View account detail."
                                                target		= "_new" 
                                                ><span class="glyphicon glyphicon-eye-open"></span></a>
                                        </td>                                     
                                    </tr>                                    
                            <?php
                                }
                            }
                            ?>                        
                        </tbody>                        
                    </table>   
                
                <hr />
                
                
                <!--Save button-->
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
	</body>
</html>

<?php
	// Collect and output page markup.
	$page_obj->markup_from_cache();	
	$page_obj->output_markup();
?>