<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."env/";
?>

<!DOCtype html>
    <head>
    	<title>UK - Environmental Management, Stormwater Quality Overview</title>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
    	<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />
    </head>

    <body>
    
        <div id="container">
            <div id="mainNavigation">
                <?php include("../libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            <div id="subContainer">
                <?php include("a_banner.php"); ?>
                <div id="subNavigation">
                    <?php include("a_subnav.php"); ?>	
                </div><!--/subNavigation-->
                <div id="content">
                    <h1>Stormwater Qualty Overview</h1>
                    <p>Welcome to the University of Kentucky's website dedicated expressly for the dissemination of stormwater management information associated with its main Lexington campus.   This website forms a crucial component of the University's efforts to comply with a state-issued general permit to discharge stormwater.  Formally entitled a Municipal Separate Storm Sewer System (MS4) Permit and issued by authority from the US EPA through the Kentucky Division of Water, it establishes conditions whereby the University can discharge stormwater runoff into the waters of the Commonwealth.</p>
                    <p>The University's stormwater system is comprised of detention basins, open drainage ditches and miles of underground piping.  In addition, this system is also comprised of outfalls that discharge stormwater from the campus' property boundary and into streams or directly into the city of Lexington's stormwater system.</p>
                    <p>The goal of the MS4 Permit and the primary objective of the University is to ensure that this runoff does not adversely impact surface water quality.  To this end, the Permit has established six categories of Minimum Control Measures (MCM's) that the University is required to address.  These six MCM's are outlined below along with a link for further discussion on the substance of each measure:</p>
                    <ul>
                        <li><a href="education_outreach.php">Public Education and Outreach</a></li>
                        <li><a href="involvement_participation.php">Public Involvement and Participation</a></li>
                        <li><a href="detection_elimination.php">Illicit Discharge and Elimination Activities</a></li>
                        <li><a href="runoff_control.php">Construction Site Stormwater Runoff Control</a></li>
                        <li><a href="new_redevelopment.php">Post-Construction Stormwater Management in New Development and Redevelopment</a></li>
                        <li><a href="municipal_operations.php">Pollution Prevention/Goodhouskeeping</a></li>
                        <li>A description of how the University addresses each of these MCM's for a 5-year time period is spelled out in a Stormwater Quality Management Plan.</li>
                    </ul>
                    <p>The University  does not utilize ordinance-based governance the way that city/county entities  do.  Instead, the University utilizes  &ldquo;Administrative Regulations&rdquo; (AR&rsquo;s) which provide interpretation and  implementation of University-wide policies set forth by the Board of Trustees  in the Governing Regulations and the Minutes of the Board of  Trustees. The AR&rsquo;s promote  the responsible and efficient administration of the University and the  accomplishment of its goals.  The AR&rsquo;s which include the Human Resources Policy and Procedure Administrative  Regulations and the Business Procedures  Manual are official University rules or  directives that:</p>
                    <ol start="1" type="1">
                      <li>Mandate       requirements of or provisions for members of the University community, and       may also provide procedures for implementation.</li>
                      <li>Provide       interpretation and implementation of University-wide polices set forth in       the Governing Regulations and the Minutes of the Board of       Trustees.</li>
                      <li>Have broad       application throughout the University.</li>
                      <li>Enhance the       University's mission, reduce institutional risk, and/or promote       operational efficiency. </li>
                      <li>Ensure the       consistent, equitable application of the University's policies and       procedures. </li>
                      <li>Help achieve       compliance with applicable federal or state law, local ordinance, or       accrediting bodies.</li>
                      <li>Have been reviewed       and approved by the President or the Board of Trustees. </li>
                    </ol>
                    
                    <p>The Board of  Trustees has full legal authority and responsibility for the governance of the  University. The President is the chief executive officer of the University with  broad authority delegated from the Board.</p>
                    <p><a name="OLE_LINK4"></a><a name="OLE_LINK3">Administrative  Regulation 6:3 specifically mandates compliance and assigns specific  responsibilities associated with the implementation of the University's health,  safety and environmental protection programs.</a>   Through AR 6:3 the University has  established broad, yet comprehensive authority over its population of faculty,  staff and students regarding compliance with local, state and federal  environmental regulations including MS4 Permit requirements.  This environmental, health and safety AR  states the following:</p>
                    <p style="font-style:italic;">The University of Kentucky supports and maintains a strong  commitment to safety, health and environmental protection through promoting a  safe and healthy environment for students, employees, and visitors; positioning  itself as a leader within the Commonwealth in environmental stewardship, health  protection and safety standards; and assuring compliance with federal, state  and local safety, health and environmental requirements. Additionally, the  University empowers our employees and students to demonstrate individual and  institutional leadership in all matters pertaining to safety, health and  environmental protection while preserving academic freedom in research,  education and evidence-based practices in patient care.  The purpose of this regulation is to mandate compliance and assign  specific responsibilities associated with implementation of the University&rsquo;s  health, safety and environmental protection programs.</p>
                </div><!--/content-->
            </div><!--/subContainer-->
            <div id="sidePanel"> 
                <img src="../media/image/sw_drain_0001.jpg" />
                <?php include("a_sidepanel.php"); ?>
            </div><!--/sidePanel-->
            <div id="footer">
                <?php include("../libraries/includes/inc_footer.php"); ?>             
            </div><!--/footer-->
        </div><!--container-->
        
        <div id="footerPad">
        	<?php include("../libraries/includes/inc_footerpad.php"); ?>
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