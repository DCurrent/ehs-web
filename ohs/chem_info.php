<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Occupational Health &amp; Safety, Chemical/Flammables Info</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="/libraries/css/style.css" type="text/css" />

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
			<h1>Chemical/Flammables Info</h1>
		  <ul>
          <li><a href="//ntp.niehs.nih.gov/?objectid=72016262-BDB7-CEBA-FA60E922B18C2540">Carcinogenic 
            Compounds</a>  </li>
          <li><a href="https://www.etrax.uky.edu/Chematix">Chemical 
            Inventory Software</a> (UK Access Only)  </li>
          <li><a href="pregnant.html">Chemical 
            Use by Pregnant Laboratory Workers</a></li>
          <li><a href="cgc2.html">Compressed 
            Gas Cylinders</a></li>
          <li><a href="../docs/pdf/ohs_refrigerators.pdf" target="_blank">Flammable-safe 
            versus explosion-proof refrigerators</a></li>
          <li><a href="../docs/pdf/ohs_compatibility_guide.pdf" target="_blank">Incompatible 
            Chemicals</a></li>
          <li><a href="lablist.html">Laboratory 
            Self-Inspection Form Guidelines</a>  </li>
          <li><a href="//www.ilpi.com/msds/">MSDS</a></li>
          <li><a href="perchloric.htm">Perchloric 
            Acid Use</a></li>
          <li><a href="peroxide.htm">Peroxide 
            Forming Chemicals</a><a href="perchloric.htm"></a> </li>
          <li><a href="/docs/pdf/ohs_fs_piranha_solution_0001.pdf" target="_blank">Piranha Solution</a></li>
          <li><a href="../docs/pdf/ohs_mercaptans.pdf" target="_blank">Precautions 
            for Laboratories using Mercaptans</a></li>
          <li><a href="../docs/pdf/ohs_fshelife.pdf" target="_blank">Shelf 
            life of chemicals</a></li>
          <li><a href="storage.html">Storage 
            and Use</a><a href="cgc2.html"></a><a href="pregnant.html"></a></li>
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