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
			<h2>Construction Site Stormwater Runoff Control</h2>
			<p>The objective of this minimum control measure is to reduce the impact of construction site runoff on the waters of the Commonwealth, by using best management practices, both structural and non-structural, to prevent construction site pollutants from negatively impacting other MS4s and streams.  Examples of activities that are part of the University's Stormwater Quality Management Plan include:</p>
			<ul>
				<li>Develop contract language requiring contractors to implement Stormwater Pollution Prevention Plan (SWPPP) controls and obtain a Notice of Coverage from the Kentucky Division of Water.</li><br />
				<li>Perform inspection audits on construction sites on campus.</li><br />
				<li>Develop enforcement procedures for SWPPP violations.</li><br />
				<li>Develop an inspection and enforcement tracking mechanism.</li><br />
				<li>Review construction plans to ensure SWPPP measures are being incorporated for all projects disturbing 1 acre or more.</li><br />
				<li>Develop technical guidance materials for design that is at least as restrictive as Kentucky's General Construction Stormwater Permit.</li><br />
				<li>Develop SWPPP review checklists to address construction site runoff control on construction sites disturbing 1 acre or more.</li><br />
				<li>Have all staff reviewing plans or performing inspections attend erosion prevention and sediment control training.</li><br />
				<li>Educate contractors and designers on new contract requirements.</li>
			</ul>
<p>&nbsp;</p>
		</div>
	</div>
	<div id="sidePanel">
	  <img src="/media/image/0321.jpg" /><br />		        	
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