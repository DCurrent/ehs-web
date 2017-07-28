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
			<h1>Chemical Redistribution</h1>
			<p>The Environmental Management Department occasionally receives unopened, unwanted chemicals from laboratories on campus.  These chemicals are evaluated for the possibility of being reused in other areas of the University.  Materials received in originally sealed containers that are not photosensitive, temperature sensitive, and not expired are available to be claimed  only by University faculty or staff and only for University work or research.  This process is a part of our Waste Minimization Process which reduces the amount of waste disposed of as hazardous waste.</p>
			<p>If you have a chemical that you would like to make available for the Chemical Redistribution program or to request an available chemical from our stock, please click on <a href="../hmm/chemrecycle.html">Free Chemicals List</a>.  Environmental Management Department personnel will pick up or deliver the chemical to any on-campus location.</p>
		</div>
	</div>
	<div id="sidePanel">
		<img src="../media/image/header_img04.jpg" /><br />
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