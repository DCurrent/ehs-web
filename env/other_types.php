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
			<h1>Other Types of Waste</h1>
			<h2><a href="fs_light_0001.php">Fluorescent and Other Lamps</a></h2>
			<p>Certain light bulbs and lamps may contain toxic metals such as mercury which require special disposal. These light bulbs and lamps are regulated as universal waste lamps. Use the E-Trax system to request a pick up or contact <a href="mailto:brianbutler@uky.edu">Brian Butler</a></p>
			<h2>Mercury Thermometers</h2>
			<p>A mercury thermometer exchange program is available to help eliminate mercury and its associated health and environmental hazards. The mercury thermometer exchange program enables laboratories to exchange their intact mercury thermometers for non-mercury thermometers at no cost so as to:</p>
			<ul>
				<li>Reduce the health and environmental risks of mercury releases</li><br />
				<li>Prevent laboratory closures due to the clean-up of broken mercury thermometers</li><br />
				<li><a href="thermometer.php">Exchange mercury thermometers with non-mercury thermometers for FREE</a></li>
			</ul>
			<p>The non-mercury thermometers that are available free of charge meet accuracy standards established by the National Institute of Standards and Technology. To inquire about exchanging a thermometer call <a href="tel:1-859-323-6280">859-323-6280</a> or email <a href="mailto:pquisenb@uky.edu">Peggy Quisenberry</a>.</p>
			<h2>Gas Cylinders</h2>
			<p>Gas cylinders are used in some labs or shop areas. It is important to consider that these will need to be disposed at some point. Your purchasing decisions may drastically effect how much it costs to dispose of the cylinder when you are through with it. Use the E-Trax system to request a pick up of waste cylinders.</p>
			<h2><a href="./hmm/disposal.php">Sharps</a></h2>
			<p>[In development]</p>
			<h2>Biological</h2>
			<p>[In development]</p>
			<h2>Regulated Medical Waste</h2>
			<p>[In development]</p>
			<h2>Request to Dispose in Trash</h2>
			<p>[In development]</p>
			<p>&nbsp;</p>
		</div>
	</div>
	<div id="sidePanel">
	  <img src="../media/image/batteries.jpg" /><br />
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