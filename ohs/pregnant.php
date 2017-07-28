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
                    <h1>Chemical Use by Pregnant Laboratory Workers</h1>
                    <p>Certain chemicals are
  known or suspected to harm fetuses or reproductive health of adults. Some examples
  of reproductive toxins are: anesthetic gases, arsenic and certain arsenic compounds,
  benzene, cadmium and certain cadmium compounds, carbon disulfide, ethylene
  glycol monomethyl and ethyl ethers, ethylene oxide, lead compounds, mercury
  compounds, toluene, vinyl chloride, xylene, and formamide. The first trimester
  of pregnancy is a period of high susceptibility. Often a woman does not know
  that she is pregnant during this period. Individuals of childbearing potential
  are warned to be especially cautious when working with such reproductive toxins.
  These individuals must use appropriate protective apparel (especially gloves)
  to prevent skin contact. Pregnant women and women intending to become pregnant
  should seek advice from knowledgeable sources before working with substances
  that are suspected to be reproductive toxins. These sources include but are
  not limited to the respective Laboratory Supervisor, Material Safety Data Sheets,
  and the UK Environmental Health and Safety office. Notify supervisors of all
  incidents of exposure or spills; consult a qualified physician when appropriate.</p>
                  <p>For more information, see the following excellent sources:</p>
                  <ul>
                    <li><font size="2" face="Arial, Helvetica, sans-serif"><a href="http://ntp.niehs.nih.gov/pubhealth/hat/index.html">Center for the Evaluation of Risks to Human Reproduction</a> </font></li>
                    <li><font size="2" face="Arial, Helvetica, sans-serif"><a href="//www.osha.gov/SLTC/reproductivehazards/">Reproductive Hazards</a> </font></li>
                    <li><font size="2" face="Arial, Helvetica, sans-serif"><a href="//www.cdc.gov/niosh/99-104.html">The Effects of Workplace Hazards on Female Reproductive Health</a></font></li>
                    <li><font size="2" face="Arial, Helvetica, sans-serif"><a href="http://www.cdc.gov/niosh/docs/99-104/">Reproductive Health</a></font></li>
                  </ul>
                  
                </div>
                <!--/content-->      
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