<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 

	// Verify user authorization and get account info.
	$oAcc->access_verify();	
?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Environmental Health And Safety</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="libraries/css/style.css" type="text/css" />
<link rel="stylesheet" href="libraries/css/print.css" type="text/css" media="print" />

<style type="text/css">
.FormButton {	font-family: verdana, arial, sans-serif;
	font-size: 9px;
	background-color: #006699;
	color: #FFFFFF;
	font-weight: bold;
	padding: 1px;
	margin: 2px;
	border-top: outset 1px #3399FF;
	border-right: outset 1px #3333CC;
	border-bottom: outset 1px #3333CC;
	border-left: outset 1px #3399FF;
}
</style>
</head>

<body>

<div id="container">
	<div id="mainNavigation">
		<?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
	</div>
	<div id="subContainer">
		<?php include($cDocroot."a_banner_0001.php"); ?>
		<div id="subNavigation">
		 	<?php include($cDocroot."a_subnav_0001.php"); ?> 
		</div>
		<div id="content">
			<h1>Grants And Contracts Checklist</h1>
		  <p>The questions below will help you assess the environmental, health, and safety needs and compliance requirements of your research project. If you answer &quot;yes&quot; to a numbered question, then in most instances compliance will require &quot;yes&quot; answers to the questions that follow. These requirements must be met before initiating research. If you have questions or need assistance with any of these responsibilities, you may contact the <a href="/">Environmental Health &amp; Safety office</a> at 257-3845. The form will be sent electronically to the <a href="/">Environmental Health &amp; Safety office</a>. After submitting the form, you will be presented with a copy to print for your records.</p>
	      <form action="grantsubmitted.php" method="post" name="grants" id="grants">
          <table width="100%" align="center" border="0" cellpadding="0" cellspacing="0">
		        <tr>
		          <td><ol>
		            <li>Will 
		              any of the research be conducted in a laboratory?<br />
		              <input type="radio" name="no1" value="yes" />
		              Yes
		              <input type="radio" name="no1" value="no" />
		              No<br />
		              <br />
		              Does the lab meet minimum <a href="docs/pdf/Labs approved.pdf" target="_blank">UK 
		                Standards</a> for the intended uses?
		                <br />
	                  <input type="radio" name="no1b" value="yes" />
		              Yes
		              <input type="radio" name="no1b" value="no" />
		              No <br />
		              <br />
	                </li>
		            <li>Will 
		              chemicals be used?
		              <br />
		              <input type="radio" name="no2" value="yes" />
		              Yes
		              <input type="radio" name="no2" value="no" />
		              No<br />
		              <br />
		              If used in a lab, do you have a <a  href="ohs/chp" target="_blank">Chemical 
		                Hygiene Plan</a> (CHP)?
		                <br />
	                  <input type="radio" name="no2b" value="yes" />
		              Yes
		              <input type="radio" name="no2b" value="no" />
		              No<br />
		              <br />
		              If used somewhere other than a lab, do you have a <a  href="ohs/hazcom.html" target="_blank">Hazard 
		                Communication Program</a>?<br />
		              <input type="radio" name="no2c" value="yes" />
		              Yes
		              <input type="radio" name="no2c" value="no" />
		              No<br />
		              <br />
		              Has everyone who will be working with chemicals completed <a  href="/classes/classes_ohs_0001.php#chemical_hygiene" target="_blank">CHP/Lab 
		                Safety Training</a> or <a href="classes/classes_ohs_0001.php#hazard_communication">Hazard Communication Training</a>?
		                <br />
	                  <input type="radio" name="no2d" value="yes" />
		              Yes
		              <input type="radio" name="no2d" value="no" />
		              No<br />
		              <br />
		              Has everyone who will be working with chemicals completed <a href="/classes/classes_env_0001.php#hazardous_waste" target="_blank">Hazardous 
		                Waste Training</a>?
		                <br />
	                  <input type="radio" name="no2e" value="yes" />
		              Yes
		              <input type="radio" name="no2e" value="no" />
		              No <br />
		              <br />
	                </li>
		            <li>Will any Homeland Security <a href="cfats">Chemicals of Interest (COIs)</a> be stored or used? <br />
		              <input type="radio" name="no3" value="yes" />
		              Yes
		              <input type="radio" name="no3" value="no" />
		              No<br />
		              <br />
		              Have all inventories been submitted to the Environmental Health &amp; Safety  Office? <br />
		              <input type="radio" name="no3b" value="yes" />
		              Yes
		              <input type="radio" name="no3b" value="no" />
		              No<br />
		              <br />
	                </li>
		            <li>Will 
		              Manufactured Nanoparticles (MNPs) be used?
		              <br />
		              <input type="radio" name="no4" value="yes" />
		              Yes
		              <input type="radio" name="no4" value="no" />
		              No <br />
		              <br />
	                </li>
		            <li>Will research involve field research or teaching field courses off campus, involve wildlife, or work performed at field stations or nature preserves?
		            	<br />
		            	<input type="radio" name="wildlife" value="yes" />
		              Yes
		              <input type="radio" name="wildlife" value="no" />
		              No <br />
		              <br />
		            </li>
		            <li>Will infectious or potentially infectious microorganisms, hazardous biological materials and/or recombinant or synthetic nucleic acid containing material?  (Infectious agents are microbial agents which can colonize humans, plants, and/or animals and which may or may not cause disease)
		              <br />
		              <input type="radio" name="no5" value="yes" />
		              Yes
		              <input type="radio" name="no5" value="no" />
		              No <br />
		              <br />
		              If used, has everyone who will work with infectious or potentially infectious microorganisms, hazardous biological materials and/or recombinant or synthetic nucleic acid containing material completed <a href="/classes/classes_biosafety_0001.php#biological_safety">Biological Safety Training</a>? <br />
		              <input type="radio" name="no5b" value="yes" />
		              Yes
		              <input type="radio" name="no5b" value="no" />
		              No <br />
		              <br />
		              Do you have a copy of the <a href="docs/pdf/bio_uk_biosafety_manual_0001.pdf">UK Biosafety Manual</a>?
		              <br />
		              <input type="radio" name="no5c" value="yes" />
		              Yes
		              <input type="radio" name="no5c" value="no" />
		              No<br />
		              <br />
		              Do you have a copy of the <a href="//oba.od.nih.gov/rdna/nih_guidelines_oba.html">NIH Guidelines</a>?
		              <br />
		              <input type="radio" name="no5d" value="yes" />
		              Yes
		              <input type="radio" name="no5d" value="no" />
		              No<br />
		              <br />
		              Have you submitted the <a href="biosafety/form.php">applicable registration forms</a> to the Institutional Biosafety Committee?
		              <br />
		              <input type="radio" name="no5e" value="yes" />
		              Yes
		              <input type="radio" name="no5e" value="no" />
		              No<br />
		              <br />
		              Will any <a href="//www.selectagents.gov/">HHS Select Agents or USDA High Consequence Livestock Pathogens, Toxins or Plant Pathogens</a> be used, stored, transported, shipped or received?
		              <br />
		              <input type="radio" name="no5f" value="yes" />
		              Yes
		              <input type="radio" name="no5f" value="no" />
		              No<br />
		              <em>If you answer &quot;Yes&quot; to this item, you must contact the <a href="/biosafety">Biological  Safety Office</a> (257-1049) immediately for specific requirements.</em><br />
		              <br />
	                </li>
		            <li>Will an autoclave be used?
		              <br />
		              <input type="radio" name="no6" value="yes" />
		              Yes
		              <input type="radio" name="no6" value="no" />
		              No<br />
		              <br />
		              If used, has everyone that will be utilizing an autoclave completed <a href="classes/classes_biosafety_0001.php#autoclave">Autoclave Training</a>?<br />
		              <input type="radio" name="no6b" value="yes" />
		              Yes
		              <input type="radio" name="no6b" value="no" />
		              No<br />
		              <br />
	                </li>
		            <li>Will the research involve human gene transfer or vectors for use in human gene transfer?
		              <br />
		              <input type="radio" name="no7" value="yes" />
		              Yes
		              <input type="radio" name="no7" value="no" />
		              No<br />
		              <br />
		              Do you have a copy of the <a href="docs/pdf/bio_uk_biosafety_manual_0001.pdf">UK Biosafety Manual</a>?
		              <br />
		              <input type="radio" name="no7b" value="yes" />
		              Yes
		              <input type="radio" name="no7b" value="no" />
		              No<br />
		              <br />
		              Do you have a copy of the <a href="//oba.od.nih.gov/rdna/nih_guidelines_oba.html" target="_blank">NIH 
		                Guidelines</a>?
		                <br />
	                  <input type="radio" name="no7c" value="yes" />
		              Yes
		              <input type="radio" name="no7c" value="no" />
		              No<br />
		              <br />
		              Have you submitted a <a href="biosafety/form.php">Gene Transfer Registration Form</a> to the Institutional Biosafety Committee?
		              <br />
		              <input type="radio" name="no7d" value="yes" />
		              Yes
		              <input type="radio" name="no7d" value="no" />
		              No<br />
		              <br />
	                </li>
		            <li>Will human blood, body  fluids, or tissues be used (includes human cell/tissue culture)?
		              <br />
		              <input type="radio" name="no8" value="yes" />
		              Yes
		              <input type="radio" name="no8" value="no" />
		              No<br />
		              <br />
		             
		              Have you submitted the <a href="http://ehs.uky.edu/biosafety/form.php">applicable registration forms</a> to the Institutional Biosafety Committee?
		              <br />
		              <input type="radio" name="ibc_forms" value="yes" />
		              Yes
		              <input type="radio" name="ibc_forms" value="no" />
		              No<br />
		              <br />
		              Has everyone who will be working with human blood, body fluids or tissues completed <a href="/classes/classes_biosafety_0001.php#bloodborne_pathogens_for_researchers">Bloodborne Pathogens Training for Researchers</a>?
		              <br />
		              <input type="radio" name="no8c" value="yes" />
		              Yes
		              <input type="radio" name="no8c" value="no" />
		              No<br />
		              <br />
	                </li>
		            <li>Will radioactive materials  be used?
		              <br />
		              <input type="radio" name="no9" value="yes" />
		              Yes
		              <input type="radio" name="no9" value="no" />
		              No<br />
		              <br />
		              Do you have a copy of the <a href="radiation/KYReg/radman.html" target="_blank">UK Radiation Safety Manual</a>?
		              <br />
		              <input type="radio" name="no9b" value="yes" />
		              Yes
		              <input type="radio" name="no9b" value="no" />
		              No<br />
		              <br />
		              Have you submitted the forms for an &quot;<a href="radiation/radauth.html" target="_blank">Authorization to Possess and Use Radioactive Materials</a>&quot;  to the Radiation Safety Committee?
		              <br />
		              <input type="radio" name="no9c" value="yes" />
		              Yes
		              <input type="radio" name="no9c" value="no" />
		              No<br />
		              <br />
		              Has everyone who will be working with radioactive materials completed <a href="/classes/classes_radiation_0001.php">Radiation Safety Training</a>?
		              <br />
		              <input type="radio" name="no9d" value="yes" />
		              Yes
		              <input type="radio" name="no9d" value="no" />
		              No<br />
		              <br />
	                </li>
		            <li>Will any &quot;dangerous  goods&quot; be shipped?
		              <br />
		              <input type="radio" name="no10" value="yes" />
		              Yes
		              <input type="radio" name="no10" value="no" />
		              No<br />
		              <br />
		              Has everyone who will be preparing dangerous goods for shipment completed training on the U.S. Department of Transportation (DOT) <a href="//hazmat.dot.gov/">hazardous materials regulations</a> and the International Air Transport Association (IATA) <a href="//www.iata.org/whatwedo/cargo/dangerous_goods/Pages/index.aspx">dangerous materials regulations</a>?<br />
		              <input type="radio" name="no10b" value="yes" />
		              Yes
		              <input type="radio" name="no10b" value="no" />
		              No<br />
		              <em>(&quot;Dangerous  goods,&quot; as defined by U.S. DOT, include explosives, compressed gases,  flammable liquids and gases, oxidizers, reactives, poisons, infectious  substances, radioactive materials, and corrosive materials.)</em> <br />
		              <br />
	                </li>
		            <li>Will x-ray producing  devices be used?
		              <br />
		              <input type="radio" name="no11" value="yes" />
		              Yes
		              <input type="radio" name="no11" value="no" />
		              No<br />
		              <br />
		              Has the device been registered with the <a href="radiation/KYReg/appf.html" target="_blank">Radiation Safety Office</a>?
		              <br />
		              <input type="radio" name="no11b" value="yes" />
		              Yes
		              <input type="radio" name="no11b" value="no" />
		              No<br />
		              <br />
		              Do you have a copy of the <a href="radiation/xrayman.html" target="_blank">UK Radiation Safety Manual for Radiation-Producing Devices</a>?
		              <br />
		              <input type="radio" name="no11c" value="yes" />
		              Yes
		              <input type="radio" name="no11c" value="no" />
		              No<br />
		              <br />
	                </li>
		            <li>Will Class IIIb or IV  lasers be used?
		              <br />
		              <input type="radio" name="no12" value="yes" />
		              Yes
		              <input type="radio" name="no12" value="no" />
		              No<br />
		              <br />
		              Has the device been registered with the <a href="radiation/app_B.html" target="_blank">Radiation Safety Office</a>?
		              <br />
		              <input type="radio" name="no12b" value="yes" />
		              Yes
		              <input type="radio" name="no12b" value="no" />
		              No<br />
		              <br />
		              Do you have a copy of the <a href="/docs/pdf/rad_laser_safety_manual.pdf" target="_blank">UK Laser Safety Manual</a>?
		              <br />
		              <input type="radio" name="no12c" value="yes" />
		              Yes
		              <input type="radio" name="no12c" value="no" />
		              No<br />
		              <br />
		              Has everyone who will be working with lasers completed <a href="/classes/classes_radiation_0001.php#laser_safety">Laser  Safety Training</a>?<br />
		              <input type="radio" name="no12d" value="yes" />
		              Yes
		              <input type="radio" name="no12d" value="no" />
		              No<br />
		              <br />
	                </li>
		            <li>Will diving (snorkel,  SCUBA, hookah, or any other similar diving practice) be involved?
		              <br />
		              <input type="radio" name="no13" value="yes" />
		              Yes
		              <input type="radio" name="no13" value="no" />
		              No<br />
		              <br />
		              Have you submitted a Scientific Diving Project Application to the UK  Diving Control Board?
		              <br />
		              <input type="radio" name="no13b" value="yes" />
		              Yes
		              <input type="radio" name="no13b" value="no" />
		              No<br />
		              <br />
	                </li>
		            <li>Are portable fire  extinguishers available for use?
		              <br />
		              <input type="radio" name="no14" value="yes" />
		              Yes
		              <input type="radio" name="no14" value="no" />
		              No<br />
		              <br />
		              Has everyone who will be permitted to use a fire extinguisher in an  emergency completed <a href="/classes/classes_fire_0001.php#fire_extinguisher_use">Fire Extinguisher Training</a>?
		              <br />
		              <input type="radio" name="no14b" value="yes" />
		              Yes
		              <input type="radio" name="no14b" value="no" />
		              No<br />
		              <br />
	                </li>
		            <li>Will respirators be used?
		              <br />
		              <input type="radio" name="no15" value="yes" />
		              Yes
		              <input type="radio" name="no15" value="no" />
		              No<br />
		              <br />
		              Do you have a <a href="ohs/respgate.php" target="_blank">Respiratory Protection Program</a>?
		              <br />
		              <input type="radio" name="no15b" value="yes" />
		              Yes
		              <input type="radio" name="no15b" value="no" />
		              No<br />
		              <br />
		              Has everyone who will be using a respirator completed <a href="/classes/classes_ohs_0001.php#respirator_use">Respirator Training</a>?<br />
		              <input type="radio" name="no15c" value="yes" />
		              Yes
		              <input type="radio" name="no15c" value="no" />
		              No<br />
		              <br />
		              Has everyone who will be using a respirator had a fit-test  and medical evaluation? <br />
		              <input type="radio" name="no15d" value="yes" />
		              Yes
		              <input type="radio" name="no15d" value="no" />
		              No<br />
		              <br />
	                </li>
		            <li>Will animals,  animal-derived material or biological materials be imported? <br />
		              <input type="radio" name="no16" value="yes" />
		              Yes
		              <input type="radio" name="no16" value="no" />
		              No<br />
		              <br />
		              Have you received all USDA, <a href="//www.cdc.gov/od/ohs/biosfty/imprtper.htm" target="_blank">CDC</a> and other required permits?
		              <br />
		              <input type="radio" name="no16b" value="yes" />
		              Yes
		              <input type="radio" name="no16b" value="no" />
		              No<br />
		              <br />
	                </li>
		            <li>Will renovation or new  construction be needed in a lab or other work area associated with the  research?
		              <br />
		              <input type="radio" name="no17" value="yes" />
		              Yes
		              <input type="radio" name="no17" value="no" />
		              No<br />
		              <br />
		              Have the drawings and plans been submitted to the <a href="fire/plan01.html" target="_blank">University  Fire&nbsp;Marshal</a> for review and approval?
		              <br />
		              <input type="radio" name="no17b" value="yes" />
		              Yes
		              <input type="radio" name="no17b" value="no" />
		              No<br />
		              <br />
                    </li>
		            </ol></td>
	            </tr>
		        <tr>
		          <td>
		            <p>I have read 
		              and understand the environmental health and safety requirements related 
		              to my research project. I have answered the above questions accurately 
		              to the best of my knowledge. As principal investigator, I am aware of 
		              those areas where I am required to provide lab-specific or project-specific 
		              training, and that training has been completed. Everyone who will be 
		              working on my research project will receive all of the required training 
	                prior to commencing work.</p></td>
	            </tr>
		        <tr>
		          <td><center>
		            <table width="85%" border="0" cellspacing="0" cellpadding="0">
		              <tr valign="middle">
		                <td width="21%">Name</td>
		                <td width="79%"><input type="text" name="name" size="35" /></td>
	                  </tr>
		              <tr valign="middle">
		                <td width="21%">Department</td>
		                <td width="79%"><input type="text" name="dept" size="35" /></td>
	                  </tr>
		              <tr valign="middle">
		                <td width="21%">Phone</td>
		                <td width="79%"><input type="text" name="phone" size="35" /></td>
	                  </tr>
		              <tr valign="middle">
		                <td width="21%">Project 
		                  Title</td>
		                <td width="79%"><input type="text" name="title" size="35" /></td>
	                  </tr>
		              <tr valign="middle">
		                <td colspan="2"><br />
		                  <table width="18%" border="0" cellspacing="0" cellpadding="0" align="left">
		                    <tr>
		                      <td width="46%"><input type="submit" name="Submit" value="Submit" /></td>
		                      <td width="54%"><input type="reset" name="reset" value="Reset" /></td>
	                        </tr>
	                      </table></td>
	                  </tr>
	                </table>
		            <br />
		            </center></td>
	            </tr>		        
	        </table>
	      </form>
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