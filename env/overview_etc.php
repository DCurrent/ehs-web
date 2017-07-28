<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Environmental Management</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

<?php 
	$cLRoot		= $cDocroot."env/";
?>

</head>

<body>

<div id="container">
	<div id="mainNavigation">
		<?php include("../libraries/includes/inc_mainnav.php"); ?>
	</div>
	<div id="subContainer">
		<?php include($cLRoot."a_banner.php"); ?>
		<div id="subNavigation">
			<?php include("a_subnav.php"); ?>	
		</div>
		<div id="content">
			<h1>Wastewater Quality</h1>
			<h2>Overview</h2>
			<p>The University discharges wastewater through the sanitary sewer system to the Lexington- Fayette Urban County Government (LFUCG) Town Branch Wastewater Treatment Plant and then finally, along with other treated sewerage from the city, to Town Branch.  The University's discharge is authorized under an Industrial Users Wastewater Discharge Permit issued by the LFUCG.			</p>
		  <h1>Industrial User Wastewater Discharge Permit</h1>
			<p>The Industrial User Wastewater Discharge Permit is issued to the University from  LFUCG through authority from the Kentucky Division of Water and the US EPA as part of the Clean Water Act.  This Permit authorizes discharge from the University to the city's sanitary sewer system through specifically permitted outfalls.  The Permit requires semiannual monitoring events take place for several specific constituents as well as a calculation of corresponding flow rates all which must be reported to the city on a semiannual basis.  The Permit also authorizes LFUCG to periodically conduct unannounced sampling of the outfalls.  In addition to the specific prohibition of discharging wastewater exceeding specific effluent limitations, the Permit prohibits the discharge of:</p>
			<ul>
				<li>Pollutants with a flashpoint less than 140°F (60°C)</li><br />
				<li>Wastewater violating <a href="//www.lexingtonky.gov/index.aspx?page=1131">LFUCG Codes (Chapter 16)</a></li><br />
				<li>Wastewater violating State and Federal Pretreatment laws, regulations and standards</li>
			</ul>
			<p>Based on these general prohibitions,  at no time may any hazardous waste be disposed  in the University's sanitary sewer system.  The Permit authorization is for a period of three years, with the current permit effective until December 31, 2011.  Renewal is through an application and permit review process.</p>
			<h2>Discharge to Sewer</h2>
			<p>The University's Industrial User Wastewater Permit, local ordinances, and state and federal environmental regulations prohibit hazardous materials from being disposed  into the sewer system.  Unless specifically approved, all chemical products, paints, dyes, lawn care products, maintenance products, and oil is prohibited from drain disposal.  More details may be found in the Fact Sheet <a href="../docs/pdf/env_guide_for_drain_disposal.pdf" target="_blank">Guide for Drain Disposal</a>.</p>
			<p>Should there be a material requiring disposal that the user believes may be safe for drain disposal a request for review and approval may be submitted to the Eviromental Management Department for evaluation using the form <a href="../docs/pdf/env_drain_disposal_request.pdf" target="_blank">Drain Disposal Request</a>.</p>
			<p><b>No material should ever be disposed in the sanitary sewer at any time if it is not listed on the Guide for Drain Disposal Fact Sheet or that has not been specifically approved for disposal.</b></p>
			<p><b>Furthermore, nothing should ever be disposed into the drains located outside buildings.  These are storm drains that discharge directly to nearby creeks and streams.  To discharge material in these drains is a violation of State law and is a violation of the University's Stormwater Permit.</b></p>
		</div>
	</div>
	<div id="sidePanel">
        <img src="../media/image/lab_sink_0001.jpg" />
        <?php include($cLRoot."a_sidepanel.php"); ?>
	</div>
	<div id="footer">
		<?php include("../libraries/includes/inc_footer.php"); ?>
		
	</div>
</div>

<div id="footerPad">
<?php include("../libraries/includes/inc_footerpad.php"); ?>
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