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
                    <h1>Indoor Air Quality</h1>
                  <p>The University of Kentucky is committed to providing work, study, and research environments that are free from recognized hazards, and to investigate complaints and concerns that may be related to poor indoor air quality (IAQ).</p>
                  <p>The University of Kentucky is committed to  providing work, study, and research environments that are free from recognized  hazards, and to investigate complaints and concerns that may be related to poor  indoor air quality (IAQ). </p>
<p>Though  specific regulations have not been developed for IAQ in the work place, there  are several consensus standards and recommendations that UK Occupational Health  &amp; Safety applies to IAQ concerns.   These include the following:</p>

				<ul>
				  <li>American Society of Heating, Refrigerating and Air-Conditioning  Engineers (ASHRAE) 62.1 – Ventilation for Acceptable Indoor Air Quality;</li>
				  <li>ASHRAE 55 – Thermal Environmental Conditions for Human Occupancy;</li>
				  <li>American National Standards Institute, Institute of Inspection,  Cleaning, and Restoration Certification (<a href="//www.iicrc.org/standards/">IICRC</a>)  S520 – Standard and Reference Guide for Professional Mold Remediation;</li>
				  <li>NYC Department of Health &amp; Mental Hygiene – Guidelines on Assessment  and Remediation of Fungi in Indoor Environments.</li>
				  </ul>
				<p>To request an IAQ investigation, please contact <a href="mailto:brent.webber@uky.edu">Brent Webber</a> at UK OHS: 859-257-7600.</p>
				<h2>Useful Links</h2>
				<ul>
				  <li>Fact Sheets: 
				    <ul>
				      <li><a href="../docs/pdf/ohs_fs_factors_affecting_iaq.pdf">Factors Affecting Indoor Air Quality</a></li>
				      <li> <a href="../docs/pdf/ohs_fs_mold_remediation.pdf">Mold Remediation</a></li>
				    </ul>
				  </li>
				  <li><a href="//www.epa.gov/iaq/largebldgs/i-beam/visual_reference/index.html">US EPA I-BEAM Visual Reference Modules</a>: Images of IAQ problems and solutions</li>
				  <li><a href="//www.acoem.org/AdverseHumanHealthEffects_Molds.aspx">American College of Occupational &amp; Environmental Medicine</a>: Adverse Human Health Effects Associated with Molds in the Indoor  Environment, 2011</li>
				  <li><a href="//www.epa.gov/iaq/pubs/careforyourair.html">US EPA Care for Your Air: A Guide to Indoor Air Quality</a></li>
				  <li><a href="//pollen.aaaai.org/nab/index.cfm?p=AllergenCalendar&stationid=41">Pollen and Mold Reports for Lexington, KY</a>: American Academy of Allergy Asthma &amp; Immunology</li>
				  <li><a href="//www.dehs.umn.edu/iaq_fib_fg_gloss.htm">Fungal Glossary</a> from the University of Minnesota EHS  Department</li>
				  <li><a href="../docs/pdf/ohs_national_toxicology_program_mold.pdf">National Toxicology Program: Mold</a></li>
				  <li><a href="../docs/pdf/ohs_epa_moisture_control_guidance.pdf" target="_blank">EPA Moisture Control Guidance for Building Design, Construction, and Maintenance</a></li>
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