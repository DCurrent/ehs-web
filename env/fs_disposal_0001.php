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
		  <h1><a href="fact_sheets.php" title="Return to Fact Sheets.">Fact Sheet</a> - Disposal of Needles, Syringes, Other Sharps and Broken Glass</font></h1>
		  <p>The
    term &#8220;sharps&#8221; refers to needles, syringes, scalpel blades, lancets,
    disposable medical instruments, broken glass and similar devices or materials
    with the potential to cut or puncture an individual as they are sent through
    the waste stream.</font></p>
          <h2> Needles, Syringes and Other Sharps</h2>
          <p>Used needles, syringes
            and other sharps must be placed into rigid, red plastic sharps containers.
            Needles should not be removed from syringes. Do not cut, bend or recap
            needles.
            This policy applies to <b>ALL</b> needles and syringes, whether (a) used or unused,
            (b) used together or separately, (c) used with blood or (d) <em>used for any
              other purpose</em>. Approved sharps containers may be obtained from UK Stores
            (stock number 6515-5265). When the container is full, secure the lid. (Don&#8217;t
            overfill containers and risk getting stuck!) Containers must be disposed
            of as medical waste&#8212;whether contaminated or not&#8212;and never placed
            in the regular trash. Contact Environmental Management if you need assistance
            disposing of medical waste in your area.</p>
          <h2> Broken Glass and Laboratory Glassware</h2>
          <p><b>ALL</b> broken glass
            must be placed into a separate waste container. Never place broken glass
            into the regular trash container. The waste glass container itself will be
            disposed of along with the broken glass. Acceptable containers for broken
            glass include small (1 to 2 cu. ft.) cardboard boxes with plastic liners,
            empty plastic paint cans, or any similar puncture-proof, leak-resistant containers.
            Cardboard boxes made especially for broken glass may be obtained from UK
            Stores (stock numbers: 5121-1797 large box; 5121-1798 small box; 5121-1801
            plastic liner large; 5121-1803 plastic liner small). Waste glass containers
            should be labeled &#8220;Caution--Broken Glass.&#8221; When full, put the
            top on the container and secure with tape. Custodians will place the whole
            container into the general waste stream.</p>
          <p><b>ALL</b> laboratory glassware&#8212;whether
            broken or unbroken&#8212;must be disposed of as described above. This applies
            to all glass items from medical, research and teaching labs and includes
            containers, pipettes, tubing, glass slides, cover slips, etc.</p>
          <p>Glassware which may be contaminated 
            with infectious agents should first be autoclaved or chemically disinfected, 
            and then disposed of as above.</p>
      </div>
	</div>
	<div id="sidePanel">
		<?php include("a_corner_image.php"); ?>
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