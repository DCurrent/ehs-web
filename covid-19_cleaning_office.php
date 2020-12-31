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
				<?php include("a_banner.php"); ?>                               
                <div id="subNavigation">                
                    <?php include("a_subnav.php"); ?>                     
                </div><!--/subNavigation-->                
              <div id="content">                
                    <h1><span data-contrast="auto" xml:lang="EN-US" lang="EN-US"><span data-ccp-parastyle="header">Guidelines with Suspected/Confirmed COVID-19</span></span></h1>                      
                    <p>This guidance provides recommendations on the cleaning and disinfection of rooms or areas of those with suspected or with confirmed COVID-19 have visited. It is aimed at limiting the survival of novel coronavirus in key environments. These recommendations will be updated if additional information becomes available. These recommendations are adapted from the <a href="https://www.cdc.gov/coronavirus/2019-ncov/community/organizations/cleaning-disinfection.html">CDC guidelines</a> focused on community, non-healthcare facilities (e.g., schools, institutions of higher education, offices, daycare centers, businesses, community centers).</p>
				  <h2>Restrict Access and Disinfection Procedures For Affected Areas</h2>
				  <p>Based on the information about knowledge of the case and in accordance with the CDC guidelines, the following guidelines have been established for the cleaning and disinfection of facilities where confirmed cases  of COVID-19 are reported.. </p>
				  <ul>
				    <li>    The sick person should leave campus and follow <a href="https://www.cdc.gov/coronavirus/2019-ncov/if-you-are-sick/steps-when-sick.html">CDC guidelines</a>.</li>
				    <li> Close off areas used by the affected persons and lock/restrict access.</li>
				    <li> Notify the building’s custodial staff of the affected area.</li>
				    <li> Custodial staff have been trained on cleaning protocols. It is recommended to close off areas used by the ill persons and wait as long as practical before beginning cleaning and disinfection to minimize potential for exposure to respiratory droplets. Open outside doors and windows to increase air circulation in the area. If possible, wait up to 24 hours before beginning cleaning and disinfection. 				      </li>
				    <li>Cleaning staff should clean and disinfect all areas (e.g., offices, bathrooms, and common areas) used by the affected persons, focusing especially on frequently touched surfaces.				      </li>
				    <li><a href="https://www.epa.gov/pesticide-registration/list-n-disinfectants-use-against-sars-cov-2">Occupants should use disinfecting wipes</a> to clean desks area and other high touch surfaces that custodial staff is not cleaning. See <a href="https://www.uky.edu/coronavirus/faqs">UK Coronavirus FAQ page</a>.</li>
			    </ul>
				  <h2>Identify Unoccupied Areas To Preserve Resources</h2>
				  <p>As much as possible, campuses and work units should close, lock, and label rooms and/or buildings that are not being used (such as classrooms, offices of employees working from home, etc.) so that cleaning staff can focus their time, energy, and supplies on the spaces still in use.</p>
				  
                  
                    
				<h2 style="page-break-before: always">References</h2>
					
					<ul>
					  <li><a href="https://www.cdc.gov/coronavirus/2019-ncov/community/organizations/cleaning-disinfection.html">CDC Interim Recommendations for US Community Facilities with Suspected/confirmed Coronavirus Disease 2019</a></li>
					  <li><a href="https://www.cdc.gov/coronavirus/2019-ncov/community/home/cleaning-disinfection.html">CDC Interim Recommendations for US Households with Suspected/Confirmed Coronavirus Disease 2019  </a></li>
			    </ul>
					
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