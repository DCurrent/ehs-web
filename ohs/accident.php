<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Occupational Health &amp; Safety, Accidents</title>
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
			<h1>Reporting  Your Accident</h1>
		  <p>All accidents,  injuries, or illnesses must be reported as quickly as possible. Any fatal  accident, any accident requiring hospitalization of one or more people, any  injury/illness that results in the loss of consciousness, any injury that  results in 2nd degree burns to more than 30% of the body or 3rd degree burns to  more than 20% of the body, any incident that results in amputation, or any  incident that results in injuries and/or illnesses to more than two employees  MUST BE REPORTED to Occupational Health and Safety IMMEDIATELY by calling (859)  227-7499. A representative of the University of Kentucky&rsquo;s OH&amp;S Department  will need to obtain the required information. Refer to the University's  Occupational Injury and Exposure Protocol for Laboratories <a href="/docs/pdf/ohs_lab_exposure_protocol_0001.pdf" target="_blank">Occupational Injury and Exposure Protocol for Laboratories</a> for laboratory accident reporting procedures.</p>
		  <h2><a name="Employee" id="Employee"></a>Employee Accidents</h2>
          <h3>Primary Reporting Procedure </h3>
          <p>Employee accidents,  injuries, or illnesses should be reported immediately by the employee's  supervisor. Student workers receiving pay other than scholarships, fellowships,  student loans, or grants are generally considered employees. Supervisors must report the employee  accident, injury, or illness to UK Workers Care by calling 1-800-440-6285. </p>
          <h3>Secondary Reporting Procedure </h3>
          <p>Unsafe working  conditions, near-miss accidents or  incidents that  are not  required to be reported to Workers Care should be reported internally  using the <a href="/apps/incident">University's  Accident-Injury Report</a>.</p>
          <p>All <span class="alert">UK HealthCare incidents</span> should be reported at <a href="//careweb.mc.uky.edu/psn/">Care Web</a> (Only available on MC network).</p>
          <h2><a name="Student" id="Student"></a>Student Or Visitor Accidents</h2>
          <p>Any faculty or staff member witnessing or being informed of an accident involving a student or a visitor should report the accident using the <a href="/apps/incident">University's Accident-Injury Report</a>.</p>
          <h2><a name="Automobile" id="Automobile"></a>Automobile Accidents</h2>
		  <ul>
		    <li><a href="//www.uky.edu/EVPFA/Controller/risk.htm" target="_blank" class="link">Claims  Reporting and Accident Procedures</a> (Click Claims Heading)</li>
		    <li><a href="//www.uky.edu/EVPFA/Controller/risk.htm" target="_blank" class="link">Owned/Leased/Rented Vehicles</a> (Click Accidents Heading)</li>
		    <li><a href="//www.uky.edu/EVPFA/Controller/files/risk/vehicleaccidentreportform.pdf" target="_blank" class="link">UK Vehicle Accident Report Form</a></li>
	      </ul>
		  <h2><a name="Property" id="Property"></a>Property Damage Accidents</h2>
<p>Property Damage  accidents such as fire, water, wind, theft and other property damage claims are  not reported on any one form. After a loss is discovered, the loss should be  reported to the department head who will contact the University's <a href="twadki2@email.uky.edu" class="link">Risk  Manager</a> at 859-257-3372.</p>
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