<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."fire/";
	
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
    	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
        
        <script language="Javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>        
        <script language="Javascript" src="//code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <script language="Javascript" src="/libraries/javascript/jquery_ui_timepicker_addon.js"></script>

        <script>
            $(document).ready(function() {
                
                $(".loadImage_form").show();
                $(".loadImage").hide();
                $(".result_table").hide();
                
                $('.form_set').load('alarm_form.php', function() {
                    $(".loadImage_form").hide();
					$(".form_set").slideDown(1000);
                });
            });
        </script>
    
    
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
                                   
                    <div class="table_header">
                    	Search Criteria
                    </div>         
                                        
                    <div class="form_set">
                    	<!-- Search criteria form will appear here. -->
                    	<center>
                        	<!-- Image appears while form is loading. -->
                        	<img src="../media/image/meter_circle_loading.gif" class="loadImage_form" align="middle">
						</center>
                    </div>
                   
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