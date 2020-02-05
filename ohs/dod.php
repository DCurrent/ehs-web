<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Occupational Health &amp; Safety</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

<link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />

<?php 
	$cLRoot		= $cDocroot."ohs/";
?>
</head>

<body>

<div id="container">
	<div id="mainNavigation">
		<?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
	</div>
	<div id="subContainer">
		<?php include($cLRoot."a_banner_0001.php"); ?>
		<div id="subNavigation">
		 	<?php include($cLRoot."a_subnav_0001.php"); ?> 
		</div>
		<div id="content">
		  <h1>Department of Defense Grant 
  Application</h1>
		  <p>The 
        Occupational Health and Safety department issues the Certificate of Environmental 
        Compliance for DOD Grant Applications. For OH&amp;S to do this in a timely 
        manner please contact <a href="mailto:Jacquelyn.rhinehart@uky.edu?subject=DOD Grants">Jackie Rhinehart</a> within two (2) weeks before proposal deadline, and have the 
        following information prepared for review. </p>
		  <ul>
		    <li>Names 
		      of all people working on this grant</li>
		    <li> Location this activity will take place</li>
		    <li> E-mail the Certificate of Environmental Compliance as a 
		      Word Doc.</li>
		    <li> <a href="/docs/pdf/ohs_dod_example_safety_plan_0001.pdf" target="_blank">Example Proposal Safety 
		      Plan</a>
		    </li>
		    <li>		      <a href="/docs/pdf/ohs_dod_proposal_safety_plan_0001.pdf" target="_blank">Proposal Safety Plan</a> (DOD Form)
		    </li>
		    <li>		      <a href="//www.safety.vanderbilt.edu/bio/DOD_PI_assurance.pdf" target="_blank">PI Assurance</a> (DOD Form)
		    </li>
		    <li><a href="https://cdmrp.org/files/forms/regulatory/cec.pdf" target="_blank">CEC Form</a>

		    </li>
		    <li>		      <a href="/classes/safe_checklist_lab_0001.php">Grants and Contracts Checklist</a> (UK Form)</li>
	      </ul>
<p>The final 
            step will be a lab inspection. This inspection will include a review 
            of your lab specific <a href="chp">Chemical Hygiene Plan</a> as well the physical space 
            the research is to be conducted.</p>
          <h2>Other information 
            of interest:</h2>
          <p>Facility
            Safety Plan. An organization wide plan has been submitted by the
            University
            of Kentucky. See <a href="https://mrmc.amedd.army.mil/index.cfm?pageid=researcher_resources.safety" target="_blank">here</a> for approval information.</p>
</div>       
	</div>    
	<div id="sidePanel">		
		<?php include($cLRoot."a_sidepanel_0001.php"); ?>		
	</div>
	<div id="footer">
		<?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
	</div>
</div>

<div id="footerPad">
<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
</div>
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