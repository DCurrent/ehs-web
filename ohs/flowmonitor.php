<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."ohs/";
?>

<!DOCtype html>
    <head>
        <title>UK - Occupational Health &amp; Safety, Fumehood Flow Monitors</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" />
        <link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
    </head>
    
    <body>
    
        <div id="container">
          <div id="mainNavigation">
                <?php include("../libraries/includes/inc_mainnav.php"); ?>
            </div>
            <div id="subContainer">
                <?php include($cLRoot."a_banner_0001.php"); ?>
                <div id="subNavigation">
                    <?php include($cLRoot."a_subnav_0001.php"); ?> 
                </div>
                <div id="content">
                    <h1>Fumehood Flow Monitors</h1>
                  <h3><a href="../media/image/Crown.JPG">Crown Controls</a></h3>
                    
                  <ul>
                  	<li>Red light constantly lit - air flow problem</li>
                    <li>Red &amp; Yellow light lit - hardware failing</li>
                    <li>Red flashing - emergency activated, depress emergency button to return to normal</li>
                    <li>Yellow light - air flow not controlled, usually when sash is closed or nearly closed</li>
                    <li>Green light - Normal air flow</li>
                  </ul>
                  
                 <p>Locations - <a href="../media/image/AgNorth.jpg">Ag Science North</a>, ASTeCC, Ag Science South, Chem/phys</p>
                                   
                  <h3><a href="../media/image/Phoenix.JPG">Phoenix Controls</a></h3>
                  	<ul>
                    	<li>Standard operation lit - normal flow</li>
                    	<li>Standby operation lit - setback operation, lower flow rate</li>
                    	<li>Emergency exhaust - commanded to emergency exhaust by operator</li>
                    	<li>Caution flow alarm - alarm loss of control of face velocity</li>
                    	<li>Emergency button - used in event of emergency, depress when conditions are safe to return to normal operation</li>
                  		<li>Mute button - silence audible alarms automatically reset when alarm condition ceases</li>
                  	</ul>
                  <p>*some models my alarm when the lights are turned off indicating to user to lower the sash to save on energy cost.</p>
                  <p>Locations - MRISC, Combs, Med Science, Wethington Building, Plant Science HSRB</p>
                  
                  <h3><a href="../media/image/Hospital.JPG">Hamilton Industries (model 54L259)</a></h3>
                  	<ul>
                    	<li>Normal light green when functioning properly</li>
                  		<li>Red alarm light lit when hood is in flow alarm</li>
                  		<li>Alarm must be in &#8220;on&#8221; position to sound</li>
                    	<li>Controlled with key</li>
                    </ul>
                    
                  <p>Locations - Hospital (Clinical labs)</p>
                  
                  <h3>Fisher Hamilton SafeAire 54L0335</h3>
                  <ul>
                  	<li>Green light lit - normal operation</li>
                    <li>Yellow light lit - caution, airflow in set caution zone between low and normal</li>
                  	<li>Red light lit - alarm, high or low air flow, audible alarm will sound</li>
                  	<li>Digital display - indicates face velocity in ft./min.</li>
                  	<li>EMERG PERG - Puts hood in full exhaust by opening the damper, should only be pushed when there is a spill inside the hood; depress to reset to normal</li>
                  	<li>TEST RESET - Will temporarily silence alarm</li>
                  </ul>
                                    
                  <p>Locations - KTDRC</p>
                  
                  <h3><a href="../media/image/TSI.JPG">TSI SUREFLOW Model 8650</a></h3>
                  <ul>
                  	<li>Green light lit - normal operation</li>
                    <li>Yellow light lit - caution</li>
                    <li>Red light lit - alarm, air flow is too high or too low, audible alarm will sound, digital display will indicate type of alarm. Contact Jan Hamon or OH&amp;S.</li>
                  	<li>Digital display - actual face velocity in ft/min</li>
                  	<li>Emergency - Opens dampers and puts hood in full exhaust, increasing velocity, the red alarm light will flash and the alarm cannot be silenced. Depress the RESET button to put hood back in normal operation</li>
                  	<li>Mute - depress once to silence alarm, alarm will stay silenced until hood returns to normal operation. If additional problems occur, audible alarm will sound again.</li>
                  </ul>
                  <p>Locations - Combs, Pharmacy</p>
                  
                </div><!--/Content-->       
            </div><!--/subContainer-->    
            <div id="sidePanel">		
                <?php include($cLRoot."a_sidepanel_0001.php"); ?>		
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