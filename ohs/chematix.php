<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Occupational Health &amp; Safety</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

<link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />

<?php 
	$cLRoot		= $cDocroot."ohs/";
?>
</head>

<body>

<div id="container">
	<div id="mainNavigation">
		<?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
	</div>
	<div id="subContainer">
		<?php include($cLRoot."a_banner_0001.php"); ?>
		<div id="subNavigation">
		 	<?php include($cLRoot."a_subnav_0001.php"); ?> 
		</div>
		<div id="content">
			<h1>Chematix Chemical and Waste Management System</h1>
			<p><a href="https://www.etrax.uky.edu/Chematix/">Chematix</a> - Link to Chematix site where you can add inventory items, create hazardous waste cards, manage personnel etc.</p>
			<p><a href="/docs/pdf/ohs_chematix_user_guide_0001.pdf" target="_blank">Chematix User Guide</a></p>
			<p><a href="#faq">Frequently Asked Questions</a></p>
			<h2>Training Videos</h2>
			<h3><a name="searchdb" id="searchdb"></a>Searching The Chematix Database</h3>
			<p><iframe title='Searching The Chematix Database' src='//www.youtube.com/embed/eD1LEUCLplo' frameborder='0' wmode='Opaque'></iframe></p>
			<h3><a name="createcard" id="createcard"></a>Creating a Waste Card By Percent Composition</h3>
			<p><iframe title='Creating a Waste Card By Percent Composition' src='//www.youtube.com/embed/ngAd_Y46QL4' frameborder='0' wmode='Opaque'></iframe></p>
			<h2><a name="faq" id="faq"></a>Frequently Asked Questions</h2>
			<h3>Q: We already have an inventory system in place. Can we import our system into Chematix?</h3>
            <p>A: Yes, you can import your current chemical inventory using MS Excel. Please contact Chematix support at 257-4016 for assistance.</p>
            <h3>Q: Can we use our existing barcodes with Chematix?</h3>
            <p>A: No. Chematix barcodes are specific and unique to the container it is on. There is no way to ensure that non-Chematix barcodes are unique.</p>
            <h3>Q: How do I remove an inventory item that was consumed in an experiment?</h3>
            <p>A: See <a href="/docs/pdf/ohs_chematix_user_guide_0001.pdf#page=21" target="_blank">page 21 of the Chematix User Guide</a>.</p>
            <h3>Q: I can't log in to Chematix. What is the problem?</h3>
            <p>A: Use your linkblue  credentials to access Chematix/Etrax, however, you must first take the  appropriate Hazardous waste training class before you can access Chematix/Etrax  (see <a href="../classes/classes_env_0001.php#hazardous_waste">here</a>).  Once you have passed the class, your supervisor must add you to the specific  labs that you need access to. If you are having trouble with your linkblue  credentials, check the <a href="//www.uky.edu/UKHome/subpages/linkblue.html">linkblue Account Manager</a>. If you have completed the  above steps and are still having trouble with Chematix, contact <a href="mailto:trobert@uky.edu">Robert Thomas</a> at  257-4016 or <a href="mailto:brianbutler@uky.edu">Brian  Butler</a> at 323-5005.</p>
<h3>Q: How do I add a new chemical into Chematix?</h3>
            <p>A: See <a href="/docs/pdf/ohs_chematix_user_guide_0001.pdf#page=12" target="_blank">page 12 of the Chematix User Guide</a>.</p>
            <h3>Q: How do I create a waste card?</h3>
            <p>A: See the &quot;<a href="#createcard">Creating a Waste Card by Percent Composition</a>&quot; video above.</p>
            <h3>Q: My chemical is not in the Chematix CAD, what do I do?</h3>
            <p>A: See <a href="/docs/pdf/ohs_chematix_user_guide_0001.pdf#page=15" target="_blank">page 15 of the Chematix User Guide</a>.</p>
</div>       
	</div>    
	<div id="sidePanel">		
		<?php include($cLRoot."a_sidepanel_0001.php"); ?>		
	</div>
	<div id="footer">
		<?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
	</div>
</div>

<div id="footerPad">
<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
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