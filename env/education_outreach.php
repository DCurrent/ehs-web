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
			<h2>Public Education and Outreach</h2>
			<p>The objective of this minimum control measure is to inform the University's community (i.e. staff, faculty and students) about the impact that they may have on water quality.  Examples of activities that are part of the University's Stormwater Quality Management Plan include:</p>
			<ul>
				<li>Develop and maintain a stormwater website, with public participation event notices, complaint reporting, personal pollution prevention tips, and contacts.				</li>
				<li>Develop educational materials and a distribution method for pond and stream riparian area management.				</li>
				<li>Include stormwater quality awareness activities in special University events.				</li>
				<li>Develop articles or news items on water quality for inclusion in locally distributed newsletters or newspapers and on the stormwater website.				</li>
				<li>Educate the community about how to identify an illicit discharge and how to report one.</li>
				<li><a href="/docs/pdf/env_fs_stormwater_custodial_cleaning_0001.pdf" target="_blank">Fact Sheet - Stormwater Pollution Prevention: Custodial Staff Cleaning Material</a></li>
				<li>Develop a survey for the community to complete to collect information on their understanding of how day to day activities impact water quality.</li>
			</ul>
		</div>
	</div>
	<div id="sidePanel">
	  <img src="/media/image/0039.jpg" /><br />		        	
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