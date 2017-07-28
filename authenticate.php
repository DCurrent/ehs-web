<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
	
	if(isset($_GET['logoff']))
	{
		$oAcc->logoff();		
		header('Location: '.ACCESS_SETTINGS::AUTHENTICATE_URL);
	}
	else
	{
		$oAcc->login();
	}
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        <link rel="stylesheet" href="libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="libraries/css/print.css" type="text/css" media="print" />
    </head>
    
    <body>
    
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--mainNavigation-->
            <div id="subContainer">
                <?php include($cDocroot."a_banner_0001.php"); ?>
                <div id="subNavigation">
                    <?php include($cDocroot."a_subnav_0001.php"); ?> 
                </div><!--/subContainer-->
                <div id="content">
                    <h1>Log In</h1>
                                
                    <?php if ($oAcc->get_dialog()){ echo "<p>".$oAcc->get_dialog()."</p>"; } ?>
                    
                    <form method="post" name="main" id="main">
                        <fieldset id="credentials">
                        	<legend>Credentials</legend>
                            
                            <label for="auth_account">Account</label>
                            <input type="text" name="auth_account" id="auth_account" placeholder="Account Name" required />
                            
                            <label for="auth_password">Password</label>
                            <input type="password" name="auth_password" id="auth_password" placeholder="Account Password" required />                         
                        </fieldset> 
                        
                        <button type="submit" name="login" id="login">Log In</button>
                                                      
                    </form>
                    
                    
                    <h3>Note For Non UK Personnel</h3>
                    <p>If you are attempting to access an <a href="classes/">EHS Training Module</a> and do not have a <a href="http://www.uky.edu/UKHome/subpages/linkblue.html">Link Blue account</a>, please contact <a href="mailto:kmcgu1@uky.edu">Kathryn Childress</a> at <a href="tel:+18592579730">859-257-9730</a> or <a href="mailto:rdeldr0@uky.edu">Rachel Eldridge</a> at <a href="tel:+18592571376">859-257-1376</a>.</p>
                    
              	</div><!--/content-->
            </div><!--/subContainer-->
            <div id="sidePanel">		
            	<?php include($cDocroot."a_sidepanel_0001.php"); ?>			
            </div><!--/sidePanel-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--/container-->
        
        <div id="footerPad">
        	<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--/footerPad-->
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
