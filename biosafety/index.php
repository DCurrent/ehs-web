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
                    <h1>Welcome</h1>
                    
                    <p>The Department of Biological  Safety is responsible for programs concerning the safe use of recombinant and/or synthetic nucleic acids,  infectious agents, and potentially infectious materials such as human sourced  materials&nbsp; in the research and teaching  laboratories at the University of Kentucky. This includes training, auditing, and consulting with researchers,  laboratory personnel and teaching staff concerning compliance with the federal  and state laws and regulations in these areas. The Biological Safety Officer is  the liaison between researchers and the Institutional Biosafety Committee,  which reviews protocols dealing with infectious agents and/or recombinant and/or  synthetic nucleic acids.</p>
                    
                    <h2>Our Mission</h2>
                    
                    <p>The mission of the Biological Safety Program at the University  of Kentucky is to ensure the safe use of recombinant and/or  synthetic nucleic acids, infectious  agents, and potentially infectious materials in research and teaching  activities so as to eliminate or reduce the potential exposure to personnel or  the environment. Rather than ensuring mere compliance with the federal  regulations, guidelines, and University policies, UK&rsquo;s Biological Safety  Program strives to adhere to the highest ethical standards in the protection of  personnel and the environment from potential exposure to potentially  biohazardous materials.&nbsp; In service of  this mission, the Biological Safety Program endeavors to:</p>
                    
                    <ul>
                      <li>Continue to inform researchers about the  application of the federal regulations in an effort to keep researchers current  with evolving standards.</li>
                        <li>Educate faculty, staff, and students who conduct  research with recombinant and/or  synthetic nucleic acids, infectious agents and potentially infectious materials of  their responsibilities to protect themselves and the environment from potential  exposures.</li>
                        <li>Develop new approaches that better serve the  overarching mission of the University and assess the overall effectiveness of  the program.</li>
                    </ul>
                    
                    <h3><a href="//topaz.uky.edu">Topaz - IBC Registration Link</a></h3>
                  <h3><a href="bio_bsc_certification_approved_vendors.pdf">BSC Certification &ndash;  Approved Vendors</a></h3>
					
					
					<p class="alert">Notice: Due to the current public health crisis, meetings of the University of Kentucky Institutional Biosafety Committee (IBC) will be conducted via videoconference.  The NIH Guidelines encourage IBCs to open their meetings to the public.  Members of the public who would like to attend videoconference meetings may contact <a href="mailto:brandy.nelson@uky.edu">brandy.nelson@uky.edu</a> for additional information. </p>
					
					<?php include($cDocroot."libraries/includes/inc_updates.php"); ?>                
                </div><!--/content-->       
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