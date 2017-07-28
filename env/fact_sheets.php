<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."env/";
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Management, Fact Sheets</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        <link rel="stylesheet" href="../libraries/css/style.css" />
        <link rel="stylesheet" href="../libraries/css/style.css" media="print"/>
    </head>
    
    <body>
    
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            <div id="subContainer">
                <?php include($cLRoot."a_banner.php"); ?>
                <div id="subNavigation">
                    <?php include($cLRoot."a_subnav.php"); ?>	
                </div><!--/subNavigation-->
                <div id="content">
                    <h1>Fact Sheets</h1>
                    <ul>
                        <li><a href="/docs/pdf/env_fs_asbestos_bm.pdf" target="_blank">Asbestos In Building Materials</a></li>
                        <li><a href="fs_biohaz_0001.php">Biohazard Autoclave Bags</a></li>
                        <li><a href="fs_disposal_0001.php">Disposal of Needles, Other Sharps and Broken Glass</a></li>
                        <li><a href="fs_water.php">Drinking Water Quality</a></li>
                        <li><a href="../docs/pdf/env_fs_ethidium_bromide.pdf" target="_blank">Ethidium Bromide</a></li>
                        <li><a href="fs_light_0001.php">Fluorescent Bulbs</a></li>
                        <li><a href="fs_moving_0001.php">Guidelines for Moving Chemicals</a></li>
                        <li><a href="../docs/pdf/env_fs_spent_aerosol_cans.pdf" target="_blank">Management of Aerosol Cans</a></li>
                        <li><a href="../docs/pdf/env_fs_batteries.pdf" target="_blank">Management of Spent Batteries</a></li>
                        <li><a href="/docs/pdf/env_petroleum_spill_flow_chart_0001.pdf" target="_blank">Oil Spill Response Guide</a></li>
                        <li><a href="/docs/xls/bio_pi_req_matrix.xls" target="_blank">PI Requirements Matrix</a></li>
                        <li><a href="/docs/pdf/ep_factsheet_surplus_0001.pdf" target="_blank">Surplusing Equipment</a></li>
                    </ul>
                    
                  <h2>Stormwater</h2>
                  <ul>
                    <li><a href="../docs/pdf/env_fs_sw_trifold_custodial.pdf">Brochure: Custodial Services &amp; Stormwater</a></li>
                    <li><a href="../docs/pdf/env_fs_sw_trifold.pdf">Brochure: General Stormwater Quality Management</a></li>
                    <li><a href="../docs/pdf/env_fs_sw_trifold_grounds.pdf">Brochure: Grounds Staff Stormwater Quality Management</a></li>
                    <li><a href="//www2.ca.uky.edu/agc/pubs/ip/ip73/ip73.pdf">Living Along a Kentucky Stream</a></li>
                    <li><a href="//www2.ca.uky.edu/agc/pubs/id/id185/id185.pdf">Planting a Riparian Buffer</a></li>
                    <li><a href="//www2.ca.uky.edu/agc/pubs/aen/aen106/aen106.pdf">Reducing Stormwater Pollution</a></li>
                    <li><a href="//www2.ca.uky.edu/agc/pubs/for/for112/for112.pdf">Riparian Buffer Strips</a></li>
                    <li><a href="/ep/sewer.html" target="_self">Sanitary & Storm Sewers</a></li>
                    <li><a href="../docs/pdf/env_fs_sw_idde.pdf">Stormwater Pollution - Illicit Discharge Detection and Elimination (IDDE) Basics</a></li>
                    <li><a href="../docs/pdf/env_fs_sw_pg_pressure_washing.pdf">Stormwater Pollution - Standard Operating Procedures Parking and Transportation Parking Garage Pressure Washing</a></li>
                    <li><a href="//www2.ca.uky.edu/enri/pubs/streamside%20buffer%20zones%208-4-10.pdf">Streamside Buffer Zones</a></li>
                    <li><a href="../docs/pdf/env_fs_sw_project_design.pdf">Summary of Design Standards for  Stormwater Quantity, Quality and Erosion Control</a></li>
                  </ul>
                </div><!--/content-->
            </div><!--/subContainer-->
            <div id="sidePanel">
              <img src="../media/image/0191.jpg" />
                <div id="sideContent">
                    <?php include($cLRoot."a_sidepanel.php"); ?>
              	</div><!--/sideContent-->		
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