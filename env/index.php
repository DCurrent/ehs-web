<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."env/";
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Management</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" />
		<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
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
                </div><!--/subContainer-->
                <div id="content">
                    <h1>Welcome</h1>
                    <p>The Environmental Management Department is responsible for ensuring the safe and timely pick up and management of hazardous waste and various other special waste streams generated at the University of Kentucky by on and off-campus locations. We also provide various services regarding compliance with waste management, water and air quality regulations. The department provides opportunities for both live and on-line training programs related to hazardous waste management and DOT/IATA shipping requirements.  Additional services provided include responding to spills/releases on a 24-hour basis, conducting site remediation and property audits and serving as the University's primary resource for conducting investigations and abatement for asbestos and lead based paint. Finally, according to a University charter, we have the responsibility for conducting and reporting internal environmental audits on a regular basis. If you are a faculty, staff or student we look forward to serving you in any of these areas.
                  </p>
                  <div id="env_mission" class="center">
                        <a href="../docs/pdf/emm_mission_0001.pdf" target="_blank" class="no_icon"><img src="../media/image/em_mission_0001.jpg" title="Mission Statement" alt="Mission Statement" /></a>
                  </div><!--/env_mission-->
                                    	
                     <h3>Environmental Management Department</h3>
                     <p>
                         Environmental  Quality Management Center (Building No. 490)<br />
                         355 Cooper Drive<br />
                         Lexington KY 40506-0490<br />
                         (859) 323-6280<br />
                         Fax: (859) 323-6274
                	 </p>
                </div><!--/content-->     
            </div><!--/subcontainer-->
            <div id="sidePanel">
                <?php include("a_corner_image.php"); ?>
                <?php include ($cLRoot."a_sidepanel.php"); ?>
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