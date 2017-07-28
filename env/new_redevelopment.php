<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."env/";
?>

<!DOCTYPE html>

    <head>
        <title>UK - Environmental Management</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        <link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />
    </head>
    
    <body>
        <div id="container">
            <div id="mainNavigation">
                <?php include("../libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            
            <div id="subContainer">
                <?php include($cLRoot."a_banner.php"); ?>
                <div id="subNavigation">
                    <?php include("a_subnav.php"); ?>	
                </div><!--/subNavigation-->
                <div id="content">
                    <h1>Post-Construction Stormwater Management in New Development and Redevelopment</h1>
                    <p>The objective of this minimum control measure is to positively impact the chemical, biological and overall health of the waters of the commonwealth’s by reducing the rate and volume and improving the quality of stormwater runoff from the MS4 after construction has been completed. Examples of activities that are part of the University's Stormwater Quality Management Plan include:</p>
                    <ul>
                        <li>Develop contract language requiring post-construction stormwater quality treatment.</li><br />
                        <li>Review plans to ensure post-construction stormwater quality treatment has been addressed.</li><br />
                        <li>Train Staff reviewing plans on post-construction stormwater design and application.</li><br />
                        <li>Develop plan review checklist.</li><br />
                        <li>Incorporate post-construction stormwater quality requirements into design and construction standards.</li><br />
                        <li>Conduct inspections to ensure measures are being installed correctly.</li><br />
                        <li>Develop or modify an inspection checklist for use during inspections to ensure that measures are being installed as required and as designed.</li><br />
                        <li>Develop and implement long-term post construction stormwater quality BMP inspection program.</li><br />
                        <li>Develop BMP inspection and maintenance plans for existing and new BMPs.</li><br />
                        <li>Perform BMP maintenance where needed.</li><br />
                        <li>Train staff performing inspections.</li><br />
                        <li>Review and evaluate the University's policies and design standards related to building and site design with the goal of infastructure, such as green roofs, porous pavement, water harvesting, etc.</li>
                    </ul>
                </div><!--/content-->
            </div><!--/subContainer-->
            <div id="sidePanel">
              <img src="/media/image/culvert.jpg" /><br />		        	
                <?php include($cLRoot."a_sidepanel.php"); ?>		
            </div><!--/sidePanel-->
            <div id="footer">
                <?php include("../libraries/includes/inc_footer.php"); ?>
            </div><!--/footer-->
        </div><!--/container-->
        
        <div id="footerPad">
        	<?php include("../libraries/includes/inc_footerpad.php"); ?>
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