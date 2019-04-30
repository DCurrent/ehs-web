<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<html>
<head>
<title>Report Submitted</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="refresh" content="15;URL=/">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<?php
//$todaysdate = date("jS F Y g:ia");
$todaysdate = date("F d, Y");
$time = date("g:ia");
echo "<div align=\"center\">";
echo "<table width=\"600\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
echo "<tr>";
echo "<td>";
echo "<div align=\"left\"><img src=\"firealarm.gif\" alt=\"UK Fire Alarm Report\">";
echo "</td>";
echo "</tr>";
echo "</table><br>";

echo "<table width=\"600\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
echo "<tr>";
echo "<td>";
echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\">";
echo "Thank you for your report, it will be handled in a timely manner. <br><br>You will be redirected to the UK Fire Marshal's page in just a moment. <br>If not, the url is <a href=\"/\">here</a>.";
echo "</font></td></tr></table>";
echo "</div>";

//replaces single quotes ' with two single quotes '' because mssql does not use backslash as escape character.
function mssql_addslashes($data) {
   $data = str_replace("'", "''", $data);
   return $data;
}


			//*************  Prepare variables    ********************
			
			//combined times
			//$timercvd = addslashes($_POST["hour"].":".$_POST["mins"]." ".$_POST["recap"]);
			//changed below
			$deactivated = addslashes($_POST["silencedhour"].":".$_POST["silencedmins"]." ".$_POST["silencedap"]);
			//changed below
			$reset = addslashes($_POST["resethour"].":".$_POST["resetmins"]." ".$_POST["resetap"]);
				
			//combined date recvd
			$datercvd = $_POST["month"]."/".$_POST["day"]."/".$_POST["year"]. " ".$_POST["hour"].":".$_POST["mins"]." ".$_POST["recap"];			
			$recfrom = addslashes($_POST["recfrom"]);
			$incident = addslashes($_POST["incident"]);
			$cause = addslashes($_POST["cause"]);
			$phone = addslashes($_POST["phone"]);
			$pull = $_POST["pull"];
			$smoke = $_POST["smoke"];
			$sprinkler = $_POST["sprinkler"];
			$stove = $_POST["stove"];
			$buildingname = $_POST["buildingname"];
			$occupied = addslashes($_POST["occupied"]);
			$evacuated = addslashes($_POST["evacuated"]);
			$notified = addslashes($_POST["notified"]);
			$activated = addslashes($_POST["activated"]);
			$occur = addslashes($_POST["occur"]);
			$extinguisher = addslashes($_POST["extinguisher"]);
			$injuries = addslashes($_POST["injuries"]);
			//added below 09-02-2004
			$type = $_POST["type"];
			$deptinvolved = $_POST["deptinvolved"];
			$fatality = $_POST["fatality"];
			$propDamage = $_POST["propDamage"];
			
			//changed below from addslashes to mssql_addslashes
			$deptinvolvedother = mssql_addslashes($_POST["deptinvolvedother"]);
			//changed below from addslashes to mssql_addslashes
			$BldgOther = mssql_addslashes($_POST["BldgOther"]);
			//changed below from addslashes to mssql_addslashes
			$causeother = mssql_addslashes($_POST["causeother"]);			
			//changed below from addslashes to mssql_addslashes
			$additional = mssql_addslashes($_POST["requireddescription"]);
			//changed below from addslashes to mssql_addslashes
			$description = mssql_addslashes($_POST["injdescription"]);
			//changed below from addslashes to mssql_addslashes
			$lname = mssql_addslashes($_POST["lname"]);
			//changed below from addslashes to mssql_addslashes
			$fname = mssql_addslashes($_POST["fname"]);
			//changed below from addslashes to mssql_addslashes
			$department = mssql_addslashes($_POST["department"]);
			//changed below from addslashes to mssql_addslashes
			$incidentother = mssql_addslashes($_POST["incidentother"]);
			//changed below from addslashes to mssql_addslashes
			$other = mssql_addslashes($_POST["other"]);
			//changed below from addslashes to mssql_addslashes
			$room = mssql_addslashes($_POST["room"]);

//Adding no comments to email if check boxes are not checked
if ($pull != "1")
{
	$pull = "0";
}
if ($smoke != "1")
{
	$smoke = "0";
}
if ($sprinkler != "1")
{
	$sprinkler = "0";
}
if ($stove != "1")
{
	$stove = "0";
}
if ($fatality != "1")
{
	$fatality = "0";
}
if ($propDamage != "1")
{
	$propDamage = "0";
}

