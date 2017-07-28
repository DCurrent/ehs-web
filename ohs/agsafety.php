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
                    <h1>Agricultural Safety Resources</h1>
                    <h2>Government           Resources</h2>
                    <p><a href="https://www.osha.gov/dsg/topics/agriculturaloperations/index.html">Occupational Health           &amp; Safety Administration</a><br>
                  <a href="http://www.cdc.gov/niosh/agforfish/">National Institute           for Occupational Health &amp; Safety</a><br>
                  <a href="//www.kyagr.com/cons_ps/safety/">Kentucky Department           of Agriculture</a><br>
                  <a href="//www.nlm.nih.gov/medlineplus/farmsafety.html">National Library of           Medicine/National Institutes of Health</a><br />
                  </p>
                  
                    <h2>UK Resources</h2>
                    <p><a href="http://www.mc.uky.edu/scahip/">Southeast Center for           Agricultural Health &amp; Injury Prevention</a><br>
                  <a href="https://www.uky.edu/bae/extension-publications">College of Ag, Biosystems           &amp; Ag Engineering Publications &#8211; Farm Safety</a><br>
                  <a href="//www.ca.uky.edu/agc/news/2002/Oct/tractor.htm">College of Ag &#8211;           News Releases</a><br />
                  </p>
                  
                    <h2> Other Resources</h2>
                    <p><a href="http://www.necasag.org/">National Safety Council           &#8211; Agricultural Safety</a><br>
                      <a href="http://ehs.okstate.edu/links/farm.htm">Oklahoma State University           &#8211; Farm Safety &amp; Agriculture</a><br>
                      <a href="//www.iol.ie/~manister/tractortrouble/index.html">Manister National           School &#8211; Tractor Trouble</a><br>
                      <a href="//www.hicahs.colostate.edu/">High Plains Intermountain           Center for Ag Health &amp; Safety</a><br>
                      <a href="http://www.ashca.org/">Agricultural Safety &amp; Health Council of America</a><br />
                      </p>
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