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
			<h1>Stormwater Quality Management Plan Overview</h1>
			<ul>
			  <li><a href="overview.php">Overview</a></li><br />
				<li><a href="education_outreach.php">Public Education and Outreach</a></li><br />
				<li><a href="involvement_participation.php">Public Involvement and Participation</a></li><br />
				<li><a href="detection_elimination.php">Illicit Discharge Detection and Elimination Activities</a></li><br />
				<li><a href="runoff_control.php">Construction Site Stormwater Runoff Control</a></li><br />
				<li><a href="new_redevelopment.php">Post-Construction Stormwater Management in New Development and Redevelopment</a></li><br />
				<li><a href="municipal_operations.php">Pollution Prevention/Good Houskeeping for Municipal Operations</a></li><br />
				<li><a href="permit_discharge.php">Kentucky Permit to Discharge from a Small Municipal Separate Storm Sewer System (MS4)</a></li><br />
				<li><a href="coverage_map.php">Map of the University of Kentucky MS4 Permit Coverage</a></li><br />
				<li><a href="fss_information.php">Faculty, Staff and Students Information</a></li><br />
				<li><a href="coordination_efforts.php">University of Kentucky/LFUCG Coordination Efforts</a></li><br />
				<li><a href="fact_sheets.php">Fact Sheets</a></li>
			</ul>
			<h3>New!</h3>
			<p>Recent  additions of stormwater quality best management practices on the Lexington  campus:</p>
			<blockquote>
			  <p><a href="//uknow.uky.edu/content/davis-marksbury-building-achieves-leed-gold-certification">David Marksbury Building</a></p>
		      <ul>
		        <li>Rain Garden</li>
	          </ul>
		      <p><a href="../docs/pdf/env_sw_ronaldmcdonald_0001.pdf" target="_blank">Ronald McDonald House</a></p>
	          <ul>
	            <li>Pervious Pavement</li>
	            <li>Bioretention</li>
              </ul>
		  </blockquote>
		</div>
	</div>
	<div id="sidePanel">
	  <img src="../media/image/sw_stream.jpg" /><br />		        	
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