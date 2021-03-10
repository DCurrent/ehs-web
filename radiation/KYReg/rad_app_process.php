<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 

error_reporting( error_reporting() & ~E_NOTICE );
?>

<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>Application for Authorization to Possess and Use Radioactive Materials</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style media="all" type="text/css">
@import url('rad_app.css');
@import "rad_app.css";
</style>
<script language="JavaScript" type="text/javascript">
function showMe (it, box) {
  var vis = (box.checked) ? "block" : "none";
  document.getElementById(it).style.display = vis;
}
</script>
<script language="JavaScript1.2" type="text/javascript">
<!--
function printpage() {
window.print();  
}
//-->
</script>
</head>
<body onload="printpage()">
  <table width="620" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr> 
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td><img src="../../media/image/rad_waste_app.png" alt="" width="371" height="58" /></td>
            <td align="right"><img src="../../media/image/app_symbol.png" alt="" width="208" height="52" /></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td><div align="center"><b> <img src="../media/image/line2.gif" alt="" width="590" height="1" /></b></div></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td class="border"><strong>Authorized User:</strong></td>
    </tr>
    <tr> 
      <td><table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr> 
            <td>Last Name<strong> &nbsp;&nbsp;
			<?php echo $_POST['lastName'];
				$lastName = $_POST['lastName'];
			 ?> </strong></td>
            <td>First Name<strong> &nbsp;&nbsp;
			<?php echo $_POST['firstName']; 
				$firstName = $_POST['firstName'];
			?> 
              </strong></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr> 
            <td>Dept<strong> &nbsp;&nbsp;
			<?php echo $_POST['dept']; 
				$dept = $_POST['dept'];
			?> </strong></td>
            <td>Building<strong> &nbsp;&nbsp;
			<?php echo $_POST['bldg'];
				$bldg = $_POST['bldg'];
			 ?> </strong></td>
            <td>Room #<strong> &nbsp;&nbsp;
			<?php echo $_POST['room'];
				$room = $_POST['room'];
			 ?> </strong></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr> 
            <td>Phone #<strong> &nbsp;&nbsp;
			<?php echo $_POST['phone']; 
				$phone = $_POST['phone'];
			?> </strong></td>
            <td>E-mail<strong> &nbsp;&nbsp;
			<?php echo $_POST['email'];
				$email = $_POST['email'];
			 ?> </strong></td>
            <td>UK Title<strong> &nbsp;&nbsp;
			<?php echo $_POST['UKtitle'];
				$UKtitle = $_POST['UKtitle'];
			 ?> </strong></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td>Project Title<strong>&nbsp;&nbsp;
	   <?php echo $_POST['projectTitle'];
	   		$projectTitle = $_POST['projectTitle'];
	    ?>  
        </strong></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td><table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr> 
            <td class="border"><strong>Where the material will be handled, stored 
              or waste will be stored:</strong></td>
          </tr>
		  <tr><td><strong>Use:</strong></td></tr>
          <tr> 
            <td>Building<strong> &nbsp;&nbsp; <?php echo $_POST['bldgUse'];
				$bldgUse = $_POST['bldgUse'];
			 ?> </strong></td>
          </tr>
          <tr> 
            <td>Room Number(s) &nbsp;&nbsp;<strong> <?php echo $_POST['roomUse'];
				$roomUse = $_POST['roomUse'];
			 ?> </strong> </td>
          </tr>
		  <tr><td><strong>Storage:</strong></td></tr>
          <tr> 
            <td>Building<strong> &nbsp;&nbsp; <?php echo $_POST['bldgStorage'];
				$bldgStorage = $_POST['bldgStorage'];
			 ?> </strong></td>
          </tr>
          <tr> 
            <td>Room Number(s)<strong>&nbsp;&nbsp;<?php echo $_POST['roomStorage'];
				$roomStorage = $_POST['roomStorage'];
			 ?></strong></td>
          </tr>
		  <tr><td><strong>Waste Storage:</strong></td></tr>
          <tr> 
            <td>Building<strong> &nbsp;&nbsp; <?php echo $_POST['bldgWasteStorage'];
				$bldgWasteStorage = $_POST['bldgWasteStorage'];
			 ?> </strong></td>
          </tr>
          <tr> 
            <td>Room Number(s) &nbsp;&nbsp;<strong><?php echo $_POST['roomWasteStorage'];
				$roomWasteStorage = $_POST['roomWasteStorage'];
			 ?> </strong> </td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td class="border"><strong>Radiological Data</strong></td>
    </tr>
    <tr> 
      <td><table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr valign="bottom"> 
            <td>Radionuclide</td>
            <td> <div align="center">Half-life</div></td>
            <td> <div align="center">Total Quantity<br />
                (mCi) </div></td>
            <td> <div align="center">Max. Amt. Per<br />
                Experiment (mCi)</div></td>
            <td> <div align="center">Chemical Form</div></td>
          </tr>
          <tr> 
            <td valign="top"><div align="center"><strong>
			<?php echo $_POST['radionuclide1'];
				$radionuclide1 = $_POST['radionuclide1'];
			 ?></strong> 
              </div></td>
            <td valign="top"><div align="center"><strong>
			<?php echo $_POST['halflife1'];
				$halflife1 = $_POST['halflife1'];
			 ?></strong> 
              </div></td>
            <td valign="top"><div align="center"><strong>
			<?php echo $_POST['quantity']; 
				$quantity = $_POST['quantity'];
			?></strong> 
              </div></td>
            <td><div align="center"><strong>
			<?php echo $_POST['max'];
				$max = $_POST['max'];
			 ?></strong> 
              </div></td>
            <td><div align="center"><strong>
			<?php echo $_POST['chemForm']; 
				$chemForm = $_POST['chemForm'];
			?></strong> 
              </div></td>
          </tr>
          <tr> 
            <td valign="top"><div align="center"><strong>
			<?php echo $_POST['radionuclide2']; 
				$radionuclide2 = $_POST['radionuclide2'];
			?></strong> 
              </div></td>
            <td valign="top"><div align="center"><strong>
			<?php echo $_POST['halflife2'];
				$halflife2 = $_POST['halflife2'];
			 ?></strong> 
              </div></td>
            <td valign="top"><div align="center"><strong>
			<?php echo $_POST['quantity2'];
				$quantity2 = $_POST['quantity2'];
			 ?></strong> 
              </div></td>
            <td><div align="center"><strong>
			<?php echo $_POST['max2'];
				$max2 = $_POST['max2'];
			 ?></strong> 
              </div></td>
            <td><div align="center"><strong>
			<?php echo $_POST['chemForm2']; 
				$chemForm2 = $_POST['chemForm2'];
			?></strong> 
              </div></td>
          </tr>
          <tr> 
            <td valign="top"><div align="center"><strong>
			<?php echo $_POST['radionuclide3'];
				$radionuclide3 = $_POST['radionuclide3'];
			 ?></strong> 
              </div></td>
            <td valign="top"><div align="center"><strong>
			<?php echo $_POST['halflife3'];
				$halflife3 = $_POST['halflife3'];
			 ?></strong> 
              </div></td>
            <td valign="top"><div align="center"><strong>
			<?php echo $_POST['quantity3'];
				$quantity3 = $_POST['quantity3'];
			 ?></strong> 
              </div></td>
            <td><div align="center"><strong>
			<?php echo $_POST['max3'];
				$max3 = $_POST['max3'];
			 ?></strong> 
              </div></td>
            <td><div align="center"><strong>
			<?php echo $_POST['chemForm3'];
				$chemForm3 = $_POST['chemForm3'];
			 ?></strong> 
              </div></td>
          </tr>
          <tr> 
            <td valign="top"><div align="center"><strong>
			<?php echo $_POST['radionuclide4']; 
				$radionuclide4 = $_POST['radionuclide4'];
			?></strong> 
              </div></td>
            <td valign="top"><div align="center"><strong>
			<?php echo $_POST['halflife4'];
				$halflife4 = $_POST['halflife4'];
			 ?></strong> 
              </div></td>
            <td valign="top"><div align="center"><strong>
			<?php echo $_POST['quantity4'];
				$quantity4 = $_POST['quantity4'];
			 ?></strong> 
              </div></td>
            <td><div align="center"><strong>
			<?php echo $_POST['max4'];
				$max4 = $_POST['max4'];
			 ?></strong> 
              </div></td>
            <td><div align="center"><strong>
			<?php echo $_POST['chemForm4'];
				$chemForm4 = $_POST['chemForm4'];
			 ?></strong> 
              </div></td>
          </tr>
          <tr> 
            <td valign="top"><div align="center"><strong>
			<?php echo $_POST['radionuclide5']; 
				$radionuclide5 = $_POST['radionuclide5'];
			?></strong> 
              </div></td>
            <td valign="top"><div align="center"><strong>
			<?php echo $_POST['halflife5']; 
				$halflife5 = $_POST['halflife5'];
			?></strong> 
              </div></td>
            <td valign="top"><div align="center"><strong>
			<?php echo $_POST['quantity5']; 
				$quantity5 = $_POST['quantity5'];
			?></strong> 
              </div></td>
            <td><div align="center"><strong>
			<?php echo $_POST['max5']; 
				$max5 = $_POST['max5'];
			?></strong> 
              </div></td>
            <td><div align="center"><strong
			><?php echo $_POST['chemForm5']; 
				$chemForm5 = $_POST['chemForm5'];
			?></strong> 
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>Is the material to be obtained or used in especially hazardous form? (e.g. carcinogen, highly toxic)<br />
        <strong><?php if(isset($_POST['espHaz']))
						 {
							 echo $_POST['espHaz']; 
							$espHaz = $_POST['espHaz'];
						 }
						else
						 { 
							$espHaz = '';
						 }
				?></strong> </td>
    </tr>
    <tr> 
      <td>If yes, please explain:<br />
        <strong><?php echo $_POST['explain']; 
					$explain = $_POST['explain'];
				?></strong> </td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td class="border"><strong>Radiation Protection</strong> Check special equipment 
        that will be used to control external and internal rad exposure.</td>
    </tr>
    <tr> 
      <td><table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr> 
            <td> 
              <?php 
					if (isset($_POST['glove'])){
						echo "&#x2713;";
						$glove = "T";}
					else{ echo "&#x2717;";
						$glove = "F"; }				
				?>
            </td>
            <td>Glove Box</td>
            <td>
              <?php 
					if (isset($_POST['ionChamber'])){
						echo "&#x2713;";
						$ionChamber = "T";}
					else{ echo "&#x2717;";
						$ionChamber = "F"; }				
				?>
              </td>
            <td>Ion chamber survey meter</td>
            <td>
              <?php 
					if (isset($_POST['respirator'])){
						echo "&#x2713;";
						$respirator = "T";}
					else{ echo "&#x2717;";
						$respirator = "F"; }				
				?>
              </td>
            <td>Respirator</td>
          </tr>
          <tr> 
            <td>
              <?php 
					if (isset($_POST['mechanical'])){
						echo "&#x2713;";
						$mechanical = "T";}
					else{ echo "&#x2717;"; 
						$mechanical = "F";}				
				?>
              </td>
            <td>Mechanical pipettes</td>
            <td>
              <?php 
					if (isset($_POST['shieldedStorage'])){
						echo "&#x2713;";
						$shieldedStorage = "T";}
					else{ echo "&#x2717;"; 
						$shieldedStorage = "F";}				
				?>
             </td>
            <td>Shielded storage container</td>
            <td>
              <?php 
					if (isset($_POST['liquidScint'])){
						echo "&#x2713;";
						$liquidScint = "T";}
					else{ echo "&#x2717;"; 
						$liquidScint = "F";}				
				?>
              </td>
            <td>Liquid scintillation counter</td>
          </tr>
          <tr> 
            <td>
              <?php 
					if (isset($_POST['fumeHood'])){
						echo "&#x2713;";
						$fumeHood = "T";}
					else{ echo "&#x2717;"; 
						$fumeHood = "F";}				
				?>
              </td>
            <td>Fume Hood</td>
            <td>
              <?php 
					if (isset($_POST['shoeCovers'])){
						echo "&#x2713;";
						$shoeCovers = "T";}
					else{ echo "&#x2717;"; 
						$shoeCovers = "F";}				
				?>
              </td>
            <td>Shoe covers</td>
            <td>
              <?php 
					if (isset($_POST['transportation'])){
						echo "&#x2713;";
						$transportation = "T";}
					else{ echo "&#x2717;";
						$transportation = "F"; }				
				?>
              </td>
            <td>Transportation container</td>
          </tr>
          <tr> 
            <td>
              <?php 
					if (isset($_POST['trays'])){
						echo "&#x2713;";
						$trays = "T";}
					else{ echo "&#x2717;";
						$trays = "F"; }				
				?>
              </td>
            <td>Trays</td>
            <td>
              <?php 
					if (isset($_POST['scintWell'])){
						echo "&#x2713;";
						$scintWell = "T";}
					else{ echo "&#x2717;";
						$scintWell = "F"; }				
				?>
              </td>
            <td>Scintillation well counter</td>
            <td>
              <?php 
					if (isset($_POST['labCoat'])){
						echo "&#x2713;";
						$labCoat = "T";}
					else{ echo "&#x2717;";
						$labCoat = "F";}				
				?>
             </td>
            <td>Lab coat</td>
          </tr>
          <tr> 
            <td>
              <?php 
					if (isset($_POST['shielding'])){
						echo "&#x2713;";
						$shielding = "T";}
					else{ echo "&#x2717;"; 
						$shielding = "F";}				
				?>
              </td>
            <td>Lead Shielding</td>
            <td>
              <?php 
					if (isset($_POST['body'])){
						echo "&#x2713;";
						$body = "T";}
					else{ echo "&#x2717;";
						$body = "F"; }				
				?>
              </td>
            <td>Body Dosimetry</td>
            <td>
              <?php 
					if (isset($_POST['protGloves'])){
						echo "&#x2713;";
						$protGloves = "T";}
					else{ echo "&#x2717;";
						$protGloves = "F"; }				
				?>
              </td>
            <td>Protective gloves</td>
          </tr>
          <tr> 
            <td>
              <?php 
					if (isset($_POST['GM'])){
						echo "&#x2713;";
						$GM = "T";}
					else{ echo "&#x2717;";
						$GM = "F"; }				
				?>
              </td>
            <td>GM survey meters</td>
            <td>
              <?php 
					if (isset($_POST['radSigns'])){
						echo "&#x2713;";
						$radSigns = "T";}
					else{ echo "&#x2717;";
						$radSigns = "F"; }				
				?>
              </td>
            <td>Radiation signs and labels</td>
            <td>
              <?php 
					if (isset($_POST['wrist'])){
						echo "&#x2713;";
						$wrist = "T";}
					else{ echo "&#x2717;";
						$wrist = "F"; }				
				?>
              </td>
            <td>Wrist Dosimetry</td>
          </tr>
          <tr> 
            <td>
              <?php 
					if (isset($_POST['handling'])){
						echo "&#x2713;";
						$handling = "T";}
					else{ echo "&#x2717;";
						$handling = "F"; }				
				?>
              </td>
            <td>Handling tongs</td>
            <td>
              <?php 
					if (isset($_POST['finger'])){
						echo "&#x2713;";
						$finger = "T";}
					else{ echo "&#x2717;"; 
						$finger = "F";}				
				?>
              </td>
            <td>Finger Dosimetry</td>
            <td>
              <?php 
					if (isset($_POST['plexiglass'])){
						echo "&#x2713;";
						$plexiglass = "T";}
					else{ echo "&#x2717;";
						$plexiglass = "F"; }				
				?>
            </td>
            <td>Plexiglass shielding</td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td class="border"><strong>Waste disposal</strong>: Check the appropriate 
        item(s). Describe all waste streams. Include information on any hazardous 
        materials - biohazards, carcinogens, toxic chemicals, etc.*</td>
    </tr>
    <tr> 
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="6%" valign="top"> 
              <?php 
					if ($_POST['ckSolid'] == "T"){
						echo "&#x2713;";
						$ckSolid = "T";}
					else{ echo "&#x2717;";
						$ckSolid = "F"; }				
				?>
              </td>
            <td width="15%" valign="top">Solid</td>
            <td width="79%"><strong><?php
									 echo $_POST['solidDesc'];
									 $solidDesc = $_POST['solidDesc']; ?></strong></td>
          </tr>
          <tr> 
            <td width="6%" valign="top"> 
              <?php 
					if ($_POST['ckAqueous'] == "T"){
						echo "&#x2713;";
						$ckAqueous = "T";}
					else{ echo "&#x2717;";
						$ckAquesous = "F"; }				
				?>
             </td>
            <td width="15%" valign="top">Aqueous</td>
            <td width="79%"><strong><?php
									 echo $_POST['aqueousDesc'];
									 $aqueousDesc = $_POST['aqueousDesc']; ?></strong></td>
          </tr>
          <tr> 
            <td width="6%" valign="top"> 
              <?php 
					if ($_POST['ckOrganic'] == "T"){
						echo "&#x2713;";
						$ckOrganic = "T";}
					else{ echo "&#x2717;"; 
						$ckOrganic = "F";}				
				?>
              </td>
            <td width="15%" valign="top">Organic</td>
            <td width="79%"><strong><?php 
									echo $_POST['orgDesc'];
									$orgDesc = $_POST['orgDesc']; ?></strong></td>
          </tr>
          <tr> 
            <td width="6%" valign="top"> 
              <?php 
					if ($_POST['ckAnimal'] == "T"){
						echo "&#x2713;";
						$ckAnimal = "T";}
					else{ echo "&#x2717;";
						$ckAnimal = "F"; }				
				?>
              </td>
            <td width="15%" valign="top">Animal</td>
            <td width="79%"><strong><?php 
									echo $_POST['animalDesc']; 
									$animalDesc = $_POST['animalDesc']; ?></strong></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td class="border">Describe the method/procedure to be taken for ensuring 
        radioactive material is <strong>secure against unauthorized access:</strong><em> 
        (An approved procedure is to ensure that the lab door is locked when the 
        lab us unoccupied).</em></td>
    </tr>
    <tr> 
      <td><strong><?php 
	  				echo $_POST['secure'];
					$secure = $_POST['secure']; ?></strong></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td class="border">Please check the type of application below and submit 
        a separate Word document describing the use of the radioactive material 
        by supplying a response to each 'bullet' topic. (e.g. - a user doing experiments 
        with radiation in mice would answer all topics in the section 'Unsealed 
        Applications' and 'Use in Animal Studies'.) Send the documents to <a href="mailto:david.rich@uky.edu">David Rich</a>.</td>
    </tr>
    <tr> 
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <?php if ($_POST['c1'] == "True"){
	  		$c1 = "T";		
		?>
          <tr> 
            <td width="4%" valign="top"> <img src="../../media/image/icon_pencil.png" alt="" /></td>
            <td>Use as a sealed source.</td>
          </tr>
          <tr> 
            <td width="4%" valign="top">&nbsp; </td>
            <td> 
              <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Rationale 
                of experiment.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Description 
                of experimental technique.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Description 
                of sealed source; chemical form, type of seal, single or double 
                seal.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Describe 
                handling procedures.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Describe 
                storage area and when applicable describe any containers to be 
                used in transporting the source.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Describe 
                radiation monitoring equipment; including methods and frequency 
                of surveys.</td>
          </tr>
		  <?php ;}
		  		else{
					$c1 ="F";
					
		  ?>
		   <tr> 
            <td width="4%" valign="top"> <img src="../../media/image/x.png" alt="" /></td>
            <td>Use as a sealed source.</td>
          </tr>
		  <?php
		  ;}
		  ?>
		  <?php if ($_POST['c2'] == "True"){
		  	$c2 = "T";
	  		
		  ?>
          <tr> 
            <td width="4%" valign="top"><img src="../../media/image/icon_pencil.png" alt="" /></td>
            <td>Use in unsealed applications.</td>
          </tr>
          <tr> 
            <td width="4%" valign="top">&nbsp; </td>
            <td> 
              <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Rationale 
                of experiment.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Description 
                of experimental techniques, especially those phases of the experimental 
                procedures where handling of radioactive material is involved.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Indicate 
                those steps in the experimental procedure where loss of radioactive 
                material is possible and describe the measures to be taken to 
                control contamination.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />List 
                precautions to be taken to eliminate contamination of the personnel 
                such as the use of protective clothing and gloves. Also describe 
                the use of any special shielding devices to be used to limit personnel 
                exposure.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Describe 
                storage area.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Describe 
                radiation monitoring equipment; including methods and frequency 
                of contamination surveys.</td>
          </tr>
		  <?php ;}
		  		else{
					$c2 = "F";
					
		  ?>
		   <tr> 
            <td width="4%" valign="top"> <img src="../../media/image/x.png" alt="" /></td>
            <td>Use in unsealed applications.</td>
          </tr>
		  <?php
		  ;}
		  ?>
		  <?php if ($_POST['c3'] == "True"){
		  	$c3 = "T";
	  		
		  ?>
          <tr> 
            <td width="4%" valign="top"><img src="../../media/image/icon_pencil.png" alt="" /></td>
            <td>Use as on ionization source for an electron capture detector in 
              gas chromatography.</td>
          </tr>
          <tr> 
            <td width="4%" valign="top">&nbsp;</td>
            <td> 
              <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Describe 
                the type of analysis to be performed.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Describe 
                any operating limits to be imposed on the system to prevent loss 
                of radioactive material.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Describe 
                the system to be used in discharging the effluent of the apparatus 
                to controlled ventilation such as a fume hood.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />If 
                you plan to perform source cleaning operations and/or install 
                new sources, describe the procedure and list the precautions to 
                be taken to control contamination and to limit exposure to personnel.<br />
                * Note: Please refer to the Radiation Safety Manual for the proper 
                guidelines for the segregation and consolidation of waste.</td>
          </tr>
		  <?php }
		  		else{
					$c3 = "F";
					
		  ?>
		   <tr> 
            <td width="4%" valign="top"> <img src="../../media/image/x.png" alt="" /></td>
            <td>Use as on ionization source for an electron capture detector in 
              gas chromatography.</td>
          </tr>
		  <?php
		  }
		  ?>
		  <?php if ($_POST['c4'] == "True"){
	  		$c4 = "T";		
			
		  ?>
          <tr> 
            <td width="4%" valign="top"><img src="../../media/image/icon_pencil.png" alt="" /></td>
            <td>Use in animal studies.</td>
          </tr>
          <tr> 
            <td width="4%" valign="top">&nbsp;</td>
            <td> 
              <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Answer 
                all the questions in either &quot;<strong>Use as a sealed source</strong>&quot; 
                or &quot;<strong>Use in unsealed applications</strong>&quot; above, 
                depending on whether the radioactive material is sealed or unsealed.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />How 
                (and where) will animals be housed.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Provide 
                the concentration (in units of uCi/gram) of the radionuclide averaged 
                over the entire weight of the live animal.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Describe 
                the kind and number of animals to be used in the study.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Describe 
                the radionuclide (including activity) to be administered per animal 
                and how administered.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />The 
                ultimate fate of the animal and suspected excretion rate of the 
                radionuclide.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Describe 
                handling and monitoring of the animals and proposed method of 
                disposal of the animal(s) and excreta.</td>
          </tr>
		   <?php }
		  		else{
					$c4 = "F";
					
		  ?>
		   <tr> 
            <td width="4%" valign="top"> <img src="../../media/image/x.png" alt="" /></td>
            <td>Use in animal studies.</td>
          </tr>
		  <?php
		  }
		  ?>
		   <?php if ($_POST['c5'] == "True"){
		   	$c5 = "T";
	  		
		  ?>
          <tr> 
            <td width="4%" valign="top"><img src="../../media/image/icon_pencil.png" alt="" /></td>
            <td>Human use.</td>
          </tr>
          <tr>
            <td width="4%" valign="top">&nbsp;</td>
            <td> 
              <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Purpose 
                for conducting study.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />State 
                whether human use is considered routine or non-routine. Include 
                the research protocol for non-routine use.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Give 
                the plan of investigation in sufficient detail to permit a critical 
                evaluation of the radioisotope methodology to be employed and 
                the radiation safety controls to be established.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Description 
                of human subjects. Include their statement of consent.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Quantity 
                of radioactive material to be administered (in millicuries).<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Calculation 
                of radiation dose.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Statement 
                on the adequacy of the physical facilities and equipment for supporting 
                the proposed study.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Qualification 
                of the individuals responsible for the study.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Estimated 
                time needed for completion of the study.<br />
                <img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Schedule 
                for reporting the results of the study.</td>
          </tr>
		  <?php }
		  		else{
					$c5 = "F";
					
		  ?>
		   <tr> 
            <td width="4%" valign="top"> <img src="../../media/image/x.png" alt="" /></td>
            <td>Human use.</td>
          </tr>
		  <?php
		  }
		  ?>
        </table></td>
    </tr>
    <tr>
      <td>&nbsp;
        </td>
    </tr>
  </table>
<?php

$todaysdate = date("F d, Y");
				
$toaddress = "david.rich@uky.edu, glschl1@email.uky.edu";
$subject = "Application to possess and use rad materials " .$todaysdate;
$mailcontent = "Today's date: " .$todaysdate."\n\n"
	."Name: ".$firstName." ".$lastName."\n"
	."Department: ".$dept."\n"
	."Building name: ".$bldg."\n"
	."Room Num: ".$room."\n"							
	."Phone: ".$phone."\n"
	."E-mail: ".$email."\n"
	."UK Title: ".$UKtitle."\n"
	."Project Title: ".$projectTitle."\n\n\n"
	."Where the material will be handled:"." \n"
	."Use:"." \n"
	."Building: ".$bldgUse."\n"
	."Room Num: ".$roomUse."\n"
	."Storage:"." \n"
	."Building: ".$bldgStorage."\n"
	."Room Num: ".$roomStorage."\n"
	."Waste Storage:"." \n"
	."Building: ".$bldgWasteStorage."\n"
	."Room Num: ".$roomWasteStorage."\n\n\n"
	."Radionuclide 1: ".$radionuclide1."\n"
	."Half-life 1: ".$halflife1."\n"
	."Total quantity 1: ".$quantity."\n"
	."Max amt per experiment 1: ".$max."(mCi)\n"
	."Chemical form 1: ".$chemForm."\n"
	."Radionuclide 2: ".$radionuclide2."\n"
	."Half-life 2: ".$halflife2."\n"
	."Total quantity 2: ".$quantity2."\n"
	."Max amt per experiment 2: ".$max2."(mCi)\n"
	."Chemical form 2: ".$chemForm2."\n"
	."Radionuclide 3: ".$radionuclide3."\n"
	."Half-life 3: ".$halflife3."\n"
	."Total quantity 3: ".$quantity3."\n"
	."Max amt per experiment 3: ".$max3."(mCi)\n"
	."Chemical form 3: ".$chemForm3."\n"
	."Radionuclide 4: ".$radionuclide4."\n"
	."Half-life 4: ".$halflife4."\n"
	."Total quantity 4: ".$quantity4."\n"
	."Max amt per experiment 4: ".$max4."(mCi)\n"
	."Chemical form 4: ".$chemForm4."\n"
	."Radionuclide 5: ".$radionuclide5."\n"
	."Half-life 5: ".$halflife5."\n"
	."Total quantity 5: ".$quantity5."\n"
	."Max amt per experiment 5: ".$max5."(mCi)\n"
	."Chemical form 5: ".$chemForm5."\n\n\n"
	."Is the material to be obtained or used in especially hazardous form? ".$espHaz."\n"
	."If yes, explain: ".$explain."\n\n"
	."Glove box: ".$glove."    "."Ion chamber meter: ".$ionChamber."   "."Respirator: ".$respirator."\n"
	."Mechanical pipettes: ".$mechanical."    "."Shielded storage cont: ".$shieldedStorage."   "."Liquid Scintillation counter: ".$liquidScint."\n"
	."Fume hood: ".$fumeHood."    "."shoe covers: ".$shoeCovers."   "."Transportation container: ".$transportation."\n"
	."Trays: ".$trays."    "."Scintillation well counter: ".$scintWell."   "."Lab coat: ".$labCoat."\n"
	."Lead shielding: ".$shielding."    "."Body dosimetry: ".$body."   "."Protective gloves: ".$protGloves."\n"
	."GM survey meters: ".$GM."    "."Radiation sign/labels: ".$radSigns."   "."Wrist dosimetry: ".$wrist."\n"
	."Handling tongs: ".$handling."    "."Finger dosimetry: ".$finger."   "."Plexiglass shielding: ".$plexiglass."\n\n\n"
	."Waste disposal: check the appropriate items. Describe all waste streams. Include information on any hazardous materials."."\n"
	."Solid: ".$ckSolid."\n"
	."Solid desc: ".$solidDesc."\n"
	."Aqueous: ".$ckAqueous."\n"
	."Aqueous desc: ".$aqueousDesc."\n"
	."Organic: ".$ckOrganic."\n"
	."Organic desc: ".$orgDesc."\n"
	."Animal: ".$ckAnimal."\n"
	."Animal desc: ".$animalDesc."\n\n"
	."Describe the method/procedure to be taken for ensuring radioactive material is secure against unauthorized access:"."\n"
	."".$secure."\n\n"
	."Submit a separate document describing the use of radioactive material by supplying the requested material."."\n"
	."Use as a sealed source: ".$c1."\n"
	."Use in unsealed applications: ".$c2."\n"
	."Use as on ionization source for an electron capture detector in gas chromatography: ".$c3."\n"
	."Use in animal studies: ".$c4."\n"
	."Human use: ".$c5."\n";							
$fromaddress = "Application to possess and use rad materials";
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