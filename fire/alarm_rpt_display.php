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
<body bgcolor="#FFFFFF" link="#000088" vlink="#007788" onLoad="MM_preloadImages('../media/image/ehs3_03-over.png','../media/image/ehs3_04-over.png','../media/image/ehs3_05-over.png','../media/image/ehs3_06-over.png')">
<table width="640" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <!--Header of Page-->
    <td width="446" align="left" valign="top"><img src="../media/image/ehs3_01.png" alt="" width="440" height="61" /><img src="../media/image/ehs3_02.png" alt="" width="140" height="18" /><a href="/" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image12','','../media/image/ehs3_03-over.png',1)"><img src="../media/image/ehs3_03.png" alt="Mission" name="Image12" width="75" height="16" border="0" id="Image12" /></a><a href="../services.html" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image13','','../media/image/ehs3_04-over.png',1)"><img src="../media/image/ehs3_04.png" alt="Services" name="Image13" width="74" height="16" border="0" id="Image13" /></a><a href="../ehsstaff.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image14','','../media/image/ehs3_05-over.png',1)"><img src="../media/image/ehs3_05.png" alt="Staff" name="Image14" width="74" height="16" border="0" id="Image14" /></a><a href="../search2.html" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image15','','../media/image/ehs3_06-over.png',1)"><img src="../media/image/ehs3_06.png" alt="Search" name="Image15" width="75" height="16" border="0" id="Image15" /></a><img src="../media/image/ehs3_07.png" width="2" height="18" alt="" /><img src="../media/image/ehs3_08.png" width="298" height="2" alt="" /> 
    </td>
    <td width="194" align="right" valign="middle"><div align="left"> 
        <div class="top"> 
          <div align="left"></div>
        </div>
      </div>
      <div align="center" class="top"><a href="//wwwagwx.ca.uky.edu/stormready/safeplaces.shtml?314" class="link"><img src="../media/image/primary_shelter_ICON.gif" alt="Severe Weather Shelter" width="90" height="89" border="0" /></a></div></td>
  </tr>
  <tr> 
    <td colspan="2" align="left" valign="top"><strong><font size="5">Fire Alarm Report List<br />
    </font></strong></td>
  </tr>
</table>

<a href="/fire/alarm_rpt_build.php">Back To Report Build</a><p></p>

<?php 
		
	//$todaysdate = date("jS F Y g:ia");
	$todaysdate = date("F d, Y");
	$time = date("g:ia");
	
	//replaces single quotes ' with two single quotes '' because mssql does not use backslash as escape character.
	function mssql_addslashes($data) {
		$data = str_replace("'", "''", $data);
		return $data;
	}


		//*************  Prepare variables    ********************
		
		//combined times
		$timercvd 		= addslashes($_POST["hour"].":".$_POST["mins"]." ".$_POST["recap"]);
		//changed below
		$deactivated 	= addslashes($_POST["silencedhour"].":".$_POST["silencedmins"]." ".$_POST["silencedap"]);
		//changed below
		$reset 			= addslashes($_POST["resethour"].":".$_POST["resetmins"]." ".$_POST["resetap"]);
		
		$date_start		= $_POST["date_start"];
		$date_end		= $_POST["date_end"];
		$iMonth_Start   = $_POST["month_start"];
		$iDay_Start   	= $_POST["day_start"];
		$iYear_Start   	= $_POST["year_start"];
		$iHour_Start   	= $_POST["hour_start"];
		$iMinute_Start  = $_POST["minute_start"];
		$iMonth_End   	= $_POST["month_end"];
		$iDay_End  		= $_POST["day_end"];
		$iYear_End  	= $_POST["year_end"];
		$iHour_End  	= $_POST["hour_end"];
		$iMinute_End  	= $_POST["minute_end"];
				
		$iRecfrom 		= $_POST["recfrom"];
		
		$incident 		= addslashes($_POST["incident"]);
		$cause 			= addslashes($_POST["cause"]);
		$phone 			= addslashes($_POST["phone"]);
		$pull 			= $_POST["pull"];
		$smoke 			= $_POST["smoke"];
		$sprinkler 		= $_POST["sprinkler"];
		$stove 			= $_POST["stove"];
		$building 		= $_POST["building"];
		$occupied 		= addslashes($_POST["occupied"]);
		$evacuated 		= addslashes($_POST["evacuated"]);
		$notified 		= addslashes($_POST["notified"]);
		$activated 		= addslashes($_POST["activated"]);
		$occur 			= addslashes($_POST["occur"]);
		$extinguisher 	= addslashes($_POST["extinguisher"]);
		$injuries 		= addslashes($_POST["injuries"]);
		$silenced_start	= addslashes($_POST["silenced_start"]);
		$silenced_end	= addslashes($_POST["silenced_end"]);
		$reset_start	= addslashes($_POST["reset_start"]);
		$reset_end		= addslashes($_POST["reset_end"]);		
		$filer			= addslashes($_POST["filer"]);			
		
		$type 			= $_POST["type"];
		$deptinvolved 	= $_POST["deptinvolved"];
		$fatality 		= $_POST["fatality"];
		$propDamage 	= $_POST["propDamage"];
		$res 			= $_POST["residential"];
		
		//changed below from addslashes to mssql_addslashes
		$deptinvolvedother 	= mssql_addslashes($_POST["deptinvolvedother"]);
		$BldgOther 			= mssql_addslashes($_POST["BldgOther"]);
		$causeother 		= mssql_addslashes($_POST["causeother"]);			
		$additional 		= mssql_addslashes($_POST["requireddescription"]);
		$description 		= mssql_addslashes($_POST["injdescription"]);
		$lname 				= mssql_addslashes($_POST["lname"]);
		$fname 				= mssql_addslashes($_POST["fname"]);
		$department 		= mssql_addslashes($_POST["department"]);
		$incidentother 		= mssql_addslashes($_POST["incidentother"]);
		$other 				= mssql_addslashes($_POST["other"]);
		$room 				= mssql_addslashes($_POST["room"]);
				
	//Connect to DB server.		
	$db_conn = mssql_connect("128.163.184.42","EHSInfo_User","ehsinfo") or die( "ERROR: Connection to database failed, please contact the webmaster immediately in order to record your results. 257-3241" ); 			
	
	//Open database.
	mssql_select_db("ehsinfo", $db_conn) or die( "ERROR: Selecting database failed,<br>please contact the <a href=\"mailto:dvcask20@email.uky.edu\">webmaster</a> immediately. 257-3241" );			
	mssql_query("SET TEXTSIZE 2147483647"); //Set text size to max (no resource loss in doing this, and otherwise text is truncated at around 4000 chars).		

