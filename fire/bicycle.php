<?php 
	abstract class PATH
	{		
		const ROOT = '../';
		const PARENT = '../fire/';
	}

	require(PATH::ROOT."libraries/php/classes/config.php"); //Basic configuration file.
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
    </head>
    
    <body>    
        <div id="container">
            
            <div id="mainNavigation">
                <?php include(PATH::ROOT."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            
            <div id="subContainer">
                
				<?php include(PATH::PARENT."a_banner_0001.php"); ?>
                
                <div id="subNavigation">
                    <?php include(PATH::PARENT."a_subnav_0001.php"); ?> 
                </div><!--/subNavigation-->
                
                <div id="content">
                
                    <h1>Bicycles In Buildings Policy</h1>
                    
			      <h2>Objective</h2>
			      <p>The following policy has been established to provide guidelines on the storage and/or parking of bicycles in and around University buildings.</p>
			      <h2>Applicability</h2>
			      <p>This policy applies to all University buildings including campus, athletic, medical, and agricultural facilities. The policy further applies to all exterior portions of a building within 10 feet of an egress door, stair, or ramp.</p>
			      <h2>Background</h2>
			      <p>Bicycles are a common mode of transportation on a college campus. Many students, staff, and visitors use them to travel daily to their classes and work spaces. The University recognizes the usefulness of bicycles and has installed numerous parking racks and stands at nearly every building on campus. Despite these efforts, we still find that bicycles are parked and/or stored in locations that are prohibited and could impact the safety of our campus community.</p>
			      <p>		          When bicycles are taken inside buildings or parked near egress doors, they present a possibly serious impediment to quick and efficient egress in an emergency situation. During an evacuation, owners will often grab their bicycles and attempt to take them outside leading to obstructions in corridors, elevators, and stairwells for all other occupants who are simultaneously leaving the building. Additionally, bicycles parked in stairwells, corridors, and just outside egress doors create a similar issue.</p>
			      <h2>Bicycles In Buildings</h2>
			      <p>Therefore, the UK Fire Marshal’s Office has determined that at no time shall bicycles be allowed inside of any room or space in University buildings unless that space has specifically been designed and designated for bicycle parking. Bicycles shall also not be parked within 10 feet of any egress door, stair, or ramp for a University building unless approved parking racks are provided. This policy clarifies the general parking regulations listed on the Transportation Services website under Parking Regulations.</p>
			      <p>		          If a bicycle is found within a University building or otherwise blocking egress from the building, the owner will be notified and the bicycle must be removed immediately. If the owner cannot be located, the University Fire Marshal reserves the right to have the bicycle removed and impounded by Transportation Services.</p>
			      <p>This policy has been           reviewed and endorsed by the University Committee on Safety and Environmental           Health.<br>
Date Endorsed: 2019-05-01</p>
                </div>
            
            </div><!--/subContainer-->
            
            <div id="sidePanel">		
                <?php include(PATH::PARENT."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            
            <div id="footer">
                <?php include(PATH::ROOT."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
            
        </div><!--/container-->
        
        <div id="footerPad">
        	<?php include(PATH::ROOT."libraries/includes/inc_footerpad.php"); ?>
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