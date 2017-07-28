<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Environmental Health and Safety, University of Kentucky</title>
<meta name="Keywords" content="environment, environmental, health, safety, environmental health, environmental health and safety, environmental health and safety, ehs" />
<meta name="Description"
content="Service and support for the University community for environmental health and safety programs that protect the environment, provide safe and healthy working conditions for work and study, and comply with applicable laws and regulations." />
<style type="text/css">
<!--
@import url(../libraries/css/main.css);
-->
</style>
<script language="JavaScript" type="text/javascript" src="../libraries/swap.js"></script>
<script language="JavaScript" type="text/javascript" src="../libraries/javascript/popup.js"></script>
</head>
<body bgcolor="#FFFFFF" link="#000088" vlink="#007788" onload="MM_preloadImages('../media/image/ehs3_03-over.png','../media/image/ehs3_04-over.png','../media/image/ehs3_05-over.png','../media/image/ehs3_06-over.png')">
<table width="640" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <!--Header of Page-->
    <td width="446" align="left" valign="top"><img src="../media/image/ehs3_01.png" alt="" width="440" height="61" /><img src="../media/image/ehs3_02.png" alt="" width="140" height="18" /><a href="/" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image12','','../media/image/ehs3_03-over.png',1)"><img src="../media/image/ehs3_03.png" alt="Mission" name="Image12" width="75" height="16" border="0" id="Image12" /></a><a href="../services.html" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image13','','../media/image/ehs3_04-over.png',1)"><img src="../media/image/ehs3_04.png" alt="Services" name="Image13" width="74" height="16" border="0" id="Image13" /></a><a href="../ehsstaff.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image14','','../media/image/ehs3_05-over.png',1)"><img src="../media/image/ehs3_05.png" alt="Staff" name="Image14" width="74" height="16" border="0" id="Image14" /></a><a href="../search2.html" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image15','','../media/image/ehs3_06-over.png',1)"><img src="../media/image/ehs3_06.png" alt="Search" name="Image15" width="75" height="16" border="0" id="Image15" /></a><img src="../media/image/ehs3_07.png" width="2" height="18" alt="" /><img src="../media/image/ehs3_08.png" width="298" height="2" alt="" /> 
    </td>
    <td width="194" align="right" valign="middle"><div align="left"> 
        <div class="top"> 
          <div align="left"></div>
        </div>
      </div>
      <div align="center" class="top"><a href="//wwwagwx.ca.uky.edu/stormready/safeplaces.shtml?314" class="link"><img src="../media/image/primary_shelter_ICON.gif" alt="Severe Weather Shelter" width="90" height="89" border="0" /></a></div></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top"><strong><font size="5">CFATS Administration</font></strong><br />
      <strong>Welcome to CFATS administration; this page allows you to adjust basic CFATS entry parameters and view CFATS data.</a></strong></td>
  </tr>
