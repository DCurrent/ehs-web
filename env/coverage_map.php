<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."env/";
?>

<!DOCtype html>
    <head>
    	<title>UK - Environmental Managemen, Coverage Mapt</title>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
    	<link rel="stylesheet" href="../libraries/css/style.css" />
        <link rel="stylesheet" href="../libraries/css/print.css" media="print" />
    </head>
    
    <body>
    	<div id="container">
            <div id="mainNavigation">
                <?php include("../libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            <div id="subContainer">
                <?php include($cLRoot."a_banner.php"); ?>
                <div id="subNavigation">
                    <?php include("a_subnav.php"); ?>	
                </div><!--/subNavigation-->
                <div id="content">
                    <h1>Map of the University of Kentucky's MS4 Permit Coverage</h1>
                    <p>The aerial extent of the property over which the University is required to manage stormwater pursuant to its MS4 Permit is provided on the map below.  The map also provides a designation of the watersheds into which each area of the campus discharges.</p>
                    <p><a href="http://www.ppd.uky.edu/outside/GIS/MS4/MS4.pdf" target="_blank" class="no_icon"><img src="../media/image/ms4_coverage_map.jpg" alt="Thumbnail view of the UK MS4 Permit Coverage" /></a></p>
                    <p>Click <a href="http://www.ppd.uky.edu/outside/GIS/MS4/MS4.pdf">here</a> or the thumbnail above to open the full map.</p>
                  	<p>Click <a href="../docs/pdf/env_sw_sewer_map.pdf">here</a> for Stormwater Sewer Map.</p>
              </div><!--/content-->
            </div><!--/subContainer-->
            <div id="sidePanel">
              	<img src="/media/image/0075.jpg" />		        	
                <?php include($cLRoot."a_sidepanel.php"); ?>		
            </div><!--/sidePanel-->
            <div id="footer">
                <?php include("../libraries/includes/inc_footer.php"); ?>
            </div><!--/footer-->
        </div><!--/container-->
        
        <div id="footerPad">
        	<?php include("../libraries/includes/inc_footerpad.php"); ?>
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