//Database connection 128.163.184.42					

			//$db_hostname 	= "128.163.184.42";
			$db_hostname 	= "GENSQLAGL\general";
			$db_connection 	= array("Database"=>"ehsinfo", "UID"=>"EHSInfo_User", "PWD"=>"ehsinfo");
			
			$db_conn 		= sqlsrv_connect($db_hostname, $db_connection);	
			
			
			//Query the database
			//Insert info into fire alarm filer table
			$query_filer = "INSERT INTO tbl_fire_alarm_filer(filer_lname, filer_fname, filer_phone, dept_other, date, time) VALUES ('$lname', '$fname', '$phone', '$department', '$todaysdate', '$time')";
			
			$qr1 = sqlsrv_query($db_conn, $query_filer);			

			//Error checking			
			if(!$qr1)
			{				
				echo "Could not insert the Filer's information into the database <br>";
				echo "Please contact the <a href=\"mailto:dvcask2@email.uky.edu\">webmaster</a> immediately in order to record your information. 257-3241";
					//Setting up email function					
			$toaddress = "dvcask2@uky.edu";
			$subject = "Fire Alarm/False Alarm Report " .$todaysdate;
			$mailcontent = "Today's date: " .$todaysdate."\n\n"
							."Building\n"
							."----------\n"
							."Building number: ".$buildingname
							."                         If other, explain: ".$BldgOther."\n"
							."Room Num: ".$room."\n\n\n"							
							."First Alarm Received\n"
							."----------\n"
							."Date of alarm: ".$datercvd
							."                          Time alarm received: ".$timercvd."\n"
							."Received from: ".$recfrom
							."                    If other, explain: " .$other."\n\n"
							."Building occupied: " .$occupied."\n"
							."Building evacuated: " .$evacuated."\n"
							."Fire department notified: " .$notified."\n"
							."Fire alarm activated: " .$activated."\n"
							."Fire alarm devices activated:\n"
							."    Pull station: " .$pull
							."                       Sprinkler system: " .$sprinkler."\n"
							."    Smoke detector: " .$smoke
							."                 Stove suppression system: " .$stove."\n\n"
							."Time alarm silenced: " .$deactivated
							."               Time alarm reset: " .$reset."\n\n\n"
							."Incident\n"
							."----------\n"
							."Did a fire occur: " .$occur."\n"
							."Type: " .$type."\n"
							."Area of incident: " .$incident."\n"
							."If other area, explain: " .$incidentother."\n"
							."Cause of alarm: " .$cause."\n"
							."If other cause, explain: " .$causeother."\n"
							."Dept Involved: " .$deptinvolved."\n"
							."If other department, explain: " .$deptinvolvedother."\n\n"
							."Fire extinguisher used: " .$extinguisher."\n"
							."Injuries: " .$injuries."\n"
							."Fatality: " .$fatality."\n"
							."Property damage: " .$propDamage."\n"
							."Description of injuries: " .$description."\n\n"
							."Description of incident: " .$additional."\n\n\n"
							."Person Filing Report\n"
							."----------\n"
							."First Name: ".$fname."\n"
							."Last Name: ".$lname."\n"
							."Department: ".$department."\n"
							."Phone: ".$phone."\n";							
			$fromaddress = "Fire Report";
			
			mail($toaddress, $subject, $mailcontent, $fromaddress);
					//End email function
				exit;
				//sqlsrv_close($db_conn);
			}
			
			//Get filer id after it was inserted above			
			$filer_id = "SELECT filer_id FROM tbl_fire_alarm_filer WHERE filer_lname = '$lname' AND filer_fname = '$fname' AND filer_phone = '$phone' AND date = '$todaysdate' AND time = '$time'";
			
			$qr2 = sqlsrv_query($db_conn, $filer_id);
			$row2 = sqlsrv_fetch_array($qr2);
			
			//changed below to test_table from tbl_fire_alarm
			
			//Insert info into fire alarm table
			$query_alarm ="INSERT INTO tbl_fire_alarm(building_id, bldgother, room_no, date_rcvd, rcvd_from_id, rcvd_from_other, time_silenced, time_reset, incident_id, incident_other, cause_id, cause_other, incident_desc, filer_id, occupied, evacuated, notified, activated, occur, extinguisher, injuries, injuries_desc, pull_station, sprinkler, smoke_detector, stove_supp, type, deptinvolved, deptinvolved_other, fatality, propDamage) VALUES ('$buildingname', '$BldgOther', '$room', '$datercvd', '$recfrom', '$other', '$deactivated', '$reset', '$incident', '$incidentother', '$cause', '$causeother', '$additional', '$row2[filer_id]', '$occupied', '$evacuated', '$notified', '$activated', '$occur', '$extinguisher', '$injuries', '$description', '$pull', '$sprinkler', '$smoke', '$stove', '$type', '$deptinvolved', '$deptinvolvedother', '$fatality', '$propDamage')";
			/*
			$query_alarm ="INSERT INTO tbl_fire_alarm (building_id) VALUES ('$buildingname')";
			*/
			$qr3 = sqlsrv_query($db_conn, $query_alarm);
			
			//Error checking			
			if(!$qr3)
			{
				
				if( ($errors = sqlsrv_errors() ) != null)
				  {
					 foreach( $errors as $error)
					 {
						echo "SQLSTATE: ".$error[ 'SQLSTATE']."\n";
						echo "code: ".$error[ 'code']."\n";
						echo "message: ".$error[ 'message']."\n";
					 }
				  }
								
				//echo "Error: " .sqlsrv_errors()."<br>" ;	
				echo "Could not insert the alarm information into the database <br>";
				echo "Please contact the <a href=\"mailto:dvcask2@email.uky.edu\">webmaster</a> immediately in order to record the fire report. 257-3241<br>";
					//Setting up email function
			$toaddress = "dvcask2@uky.edu";
			$subject = "Fire Alarm/False Alarm Report " .$todaysdate;
			$mailcontent = 	"Today's date: " .$todaysdate."\n\n"
							."Building\n"
							."----------\n"
							."Building number: ".$buildingname
							."                         If other, explain: ".$BldgOther."\n"
							."Room Num: ".$room."\n\n\n"							
							."First Alarm Received\n"
							."----------\n"
							."Date of alarm: ".$datercvd
							."                          Time alarm received: ".$timercvd."\n"
							."Received from: ".$recfrom
							."                    If other, explain: " .$other."\n\n"
							."Building occupied: " .$occupied."\n"
							."Building evacuated: " .$evacuated."\n"
							."Fire department notified: " .$notified."\n"
							."Fire alarm activated: " .$activated."\n"
							."Fire alarm devices activated:\n"
							."    Pull station: " .$pull
							."                       Sprinkler system: " .$sprinkler."\n"
							."    Smoke detector: " .$smoke
							."                 Stove suppression system: " .$stove."\n\n"
							."Time alarm silenced: " .$deactivated
							."               Time alarm reset: " .$reset."\n\n\n"
							."Incident\n"
							."----------\n"
							."Did a fire occur: " .$occur."\n"
							."Type: " .$type."\n"
							."Area of incident: " .$incident."\n"
							."If other area, explain: " .$incidentother."\n"
							."Cause of alarm: " .$cause."\n"
							."If other cause, explain: " .$causeother."\n"
							."Dept Involved: " .$deptinvolved."\n"
							."If other department, explain: " .$deptinvolvedother."\n\n"
							."Fire extinguisher used: " .$extinguisher."\n"
							."Injuries: " .$injuries."\n"
							."Fatality: " .$fatality."\n"
							."Property damage: " .$propDamage."\n"
							."Description of injuries: " .$description."\n\n"
							."Description of incident: " .$additional."\n\n\n"
							."Person Filing Report\n"
							."----------\n"
							."First Name: ".$fname."\n"
							."Last Name: ".$lname."\n"
							."Department: ".$department."\n"
							."Phone: ".$phone."\n";							
				$fromaddress = "ggwill2@uky.edu";
				if(mail($toaddress, $subject, $mailcontent, $fromaddress))
				{
					echo "Mailed.<br>";
				}
				else
				{
					echo "Mail failed.<br>";
				}				
				
					//End email function
				exit;
				//sqlsrv_close($db_conn);
			}


