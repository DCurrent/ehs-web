<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	
	/*
	Damon V. Caskey
	20110529
	
	Administrate classes 
	
	Create training quiz from database entries as identified by class ID.
	*/		
?> 

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety, <?php //echo $cClassTitle; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
    </head>
    
    <body>
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div>
            
            <div id="subContainer">
				<?php include($cDocroot."a_banner_0001.php"); ?>
                <div id="subNavigation">
                	<?php include($cDocroot."a_subnav_0001.php"); ?> 
                </div><!--subNavigation-->
                
                <div id="content">           
                
                    <div class="module_select">
                    
                        <!-- Module and window selection -->
                        <h1>Training Module Administration</h1>                   
                                               	
                        <form name="form1" method="post" action="">
                            <fieldset>
                            	<legend>Select Class</legend>
                                <select>
                                  <option value="volvo">Volvo</option>
                                  <option value="saab">Saab</option>
                                  <option value="mercedes">Mercedes</option>
                                  <option value="audi">Audi</option>
                                </select>
                                                                
                        		<p>
                                	<!--When clicked, present blank form to start a class-->
                                	<a href="#" class="cmd_new_class icon_edit">New Class</a>
                                	
                                    <!--When clicked, delete the current class-->                                
                        			<a href="#" class="cmd_new_class icon_delete">Delete Class</a>
                                </p>
                            </fieldset>
                        </form>                          
                        
                        <div class="module_selected_yes">                   
                        
                        </div><!--/module_selected_yes-->
                	</div>                   
                    
                </div><!--/Content-->       
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
        </div><!--footerPad-->
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