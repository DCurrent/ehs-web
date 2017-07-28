<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."env/";
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Management, Drinking Water Quality</title>
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
                    <h1>Fact Sheet - Drinking Water Quality</h1>
                    
                    <p>Questions have been raised on campus regarding drinking water quality. Reports that the water looks odd, smells funny, or tastes bad are fairly common. UK Environmental Management and the Physical Plant Division's Water Quality unit have overseen water sampling at dozens of locations on campus with virtually the same result: drinking water at UK may not always be esthetically perfect, but it is safe to drink. In many cases it's actually safer than drinking water from an at-the-tap filter system, particularly if the system hasn't been maintained or serviced properly. Both UK and Kentucky-American Water Company (KAWC) discourage the use of point-of-use filtering devices.</p>

					<p>The following information may help answer some questions regarding water quality:</p>
                    
                    <h3>What if I experience discolored or "red" water?</h3>
                    
                    <p>Discolored or "red" water is usually caused by rusty pipes or calcium deposits that form from minerals in the water itself. Normally, these deposits remain intact and cause no problem, but sometimes changes in the water flow can disturb the deposits. When that happens, rusty water can appear, particularly in older buildings. This problem normally clears up after the water runs for a few minutes. Rusty water does not represent a health hazard.</p>
                    
                    <h3>What if the water has a white or "milky" color?</h3>
                    
                    <p>Millions of tiny air bubbles in water can give it a white or "milky" appearance. Air is normally dissolved in water, and the colder the water is the more air it will hold. When this cold water moves into a warmer environment (for example, a building's plumbing system), the air often escapes, producing a milky or cloudy appearance. Air in the water does not represent a health risk.</p>
                    
                    <h3>What if the water has a "musty" or "earthy" taste or odor?</h3>
                    
                    <p>Lead can leach or dissolve into drinking water on the way to the tap as it flows through piping or fixtures that contain lead. "Flushing" a tap before use can reduce the risks associated with lead, especially any time the water in a particular faucet has not been used for six or more hours. You can "flush" your cold water pipes by allowing the water to run until it becomes cooler (approximately one to two minutes). The water that is flushed can be saved and used to water plants or for other purposes besides drinking or cooking.</p>
                    
                    <p>UK and KAWC have conducted water testing on campus since the late 1980s. Virtually all of the testing has shown lead levels well below the EPA action level.</p>
                    
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