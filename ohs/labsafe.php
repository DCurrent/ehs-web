<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Occupational Health &amp; Safety</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

<link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />

<?php 
	$cLRoot		= $cDocroot."ohs/";
?>

</head>

<body>

<div id="container">
	<div id="mainNavigation">
		<?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
	</div>
	<div id="subContainer">
		<?php include($cLRoot."a_banner_0001.php"); ?>
		<div id="subNavigation">
		 	<?php include($cLRoot."a_subnav_0001.php"); ?> 
		</div>
		<div id="content">
			<h1>Laboratory Safety</h1>
			<ul class="cols two">
			  <li><a href="#chemical_flammables">Chemical / Flammable Info</a></li>
			  <li><a href="#chemical_hood_info">Chemical Hood</a></li>
			  <li><a href="chp">Chemical Hygiene</a></li>
 			  <li><a href="#glove_selection">Glove Selection</a></li>
			  <li><a href="#lab_setup" class="no_icon">Lab Design &amp; Emergency Equipment</a></li>
			  <li><a href="inspections.php">Lab Inspection Examples</a></li>
			  <li><a href="#training">Training</a></li>
			  <li><a href="#useful_links">Useful Links</a></li>
          </ul>
			<h2 id="chemical_flammables">Chemical / Flammables Info</h2>
			<ul>
			  <li><a href="//ntp.niehs.nih.gov/?objectid=72016262-BDB7-CEBA-FA60E922B18C2540">Carcinogenic               Compounds</a></li>
			  <li><a href="https://www.etrax.uky.edu/Chematix">Chemical               Inventory Software</a> (UK Access Only) </li>
			  <li><a href="pregnant.php">Chemical               Use by Pregnant Laboratory Workers</a></li>
			  <li><a href="cgc2.html">Compressed               Gas Cylinders</a></li>
			  <li><a href="../docs/pdf/ohs_refrigerators.pdf">Flammable-safe               versus explosion-proof refrigerators</a>
			   
		      </li>
			  <li><a href="../docs/pdf/ohs_compatibility_guide.pdf">Incompatible               Chemicals</a>
			   
		      </li>
			  <li><a href="lablist.html">Laboratory               Self-Inspection Form Guidelines</a></li>
			  <li><a href="//www.ilpi.com/msds/">MSDS</a></li>
			  <li><a href="perchloric.htm">Perchloric               Acid Use</a></li>
			  <li><a href="peroxide.htm">Peroxide               Forming Chemicals</a></li>
			  <li><a href="../docs/pdf/ohs_mercaptans.pdf">Precautions               for Laboratories using Mercaptans</a>
			   
		      </li>
			  <li><a href="../docs/pdf/ohs_fshelife.pdf">Shelf               life of chemicals</a>
			   
		      </li>
			  <li><a href="storage.html">Storage               and Use</a></li>
		  </ul>
			<h2><a name="chemical_hood_info" id="chemical_hood_info"></a>Chemical Hood Information</h2>
			<ul>
			  <li><a href="/classes/classes_ohs_0001.php#chemical_hygiene">Chemical 
          Hood Safety</a></li>
			  <li><a href="flowmonitor.php">Fume 
          Hood Guide</a></li>
			  <li><a href="fumehood.php">Technical and Performance Standard: Chemical Hoods</a></li>
		  </ul>
			<p><a name="glove_selection" id="glove_selection"></a><h2>Glove Selection</h2></p>
			<ul>
			  <li><a href="../docs/pdf/ohs_diamond_grip.pdf">Diamond 
			    Grip Compatibility Chart</a>
               
              </li>
			  <li><a href="genppe.html">General 
			    Personal Protective Equipment Guide</a></li>
			  <li><a href="gloves.php#glove_selection">Glove 
			    Selection</a></li>
			  <li><a href="gloves.php#glove_use">Glove 
		      Use</a></li>
			  <li><a href="gloves.php#glove_links">Links 
			    to Glove Selection</a></li>
			  <li><a href="//www.microflex.com/distributor/media/image/support/misMaterials/miscpdfs/ChemChartLatexNitrile.pdf">Microflex 
			    Compatibility Chart</a> 
			   
			  </li>
		  </ul>
			<h2><a name="lab_setup" id="lab_setup"></a>Lab Design And Emergency Equipment (lab setup)</h2>
			<ul>
			  <li><a href="/docs/ohs/chp/chemical_hygiene_plan.pdf">Chemical Hygiene Plan</a></li>
			  <li><a href="/docs/pdf/ohs_ansi_2004.pdf">Eyewash and Safety Shower, 
              ANSI Standards</a></li>
			  <li><a href="eyewash.php">Eyewash and Safety Shower 
			    Guidelines</a></li>
			  <li><a href="fumehood.php">Fume Hood Guidelines</a></li>
			  <li><a href="labdesign.php">Laboratory Design Guidelines</a></li>
			  <li><a href="../exit.php">Lab Exit Checklist</a></li>
			  <li><a href="../apps/lab_sign">Laboratory
              Sign Template</a></li>
			  <li><a href="#training">Training</a></li>
		  </ul>
			<h2><a name="training" id="training"></a>Training</h2>
			<ul>
			  <li><a href="/classes">Chemical               Hygiene Plan/Laboratory Safety Class</a></li>
			  <li><a href="/classes/safe_checklist_lab_0001.php">Health               &amp; Safety Training Checklist for Labs</a></li>
			  <li><a href="video.html">Video               Lending Program</a>: order your video online			</li>
		  </ul>
			<h2><a name="useful_links" id="useful_links"></a>Useful Links</h2>
			<ul>
			  <li>Sources of Hazard               Data for Laboratory Chemicals
			    <ul>
			      <li><a href="hazinfo_printed.html">Printed                   Material</a></li>
			      <li><a href="hazinfo.html">On-line                   Information</a></li>
		        </ul>
		      </li>
			  <li><a href="//www.hhmi.org/science/labsafe/lcss/">Laboratory               Chemical Safety Summaries</a></li>
			  <li><a href="alerts.html">Lab               Safety Alerts</a></li>
			  <li><a href="//www.ilpi.com/msds/index.html">MSDS               Page</a></li>
			  <li><a href="//www.osha-slc.gov:80/OshStd_data/1910_1450.html">OSHA               Laboratory Standard</a></li>
			  <li><a href="//www.nap.edu/readingroom/books/prudent/">Prudent               Practices in the Lab</a> (NAS) </li>
			  <li><a href="/docs/pdf/ohs_erg_ergonomics_guide_0001.pdf" target="_blank">Laboratory               Ergonomics</a></li>
			  <li><a href="pregnant.php">Chemical Use by Pregnant Laboratory Workers</a></li>
		  </ul>
</div>       
	</div>    
	<div id="sidePanel">		
		<?php include($cLRoot."a_sidepanel_0001.php"); ?>		
	</div>
	<div id="footer">
		<?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
	</div>
</div>

<div id="footerPad">
<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
</div>
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