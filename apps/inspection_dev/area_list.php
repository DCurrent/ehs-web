<?php 
		
	require(__DIR__.'/source/main.php');
	
	class class_filter
	{
		private
			$create_f	= NULL,
			$create_t	= NULL,
			$update_f	= NULL,
			$update_t 	= NULL,
			$building	= NULL,
			$floor		= NULL,
			$room_id	= NULL;
		
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
		
		public function get_building()
		{
			return $this->building;
		}
		
		public function get_floor()
		{
			return $this->floor;
		}
		
		public function get_room_id()
		{
			return $this->room_id;
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
		
		public function set_building($value)
		{
			$this->building = $value;
		}
		
		public function set_floor($value)
		{
			$this->floor = $value;
		}
		
		public function set_room_id($value)
		{
			$this->room_id = $value;
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
	
	// Establish sorting object, set defaults, and then get settings
	// from user (if any).
	$sorting = new class_sort_control;
	$sorting->set_sort_field(2);
	$sorting->set_sort_order(SORTING_ORDER_TYPE::ASCENDING);
	$sorting->populate_from_request();
	
	$filter = new class_filter();
	$filter->populate_from_request();
	
	$paging = new class_paging();
	$paging->set_row_max(APPLICATION_SETTINGS::PAGE_ROW_MAX);
	
	$query->set_sql('{call area_list(@page_current 	= ?,														 
										@page_rows 			= ?,										
										@update_from		= ?,
										@update_to			= ?,
										@building			= ?,
										@floor				= ?,
										@room_id			= ?,
										@sort_field 		= ?,
										@sort_order 		= ?)}');
	
	$sort_field 		= $sorting->get_sort_field();
	$sort_order 		= $sorting->get_sort_order();
	
	$params = array(array($paging->get_page_current(), 	SQLSRV_PARAM_IN), 
					array($paging->get_row_max(), 		SQLSRV_PARAM_IN),					
					array($filter->get_update_f(),		SQLSRV_PARAM_IN),
					array($filter->get_update_t(),		SQLSRV_PARAM_IN),
					array($filter->get_building(),		SQLSRV_PARAM_IN),
					array($filter->get_floor(),			SQLSRV_PARAM_IN),
					array($filter->get_room_id(),		SQLSRV_PARAM_IN),
					array($sort_field,					SQLSRV_PARAM_IN),
					array($sort_order,					SQLSRV_PARAM_IN));
	
	$query->set_params($params);
	$query->query();	

	// Main data.
	$query->get_line_params()->set_class_name('blair_class_area_data');
	$_obj_data_main_list = $query->get_line_object_list();
	
	// --Paging
	$query->get_next_result();
	
	$query->get_line_params()->set_class_name('class_paging');
	
	//$_obj_data_paging = new class_paging();
	if($query->get_row_exists()) $paging = $query->get_line_object();
	
	// Datalist list generation.
		
		// Buildings
		$_obj_field_source_building_list = new blair_class_area_data();
	
		$query->set_sql('{call building_list(@page_current = ?)}');
		$query->query(array(-1));
		
		$query->get_line_params()->set_class_name('blair_class_area_data');
		
		$_obj_field_source_building_list = new SplDoublyLinkedList();
		if($query->get_row_exists() === TRUE) $_obj_field_source_building_list = $query->get_line_object_list();
		
		// Floors
		$_obj_field_source_floor_list = new blair_class_area_data();
	
		$query->set_sql('{call floor_list()}');
		$query->query();
		
		$query->get_line_params()->set_class_name('blair_class_area_data');
		
		$_obj_field_source_floor_list = new SplDoublyLinkedList();
		if($query->get_row_exists() === TRUE) $_obj_field_source_floor_list = $query->get_line_object_list();
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
                <h1>Areas</h1>
                <p>This is a list of areas pre-entered or currently in use by Inspector Blair.</p>
            </div>
            
            <div id="filters">
            
	        <legend>Filters <a type="button" class="btn" data-toggle="collapse" data-target="#filter">(Show/Hide)</a></legend>
            <form class="form-horizontal collapse" role="form" id="filter" method="get" enctype="multipart/form-data">
            	                
                <input type="hidden" name="field" value="<?php echo $sorting->get_sort_field(); ?>" />
                <input type="hidden" name="order" value="<?php echo $sorting->get_sort_order(); ?>" />
                
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
                                
                                ?>
                        	</optgroup>                                 
                        </select>
                    </div>                
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="floor">Floor</label>
                    <div class="col-sm-10">
                        <select name="floor" 
                            id="floor" 
                            data-current="<?php echo $filter->get_floor(); ?>" 
                            data-source-url="../../libraries/inserts/facility.php" 
                            data-extra-options='<option value="0">All Buildings</option>'
                            data-grouped="1"
                            class="room_search form-control">
                            <optgroup label="Groups">                            
                            	<option value="" <?php if($filter->get_floor() == '') echo ' selected ' ?>>All</option>
                            </optgroup>
                            <optgroup label="Floors">
                                <?php
                                
									// Generate table row for each item in list.
									for($_obj_field_source_floor_list->rewind();	$_obj_field_source_floor_list->valid(); $_obj_field_source_floor_list->next())
									{	                                                               
										$_obj_field_source_floor = $_obj_field_source_floor_list->current();
										
										$sub_floor 				= $_obj_field_source_floor->get_floor();		
										$sub_floor_selected 	= NULL;
												
										if($filter->get_floor())
										{
											if($filter->get_floor() == $sub_floor)
											{
												$sub_floor_selected = ' selected ';
											}								
										}
										
										?>
										<option value="<?php echo $sub_floor; ?>" <?php echo $sub_floor_selected; ?>><?php echo $sub_floor; ?></option>
										<?php                                
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
            
            <a href="area.php&#63;nav_command=<?php echo RECORD_NAV_COMMANDS::NEW_BLANK;?>&amp;id=<?php echo DB_DEFAULTS::NEW_GUID; ?>" class="btn btn-success" title="Click here to start entering a new area."><span class="glyphicon glyphicon-plus"></span> Area</a>
          
          	
            <!--div class="table-responsive"-->
            <br /><br />
            <?php 
				$paging_markup = $paging->generate_paging_markup(); 
				echo $paging_markup;
			?>
                <table class="table table-striped table-hover">
                    <caption></caption>
                    <thead>
                        <tr>
                            <th><a href="<?php echo $sorting->sort_url(1); ?>">Label <?php echo $sorting->sorting_markup(1); ?></a></th>                            
                            <th><a href="<?php echo $sorting->sort_url(2); ?>">Building <?php echo $sorting->sorting_markup(2); ?></a></th>
                            <th><a href="<?php echo $sorting->sort_url(3); ?>">Floor <?php echo $sorting->sorting_markup(3); ?></a></th>
                            <th><a href="<?php echo $sorting->sort_url(4); ?>">Room <?php echo $sorting->sorting_markup(4); ?></a></th>                      
                            <th><a href="<?php echo $sorting->sort_url(5); ?>">Updated <?php echo $sorting->sorting_markup(5); ?></a></th>                            
                            <th><!--Action--></th>
                        </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                    <tbody>                        
                        <?php
										
							$t_i = 0;
											
                            if(is_object($_obj_data_main_list) === TRUE)
							{								
								for($_obj_data_main_list->rewind(); $_obj_data_main_list->valid(); $_obj_data_main_list->next())
								{									
									//$_obj_data_main = new blair_class_common_inspection_data();													
									$_obj_data_main = $_obj_data_main_list->current();										
                            ?>
                                        <tr>
                                            <td><?php echo $_obj_data_main->get_label(); ?></td>
                                            <td><?php echo $_obj_data_main->get_building_name(); ?></td>                                                                                        
                                            <td><?php echo $_obj_data_main->get_floor(); ?></td>
                                            <td><?php echo $_obj_data_main->get_room_id(); ?></td>                                            
                                            <td><?php if(is_object($_obj_data_main->get_log_update()) === TRUE) echo date(APPLICATION_SETTINGS::TIME_FORMAT, $_obj_data_main->get_log_update()->getTimestamp()); ?></td>                
                                            <td><a	href	="<?php echo 'area.php&#63;id='.$_obj_data_main->get_code(); ?>" 
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
				echo $paging_markup;
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