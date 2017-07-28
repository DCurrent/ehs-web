<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Environmental Health And Safety</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="libraries/css/style.css" type="text/css" />
<link rel="stylesheet" href="libraries/css/print.css" type="text/css" media="print" />
<?php
/*User authorization*/	
auth_verify_0001();

?>
</head>

<body>

<div id="container">
	<div id="mainNavigation">
		<?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
	</div>
	<div id="subContainer">
		<?php include("a_banner_0001.php"); ?>
		<div id="subNavigation">
		 	<?php include("a_subnav_0001.php"); ?> 
		</div>
		<div id="content">
			<h1>EHS Control Panel</h1>
		  <p>This page provides direct access to administration areas of the EHS web portal.</p>
		  <h2> Incident Reporting</h2>
<p>Fire Log</p>
<p><a href="ohs/form6_admin_0001.php">Form 6 (accident reporting)</a></p>
<h2>Other</h2>
		  <p>EHS Staff</p>
		  <p><a href="objcodes_admin.php">Object Codes</a></p>
		  <p><a href="authenticate_reg.php">EHS Account Creation</a></p>
		  <h2>Training</h2>
          <p><a href="classes/admin/index.php">Class Modules</a></p>
          <p><a href="classes/participant_list.php">Class Participant List</a></p>
          <p><a href="classes/manual_entry.php">Manual Participant Entry</a></p>
      </p>
	  </div>       
	</div>    
		<div id="sidePanel">		
			<?php include($cDocroot."a_sidepanel_0001.php"); ?>		
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