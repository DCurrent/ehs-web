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
			<h1>Waste Pick-Up Service</h1>
			<p>One of the primary functions of the Environmental Management Department is to manage the University's permitted hazardous waste storage and treatment facility located at the <a href="eqmc.php">Environmental Quality Management Center (EQMC)</a>.  Most of the waste generated by the research and teaching laboratories (as well as other University sectors) is brought to this 11,000 sq. ft. facility for consolidation prior to its final shipment to an off-site commercial disposal or treatment facility.</p>
			<p>The Environmental Management Department manages a web-based waste tracking system known as E-Trax.  As a critical component of the University's regulatory compliance strategy, E-Trax provides a proficient and speedy means for those who generate waste to ensure its safe and timely pick-up by trained personnel.  If you have the required training in place, simply access the E-Trax website by clicking the icon below, fill in the requested information, submit it to us using the prescribed notification process and within five (5) working days your waste will be picked up from your on or off-campus location.</p>
			<p align="center"><a href="//www.etrax.uky.edu/" target="_blank"><img src="../media/image/etrax.jpg" alt="Link to E-Trax login." /></a></p>
			<p>If you have not used E-Trax before or need a reminder of certain aspects of the service, a convenient <a href="../docs/pdf/emm_etrax_user_training_manual_0001.pdf">E-Trax User's Guide</a> is available.</p>
			<p>Annual Hazardous Waste training is required for those responsible for any aspect of its management. Click on our "<a href="hazardous_training.php">Hazardous Waste Management Training</a>" page for more information.</p>
		</div>
	</div>
	<div id="sidePanel">
  <img src="../media/image/0154.jpg" /><br />
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