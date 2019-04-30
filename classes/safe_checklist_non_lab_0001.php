<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Environmental Health And Safety</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

<link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />

<?php 
	$cLRoot		= $cDocroot."classes/"; 
?>
</head>

<body>

<div id="container">
	<div id="mainNavigation">
		<?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
	</div>
	<div id="subContainer">
		<?php include("a_banner_0001.php"); ?>
		<div id="subNavigation">
		 	<?php include("a_subnav_0001.php"); ?> 
		</div>
		<div id="content">
		  <h1>Non-Laboratory Safety Training Checklist</h1>
		  <p>This checklist will assist faculty, supervisors and employees in determining the mandatory training required for specific job functions. </p>
		  <h3>All training is required to be completed prior to the Initiating Activity and thereafter at the specified frequency. </h3>
		  <table width="100%" border="2" cellspacing="0" cellpadding="1">
		    <tr>
		      <th>Activity</th>
		      <th>Training Requirements</th>
		      <th>Minimum Required Frequency*</th>
	        </tr>
		    <tr >
		      <td>Will anyone be permitted to use a fire extinguisher in an emergency?</td>
		      <td><a href="classes_fire_0001.php#fire_extinguisher_use">Fire Extinguisher Use</a></td>
		      <td>Initial, then annual</td>
	        </tr>
		    <tr >
		      <td>Will chemicals be used?</td>
		      <td><a href="classes_ohs_0001.php#hazard_communication">Hazard Communication</a><a href="classes_env_0001.php#hazardous_waste"></a></td>
		      <td><p>Once</p></td>
	        </tr>
		    <tr >
		      <td><p>Will the use of chemicals result in waste materials that are toxic, ignitable, reactive or corrosive? </p></td>
		      <td><a href="http://ehs.uky.edu/classes/classes_env_0001.php#hazardous_waste">Hazardous Waste</a></td>
		      <td> Initial, then annual</td>
	        </tr>
		    <tr>
		      <td rowspan="3" >Will radioactive materials be used?</td>
		      <td><a href="classes_radiation_0001.php#advanced_radiation_safety">Advanced  Radiation Safety</a></td>
		      <td><p>Initial - must  complete prior to being approved as an authorized user (AU)</p></td>
	        </tr>
		    <tr>
		      <td><p><a href="classes_radiation_0001.php#basic_radiation_safety">Basic Radiation Safety</a></p></td>
		      <td><p>Once - must complete after completion of    Initial Radiation Safety </p></td>
	        </tr>
		    <tr>
		      <td><p><a href="classes_radiation_0001.php#initial_radiation_safety">On-Site and Initial Radiation Safety</a></p></td>
		      <td>Initial &ndash; must complete prior to starting as a Radiation Worker</td>
	        </tr>
		    <tr>
		      <td>Will X-ray producing devices be used?</td>
		      <td><p><a href="classes_radiation_0001.php#analytical_xray">On-Site and Analytical X-Ray Safety</a></p></td>
		      <td>Once &ndash; must complete prior to starting as a Radiation Worker</td>
	        </tr>
		    <tr>
		      <td>Will human blood, body fluids, or tissues be used (includes human cell/tissue culture)?</td>
		      <td><a href="classes_ohs_0001.php#bloodborne_pathogens_general">Bloodborne Pathogens (General)</a><a href="classes_biosafety_0001.php#bloodborne_pathogens_for_researchers"></a></td>
		      <td><p>Initial, then annual</p></td>
	        </tr>
		    <tr>
		      <td>Will entry be made into confined spaces such as pits, tanks, tunnels,  silos, air handlers, or pipes?</td>
		      <td><a href="classes_ohs_0001.php#confined_space_entry">Confined Space Entry</a></td>
		      <td>Initial, then as needed.</td>
	        </tr>
		    <tr>
		      <td>Will Hot Work operations be conducted defined as those requiring the use  of an open flame or from those operations that may produce heat or sparks? </td>
		      <td><a href="classes_ohs_0001.php#hot_work_program">Hot Work</a> <a href="classes_biosafety_0001.php#biological_safety_cabinet"></a></td>
		      <td>Once</td>
	        </tr>
		    <tr>
		      <td>Will service or maintenance of equipment be performed where the unexpected  energization, start-up of equipment or release of stored energy could cause  injury?</td>
		      <td><a href="classes_ohs_0001.php#lockout_tagout">Lockout/Tagout</a><a href="classes_biosafety_0001.php#autoclave"></a></td>
		      <td>Initial, then as needed.</td>
	        </tr>
		    <tr>
		      <td rowspan="2" >Will any &quot;dangerous goods&quot; be shipped? (&quot;Dangerous goods,&quot; as defined by U.S. DOT, include explosives, compressed gases, flammable liquids and gases, oxidizers, reactives, poisons, infectious substances, radioactive materials, and corrosive materials.)</td>
		      <td><p><a href="classes_env_0001.php#dot_iata">DOT/IATA</a></p></td>
		      <td>Once</td>
	        </tr>
		    <tr>
		      <td><a href="classes_env_0001.php#dot_iata_recertification">DOT/IATA  Recertification</a></td>
		      <td>Every 2 years from date of initial training (DOT/IATA)</td>
	        </tr>
		    <tr>
		      <td>Will you be driving a 12 or 15-Passenger Van?</td>
		      <td><p><a href="classes_ohs_0001.php#pass_van">12-15 Passenger Van Safety Awareness</a></p></td>
		      <td><p>Once</p></td>
	        </tr>
		    <tr >
		      <td>Will respiratory protection (respirators) be used?</td>
		      <td><p><a href="classes_ohs_0001.php#respirator_use">Respirator Use</a></p></td>
		      <td><p>Initial, then annual</p></td>
	        </tr>
		    <tr >
		      <td>Will heights and working locations &gt;6 feet have to be accessed?</td>
		      <td><a href="classes_ohs_0001.php#ladder_safety">Fall  Protection and Ladder safety</a></td>
		      <td>Initial, then as needed.</td>
	        </tr>
		    <tr >
		      <td>Will Powered Platforms, Manlifts, and Vehicle-Mounted Work Platforms(e.g.,  lifts, scissors lifts, booms) be used?</td>
		      <td><a href="../docs/pdf/ohs_aerial_lift_safety_program_0001.pdf">Powered  Platforms</a></td>
		      <td>Once</td>
	        </tr>
		    <tr >
		      <td>Will forklifts be used?</td>
		      <td><a href="../docs/pdf/ohs_powered_industrial_truck_safety_program_0001.pdf">Powered  Industrial Trucks</a></td>
		      <td>Initial, then as needed.</td>
	        </tr>
		    <tr >
		      <td>Will  you be driving a <a href="http://www.uky.edu/EVPFA/Controller/files/BPM/E-14-3.pdf">utility/golf cart</a>?</td>
		      <td><a href="classes_ohs_0001.php#utility_cart">Utility Cart Training</a></td>
		      <td>Once</td>
	        </tr>
		    <tr >
		      <td>Will  you be performing tasks in <a href="https://www.osha.gov/SLTC/heatstress/">environments exceeding 85 F</a>?</td>
		      <td><a href="classes_ohs_0001.php#heat_stress">Heat Stress Awareness</a></td>
		      <td>Once</td>
	        </tr>
		    <tr >
		      <td>Will  you be sitting at a computer workstation for extended periods of time?</td>
		      <td><a href="/docs/pdf/ohs_worker_checklist_0001.pdf">Office Ergonomics Checklist</a></td>
		      <td>Initial, then as needed.</td>
	        </tr>
	      </table>
		  <h3>* More frequent and &quot;as needed&quot; training may be required whenever there are changes in employee job functions or regulations. </h3>
        </div>       
	</div>    
	<div id="sidePanel">		
			<?php include($cDocroot."a_sidepanel_0001.php"); ?>		
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