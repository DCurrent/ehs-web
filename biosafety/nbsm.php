<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cDocroot 	= $_SERVER['DOCUMENT_ROOT']."/"; 
	$cLRoot		= $cDocroot."biosafety/";
	
?>

<!DOCtype html>
    <head>
        <title>UK - Biological Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
    </head>
    
    <body>
    
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."/libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            <div id="subContainer">
                <?php include($cLRoot."a_banner.php"); ?>
                <div id="subNavigation">
                    <?php include($cLRoot."a_subnav.php"); ?> 
                </div><!--/subNavigation-->
                <div id="content">
                    <h1>National Biosafety Stewardship Month</h1>
                    
                    <p>From the  National Institutes of Health Notice of National Biosafety Stewardship Month  and Health and Safety Requirements for <span style="font-style:italic; font-weight:bold">NIH Grantees</span>:</p>
                    <p>&ldquo;Recent  reports of lapses in biosafety practices involving Federal laboratories have  served to remind us of the importance of constant vigilance over our  implementation of biosafety standards. These events potentially put individuals  at risk, undermine public confidence in the research enterprise, and must be  addressed to prevent their reoccurrence. Efforts to strengthen biosafety  oversight and practice must be supported and carried out by organizational  leadership, biosafety programs, and individual laboratories.</p>
                    <p>As a measure  toward preventing future lapses as well as promoting stewardship of the life  sciences and biosafety awareness across Federal entities, Federal laboratories  will reinforce their attention to safe practices in biomedical research. In  that regard, the NIH and other HHS agencies will be instituting National  Biosafety Stewardship Month, and we urge all NIH grantee institutions and/or  contractors to do the same at the local level.</p>
                    <p>In the month  of September, NIH laboratories will, and grantee institutions and/or  contractors are encouraged to, do the following:</p>
                    <ul>
                      <li><span style="font-weight:bold">Reexamine  current policies and procedures for biosafety practices</span> and oversight to ascertain whether they require  modification to optimize their effectiveness;</li>
                      <li><span style="font-weight:bold">Conduct  inventories of infectious agents and toxins</span> in all laboratories to ensure that the institution has a record of which  infectious agents and toxins are being utilized, has documentation that those  materials are properly stored under the appropriate containment conditions, and  has documentation that cites the party responsible for appropriate stewardship  of the materials; and</li>
                      <li><span style="font-weight:bold">Reinforce  biosafety training</span> of  investigators, laboratory staff, and members of IBCs to include</li>
                      <ul>
                        <li>Reexamining  training materials and practices being utilized by the institution;</li>
                        <li>Updating  materials as appropriate; and</li>
                        <li>Ascertaining  the appropriate frequency of training and conduct training when the interval  between training or other considerations warrant it.&rdquo;</li>
                      </ul>
                    </ul>
                  <p>Full NIH  Notice available at: <a href="http://grants.nih.gov/grants/guide/notice-files/NOT-OD-14-127.html">http://grants.nih.gov/grants/guide/notice-files/NOT-OD-14-127.html</a></p>
                  <p>The Department of Biological Safety at UK  currently provides a comprehensive biosafety program to help you ensure that  you meet all of your requirements as an NIH grantee and/or contractor.  If you need assistance in assessing your  lab&rsquo;s compliance with biosafety practices and procedures, training or  Institutional Biosafety Committee registration and approval our department is  always available to assist you.</p>
                     <h2>Helpful Links </h2>
                    <p><a href="../docs/pdf/bio_nbsm_flyer.pdf">National Biosafety Stewardship Month Flyer which may be  posted in your department or college</a><br>
                      <a href="../docs/pdf/bio_nbsm_agent_inventory_guidance.pdf">Biological Agent Inventory Guidance</a><br>
                      <a href="../docs/xls/bio_nbsm_inventory_template.xlsx">Inventory Template Example</a><br>
  <a href="http://www.nih.gov/science/biosafety.htm">National  Institutes of Health National Biosafety Stewardship Month Page</a> <br>
  <a href="http://www.whitehouse.gov/sites/default/files/microsites/ostp/enhancing_biosafety_and_biosecurity_19aug2014_final.pdf">White  House Memo: Enhancing Biosafety and Biosecurity in the United States</a><br>
  <a href="http://www.whitehouse.gov/blog/2014/08/28/ensuring-biosafety-and-biosecurity-us-laboratories">Office  of Science and Technology Policy: Ensuring Biosafety and Biosecurity in U.S.  Laboratories</a><br>
  <a href="http://www.asm.org/index.php/public-policy/99-policy/policy/93059-freezer-8-14">American  Society for Microbiology Statement: What is in your laboratory freezer?</a>
                
                	<?php include($cDocroot."libraries/includes/inc_updates.php"); ?>                
                </p>
                </div>
                <!--/content-->       
            </div><!--/subContainer-->
            <div id="sidePanel">		
            	<?php include($cLRoot."a_sidepanel.php"); ?>        
            </div><!--/sidePanel-->
            <div id="footer">
                <?php include($cDocroot."/libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--/container-->
        
        <div id="footerPad">
        	<?php include($cDocroot."/libraries/includes/inc_footerpad.php"); ?>
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