?>
	<table width="60%" border="1" cellpadding="2" cellspacing="1">
<?php			
	
	$query 	= "SELECT 
	id 																			AS	'Fire ID',
	tbl_list_building.building_id + ', ' + building_desc								AS  'Building',
	CASE WHEN		bldgother			= ''	THEN 'NA' 	ELSE bldgother			END	AS 	'Building Alt.',
	CASE WHEN 		room_no				= ''	THEN 'NA' 	ELSE room_no			END	AS 	'Room',
	CASE WHEN 		tbl_list_building.res = '1'	THEN 'YES' 	ELSE 'No'				END	AS 	'Residential',
	date_rcvd																			AS 	'Received',
	rcvd_from_id																		AS	'Received From',
	CASE WHEN		rcvd_from_other		= ''	THEN 'NA' 	ELSE rcvd_from_other	END	AS	'Received From Alt',
	CASE WHEN 		occupied			= 1 	THEN 'Yes' 	ELSE 'No' 				END	AS 	'Building Occupied',
	CASE WHEN 		evacuated			= 1 	THEN 'Yes' 	ELSE 'No' 				END AS 	'Building Evacuated',
	CASE WHEN 		notified			= 1		THEN 'Yes'	ELSE 'No'				END AS 	'Fire Dept. Notified',
	CASE WHEN 		activated			= 1		THEN 'Yes'	ELSE 'No'				END AS 	'Alarm Activated',
	CASE WHEN 		pull_station		= 1		THEN 'Yes'	ELSE 'No'				END AS 	'Pull Station',
	CASE WHEN 		sprinkler			= 1		THEN 'Yes'	ELSE 'No'				END AS 	'Sprinkler',
	CASE WHEN 		smoke_detector		= 1		THEN 'Yes'	ELSE 'No'				END AS 	'Smoke Detector',
	CASE WHEN 		stove_supp			= 1		THEN 'Yes'	ELSE 'No'				END AS 	'Stove Suppression',
	time_silenced																		AS	'Silenced',
	time_reset																			AS	'Reset',
	CASE WHEN 		occur 				= 1		THEN 'Yes'	ELSE 'No'				END AS 	'Fire Occured',
	incident_id																			AS	'Area',
	CASE WHEN		incident_other		= ''	THEN 'NA' 	ELSE incident_other		END	AS	'Area Alt.',
	cause_id																			AS	'Cause',
	CASE WHEN		cause_other			= ''	THEN 'NA' 	ELSE cause_other		END	AS	'Cause Alt.',
	CASE WHEN		deptinvolved		= NULL	THEN 'NA'	ELSE deptinvolved		END AS 	'Dept.',
	CASE WHEN		deptinvolved_other	= NULL 	THEN 'NA' 	ELSE deptinvolved_other	END	AS	'Dept. Alt.',
	CASE WHEN 		extinguisher		= 1		THEN 'Yes'	ELSE 'No'				END AS 	'Extinguisher Used',
	CASE WHEN 		injuries			= 1		THEN 'Yes'	ELSE 'No'				END AS 	'Injuries',
	CASE WHEN 		fatality			= 1		THEN 'Yes'	ELSE 'No'				END AS 	'Fatalities',
	CASE WHEN		injuries_desc		= ''	THEN 'NA' 	ELSE injuries_desc		END	AS	'Injuries Desc.',
	CASE WHEN 		propDamage			= 1		THEN 'Yes'	ELSE 'No'				END AS 	'Property Damage',
	CASE WHEN		incident_desc		= ''	THEN 'NA' 	ELSE incident_desc		END	AS	'Incident Desc.',
	filer_fname + ' ' + filer_lname + ', ' + filer_phone + ', ' + dept_other			AS	'Filer'

	FROM 			tbl_fire_alarm 
	
	LEFT JOIN       tbl_list_building
	ON 				tbl_list_building.building_id	= tbl_fire_alarm.building_id
	LEFT JOIN       tbl_fire_alarm_filer
	ON 				tbl_fire_alarm_filer.filer_id 	= tbl_fire_alarm.filer_id

	WHERE 			(tbl_fire_alarm.building_id 	= 		'"	.$building.			"' OR " 	.$building.			"= -1)
	AND 			(tbl_list_building.res			= 		'"	.$res.				"' OR " 	.$res. 				"= -1)
	AND 			(room_no 						= 		'"	.$room.				"' OR " 	.$room. 			"= -1)	
	AND 			(date_rcvd						between '"  .$date_start.		"' AND '"	.$date_end.			"')
	AND				(rcvd_from_id					= 		'"	.$iRecfrom.			"' OR "		.$iRecfrom. 		"= -1)
	AND				(occupied						=		'" 	.$occupied.			"' OR "		.$occupied.			"= -1)
	AND				(evacuated						=		'" 	.$evacuated.		"' OR "		.$evacuated.		"= -1)
	AND				(notified						=		'" 	.$notified.			"' OR "		.$notified.			"= -1)
	AND				(activated						=		'" 	.$activated.		"' OR "		.$activated.		"= -1)
	AND				(pull_station					=		'" 	.$pull.				"' OR "		.$pull.				"= -1)
	AND				(smoke_detector					=		'" 	.$smoke.			"' OR "		.$smoke.			"= -1)
	AND				(sprinkler						=		'" 	.$sprinkler.		"' OR "		.$sprinkler.		"= -1)
	AND				(stove_supp						=		'" 	.$stove.			"' OR "		.$stove.			"= -1)
	AND 			(time_silenced					between '"  .$silenced_start.	"' AND '"	.$silenced_end.		"')
	AND 			(time_reset						between '"  .$reset_start.		"' AND '"	.$reset_end.		"')
	AND				(occur							=		'" 	.$occur.			"' OR "		.$occur.			"= -1)
	AND				(type							=		'" 	.$type.				"' OR "		.$type.				"= -1)
	AND				(incident_id					=		'" 	.$incident.			"' OR "		.$incident.			"= -1)
	AND				(cause_id						=		'" 	.$cause.			"' OR "		.$cause.			"= -1)
	AND				(deptinvolved					=		'" 	.$deptinvolved.		"' OR "		.$deptinvolved.		"= -1)
	AND				(extinguisher					=		'" 	.$extinguisher.		"' OR "		.$extinguisher.		"= -1)
	AND				(injuries						=		'" 	.$injuries.			"' OR "		.$injuries.			"= -1)
	AND				(fatality						=		'" 	.$fatality.			"' OR "		.$fatality.			"= -1)
	AND				(propDamage						=		'" 	.$propDamage.		"' OR "		.$propDamage.		"= -1)
	AND				(tbl_fire_alarm.filer_id		=		'" 	.$filer.			"' OR "		.$filer.			"= -1)
	ORDER BY		date_rcvd	
	";
	
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
<table width="640" border="0" cellpadding="0" cellspacing="0">
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