</table>
<?php 

	$oAccname = "ehsstaff"; 	//Username.
	$password = "!ehs5taff"; 	//Password.
	
	if ($_POST['txtUsername'] != $oAccname || $_POST['txtPassword'] != $password) { 

?> 
<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
    <p><label for="txtUsername">Username:</label> 
    <br /><input type="text" title="Enter your Username" name="txtUsername" /></p> 

    <p><label for="txtpassword">Password:</label> 
    <br /><input type="password" title="Enter your password" name="txtPassword" /></p> 

    <p><input type="submit" name="Submit" value="Login" /></p>
</form> 

<?php 

	}else{ 
	
		$coi_select = "<option value=0>Select COI</option>";			//COI droplist.
		$unit_select = "<option value=0>Select Unit</option>";  		//Unit type droplist.
		$facility_select = "<option value=0>Select Facility</option>"; 	//Facility dropdown.	
			
		//Connect to DB server.		
		$db_conn = mssql_connect("128.163.184.42","EHSInfo_User","ehsinfo") or die( "ERROR: Connection to database failed, please contact the webmaster immediately in order to record your results. 257-3241" ); 			
		
		//Open database.
		mssql_select_db("ehs", $db_conn) or die( "ERROR: Selecting database failed,<br>please contact the <a href=\"mailto:dvcask20@email.uky.edu\">webmaster</a> immediately. 257-3241" );			
		mssql_query("SET TEXTSIZE 2147483647"); //Set text size to max (no resource loss in doing this, and otherwise text is truncated at around 4000 chars).
			
		//Query for basic page parameters.
		$query = "SELECT * FROM chem_params";	//Set up page parameter query.
		$result = mssql_query($query);			//Run parameter query.			
		$params = mssql_fetch_row($result);		//Parse results into array.
	
?> 

<br />
<form action="/cfats/cfats_admin_submit_0001.php" method="post">
<strong>Title:</strong><br />
<textarea name="title_text" cols="100" id="textarea3"><?php echo $params[3]; ?></textarea>
<br />
<p>  <strong>Introduction:</strong><br />
  <textarea name="intro_text" cols="100" rows="15" id="intro_text"><?php echo $params[4]; ?></textarea>
</p>
<p> 
  <strong>Instructions:</strong><br />
  <textarea name="entry_text" cols="100" rows="10" id="textarea2"><?php echo $params[5]; ?></textarea>
</p>
<p> <strong>Users may add up to</strong> 
  <input name="max_entries" type="text" size="5" value ="<?php echo $params[1]; ?>"/>
  <strong>entries at one time.</strong><br />
  <br />
  <strong>Labels:</strong></p>
<table width="60%" height="0" border="0" cellpadding="1" cellspacing="0" bgcolor="#EFEFEF">
  <tr>
    <td height="21" bgcolor="#CCCCCC"><textarea name="label1" cols="40" rows="5" id="label1"><?php echo $params[6]; ?></textarea></td>
    <td> User enters date and time here.</td>
  </tr>
  <tr> 
    <td bgcolor="#CCCCCC"><textarea name="label2" cols="40" rows="5" id="label2"><?php echo $params[7]; ?></textarea></td>
    <td>User enters responsible party here.</td>
  </tr>
  <tr> 
    <td width="54%" bgcolor="#CCCCCC"><textarea name="label3" cols="40" rows="5" id="label3"><?php echo $params[8]; ?></textarea></td>
    <td width="46%">User selects facility (building) here.</td>
  </tr>
  <tr> 
    <td bgcolor="#CCCCCC">
      <textarea name="label4" cols="40" rows="5" id="label4"><?php echo $params[9]; ?></textarea></td>
    <td>User enters an area or room number here.</td>
  </tr>
</table>
<br />
<table width="60%" border="0" cellpadding="2" cellspacing="0" bgcolor="#EFEFEF">
  <tr bgcolor="#CCCCCC"> 
    <td>
      <textarea name="label5" rows="8" id="label5"><?php echo $params[10]; ?></textarea></td>
    <td>
      <textarea name="label6" rows="8" id="label6"><?php echo $params[11]; ?></textarea></td>
    <td>
      <textarea name="label7" rows="8" id="label7"><?php echo $params[12]; ?></textarea></td>
    <td>
      <textarea name="label8" rows="8" id="label8"><?php echo $params[13]; ?></textarea></td>
  </tr>
  <tr bgcolor="#EFEFEF"> 
    <td><font size="2">User selects Chemical of interest here.</font></td>
    <td><font size="2">User enters quantity here.</font></td>
    <td><font size="2">User enters percentage here.</font></td>
    <td><font size="2">User selects measurement unit here.</font></td>
  </tr>
</table>
<br />
<input type="submit" name="Submit" value="Submit" />
<br />
<br />
<font size="4"><strong>Current COI Entries:</strong></font><br />
<table width="60%" border="1" cellpadding="2" cellspacing="0" bgcolor="#EFEFEF"> 
<tr bgcolor="#CCCCCC">
<?php
		$query ="SELECT 
			time_stamp 		AS	'Auto Time Stamp',
			user_date		AS	'User Time Stamp',
			party			AS	'Responsible Party',
			facility		AS	'Facility (building)',
			area			AS	'Area (room/lab)',
			coi				AS	'COI CAS Number',
			coi_desc		AS	'COI Name',
			quantity		AS	'Quantity',
			units			AS	'Units',
			percentage		AS	'%'
		
			FROM chem_main
					
			LEFT JOIN       chem_coi_list
			ON 				chem_coi_list.cas_number	= chem_main.coi";
			
		$result = mssql_query($query);

		//Output query results as table.
		while($sField = mssql_fetch_field($result)){
			echo "<td><strong>" .$sField->name. "</strong></td>";
			$iFields++; 
		}
		
		while($line = mssql_fetch_row($result)){		
			$iRecCount++;
			echo "</tr><tr>";
					
			for ($i = 0; $i < $iFields; $i++){			
				echo "<td><font size =1>".$line[$i]."</td>";			
			}
			
			echo "</tr></font>";
		}
		
		echo "</table><p>Total: " .$iRecCount;
		
?>
<p></p><table width="640" border="0" cellpadding="0" cellspacing="0">
  <tr>
        <!--Navigation links-->        
    <td colspan="3" align="center"> 
      <img src="../media/image/line2.gif" alt="" />
	  <br />
      <font face="Arial, Helvetica, sans-serif" size="2"><b><a title="UK" href="//www.uky.edu/" class="link">UK</a></b></font><b><font face="Arial, Helvetica, sans-serif" size="2"> 
      | <a title="Campus Services" href="//www.uky.edu/Services/" class="link">Campus Services</a></font></b>
	  </td>
	</tr>	
  <tr>
   
    <!--Address-->
    <td width="200" valign="top"><p><font size="2" face="Arial, Helvetica, sans-serif">252 East Maxwell Street<br />
Lexington, KY 40506-0314
    </font></p>
      <p>
    </p></td>          
    <td width="235" valign="top">&nbsp;</td>        
    <td width="222" valign="top"><p><font size="2" face="Arial, Helvetica, sans-serif">Phone: 
        (859) 257-1376<br />
    Fax: (859) 257-8787</font></p>
	</td>
  </tr>
  <tr>      
    <td colspan="2" valign="top"><font face="Arial, Helvetica, sans-serif" size="1">Last 
      modified: 03.26.2008<br />
      Send comments to: <a href="mailto:dvcask2@email.uky.edu" class="link">Damon V. Caskey </a></font></td>
    <td width="222" valign="top"><img src="../media/image/camp_serv.png" alt="Campus Services" title="Campus Services" width="151" height="28" /></td>
  </tr>
	<tr valign="top">
	<td colspan="3"><font size="1" face="Arial, Helvetica, sans-serif">Warning - Some Web sites to which these materials provide links for the convenience of users are not managed by the University of Kentucky. The University takes no responsibility for the contents of those sites. </font></td>
  </tr>
</table>

<?php 

} 

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