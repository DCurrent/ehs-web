<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."ohs/";
?>

<!DOCtype html>
    <head>
        <title>UK - Occupational Health &amp; Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />    
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
                </div><!--/subContainer-->
                <div id="content">
                    <h1>Industrial Hygiene</h1>
                    <p>Welcome to the Industrial Hygiene page.  The University of Kentucky Occupational Health & Safety Division is committed to providing work, study, and research environments that are free from recognized hazards that could cause serious physical harm to employees, students, and visitors.</p>

				  <p>The UK Industrial Hygiene Program deals with the anticipation, recognition, evaluation, and control of health hazards in the University environment.                  </p>
				  <p>Please click on any of the tabs below to learn more about our various domains  of industrial hygiene programs and practice.   If you have any questions, comments, or concerns, please do not hesitate  to contact me.</p>
                  <p>
                    <a href="mailto:derek.bocard@uky.edu">Bocard, Derek</a>, Senior Industrial Hygienist<br />
					UK Occupational Health &amp; Safety<br />
					252 East Maxwell Street, Lexington, KY  40503-0314<br />
					(859) 257-7600 - office<br />
				  (859)  257-8787 - fax</p>
                  
					<nav class="nav_sub_button">
                  		<ul>
                            <li><a href="bb_pathogens.php">Bloodborne Pathogens</a></li>
                            <li><a href="hearcons.php">Noise and Hearing Conservation</a></li>
                            <li><a href="air.php">Indoor Air Quality</a></li>
                            <li><a href="respgate.php">Respiratory Protection</a></li>
                            <li><a href="ih_monitoring.php">Monitoring</a></li>
                            <li><a href="radon.php">Radon</a></li>
                            <li><a href="ih_asbestos.php">Asbestos</a></li>
                            <li><a href="ih_lead.php">Lead</a></li>
                            <li><a href="ih_nr_exposure.php">Non-Routine Exposures</a></li>
                   	  </ul>
					</nav>
                    
                <p class="center"><img src="../media/image/ohs_indhyg.png" style="width:80%; margin:10px 10px 10px 10px;" alt="Industrial Hygiene"></span> 
                
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