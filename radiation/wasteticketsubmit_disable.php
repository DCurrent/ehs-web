<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>Radioactive Waste Ticket</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" media="screen" href="screen.css" />
<link rel="stylesheet" type="text/css" media="print" href="print.css" />
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
<script language="JavaScript1.2" type="text/javascript">
<!--
function printpage() {
window.print();  
}
//-->
</script>
</head>
<body onLoad="printpage()">
<table width="80%" align="center" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr valign="bottom"> 
          <td><div align="center" class="trans"> 
              <h1><strong>Print this out and place on waste container to be picked 
                up.</strong></h1>
            </div></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td> <div align="left"><strong>Ticket Number:  
        <?php
settype($template, "string");

// you could repeat the alphabet to get more randomness
$template = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

function GetRandomString($length) {

       global $template;

       settype($length, "integer");
       settype($rndstring, "string");
       settype($a, "integer");
       settype($b, "integer");
      
       for ($a = 0; $a <= $length; $a++) {
               $b = rand(0, strlen($template) - 1);
               $rndstring .= $template[$b];
       }
       return $rndstring;     
}
$random1 = GetRandomString(1);
echo $random1;

settype($template2, "string");

// you could repeat the alphabet to get more randomness
$template2 = "1234567890";

function GetRandomString2($length) {

       global $template2;

       settype($length, "integer");
       settype($rndstring, "string");
       settype($a, "integer");
       settype($b, "integer");
      
       for ($a = 0; $a <= $length; $a++) {
               $b = rand(0, strlen($template2) - 1);
               $rndstring .= $template2[$b];
       }
       return $rndstring;     
}
$random2 = GetRandomString2(4);
echo $random2;

