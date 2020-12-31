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
                    <?php include("a_subnav_0001.php"); ?>                     
                </div><!--/subNavigation-->                
              <div id="content">                
                    <h1>UK EHS COVID-19 Guidance</h1>                      
                    <p>UK’s EH&S supports following all current federal, state, and local guidelines for COVID-19 including current directives from the Center for Disease Control (CDC), the Occupational Safety and Health Administration (OSHA), and the Kentucky State Government. An overview of best practices is listed below and supporting guidelines can be found in the resources section of this document.</p>
                  <ul>
                      <li>
                      Do not come to work if you are sick, have recently had close contact with a person with COVID-19, or recently traveled from somewhere outside of the U.S.  Notify your supervisor and follow the CDC guidelines for Social Distancing, Quarantine, and Isolation found in the resources section (1).</li>
                      <li>If you believe you are sick, contact your healthcare provider and get tested for COVID-19 at one of KY’s testing sites. Testing is available and a list of drive through testing locations in KY is provided in the resources section (2).</li>
                      <li>Regularly wash your hands using soap and water for at least 20 seconds. Use hand sanitizer with at least 60% alcohol if soap and water are not available.</li>
                      <li>Avoid touching your eyes, nose, and mouth with unwashed hands.</li>
                      <li>Maintain social distancing, six feet or more between yourself and other employees to the greatest extent possible.</li>
                      <li>Implement flexible work sites (telework) and flexible work hours (staggered shifts) if possible.</li>
                      <li>Do not gather in groups. Use online conferencing such as Microsoft Teams, Zoom, or Skype.</li>
                      <li>Wear a cloth face covering to avoid spreading COVID-19 when around others in case you are infected but do not have symptoms.  Information on use of masks is provided in the resources section (3).  Do not use a facemask meant for a healthcare worker and still maintain social distancing while wearing a mask.</li>
                      <li>Cover your mouth and nose with a tissue when you cough or sneeze or use the inside of your elbow. Throw used tissues in the trash and immediately wash hands with soap and water for at least 20 seconds. If soap and water are not available, use hand sanitizer containing at least 60% alcohol.</li>
                      <li>Avoid using other employees’ phones, desks, offices, or other work tools and equipment, when possible. If necessary, clean and disinfect them before and after use.</li>
                      <li>Clean and disinfect high touch surfaces regularly.  Examples include tables, workstations, keyboards, telephones, handrails, doorknobs, light switches, countertops, desks, toilets, faucets, and sinks. Coordinate with Custodial Services to follow the CDC guidelines for Cleaning and Disinfecting Your Facility found in the resources section (4).</li>
                      <li>All common gathering areas must remain closed.</li>
                      <li>Employees should be self- screening for temperature and other symptoms of illness before reporting to the workplace.</li>
                </ul>
                    
				<h2 style="page-break-before: always">Resources</h2>
					
					<ol>
					  <li><a href="https://www.cdc.gov/coronavirus/2019-ncov/prevent-getting-sick/social-distancing.html">CDC guidelines for Social Distancing, Quarantine, and Isolation</a></li>
					  <li><a href="https://chfs.ky.gov/agencies/dph/Pages/COVID-19-Drive-Thru-Locations.aspx">Kentucky Coronavirus Drive Through Testing Locations</a></li>
					  <li><a href="https://www.cdc.gov/coronavirus/2019-ncov/prevent-getting-sick/diy-cloth-face-coverings.html">CDC guidelines for use and maintenance of cloth face masks</a></li>
					  <li><a href="https://www.cdc.gov/coronavirus/2019-ncov/community/disinfecting-building-facility.html">CDC guidelines for Cleaning and Disinfecting Your Facility</a></li>
					  <li><a href="https://govstatus.egov.com/kycovid19">The Official Team Kentucky Source for Information Concerning COVID-19</a></li>
					  <li><a href="https://www.cdc.gov/coronavirus/2019-ncov/community/guidance-business-response.html">CDC Interim Guidance for Businesses and Employers to Plan and Respond to Coronavirus Disease 2019 (COVID-19)</a></li>
					  <li><a href="https://www.osha.gov/Publications/OSHA3990.pdf">OHSA Guidance on Preparing Workplaces for COVID 19</a></li>
			    </ol>
					
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