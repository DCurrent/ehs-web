<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."ohs/";	
?>

<!DOCtype HTML>
    <head>
        <title>UK - Occupational Health &amp; Safety, Fumehoods</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        <link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />        
        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
    </head>

	<body>

		<div id="container">
        	<div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            <div id="subContainer">
                <?php include($cLRoot."a_banner_0001.php"); ?>
                <div id="subNavigation">
                    <?php include($cLRoot."a_subnav_0001.php"); ?> 
                </div><!--/subNavigation-->
                <div id="content">
                    <h1>Chemical Hoods</h1>
                    <p>Techncial Standards and Performance Standards</p>
                    <h2>General</h2>
                    <p>Chemical  hood systems shall be designed to protect laboratory workers and to ensure that  hazardous chemical vapors originating from laboratory operations shall not be  recirculated. The use of variable air volume systems is preferred. Additional  requirements include: </p>
                    <ul>
                      <li>Designed to provide 100 linear feet per minute face velocity at a height of twelve inches.</li>
                      <li>Maintain a set point within five percent within one second of any change in fume hood sash position, or changes in the exhaust and/or supply systems; except in those cases where the existing building's HVAC systems are not capable of complying with this requirement. </li>
                      <li>Provide flow detectors/alarms          visual readout of face velocity. </li>
                  </ul>
                    <h2> Chemical Hood Location</h2>
                    <ul>
                      <li>Fume hoods must not be located adjacent to a single means of access to an exit or in high traffic areas.</li>
                      <li>Locate away from doors,      operable windows, and in general located to minimize cross drafts and air      disruption Swinging doors are prohibited in rooms with chemical hoods.</li>
                      <li>Supply air diffusers air jet velocity shall be less than half (preferably less than one third) of capture velocity of the exhaust hood. </li>
                  </ul>
                    <h2> Chemical Hood Exhaust </h2>
                    <ul>
                      <li>Chemical hood exhaust      discharges must be designed to minimize air re-entry, take into account aesthetic      appearance,      and minimize exposures to maintenance workers.</li>
                      <li>Locate fans on roof or in a separate room (penthouse) that is maintained at a negative pressure to the rest of the building and is well ventilated.</li>
                      <li>A motion/light sensor may be utilized to lower exhaust rate to 60 linear feet per minute when fume hood is not in use.</li>
                      <li>Exhaust system must be        constructed entirely of non-combustible materials; all duct work shall have        welded seams and made of  materials resistant to acids, bases, solvents and corrosive gases. </li>
                  </ul>
                    <h2> Sound Levels</h2>
                    <ul>
                      <li>Chemical hood exhaust      systems must be designed to minimize sound level problems.</li>
                      <li>Designed to keep noise levels less than 68 db(A) one foot in front of hood face with hoods running. </li>
                  </ul>
                    <h2> Perchloric Acid Hoods </h2>
                    <p> If perchloric acid is to be used above ambient temperature or at concentrations      above 72%, separate specifically designed hoods must be provided including      separate exhaust system with a water wash down system. </p>
                    <h2> Recirculating Chemical Hoods </h2>
                    <p> Ductless hoods which filter air (through HEPA or charcoal filters) then discharge the filtered air back into the laboratory may not be used without approval of the directors of Environmental Management and Occupational Health and Safety. </p>
                    <h2> Air Cleaning Devices </h2>
                    <p> Air cleaning devices are not generally      required for laboratory fume hoods, and may not be used without approval      of the directors of Environmental Management and Occupational Health &amp; Safety      departments. </p>
                    <h2> Energy Efficiency </h2>
                    <p> See guidelines and standards related to HVAC. </p>
                    <p> Approved by UK Design Guidelines &amp; Technical      Standards Committee June 18, 1998.</p>
                </div><!--/content-->
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