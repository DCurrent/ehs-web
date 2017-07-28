<?php 
	
	abstract class PATH
	{		
		const ROOT = '../';
		const PARENT = '../fire/';
	}

	require(PATH::ROOT."libraries/php/classes/config.php"); //Basic configuration file.	
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
        
        <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
    </head>
    
    <body>    
        <div id="container">                	
            
            <div id="mainNavigation">
                <?php include(PATH::ROOT."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            
            <div id="subContainer">
                
				<?php include(PATH::PARENT."a_banner_0001.php"); ?>
                
                <div id="subNavigation">
                    <?php include(PATH::PARENT."a_subnav_0001.php"); ?> 
                </div><!--/subNavigation-->
                
                <div id="content">                 
                    
                <img src="../media/image/fire_extinguisher.jpg" width="601" height="1170" alt="Extinguisher">
                </div><!--/content-->
            
            </div><!--/subContainer-->
            
            <div id="sidePanel">		
                <?php include(PATH::PARENT."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            
            <div id="footer">
                <?php include(PATH::ROOT."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
            
        </div><!--/container-->
        
        <div id="footerPad">
        	<?php include(PATH::ROOT."libraries/includes/inc_footerpad.php"); ?>
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