<?php 
		
	require(__DIR__.'/source/main.php');
	
	class class_filter
	{
		private			
			$update_f	= NULL,
			$update_t 	= NULL,
			$status		= NULL,
			$inspector	= NULL,
			$building	= NULL;
		
		// Populate members from $_REQUEST.
		public function populate_from_request()
		{		
			// Interate through each class method.
			foreach(get_class_methods($this) as $method) 
			{		
				$key = str_replace('set_', '', $method);
							
				// If there is a request var with key matching
				// current method name, then the current method 
				// is a set mutator for this request var. Run 
				// it (the set method) with the request var. 
				if(isset($_GET[$key]))
				{					
					$this->$method($_GET[$key]);					
				}
			}
		}
		
		private function validateDate($date, $format = 'Y-m-d')
		{
			$d = DateTime::createFromFormat($format, $date);
			return $d && $d->format($format) == $date;
		}
		
		public function get_update_f()
		{
			return $this->update_f;
		}
		
		public function get_update_t()
		{
			return $this->update_t;
		}
		
		public function get_inspector_f()
		{
			return $this->inspector;
		}
		
		public function get_status()
		{
			return $this->status;
		}
		
		public function get_building()
		{
			return $this->building;
		}
		
		public function set_update_f($value)
		{
			if($this->validateDate($value) === TRUE)
			{
				$this->update_f = $value;
			}
		}
		
		public function set_update_t($value)
		{
			if($this->validateDate($value) === TRUE)
			{
				$this->update_t = $value;
			}
		}
		
		public function set_inspector_f($value)
		{
			if(!$value)
			{
				$value = array('00000000-0000-0000-0000-000000000000');
			}
			
			$this->inspector = $value;
		}
		
		public function set_status($value)
		{		
			$this->status = $value;			
		}
		
		public function set_building($value)
		{
			$this->building = $value;
		}
	}
		
	
	// Prepare redirect url with variables.
	$url_query	= new url_query;
		
	// User access.
	$access_obj = new class_access_status();
	$access_obj->get_settings()->set_authenticate_url(APPLICATION_SETTINGS::DIRECTORY_PRIME);
	$access_obj->set_redirect($url_query->return_url());
	
	$access_obj->verify();	
	$access_obj->action();
	
	// Start page cache.
	$page_obj = new class_page_cache();
	ob_start();
		
	// Set up navigaiton.
	$navigation_obj = new class_navigation();
	$navigation_obj->generate_markup_nav();
	$navigation_obj->generate_markup_footer();	
	
	// Set up database.
	$db_conn_set = new class_db_connect_params();
	$db_conn_set->set_name(DATABASE::NAME);
	
	$db = new class_db_connection($db_conn_set);
	$query = new class_db_query($db);
	
	// Let's get the current account ID. We'll need to query
	// using the account name logged in.
	
	$query->set_sql('{call account_lookup(@account	= ?)}');
	
	$paging = new class_paging();
	$paging->set_row_max(APPLICATION_SETTINGS::PAGE_ROW_MAX);	
	
	$params = array(array($access_obj->get_account(), SQLSRV_PARAM_IN));

	

	$query->set_params($params);
	$query->query();
	
	$query->get_line_params()->set_class_name('blair_class_account_data');
	$_obj_data_account = $query->get_line_object();
	
	//echo $access_obj->get_account();
	//echo $_obj_data_account->get_id();
	
	// Establish sorting object, set defaults, and then get settings
	// from user (if any).
	$sorting = new class_sort_control;
	$sorting->set_sort_field(6);
	$sorting->set_sort_order(SORTING_ORDER_TYPE::DECENDING);
	$sorting->populate_from_request();
	
	$filter = new class_filter();
	$filter->populate_from_request();
	
	$query->set_sql('{call inspection_list(@page_current 	= ?,														 
										@page_rows 			= ?,										
										@inspector			= ?,
										@update_from		= ?,
										@update_to			= ?,
										@status				= ?,
										@building			= ?,
										@sort_field 		= ?,
										@sort_order 		= ?)}');
											
	$page_last 	= NULL;
	$row_count 	= NULL;		
	
	$sort_field 		= $sorting->get_sort_field();
	$sort_order 		= $sorting->get_sort_order();
	
	// In case there is no account selected, default to account logged in.
	$filter_account_argument	= $filter->get_inspector_f();
	$filter_account_string		= '';
		
	if(is_array($filter_account_argument) === FALSE)
	{
		$filter_account_argument = array($_obj_data_account->get_id());
	}
	
	// Let's break down the array filters before sending them to database.
	$filter_account_string = implode(",", $filter_account_argument);
	
	echo '<!--filter_account_string: '.$filter_account_string.'-->';
	
	
	$params = array(array($paging->get_page_current(), 	SQLSRV_PARAM_IN), 
					array($paging->get_row_max(), 		SQLSRV_PARAM_IN), 
					array($filter_account_string, 		SQLSRV_PARAM_IN),
					array($filter->get_update_f(),		SQLSRV_PARAM_IN),
					array($filter->get_update_t(),		SQLSRV_PARAM_IN),
					array(NULL,		SQLSRV_PARAM_IN),//array($filter->get_status(),		SQLSRV_PARAM_IN),
					array($filter->get_building(),		SQLSRV_PARAM_IN),
					array($sort_field,					SQLSRV_PARAM_IN),
					array($sort_order,					SQLSRV_PARAM_IN));

	//var_dump($params);

	

	$query->set_params($params);
	$query->query();	
	$query->get_line_params()->set_class_name('blair_class_common_inspection_data');
	$_obj_data_main_list = $query->get_line_object_list();
	
	// --Paging
	$query->get_next_result();
	
	$query->get_line_params()->set_class_name('class_paging');
	if($query->get_row_exists()) $paging = $query->get_line_object();
	
	// Datalist list generation.
		// Status
		$_obj_data_list_status = NULL;
		
		$query->set_sql('{call inspection_status_list_unpaged}');
			
		$query->query();
		$query->get_line_params()->set_class_name('blair_class_common_inspection_data');
		
		//$_obj_data_list_status_list = new blair_class_common_inspection_data();
		$_obj_data_list_status_list = $query->get_line_object_list();
	
		// Accounts (Inspectors)
		$_obj_field_source_account_list = new blair_class_account_data();
	
		$query->set_sql('{call account_list_inspector()}');
		$query->query();		
		
		$query->get_line_params()->set_class_name('blair_class_account_data');
		
		$_obj_field_source_account_list = array();
		if($query->get_row_exists() === TRUE) $_obj_field_source_account_list = $query->get_line_object_list();
		
		// Buildings
		$_obj_field_source_building_list = new blair_class_area_data();
	
		$query->set_sql('{call building_list()}');
		$query->query();
		
		$query->get_line_params()->set_class_name('blair_class_area_data');
		
		$_obj_field_source_building_list = array();
		if($query->get_row_exists() === TRUE) $_obj_field_source_building_list = $query->get_line_object_list();
