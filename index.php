<?php 

	/*
	* Global configuration file.
	*/
	require($_SERVER['DOCUMENT_ROOT']."/libraries/config.php"); //Basic configuration file. 

	/*
	* Start page caching.
	*/
	$dc_prudhoe_cache_control = new \dc\prudhoe\PageCache();
?>

<!DOCtype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>UK - Environmental Health And Safety</title>        
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" />
		<link rel="stylesheet" href="libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="libraries/css/print.css" type="text/css" media="print" />
		
    </head>
    
    <body>    
        <div id="container">            
            <div id="mainNavigation">
                <?php // include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->            
            <div id="subContainer">                            
				<?php include("a_banner_0001.php"); ?>                               
                <div id="subNavigation">                
                    <?php include("a_subnav_0001.php"); ?>                     
                </div><!--/subNavigation-->                
                <div id="content">                
                    <h1>Welcome</h1>                      
                    <p>Welcome to the University of Kentucky's Environmental Health And Safety Division. UK safety begins with you!</p>                     
                    <h2>Our Mission</h2>                      
                    <p>The EHS Division supports the University's teaching, research, and public service mission by promoting a safe, healthful, clean, and accessible campus environment.</p>
                    <p>The Division's  programs are intended to provide safe and healthy conditions for work   and study, protect the environment, and comply with applicable laws and regulations. The Division serves the University community by providing   technical services, education and training, periodic audits, and   compliance assistance.</p>
                     
                    <?php include($_SERVER['DOCUMENT_ROOT']."/libraries/includes/inc_updates.php"); ?>
              	</div><!--/content-->                      
            </div><!--/subContainer-->
            
            <div id="sidePanel">
                <?php // include($cDocroot."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            
            <div id="footer">
                <?php include($_SERVER['DOCUMENT_ROOT']."/libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--container-->
        
        <div id="footerPad">
        	<?php // include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--/footerPad-->
    <script>
 

</script>
</body>
</html>

<?php 

/*
* Output page contents to browser.
*/
echo $dc_prudhoe_cache_control->markup_and_flush();

?>