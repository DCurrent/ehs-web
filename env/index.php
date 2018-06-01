<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."env/";
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Management</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Permanent Marker" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" />
		<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
    
    	<style>
		.custom_marker_normal
			{
				font-family: 'Permanent Marker';
				font-size: 48px;
			}
		.custom_marker_alert
			{
				color: #8C0002;
				font-family: 'Permanent Marker';
				font-size: 48px;
				text-decoration-line: underline;
				
			}
		li.double-space
			{
				padding:1em 0;
			}
		</style>    
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
                </div><!--/subContainer-->
                <div id="content">
				  <h1 class="alert center"><span style="font-style: italic;">Attention</span> - Announcing</h1>
                   	<br />
                    
					<img style="float: right;" src="../media/image/rde-hand-01.png" width="343" height="389" alt=""/>						


				  <div class="float_right">
						<span class="custom_marker_normal">New</span><br />
					  <span class="custom_marker_alert"> Regulations!</span>								
					</div>

					<p class="float_right"  style="clear:both;">
					  <span style="color: #005daa;font-size: xx-large;font-weight: bold;">Directly applicable to all hazardous waste generating locations at the University of Kentucky.</span>
					</p>	
                    
                    <br/>
                    
                  <div id="header-text" style="display: block; clear:both;">
						<h2>What</h2>
						<p>A federally mandated regulation known as the <span class="alert">Hazardous Waste Generator Improvements Rule</span>, has been made final in Kentucky and it has changed key elements of the way in which those who generate hazardous waste must manage those wastes.</p>
						<h2>How Are you Affected</h2>
						<p>If your job functions or researching and teaching activities result in the generation of hazardous waste the new regulation will impact the way in which you are required to document, accumulate and manage that waste while it is in your possession.</p>
						<h2>Additional Information</h2>
						<p>The details of the way in which the University will address the new regulation will be provided through live training opportunities as scheduled below:</p>
						
						Several live training events were held during the month May to provide details of the new regulation and the specific strategies of how the University will attain compliance. If you were unable to attend any of these live events, please check back to this page and a recorded version will be available very soon.  In addition, printed guidance and other resources are currently available:
						<ul>
						  <li class="double-space">For a summary of key parts of the new regulation consult - <a href="media/hazardous-waste-generator-improvements-summary.pdf" target="_blank">Hazardous Waste Generator Improvements  Rule - Summary</a>
						  </li>
						  <li class="double-space">For instructions for managing hazardous waste at their point of generation consult - <a href="media/saa-regulatory-guidance-paper.pdf" target="_blank">Hazardous  Waste  Generator Improvements Rule - SAA Regulatory Guidance Paper</a>
						  </li>
						  <li class = "double-space">The following must be available at every Satelite Accumulation Area for use in case of an emergency involving a release of hazardous waste - <a href="media/contingency-plan-quick-reference-guide.pdf" target="_blank">Quick Reference Contingency Plan</a></li>
  			        </ul>
						<h2>Contact Information</h2>
						<p>The primary contact for the new requirement and the University's strategies for compliance is Ron Taylor, Assistant Director, Environmental Management Dept.</p>
					</div>
                  <div id="env_mission" class="center">
                        <a href="../docs/pdf/emm_mission_0001.pdf" target="_blank" class="no_icon"><img src="../media/image/em_mission_0001.jpg" title="Mission Statement" alt="Mission Statement" /></a>
                  </div><!--/env_mission-->
                                    	
                     <h3>Environmental Management Department</h3>
                     <p>
                         Environmental  Quality Management Center (Building No. 490)<br />
                         355 Cooper Drive<br />
                         Lexington KY 40506-0490<br />
                         (859) 323-6280<br />
                         Fax: (859) 323-6274
                	 </p>
                </div><!--/content-->     
            </div><!--/subcontainer-->
            <div id="sidePanel">
                <?php include("a_corner_image.php"); ?>
                <?php include ($cLRoot."a_sidepanel.php"); ?>
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