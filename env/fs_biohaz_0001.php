<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>Environmental Management; Biohazard Autoclave Bags</title>
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
		<?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
	</div>
	<div id="subContainer">
		<?php include($cLRoot."a_banner.php"); ?>
		<div id="subNavigation">
			<?php include("a_subnav.php"); ?>	
		</div>
		<div id="content">
		  <h1><font size="4" face="Arial"><a href="fact_sheets.php" title="Return to Fact Sheets.">Fact Sheet</a> - Biohazard Autoclave Bags</font></h1>
		  <p><font size="2" face="Arial, Helvetica, sans-serif">Autoclaving is a commonly
    used procedure for treating biohazardous (infectious) waste. The following
    bags are recommended for autoclaving infectious materials: <b>clear</b> or <b>orange</b> polyethylene plastic bags that are strong, pliable, lead and puncture resistant.
    A clearly visible biohazard symbol which darkens to show proper autoclaving
    temperature is also recommended. Acceptable autoclave bags may be obtained
    from UK Stores (Stock numbers for clear bags are: 8&quot;x12&quot;,
    6532-0041; 12&quot;x24&quot;, 6532-0042; 24&quot;x30&quot;, 6532-0043; 24&quot;x36&quot;,
    6532-0044). </font></p>
          <p><font size="2" face="Arial, Helvetica, sans-serif">See the <a href="/docs/pdf/bio_uk_biosafety_manual_0001.pdf" target="_blank">UK Biosafety Manual</a> for infectious waste guidelines and for a list of materials which must be rendered non-infectious by autoclaving. <b>Do not place needles, broken glass or other sharps in autoclave bags</b>.  Following autoclaving, these bags will be picked up by the custodial staff and disposed of with the regular trash.  Treated waste is considered solid waste and may be safely landfilled.  If waste cannot be treated it must be incinerated (see the <a href="/docs/pdf/bio_uk_biosafety_manual_0001.pdf" target="_blank">UK Biosafety Manual</a> for proper use of Red Bags).</font></p>
          <p align="center"><b><font size="2" face="Arial, Helvetica, sans-serif" class="alert">WARNING:  Red Bags must not be used for autoclaving!!!</font></b> </p>
          <p><b><font size="2" face="Arial, Helvetica, sans-serif">UK uses Red Bags to designate infectious waste that must be <i>incinerated</i>.</font></b><font size="2" face="Arial, Helvetica, sans-serif"> Red
            Bags should not be used for any other purpose. Do not use Red Bags for autoclaving
            infectious material and, regardless of their contents, do not place Red Bags
            in the regular trash for disposal. If Red Bags are dumped at the landfill,
            facility operators will call UK to come and get them. Since land filling infectious
            waste is against the law, this practice can result in regulatory action, fines,
            and even loss of landfill privileges.</font></p>
          <p><font size="2" face="Arial, Helvetica, sans-serif">Only Medical Center and Hospital custodians
            are trained to pick up Red Bags and take them to the Hospital incinerator
            room. Other Red Bags on Lexington
            campus must be picked up by Environmental Management. If Red Bags are observed
            in the regular trash, please notify Environmental Management immediately.</font></p>
      </div>
	</div>
	<div id="sidePanel">
		<?php include("a_corner_image.php"); ?>
        <?php include("a_sidepanel.php"); ?>
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