?>
        </strong> <br />
        <br />
      </div></td>
  </tr>
  <tr> 
    <td> <center>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr valign="middle"> 
            <td width="120"><strong>Authorized User</strong></td>
            <td> 
              <?php
							/*if (session_is_registered("Name")){	
								$_SESSION['Name'] = $_POST["Name"];
								echo $_SESSION['Name'];}*/
							if ($_POST['Name']=="")
							{
								echo $_SESSION['Name'];
								$Name = $_SESSION['Name'];
							}
							else{
								$_SESSION['Name'] = $_POST['Name'];
								echo $_SESSION['Name'];
								$Name = $_SESSION['Name'];
							}
								
								//echo $_SESSION['Name'];
				?>
            </td>
          </tr>
          <tr valign="middle"> 
            <td width="120"><strong>Department</strong></td>
            <td> 
              <?php
							if ($_POST['Department'] == "")
							{
								echo $_SESSION['Department'];
								$Department = $_SESSION['Department'];
							}
							else{
								$_SESSION['Department'] = $_POST['Department'];
								echo $_SESSION['Department'];
								$Department = $_SESSION['Department'];
							}
								?>
            </td>
          </tr>
          <tr valign="middle"> 
            <td width="120"><strong>Building</strong></td>
            <td> 
              <?php
							if ($_POST['Building'] == "")
							{	
								echo $_SESSION['Building'];
								$Building = $_SESSION['Building'];
							}
							else{
								$_SESSION['Building'] = $_POST['Building'];
								echo $_SESSION['Building'];
								$Building = $_SESSION['Building'];
							}
								?>
            </td>
          </tr>
          <tr valign="middle"> 
            <td width="120"><strong>Room</strong></td>
            <td> 
              <?php
							if ($_POST['Room'] =="")
							{	
								echo $_SESSION['Room'];
								$Room = $_SESSION['Room'];
							}
							else{
								$_SESSION['Room'] = $_POST['Room'];
								echo $_SESSION['Room'];
								$Room = $_SESSION['Room'];
							}
								?>
            </td>
          </tr>
          <tr valign="middle"> 
            <td width="120"><strong>Phone</strong></td>
            <td> 
              <?php
							if ($_POST['Phone'] =="")
							{	
								echo $_SESSION['Phone'];
								$Phone = $_SESSION['Phone'];
							}
							else{
								$_SESSION['Phone'] = $_POST['Phone'];
								echo $_SESSION['Phone'];
								$Phone = $_SESSION['Phone'];
							}
								?>
            </td>
          </tr>
        </table>
        <div align="left"><br />
          Check Isotope(s) and provide activity in mCi..<br />
          <table width="320" border="0" cellspacing="0" cellpadding="0">
            <tr> 
              <td width="20"> <div align="center"> 
                  <?php
			  		if ($_POST['H3'] == 'T')
					{
						echo "<strong>x</strong>";
						$H3 = "x";
					}			  
			  ?>
                </div></td>
              <td>H-3</td>
              <td> <div align="center"> <strong> 
                  <?php
						echo $_POST['mCi1'];
						$mCi1 = $_POST['mCi1'];
			 	 ?>
                  </strong> </div></td>
              <td>mCi</td>
              <td>&nbsp;</td>
              <td width="20" align="center"> 
                <?php
			  		if ($_POST['S35'] == 'T')
					{
						echo "<strong>x</strong>";
						$S35 = "x";
					}
			  ?>
              </td>
              <td>S-35</td>
              <td><div align="center"> <strong> 
                  <?php
						echo $_POST['mCi2'];
						$mCi2 = $_POST['mCi2'];
			 	 ?>
                  </strong> </div></td>
              <td>mCi</td>
            </tr>
            <tr> 
              <td width="20"> <div align="center"> 
                  <?php
			  		if ($_POST['C14'] == 'T')
					{
						echo "<strong>x</strong>";
						$C14 = "x";
					}			  
			  ?>
                </div></td>
              <td>C-14</td>
              <td> <div align="center"> <strong> 
                  <?php
						echo $_POST['mCi3'];
						$mCi3 = $_POST['mCi3'];
			 	 ?>
                  </strong> </div></td>
              <td>mCi</td>
              <td>&nbsp;</td>
              <td width="20" align="center"> 
                <?php
			  		if ($_POST['I125'] == 'T')
					{
						echo "<strong>x</strong>";
						$I125 = "x";
					}			  
			  ?>
              </td>
              <td>I-125</td>
              <td><div align="center"> <strong> 
                  <?php
						echo $_POST['mCi4'];
						$mCi4 = $_POST['mCi4'];
			 	 ?>
                  </strong> </div></td>
              <td>mCi</td>
            </tr>
            <tr> 
              <td width="20"> <div align="center"> 
                  <?php
			  		if ($_POST['P32'] == 'T')
					{
						echo "<strong>x</strong>";
						$P32 = "x";
					}			  
			  ?>
                </div></td>
              <td>P-32</td>
              <td> <div align="center"> <strong> 
                  <?php
						echo $_POST['mCi5'];
						$mCi5 = $_POST['mCi5'];
			 	 ?>
                  </strong> </div></td>
              <td>mCi</td>
              <td>&nbsp;</td>
              <td width="20" align="center"> 
                <?php
			  		if ($_POST['Cr51'] == 'T')
					{
						echo "<strong>x</strong>";
						$Cr51 = "x";
					}			  
			  ?>
              </td>
              <td>Cr-51</td>
              <td><div align="center"> <strong> 
                  <?php
						echo $_POST['mCi6'];
						$mCi6 = $_POST['mCi6'];
			 	 ?>
                  </strong> </div></td>
              <td>mCi</td>
            </tr>
          </table>
          <table width="320" border="0" cellspacing="0" cellpadding="0">
            <tr> 
              <td width="40">Other:</td>
              <td> <div align="left"><strong> 
                  <?php
						echo $_POST['IsotopeOther'];
						$IsotopeOther = $_POST['IsotopeOther'];
			 	 ?>
                  </strong> </div></td>
              <td> <div align="right"><strong> 
                  <?php
						echo $_POST['mCi7'];
						$mCi7 = $_POST['mCi7'];
			 	 ?>
                  &nbsp; </strong> </div></td>
              <td width="50">mCi</td>
            </tr>
          </table>
          <br />
          <table width="220" border="0" cellspacing="0" cellpadding="0">
            <tr> 
              <td colspan="2"><strong>A</strong>. Dry Solid Waste container size:</td>
            </tr>
            <tr> 
              <td> 
                <?php
			  		if ($_POST['Gal32'] == 'T')
					{
						echo "<strong>x</strong>";
						$Gal32 = "x";
					}			  
			  ?>
                32 gal.</td>
              <td> 
                <?php
			  		if ($_POST['Gal10'] == 'T')
					{
						echo "<strong>x</strong>";
						$Gal10 = "x";
					}			  
			  ?>
                10 gal.</td>
            </tr>
          </table>
          <br />
          <table width="300" border="0" cellspacing="0" cellpadding="0">
            <tr> 
              <td><strong>B</strong>. 
                <?php
			  		if ($_POST['Vials'] == 'T')
					{
						echo "<strong>x</strong>";
						$Vials = "x";
					}			  
			  ?>
                Vials</td>
              <td> 
                <?php
			  		if ($_POST['Toluene'] == 'T')
					{
						echo "<strong>x</strong>";
						$Toluene = "x";
					}			  
			  ?>
                Toluene</td>
              <td> 
                <?php
			  		if ($_POST['Xylene'] == 'T')
					{
						echo "<strong>x</strong>";
						$Xylene = "x";
					}			  
			  ?>
                Xylene</td>
            </tr>
            <tr> 
              <td colspan="3">Other: 
                <?php
						echo $_POST['BOther'];
						$BOther = $_POST['BOther'];
			 	 ?>
              </td>
            </tr>
          </table>
          <table width="300" border="0" cellspacing="0" cellpadding="0">
            <tr> 
              <td>Drum size:</td>
              <td> 
                <?php
			  		if ($_POST['Gal55'] == 'T')
					{
						echo "<strong>x</strong>";
						$Gal55 = "x";
					}		  
			  ?>
                55 gal.</td>
              <td> 
                <?php
			  		if ($_POST['Gal33'] == 'T')
					{
						echo "<strong>x</strong>";
						$Gal33 = "x";
					}			  
			  ?>
                33 gal.</td>
              <td> 
                <?php
			  		if ($_POST['Drum10Gal'] == 'T')
					{
						echo "<strong>x</strong>";
						$Drum10Gal = "x";
					}			  
			  ?>
                10 gal.</td>
            </tr>
          </table>
          <br />
          <table width="450" border="0" cellspacing="0" cellpadding="0">
            <tr> 
              <td width="50"><strong>C</strong>. Other:</td>
              <td> <strong> 
                <?php
						echo $_POST['COther'];
						$COther = $_POST['COther'];
			 	 ?>
                </strong> </td>
              <td width="50">Volume:</td>
              <td> <strong> 
                <?php
						echo $_POST['CVolume'];
						$CVolume = $_POST['CVolume'];
			 	 ?>
                </strong> </td>
            </tr>
          </table>
          <br />
          <strong>D</strong>. Aqueous liquid waste: 
          <?php
			  		if ($_POST['Aqueous'] == 'T')
					{
						echo "<strong>x</strong>";
						$Aqueous = "x";
					}			  
			  ?>
          (must complete section F)<br />
          <br />
          <strong>E</strong>. Hazardous chemicals: 
          <?php
			  		if ($_POST['Hazardous'] == 'T')
					{
						echo "<strong>x</strong>";
						$Hazardous = "x";
					}			  
			  ?>
          (must complete section F)<br />
          <br />
          <table width="375" border="0" cellpadding="0" cellspacing="0">
            <tr> 
              <td width="210"><strong>F</strong>. pH (Required for all waste liquids):</td>
              <td> <strong> 
                <?php
						echo $_POST['pH'];
						$pH = $_POST['pH'];
			 	 ?>
                </strong> </td>
            </tr>
          </table>
          <br />
          List all constituents in the container, total must equal 100%. Chemical 
          names only (no abbreviations or formulas).<br />
          <table width="100%" border="1" cellspacing="0" cellpadding="2">
            <tr> 
              <td colspan="3"><div align="center"><strong>Constituents</strong></div></td>
            </tr>
            <tr> 
              <td width="70%"><strong>Name</strong> </td>
              <td width="20%"><div align="center"><strong>Percentage</strong></div></td>
              <td width="10%"><div align="center">%</div></td>
            </tr>
            <tr> 
              <td width="70%"> &nbsp; 
                <?php
								
								echo $_POST['name1'];
								echo "";
								$name1 = $_POST['name1'];
								?>
              </td>
              <td width="20%"> &nbsp; 
                <?php
								
								echo $_POST['percent1'];
								echo "";
								$percent1 = $_POST['percent1'];
								?>
              </td>
              <td width="10%"><div align="center">%</div></td>
            </tr>
            <tr> 
              <td width="70%"> &nbsp; 
                <?php
								
								echo $_POST['name2'];
								echo "";
								$name2 = $_POST['name2'];
								?>
              </td>
              <td width="20%"> &nbsp; 
                <?php
								
								echo $_POST['percent2'];
								echo "";
								$percent2 = $_POST['percent2'];
								?>
              </td>
              <td width="10%"><div align="center">%</div></td>
            </tr>
            <tr> 
              <td width="70%"> &nbsp; 
                <?php
								
								echo $_POST['name3'];
								echo "";
								$name3 = $_POST['name3'];
								?>
              </td>
              <td width="20%"> &nbsp; 
                <?php
								
								echo $_POST['percent3'];
								echo "";
								$percent3 = $_POST['percent3'];
								?>
              </td>
              <td width="10%"><div align="center">%</div></td>
            </tr>
            <tr> 
              <td width="70%"> &nbsp; 
                <?php
								
								echo $_POST['name4'];
								echo "";
								$name4 = $_POST['name4'];
								?>
              </td>
              <td width="20%"> &nbsp; 
                <?php
								
								echo $_POST['percent4'];
								echo "";
								$percent4 = $_POST['percent4'];
								?>
              </td>
              <td width="10%"><div align="center">%</div></td>
            </tr>
            <tr> 
              <td width="70%"> &nbsp; 
                <?php
								
								echo $_POST['name5'];
								echo "";
								$name5 = $_POST['name5'];
								?>
              </td>
              <td width="20%"> &nbsp; 
                <?php
								
								echo $_POST['percent5'];
								echo "";
								$percent5 = $_POST['percent5'];
								?>
              </td>
              <td width="10%"><div align="center">%</div></td>
            </tr>
            <tr> 
              <td width="70%"> &nbsp; 
                <?php
								
								echo $_POST['name6'];
								echo "";
								$name6 = $_POST['name6'];
								?>
              </td>
              <td width="20%"> &nbsp; 
                <?php
								
								echo $_POST['percent6'];
								echo "";
								$percent6 = $_POST['percent6'];
								?>
              </td>
              <td width="10%"><div align="center">%</div></td>
            </tr>
            <tr> 
              <td width="70%"> &nbsp; 
                <?php
								
								echo $_POST['name7'];
								echo "";
								$name7 = $_POST['name7'];
								?>
              </td>
              <td width="20%"> &nbsp; 
                <?php
								
								echo $_POST['percent7'];
								echo "";
								$percent7 = $_POST['percent7'];
								?>
              </td>
              <td width="10%"><div align="center">%</div></td>
            </tr>
            <tr> 
              <td width="70%"> &nbsp; 
                <?php
								
								echo $_POST['name8'];
								echo "";
								$name8 = $_POST['name8'];
								?>
              </td>
              <td width="20%"> &nbsp; 
                <?php
								
								echo $_POST['percent8'];
								echo "";
								$percent8 = $_POST['percent8'];
								?>
              </td>
              <td width="10%"><div align="center">%</div></td>
            </tr>
            <tr> 
              <td>&nbsp;</td>
              <td><div align="center"><strong>Total</strong></div></td>
              <td><strong>100%</strong></td>
            </tr>
          </table>
        </div>
      </center></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr> 
              
          <td width="46%" valign="top"><div align="right"><strong>Size of container:</strong> 
            </div></td>
              <td><?php
								
								echo $_POST['ContainerSize'];
								echo "";
								$ContainerSize = $_POST['ContainerSize'];
								?>
				</td>
            </tr>
            <tr> 
              <td width="46%" valign="top">
