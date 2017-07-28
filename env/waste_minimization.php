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
			<h1>Waste Minimization</h1>
			<p>Waste minimization is a national policy specifically mandated by the U.S. Congress in a 1984 amendment to the national hazardous waste law, the Resources Conservation and Recovery Act. Consistent with national and State policy and the University's hazardous waste management permit and registration, hazardous wastes are expected to be minimized to the extent possible. Some methods to be used are:</p>
			<ul>
				<li>Quantity and Source Reduction</li><br />
				<li>Recycling</li><br />
				<li>Substitution</li><br />
				<li>Treatment</li>
			</ul>
			<p>Reducing the generation and quantity of hazardous wastes will assist in reducing disposal costs, liability, and support the University's environmental stewardship and Sustainability efforts.</p>
			<p>The annual report reviewing the details of the most current Waste Minimization process may be viewed at</p>
			<p><a href="../docs/pdf/wasminihmm.pdf" target="_blank">Waste Minimization Process Review - 2009</a>
			<p>For more information call 257-3129 or email <a href="mailto:ron.taylor@uky.edu">Ron Taylor</a>.</p>
		</div>
	</div>
	<div id="sidePanel"> <a href="../media/image/0136.jpg"><img src="../media/image/header_img04.jpg" /></a><br />
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