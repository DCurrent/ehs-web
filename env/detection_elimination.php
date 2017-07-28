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
			<h1>Stormwater Qualty</h1>
			<h2>Illicit Discharge Detection and Elimination Activities</h2>
			<p>The objective of this measure is to ensure that the University community has a thorough awareness of their storm sewer system.  Such awareness will address identifying and eliminating illicit discharges, and the establishment of administrative regulations, technical policies and applicable educational forums needed to eliminate such discharges.  Examples of activities that are part of the University's Stormwater Quality Management Plan include:</p>
			<ul>
				<li>Develop an administrative regulation prohibiting non-stormwater discharges and illegal dumping and ensure its distribution to faculty, staff and students.</li><br />
				<li>Continually refine the map of all known major outfalls and streams within the University's MS4 Permit boundary.</li><br />
				<li>Develop and train staff on a field protocol for visually inspecting outfalls.</li><br />
				<li>Develop data collection policies prior to screening and visually inspect known outfalls from the main campus.</li><br />
				<li>Develop procedures to remove illicit discharges, if found, and if reported through the website and reporting hotline.  Procedures will include immediate response for violations deemed to be emergencies and coordination with the appropriate authorities when discharges are considered severe.</li><br />
				<li>Educate staff about how to identify an illicit discharge and how to report one.</li><br />
				<li>Develop and maintain fact sheets/written guidelines.</li><br />
				<li>Develop an illicit discharge tracking program to track its effectiveness.</li>
			</ul>
		</div>
	</div>
	<div id="sidePanel">
	  <img src="/media/image/1083.jpg" /><br />		        	
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