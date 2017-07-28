<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."fsm/";
	$cPRoot		= $cDocroot."fire/";
?>

<!DOCtype html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>UK - Campus Fire Safety Month</title>
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
                <?php include($cLRoot."a_banner.php"); ?>
                <div id="subNavigation">
                    <?php include($cLRoot."a_subnav.php"); ?> 
                </div>
                
                <div id="content">
                  <h1>Are you prepared?</h1>                 
                  
                  <p>A moment's notice - that's all it takes to engulf your cozy campus loft in a raging inferno. If confronted by a fire, would you know what to  do? What are the ways you could help prevent fires from starting in the first  place?</p>
                  
                  <p>National Campus Fire Safety Month is held each September to  help promote awareness of fire procedures and preventions. We invite you to  participate in one of the many educational events being held around campus.  The knowledge you gain could save your life or someone else's!</p>
                  
                  <p>For further information, please contact the <a href="../fire">UK Fire Marshal's Office</a>.</p>
                  <h2><a href="/docs/pdf/fsm_gov_proclamation.pdf" target="_blank">Governor&rsquo;s Proclamation</a></h2>                 
                  
                  <div><iframe src="//www.youtube.com/embed/nYA2ntW9oNE?wmode=transparent" allowfullscreen></iframe></div>
                  
                </div><!--/content-->      
            
            </div><!--/subContainer-->
                
            <div id="sidePanel">		
                    <?php include($cLRoot."a_sidepanel.php"); ?>
            </div><!--sidePanel-->
            
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--/container-->
        
        <div id="footerPad">
            <?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--/footerpad-->     
        
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