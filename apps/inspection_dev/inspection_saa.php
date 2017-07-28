<?php 
	
	require(__DIR__.'/source/main.php');
	
	// Page caching.
	$page_obj = new class_page_cache();
	ob_start();
	
	// Inspection type this page refers to.
	$inspection_type = 'a61f45cd-eb8a-49c2-bf63-62ce0f4f342c';
			
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
	$_main_data = new blair_class_common_inspection_data();	
		
	// Ensure the main data ID member is same as navigation object ID.
	$_main_data->set_id($obj_navigation_rec->get_id());
			
	// Populate main data. 
	$query->set_sql('{call inspection_saa(@id = ?,
								@inspection_type = ?,							
								@sort_field 	= ?,
								@sort_order 	= ?)}');	
					
	$params = array(array($_main_data->get_id(), SQLSRV_PARAM_IN),
					array($inspection_type, 	SQLSRV_PARAM_IN),
					array(NULL, 		SQLSRV_PARAM_IN),
					array(NULL, 		SQLSRV_PARAM_IN));

	$query->set_params($params);
	$query->query();
	
	// Query for navigation data and populate navigation object.
	$_obj_navigation = new class_db_navigation_data();
	
	$query->get_line_params()->set_class_name('class_db_navigation_data');	
	if($query->get_row_exists() === TRUE) $_obj_navigation = $query->get_line_object();
		
	$obj_navigation_rec->set_id_first($_obj_navigation->get_id_first());
	$obj_navigation_rec->set_id_previous($_obj_navigation->get_id_previous());
	$obj_navigation_rec->set_id_next($_obj_navigation->get_id_next());
	$obj_navigation_rec->set_id_last($_obj_navigation->get_id_last());
	
	$obj_navigation_rec->generate_button_list();
	
	// Query for primary data.
	$query->get_next_result();	
	$query->get_line_params()->set_class_name('blair_class_common_inspection_data');
	
	if($query->get_row_exists() === TRUE) $_main_data = $query->get_line_object();
	
	// Populate sub table data
	
	// --Parties
	$query->get_next_result();
	
	$query->get_line_params()->set_class_name('class_inspection_party_data');
	
	$_obj_data_sub_party_list = new SplDoublyLinkedList();
	if($query->get_row_exists()) $_obj_data_sub_party_list = $query->get_line_object_list();
	
	// --Visits
	$query->get_next_result();
	
	$query->get_line_params()->set_class_name('class_inspection_visit_data');
	
	$_obj_data_sub_visit_list = new SplDoublyLinkedList();
	if($query->get_row_exists()) $_obj_data_sub_visit_list = $query->get_line_object_list();

	// --Details
	$query->get_next_result();
	
	$query->get_line_params()->set_class_name('class_inspection_saa_detail_data');
	
	$_obj_data_sub_detail_list = new SplDoublyLinkedList();
	if($query->get_row_exists()) $_obj_data_sub_detail_list = $query->get_line_object_list();

			
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
			$query->set_sql('{call inspection_primary_delete(@id = ?)}');			
			
			$query->set_params(array(array($_main_data->get_id(), SQLSRV_PARAM_IN)));
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
			
			// Populate sub objects.
			$_obj_data_sub_request_party = new class_inspection_party_data();
			$_obj_data_sub_request_party->populate_from_request();
			
			$_obj_data_sub_request_visit = new class_inspection_visit_data();
			$_obj_data_sub_request_visit->populate_from_request();
			
			// Save building choice (if any)
			if($_main_data->get_building_code())
			{
				$_SESSION[SESSION_ID::LAST_BUILDING] = $_main_data->get_facility();
			}
			
			// Not used for accounts.
			//$_main_data_label = $_main_data->get_label(); 
		
			// Call update stored procedure.
			$query->set_sql('{call inspection_primary_update(@id 			= ?, 
													@update_by				= ?, 
													@update_ip 				= ?,														 
													@label					= ?,
													@details				= ?,	
													@status					= ?,
													@room_code				= ?,
													@inspection_type 		= ?,
													@sub_party_xml			= ?,
													@sub_visit_xml			= ?)}');
													
			$params = array(array($_main_data->get_id(), 			SQLSRV_PARAM_IN),
						array($access_obj->get_id(), 				SQLSRV_PARAM_IN),
						array($access_obj->get_ip(), 				SQLSRV_PARAM_IN),
						array($_main_data->get_label(), 			SQLSRV_PARAM_IN),						
						array($_main_data->get_details(),			SQLSRV_PARAM_IN),						
						array($_main_data->get_status(), 			SQLSRV_PARAM_IN),
						array($_main_data->get_room_code(), 		SQLSRV_PARAM_IN),
						array($_main_data->get_inspection_type(), 	SQLSRV_PARAM_IN),
						array($_obj_data_sub_request_party->xml(), 	SQLSRV_PARAM_IN),
						array($_obj_data_sub_request_visit->xml(), 	SQLSRV_PARAM_IN));
			
			
			// Did all data verify?
			if($valid === TRUE)
			{	
			
				var_dump($params);
					
				$query->set_params($params);			
				$query->query();
				
				// Repopulate main data object with results from merge query.
				$query->get_line_params()->set_class_name('blair_class_common_inspection_data');
				$_main_data = $query->get_line_object();
								
				// Sub table saving.
				
				// --detail
				$_obj_data_sub_request = new class_inspection_saa_detail_data();
				$_obj_data_sub_request->populate_from_request();
										
				// Call update stored procedure to process xml and update sub table.
				$query->set_sql('{call inspection_saa_detail_update(@fk_id = ?,														 
														@xml = ?)}');
														
				$params = array(array($_main_data->get_id(), 			SQLSRV_PARAM_IN),
								array($_obj_data_sub_request->xml(), 	SQLSRV_PARAM_IN));
				
				$query->set_params($params);			
				$query->query();
				
				// Now that save operation has completed, reload page using ID from
				// database. This ensures the ID is always up to date, even with a new
				// or copied record.
				header('Location: '.$_SERVER['PHP_SELF'].'?id='.$_main_data->get_id());					
			}
			
			break;			
	}
	
	// List queries
		// --Status
		$_obj_data_list_status_list = new blair_class_common_data();
	
		$query->set_sql('{call inspection_status_list_unpaged()}');
		$query->query();
		
		$query->get_line_params()->set_class_name('blair_class_common_data');
		
		$_obj_data_list_status_list = array();
		if($query->get_row_exists() === TRUE) $_obj_data_list_status_list = $query->get_line_object_list();
		
		// --Accounts
		$_obj_field_source_account_list = new blair_class_account_data();
	
		$query->set_sql('{call account_list_inspector()}');
		$query->query();
		
		$query->get_line_params()->set_class_name('blair_class_account_data');
		
		$_obj_field_source_account_list = array();
		if($query->get_row_exists() === TRUE) $_obj_field_source_account_list = $query->get_line_object_list();		
		
		// --Event type
		$_obj_data_list_event_type_list = new blair_class_common_data();
	
		$query->set_sql('{call event_type_list_unpaged()}');
		$query->query();
		
		$query->get_line_params()->set_class_name('blair_class_common_data');
		
		$_obj_data_list_event_type_list = array();
		if($query->get_row_exists() === TRUE) $_obj_data_list_event_type_list = $query->get_line_object_list();
			
		// Categories
		$query->set_sql('{call audit_question_category_list(@page_current 		= ?)}');											
		$page_last 	= NULL;
		$row_count 	= NULL;		
		
		$params = array(array(-1,			SQLSRV_PARAM_IN));

		$query->set_params($params);
		$query->query();
		
		$query->get_line_params()->set_class_name('blair_class_common_data');
		
		$_obj_field_source_category_list = new SplDoublyLinkedList();
		if($query->get_row_exists() === TRUE) $_obj_field_source_category_list = $query->get_line_object_list();
		
		// Generate a list for new record insert. List for existing records are generated per each
		// record loop to 'select' the current record value.
		$category_list_options = '<optgroup label="Groups"><option value="'.DB_DEFAULTS::NEW_GUID.'">All</option></optgroup><optgroup label="Categories">';
				
		for($_obj_field_source_category_list->rewind();	$_obj_field_source_category_list->valid(); $_obj_field_source_category_list->next())
		{	                                                               
			$_obj_field_source_category = $_obj_field_source_category_list->current();					
			
			$category_list_options .= '<option value="'.$_obj_field_source_category->get_id().'">'.$_obj_field_source_category->get_label().'</option>';					
		}
		
		$category_list_options .= '</optgroup>';
		
		
		
		//////////
		// Audit item query. Since we are constructing markup as we go, 
		// there's no getting around multiple executions, so we'll 
		// prepare the query here with bound parameters for
		// maximum speed and efficiency.
		
		// Bound parameters.
		$query_audit_items_params			= array();
		$query_audit_items_param_category 	= NULL;		
		
		// Set up a query object and send SQL string.
		$query_audit_items = new class_db_query($db);
		$query_audit_items->set_sql('{call inspection_question_list_select(@category 	= ?,
															@inclusion	= ?)}');
		
		// Set up bound parameters.
		$query_audit_items_params = array(array(&$query_audit_items_param_category, SQLSRV_PARAM_IN),
										array(&$inspection_type, SQLSRV_PARAM_IN));
		
		// Prepare query for execution.
		$query_audit_items->set_params($query_audit_items_params);
		$query_audit_items->prepare();
		
		
		// Generate a list for new record insert. List for existing records are generated per each
		// record loop to 'select' the current record value.
		$correction_list_options = '<option value="'.DB_DEFAULTS::NEW_GUID.'">Select Item</option>';
		
		// Interate through each category. At every loop we will set our bound 
		// category parameter and execute the item query.
		for($_obj_field_source_category_list->rewind();	$_obj_field_source_category_list->valid(); $_obj_field_source_category_list->next())
		{	                                                               
			$_obj_field_source_category = $_obj_field_source_category_list->current();					
			
			// Add current category to markup as an option group.
			$correction_list_options .= '<optgroup label="'.$_obj_field_source_category->get_label().'">';
			
			// Set bound parameter and execute prepared query. 
			$query_audit_items_param_category = $_obj_field_source_category->get_id();			
			$query_audit_items->execute();
			
			// Set class object we will push rows from datbase into.
			$query_audit_items->get_line_params()->set_class_name('blair_class_audit_question_data');
			
			// Establish linked list of objects and populate with rows assuming that 
			// rows were returned. 
			$_obj_data_list_saa_correction_list = new SplDoublyLinkedList();
			if($query_audit_items->get_row_exists() === TRUE) $_obj_data_list_saa_correction_list = $query_audit_items->get_line_object_list();
			
			// Now loop over all items returned from our prepared query execution.
			for($_obj_data_list_saa_correction_list->rewind();	$_obj_data_list_saa_correction_list->valid(); $_obj_data_list_saa_correction_list->next())
			{	                                                               
				$_obj_data_list_saa_correction = $_obj_data_list_saa_correction_list->current();					
				
				$correction_list_options .= '<option value="'.$_obj_data_list_saa_correction->get_id().'">'.$_obj_data_list_saa_correction->get_finding().'</option>';					
			}
			
			// Close the option group markup for this category.
			$correction_list_options .= '</optgroup>';
		}	
		
		
		//////////		
