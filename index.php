<?php require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>UK - Environmental Health And Safety</title>        
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" />
		<link rel="stylesheet" href="libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="libraries/css/print.css" type="text/css" media="print" />
    </head>
    
    <body>    
        <div id="container">            
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->            
            <div id="subContainer">                            
				<?php include("a_banner_0001.php"); ?>                               
                <div id="subNavigation">                
                    <?php include("a_subnav_0001.php"); ?>                     
                </div><!--/subNavigation-->                
                <div id="content">                
                    <h1>Welcome</h1>                      
                    <p>Welcome to the University of Kentucky's Environmental Health And Safety Division. UK safety begins with you!</p>                     
                    <h2>Our Mission</h2>                      
                    <p>The EHS Division supports the University's teaching, research, and public service mission by promoting a safe, healthful, clean, and accessible campus environment.</p>
                    <p>The Division's  programs are intended to provide safe and healthy conditions for work   and study, protect the environment, and comply with applicable laws and regulations. The Division serves the University community by providing   technical services, education and training, periodic audits, and   compliance assistance.</p>
                     
                    <?php include($cDocroot."libraries/includes/inc_updates.php"); ?>
              	</div><!--/content-->                      
            </div><!--/subContainer-->
            
            <div id="sidePanel">
                <?php include($cDocroot."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--container-->
        
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