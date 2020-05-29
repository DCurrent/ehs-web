<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."env/";
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Management</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Permanent Marker" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" />
		<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
    
    	<style>
		.custom_marker_normal
			{
				font-family: 'Permanent Marker';
				font-size: 48px;
			}
		.custom_marker_alert
			{
				color: #8C0002;
				font-family: 'Permanent Marker';
				font-size: 48px;
				text-decoration-line: underline;
				
			}
		li.double-space
			{
				padding:1em 0;
			}
		</style>    
    </head>
    
    
    
    <body>    
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            <div id="subContainer">
                <?php include($cLRoot."a_banner.php"); ?>
                <div id="subNavigation">
                    <?php include($cLRoot."a_subnav.php"); ?>	
                </div><!--/subContainer-->
                <div id="content">
				  <div style ="padding: 10px; border: 2px solid; border-radius: 15px; border-color:#3399ff; background-color:#e6f2ff; -moz-border-radius: 15px;" id="env_mission" class="center">
					  <h1>Attention</h1>
					  <p style="color:#0056b3">Due to the University’s response to COVID-19 concerns, as of March 30, 2020 the Environmental Management Department has adjusted its normal work location assignments for much of its staff. These reassignments may cause a slight deviation in normal response times for waste pick-up requests made through the E-Trax system or those that are called or emailed into the department.</p>
					  
					  <p style="color:#0056b3">We hope that this period of staff reassignment is short-lived but if you have any questions concerning a waste pick up request during this time, please call <a href="tel:18593235005">859-323-5005</a> or <a href="tel:18592573129">859-257-3129</a>.</p></div>
                  <div id="env_mission" class="center">
                        <a href="../docs/pdf/emm_mission_0001.pdf" target="_blank" class="no_icon"><img src="../media/image/em_mission_0001.jpg" title="Mission Statement" alt="Mission Statement" /></a>
                  </div><!--/env_mission-->
                                   	
                     
                     <p>
                         Environmental  Quality Management Center (Building No. 490)<br />
                         355 Cooper Drive<br />
                         Lexington KY 40506-0490<br />
                         (859) 323-6280<br />
                         Fax: (859) 323-6274
                	 </p>
                </div><!--/content-->     
            </div><!--/subcontainer-->
            <div id="sidePanel">
                <?php include("a_corner_image.php"); ?>
                <?php include ($cLRoot."a_sidepanel.php"); ?>
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