?>

<!DOCtype html>
<html lang="en">
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" />
        <title><?php echo APPLICATION_SETTINGS::NAME; ?></title>        
        
         <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="source/css/style.css" />
        <link rel="stylesheet" href="source/css/print.css" media="print" />
        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        
        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </head>
    
    <body>    
        <div id="container" class="container">            
            <?php echo $navigation_obj->get_markup_nav(); ?>                                                                                
            <div class="page-header">
                <h1>Inspections</h1>
                <p>This is a list of inspections in the database.</p>
            </div>
            
            <div id="filters">
            
	        <legend>Filters <a type="button" class="btn" data-toggle="collapse" data-target="#filter">(Show/Hide)</a></legend>
            <form class="form-horizontal collapse" role="form" id="filter" method="get" enctype="multipart/form-data">
            	                
                <input type="hidden" name="field" value="<?php echo $sorting->get_sort_field(); ?>" />
                <input type="hidden" name="order" value="<?php echo $sorting->get_sort_order(); ?>" />
                
                
                <!--Details-->
                <div class="form-group">                  
                    <label class="control-label col-sm-2" for="inspector_f_0">Inspectors</label>
                    <div class="col-sm-10">                              
                        <select
                            name 	= "inspector_f[]"
                            id		= "inspector_f_0"
                            class	= "form-control">
                            <optgroup label="Groups">                            
                                <option value="<?php echo DB_DEFAULTS::NEW_GUID; ?>" <?php if($filter->get_inspector_f() == DB_DEFAULTS::NEW_GUID) echo ' selected ' ?>>All</option>
                            </optgroup>
                            <optgroup label="Inspectors">
                                <?php
                                if(is_object($_obj_field_source_account_list) === TRUE)
                                {        
                                    // Generate table row for each item in list.
                                    for($_obj_field_source_account_list->rewind();	$_obj_field_source_account_list->valid(); $_obj_field_source_account_list->next())
                                    {	                                                               
                                        $_obj_field_source_account = $_obj_field_source_account_list->current();
                                        
                                        $sub_account_value 		= $_obj_field_source_account->get_id();																
                                        $sub_account_label		= $_obj_field_source_account->get_name_l().', '.$_obj_field_source_account->get_name_f();
                                        $sub_account_selected 	= NULL;
                                                
                                        if($filter->get_inspector_f())
                                        {
                                            if($filter->get_inspector_f() == $sub_account_value)
                                            {
                                                $sub_account_selected = ' selected ';
                                            }								
                                        }
                                        else
                                        {
                                            if($_obj_data_account->get_id() == $sub_account_value)
                                            {
                                                $sub_account_selected = ' selected ';
                                            }
                                        }
                                        
                                        ?>
                                        <option value="<?php echo $sub_account_value; ?>" <?php echo $sub_account_selected ?>><?php echo $sub_account_label; ?></option>
                                        <?php                                
                                    }
                                }
                                ?>
                            </optgroup>                        	
                        </select>
                    </div>                        
                </div>
                <!--/Details-->
            
            	<div class="form-group">
                    <label class="control-label col-sm-2" for="building">Building</label>
                    <div class="col-sm-10">
                        <select name="building" 
                            id="building" 
                            data-current="<?php echo $filter->get_building(); ?>" 
                            data-source-url="../../libraries/inserts/facility.php" 
                            data-extra-options='<option value="0">All Buildings</option>'
                            data-grouped="1"
                            class="room_search form-control">
                            <optgroup label="Groups">                            
                            	<option value="-1" <?php if($filter->get_building() == '-1') echo ' selected ' ?>>All</option>
                            </optgroup>
                            <optgroup label="Buildings">
                                <?php
                                if(is_object($_obj_field_source_account_list) === TRUE)
                                {        
                                    // Generate table row for each item in list.
                                    for($_obj_field_source_building_list->rewind();	$_obj_field_source_building_list->valid(); $_obj_field_source_building_list->next())
                                    {	                                                               
                                        $_obj_field_source_building = $_obj_field_source_building_list->current();
                                        
                                        $sub_building_id 		= $_obj_field_source_building->get_building_id();																
                                        $sub_building_name		= $_obj_field_source_building->get_building_name();
                                        $sub_building_selected 	= NULL;
                                                
                                        if($filter->get_building())
                                        {
                                            if($filter->get_building() == $sub_building_id)
                                            {
                                                $sub_building_selected = ' selected ';
                                            }								
                                        }
                                        
                                        ?>
                                        <option value="<?php echo $sub_building_id; ?>" <?php echo $sub_building_selected; ?>><?php echo $sub_building_id .' - '.$sub_building_name; ?></option>
                                        <?php                                
                                    }
                                }
                                ?>
                        	</optgroup>                                 
                        </select>
                    </div>                
                </div>
                
                <div class="form-group">
                	<label class="control-label col-sm-2" for="created">Updated (from):</label>
                	<div class="col-sm-4">
                		<input 
                        	type	="datetime-local" 
                            class	="form-control"  
                            name	="update_f" 
                            id		="update_f" 
                            placeholder="yyyy-mm-dd"
                            value="<?php echo $filter->get_update_f(); ?>">
                	</div>
                
                	<label class="control-label col-sm-2" for="created">Updated (to):</label>
                	<div class="col-sm-4">
                		<input 
                        	type	="datetime-local" 
                            class	="form-control"  
                            name	="update_t" 
                            id		="update_t" 
                            placeholder="yyyy-mm-dd"
                            value="<?php echo $filter->get_update_t(); ?>">
                	</div>
                </div>
                
                <div class="form-group">
                	<label class="control-label col-sm-2" for="status">Status:</label>
                	<div class="col-sm-10">
                    	<?php
                    	if(is_object($_obj_data_list_status_list) === TRUE)
						{
							for($_obj_data_list_status_list->rewind(); $_obj_data_list_status_list->valid(); $_obj_data_list_status_list->next())
							{						
								$_obj_data_list_status = $_obj_data_list_status_list->current();							
						?>                           
                       		<div class="radio">
                            
                            	<label><input 
                                        type="radio" 
                                        name="status" 
                                        value="<?php echo $_obj_data_list_status->get_id(); ?>"                                             
                                        <?php if($filter->get_status() == $_obj_data_list_status->get_id()) echo ' checked ';?>><?php echo $_obj_data_list_status->get_label(); ?></label>
                       	 	</div>
                       
                        <?php
							}
                        }
                    	?>     
                        		
                            <div class="radio">
                        
                           		<label><input 
                                        type="radio" 
                                        name="status" 
                                        value=""                                             
                                        <?php if($filter->get_status() == NULL) echo ' checked ';?>>All</label>
                       	 	</div>                   
                	</div>
				</div>
                
                <button 
                                type	="submit"
                                class 	="btn btn-primary btn-block" 
                                name	="set_filter" 
                                id		="set_filter"
                                title	="Apply selected filters to list."
                                >
                                <span class="glyphicon glyphicon-filter"></span>Apply Filters</button>       
                    
            </form>
            
            </div>
            
            <br />
            
            <a href="inspection_autoclave.php&#63;nav_command=<?php echo RECORD_NAV_COMMANDS::NEW_BLANK;?>&amp;id=<?php echo DB_DEFAULTS::NEW_GUID; ?>" class="btn btn-success" title="Click here to start entering a new inspection."><span class="glyphicon glyphicon-plus"></span> Autoclave</a>
            
            <a href="inspection_saa.php&#63;nav_command=<?php echo RECORD_NAV_COMMANDS::NEW_BLANK;?>&amp;id=<?php echo DB_DEFAULTS::NEW_GUID; ?>" class="btn btn-success" title="Click here to start entering a new inspection."><span class="glyphicon glyphicon-plus"></span> SAA</a>
          
            <!--div class="table-responsive"-->
                <table class="table table-striped table-hover">
                    <caption></caption>
                    <thead>
                        <tr>
                            <th><a href="<?php echo $sorting->sort_url(1); ?>">Label <?php echo $sorting->sorting_markup(1); ?></a></th>                            
                            <th><a href="<?php echo $sorting->sort_url(2); ?>">Building <?php echo $sorting->sorting_markup(2); ?></a></th>
                            <th><a href="<?php echo $sorting->sort_url(3); ?>">Room <?php echo $sorting->sorting_markup(3); ?></a></th>
                            <th><a href="<?php echo $sorting->sort_url(4); ?>">Status <?php echo $sorting->sorting_markup(4); ?></a></th>
                            <th><a href="<?php echo $sorting->sort_url(7); ?>">Type <?php echo $sorting->sorting_markup(7); ?></a></th>
                            <th><a href="<?php echo $sorting->sort_url(6); ?>">Last Update <?php echo $sorting->sorting_markup(6); ?></a></th>                            
                            <th><!--Action--></th>
                        </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                    <tbody>                        
                        <?php
							// For looking up names from active directory.
							$account_lookup = new class_access_lookup();
							
                            if(is_object($_obj_data_main_list) === TRUE)
							{
								for($_obj_data_main_list->rewind(); $_obj_data_main_list->valid(); $_obj_data_main_list->next())
								{	
									$_obj_data_main = new blair_class_common_inspection_data();
													
									$_obj_data_main = $_obj_data_main_list->current();
																	
									// Update lookup object with current account.
									$account_lookup->lookup($_obj_data_main->get_account());
                            ?>
                                        <tr>
                                            <td><?php echo $_obj_data_main->get_label(); ?></td>
                                            <td><?php echo $_obj_data_main->get_building_name(); ?></td>
                                            <td><?php echo $_obj_data_main->get_room_id(); ?></td>                                            
                                            <td><?php echo $_obj_data_main->get_status_label(); ?></td>
                                            <td><?php echo $_obj_data_main->get_inspection_type_label(); ?></td>
                                            
                                    <td><?php if(is_object($_obj_data_main->get_log_update()) === TRUE) echo date(APPLICATION_SETTINGS::TIME_FORMAT, $_obj_data_main->get_log_update()->getTimestamp()); ?></td>
                                            <td>                                            
                                            <?php
												echo '<!--Inspection Type: '.$_obj_data_main->get_inspection_type().'-->';
												$detail_url = NULL;
											
												// SAA
												if($_obj_data_main->get_inspection_type() == 'a61f45cd-eb8a-49c2-bf63-62ce0f4f342c')
												{
													$detail_url = 'inspection_saa.php&#63;id='.$_obj_data_main->get_id();
												}		
											
												echo '<!--Detail Url: '.$detail_url.'-->';
											
											?>                                            
                                            <a	href	="<?php echo $detail_url; ?>" 
                                            class		="btn btn-info"
                                            title		="View details or edit this item."
                                            ><span class="glyphicon glyphicon-eye-open"></span></a></td>
                                        </tr>                                    
                            <?php								
                            	}
							}
                        ?>
                    </tbody>                        
                </table>  
            <?php 
				echo $paging->generate_paging_markup();
				echo $navigation_obj->get_markup_footer(); 
			?>
        </div><!--container-->        
        
        
 
 
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40196994-1', 'uky.edu');
  ga('send', 'pageview');
  
  $(document).ready(function(event){
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