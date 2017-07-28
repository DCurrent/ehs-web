<?php 

	$cDocroot 	= $_SERVER['DOCUMENT_ROOT'].'/';
	$cBase 		= $cDocroot.'/libraries/php/';

	require_once($cDocroot.'/libraries/php/classes/database/main.php');
	
	function localize_us_number($phone) 
	{
		$result = '<a href="tel:+'.$phone.'">';	
		
		$numbers_only = preg_replace("/[^\d]/", "", $phone);
		$result .= preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $numbers_only);
		
		$result .= '</a>';
		
		return $result;
	}

	$db			= NULL;	// Database object.
	$query		= NULL;	// Query object.
	$markup		= NULL; // Result markup.
	$line_arr_dept	= NULL;	// Line object array.
	$line_dept 		= NULL; // Line object.

	$db		= new class_db_connection();
	$options = new class_db_query_options();	
	
	// We don't need to update, so use fastest cursor.
	$options->set_scrollable(SQLSRV_CURSOR_FORWARD);
	
	// Initialize new query objects.	
	$query 			= new class_db_query($db, $options);	
	$query_staff	= new class_db_query($db, $options);
	$query_phone	= new class_db_query($db, $options);
	
	// Let's get a list of EHS categories.
	$query->set_sql("SELECT
		number, name
			FROM vw_uk_space_department
			WHERE number IN ('3he00', '3he10', '3he20', '3he30', '3he40', '3he50')
			ORDER BY number");
			
	$query->query();
	
	$line_arr_dept = $query->get_line_object_all();

	// Prepare a staff query.
	$query_staff->set_sql('SELECT 
							id,
							account,
							name_f,													
							name_l,
							title,
							email						
										
							FROM tbl_staff
							
							WHERE
								department = ?
								AND
								active = 1
							
							ORDER BY listing_order, name_l');					
	$query_staff->set_params(array(&$dept));
	$query_staff->prepare();


	// Prepare a phone number query.
	$query_phone->set_sql('SELECT number FROM tbl_staff_phone WHERE display = 1 AND type = 1 AND fk_id = ?');
	$query_phone->set_params(array(&$id));
	$query_phone->prepare();

?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        <link rel="stylesheet" href="libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="libraries/css/print.css" type="text/css" media="print" />    
    	<style>
			.cell_name
			{
				width:30%;
			}			
			.cell_title
			{
			}
			
			.cell_phone
			{
				width:20%;
				text-align:right;
			}
		</style>
    </head>
    
    <body>
    
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            <div id="subContainer">
                <?php include($cDocroot."a_banner_0001.php"); ?>
                <div id="subNavigation">
                    <?php include($cDocroot."a_subnav_0001.php"); ?> 
                </div><!--/subNavigation-->
              	<div id="content">
                	<?php
					
					// We'll loop through the category results.				
					foreach($line_arr_dept as $line_dept)
					{
						
						// Set our bound parameter and execute query for staff..
						$dept = $line_dept->number;
						$query_staff->execute();
						
						$line_arr_staff = $query_staff->get_line_object_all();
						
					?>		
                        <table class="block" id="table_staff_<?php echo $line_dept->number; ?>">
                            <caption><?php echo ucwords(strtolower($line_dept->name)); ?></caption>
                            
                            <colgroup>
                                <col class="cell_name">
                                <col class="cell_title">
                                <col class="cell_phone">
                            </colgroup>
                            
                            <thead>
                            </thead>
                            
                            <tfoot>                                
                            </tfoot>
                            
                            <tbody>
                            	<?php 
								
								// Now loop through each staff result.
								foreach($line_arr_staff as $line_staff)
                            	{
						
									// Default to account if email missing.
									if(!$line_staff->email)
									{
										$line_staff->email = $line_staff->account .'@uky.edu';
									}
																	
									// Let's get the list of office numbers for this staff entry.
									$id = $line_staff->id;
									$query_phone->execute();
									
									if($query_phone->get_row_exists())
									{																	
										$line_all_phone = $query_phone->get_line_object_all();
											
										// Clean phone number array.
										$phone_arr = array();
										
										// Populate phone number array with finished link/number strings.
										foreach($line_all_phone as $line_phone)
										{
											$phone_arr[] = localize_us_number($line_phone->number);
										}
										
										// Concatenate phone array into comma separated string.
										$phone = implode(', ', $phone_arr);
									}
									else
									{
										$phone = "NA";
									}
								?>
                                	<tr>
                                        <td>
                                            <a href="mailto:<?php echo $line_staff->email; ?>"><?php echo $line_staff->name_f.' '.$line_staff->name_l; ?>                                         </a>
                                        </td>
                                        <td>
                                            <?php echo $line_staff->title; ?>
                                        </td>
                                        <td>
                                            <?php echo $phone; ?>
                                        </td>
                                    </tr>
                                <?php
								}
								?>
                            </tbody>                           
                                                    
                        </table>
                	<?php
					}
					?>                                
              	</div><!--content-->       
            </div><!--/subContainer-->
                <div id="sidePanel">		
                    <?php include($cDocroot."a_sidepanel_0001.php"); ?>			
                </div><!--/sidePanel-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div>
        </div><!--/container-->
        
        <div id="footerPad">
        	<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--/footerPad-->
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40196994-1', 'uky.edu');
  ga('send', 'pageview');

</script>
</body>
</html>