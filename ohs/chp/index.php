<?php
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."ohs/";
?>

<!DOCtype html>
    <head>
        <title>UK - Occupational Health &amp; Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        <link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />        
        <link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
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
                </div><!--subNavigation-->
                
                <div id="content"> 
                	<h1>University of Kentucky Chemical Hygiene Plan</h1>
                  	<p>The following is a revised version adopted by the University Chemical 
                    Safety Committee. The revision was necessary for compliance with the 
                    OSHA Laboratory Standard which requires an annual review.</p>
                    
                  	<h2><a href="chemical_hygiene_plan.pdf" target="_blank">Chemical Hygiene Plan</a></h2>
        			
                  <p>Printed versions of the Chemical Hygiene Plan can be requested, please contact <a href="mailto:jacquelyn.rhinehart@uky.edu">Jackie Rhinehart</a> at 257-3242 to request a copy.
                  Any manual preceding the 2012 edition needs the updated information on the Globally Harmonized Standard of Classification and Labeling of 					Chemicals (GHS). This can be done by requesting a new manual, or just copying Chapter 6 and replacing it in the existing manual of the laboratory.</p>
                    
                    <h2><a href="/docs/pdf/ohs_chp_chapter_6.pdf">Chapter 6</a></h2>
                  
                    <h2><a href="anrev.php">Chemical Hygiene Plan Annual Review</a></h2>
                  
                    <table width="100%" border="0" cellspacing="0">
                        <caption>Forms</caption>
                        <tr>
                        	<td><a href="/docs/pdf/SOPform.pdf" target="_blank">Standard Operating Procedures</a></td>
                        </tr>
                        <tr>
                        	<td><a href="/docs/pdf/IDpage.pdf" target="_blank">CHP ID Page</a></td>
                        </tr>
                        <tr>
                        	<td><a href="/apps/lab_sign">Standard Laboratory Signage</a></td>
                        </tr>
                        <tr>
                        	<td><a href="/docs/pdf/ohs_lab_spec_training_checklist.pdf" target="_blank">Lab Specific Training Checklist</a></td>
                        </tr>
                        <tr>
                        	<td><a href="/docs/pdf/self_insp.pdf" target="_blank">Laboratory Self Inspection Form</a></td>
                        </tr>
                        <tr>
                        	<td><a href="/docs/pdf/self_insp_directions.pdf" target="_blank">Directions for Laboratory Self Inspection Form</a></td>
                        </tr>
                        <tr>
                          <td><a href="../../docs/pdf/ohs_chp_violation.pdf">Violations Checklist</a></td>
                        </tr>
                    </table>
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
        </div><!--/footerpad-->
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