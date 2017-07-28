<?xml version="1.0" encoding="iso-8859-1"?>
<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>Application for Authorization to Possess and Use Radioactive Materials</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style media="all" type="text/css">
@import url('rad_app.css');
@import "rad_app.css";
</style>
<script language="JavaScript" type="text/javascript" src="../required_app.js"></script>
<script language="JavaScript" type="text/javascript">
function showMe (it, box) {
  var vis = (box.checked) ? "block" : "none";
  document.getElementById(it).style.display = vis;
}
</script>
</head>
<body>
<form name="form1" id="form1" method="post" action="rad_app_process.php" onsubmit="return formCheck(this);">
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
            <td>Last Name<strong> 
              <input name="lastName" type="text" id="lastName" size="25" />
              </strong></td>
            <td>First Name<strong> 
              <input name="firstName" type="text" id="firstName" size="25" />
              </strong></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr> 
            <td>Dept<strong> 
              <input name="dept" type="text" id="dept" size="20" />
              </strong></td>
            <td>Building<strong> 
              <input name="bldg" type="text" id="bldg" size="25" />
              </strong></td>
            <td>Room #<strong> 
              <input name="room" type="text" id="room" size="4" maxlength="4" />
              </strong></td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr> 
            <td>Phone #<strong> 
              <input name="phone" type="text" id="phone" size="12" maxlength="22" />
              </strong></td>
            <td>E-mail<strong> 
              <input name="email" type="text" id="email" size="20" />
              </strong></td>
            <td>UK Title<strong> 
              <input name="UKtitle" type="text" id="UKtitle" size="15" />
              </strong></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td>Project Title<strong> 
        <input name="projectTitle" type="text" id="projectTitle" />
        </strong></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td><table width="100%" border="0" cellspacing="0" cellpadding="1">
          <tr> 
            <td class="border"><strong>Where the material will be used, stored 
              and waste will be stored:</strong></td>
          </tr>
		  <tr>
            <td><strong>Use:</strong></td>
          </tr>
          <tr> 
            <td>Building<strong> 
              <input name="bldgUse" type="text" id="bldgUse" size="25" />
              </strong></td>
          </tr>
          <tr> 
            <td height="25">Room Number(s) 
              <input name="roomUse" type="text" id="roomUse" size="15" />
            </td>
          </tr>
         <tr>
            <td><strong>Storage:</strong></td>
          </tr>
          <tr> 
            <td>Building<strong> 
              <input name="bldgStorage" type="text" id="bldgStorage" size="25" />
              </strong></td>
          </tr>
          <tr> 
            <td height="25">Room Number(s)
<input name="roomStorage" type="text" id="roomStorage" size="15" />
            </td>
          </tr>
          <tr>
            <td><strong>Waste Storage:</strong></td>
          </tr>
          <tr> 
            <td>Building<strong> 
              <input name="bldgWasteStorage" type="text" id="bldgWasteStorage" size="25" />
              </strong></td>
          </tr>
          <tr> 
            <td height="25">Room Number(s)
