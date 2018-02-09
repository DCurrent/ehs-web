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
			ul.rig {
				list-style: none;
				font-size: 0px;
				margin-left: -2.5%; /* should match li left margin */				
			}
			ul.rig li {
				display: inline-block;
				padding: 10px;
				margin: 0 0 2.5% 2.5%;
				background: #fff;
				border: 1px solid #ddd;
				border-radius: 5px;
				font-size: 16px;
				font-size: 1rem;
				vertical-align: top;
				text-align:center;
				box-shadow: 0 0 5px #ddd;
				box-sizing: border-box;
				-moz-box-sizing: border-box;
				-webkit-box-sizing: border-box;
			}
			ul.rig li img {
				max-width: 100%;
				height: auto;
				margin: 0 0 2px;
			}
			ul.rig li h3 {
				margin: 0 0 5px;
			}
			ul.rig li p {
				font-size: .9em;
				line-height: 1.5em;
				color: #999;
			}
			/* class for 2 columns */
			ul.rig.columns-2 li {
				width: 47.5%; /* this value + 2.5 should = 50% */
			}
			/* class for 3 columns */
			ul.rig.columns-3 li {
				width: 30.83%; /* this value + 2.5 should = 33% */
			}
			/* class for 4 columns */
			ul.rig.columns-4 li {
				width: 22.5%; /* this value + 2.5 should = 25% */
			}
			 
			@media (max-width: 480px) {
				ul.grid-nav li {
					display: block;
					margin: 0 0 5px;
				}
				ul.grid-nav li a {
					display: block;
				}
				ul.rig {
					margin-left: 0;
				}
				ul.rig li {
					width: 100% !important; /* over-ride all li styles */
					margin: 0 0 20px;
				}				
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
                    <h1>Monitoring</h1>
                    <p>The University of Kentucky is committed to  providing work, study, research, and residential environments that are free from  recognized hazards.  Therefore, a  rigorous program of industrial hygiene monitoring is in place to ensure the well-being  of all persons at UK.</p>
                    <p>Monitoring is performed for a variety of  substances.  Hazards in the workplace  encompass numerous environmental and physical stressors, which can include both  chemical and physical hazards.&nbsp; Chemical hazards constitute a large  percentage of occupational health hazards, whether in the form of vapor, gas,  or mist which can be breathed into the lungs, or as solvents, which can cause  skin irritation or be absorbed through the skin.  Physical hazards include excessive levels of noise,  nonionizing and ionizing radiation, vibration, and extremes of temperature and  pressure. </p>
                  <p>The University of Kentucky Health &amp; Safety  (UKHS) Division performs frequent on-campus monitoring that takes a variety of  forms.  Reasons for performing monitoring  include both of the following:</p>
                    <ul>
                      <li>Ensuring that engineering and  administrative controls are adequate to protect personnel from exposures, and  determining appropriate levels of personal protective equipment;</li>
                      <li>Ensuring compliance with exposure  limits established by regulatory agencies (e.g. OSHA, EPA), and agencies who  publish best-practice recommendations (e.g. NIOSH, ACGIH).</li>
                    </ul>
                    <h2>Personal Monitoring</h2>
                    <p>Personal monitoring refers to monitoring devices which are worn by the affected  faculty/staff/student, with the sampling device as close to the &ldquo;breathing  zone&rdquo; (for inhaled chemical hazards) or the ears (for noise) as possible.  Below are examples of on-campus personal  monitoring for inhalational hazards using sampling pumps and media.</p>
                    <ul class="rig columns-2">
                        <li>
                            <img src="../media/image/ih_monitoring_1.jpg" />
                            <h4>Lead</h4>                            
                        </li>
                        <li>
                            <img src="../media/image/ih_monitoring_2.jpg" />
                            <h4>Dimethylacetamide</h4>                           
                        </li>
                        <li>
                            <img src="../media/image/ih_monitoring_3.jpg" />
                            <h4>Formaldehyde</h4>                           
                        </li>
                        <li>
                            <img src="../media/image/ih_monitoring_4.jpg" />
                            <h4>Metal Fumes</h4>                            
                        </li>                        
                    </ul>
                    <p>Personal monitoring can also be done with direct-reading instruments  designed to be worn during the normal course of the day. Examples:</p>
                    
                    <ul class="rig columns-2">
                        <li>
                            <img src="../media/image/ih_monitoring_5.jpg" />
                            <h4>Carbon Monoxide / Nitrogen Dioxide</h4>                            
                        </li>
                        <li>
                            <img src="../media/image/ih_monitoring_6.jpg" />
                            <h4>Noise</h4>                           
                        </li>                                               
                    </ul>
                    
                    <h2>Area Monitoring</h2>
                    
                    <p>Area Monitoring uses monitoring devices (either direct or indirect-reading) placed in specific environments but not worn by personnel. Some examples are depicted below.</p>
                    
                    <ul class="rig columns-2">
                        <li>
                            <img src="../media/image/ih_monitoring_7.jpg" />
                            <h4>Asbestos</h4>                            
                        </li>
                        <li>
                            <img src="../media/image/ih_monitoring_8.jpg" />
                            <h4>Mercury</h4>                           
                        </li>
                        <li>
                            <img src="../media/image/ih_monitoring_9.jpg" />
                            <h4>Heat Stress</h4>                           
                        </li>
                        <li>
                            <img src="../media/image/ih_monitoring_10.jpg" />
                            <h4>Power Density</h4>                            
                        </li>                        
                    </ul>
                    
                    <h2>Other Types of Monitoring</h2>
                    
                    <ul class="rig columns-3">
                        <li>
                            <img src="../media/image/ih_monitoring_11.jpg" />
                            <h4>Monitoring</h4>                                                        
                        </li>
                        <li>
                            <img src="../media/image/ih_monitoring_12.jpg" />
                            <h4>Tape</h4>                                                        
                        </li>
                        <li>
                            <img src="../media/image/ih_monitoring_13.jpg" />
                            <h4>Swabs</h4>                                                        
                        </li>  
                        <li>
                            <img src="../media/image/ih_monitoring_14.jpg" />
                            <h4>Bulk Air Samples</h4>
                            <p>"Grab" bulk air samples for analysis of specfic contaminants</p>                                                       
                        </li>                                           
                    </ul>                    
                                       
                   
                    <h2>Further Information</h2>
                    <p>For more information on lead, asbestos, <a href="/ohs/hearcons.php">noise</a>, or <a href="/ohs/radon.php">radon</a>, refer to the specific UKHS pages  hyperlinked herein.  <em>(Insert hyperlinks for lead and asbestos after pages developed).</em></p>
                    <p>For questions about monitoring for biological  materials, infectious agents, autoclave testing, etc., contact the <a href="/biosafety/">UK Department of Biological Safety</a>.</p>
                    <p>For questions about radionuclide monitoring,  dosimetry, or ionizing radiation sources other than radon, contact the <a href="/radiation/">UK Radiation Safety Division</a>.</p>
                  <p>OHS  can perform monitoring for any potential hazard that has a testing method  approved by a recognized organization such as NIOSH, ASTM, OSHA, etc.  If you have any questions about industrial  hygiene monitoring, or to request monitoring, please contact <a href="mailto:djboca2@uky.edu">Derek Bocard</a>.</p>
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