<?php require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.

	$cDocroot 	= $_SERVER['DOCUMENT_ROOT']."/"; 
	$cLRoot		= $cDocroot."fire/";
	
	/*-----------------------------------------------*/
	
	$query						= NULL;	//Query string.
	$cOutput					= NULL; //Result output.	
			
	$query 	= "SELECT     TOP (100) 
							PERCENT CONVERT(VARCHAR(19), dbo.tbl_fire_alarm.date_WRONG, 120) AS 'Time', 
							UKSpace.dbo.MasterBuildings.BuildingName AS 'Location', 
		                    dbo.tbl_fire_alarm.public_desc AS 'Nature'
				
				FROM         dbo.tbl_fire_alarm LEFT OUTER JOIN
                
						      UKSpace.dbo.MasterBuildings ON dbo.tbl_fire_alarm.building_id = UKSpace.dbo.MasterBuildings.BuildingCode
				
				WHERE     (dbo.tbl_fire_alarm.public_display = 1)
				ORDER BY dbo.tbl_fire_alarm.date_rcvd DESC";
	
	$params = array();

	$oDB->db_basic_select($query, $params, TRUE, TRUE, TRUE, TRUE);
	
	$cOutput = $oTbl->tables_db_output($oDB, FALSE);
	
?>

<!DOCtype html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<title>UK - Environmental Health And Safety, Campus Fire Log</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" />
    	<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />    
    	<link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
        
        <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
    </head>
    
    <body>    
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            <div id="subContainer">
                <?php include($cLRoot."a_banner_0001.php"); ?>
                <div id="subNavigation">
                    <?php include($cLRoot."a_subnav_0001.php"); ?> 
                </div><!--/subNavigation-->
                <div id="content">
                    <h1>Campus Fire Log</h1>
                    
                  	<?php echo $cOutput; ?>
                </div><!--/content-->
            </div><!--/subContainer-->    
            <div id="sidePanel">		
                <?php include($cLRoot."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
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