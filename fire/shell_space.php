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
                
                    <h1>Shell Space Usage Policy</h1>
                    
			      <h2>Objective</h2>
			      <p>The following policy has been established to provide guidelines governing the use of shell spaces in all University buildings.</p>
			      <h2>Applicability</h2>
			      <p>This policy applies to all University buildings and facilities that have shell spaces. This includes campus, athletic, medical, and agricultural buildings. All University personnel, persons working for any University affiliated company, and any persons conducting work on the Universities behalf are required to follow this policy.</p>
			      <h2>Definitions</h2>
			      <p>Shell space – any portion of a building that has not been completed during the original construction or renovation process. They generally have no interior walls, no finishes, and have exposed utilities and duct work. These spaces are usually intended to be completed in the future and have not been approved for occupancy.</p>
			      <p> Storage items – items left unattended in a building space with the intention of retrieving and using them or disposing of them at a later date. This can include, but is not limited to, the following:</p>
			      <ul>
			        <li> Construction materials</li>
			        <li> Equipment, whole or parts</li>
			        <li> Furnishings or casework</li>
			        <li> Stock such as office goods or maintenance items</li>
			        <li> Trash</li>
			        <li> Deliveries</li>
		          </ul>
			      <h2>Background</h2>
			      <p>Shell spaces are a common occurrence in University of Kentucky buildings. They provide flexibility for the University to configure usable space as needed after a building is constructed or renovated. Unfortunately, they also provide large, open areas that staff and facility personnel will use to accumulate storage items over time.</p>
			      <p> The accumulation of these items can create a substantial fire risk that shell spaces are not designed to contain. The Kentucky Building Code and the NFPA Life Safety Code use compartmentalization, fire-
		          resistance rated construction, and engineered fire protection systems to mitigate the different types of hazards found throughout a completed building. Shell spaces are designed and constructed to be empty, unoccupied portions of the building and may not provide the necessary protection elements required by the codes when used for storage.</p>
			      <h2>Shell Space Usage</h2>
			      <p>Shell spaces shall not be utilized for the storage of any items for any length of time unless specifically approved the by the University Fire Marshal’s Office. Any items found in shell spaces and not approved must be removed immediately. Removal of these items will be at the expense of the responsible department or unit. When such items are observed during building inspections, the University Fire Marshal's Office will notify the responsible department or unit person(s) or project construction manager that the items must be removed. Items not removed are subject to be picked up by Trucking and taken to Surplus Property. Monetary fees associated with moving these items will be the responsibility of the department/unit.</p>
			      <p> There shall be no occupancy of shell spaces for any length of time by any person unless authorized by the University Fire Marshal’s Office. These spaces are not designed to conform to the code requirements for occupancy. If any person is found to be working in or otherwise occupying a shell space, they will be asked to leave the area immediately. The University Fire Marshal’s Office reserves the right to revoke the responsible department or unit’s access to the shell space.</p>
			      <h2>Shell Space Requirements and Approval Process</h2>
			      <p>Any shell space created by new construction or renovation shall have NO STORAGE signs posted conspicuously throughout the space. This policy applies retroactively and shall be implemented in any shell space currently existing in University buildings. Signs shall meet the following requirements:</p>
			      <p> • Signs must be at least 8.5” x 11”.<br>
			        • Letters in contrasting color to the background.<br>
			        • Approval for the number and placement of the signs will be provided by the University Fire Marshal’s Office.<br>
		          • An <a href="no_storage_sign.pdf">example sign is provided here</a>.</p>
			      <p>			        If any department or unit wishes to use a shell space for temporary storage purposes, they must first request approval from the University Fire Marshal’s Office. A <a href="shell_space_request.pdf">form is provided here</a>. If approval is granted for temporary storage, the following requirements shall be met:</p>
			      <p> • Each grouping of approved items will be marked with flagging tape.<br>
			        • An approval form will be attached to each grouping and will contain the type of items, the approximate number of items, the approval date, the expected removal date, contact information for the responsible person, and approval signatures from the Unversity Fire Marshal.<br>
			        <br>
		          The decision to approve the storage of any item in a shell space will include but not be limited to the following information:</p>
			      <p> • What is the combustibility of the items being stored?<br>
			        • Are the items hazardous?<br>
			        • How much fuel loading do the items create?<br>
			        • Is the sprinkler system designed to handle the additional fuel loading?<br>
			        • How long will the items be stored?<br>
		          • What is the construction of the shell space?</p>
			      <p> The following items shall not be considered and are not allowed to be stored in shell spaces under any circumstances:</p>
			      <p> • Flammable or combustible liquids in any quantity<br>
			        • Pressurized cylinders<br>
			        • Biohazard materials<br>
			        • Radioactive materials<br>
			        • Hazardous or toxic chemicals<br>
		          • Trash or construction debris such as stacked pallets, crates, cardboard, etc.</p>
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