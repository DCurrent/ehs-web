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
		  <h1><font size="4" face="arial"><a href="fact_sheets.php">Fact Sheet</a> - Management of Fluorescent Lighting Wastes</font></h1>
			<p> Federal and State regulations
   apply to fluorescent lighting waste due to minute quantities of mercury
  and other metals that may be present in spent fluorescent bulbs. The University
  of Kentucky will manage used unbroken fluorescent bulbs as &quot;Universal
  Waste&quot; under EPA regulations. These bulbs will be recycled as part of
  our continuing efforts in waste minimization. <span class="alert">Please note, low-mercury bulbs
  with green tips and/or green lettering on the tube do not require special handling.</span> </p>
          <p> <h2>What is Fluorescent Lighting Waste?</h2><br />
            <br />
            Fluorescent lighting waste refers to fluorescent lamp bulbs that are spent, burned
            out or have been removed due to their low level of efficiency. <span class="alert">Fluorescent
              bulbs
              may no longer be placed in the regular trash.</span> Unbroken fluorescent bulbs will
            be managed using the procedures described below. Broken or damaged fluorescent
            lamp bulbs must be treated as hazardous waste and will be managed under UK's
            Hazardous Waste Program. </p>
        <p> <h2>Managing Used Fluorescent Bulbs</h2><br />
              <br />
              Only properly trained maintenance personnel may change fluorescent bulbs.  The
              bulbs should be placed into shipping containers supplied by Environmental Management
              (EM). These containers will be stored on site until they are full. Full containers
              should be marked with magic marker or wax pencil with the words &quot;Universal
              Waste Fluorescent Light Bulbs,&quot; the number of bulbs in the container, and
              the building(s) where they originated. Maintenance personnel on campus should
              contact EM when containers are full to arrange pickup. Off campus sites should
            contact EM to make arrangements to have bulbs delivered to EM. </p>
          <p> <h2>Managing Broken or Damaged Fluorescent Bulbs</h2><br />
            <br />
            Broken or damaged bulbs will be treated as hazardous waste.  All debris from
            broken or damaged bulbs must be cleaned up and placed into a sealed bag. The
            bag should then be placed in a puncture-proof container (such as a cardboard
            box) and labeled &quot;Hazardous Waste&quot;. Use the <a href="waste_pick-up.php">E-Trax</a> system to request a pickup or contact <a href="mailto:brianbutler@uky.edu">Brian Butler</a>.</p>
</div>
	</div>
	<div id="sidePanel">
		<?php include("a_corner_image.php"); ?>
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