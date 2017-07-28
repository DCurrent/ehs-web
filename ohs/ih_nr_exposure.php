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
                    <h1>Non-Routine  Exposures for Building Occupants</h1>                    
                    <ul class="rig columns-3">
                        <li>
                            <img src="../media/image/ih_nr_exposure_1.jpg" />                                                        
                        </li>
                        <li>
                            <img src="../media/image/ih_nr_exposure_2.jpg" />                                                     
                        </li>
                        <li>
                            <img src="../media/image/ih_nr_exposure_3.jpg" />                                                       
                        </li>                       
                  </ul>
                    
                  <p>The University of Kentucky is committed to  providing work, study, research, and residential environments that are free from  recognized hazards.  As part of this  commitment, the UK Health &amp; Safety office monitors campus buildings any  time that non-routine maintenance, repair, or restoration activities occur that  might result in indoor air quality concerns.</p>
                  <p>Sometimes, non-routine maintenance or repair  needs to occur in a campus building.  For  example, when water damage occurs in a building due to roof leaks, flooding,  broken pipes, or other incidents, then several chemical compounds might be used  in order to repair the building and put it back into normal service.  Examples include:</p>
                  <ul>
                    <li>Roof-sealant compounds</li>
                    <li>Antimicrobial encapsulant and  water-sealer for indoor building materials</li>
                    <li>Paints or other finishes</li>
                    <li>Chemicals for cleaning and repairing  floor coverings such as carpets or linoleum.</li>
                  </ul>
                  <p>UK Health &amp; Safety works with the Physical  Plant Division (PPD) and building operators to ensure that only the safest  products and procedures are used for all work that occurs within, or adjacent  to, occupied buildings.   </p>
Please  contact <a href="mailto:brent.webber@uky.edu">Brent Webber</a> (<a href="tel:+18592577600">859-257-7600</a>) if you have any concerns about  non-routine exposures, renovations, repairs, or any other safety and health  topic.
                  <h2>Useful Links</h2>
                  <p>Safety Data Sheets for the most commonly used  roofing compounds at UK:</p>
                  <ul>
                    <li><a href="../docs/pdf/ohs_sds_permathane_grey.pdf" target="new">Neogard® Permathane FR Basecoat Dark  Gray</a></li>
                    <li><a href="../docs/pdf/ohs_sds_permathane_white.pdf" target="new">Neogard® Permathane Top Coat White</a></li>
                    <li><a href="../docs/pdf/ohs_sds_permathane_tan.pdf" target="new">Neogard® Permathane Top Coat Tan</a></li>
                  </ul>
                  <p>Monitoring reports by UKHS from on-campus  roofing projects:</p>
                  <ul>
                    <li><a href="../docs/pdf/ohs_nr_astecc_tdi.pdf" target="new">Advanced Science and Technology  Commercialization Center</a></li>
                    <li><a href="../docs/pdf/ohs_nr_taylor_ed.pdf" target="new">Taylor  Education Building</a></li>
                  </ul>
                  <p>Safety Data Sheets for IdeaPaint products used to create dry-erase wall surfaces:</p>
                  <ul>
                    <li><a href="../docs/pdf/ohs_ih_ideapaint_create_part_b_sds.pdf">IdeaPaint Create Part B SDS</a></li>
                    <li><a href="../docs/pdf/ohs_ih_ideapaint_create_clear_part_a_sds.pdf">IdeaPaint Create-Clear Part A SDS</a></li>
                    <li><a href="../docs/pdf/ohs_ih_ideapaint_create_white_part_a_sds.pdf">IdeaPaint Create-White Part A SDS</a></li>
                    <li><a href="../docs/pdf/ohs_ih_ideapaint_create_clear_part_a_sds.pdf">IdeaPaint PRO Part A SDS</a></li>
                    <li><a href="../docs/pdf/ohs_ih_ideapaint_create_part_b_sds.pdf">IdeaPaint PRO Part B SDS</a></li>
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