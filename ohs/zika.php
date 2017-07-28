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
                    <h1>Zika Virus</h1>
                    <p><img src="../media/image/ohs_mosquito.jpg" style="padding:5px;"><img src="../media/image/ohs_zika_map.png" style="padding:5px;"></p>
                    <p>Zika virus disease, an infectious disease spread through the bite of mosquitoes, is considered by the World Health Organization to be a serious international public health threat. Although many people who contract Zika virus infection have mild or no symptoms, pregnant women are thought to be at particular high risk for complications after Zika virus exposure, because the virus has been linked with the birth of babies with microcephaly (smaller than normal heads).  </p>
                    <p>The Kentucky Department for Public Health is working closely with the Centers of Disease Control and Prevention to provide guidance and education to health professionals and the general public regarding the Zika virus disease. For additional Kentucky questions or assistance, call (888) 973-7678 during business hours. </p>
                    <iframe src="https://www.youtube.com/embed/M4tcWVhecXo" allowfullscreen></iframe>
                    
                    <h2>Usful Links</h2>
                    <ul>
                      <li><a href="http://pest.ca.uky.edu/EXT/ZIKA/Mosquito%20poster.pdf">Fight the Bite</a>:  guidance from the University of Kentucky <a href="http://pest.ca.uky.edu/EXT/ZIKA/FAQ.pdf">Cooperative Extension Service</a></li>
                      <li>                        Tips on <a href="http://www.cdc.gov/chikungunya/pdfs/fs_mosquito_bite_prevention_us.pdf">mosquito  bite prevention</a> from the Centers for Disease Control and Prevention</li>
                      <li> <a href="http://healthalerts.ky.gov/Pages/Zika.aspx">Zika  Virus health alerts</a> from the Kentucky Department for Public Health</li>
                      <li> <a href="http://www.fda.gov/EmergencyPreparedness/Counterterrorism/MedicalCountermeasures/MCMIssues/ucm485199.htm">Zika  Virus response updates</a> from the United States Food and Drug Administration</li>
                    </ul>
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