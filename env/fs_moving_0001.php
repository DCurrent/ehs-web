<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Environmental Management</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

<?php 
	$cLRoot 	= $cDocroot."env/"; 
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
		  <h1><a href="fact_sheets.php" title="Return to Fact Sheets.">Fact Sheet</a> - Guidelines for Moving Chemicals</font></h1>
		  <p>Transporting chemicals between buildings poses a potential risk to human health and safety, and to the environment. To help minimize this risk, Environmental Management (EM) will assist departments or laboratories with the transport of hazardous materials.

            <br />
            <br />
            All containers must have a secure, tight, non-leaking lid.

            <br />
            <br />
            All glass containers should be packed with newspaper or some other kind of cushioning to prevent breakage.

            <br />
            <br />
            Hazardous waste tickets should be filled out and sent to EM for all unacceptable containers (i.e. rusted or corroded). Do not move containers that are in poor condition.

            <br />
            <br />
            Incompatible chemicals should not be packed together. The following is a list of SOME incompatibles. This is not an all-inclusive list, so be sure to check out the MSDS if there are any questions.

            <br />
          </p>
		  <ul>
		    <li>            Cyanides and acids</li>
		    <li>Sulfides and acids</li>
		    <li>Oxidizers and organics or flammables		      </li>
		    <li>Strong acids and bases		      </li>
		    <li>Hydrazine and Oxidizers		      </li>
		    <li>Strong Acids or Bases and flammables		      </li>
		    <li>Acids and chlorine compounds</li>
		    <li> Water or air reactives and most everything</li>
	      </ul>
		  <p>		      All moves should be done during regular work hours  and should be coordinated with Environmental Management. 
		      
		      During the move, lab personnel must be present to assist EM. In addition, all cylinders must have their regulators removed and the manufacturer’s cap securely tightened.
		      
		      Before the move, offer “good” chemicals that are no longer needed to other people within your department. If they go unclaimed, please contact EM for recycling.
		      
	        For moves involving radioactive material, contact Radiation Safety at 7-6777.</p>
      </div>
	</div>
	<div id="sidePanel">
		<?php include("a_corner_image.php"); ?>
		<?php include($cLRoot."a_sidepanel.php"); ?>
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