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
			<h1>Controlled Substances in Research and Teaching Settings</h1>
			<p>The overall goal of the Controlled Substances Act (CSA) and of Drug Enforcement Administration's regulations in Title 21, Code of Federal Regulations (CFR), parts 1300-1316 is to provide a closed distribution system so that a controlled substance is at all times under the legal control of a person registered, or specifically exempted from registration, by the Drug Enforcement Administration (DEA) until it reaches the ultimate user or is destroyed. DEA achieves this goal by registering manufacturers, distributors, and dispensers of controlled substances. Thus, any movement of controlled substances between these registered persons is covered by DEA regulations.</p>
		  <p>Drugs used in research or teaching laboratories that meet the definition of a controlled substance must be managed in strict compliance with DEA requirements including how they are to be managed once they are no longer needed or if their useful life has expired. To use a controlled substance at the University requires that licensing on an individual basis (i.e. there is not a centralized licensing and drug purchasing system available). More information on licensing can be found on the US DEA's website. At this time, therefore, the resolution of any remaining portions of the controlled substance is the responsibility of the licensed individual or department. A Reverse Distributor is most often used for this purpose. Environmental Management Department personnel are not DEA registered and, therefore, cannot collect, hold or dispose of controlled substances. However, if you become aware of  a controlled substance that has been discovered and is unclaimed by any current staff or faculty member (i.e., "orphaned"), please contact the Environmental Management Department for the appropriate guidelines to follow.</p>
			<p>While the UK HealthCare sectors will obviously deal with controlled substances on a regular basis, there are policies in effect that address their proper handling.  If you work in UK HealthCare please consult these policies or contact the applicable pharmacy representative.</p>
		</div>
	</div>
	<div id="sidePanel">
	  	<img src="../media/image/pill_bottle_and_pills1.jpg" /><br />
		<?php include("a_sidepanel.php"); ?>
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