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
                    <h1>Hearing Conservation</h1>
                  <p>The University of Kentucky is committed to  providing work, study, and research environments that are free from recognized  hazards, including those that result from high-noise environments.  The purpose of the Hearing Conservation  Program is to provide for the protection of University personnel from long term  hearing loss associated with noise levels in the workplace in compliance with  the Occupational Safety and Health Administration (OSHA) <a href="https://www.osha.gov/pls/oshaweb/owadisp.show_document?p_table=STANDARDS&p_id=9735">29 CFR Part 1910.95</a>, Occupational Noise Exposure. </p>

                  <h2>Hearing  Conservation Program (HCP)</h2>
                  
                  <p>All UK personnel whose noise exposures equal or exceeds an 8-hour time weighted average (TWA) of 85 decibels, also known as the OSHA action level, must be enrolled in a HCP. The hearing conservation program includes:</p>
                  
                  <ul>
                    <li>                    Annual monitoring of noise exposures </li>
                    <li>Annual training on noise exposures</li>
                    <li>Use of hearing protectors</li>
                    <li>Annual audiometric testing</li>
                  </ul>
                  
                  <h2>Recognition and Evaluation of Noise Sources</h2>
                  <p>When information indicates that any employee's  exposure may equal or exceed 85 decibels (8-hour TWA), the department is to  notify UK Occupational Health &amp; Safety (OHS) to implement a monitoring  program. The noise survey is performed using a sound level meter (A-scale, slow  response) and/or noise dosimeter for evaluation of personal exposures.  Monitoring shall be repeated whenever a change in production, process,  equipment or controls increases noise exposures to the extent that additional  employees may be exposed at or above the action level; or the attenuation  provided by hearing protectors being used by employees is not adequate. </p>
                  
                  <h2>Audiometric testing</h2>
					
                  <p>Annual audiometric testing is performed by a licensed or certified  audiologist. A baseline audiogram is obtained within 6 months of an employee's  first exposure at or above the action level. The baseline audiogram is  established to compare against subsequent audiograms. The results of the  audiometric tests are sent to the Department of Preventive Medicine and  Environmental Health for review and to determine whether audiograms require  further evaluation. Employees are to be notified, in writing, of the results of  exams. When there is a verified standard threshold shift, the employee must be  notified within 21 days after verification.</p>
                  
                  <h2>Control of Noise Source</h2>
                  
                  <p>When employees are subjected to sound levels exceeding 85 decibels  (8-hour TWA), feasible administrative or engineering controls are to be  utilized. Types of administrative controls are rotation of employees, limiting  time of certain operations, or restricting areas or work operations.  Engineering controls include maintenance, modifying equipment, substitution of  equipment, isolation, and acoustic material.</p>
                  
                  <h2>Hearing Protection Devices</h2>
                  
                  <p>If feasible engineering or administrative  controls cannot be accomplished, personal hearing protective devices must be  provided and used to reduce sound levels in areas above 85 dBA. The hearing  protection used will depend on the operation, employee preference and  attenuation required. UK OHS can assist in supplying information on attenuation  data and supervise the correct use of hearing protectors. Employees are given  the opportunity to select their hearing protectors from a variety of suitable types.  Personal protective devices should also be used during non-routine, infrequent  operations, which do not warrant special engineering control. </p>

<p>For  employees who have experienced a standard threshold shift, hearing protectors  must attenuate employee exposure to an 8-hour time-weighted average of 85  decibels or below. The adequacy of hearing protector attenuation shall be  re-evaluated whenever employee noise exposures increase to the extent that the  hearing protectors provided may no longer provide adequate attenuation.</p>					

                  <h2>Signs</h2>
                  
                  <p>Signs are to be posted in areas where noise levels are above 85 dBA  stating that hearing protection is required.</p>
                  
                  <h2>Training</h2>
                  
                  <p>An annual training program is provided for each employee included in the  hearing conservation program. The training program includes effects of noise on  hearing; the purpose of hearing protectors, and instruction on their selection,  fitting, use, and care; and the purpose of audiometric testing.</p>

<h2>Useful Links</h2>
                  
                  <ul>
                    <li>
                      World Health Organization, <a href="//www.who.int/occupational_health/publications/occupnoise/en/index.html">Occupational Exposure to Noise: Evaluation, Prevention, and  Control</a>                      
                    </li>
                    <li><a href="//www.cdc.gov/niosh/mining/content/earplug.html">CDC: How to Wear Soft Foam Earplugs</a></li>
                    <li><a href="//wwwn.cdc.gov/niosh-sound-vibration/">CDC Power Tools Database</a>: sound specifications for various  types of power tools</li>
                    <li><a href="//buyquietroadmap.com/">NASA Education Auditory Research (EAR) Lab</a></li>
                    
                  </ul>
                  <p class="gallery" ><a href="../media/image/ohs_sign_hearing_prot.png" target="_blank"><img src="../media/image/ohs_sign_hearing_prot.png" alt="Sign: Hearing Protection Required"></a>
                  <a href="../media/image/ohs_scene_machine.jpg" target="_blank"><img src="../media/image/ohs_scene_machine.jpg" alt="Machinery"></a></p>
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