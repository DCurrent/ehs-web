<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
	require('../../libraries/php/classes/database/main.php'); 	// Database class.
	$cLRoot		= $cDocroot."fire/";	
	
	$db		= NULL;	// Database object.
	$query	= NULL;	// Query object.
	$markup	= NULL; // Result markup.
		
	// Verify user authorization and get account info.
	$oAcc->access_verify();
		
	// Initialize DB connection and query objects.
	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);	
	
	// Set SQL and parameter string.	
	$query->set_sql('SELECT 
						serial as Serial,
						born_str as Born,
						remaining as Remaining,
						location_desc as Location,
						action as Record	
	 				FROM dbo.vw_tbl_extinguisher
					ORDER BY born DESC');	

	// Execute query.
	$query->query();
	
	if($query->get_row_exists() === TRUE)
	{		// Create table.	
		$markup = $oTbl->tables_db_markup($query);		
	}
	else
	{
		$markup = '<h2 class="color_red">No Records</h2>';
	}
	
	
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
        <script src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script src="//code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <script src="../../libraries/jquery/tablesorter/jquery.tablesorter.js"></script>
        
        <style>
			#container
			{
				width:auto;
			}
			
			#subContainer
			{
				width:95%;
				padding:10px;
			}
		</style>
    </head>
    
    <body>    
        <div id="container">
            
            <div id="mainNavigation">
                <?php //include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
                <form action="details_extinguisher.php">
                    <input type="submit" value="Details">
                </form>
            </div><!--/mainNavigation-->
            
            <div id="subContainer">
                
				<h1>Extinguisher List</h1>
                               
                <div id="content">
                                
                    <?php echo $markup; ?>
                    
                </div><!--/content-->
            
            </div><!--/subContainer-->
                        
            
            <div id="footer">		
            </div><!--/footer-->
            
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