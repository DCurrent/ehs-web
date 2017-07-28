<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cDocroot 	= $_SERVER['DOCUMENT_ROOT']."/"; 
	$cLRoot		= $cDocroot."biosafety/";
?>

<!DOCtype html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        
        <title>UK - Biological Safety; Institutional Biosafety Committee Review Form</title>
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
				<?php include("a_banner.php"); ?>
                <div id="subNavigation">
                	<?php include("a_subnav.php"); ?> 
                </div><!--/subNvaigation-->
                <div id="content">
                	<h1>Institutional Biosafety Committee Review Form</h1>
                    <p>
                    	Registration of protocols for Institutional Biosafety Committee review and approval requires the use of our <a href="//topaz.uky.edu" class="link">online software</a>.</p>          
                    
                    <p>Computer requirements for the use of this software are:          
                        <ul>
                            <li>1G RAM</li>
                            <li><a href="//www.microsoft.com/getsilverlight/">MS Silverlight 4+</a></li>
                            <li>Intel CPU (Mac users)</li>
                        </ul>
                    </p>
                    
                    <p>Before gaining authorized access to the system you must contact the Department of Biological Safety at 859-257-8655 or <a href="mailto:ehsbiosafety@uky.edu" class="link">ehsbiosafety@uky.edu</a> to provide a list of names of the PI and personnel associated with the protocol.</p>
                    
                    <p>IBC registration software may be accessed with your University of Kentucky link blue account <a href="//topaz.uky.edu">here</a>.</p>
                    
                    <p>Training sessions for the use of the software are offered regularly. Please contact the Department of Biological Safety at 859-257-8655 or <a href="mailto:ehsbiosafety@uky.edu" class="link">ehsbiosafety@uky.edu</a> for more information.</p>
                    
                    <p>For research involving human pathogens, the following document will also be required: <a href="../docs/pdf/bio_ecp_personnel_statement.pdf" class="link">ECP Personnel Statement </a></p>
                    
                    <p>
                    	Any research involving any infectious agents, potentially infectious materials or recombinant nucleic acids is required to be registered with the Institutional Biosafety Committee as established by University of Kentucky policy and the NIH. Because the University receives funding from NIH grants, ALL research conducted at the University must comply with the NIH Guidelines for Research Involving Recombinant DNA Molecules and University policies. </p>
                    <p> Biohazardous materials which are considered worthy of registration may include, but are not limited to:
                        <ul>
                            <li>Infectious agents (viral, bacterial, fungal, parasitic, or prion) </li>
                            <li> Recombinant nucleic acids (ex: plasmids with inserts, viral vectors, etc. or whole animals and plants with introduced recombinant materials) </li>
                            <li> Infected animal blood and/or tissues </li>
                            <li> Human blood, blood products, or fluids </li>
                            <li> Infected animal blood and/or tissues </li>
                            <li> Human blood, blood products, or fluids </li>
                            <li> Human derived cell lines or tissues </li>
                            <li> Live vaccines </li>
                        </ul>
                    </p>
                    
                    <p>If you are uncertain as to whether material you are using in your research qualifies as biohazardous, please contact the University of Kentucky Department of Biological Safety at <a href="mailto:ehsbiosafety@uky.edu" class="link">ehsbiosafety@uky.edu</a> or call 859-257-8655. </p>
                </div><!--/content-->
            </div><!--/subContainer-->    
            
            <div id="sidePanel">		
            	<?php include("a_sidepanel.php"); ?>
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