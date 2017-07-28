<?php 

	$cDocroot 	= $_SERVER['DOCUMENT_ROOT']."/"; 
	$cLRoot		= $cDocroot."biosafety/";
?>

<!DOCtype html>    
    <head>
        <title>UK - Environmental Health And Safety, Biological Select Agents and Toxins Campus Survey</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        <link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />    
        <link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
       
        <script language="Javascript" type="text/javascript" src="/libraries/list_update_0001.js"></script>
        <script language="Javascript" type="text/javascript" src="/libraries/javascript/show_hide_0001.js"></script>
    
    </head>
    
    <body>
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            
            <div id="subContainer">
                <?php include($cLRoot."a_banner.php"); ?>
                <div id="subNavigation">
                    <?php include($cLRoot."a_subnav.php"); ?> 
                </div>
                <div id="content">
                	<h1>Biological Select Agents and Toxins Campus Survey</h1>
                    
                    <p>Per the Code of Federal Regulations (7 CFR Part 331, 9 CFR Part 121, and 42 CFR Part 73) possession, use or transfer of the infectious agents and toxins listed below requires registration with the Centers for Disease Control and Prevention and/or United States Department of Agriculture.  Non-compliance with these regulations may result in criminal penalties, including fines and incarceration, affecting the University of Kentucky and/or the individual in possession of the material.  Additionally, per University of Kentucky policy, research involving these materials must be registered with the Institutional Biosafety Committee.  Please review the list below and document on the survey form any of these materials which your lab may possess.</p>
           
					<p>Information regarding the biological Select Agents and Toxins (BSAT) regulations may be found <a href="//www.selectagents.gov/index.html" target="_blank">here</a>.  For additional questions or concerns regarding BSAT, please contact the Department of Biological Safety at 859-257-1049.</p>
                </div><!--/content-->
            </div><!--/subContainer-->
            
            <div id="sidePanel">		
                <?php include($cLRoot."a_corner_image.php"); ?>
                <div id="sideContent">
                    <?php include($cLRoot."a_contact.php"); ?>
                    <?php include($cLRoot."a_reg_archive.php"); ?>            			
                </div>
                <div id="sideContent">			
                    <?php include($cLRoot."a_staff.php"); ?>
                </div>
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