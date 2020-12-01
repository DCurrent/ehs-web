<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Environmental Management</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

<?php 
	$cLRoot	= $cDocroot."env/"; 
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
			<h1>Hazardous Waste Management Online Training</h1>
			<p>To ensure safe and compliant practices, it is a University policy that those engaged in the generation of hazardous waste take initial training and annual refresher training thereafter.  Training can be accomplished on-line through an easy two step process:</p>
			<p><b>Step 1 –	</b>Review the <a href="../docs/pdf/emm_hazardous_waste_management.pdf">Hazardous Waste Management Training Manual</a> and a copy of the<a href="https://ehs.uky.edu/apps/rocky/media/material/uk_hazardous_waste_training.pdf" target="_blank"> training session PowerPoint presentaiton</a> to become completely familiar with the regulatory requirements and University guidelines.  If you have any questions do not hesitate to get in contact with our Environmental Affairs Compliance Manager who will gladly assist you.</p>
			<p><b>Step 2 –	</b>Take the appropriate on-line quiz based on the location of the waste generating process:</p>
		  <blockquote>
				<p><a href="/classes/classes_env_0001.php#hazardous_waste">"General" Hazardous Waste Management Quiz</a></p>
				<p>Required for all on or off-campus waste generating locations <b>except</b> those noted below:</p>
				<ul>
					<li>Veterinary Diagnostic Laboratory</li>
					<li>Center for Applied Energy Research</li>
					<li>Chemistry Department</li>
					<li>UK HealthCare (pharmacies and patient care areas)</li>
				</ul>
			  <p><a href="/classes/classes_env_0001.php#hazardous_waste">"Specific" Hazardous Waste Management Quiz</a></p>
			<p>Only required for the following waste generating locations:</p>
			  <ul>
				  <li>Veterinary Diagnostic Laboratory</li>
				  <li>Center for Applied Energy Research</li>
				  <li>Chemistry Department</li></ul></blockquote>
	The Environmental Management Department as well as the other departments in EHS, are available to provide classroom training if needed. Contact <a href="mailto:pquisenb@uky.edu">Peggy Quisenberry</a> at (859) 323-6280 for more information.<br />
			  <br />
		    For certain UK HealthCare patient care and pharmacy locations, a <a href="pharmaceutical_managment.php">Pharmaceutical Waste Management</a> training program is available and an associated quiz is required to be taken.  This training and quiz is available only on the UK HealthCare SharePoint site.  You should contact your supervisor to determine the applicability of this requirement.
		</div>
	</div>
	<div id="sidePanel">
		<img src="../media/image/header_img03.jpg" /><br />
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