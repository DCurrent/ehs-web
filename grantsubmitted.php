<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>University of Kentucky - Environmental Health and Safety for Grants and Contracts</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta content="MSHTML 5.50.4522.1800" name="GENERATOR" />
<script language="JavaScript" type="text/javascript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
// -->
</script>
<link href="libraries/css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form action="grantsubmitted.php" method="post" name="grants" id="grants">
  <table width="650" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td valign="top"> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr valign="bottom"> 
            <td width="28%"><img src="media/image/ehslogo.gif" width="175" height="90" alt="UK Envirornmental Health and Safety" /></td>
            <td width="72%" valign="middle"> 
              <div align="center"><b>Environmental 
                Health and Safety Requirements for Research Grants and Contracts 
                Checklist</b></div>
            </td>
          </tr>
        </table>
      </td></tr>
  <tr>
    <td>
        <div align="center"> 
          <h2><img src="media/image/line2.gif" alt="" width="90%" height="1" /> </h2>
      </div></td></tr>
  <tr>
      <td> <ol>
        <li><strong>Will 
          any of the research be conducted in a laboratory?</strong><strong> </strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no1"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          Does the lab meet minimum <a href="docs/pdf/Labs approved.pdf" target="_blank">UK 
            Standards</a> for the intended uses?
            
            <?php
								echo "<b><em> ";
								echo $_POST["no1b"];
								echo "</b></em> ";
								?>
            <br />
          <br />
        </li>
        <li><strong>Will 
          chemicals be used? </strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no2"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          If used in a lab, do you have a <a  href="ohs/chp" target="_blank">Chemical 
            Hygiene Plan</a> (CHP)?
            
            <?php
								echo "<b><em> ";
								echo $_POST["no2b"];
								echo "</b></em> ";
								?>
            <br />
          <br />
          If used somewhere other than a lab, do you have a <a  href="ohs/hazcom.html" target="_blank">Hazard 
            Communication Program</a>?
            <?php
								echo "<b><em> ";
								echo $_POST["no2c"];
								echo "</b></em> ";
								?>
            <br />
          <br />
          Has everyone who will be working with chemicals completed <a  href="classes/chemhyg/" target="_blank">CHP/Lab 
            Safety Training</a> or <a href="classes/classes_ohs_0001.php#hazard_communication">Hazard Communication Training</a>?
            
            <?php
								echo "<b><em> ";
								echo $_POST["no2d"];
								echo "</b></em> ";
								?>
            <br />
          <br />
          Has everyone who will be working with chemicals completed <a href="/classes/main.php?cClassID=HAZWASTE" target="_blank">Hazardous 
            Waste Training</a>?
            
            <?php
								echo "<b><em> ";
								echo $_POST["no2e"];
								echo "</b></em> ";
								?>
            <br />
          <strong><br />
          </strong></li>
        <li><strong>Will any Homeland Security <a href="cfats">Chemicals of Interest (COIs)</a> be stored or used?</strong> 
          <?php
								echo "<b><em> ";
								echo $_POST["no3"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          Have all inventories been submitted to the Environmental Health &amp; Safety  Office? 
          <?php
								echo "<b><em> ";
								echo $_POST["no3b"];
								echo "</b></em> ";
								?>
          <br />
          <br />
        </li>
        <li><strong>Will 
          Manufactured Nanoparticles (MNPs) be used? </strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no4"];
								echo "</b></em> ";
								?>
          <br />
          <br />
        </li>
        <li><strong>Will infectious or potentially infectious microorganisms, hazardous biological materials and/or recombinant DNA be used?  (Infectious agents are microbial agents which can colonize humans, plants, and/or animals and which may or may not cause disease)</strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no5"];
								echo "</b></em> ";
								?>
        <br />
          <br />
          If used, has everyone who will work with infectious or potentially infectious microorganisms, hazardous biological materials and/or recombinant DNA completed <a href="classes/biosafety.php#biological_safety">Biological Safety Training</a>? <br />
          
          <?php
								echo "<b><em> ";
								echo $_POST["no5b"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          Do you have a copy of the <a href="docs/pdf/bio_uk_biosafety_manual_0001.pdf">UK Biosafety Manual</a>?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no5c"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          Do you have a copy of the <a href="//oba.od.nih.gov/rdna/nih_guidelines_oba.html">NIH Guidelines</a>?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no5d"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          Have you submitted the <a href="biosafety/form.php">applicable registration forms</a> to the Institutional Biosafety Committee?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no5e"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          Will any <a href="//www.selectagents.gov/">HHS Select Agents or USDA High Consequence Livestock Pathogens, Toxins or Plant Pathogens</a> be used, stored, transported, shipped or received?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no5f"];
								echo "</b></em> ";
								?>
          <br />
          <em>If you answer &quot;Yes&quot; to this item, you must contact the Biological  Safety Office (257-1049) immediately for specific requirements.</em><br />
          <br />
        </li>
        <li><strong>Will an autoclave be used?</strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no6"];
								echo "</b></em> ";
								?>
        <br />
          <br />
          If used, has everyone that will be utilizing an autoclave completed <a href="classes/classes_biosafety_0001.php#autoclave">Autoclave Training</a>?
          <?php
								echo "<b><em> ";
								echo $_POST["no6b"];
								echo "</b></em> ";
								?>
          <br />
          <br />
        </li>
        <li><strong>Will the research involve human gene transfer or vectors for use in human gene transfer?</strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no7"];
								echo "</b></em> ";
								?>
        <br />
          <br />
          Do you have a copy of the <a href="docs/pdf/bio_uk_biosafety_manual_0001.pdf">UK Biosafety Manual</a>?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no7b"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          Do you have a copy of the <a href="//oba.od.nih.gov/rdna/nih_guidelines_oba.html" target="_blank">NIH 
            Guidelines</a>?
            
            <?php
								echo "<b><em> ";
								echo $_POST["no7c"];
								echo "</b></em> ";
								?>
            <br />
          <br />
          Have you submitted a <a href="biosafety/form.php">Gene Transfer Registration Form</a> to the Institutional Biosafety Committee?
          <?php
								echo "<b><em> ";
								echo $_POST["no7d"];
								echo "</b></em> ";
								?>
          <br />
          <br />
        </li>
        <li><strong>Will human blood, body  fluids, or tissues be used (includes human cell/tissue culture)?</strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no8"];
								echo "</b></em> ";
								?>
        <br />
          <br />
          Do you have an <a href="docs/doc/bio_attachment_ecp.rtf">Exposure Control Plan for Bloodborne <em>Pathogens</em></a>?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no8b"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          Has everyone who will be working with human blood, body fluids or tissues completed <a href="classes/biosafety.php#bloodborne_pathogens_for_researchers">Bloodborne Pathogens Training</a>?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no8c"];
								echo "</b></em> ";
								?>
          <br />
          <br />
        </li>
        <li><strong>Will radioactive materials  be used? </strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no9"];
								echo "</b></em> ";
								?>
        <br />
          <br />
          Do you have a copy of the <a href="radiation/KYReg/radman.html" target="_blank">UK Radiation Safety Manual</a>?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no9b"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          Have you submitted the forms for an &quot;<a href="radiation/radauth.html" target="_blank">Authorization to Possess and Use Radioactive Materials</a>&quot;  to the Radiation Safety Committee?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no9c"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          Has everyone who will be working with radioactive materials completed <a href="/classes">Radiation Safety Training</a>?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no9d"];
								echo "</b></em> ";
								?>
          <br />
          <br />
        </li>
        <li><strong>Will any &quot;dangerous  goods&quot; be shipped? </strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no10"];
								echo "</b></em> ";
								?>
        <br />
          <br />
          Has everyone who will be preparing dangerous goods for shipment completed training on the U.S. Department of Transportation (DOT) <a href="//hazmat.dot.gov/">hazardous materials regulations</a> and the International Air Transport Association (IATA) <a href="//www.iata.org/whatwedo/cargo/dangerous_goods/Pages/index.aspx">dangerous materials regulations</a>?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no10b"];
								echo "</b></em> ";
								?>
          <br />
          <em>(&quot;Dangerous  goods,&quot; as defined by U.S. DOT, include explosives, compressed gases,  flammable liquids and gases, oxidizers, reactives, poisons, infectious  substances, radioactive materials, and corrosive materials.)</em> <br />
          <br />
        </li>
        <li><strong>Will x-ray producing  devices be used?</strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no11"];
								echo "</b></em> ";
								?>
        <br />
          <br />
          Has the device been registered with the <a href="radiation/KYReg/appf.html" target="_blank">Radiation Safety Office</a>?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no11b"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          Do you have a copy of the <a href="radiation/xrayman.html" target="_blank">UK Radiation Safety Manual for Radiation-Producing Devices</a>?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no11c"];
								echo "</b></em> ";
								?>
          <br />
          <br />
        </li>
        <li><strong>Will Class IIIb or IV  lasers be used?</strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no12"];
								echo "</b></em> ";
								?>
        <br />
          <br />
          Has the device been registered with the <a href="radiation/app_B.html" target="_blank">Radiation Safety Office</a>?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no12b"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          Do you have a copy of the <a href="/docs/pdf/rad_laser_safety_manual.pdf" target="_blank">UK Laser Safety Manual</a>?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no12c"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          Has everyone who will be working with lasers completed <a href="classes/laser/">Laser  Safety Training</a>?
          <?php
								echo "<b><em> ";
								echo $_POST["no12d"];
								echo "</b></em> ";
								?>
          <br />
          <br />
        </li>
        <li><strong>Will diving (snorkel,  SCUBA, hookah, or any other similar diving practice) be involved? </strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no13"];
								echo "</b></em> ";
								?>
        <br />
          <br />
          Have you submitted a Scientific Diving Project Application to the UK  Diving Control Board?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no13b"];
								echo "</b></em> ";
								?>
          <br />
          <br />
        </li>
        <li><strong>Are portable fire  extinguishers available for use? </strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no14"];
								echo "</b></em> ";
								?>
        <br />
          <br />
          Has everyone who will be permitted to use a fire extinguisher in an  emergency completed <a href="classes/fire/">Fire Extinguisher Training</a>?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no14b"];
								echo "</b></em> ";
								?>
          <br />
          <br />
        </li>
        <li><strong>Will respirators be used? </strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no15"];
								echo "</b></em> ";
								?>
        <br />
          <br />
          Do you have a <a href="ohs/respgate.php" target="_blank">Respiratory Protection Program</a>?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no15b"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          Has everyone who will be using a respirator completed <a href="classes/respirator/">Respirator Training</a>?
          <?php
								echo "<b><em> ";
								echo $_POST["no15c"];
								echo "</b></em> ";
								?>
          <br />
          <br />
          Has everyone who will be using a respirator had a fit-test  and medical evaluation? 
          
          <?php
								echo "<b><em> ";
								echo $_POST["no15d"];
								echo "</b></em> ";
								?>
          <br />
          <br />
        </li>
        <li><strong>Will animals,  animal-derived material or biological materials be imported?</strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no16"];
								echo "</b></em> ";
								?>
        <br />
          <br />
          Have you received all USDA, <a href="//www.cdc.gov/od/ohs/biosfty/imprtper.htm" target="_blank">CDC</a> and other required permits?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no16b"];
								echo "</b></em> ";
								?>
          <br />
          <br />
        </li>
        <li><strong>Will renovation or new  construction be needed in a lab or other work area associated with the  research? </strong>
          <?php
								echo "<b><em> ";
								echo $_POST["no17"];
								echo "</b></em> ";
								?>
        <br />
          <br />
          Have the drawings and plans been submitted to the <a href="fire/plan01.html" target="_blank">University  Fire&nbsp;Marshal</a> for review and approval?
          
          <?php
								echo "<b><em> ";
								echo $_POST["no17b"];
								echo "</b></em> ";
								?>
          <br />
        </li>
      </ol>        
	  </td></tr>

  <tr>

      <td valign="top"> 
        <center>
          <table width="85%" border="0" cellspacing="0" cellpadding="0">
            <tr valign="middle"> 
              <td width="21%"><b>Name</b></td>
              <td width="79%"> 
               					 
               					 <?php								
								echo $_POST["name"];								
								?>
			                </td>
            </tr>
            <tr valign="middle"> 
              <td width="21%"><b>Department</b></td>
              <td width="79%"> 
                				
                				<?php								
								echo $_POST["dept"];								
								?>
			                </td>
            </tr>
            <tr valign="middle"> 
              <td width="21%"><b>Phone</b></td>
              <td width="79%"> 
                				
                				<?php								
								echo $_POST["phone"];								
								?>
			                </td>
            </tr>
            <tr valign="middle"> 
              <td width="21%"><b>Project 
                Title</b></td>
              <td width="79%"> 
                				
                				<?php								
								echo $_POST["title"];															
								?>
			                </td>
            </tr>
          </table>
		          
        </center>
          
      </td></tr>
  </table>
</form>
<?php
//Setting up email function
			$todaysdate = date("jS F Y");
			$toaddress = "lpoor2@uky.edu, dvcask2@uky.edu";
			$subject = "Research Grants and Contracts Checklist " .$todaysdate;
			$mailcontent = "Today's date: " .$todaysdate."\n\n"
			
."1) Will any of the research be conducted in a laboratory?: ".$_POST["no1"]."\n"
."Does the lab meet minimum UK standards for the intended uses?: ".$_POST["no1b"]."\n\n"

."2) Will chemicals be used?: ".$_POST["no2"]."\n"
."If used in a lab, do you have a Chemical Hygiene Plan (CHP)?: ".$_POST["no2b"]."\n"							
."If used somewhere other than a lab, do you have a Hazard Communication Program?: ".$_POST["no2c"]."\n"
."Has everyone who will be working with chemicals completed CHP/Lab Safety Training or Hazard Communication Training?: ".$_POST["no2d"]."\n"
."Has everyone who will be working with chemicals completed Hazardous Waste Training?: " .$_POST["no2e"]."\n\n"

."3) Will any Homeland Security Chemicals of Interest (COIs) be stored or used?: ".$_POST['no3']."\n"
."Have all inventories been submitted to the Environmental Health & Safety Office?: " .$_POST["no3b"]."\n\n"

."4) Will Manufactured Nanoparticles (MNPs) be used?: ".$_POST["no4"]."\n\n"

."5) Will infectious or potentially infectious microorganisms, hazardous biological materials and/or recombinant DNA be used? (Infectious agents are microbial agents which can colonize humans, plants, and/or animals and which may or may not cause disease) : ".$_POST["no5"]."\n"
."If used, has everyone who will work with infectious or potentially infectious microorganisms, hazardous biological materials and/or recombinant DNA completed Biological Safety Training?: ".$_POST["no5b"]."\n"
."Do you have a copy of the UK Biosafety Manual? ".$_POST["no5c"]."\n"
."Do you have a copy of the NIH Guidelines?: ".$_POST["no5d"]."\n"
."Have you submitted the applicable registration forms to the Institutional Biosafety Committee? ".$_POST["no5e"]."\n"
."Have you submitted the applicable registration forms to the Institutional Biosafety Committee? ".$_POST["no5f"]."\n\n"

."6) Will an autoclave be used?: ".$_POST["no6"]."\n"
."If used, has everyone that will be utilizing an autoclave completed Autoclave Training?: ".$_POST["no6b"]."\n\n"

."7) Will the research involve human gene transfer or vectors for use in human gene transfer?: ".$_POST["no7"]."\n"
."Do you have a copy of the UK Biosafety Manual?: ".$_POST["no7b"]."\n"
."Do you have a copy of the NIH Guidelines?: ".$_POST["no7c"]."\n"
."Have you submitted a Gene Transfer Registration Form to the Institutional Biosafety Committee?: ".$_POST["no7d"]."\n\n"

."8) Will human blood, body fluids, or tissues be used (includes human cell/tissue culture)? : ".$_POST["no8"]."\n"
."Do you have an Exposure Control Plan for Bloodborne Pathogens?: ".$_POST["no8b"]."\n"
."Has everyone who will be working with human blood, body fluids or tissues completed Bloodborne Pathogens Training?: ".$_POST["no8c"]."\n\n"

."9) Will radioactive materials be used?: ".$_POST["no9"]."\n"
."Do you have a copy of the UK Radiation Safety Manual? : ".$_POST["no9b"]."\n"
."Have you submitted the forms for an Authorization to Possess and Use Radioactive Materials to the Radiation Safety Committee? : ".$_POST["no9c"]."\n"
."Has everyone who will be working with radioactive materials completed Radiation Safety Training? : ".$_POST["no9d"]."\n\n"

."10) Will any dangerous goods be shipped?: ".$_POST["no10"]."\n"
."Has everyone who will be preparing dangerous goods for shipment completed training on the U.S. Department of Transportation (DOT) hazardous materials regulations and the International Air Transport Association (IATA) dangerous materials regulations?: ".$_POST["no10b"]."\n\n"

."11) Will x-ray producing devices be used?: ".$_POST["no11"]."\n"
."Has the device been registered with the Radiation Safety Office?: ".$_POST["no11b"]."\n"
."Do you have a copy of the UK Radiation Safety Manual for Radiation-Producing Devices?: ".$_POST["no11b"]."\n\n"

."12) Will Class IIIb or IV lasers be used?: ".$_POST["no12"]."\n"
."Has the device been registered with the Radiation Safety Office?: ".$_POST["no12b"]."\n"
."Do you have a copy of the UK Laser Safety Manual? : ".$_POST["no12c"]."\n"
."Has everyone who will be working with lasers completed Laser Safety Training? : ".$_POST["no12d"]."\n\n"

."13) Will diving (snorkel, SCUBA, hookah, or any other similar diving practice) be involved?: ".$_POST["no13"]."\n"
."Have you submitted a Scientific Diving Project Application to the UK Diving Control Board? : ".$_POST["no13b"]."\n\n"

."14) Are portable fire extinguishers available for use?: ".$_POST["no14"]."\n"
."Has everyone who will be permitted to use a fire extinguisher in an emergency completed Fire Extinguisher Training?: ".$_POST["no14b"]."\n\n"

."15) Will respirators be used?: ".$_POST["no15"]."\n\n"
."Do you have a Respiratory Protection Program?: ".$_POST["no15b"]."\n"
."Has everyone who will be using a respirator completed Respirator Training?: ".$_POST["no15c"]."\n"
."Has everyone who will be using a respirator had a fit-test and medical evaluation?: ".$_POST["no15d"]."\n\n"

."16) Will animals, animal-derived material or biological materials be imported?: ".$_POST["no16"]."\n"
."Have you received all USDA, CDC and other required permits? : ".$_POST["no16b"]."\n\n"

."17) Will renovation or new construction be needed in a lab or other work area associated with the research?: ".$_POST["no17"]."\n"
."Have the drawings and plans been submitted to the University Fire Marshal for review and approval? : ".$_POST["no17b"]."\n\n\n"

."Name: ".$_POST["name"]."\n"
."Department: ".$_POST["dept"]."\n"
."Phone: ".$_POST["phone"]."\n"
."Title: ".$_POST["title"]."\n";
							
			$fromaddress = "Research Grants and Contracts Checklist";
			mail($toaddress, $subject, $mailcontent, $fromaddress);
?>
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