<input name="roomWasteStorage" type="text" id="roomWasteStorage" size="15" />
            </td>
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
            <td valign="top"><div align="center"> 
                <input name="radionuclide1" type="text" id="radionuclide1" size="6" />
              </div></td>
            <td valign="top"><div align="center"> 
                <input name="halflife1" type="text" id="halflife" size="6" />
              </div></td>
            <td valign="top"><div align="center"> 
                <input name="quantity" type="text" id="quantity" size="12" />
              </div></td>
            <td><div align="center"> 
                <input name="max" type="text" id="max" size="20" />
              </div></td>
            <td><div align="center"> 
                <input name="chemForm" type="text" id="chemForm" size="20" />
              </div></td>
          </tr>
          <tr> 
            <td valign="top"><div align="center"> 
                <input name="radionuclide2" type="text" id="radionuclide12" size="6" />
              </div></td>
            <td valign="top"><div align="center"> 
                <input name="halflife2" type="text" id="halflife2" size="6" />
              </div></td>
            <td valign="top"><div align="center"> 
                <input name="quantity2" type="text" id="quantity2" size="12" />
              </div></td>
            <td><div align="center"> 
                <input name="max2" type="text" id="max2" size="20" />
              </div></td>
            <td><div align="center"> 
                <input name="chemForm2" type="text" id="chemForm2" size="20" />
              </div></td>
          </tr>
          <tr> 
            <td valign="top"><div align="center"> 
                <input name="radionuclide3" type="text" id="radionuclide13" size="6" />
              </div></td>
            <td valign="top"><div align="center"> 
                <input name="halflife3" type="text" id="halflife3" size="6" />
              </div></td>
            <td valign="top"><div align="center"> 
                <input name="quantity3" type="text" id="quantity3" size="12" />
              </div></td>
            <td><div align="center"> 
                <input name="max3" type="text" id="max3" size="20" />
              </div></td>
            <td><div align="center"> 
                <input name="chemForm3" type="text" id="chemForm3" size="20" />
              </div></td>
          </tr>
          <tr> 
            <td valign="top"><div align="center"> 
                <input name="radionuclide4" type="text" id="radionuclide14" size="6" />
              </div></td>
            <td valign="top"><div align="center"> 
                <input name="halflife4" type="text" id="halflife4" size="6" />
              </div></td>
            <td valign="top"><div align="center"> 
                <input name="quantity4" type="text" id="quantity4" size="12" />
              </div></td>
            <td><div align="center"> 
                <input name="max4" type="text" id="max4" size="20" />
              </div></td>
            <td><div align="center"> 
                <input name="chemForm4" type="text" id="chemForm4" size="20" />
              </div></td>
          </tr>
          <tr> 
            <td valign="top"><div align="center"> 
                <input name="radionuclide5" type="text" id="radionuclide15" size="6" />
              </div></td>
            <td valign="top"><div align="center"> 
                <input name="halflife5" type="text" id="halflife5" size="6" />
              </div></td>
            <td valign="top"><div align="center"> 
                <input name="quantity5" type="text" id="quantity5" size="12" />
              </div></td>
            <td><div align="center"> 
                <input name="max5" type="text" id="max5" size="20" />
              </div></td>
            <td><div align="center"> 
                <input name="chemForm5" type="text" id="chemForm5" size="20" />
              </div></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td><strong>Is the material to be obtained or used in especially hazardous 
        form? </strong>(e.g. carcinogen, highly toxic)<br /> <strong>No</strong> 
        <input type="radio" name="espHaz" value="No" /> <strong>Yes</strong> <input type="radio" name="espHaz" value="Yes" /></td>
    </tr>
    <tr> 
      <td><strong>If yes, please explain:<br />
        <textarea name="explain" cols="65" rows="3" id="explain"></textarea>
        </strong></td>
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
            <td><input name="glove" type="checkbox" id="glove" value="checkbox" /></td>
            <td>Glove Box</td>
            <td><input name="ionChamber" type="checkbox" id="ionChamber" value="checkbox" /></td>
            <td>Ion chamber survey meter</td>
            <td><input name="respirator" type="checkbox" id="respirator" value="checkbox" /></td>
            <td>Respirator</td>
          </tr>
          <tr> 
            <td><input name="mechanical" type="checkbox" id="mechanical" value="checkbox" /></td>
            <td>Mechanical pipettes</td>
            <td><input name="shieldedStorage" type="checkbox" id="shieldedStorage" value="checkbox" /></td>
            <td>Shielded storage container</td>
            <td><input name="liquidScint" type="checkbox" id="liquidScint" value="checkbox" /></td>
            <td>Liquid scintillation counter</td>
          </tr>
          <tr> 
            <td><input name="fumeHood" type="checkbox" id="fumeHood" value="checkbox" /></td>
            <td>Fume Hood</td>
            <td><input name="shoeCovers" type="checkbox" id="shoeCovers" value="checkbox" /></td>
            <td>Shoe covers</td>
            <td><input name="transportation" type="checkbox" id="transportation" value="checkbox" /></td>
            <td>Transportation container</td>
          </tr>
          <tr> 
            <td><input name="trays" type="checkbox" id="trays" value="checkbox" /></td>
            <td>Trays</td>
            <td><input name="scintWell" type="checkbox" id="scintWell" value="checkbox" /></td>
            <td>Scintillation well counter</td>
            <td><input name="labCoat" type="checkbox" id="labCoat" value="checkbox" /></td>
            <td>Lab coat</td>
          </tr>
          <tr> 
            <td><input name="shielding" type="checkbox" id="shielding" value="checkbox" /></td>
            <td>Lead Shielding</td>
            <td><input name="body" type="checkbox" id="body" value="checkbox" /></td>
            <td>Body Dosimetry</td>
            <td><input name="protGloves" type="checkbox" id="protGloves" value="checkbox" /></td>
            <td>Protective gloves</td>
          </tr>
          <tr> 
            <td><input name="GM" type="checkbox" id="GM" value="checkbox" /> </td>
            <td>GM survey meters</td>
            <td><input name="radSigns" type="checkbox" id="radSigns" value="checkbox" /></td>
            <td>Radiation signs and labels</td>
            <td><input name="wrist" type="checkbox" id="wrist" value="checkbox" /></td>
            <td>Wrist Dosimetry</td>
          </tr>
          <tr> 
            <td><input name="handling" type="checkbox" id="handling" value="checkbox" /></td>
            <td>Handling tongs</td>
            <td><input name="finger" type="checkbox" id="finger" value="checkbox" /></td>
            <td>Finger Dosimetry</td>
            <td><input name="plexiglass" type="checkbox" id="plexiglass" value="checkbox" /></td>
            <td>Plexiglas Shielding</td>
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
            <td valign="top"> <input name="ckSolid" type="checkbox" id="ckSolid" value="T" /></td>
            <td valign="top">Solid</td>
            <td><textarea name="solidDesc" cols="50" rows="3" id="solidDesc"></textarea></td>
          </tr>
          <tr> 
            <td valign="top"> <input name="ckAqueous" type="checkbox" id="ckAqueous" value="T" /></td>
            <td valign="top">Aqueous</td>
            <td><textarea name="aqueousDesc" cols="50" rows="3" id="aqueousDesc"></textarea></td>
          </tr>
          <tr> 
            <td valign="top"> <input name="ckOrganic" type="checkbox" id="ckOrganic" value="T" /></td>
            <td valign="top">Organic</td>
            <td><textarea name="orgDesc" cols="50" rows="3" id="orgDesc"></textarea></td>
          </tr>
          <tr> 
            <td valign="top"> <input name="ckAnimal" type="checkbox" id="ckAnimal" value="T" /></td>
            <td valign="top">Animal</td>
            <td><textarea name="animalDesc" cols="50" rows="3" id="animalDesc"></textarea></td>
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
      <td><textarea name="secure" cols="65" rows="3" id="textarea4"></textarea></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
    </tr>
    <tr> 
      <td class="border">Please check the type of application below and submit 
        a separate Word document describing the use of the radioactive material 
        by supplying a response to each 'bullet' topic. (e.g. - a user doing experiments 
        with radiation in mice would answer all topics in the section 'Unsealed 
        Applications' and 'Use in Animal Studies'.) Send the documents to Fred 
        Rawlings at <a href="mailto:fprawl@email.uky.edu">fprawl@email.uky.edu</a>.</td>
    </tr>
    <tr> 
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="4%" valign="top"> <input name="c1" type="checkbox" id="c1" value="True" onclick="showMe('div1', this)" /></td>
            <td>Use as a sealed source.</td>
          </tr>
          <tr> 
            <td width="4%" valign="top">&nbsp; </td>
            <td> <div id="div1" style="display:none;"><img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Rationale 
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
                of surveys.</div></td>
          </tr>
          <tr> 
            <td width="4%" valign="top"><input name="c2" type="checkbox" id="c2" value="True" onclick="showMe('div2', this)" /></td>
            <td>Use in unsealed applications.</td>
          </tr>
          <tr> 
            <td width="4%" valign="top">&nbsp; </td>
            <td> <div id="div2" style="display:none;"><img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Rationale 
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
                of contamination surveys.</div></td>
          </tr>
          <tr> 
            <td width="4%" valign="top"><input name="c3" type="checkbox" id="c3" value="True" onclick="showMe('div3', this)" /></td>
            <td>Use as on ionization source for an electron capture detector in 
              gas chromatography.</td>
          </tr>
          <tr> 
            <td width="4%" valign="top">&nbsp;</td>
            <td> <div id="div3" style="display:none;"><img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Describe 
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
                guidelines for the segregation and consolidation of waste.</div></td>
          </tr>
          <tr> 
            <td width="4%" valign="top"><input name="c4" type="checkbox" id="c4" value="True" onclick="showMe('div4', this)" /></td>
            <td>Use in animal studies.</td>
          </tr>
          <tr> 
            <td width="4%" valign="top">&nbsp;</td>
            <td> <div id="div4" style="display:none;"><img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Answer 
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
                disposal of the animal(s) and excreta.</div></td>
          </tr>
          <tr> 
            <td width="4%" valign="top"><input name="c5" type="checkbox" id="c5" value="True" onclick="showMe('div5', this)" /></td>
            <td>Human use.</td>
          </tr>
          <tr> 
            <td width="4%" valign="top">&nbsp;</td>
            <td> <div id="div5" style="display:none;"><img src="../../media/image/pointer.gif" alt="" width="15" height="14" />Purpose 
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
                for reporting the results of the study.</div></td>
          </tr>
        </table></td>
    </tr>
    <tr> 
      <td>&nbsp; </td>
    </tr>
	<tr> 
      <td><div align="center"> 
          <input type="checkbox" name="checkbox" value="checkbox" onclick="javascript:document.form1.Submit.disabled=false" />
          Click here if you are ready to submit the form. </div></td>
    </tr>
    <tr>
      <td><div align="center">
          <input type="submit" name="Submit" value="Submit" disabled />&nbsp;&nbsp;<input type="reset" name="Submit2" value="Cancel" />
        </div></td>
    </tr>
  </table>
</form>
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