//added below 09-02-2004
if ($type == "1")
{
	$type = "True Alarm";
}elseif ($type == "2")
{
	$type ="Nuisance Alarm";
}elseif ($type =="5")
{ 
	$type = "Threat of Fire";
}else { $type = "Malicious Alarm";}

switch($deptinvolved)
{
	case "00":
		$deptinvolved = "Select department...";
		break;
	case "01":
		$deptinvolved = "Campus PPD";
		break;
	case "02":
		$deptinvolved = "Contractor";
		break;
	case "03":
		$deptinvolved = "Faculty";
		break;
	case "04":
		$deptinvolved = "Housing";
		break;
	case "05":
		$deptinvolved = "Med. Ctr. PPD";
		break;
	case "06":
		$deptinvolved = "Patient";
		break;
	case "07":
		$deptinvolved = "Staff";
		break;
	case "08":
		$deptinvolved = "Student";
		break;
	case "09":
		$deptinvolved = "Visitor";
		break;
	case "10":
		$deptinvolved = "Other";
		break;
	case "11":
		$deptinvolved = "Housing Maintenance Staff";
		break;
	case "12":
		$deptinvolved = "Child";
		break;
	default:
		$deptinvolved = "Other";
		break;
}

switch($cause)
{
	case "00":
		$cause = "Select cause...";
		break;
	case "01":
		$cause = "Arson";
		break;
	case "02":
		$cause = "Candles";
		break;
	case "03":
		$cause = "Chemicals";
		break;
	case "04":
		$cause = "Construction";
		break;
	case "05":
		$cause = "Cooking";
		break;
	case "06":
		$cause = "Dust";
		break;
	case "07":
		$cause = "Electrical";
		break;
	case "08":
		$cause = "Maintenance";
		break;
	case "09":
		$cause = "Microwave";
		break;
	case "10":
		$cause = "Smoking";
		break;
	case "11":
		$cause = "Steam";
		break;
	case "12":
		$cause = "Vandalism";
		break;
	case "13":
		$cause = "Other";
		break;
	case "14":
		$cause = "Mulch";
		break;
	case "15":
		$cause = "Gas Odor";
		break;
	case "16":
		$cause = "Weather";
		break;
	case "17":
		$cause = "Welding";
		break;
	case "18":
		$cause = "Horseplay";
		break;
	case "19":
		$cause = "Mechanical";
		break;
	default:
		$cause = "Other";
		break;
}

