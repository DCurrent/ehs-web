<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."ohs/";
?>

<!DOCtype html>
    <head>
        <title>UK - Occupational Health &amp; Safety</title>
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
                </div><!--/subContainer-->
                <div id="content"><img src="../media/image/body_fluid_cleanup.jpg" style="float: right;
margin: 10px; border-radius:5px;" alt="Body Fluids Cleanup">
                  <h1>Fact Sheet - Cleaning Blood and Body Fluids</h1>
                  <p>After caring for an incident victim, the next important step is to eliminate the risk of bloodborne diseases from an incident area.  A potential hazard still exists until the entire area is cleaned of blood and body fluids*, and the contaminated cleaning equipment has been disinfected or safely disposed. Only designated and trained individuals should clean up blood or body fluids. Contact your supervisor or resident advisor for the designated individual in your area.</p>
                    <h2>Safe Housekeeping</h2>
                    <p>Whenever you clean up blood or body fluids:</p>
                    <ol start="1" type="1">
                      <li>Restrict access to       the area. </li>
                      <li>Wear gloves (latex       or nitrile) to protect your hands. Avoid tearing your gloves on equipment       or sharp objects. Torn gloves should be replaced immediately. </li>
                      <li>Use additional       personal protective equipment, as needed (e.g., leak-proof apron and/or       eye protection). </li>
                      <li>Use disposable       towels or mats to soak up most of the blood. </li>
                      <li>Clean with an       appropriate disinfecting solution, such as ten parts water to one part       bleach. Bleach will kill both HIV and hepatitis B virus. After cleaning,       promptly disinfect mops and any other cleaning equipment; otherwise, you       may spread the viruses to other areas. </li>
                      <li>Put all       contaminated towels and waste in a Red Bag or other appropriate sealed,       labeled (<em>Biohazard</em> symbol or label), leak-proof container. This is       regulated waste; call <a href="\env">UK Environmental Management</a> (<a href="tel:+18593236280">859-323-6280</a>) for pickup. </li>
                    </ol>
                    <h2>Be Prepared</h2>
                    <ol start="1" type="1">
                      <li>Always wear gloves       whenever there is the slightest risk of exposure to blood. </li>
                      <li>Be alert for sharp       objects, such as broken glassware or used syringes, when emptying trash       containers. </li>
                      <li>Do not pick up       broken glass directly with your hands. Use a brush and dustpan. </li>
                      <li>Be sure to wash       hands and remove any protective clothing before smoking, drinking, eating,       applying cosmetics or lip balm, or handling contact lenses. </li>
                    </ol>
                  <p>*  Includes  human blood, semen, vaginal secretions, cerebrospinal fluid, pleural fluid,  pericardial fluid, peritoneal fluid, amniotic fluid, saliva in dental  procedures, tissue, and organs. Also includes any other human body fluid  (urine, feces, nasal secretions, vomitus, etc.) that is visibly contaminated  with blood. </p>
                  
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