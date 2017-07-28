<?php 

	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
 
	$cLRoot		= $cDocroot."env/";
	$cOutput	= NULL;		

	require($cDocroot."libraries/php/gen_query_0002.php");		//General select query parser.
	
	/* Verify user is authorized  */
	$oAcc->access_verify();
	
	$cOutput	= gen_query_0002("a_cred_master_0001", "SELECT 
			*		
			FROM vw_chem_recycle", NULL, 0);
?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Environmental Management</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

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
			<h1>Chemicals for Redistribution</h1>
			<p><?php echo $cOutput; ?>
		    </p>
		</div>       
	</div>    
	<div id="sidePanel">
		<?php include ($cLRoot."a_sidepanel_0001.php"); ?>
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