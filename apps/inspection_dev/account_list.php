<?php 
		
	require(__DIR__.'/source/main.php');
	
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
		
	$paging = new class_paging();
	$paging->set_row_max(APPLICATION_SETTINGS::PAGE_ROW_MAX);	
	
	$query->set_sql('{call account_list(@page_current 		= ?,														 
										@page_rows 			= ?)}');	
	
	$params = array(array($paging->get_page_current(), 	SQLSRV_PARAM_IN), 
					array($paging->get_row_max(), 		SQLSRV_PARAM_IN));

	$query->set_params($params);
	$query->query();
	
	$query->get_line_params()->set_class_name('blair_class_account_data');
	$_obj_data_main_list = $query->get_line_object_list();

	// --Paging
	$query->get_next_result();
	
	$query->get_line_params()->set_class_name('class_paging');
	
	//$_obj_data_paging = new class_paging();
	if($query->get_row_exists()) $paging = $query->get_line_object();
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
                <h1>Accounts</h1>
                <p>Accounts allow clients to log into application, and are given levels of access based on assigned roles. The following is a list of accounts.</p>
            </div>
            
            <a href="account.php&#63;nav_command=<?php echo RECORD_NAV_COMMANDS::NEW_BLANK;?>&amp;id=<?php echo DB_DEFAULTS::NEW_GUID; ?>" class="btn btn-success btn-block" title="Click here to start entering a new account."><span class="glyphicon glyphicon-plus"></span> New Account</a>
          
            <!--div class="table-responsive"-->
                <table class="table table-striped table-hover">
                    <caption></caption>
                    <thead>
                        <tr>
                            <th>Account</th>
                            <th>Name</th>
                            <th>Notes</th>
                            <th><!--Action--></th>
                        </tr>
                    </thead>
                    <tfoot>
                    </tfoot>
                    <tbody>                        
                        <?php
                            if(is_object($_obj_data_main_list) === TRUE)
							{
								for($_obj_data_main_list->rewind(); $_obj_data_main_list->valid(); $_obj_data_main_list->next())
								{						
									$_obj_data_main = $_obj_data_main_list->current();
                            ?>
                                        <tr>
                                            <td><?php echo $_obj_data_main->get_account(); ?></td>
                                            <td><?php if($_obj_data_main->get_name_l()) echo $_obj_data_main->get_name_l().', '.$_obj_data_main->get_name_f(); ?></td>
                                            <td><?php echo $_obj_data_main->get_notes(); ?></td>
                                            <td><a	href		="account.php&#63;id=<?php echo $_obj_data_main->get_id(); ?>" 
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