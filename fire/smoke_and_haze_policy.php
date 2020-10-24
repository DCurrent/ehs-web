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
                
                    <h1>Smoke and Haze Use Policy</h1>
                    <h2>Objective</h2>
                    <p>This policy has been established to provide the requirements and procedures necessary whenever smoke or haze is used during a University event, theatrical production, or for any other purpose inside of University facilities or on University property.</p>
                  <h2>Applicability</h2>
                  <p>This policy applies to all University buildings including campus, athletic, medical, and agricultural facilities. The policy further applies to the use of smoke or haze on any property owned by the University.</p>
                  <h2>Definitions</h2>
                  <p>Smoke and haze – any atmospheric effect that produces small particle distribution in the air for the purpose of entertainment, theatrical mood setting, or lighting effects. Smoke and haze shall refer to any particles of a solid or liquid substance suspended in the air and shall include smoke, haze, fog, CO2 use, and/or nitrogen use.</p>
                  <h2>Background</h2>
                  <p>Smoke and haze use in University buildings is often associated with concerts, theatrical productions, and athletic events. The UK Fire Marshal’s Office does not prohibit the use of these effects, but they do need to be approved and regulated. Smoke and haze production inside of a building can be problematic for several reasons. First, smoke and haze is capable of tripping smoke detectors and activating the building’s fire alarm system. Second, the improper use of smoke and haze can create a situation where exits and exit routes are obscured and difficult to navigate in an emergency. Lastly, smoke and haze production has previously been perceived by uninformed occupants as a fire condition followed by confusion and unnecessary emergency response.</p>
                  <h2>Smoke and Haze Usage</h2>
                  <p>Smoke and haze use in any University building and on any property owned by the University shall be submitted to the UK Fire Marshal for review and approval prior to the event or use. You may use the <a href="smoke_and_haze_use_submission_form.pdf">form located here</a>.</p>
                  <h2>Smoke and Haze Approval Process</h2>
                  <p>Any event where smoke and haze may be used shall be submitted to the UK Fire Marshal’s Office for review and approval. Considerations for the approval will include the following:</p>
                  
                  <p>
					  <ul>
						  <li>Location of the event</li>
						  <li>The type of smoke and/or haze produced</li>
						  <li>Method of smoke and/or haze production</li>
						  <li>Duration of the smoke and/or haze production</li>
						  <li>Proximity to egress components</li>
						  <li>Proximity to fire alarm detection devices</li>
					</ul>
				  </p> 
				<p>If the smoke and haze use is approved, there may be additional requirements for the event staff. If the facility has smoke detectors in close proximity to the event, it may be necessary for Fire Marshal staff or approved PPD staff to be present to monitor the fire alarm system. Monetary fees associated with the additional personnel will be the responsibility of the person(s) producing the event. Event staff shall also notify building occupants and facility personnel of the smoke and haze use. This can be done through email and can be coordinated with facility representatives. </p>

                    
                </div><!--/content-->
            
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