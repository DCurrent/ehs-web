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
                    <h1>Radon</h1>
                  <p>The University of Kentucky is committed to providing work, study, and research environments that are free from recognized hazards.  As part of this commitment, the UK Occupational Health & Safety office routinely monitors campus buildings for radon, and has developed a Radon Management Program.  </p>
                  <p>Click <a href="../docs/pdf/ohs_fs_radon.pdf">here</a> to learn basic  facts about Radon at UK.</p>
                  <!--<p>Click <a href="../docs/pdf/ohs_radon_management.pdf">here</a> to access the  entire UK Radon Management Program document.</p>-->
                  <p class="gallery"><a href="../media/image/ohs_radon.png"><img src="../media/image/ohs_radon.png" alt="Radon Movement" title="Radon Movement"></a>
                  <a href="../media/image/ohs_radon_map.png"><img src="../media/image/ohs_radon_map.png" alt="Radon Map" title="Radon Map"></a></p>
				<h2>Useful Links</h2>
				<ul>
				  <li><a href="//www.epa.gov/radon/pubs/citguide.html">US EPA: A Citizen&rsquo;s Guide to Radon</a></li>
				  <li><a href="//www.epa.gov/radon/rrnc/index.html">US EPA: Radon-Resistant New Construction</a></li>
				  <li><a href="//www.cdc.gov/niosh/hhe/reports/pdfs/2011-0031-3167.pdf">NIOSH Evaluation of Radon Exposures at a Government Facility</a>				  </li>
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