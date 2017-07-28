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
			<h1>Pharmaceutical Waste Management</h1>
			<p>In cooperation with UKHealthCare, the Environmental Management Department has developed a waste management program that has been uniquely tailored to meet the needs of this University sector.  The program considers that fact that some drugs may possess certain inherent characteristics such that when they are disposed or otherwise become unusable they meet the definition of a hazardous waste.  Therefore, specific measures have been established within the Medical Center complex and at Kentucky Clinic locations that facilitate the safe and convenient collection of such pharmaceutical wastes.</p>
			<p>In addition to those pharmaceuticals that strictly meet the qualifications of a hazardous waste, the University realizes that there are some drugs that possess a sufficient level of toxicity or potential harm to human health or the environment that they warrant special consideration even though they may not meet the strict definition of hazardous waste.  These so-called "equivalent" hazardous waste pharmaceuticals, which include most of the chemotherapy agents used at the UKHealthCare units, are also required to be managed within the context of the pharmaceutical hazardous waste management program.</p>
		  <p>If you have additional questions concerning the management of pharmaceutical wastes, you can contact the Environmental Management Department.  UKHealthCare has established their own web-based training program for their staff.  So please contact your supervisor to determine the applicability of taking such training.</p>
			<p>If you are a UK HealthCare staff and require the pick up of a pharmaceutical waste container from your unit please contact us at (859) 323-5005 or contact <a href="mailto:brianbutler@uky.edu">Brian Butler</a>.</p>
		</div>
	</div>
	<div id="sidePanel">
	  <img src="../media/image/facility_wethington.jpg" /><br />
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