switch($incident)
{
	case "00":
		$incident = "Select area....";
		break;
	case "01":
		$incident = "Bathroom";
		break;
	case "02":
		$incident = "Classroom";
		break;
	case "03":
		$incident = "Corridor";
		break;
	case "04":
		$incident = "Dumpster";
		break;
	case "05":
		$incident = "Kitchen";
		break;
	case "06":
		$incident = "Laboratory";
		break;
	case "07":
		$incident = "Mechanical Room";
		break;
	case "08":
		$incident = "Mulch";
		break;
	case "09":
		$incident = "Patient Room";
		break;
	case "10":
		$incident = "Student Room";
		break;
	case "11":
		$incident = "Vehicle";
		break;
	case "12":
		$incident = "Other";
		break;
	case "18":
		$incident = "Stairwell";
		break;
	case "19":
		$incident = "Elevator";
		break;
	case "20":
		$incident = "Dining Room";
		break;
	default:
		$incident = "Other";
		break;
}
switch($recfrom)
{
	case "1":
		$recfrom = "911";
		break;
	case "2":
		$recfrom = "Delta";
		break;
	case "3":
		$recfrom = "Simplex";
		break;
	case "4":
		$recfrom = "Station 10";
		break;
	case "5":
		$recfrom = "Other";
		break;
	default:
		$recfrom = "911";
		break;
}

if ($occur == "1")
{
	$occur = "True";
}
else
{
	$occur = "False";
}
if ($injuries == "1")
{
	$injuries = "True";
}
else
{
	$injuries = "False";
}
if ($extinguisher == "1")
{
	$extinguisher = "True";
}
else
{
	$extinguisher = "False";
}
if ($occupied == "1")
{
	$occupied = "True";
}
else
{
	$occupied = "False";
}
if ($evacuated == "1")
{
	$evacuated = "True";
}
else
{
	$evacuated = "False";
}
if ($notified == "1")
{
	$notified = "True";
}
else
{
	$notified = "False";
}
if ($activated == "1")
{
	$activated = "True";
}
else
{
	$activated = "False";
}

