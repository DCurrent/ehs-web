<?php 
	abstract class PATH
	{		
		const ROOT = '../';
		const PARENT = '../fire/';
	}

	require(PATH::ROOT."libraries/php/classes/config.php"); //Basic configuration file.
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
    </head>
    
    <body>    
        <div id="container">
            
            <div id="mainNavigation">
                <?php include(PATH::ROOT."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            
            <div id="subContainer">
                
				<?php include(PATH::PARENT."a_banner_0001.php"); ?>
                
                <div id="subNavigation">
                    <?php include(PATH::PARENT."a_subnav_0001.php"); ?> 
                </div><!--/subNavigation-->
                
                <div id="content">
                
                    <h1>Welcome</h1>
                    <p>Welcome to the  University of Kentucky Fire Marshal's web portal. UK safety begins with you!</p>
                    <h2>Our Mission</h2>
                    <p>This department handles fire prevention and training, fire suppression systems, fire extinguisher inspection and maintenance, life safety audits, emergency evacuation planning, and building code compliance.  The University Fire Marshal has the delegated authority for plan review and approval of in-house construction and renovation projects (i.e., non-capital projects which do not exceed a cost of 1,000,000).</p>
                    
                    
                    <h2>Special Forms &amp; Policies</h2>
                    <nav class="nav_sub_button center">
                  		<ul>
                            <li><a href="/docs/pdf/fire_property_acceptance_form.pdf" target="_blank">Property Acceptance Form</a></li>
                   	  </ul>
					</nav>
                    
                    <h2>Reports &amp; Logs</h2>
                    
                    <div id="fire_reports_and_logs" class="center">
                    	<span class="alert">*</span> indicates restricted access.
                    
                        <nav class="nav_sub_button">
                            <ul>
                                <li><a href="/apps/flashpoint/incident_log.php">Campus Fire Log</a></li>
                                <li><a href="drill.php">Drill Report Entry <span class="alert">*</span></a></li>
                                <li><a href="/apps/flashpoint/alarm_entry.php">Fire/False Alarm Report Entry <span class="alert">*</span></a></li>
                            </ul>
                        </nav>                    
                    </div><!--/fire_reports_and_logs-->
                    
                    <h2>Social Outreach</h2>
                    <?php include(PATH::PARENT."a_tweets.php"); ?>
                    
                </div><!--/content-->
            
            </div><!--/subContainer-->
            
            <div id="sidePanel">		
                <?php include(PATH::PARENT."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            
            <div id="footer">
                <?php include(PATH::ROOT."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
            
        </div><!--/container-->
        
        <div id="footerPad">
        	<?php include(PATH::ROOT."libraries/includes/inc_footerpad.php"); ?>
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