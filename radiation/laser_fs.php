<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."radiation/";
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
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            <div id="subContainer">
                <?php include($cLRoot."a_banner_0001.php"); ?>
                <div id="subNavigation">
                    <?php include($cLRoot."a_subnav_0001.php"); ?> 
                </div><!--/subNavigation-->
                <div id="content">
                    <h1>Fact Sheet - Laser Safety</h1>
                  <p>Lasers are classified to describe           the capabilities of a laser system to produce injury to personnel. This           classification rates from Class I lasers (no harm) to Class IV lasers           like the 2000 Watt, carbon dioxide (let's cut thick steel) laser here           on campus. The manufacturer is required to label Class II, III and IV           lasers with a warning label which will also have the laser's classification           printed on it. </p>
                  <h2>Class I</h2>
                  <p> Class I lasers           are low powered devices that are considered safe from all potential hazards.           Some examples of Class I laser use are: laser printers, CD players, CD           ROM devices, geological survey equipment and laboratory analytical equipment.           No individual, regardless of exposure conditions to the eyes or skin,           would be expected to be injured by a Class I laser. No safety requirements           are needed to use Class I laser devices. </p>
                  <h2>Class II</h2>
                  <p> Class II lasers           are low power (&lt; 1mW), visible light lasers that could possibly cause           damage to a person's eyes. Some examples of Class II laser use are: classroom           demonstrations, laser pointers, aiming devices and range finding equipment.           If class II laser beams are directly viewed for long periods of time (i.e.           > 15 minutes) damage to the eyes could result. Avoid looking into a Class           II laser beam or pointing a Class II laser beam into another person's           eyes. Avoid viewing Class II laser beams with telescopic devices. Realize           that the bright light of a Class II laser beam into your eyes will cause           a normal reaction to look away or close your eyes. This response is expected           to protect you from Class II laser damage to the eyes. </p>
                  <h2>Class IIIa </h2>
                  <p>Class IIIa lasers           are continuous wave, intermediate power (1-5 mW) devices. Some examples           of Class IIIa laser uses are the same as Class II lasers with the most           popular uses being laser pointers and laser scanners. Direct viewing of           the Class IIIa laser beam could be hazardous to the eyes. Do not           view the Class IIIa laser beam directly. Do not point a Class IIIa           laser beam into another persons eyes. Do not view a Class IIIa           laser beam with telescopic devices; this amplifies the problem. </p>
                  <h2>Class IIIb </h2>
                  <p>Class IIIb lasers           are intermediate power (c.w. 5-500 mW or pulsed 10 J/cm²) devices. Some           examples of Class IIIb laser uses are spectrometry, stereolithography,           and entertainment light shows. Direct viewing of the Class IIIb laser           beam is hazardous to the eye and diffuse reflections of the beam can also           be hazardous to the eye. Do not view the Class IIIb laser beam           directly. Do not view a Class IIIb laser beam with telescopic devices;           this amplifies the problem. Whenever occupying a laser controlled area,           wear the proper eye protection. Refer to the University of Kentucky Laser           Safety Manual for complete instructions on the safety requirements for           Class IIIb laser use. </p>
                  <h2>Class IV </h2>
                  <p>Class IV lasers           are high power (c.w. >500mW or pulsed >10J/cm²) devices. Some examples           of Class IV laser use are surgery, research, drilling, cutting, welding,           and micromachining. The direct beam and diffuse reflections from Class           IV lasers are hazardous to the eyes and skin. Class IV laser devices can           also be a fire hazard depending on the reaction of the target when struck.           Much greater controls are required to ensure the safe operation of this           class of laser devices. Whenever occupying a laser controlled area, wear           the proper eye protection. Most laser eye injuries occur from reflected           beams of class IV laser light, so keep all reflective materials away from           the beam. Do not place your hand or any other body part into the class           IV laser beam. The pain and smell of burned flesh will let you know if           this happens. Realize the dangers involved in the use of Class IV lasers           and please use common sense. Refer to the University of Kentucky Laser           Safety Manual for complete instructions on the safety requirements for           Class IV laser use. </p>
                  <p>&nbsp;</p>
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