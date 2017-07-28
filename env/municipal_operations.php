<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."env/";	
?>

<!DOCTYPE html>
	<head>
    	<title>UK - Environmental Management</title>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
    	<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />
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
                    <h1>Pollution Prevention/Good Housekeeping for Municipal Operations</h1>
                    <p>The objective of this minimum control measure is to ensure that UK operations (i.e., open space maintenance, fleet management, building maintenance, utility line construction, etc.) are performed in ways that will minimize the impact to stormwater quality. Examples of activities that are part of the University's Stormwater Quality Management Plan include:</p>
                    <ul>
                        <li>Evaluate standard operating procedures for activities related to Athletics grounds maintenance.</li><br />
                        <li>Continue implementing Athletics' policy on proper washing of field stripe painting equipment.</li><br />
                        <li>Develop stormwater pollution prevention fact sheet for inclusion in employee manual for Athletics.</li><br />
                        <li>Evaluate standard operating procedures for activities related to Grounds Services.</li><br />
                        <li>Develop written policy for Grounds Services on picking up trash before mowing.</li><br />
                        <li>Evaluate standard operating procedures for activities related to maintenance and operation of campus utilities.</li><br />
                        <li>Check drains in buildings for obvious cross connections.</li><br />
                        <li>Evaluate standard operating procedures for activities related to building renovations.</li><br />
                        <li>Develop an invetory of facilities and maintenance activities on campus, maintenance schedules, and on-going inspection procedures for structural and non-structural BMPs.</li>
                    </ul>
                </div><!--/content-->
            </div><!--/subContainer-->
            <div id="sidePanel">
              	<img src="/media/image/0037.jpg" /><br />		        	
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