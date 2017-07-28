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
        <style>
			ul.columns  { 
					
					-webkit-column-count: 2;  				
					-moz-column-count: 2;				
				  column-count: 2;			 
				  margin: 0; 
				  padding: 0; 
				  margin-left: 20px;				  			  
				}
    	</style> 
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
                    <h1><img src="../media/image/ih_asbestos_3.jpg" style="float:right; margin-left:20px; border-radius:5px;" alt="Asbestos">Fact Sheet - Asbestos</h1>
                    <p>Asbestos is a general name for a group of  naturally-occurring minerals composed of small fibers.  It is common in many building materials.  Various diseases have been associated with  industrial exposure to asbestos fibers, and the extensive use of asbestos in  building materials has raised some concern about exposure in non-industrial  settings. </p>
                  <p>The presence of asbestos in a building does  not mean that the health of building occupants is endangered. As long as  asbestos-containing materials remain in good condition and are not disturbed or  damaged, exposure is unlikely. On the other hand, damaged, deteriorated, or  disturbed asbestos-containing materials can lead to fiber release (exposure),  and unauthorized removal or disturbance of asbestos materials is not only  potentially unhealthy but also illegal.  Only trained, certified workers should  handle or remove asbestos-containing materials.</p>
                  <p>Unauthorized  or uncontrolled disturbance of asbestos materials is a violation of UK policy  and can lead to civil or criminal liability under EPA or OSHA regulations.</p>
                  <h2>Types  of Asbestos Building Materials</h2>
                  <p>The following are some types of materials that may contain asbestos:</p>
                  <ul class="columns">
                    <li>floor tile</li>
                    <li>boiler insulation</li>
                    <li>ceiling tiles</li>
                    <li>fireproofing</li>
                    <li>linoleum</li>
                    <li>tank insulation</li>
                    <li>adhesives</li>
                    <li>acoustical finishes</li>
                    <li>floor tile mastic</li>
                    <li>gaskets</li>
                    <li>fume  hood liners </li>
                    <li>plaster</li>
                    <li>pipe insulation</li>
                    <li>HVAC duct wrap</li>
                    <li>lab countertops</li>
                    <li>roofing</li>
                    <li>pipe fittings</li>
                    <li>fire doors</li>
                    <li>chalkboard glue</li>
                    <li>siding  shingles</li>
                  </ul>
                  <p>In general, buildings built after 1980 are  presumed to not have any asbestos-containing materials (ACM).  However, there can be exceptions, and thus  OSHA requires due diligence on the part of building owners to identify  potential ACM in post-1980 buildings (<a href="https://www.osha.gov/pls/oshaweb/owadisp.show_document?p_table=interpretations&p_id=22462">reference</a>).</p>
                  <p>Building  materials that may contain asbestos must be treated as if they do until  laboratory testing proves that they do not contain asbestos. If you have any  questions about whether a material contains asbestos, ask your supervisor/resident  advisor/house corporation or call <a href="/env">UK's Environmental Management Department</a> at  <a href="tel:+18593236280">(859) 323-6280</a>.                </p>
                  <h2>Asbestos Guidlines</h2>
                  <ul>
                    <li>Do not damage, disturb, or remove  asbestos-containing materials. Only trained and certified workers should handle  or remove asbestos-containing materials.</li>
                    <li>Promptly report potential asbestos  debris or damaged asbestos materials (e.g., damaged pipe insulation and  loose/missing floor tiles) that you see to your supervisor/resident  advisor/house corporation. The materials may already have been tested or, if  not, will be sampled and tested.</li>
                    <li>When in doubt, ask.</li>
                    <li>If  you see improper cleaning or maintenance activities being done on suspect  materials, see that they are stopped and contact your supervisor/resident  advisor/house corporation. </li>
                  </ul>
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