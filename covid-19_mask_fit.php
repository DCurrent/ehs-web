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
                    <h1>Mask Guidance for COVID-19</h1>                      
                <p>UK Environmental Health & Safety supports following all current federal, state, and local guidelines for COVID-19 including current directives from the Center for Disease Control (CDC), the Occupational Safety and Health Administration (OSHA), and the Kentucky State Government.  An overview for mask use is listed below and supporting guidelines can be found in the resources section of this document.</p>
                    <ul>
                      <li> Cloth masks should be worn whenever people are in a community setting to avoid spreading the virus that causes COVID-19. Workers coming to campus should have a mask with them and put them on when they are travelling on public transportation, walking in hallways, in shared work areas, and outdoors when social distancing is not assured. Masks would not be needed when in private offices. Information on use of masks is provided in the resources section (1, 2).       </li>
                      <li>UK has obtained a supply of masks and can be ordered through UK Supply Center. When searching mask as the key word, appropriate masks for COVID-19 are ones with ear loops. N95s with exhalation valves are not appropriate. Employees can bring and wear their own masks or any cloth face covering that covers the nose and mouth. Contact your supervisor for information.</li>
                      <li> Do not use a facemask meant for a healthcare worker such as a surgical mask or respirators such as an N-95.</li>
						<li><mark>If you have been given a N-95 respirator due to shortage of other options, it must not have an exhalation valve.</mark></li>
                      <li>Maintain social distancing even while wearing a mask.</li>
                    </ul>
                    
				<h2 style="">Wearing a Cloth Face Covering</h2>
				<p><img src="mask_fit_0.png" /></p>
				<h3>Cloth Face Coverings Should</h3>
				<ul>
				  <li> Fit snugly but comfortably against the side of the face.</li>
				  <li> Be secured with ties or ear loops      Include multiple layers of fabric.</li>
				  <li> Allow for breathing without restriction.</li>
				  <li> Be able to be laundered and machine dried without damage or change to shape.</li>
				  <li> Should not have an exhalation valve. </li>
			    </ul>
				<h3 style="page-break-before: always">FAQ</h3>
				<h5>Q. Should cloth face coverings be washed or otherwise cleaned regularly? How regularly?</h5>
				<p>Yes. They should be routinely washed depending on the frequency of use. </p>
				<h5>Q. How does one safely sterilize/clean a cloth face covering?</h5>
                <p>Machine washing should suffice in properly cleansing a face covering. </p>
				<h5>Q. How does one safely remove a used cloth face covering? </h5>
                <p>Individuals should be careful not to touch their eyes, nose, and mouth when removing their face covering and wash hands immediately after removing.</p>
                
				<h2>Resources</h2>
				<ol>
				  <li><a href="https://govstatus.egov.com/ky-healthy-at-work">Team Kentucky - Healthy at Work: How We Reopen Our Economy</a> </li>
				  <li><a href="https://kentucky.gov/Pages/Activity-stream.aspx?n=GovernorBeshear&prId=147">Gov. Beshear Shares 10 Rules to Reopening as Businesses Plan to Restart</a></li>
				  <li><a href="https://www.cdc.gov/coronavirus/2019-ncov/prevent-getting-sick/cloth-face-cover.html">Recommendation Regarding the Use of Cloth Face Coverings, Especially in Areas of Significant Community-Based Transmission</a></li>
				  <li><a href="https://www.cdc.gov/coronavirus/2019-ncov/prevent-getting-sick/diy-cloth-face-coverings.html">Use of Cloth Face Coverings to Help Slow the Spread of COVID-19</a></li>
				  <li><a href="https://govstatus.egov.com/kycovid19">Official Team Kentucky Source for Information Concerning COVID-19</a></li>
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