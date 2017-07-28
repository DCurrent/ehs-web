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
			<h1>University of Kentucky/LFUCG Coordination Efforts</h1>
			<p>Just as the University is responsible for the management of stormwater discharged from the approximately 600 acres of its main campus as is outlined in its MS4 Permit, the city of Lexington is likewise responsible for regulating the quality of stormwater from public and private sources from within Lexington/Fayette County through its MS4 Permit.</p>
			<p>The University and the city have on-going and active discussions in which all aspects of the respective MS4 Permits are coordinated.  For example, the University has been invited to take part in the city's Watershed Stakeholders Roundtable, groups which meets regularly to discuss and coordinate stormwater quality sampling and laboratory analytical techniques.</p>
			<p>The University and city officials are also presently discussing the composition of a Memorandum of Understanding that will serve as a guide for on-going coordination efforts.  This document will be posted on this website when it becomes final.</p>
		</div>
	</div>
	<div id="sidePanel">		        	
		<?php
			include("a_corner_image.php"); 
            include($cLRoot."a_sidepanel.php");
        ?>		
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