<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>


<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>Radioactive Waste Ticket</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script language="JavaScript" type="text/javascript" src="required.js"></script>
<style type="text/css">
.FormButton {
	font-family: verdana, arial, sans-serif;
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
</head>
<body text="#000000" vlink="#000088" alink="#0000ff" link="#007788" bgcolor="#ffffff">
<form action="wasteticketsubmit.php" method="post" onsubmit="return formCheck(this);">
  <table width="650" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr> 
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr valign="bottom"> 
            <td><img src="../media/image/waste_tix.png" alt="Radioactive Waste Disposal" title="Radioactive Waste Disposal" width="361" height="57" /></td>
          </tr>
		  <tr><td>&nbsp;</td></tr>
        </table></td>
    </tr>
	<tr>
      <td><p><font size="2" face="Arial, Helvetica, sans-serif"><strong>In order 
          to dispose of radioactive waste, please fill out the following form 
          for EACH container. Print a copy of the form and securely tape it to 
          the container. The person(s) who actually generated the waste or who 
          otherwise has knowledge of the material should complete the form. After 
          the form is received, Radiation Safety will remove the waste, usually 
          within 5 workdays. Refer to the <a href="../docs/pdf/rad_radiation_safety_manual.pdf">Radiation Safety Manual</a> for the proper handling / packaging criteria for Dry, Liquid, LSC and 
          other waste types.</strong></font></p>
        <p><font size="2" face="Arial, Helvetica, sans-serif"><strong><u>WASTE 
          CANNOT BE PICKED UP WITHOUT A COMPLETED TICKET ATTACHED TO EACH CONTAINER</u>.</strong></font></p></td>
    </tr>
	<tr><td>&nbsp;</td></tr>
		<tr> 
      <td> <div align="center"> <img src="../media/image/line2.gif" alt="" width="90%" height="1" /><br />
          <br />
        </div></td>
    </tr>
    <tr> 
      <td> <center>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr valign="middle"> 
              <td width="120"><strong><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Authorized 
                User </font></strong></td>
              <td width="550">
			  <?php 			  
			 		 if (isset($_SESSION['Name']) && $_SESSION['Name'] != "")
			  			{
							/*$Name = $_SESSION['Name'];
							echo $_SESSION['Name'];
							echo "\$Name";*/
							echo $_SESSION['Name'];
							//$_SESSION['Name'] =  $_POST['Name'];
							//echo $_POST['Name'];
						}
					else
						{			  				
							$_SESSION['Name'];
							echo "<input type=\"text\" name=\"Name\" size=\"35\" />";
						}
				?>
				</td>
            </tr>
            <tr valign="middle"> 
              <td width="120"><strong><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Department</font></strong></td>
              <td width="550"> <?php if (isset($_SESSION['Department']) && $_SESSION['Department'] != "")
			  	{
					echo $_SESSION['Department'];
				}
				else
				{			  
			  		//session_register("Department");
					$_SESSION['Department'];
			  		echo "<input type=\"text\" name=\"Department\" size=\"35\" />";
				}
				?> </td>
            </tr>
            <tr valign="middle"> 
              <td width="120"><strong><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Building</font></strong></td>
              <td width="550"> <?php if (isset($_SESSION['Building']) && $_SESSION['Building'] != "")
			  	{
					echo $_SESSION['Building'];
				}
				else
				{			  
			  		//session_register("Building");
					$_SESSION['Building'];		
					echo "<input name=\"Building\" type=\"text\" id=\"building\" size=\"35\" />";
				}
				?> 
              </td>
            </tr>
            <tr valign="middle"> 
              <td width="120"><strong><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Room</font></strong></td>
              <td width="550"> <?php if (isset($_SESSION['Room']) && $_SESSION['Room'] != "")
			  	{
					echo $_SESSION['Room'];
				}
				else
				{			  
			  		//session_register("Room");	
					$_SESSION['Room'];	
					echo "<input name=\"Room\" type=\"text\" id=\"room\" size=\"35\" />";
				}
				?> 
              </td>
            </tr>
            <tr valign="middle"> 
              <td width="120"><strong><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Phone</font></strong></td>
              <td width="550"> <?php if (isset($_SESSION['Phone']) && $_SESSION['Phone'] != "")
			  	{
					echo $_SESSION['Phone'];
				}
				else
				{			  
			  		//session_register("Phone");
					$_SESSION['Phone'];
			  		echo "<input name=\"Phone\" type=\"text\" id=\"phone\" size=\"35\" />";
				}
				?> 
              </td>
            </tr>
          </table>
          <div align="left"><br />
            <font size="2" face="Arial, Helvetica, sans-serif">Check Isotope(s) 
            and provide activity in mCi..</font><br />
            <table width="320" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
                  <input name="H3" type="checkbox" id="H3" value="T" />
                  </font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">H-3</font></td>
                <td> <div align="center"> <font size="2" face="Arial, Helvetica, sans-serif"> 
                    <input name="mCi1" type="text" id="mCi1" size="5" />
                    </font></div></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">mCi</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif"> 
                  <input name="S35" type="checkbox" id="S35" value="T" />
                  </font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">S-35</font></td>
                <td><div align="center"> <font size="2" face="Arial, Helvetica, sans-serif"> 
                    <input name="mCi2" type="text" id="mCi2" size="5" />
                    </font></div></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">mCi</font></td>
              </tr>
              <tr> 
                <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
                  <input name="C14" type="checkbox" id="C14" value="T" />
                  </font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">C-14</font></td>
                <td> <div align="center"> <font size="2" face="Arial, Helvetica, sans-serif"> 
                    <input name="mCi3" type="text" id="mCi3" size="5" />
                    </font></div></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">mCi</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif"> 
                  <input name="I125" type="checkbox" id="I125" value="T" />
                  </font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">I-125</font></td>
                <td><div align="center"> <font size="2" face="Arial, Helvetica, sans-serif"> 
                    <input name="mCi4" type="text" id="mCi4" size="5" />
                    </font></div></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">mCi</font></td>
              </tr>
              <tr> 
                <td> <font size="2" face="Arial, Helvetica, sans-serif"> 
                  <input name="P32" type="checkbox" id="P32" value="T" />
                  </font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">P-32</font></td>
                <td> <div align="center"> <font size="2" face="Arial, Helvetica, sans-serif"> 
                    <input name="mCi5" type="text" id="mCi5" size="5" />
                    </font></div></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">mCi</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">&nbsp;</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif"> 
                  <input name="Cr51" type="checkbox" id="Cr51" value="T" />
                  </font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">Cr-51</font></td>
                <td><div align="center"> <font size="2" face="Arial, Helvetica, sans-serif"> 
                    <input name="mCi6" type="text" id="mCi6" size="5" />
                    </font></div></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">mCi</font></td>
              </tr>
            </table>
            <table width="320" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><font size="2" face="Arial, Helvetica, sans-serif">Other:</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif"> 
                  <input name="IsotopeOther" type="text" id="IsotopeOther" />
                  </font></td>
                <td> <div align="center"> <font size="2" face="Arial, Helvetica, sans-serif"> 
                    <input name="mCi7" type="text" id="mCi7" size="5" />
                    </font></div></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">mCi</font></td>
              </tr>
            </table>
            <br />
            <table width="220" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td colspan="2"><font size="2" face="Arial, Helvetica, sans-serif"><strong>A</strong>. 
                  Dry Solid Waste container size:</font></td>
              </tr>
              <tr> 
                <td><font size="2" face="Arial, Helvetica, sans-serif">
                  <input name="Gal32" type="checkbox" value="T" id="Gal32" />
                  32 gal.</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">
                  <input name="Gal10" type="checkbox" id="Gal10" value="T" />
                  10 gal.</font></td>
              </tr>
            </table>
            <br />
            <table width="300" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>B</strong>. 
                  <input name="Vials" type="checkbox" id="Vials" value="T" />
                  Vials</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">
                  <input name="Toluene" type="checkbox" id="Toluene" value="T" />
                  Toluene</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">
                  <input name="Xylene" type="checkbox" id="Xylene" value="T" />
                  Xylene</font></td>
              </tr>
              <tr> 
                <td colspan="3"><font size="2" face="Arial, Helvetica, sans-serif">Other: 
                  <input name="BOther" type="text" id="BOther" />
                  </font></td>
              </tr>
            </table>
            <table width="300" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><font size="2" face="Arial, Helvetica, sans-serif">Drum size:</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">
                  <input name="Gal55" type="checkbox" id="Gal55" value="T" />
                  55 gal.</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">
                  <input name="Gal33" type="checkbox" id="Gal33" value="T" />
                  33 gal.</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">
                  <input name="Drum10Gal" type="checkbox" value="T" />
                  10 gal.</font></td>
              </tr>
            </table>
            <br />
            <table width="450" border="0" cellspacing="0" cellpadding="0">
              <tr> 
                <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>C</strong>. 
                  Other:</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif"> 
                  <input name="COther" type="text" id="COther" />
                  </font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">Volume:</font></td>
                <td><input name="CVolume" type="text" id="CVolume" /></td>
              </tr>
            </table>
            <br />
            <font size="2" face="Arial, Helvetica, sans-serif"><strong>D</strong>. 
            Aqueous liquid waste: 
            <input name="Aqueous" type="checkbox" id="Aqueous" value="T" />
            (must complete section F)<br />
            <br />
            <strong>E</strong>. Hazardous chemicals: 
            <input name="Hazardous" type="checkbox" id="Hazardous" value="T" />
            (must complete section F)<br />
            </font> <br />
            <table width="535" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><font size="2" face="Arial, Helvetica, sans-serif"><strong>F</strong>. 
                  pH (Required for all waste liquids except Scintillation Cocktail):</font></td>
                <td><font size="2" face="Arial, Helvetica, sans-serif">
                  <input name="pH" type="text" id="pH" />
                  </font></td>
              </tr>
            </table>
            <br />
            <font size="2" face="Arial, Helvetica, sans-serif">List all constituents 
            in the container, total must equal 100%. Chemical names only (no abbreviations 
            or formulas).</font><br />
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <caption>
              <font size="2" face="Arial, Helvetica, sans-serif"><strong>Constituents</strong></font> 
              </caption>
              <tr> 
                <th width="70%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Name</font></th>
                <th width="20%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Percentage</font></th>
                <td width="10%"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">%</font></div></td>
              </tr>
              <tr> 
                <td width="70%"><input name="name1" type="text" size="65" /></td>
                <td width="20%"> <input type="text" name="percent1" /></td>
                <td width="10%"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">%</font></div></td>
              </tr>
              <tr> 
                <td width="70%"><input name="name2" type="text" size="65" /></td>
                <td width="20%"> <input type="text" name="percent2" /></td>
                <td width="10%"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">%</font></div></td>
              </tr>
              <tr> 
                <td width="70%"><input type="text" name="name3" size="65" /></td>
                <td width="20%"> <input type="text" name="percent3" /></td>
                <td width="10%"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">%</font></div></td>
              </tr>
              <tr> 
                <td width="70%"><input type="text" name="name4" size="65" /></td>
                <td width="20%"> <input type="text" name="percent4" /></td>
                <td width="10%"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">%</font></div></td>
              </tr>
              <tr> 
                <td width="70%"><input type="text" name="name5" size="65" /></td>
                <td width="20%"> <input type="text" name="percent5" /></td>
                <td width="10%"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">%</font></div></td>
              </tr>
              <tr> 
                <td width="70%"><input type="text" name="name6" size="65" /></td>
                <td width="20%"> <input type="text" name="percent6" /></td>
                <td width="10%"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">%</font></div></td>
              </tr>
              <tr> 
                <td width="70%"><input type="text" name="name7" size="65" /></td>
                <td width="20%"> <input type="text" name="percent7" /></td>
                <td width="10%"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">%</font></div></td>
              </tr>
              <tr> 
                <td width="70%"><input type="text" name="name8" size="65" /></td>
                <td width="20%"> <input type="text" name="percent8" /></td>
                <td width="10%"><div align="center"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">%</font></div></td>
              </tr>
              <tr> 
                <td>&nbsp;</td>
                <td><div align="center"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Total</font></strong></div></td>
                <td><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">100%</font></strong></td>
              </tr>
            </table>
          </div><br />
		  <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr> 
              <td width="46%" valign="top">
<div align="right"> <strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Size 
                  of container:</font></strong> </div></td>
              <td><input name="ContainerSize" type="text" id="contSize" size="40" /></td>
            </tr>
            <tr> 
              <td width="46%" valign="top">
<div align="right"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Type 
                  of container:</font></strong></div></td>
              <td><select name="ContainerType">
                  <option value="Glass Bottle">Glass Bottle</option>
                  <option value="Plastic Garbage Can">Plastic Garbage Can</option>
                  <option value="Metal Drum">Metal Drum</option>
                  <option value="Cardboard Box">Cardboard Box</option>
                  <option value="Carboy">Carboy</option>
                  <option value="Plastic Bag">Plastic Bag</option>
				  <option value="Sharps Container">Sharps Container</option>
                  <option value="Other">Other</option>
                </select> </td>
            </tr>
            <tr> 
              <td width="46%" valign="top">
<div align="right"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Amount 
                  of waste in container:</font></strong></div></td>
              <td><input name="AmountofWaste" type="text" id="amount" size="40" /></td>
            </tr>
            <tr> 
              <td width="46%" valign="top"><div align="right"><strong><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Notes:</font></strong></div></td>
              <td><textarea name="textarea" cols="35" rows="5"></textarea></td>
            </tr>
          </table>
          <br />
          <table width="18%" border="0" cellspacing="0" cellpadding="0" align="center">
            <tr> 
                    <td width="46%"> <input class="FormButton" type="submit" name="Submit" value="Submit" /> 
                    </td>
                    <td width="54%"> <input class="FormButton" type="reset" name="reset" value="Reset" /> 
                    </td>
                  </tr>
                </table>
          <br />
        </center>
        <div align="center"><img src="../media/image/line2.gif" alt="" width="90%" height="1" /><br />
          <br />
          <font size="2" face="Arial, Helvetica, sans-serif"><strong><a href="index_rad.html">Radiation 
          Safety</a> | <a href="../">EH&amp;S</a></strong></font></div></td>
    </tr>
    <tr> 
      <td> <p><font color="#999999" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
          Last Modified 11.30.2007<br />
      Send Comments to </font><font face="Arial, Helvetica, sans-serif" size="1"><a href="mailto:dvcask2@email.uky.edu">Damon V. Caskey</a></font></p></td>
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