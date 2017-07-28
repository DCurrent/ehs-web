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
			<h1>Faculty, Staff and Students</h1>
			<h2>Stormwater Pollution Prevention Tips</h2>
			<ul>
				<li>Wash department vehicles only at Parking and Transportation or at a commercial car wash.</li><br />
				<li>Dispose of cleaning water into sanitary sewer drains only. If chemicals are present, however, refer to the <a href="overview_etc.php">Drain Disposal Request</a>.</li><br />
				<li>Ensure all laboratory waste and hazardous waste is disposed of properly. </li><br />
				<li>Make sure students doing research have been trained in proper laboratory techniques and waste disposal requirements. Make sure the students understand potential problems which may arise as a result of chemical interactions or accidentally mixing the wrong chemicals. Visit the Occupation Safety and Health website for information on safe laboratory practices.</li><br />
				<li>If you are interested in volunteering for campus clean-up or storm drain marking events, contact the Environmental Management Department at 323-6280.</li>
			</ul>
			<h2>Related Links</h2>

          <h3>Documents</h3>
          
		    (Coming Soon)
				<h3>General</h3>
<a href="//kywater.net/wolfrun/">Friends of Wolf Run</a><br />
		  <a href="//www.uky.edu/WaterResources/">UK Kentucky Water Resources Institute</a><br />
		  <a href="//www.uky.edu/KGS/">Kentucky Geological Survey (KGS)</a><br />
		  <a href="//www.sustainability.uky.edu/">UK Sustainability Committee </a>
		  </p>
		  
		  <h3>
			Regulatory</h3>
		  <p><a href="//cfpub.epa.gov/npdes/home.cfm?program_id=6">Environmental Protection Agency - Stormwater Program</a><br />
		    <a href="//kydep.wordpress.com/">Kentucky  Dept. for Environmental Protection&rsquo;s <em>Naturally  Connected</em></a><br />
		    <a href="//water.ky.gov/Pages/default.aspx">Kentucky Division Water</a><br />
		    <a href="//www.lexingtonky.gov/index.aspx?page=2598">Lexington-Fayette Urban County Government – Stormwater Program</a></p>
			<h3>
        Pollution prevention tips and information</h3>
			<p>				(Coming Soon)</p>
      </div>
	</div>
	<div id="sidePanel">
	  <img src="/media/image/0917.jpg" /><br />		        	
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