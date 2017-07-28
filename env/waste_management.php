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
			<h1>Waste Management</h1>
			<ul>
				<li><a href="waste_pick-up.php">Waste Pick-Up Services</a></li><br />
				<li><a href="hazardous_training.php">Hazardous Waste Management Training</a></li><br />
				<li><a href="pharmaceutical_managment.php">Pharmaceutical Waste Management</a></li><br />
				<li><a href="controlled_substances.php">Controlled Substances in Research and Teaching Settings</a></li><br />
				<li><a href="other_types.php">Other Types of Waste</a></li><br />
				<li><a href="waste_minimization.php">Waste Minimization</a></li><br />
				<li><a href="chemical_redistribution.php">Chemical Redistribution</a></li><br />
				<li><a href="laboratory_close-out.php">Laboratory Close-Out</a></li><br />
				<li><a href="fact_sheets.php">Fact Sheets</a></li>
			</ul>
		</div>
	</div>
	<div id="sidePanel">
		<img src="../media/image/0102.jpg" /><br />
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