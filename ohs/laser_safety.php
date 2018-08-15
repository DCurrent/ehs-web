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
					
					<p>Laser Safety</p>
                    <p>Statement of Purpose</p>
                    <p>The university of Kentucky is dedicated to providing a safe and   healthy working environment for all faculty, staff, students and   visitors. This includes the use of lasers and their safet use.  If you   are interested in learning more about the University of Kentucky&rsquo;s Laser   Safety Program, or have further concerns, please contact the laser   safety officer (LSO), Robert Thomas at 859-257-4016.</p>
                    <p>UK adopts ANSI Z136.1-2000 as its laser safety program. Exceptions to   this standard will be considered on a case-by-case basis by the LSO.   The LSO shall document and keep record of any policy decisions that are   exceptions to the ANSI Z136.1- 2000 standard.</p>
                    <p>Attention: All class 3b and 4 lasers and laser systems and users MUST be registered!</p>
                    <p>RC&amp;RS Laser Safety maintains records for all class 3b and 4   lasers and laser systems used in university facilities and is currently   updating the registration database.</p>
                    <p>All new and existing class 3b and 4 lasers and laser systems must be   registered. This registration also includes lasers or laser systems that   are in storage or are out-of-service.</p>
                    <p>Below this should be the link to the registration form, fact sheet and manual. (all to be updated shortly)</p>
                    <p>Include these USEFUL LINKS as well</p>
                    <p><a href="http://www.osha.gov/dcsp/alliances/lia/lia.html">OSHA - LIA Alliance Website(link is external)</a></p>
                    <p><a href="https://putrain.learn.com/learncenter.asp?id=178409&page=194">Laser Safety Training(link is external)</a></p>
<?php include($cDocroot."libraries/includes/inc_updates.php"); ?>
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