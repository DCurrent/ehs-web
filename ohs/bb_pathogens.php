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
                    <h1>Bloodborne Pathogens</h1>
                    <p><a href="../docs/pdf/ohs_bp_what_to_do_if_exposed.pdf">What to Do in Case of Exposure to Human Blood or Other Potentially Infectious Materials</a></p>
                  <p>The University of Kentucky is committed to providing work, study, and research environments that are free from recognized hazards, including those from human blood or other potentially infectious materials (OPIM).  All personnel with reasonably-anticipated exposures to human blood or OPIM must be covered by a unit-specific Exposure Control Plan.  This Plan must describe how a combination of engineering and work practice controls, the use of personal protective clothing and equipment, training, medical surveillance, hepatitis B vaccination, and signs/labels will be used to protect personnel, and must be updated at least annually.</p>
                                       
                    <p>Engineering controls are the primary means of eliminating or minimizing exposure and can include the use of safer medical devices, such as needleless devices, shielded needle devices, and plastic capillary tubes.</p>
                    
                    <p>Potentially affected personnel must be trained at least annually on both the unit-specific procedures and general bloodborne pathogens (BBP) training.  Online BBP training modules for both researchers and non-research personnel can be found on the EHS Training page.</p>
                    
                  <p>If you have questions about bloodborne pathogens, training, or how to complete an <a href="../docs/doc/ohs_bbp_exposure_control_plan_template.doc">Exposure Control Plan</a>, please contact Derek Bocard at UK OHS: 859-257-7600.</p>
                    
                  <h2>Useful Links</h2>
                  <ul>
                    <li>Bloodborne Pathogens: Exposure Control Plan template</li>
                    <li>NIOSH ALERT:<a href="//www.cdc.gov/niosh/docs/2000-108/pdfs/2000-108.pdf"> Preventing Needlestick Injuries in Health Care  Settings</a></li>
                    <li>Fact Sheet: <a href="/env/fs_disposal_0001.php">Disposal of Needles, Syringes, Other Sharps and Broken Glass</a></li>
                    <li>Fact Sheet: <a href="/env/fs_biohaz_0001.php">Biohazard Autoclave Bags</a></li>
                    <li>Fact Sheet: <a href="fs_blood_and_body.php">Cleaning up Blood and Body Fluids</a></li>
                    <li>Occupational Safety and Health Administration
                      <ul>
                        <li><a href="https://www.osha.gov/pls/oshaweb/owadisp.show_document?p_table=STANDARDS&p_id=10051">Bloodborne Pathogens Standard</a></li>
                        <li><a href="https://www.osha.gov/pls/oshaweb/owadisp.show_document?p_table=INTERPRETATIONS&p_id=21519">Applicability of BBP Standard to Established Human Cell Lines</a></li>
                      </ul>
                    </li>
                  </ul>
                  <p class="center"><a href="//www.cdc.gov/niosh/stopsticks/" target="_blank" class="no_icon"><img src="../media/image/cdc_needle_stick.png" alt="Needle Stick"></a><a href="//www.cdc.gov/niosh/docs/2008-115/pdfs/2008-115.pdf" target="_blank" class="no_icon"><img src="../media/image/cdc_exposure_control.png" alt="Exposure Control"></a></p>
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