?>

<!DOCtype html>
<html lang="en">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php echo APPLICATION_SETTINGS::NAME; ?>, Inspection SAA</title>        
        
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
                <h1>Inspection SAA Entry<?php if($_main_data->get_label()) echo ' - '.$_main_data->get_label(); ?></h1>
                <p>This view allows you to view and modify the details of an individual inspection.</p>
            </div>
                        
            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">           
           		<?php echo $obj_navigation_rec->get_markup(); ?>                
                <?php require __DIR__.'/source/form_common_inspection.php'; ?>            
                
                <input type="hidden" name="inspection_type" id="inspection_type" value="<?php echo $inspection_type; ?>">
                                       
                <!--Details-->
                <div class="form-group">                    	
                    <div class="col-sm-offset-2 col-sm-10">
                        <fieldset>
                            <legend>Findings</legend>                                
                            <table class="table table-striped table-hover" id="tbl_sub_finding"> 
                                <thead>
                                    <tr>
                                        <th></th>                                                
                                        <th></th>                            
                                    </tr>
                                </thead>
                                <tfoot>
                                </tfoot>
                                <tbody class="tbody_finding">                        
                                    <?php                              
                                    if(is_object($_obj_data_sub_detail_list) === TRUE)
                                    {        
                                        // Generate table row for each item in list.
                                        for($_obj_data_sub_detail_list->rewind(); $_obj_data_sub_detail_list->valid(); $_obj_data_sub_detail_list->next())
                                        {						
                                            $_obj_data_sub_detail = $_obj_data_sub_detail_list->current();
                                        
                                            // Blank IDs will cause a database error, so make sure there is a
                                            // usable one here.
                                            if(!$_obj_data_sub_detail->get_id()) $_obj_data_sub_party->set_id(DB_DEFAULTS::NEW_ID);
                                            
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2" for="sub_saa_detail_area_<?php echo $_obj_data_sub_detail->get_id(); ?>">Category:</label>
                                                        <div class="col-sm-10">         
                                                            <!--Aera: <?php echo $_obj_data_sub_detail->get_area(); ?>-->
                                                                                                                    
                                                            <select
                                                                name 		= "sub_saa_detail_area[]"
                                                                id			= "sub_saa_detail_area_<?php echo $_obj_data_sub_detail->get_id(); ?>"
                                                                class		= "form-control"
                                                                onChange 	= "update_corrections(this)">
                                                                <?php																
                                                                if(is_object($_obj_field_source_category_list) === TRUE)
                                                                {        
                                                                    // Generate table row for each item in list.
                                                                    for($_obj_field_source_category_list->rewind();	$_obj_field_source_category_list->valid(); $_obj_field_source_category_list->next())
                                                                    {	                                                               
                                                                        $_obj_data_list_saa_area = $_obj_field_source_category_list->current();
                                                                                                                                                
                                                                        $sub_selected 	= NULL;
                                                                                
                                                                        if($_obj_data_sub_detail->get_area())
                                                                        {
                                                                            if($_obj_data_sub_detail->get_area() == $_obj_data_list_saa_area->get_id())
                                                                            {
                                                                                $sub_selected = ' selected ';
                                                                            }								
                                                                        }                                                                        
                                                                        
                                                                        ?>
                                                                        <option value="<?php echo $_obj_data_list_saa_area->get_id(); ?>" <?php echo $sub_selected; ?>><?php echo $_obj_data_list_saa_area->get_label(); ?></option>
                                                                        <?php                                
                                                                    }
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="form-group">
                                                        <label class="control-label col-sm-2" for="sub_saa_detail_correction_<?php echo $_obj_data_sub_detail->get_id(); ?>">Correction:</label>
                                                        <div class="col-sm-10"> 
                                                            <!--Correction: <?php echo $_obj_data_sub_detail->get_correction(); ?>-->
                                                            
                                                            <select
                                                                name 	= "sub_saa_detail_correction[]"
                                                                id		= "sub_saa_detail_correction_<?php echo $_obj_data_sub_detail->get_id(); ?>"
                                                                class	= "form-control update_source_sub_saa_detail_area_<?php echo $_obj_data_sub_detail->get_id(); ?>"
                                                                <?php if(!$_obj_data_sub_detail->get_correction()) echo 'disabled' ?> >
                                                                <?php
																
																// Only generate list if there is a correction to list
																if($_obj_data_sub_detail->get_correction())
																{															
																	if(is_object($_obj_data_list_saa_correction_list) === TRUE)
																	{        
																		// Generate table row for each item in list.
																		for($_obj_data_list_saa_correction_list->rewind();	$_obj_data_list_saa_correction_list->valid(); $_obj_data_list_saa_correction_list->next())
																		{	                                                               
																			$_obj_data_list_saa_correction = $_obj_data_list_saa_correction_list->current();
																																					
																			$sub_selected 	= NULL;
																			
																			if($_obj_data_sub_detail->get_correction())
																			{
																				if($_obj_data_sub_detail->get_correction() == $_obj_data_list_saa_correction->get_id())
																				{
																					$sub_selected = ' selected ';
																				}								
																			} 
																		   
																			?>
																			<option value="<?php echo $_obj_data_list_saa_correction->get_id(); ?>" <?php echo $sub_selected; ?>><?php echo $_obj_data_list_saa_correction->get_label(); ?></option>
																			<?php                                
																		}
																	}
																}
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>                                                        
                                                    
                                                    <div class="form-group collapse" id="div_sub_saa_detail_details_<?php echo $_obj_data_sub_detail->get_id(); ?>">
                                                        <label class="control-label col-sm-2" for="sub_saa_detail_details_<?php echo $_obj_data_sub_detail->get_id(); ?>">Comments:</label>
                                                        <div class="col-sm-10">
                                                            <textarea 
                                                                class="form-control" 
                                                                rows="5" 
                                                                name="sub_saa_detail_details[]" 
                                                                id="sub_saa_detail_details_<?php echo $_obj_data_sub_detail->get_id(); ?>"><?php echo $_obj_data_sub_detail->get_details(); ?></textarea>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group" id="div_sub_saa_detail_complete_<?php echo $_obj_data_sub_detail->get_id(); ?>">
                                                        <label class="control-label col-sm-2" for="div_sub_saa_detail_complete_<?php echo $_obj_data_sub_detail->get_id(); ?>">Completed:</label>
                                                        <div class="col-sm-10">
                                                        	<label class="radio-inline">
                                                            <input type="radio" 
                                                            	name="div_sub_saa_detail_complete[]"
                                                                id="div_sub_saa_detail_complete_0_<?php echo $_obj_data_sub_detail->get_id(); ?>" disabled>No</label>
															<label class="radio-inline"><input type="radio" 
                                                            	name="div_sub_saa_detail_complete[]"
                                                                id="div_sub_saa_detail_complete_1_<?php echo $_obj_data_sub_detail->get_id(); ?>" disabled>Yes</label>
                                                           
                                                        </div>
                                                    </div>
                                                   
                                                    
                                                    
                                                </td>
                                                                                       
                                                <td>													
                                                    <input 
                                                        type	="hidden" 
                                                        name	="sub_saa_detail_id[]" 
                                                        id		="sub_saa_detail_id_<?php echo $_obj_data_sub_detail->get_id(); ?>" 
                                                        value	="<?php echo $_obj_data_sub_detail->get_id(); ?>" />
                                                </td>       
                                                <td>
                                                    <?php
                                                        $btn_type 	= 'btn-primary';
                                                        $btn_title	= 'Show or hide comments.';
                                                        
                                                        if($_obj_data_sub_detail->get_details())
                                                        {
                                                            $btn_type = 'btn-warning';	
                                                            $btn_title	= 'This row has comments. Click to show or hide.';	
                                                        }
                                                                                                                    
                                                    ?>
                                                    
                                                    <a  class		= "btn <?php echo $btn_type; ?>  btn-sm"                                                           
                                                        type		= "button"
                                                        data-toggle	= "collapse" 
                                                        title		= "<?php echo $btn_title; ?>"
                                                        data-target	= "#div_sub_saa_detail_details_<?php echo $_obj_data_sub_detail->get_id(); ?>"><span class="glyphicon glyphicon-pencil"></span></a>
                                                    
                                                </td>
                                                
                                                <td>   
                                                    <button 
                                                        type	="button" 
                                                        class 	="btn btn-danger btn-sm" 
                                                        name	="sub_saa_detail_row_del" 
                                                        id		="sub_saa_detail_row_del_<?php echo $_obj_data_sub_detail->get_id(); ?>" 
                                                        title	="Remove this item."
                                                        onclick="deleteRow_sub_finding(this)"><span class="glyphicon glyphicon-minus"></span></button> 
                                                            
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
                                id		="row_add_detail"
                                title	="Add new item."
                                onclick	="insRow_finding()">
                                <span class="glyphicon glyphicon-plus"></span></button>
                        </fieldset>
                    </div>                        
                </div>
                <!--/Details-->
                
                <hr />
                <?php echo $obj_navigation_rec->get_markup(); ?>
                
                <!--Save button
                <div class="form-group">
                	<div class="col-sm-12">
                		<?php echo $obj_navigation_rec->get_markup_cmd_save_block(); ?>
                	</div>
                </div> -->              
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
        
            var $temp_finding = 0;
            
            function deleteRow_sub_finding(row)
            {
                var i=row.parentNode.parentNode.rowIndex;
                document.getElementById('tbl_sub_finding').deleteRow(i);
            }
            
            function insRow_finding()
            {	
                
                $('.tbody_finding').append(
                    '<tr>'
                        +'<td>'
                            +'<div class="form-group">'
                                +'<label class="control-label col-sm-2" for="sub_saa_detail_area_'+$temp_finding+'">Category:</label>'
                                +'<div class="col-sm-10">'
                                                                                            
                                    +'<select '
                                        +'name 		= "sub_saa_detail_area[]" '
                                        +'id		= "sub_saa_detail_area_'+$temp_finding+'" '
                                        +'class		= "form-control" '
                                        +'onChange 	= "update_corrections(this)"> '
                                        +'<?php echo $category_list_options; ?> '
                                    +'</select>'
                                +'</div>'
                            +'</div>'
                        
                            +'<div class="form-group"> '
                                +'<label class="control-label col-sm-2" for="sub_saa_detail_correction_'+$temp_finding+'">Correction:</label> '
                                +'<div class="col-sm-10">'								
                                    
                                    +'<select '
                                        +'name 	= "sub_saa_detail_correction[]" '
                                        +'id	= "sub_saa_detail_correction_'+$temp_finding+'" '
                                        +'class	= "form-control update_source_sub_saa_detail_area_'+$temp_finding+'"> '
                                        
                                        +'<?php echo $correction_list_options; ?>'                                        
                                    +'</select>'
                                +'</div>'
                            +'</div>'                                                        
                            
                            +'<div class="form-group collapse" id="div_sub_saa_detail_details_'+$temp_finding+'">'
                                +'<label class="control-label col-sm-2" for="sub_saa_detail_details_'+$temp_finding+'">Comments:</label>'
                                +'<div class="col-sm-10">'
                                    +'<textarea ' 
                                        +'class	= "form-control" ' 
                                        +'rows 	= "5" ' 
                                        +'name	= "sub_saa_detail_details[]" ' 
                                        +'id	= "sub_saa_detail_details_'+$temp_finding+'"></textarea>'
                                +'</div>'
                            +'</div>'
							
							+'<div class="form-group"> '
								+'<label class="control-label col-sm-2" for="div_sub_saa_detail_complete_'+$temp_finding+'">Completed:</label>'
								+'<div class="col-sm-10">'									
									+'<label class="radio-inline">'
									+'<input type="radio" ' 
										+'name="div_sub_saa_detail_complete[]" '
										+'id="div_sub_saa_detail_complete_0_'+$temp_finding+'" disabled>No</label>'
									+'<label class="radio-inline"><input type="radio" ' 
										+'name="div_sub_saa_detail_complete[]" '
										+'id="div_sub_saa_detail_complete_1_'+$temp_finding+'" disabled>Yes</label>'
								   
								+'</div>'
                            +'</div>'
                        +'</td>'
                                                               
                        +'<td>'													
                            +'<input ' 
                                +'type	= "hidden" ' 
                                +'name	= "sub_saa_detail_id[]" ' 
                                +'id	= "sub_saa_detail_id_'+$temp_finding+'" ' 
                                +'value	= "<?php echo DB_DEFAULTS::NEW_GUID; ?>" /> '
                        +'</td>'
                        +'<td>'
                            +'<a class		= "btn btn-primary btn-sm" '                                                           
                            +'type			= "button" '
                            +'data-toggle	= "collapse" ' 
                            +'title			= "Show or hide comments." '
                            +'data-target	= "#div_sub_saa_detail_details_'+$temp_finding+'"><span class="glyphicon glyphicon-pencil"></span></a>'
                        +'</td>'
                        +'<td>'
                            +'<button ' 
                                +'type	= "button" ' 
                                +'class = "btn btn-danger btn-sm" ' 
                                +'name	= "sub_saa_detail_row_del" ' 
                                +'id	= "sub_saa_detail_row_del_'+$temp_finding+'" ' 
                                +'onclick = "deleteRow_sub_finding(this)"><span class="glyphicon glyphicon-minus"></span></button>'       
                        +'</td>'
                    +'</tr>'			
                );
                
                tinymce.init({
                selector: '#sub_saa_detail_details_'+$temp_finding,
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"});
        
                
                $temp_finding--;
            }
            
            // Update correction list items based on category selection.
            function update_corrections($val)
            {
                var $update_select_id = ".update_source_" + $($val).attr('id');	
				           
                // Get element by css seelctor - this returns a list.
                var $target = document.querySelectorAll($update_select_id);
        
                // Iterate list and update al elements (In most cases, there will
                // only be one).
                for (var i = 0; i < $($target).length; i++) 
                {
                    $($target).attr('disabled', false);
                    $($target).load('<?php echo APPLICATION_SETTINGS::DIRECTORY_PRIME; ?>/inspection_saa_corrections_list.php?category=' + $($val).val() + '&inclusion=<?php echo $inspection_type; ?>');
                }			
            }
                     
        </script>
	</body>
</html>

<?php
	// Collect and output page markup.
	$page_obj->markup_from_cache();	
	$page_obj->output_markup();
?>