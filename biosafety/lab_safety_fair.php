<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cDocroot 	= $_SERVER['DOCUMENT_ROOT']."/"; 
	$cLRoot		= $cDocroot."biosafety/";
	
?>

<!DOCtype html>
    <head>
        <title>UK - Biological Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
    </head>
    
    <body>
    
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."/libraries/includes/inc_mainnav.php"); ?>
            </div><!--#mainNavigation-->
            <div id="subContainer">
                <?php include($cLRoot."a_banner.php"); ?>
                <div id="subNavigation">
                    <?php include($cLRoot."a_subnav.php"); ?> 
                </div><!--#subNavigation-->
                <div id="content">
                    <p class="center">
                   	<img src="../media/image/bio_lab_safe_fair_2015.png" alt="Lab Safety Fair Flyer" width="733"></p>
                    <h2 class="center">Don't miss out! <a href="../docs/bio_lab_safety_fair_2015.ics">Click here</a> to add to your calendar.</h2>           
                                    
                </div><!--#content-->       
            </div><!--#subContainer-->
            <div id="sidePanel">		
            	<?php include($cLRoot."a_sidepanel.php"); ?>        
            </div><!--#sidePanel-->
            <div id="footer">
                <?php include($cDocroot."/libraries/includes/inc_footer.php"); ?>		
            </div><!--#footer-->
        </div><!--#container-->
        
        <div id="footerPad">
        	<?php include($cDocroot."/libraries/includes/inc_footerpad.php"); ?>
        </div><!--#footerPad-->
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