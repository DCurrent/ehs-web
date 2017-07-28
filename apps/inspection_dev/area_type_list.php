<?php 
		
	require(__DIR__.'/source/main.php');
	
	class class_filter extends blair_class_audit_question_data
	{
		private
			$update_f	= NULL,
			$update_t 	= NULL;
		
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
	$sorting->set_sort_field(1);
	$sorting->set_sort_order(SORTING_ORDER_TYPE::ASCENDING);
	$sorting->populate_from_request();
	
	$filter = new class_filter();
	$filter->populate_from_request();
	
	$paging = new class_paging();
	$paging->set_row_max(APPLICATION_SETTINGS::PAGE_ROW_MAX);
	
	$query->set_sql('{call area_type_list(@page_current 	= ?,														 
										@page_rows 			= ?,										
										@update_from		= ?,
										@update_to			= ?,
										@sort_field			= ?,
										@sort_order			= ?)}');
	
	$sort_field 		= $sorting->get_sort_field();
	$sort_order 		= $sorting->get_sort_order();
	
	$params = array(array($paging->get_page_current(), 	SQLSRV_PARAM_IN), 
					array($paging->get_row_max(), 		SQLSRV_PARAM_IN),					
					array($filter->get_update_f(),		SQLSRV_PARAM_IN),
					array($filter->get_update_t(),		SQLSRV_PARAM_IN),
					array($sort_field,					SQLSRV_PARAM_IN),
					array($sort_order,					SQLSRV_PARAM_IN));
	
	$query->set_params($params);
	$query->query();	

	// Main data.
	$query->get_line_params()->set_class_name('blair_class_common_data');
	$_obj_data_main_list = $query->get_line_object_list();
	
	// --Paging
	$query->get_next_result();
	
	$query->get_line_params()->set_class_name('class_paging');
	
	//$_obj_data_paging = new class_paging();
	if($query->get_row_exists()) $paging = $query->get_line_object();
	
	// Datalist list generation.
		
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
                <h1>Area Type List</h1>
                <p>This is a list of types that may be assigned to each area.</p>
            </div>
            
            <div id="filters">
            
	        <legend>Filters <a type="button" class="btn" data-toggle="collapse" data-target="#filter">(Show/Hide)</a></legend>
            <form class="form-horizontal collapse" role="form" id="filter" method="get" enctype="multipart/form-data">
            	                
                <input type="hidden" name="field" value="<?php echo $sorting->get_sort_field(); ?>" />
                <input type="hidden" name="order" value="<?php echo $sorting->get_sort_order(); ?>" />
                
            	
                            
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
            
            <a href="area_type.php&#63;nav_command=<?php echo RECORD_NAV_COMMANDS::NEW_BLANK;?>&amp;id=<?php echo DB_DEFAULTS::NEW_GUID; ?>" class="btn btn-success" title="Click here to start entering a new item."><span class="glyphicon glyphicon-plus"></span> Item</a>
          
            <!--div class="table-responsive"-->
                <table class="table table-striped table-hover">
                    <caption></caption>
                    <thead>
                        <tr>
                            <th><a href="<?php echo $sorting->sort_url(1); ?>">Label <?php echo $sorting->sorting_markup(1); ?></a></th>                                                      
                            <th><a href="<?php echo $sorting->sort_url(2); ?>">Updated <?php echo $sorting->sorting_markup(2); ?></a></th>                            
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
                                            <td><?php if(is_object($_obj_data_main->get_log_update()) === TRUE) echo date(APPLICATION_SETTINGS::TIME_FORMAT, $_obj_data_main->get_log_update()->getTimestamp()); ?></td>                
                                            <td><a	href	="<?php echo 'area_type.php&#63;id='.$_obj_data_main->get_id(); ?>" 
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