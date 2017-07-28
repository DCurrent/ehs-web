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
			<h2>Public Involvement and Participation</h2>
			<p>The objective of this minimum control measure is to engage the University community in an active role in both the development and implementation of its stormwater management program.  The community will be able to provide valuable input into stormwater management activities which will be integral to the overall success of the program because of the additional support, expertise and resources brought to bear.  Examples of activities that are part of the University's Stormwater Quality Management Plan include:</p>
			<ul>
				<li>Identify the number of storm drains that do not have the "No Dumping" label or stamp.  Develop a tracking methodology to identify areas for volunteers to perform storm drain labeling.</li>
				<li>Develop a handout for volunteers on the purpose of storm drain labeling, how to place the decals or labels, and how to document the storm drains that have been labeled.</li>
				<li>For existing drains that do not have a "No Dumping" label, work with campus groups to mark storm drains within the MS4 Permit boundary.</li>
			</ul>
			<p><center>
			  <img src="../media/image/em_storm_markers_0001.jpg" alt="Storm markers" width="399" height="197" />
	      </center></p>
        </div>
	</div>
	<div id="sidePanel">
	  <img src="/media/image/sw_drain.jpg" /><br />		        	
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