if ($pull == "1")
{
	$pull = "True";
}
else
{
	$pull = "False";
}
if ($smoke == "1")
{
	$smoke = "True";
}
else
{
	$smoke = "False";
}
if ($sprinkler == "1")
{
	$sprinkler = "True";
}
else
{
	$sprinkler = "False";
}
if ($stove == "1")
{
	$stove = "True";
}
else
{
	$stove = "False";
}
if ($fatality == "1")
{
	$fatality = "True";
}
else
{
	$fatality = "False";
}
if ($propDamage == "1")
{
	$propDamage = "True";
}
else
{
	$propDamage = "False";
}

		$db_hostname 	= "GENSQLAGL\general";
		$db_connection 	= array("Database"=>"UKSpace", "UID"=>"EHSInfo_User", "PWD"=>"ehsinfo");
		
		//Connect to DB server.	
		$db_conn = sqlsrv_connect($db_hostname, $db_connection);
							
		//Convert bldg number to bldg name
		$query  = "SELECT BuildingCode, BuildingName FROM MasterBuildings WHERE BuildingCode = '$buildingname'";
		$result = sqlsrv_query($db_conn, $query);
		$line 	= sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);
		$buildingname = $line[0].", ".$line[1];
		
		//Convert room bar code to roomID.		
		$query = "SELECT DISTINCT 
										RoomBarCode,
										RoomID,
										UsageSubDescr,
										BuildingCode										
					FROM         		Rooms_Chematix
					WHERE     			(RoomBarCode = '$room')
					ORDER BY 			RoomID";
		
		$result = sqlsrv_query($db_conn, $query);
		$line 	= sqlsrv_fetch_array($result);
		$room 	= $line[1].", ".$line[2];
		
		//sqlsrv_close($db_conn);
		
//Setting up email function  UKPDFireAlarmResponse@ppd.uky.edu,
			$toaddress = "dvcask2@uky.edu, kjcoom0@email.uky.edu, jdel222@uky.edu, jwmonr1@email.uky.edu, richard.peddicord@ky.gov, ggwill2@email.uky.edu, seberr0@email.uky.edu, pjmerr0@email.uky.edu, tross@email.uky.edu, firereport@email.uky.edu, ppdUKPDFireAlarmResponse@email.uky.edu, trmatl2@uky.edu, ska248@uky.edu, lljayn0@uky.edu, jgba224@uky.edu";
			$subject = "Fire Alarm/False Alarm Report " .$todaysdate;
			$mailcontent = "Today's date: " .$todaysdate."\n\n"
							."Location\n"
							."----------\n"
							."Facility: ".$buildingname."\n"							
							."Room: ".$room."\n\n\n"							
							."First Alarm Received\n"
							."----------\n"
							."Date of alarm: ".$datercvd
							."                          Time alarm received: ".$timercvd."\n"
							."Received from: ".$recfrom
							."                    If other, explain: " .$other."\n\n"
							."Building occupied: " .$occupied."\n"
							."Building evacuated: " .$evacuated."\n"
							."Fire department notified: " .$notified."\n"
							."Fire alarm activated: " .$activated."\n"
							."Fire alarm devices activated:\n"
							."    Pull station: " .$pull
							."                       Sprinkler system: " .$sprinkler."\n"
							."    Smoke detector: " .$smoke
							."                 Stove suppression system: " .$stove."\n\n"
							."Time alarm silenced: " .$deactivated
							."               Time alarm reset: " .$reset."\n\n\n"
							."Incident\n"
							."----------\n"
							."Did a fire occur: " .$occur."\n"
							."Type: " .$type."\n"
							."Area of incident: " .$incident."\n"
							."If other area, explain: " .$incidentother."\n"
							."Cause of alarm: " .$cause."\n"
							."If other cause, explain: " .$causeother."\n"
							."Dept Involved: " .$deptinvolved."\n"
							."If other department, explain: " .$deptinvolvedother."\n\n"
							."Fire extinguisher used: " .$extinguisher."\n"
							."Injuries: " .$injuries."\n"
							."Fatality: " .$fatality."\n"
							."Property damage: " .$propDamage."\n"
							."Description of injuries: " .$description."\n\n"
							."Description of incident: " .$additional."\n\n\n"
							."Person Filing Report\n"
							."----------\n"
							."First Name: ".$fname."\n"
							."Last Name: ".$lname."\n"
							."Department: ".$department."\n"
							."Phone: ".$phone."\n";							
			$fromaddress = "ggwill2@uky.edu";
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