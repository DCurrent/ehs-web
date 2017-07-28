<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Occupational Health &amp; Safety, Office Ergonomics</title>
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
			<h1>Office &amp; Laboratory Ergonomics</h1>
		  <h2>General Ergonomics</h2>
		  <ul>
		    <li><a href="/docs/pdf/ohs_lab_ergonomics_0001.pdf" target="_blank" class="link">Laboratory 
		      Ergonomics</a></li>
		    <li><a href="//www.osha.gov/SLTC/etools/hospital/hazards/ergo/ergo.html" target="_blank" class="link">HealthCare 
		      Ergonomics</a></li>
		    <li><a href="//www.cdc.gov/niosh/docs/2007-131" target="_blank" class="link">Material Handling/Back Safety</a></li>
		    <li><a href="material_handling.php">Safety Tips for Manual Material Handling</a></li>
	      </ul>
		  <h2>Office Ergonomics</h2>
          <ul>
            <li><a href="/docs/pdf/ohs_computer_workstation_ergonomics_cdc_0001.pdf" target="_blank" class="link">Computer Workstation Ergonomics (Center for Disease Control)</a>
             
            </li>
            <li><a href="../docs/pdf/ohs_laptop_ergonomic_tips_0001.pdf" target="_blank" class="link">Laptop  Ergonomics</a>
             
            </li>
            <li><a href="/docs/pdf/ohs_worker_checklist_0001.pdf" target="_blank" class="link">Office Self Checklist</a> 
             
            </li>
            <li><a href="//www.osha.gov/SLTC/etools/computerworkstations/index.html" target="_blank">OSHA Guidance for Computer Workstations</a></li>
            <li><a href="/docs/pdf/ohs_suggested_hardware_list_0001.pdf" target="_blank" class="link">Suggested Hardware</a> 
             
            </li>
          </ul>
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