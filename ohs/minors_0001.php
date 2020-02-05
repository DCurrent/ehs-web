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
                <div id="content">
                    <h1>Minors In Research Laboratories or Animal Facilities</h1>
                    <p>Environmental Health and Safety is committed to helping young  researchers understand the risks involved with working in research laboratories  or animal facilities and how those risks can be minimized. The Minors In  Research Laboratories  or Animal Facilities Policy was developed to  document the risk assessment decision logic for each proposed project. The risk  assessment also provides researchers information on controls and training that  are required when certain hazards are present.</p>
                    <ul>
                      <li>Please read the <a href="/docs/pdf/ohs_minors_in_labs_0001.pdf" target="_blank">instructions document</a></li>
                      <li>And complete the <a href="/docs/pdf/ohs_minors_in_labs_research_proposal_registration_0001.pdf" target="_blank">Project Registration form</a></li>
                      <li>Fill out the <a href="/docs/pdf/ohs_minors_in_labs_project_hazard_assessment_form_0001.pdf" target="_blank">Project Risk Assessment</a></li>
                      <li><a href="../docs/pdf/train_minors_in_labs.pdf">Materials for High School Instructors</a></li>
                    </ul>
                    <p>The risk assessment and the project form will be reviewed by  EHS and an approval letter will be sent to the Principal investigator once the  review is complete. If you have any questions about this process of laboratory  safety at UK, please contact <a href="mailto:Jacquelyn.rhinehart@uky.edu">Jackie Rhinehart</a>,  Lab safety specialist, or <a href="mailto:lee.poore@uky.edu">Lee Poore</a>.</p>
                    
                    
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