<div align="right"><strong>Type of container:</strong></div></td>
              
          <td> 
            <?php
								
								echo $_POST['ContainerType'];
								echo "";
								$ContainerType = $_POST['ContainerType'];
								?>
          </td>
            </tr>
            <tr> 
              <td width="46%" valign="top">
<div align="right"><strong>Amount of waste in container:</strong></div></td>
              
          <td> 
            <?php
								
								echo $_POST['AmountofWaste'];
								echo "";
								$AmountofWaste = $_POST['AmountofWaste'];
								?>
          </td>
            </tr>
            <tr> 
              <td width="46%" valign="top"><div align="right"><strong>Notes:</strong></div></td>
              
          <td> 
            <?php
								
								echo $_POST['textarea'];
								echo "";
								$textarea = $_POST['textarea'];
								?>
          </td>
            </tr>
          </table>
	</td>
  </tr>
</table>
<?php

$todaysdate = date("F d, Y");
				
$toaddress = "fprawl@email.uky.edu, whgarn2@email.uky.edu, drich1@email.uky.edu, gaelli2@email.uky.edu, melawr2@uky.edu, dccrof0@uky.edu, jev224@uky.edu, gina.carlton@uky.edu";
$subject = "R-Waste Ticket " .$todaysdate;
$mailcontent = "Today's date: " .$todaysdate."\n\n"
	."R-Ticket number: R-".$random1."".$random2."\n\n"
	."Name: ".$Name."\n"
	."Department: ".$Department."\n"
	."Building name: ".$Building."\n"
	."Room Num: ".$Room."\n"							
	."Phone: ".$Phone."\n\n\n"
	."H-3: ".$H3."    "."mCi: ".$mCi1."\n"
	."S-35: ".$S35."    "."mCi: ".$mCi2."\n"
	."C14: ".$C14."    "."mCi: ".$mCi3."\n"
	."I-125: ".$I125."    "."mCi: ".$mCi4."\n"
	."P-32: ".$P32."    "."mCi: ".$mCi5."\n"
	."Cr-51: ".$Cr51."    "."mCi: ".$mCi6."\n"
	."Other: ".$IsotopeOther."    "."mCi: ".$mCi7."\n\n\n"
	."A. Dry solid waste container size "."\n"
	."32 gal   " .$Gal32."\n"
	."10 gal   " .$Gal10."\n\n"
	."B. Vials: " .$Vials."   "."Toluene: " .$Toluene."   "."Xylene: " .$Xylene."\n"
	."Other: " .$BOther."\n"
	."Drum size: 55 gal: ".$Gal55."  "."33 gal: ".$Gal33."  "."10 gal: ".$Drum10Gal."\n\n"
	."C. Other: ".$COther."\n"
	."Volume: ".$CVolume."\n\n"
	."D. Aqueous liquid waste: ".$Aqueous."\n"
	."E. Hazardous chemicals: ".$Hazardous."\n"
	."F. pH: ".$pH."\n\n"
	."Constituent 1: ".$name1."       "."Percentage: ".$percent1." % "."\n"
	."Constituent 2: ".$name2."       "."Percentage: ".$percent2." % "."\n"
	."Constituent 3: ".$name3."       "."Percentage: ".$percent3." % "."\n"
	."Constituent 4: ".$name4."       "."Percentage: ".$percent4." % "."\n"
	."Constituent 5: ".$name5."       "."Percentage: ".$percent5." % "."\n"
	."Constituent 6: ".$name6."       "."Percentage: ".$percent6." % "."\n"
	."Constituent 7: ".$name7."       "."Percentage: ".$percent7." % "."\n"
	."Constituent 8: ".$name8."       "."Percentage: ".$percent8." % "."\n\n\n"
	."Size of container: " .$ContainerSize."\n"
	."Type of container: " .$ContainerType."\n"
	."Amount of waste in container: " .$AmountofWaste."\n"
	."Notes: " .$textarea."\n";							
$fromaddress = "R-Waste Ticket";
mail($toaddress, $subject, $mailcontent, $fromaddress);

?>
<div align="center"><br />
  <a href="wasteticket.php" class="trans">Next Ticket</a> <img src="../media/image/pointer.gif" alt="" width="15" height="14" border="0" class="trans" /></div>
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