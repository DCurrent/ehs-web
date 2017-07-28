<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK Fire Alarm Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
a:link { text-decoration: underline }
a:visited { text-decoration: underline }
a:hover { text-decoration: none }
.style2 {color: #000000}
.style5 {font-size: 10px}
.style6 {font-size: 9px}
.style8 {
	font-size: 24px;
	font-family: "vDefault Font";
}
</style>
<script language="JavaScript" type="text/javascript" src="../libraries/javascript/fs_required.js"></script>
<script language="JavaScript" type="text/javascript" src="limit.js"></script>
<script language="JavaScript" type="text/javascript" src="../libraries/radio.js"></script>
<script language="JavaScript" type="text/javascript">
function disable( aValues )
{    var aRB = document.forms["alarm"]["type"];

    for( i=0; i< aRB.length; i++ )
    {    for (bFound = false, j=0; !bFound && j< aValues.length; j++)
            bFound = aRB[i].value == aValues[j].toString();
        if(bFound) aRB[i].checked = false;    
        aRB[i].disabled = bFound;    
    }
}
</script>
</head>

<body bgcolor="#CCCCCC" text="#000000">
<form action="alarm_rpt_display.php" method="post" name="alarm" id="alarm">
  <table border="1" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF"><tr><td>
  <table width="620" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
    <tr>
            <td width="47" valign="bottom">&nbsp;</td>
      <td width="573">
 <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
                  <td> 
                    <div align="left"><img src="../media/image/fs_firealarm.gif" alt="UK Fire Alarm/False Alarm Report" /></div>
                  </td>
  </tr>
</table>

<?php
	//Open database.
	$db_conn = mssql_connect("128.163.184.42","EHSInfo_User","ehsinfo") or die( "ERROR: Connection to database failed, please contact the webmaster immediately in order to record your results. 257-3241" ); 			
	
	mssql_select_db("ehsinfo", $db_conn) or die( "ERROR: Selecting database failed,<br>please contact the <a href=\"mailto:dvcask20@email.uky.edu\">webmaster</a> immediately. 257-3241" );			
	mssql_query("SET TEXTSIZE 2147483647");	//Set text size to max (no resource loss in doing this, and otherwise text is truncated at around 4000 chars).
	
	//date droplist.
	$query = "SELECT DISTINCT date_rcvd
				FROM        tbl_fire_alarm
				WHERE     	(date_rcvd <> '')
				ORDER BY 	date_rcvd";
	  
	$result 			= mssql_query($query);
	$date_select; 
	
	while($line = mssql_fetch_row($result)){
		$date_select 		= $date_select . "<option value='".$line[0]."'>".$line[0]. "</option>";
		$date_end_default 	= $line[0];
	}	
	
	//Room drop list.
	$query = "SELECT DISTINCT 	room_no
			  FROM				tbl_fire_alarm
			  WHERE				room_no <> ''
			  ORDER BY			room_no";
	  
	$result 			= mssql_query($query);
	$room_select		= "<option value=-1 selected='selected'>All</option>"; //Room number.
	
	while($line = mssql_fetch_row($result)){
		$room_select = $room_select . "<option value=$line[0]> $line[0]</option>";
	}
	
	//Building drop list items.
	$query  = "SELECT DISTINCT 	tbl_list_building.building_id, 
								tbl_list_building.building_desc
			   FROM         	tbl_list_building 
			   INNER JOIN       tbl_fire_alarm 
			   ON 				tbl_list_building.building_id = tbl_fire_alarm.building_id
			   ORDER BY 		tbl_list_building.building_desc";
		
	$result 			= mssql_query($query);
	$facility_select 	= "<option value=-1 selected='selected'>All</option>"; //Facility dropdown.
	
	//Populate building drop list variable.
	while($line = mssql_fetch_row($result)){
		$facility_select = $facility_select . "<option value=$line[0]> $line[1]</option>";
	}
	
	//Time silenced.
	$query = "SELECT DISTINCT time_silenced
				FROM        tbl_fire_alarm
				WHERE     	(time_silenced <> '')
				ORDER BY 	time_silenced";
	  
	$result 			= mssql_query($query);
	$time_silenced; 
	
	while($line = mssql_fetch_row($result)){
		$time_silenced_select 		= $time_silenced_select. "<option value='".$line[0]."'>".$line[0]. "</option>";
		$time_silenced_end_default 	= $line[0];
	}
	
	//Time reset.
	$query = "SELECT DISTINCT time_reset
				FROM        tbl_fire_alarm
				WHERE     	(time_reset <> '')
				ORDER BY 	time_reset";
	  
	$result 			= mssql_query($query);
	$time_reset; 
	
	while($line = mssql_fetch_row($result)){
		$time_reset_select 		= $time_reset_select . "<option value='".$line[0]."'>".$line[0]. "</option>";
		$time_reset_end_default = $line[0];
	}
	
	//Filer drop list items.
	$query  = "SELECT     
				MAX			(filer_id) AS filer_id, 
				MAX			(filer_fname + ' ' + filer_lname + ', ' + filer_phone + ', ' + dept_other) AS filer
				FROM    	tbl_fire_alarm_filer
				WHERE     	(filer_lname <> '')
				GROUP BY	filer_lname, filer_fname";
		
	$result 			= mssql_query($query);
	$filer_select 	= "<option value='-1' selected='selected'>All</option>"; //Facility dropdown.
	
	//Populate filer drop list variable.
	while($line = mssql_fetch_row($result)){
		$filer_select = $filer_select . "<option value=".$line[0]."'>".$line[1]."</option>";
	}
						
?>

 <br />
    <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr><td colspan="4"></td></tr>
	  <tr> 
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b>Building</b></font></td>
      </tr>
      <tr> 
        <td> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="24%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Building</font></td>
                        <td width="76%">						
							<select name="building" id="building"><?php print $facility_select; ?>
						  </select>						</td>
                      </tr>
                      <tr> 
                        <td width="24%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Room 
                          no.</font></td>
                        <td width="76%"><select name="room" id="room">
                          <?php print $room_select; ?>
                        </select> 
                        </td>
                      </tr>
                      <tr>
                        <td><div align="left" class="style8"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Residential</font></div></td>
                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                          <input type="radio" name="residential" value="1" />
                          Yes 
                          <input name="residential" type="radio" value="0" />
no
<input name="residential" type="radio" value="-1" checked="checked" />
<span class="style2">All</span></font></td>
                      </tr>
                    </table>
        </td>
      </tr>
    </table>
              <div align="center">
                <hr width="85%" align="center" />
              </div>
              <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr> 
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b>First 
          Alarm Received</b></font></td>
      </tr>
      <tr> 
        <td> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="31%"><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Date/Time<br />
                        </font><font face="Verdana, Arial, Helvetica, sans-serif"><span class="style6">(mm/dd/yyyy 00:00)</span></font><font face="Verdana, Arial, Helvetica, sans-serif" size="2">                          <br />
                          </font><font face="Verdana, Arial, Helvetica, sans-serif">  </font> </div></td>
                        <td width="4%"> <p class="style5">Start:
                            </p>
                        <p class="style5">End:</p></td>
                        <td width="52%"><p align="center">
                          <select name="date_start" id="date_start">
                            <?php echo $date_select; ?>
                          </select>
                          <span class="style5"><br />
                          </span>
                          
                          <select name="date_end" id="date_end">
						  	
                            <?php 
							echo $date_select;
							echo "<option value='".$date_end_default."' selected='selected'>".$date_end_default."</option>"; 
							?>
                          </select>
                        </p>
                        </td>
                        <td width="13%" valign="middle"><p>&nbsp;</p>
                          <p>&nbsp;                          </p></td>
                      </tr>
                      <tr> 
                        <td width="31%"><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">From 
                          </font></div></td>
                        <td colspan="2"> 
                          <div align="left">
                              <select name="recfrom">
                                <option value="-1" selected="selected">All</option>
                                <option value="1">911</option>
                                <option value="2">Delta</option>
                                <option value="3">Simplex</option>
                                <option value="4">Station 10 (MC/Hospital)</option>
                                <option value="5">Other</option>
                              </select>
                            </div></td>
                        <td>&nbsp;</td>
                      </tr>
                    </table>
        </td>
      </tr>
    </table>
    </td>
    </tr>
    <tr>
            <td width="47" valign="top">&nbsp;</td>
      <td width="573">&nbsp;</td>
    </tr>
    <tr>
            <td width="47" valign="bottom">&nbsp;</td>
      <td width="573"><table width="600" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="239"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Building 
                    occupied?</font></td>
                  <td width="360"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                    <input type="radio" name="occupied" value="1" />
                    yes 
                    <input name="occupied" type="radio" value="0" />
                    no 
                    <input name="occupied" type="radio" value="-1" checked="checked" />
                    <span class="style2">All</span></font></td>
                </tr>
                <tr> 
                  <td width="239"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Building 
                    evacuated?</font></td>
                  <td width="360"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                    <input type="radio" name="evacuated" value="1" />
                    yes 
                    <input name="evacuated" type="radio" value="0" />
                    no 
                    <input name="evacuated" type="radio" value="-1" checked="checked" /> 
                    All</font></td>
                </tr>
                <tr> 
                  <td width="239"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Fire 
                    department notified?</font></td>
                  <td width="360"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                    <input type="radio" name="notified" value="1" />
                    yes 
                    <input name="notified" type="radio" value="0" />
                    no 
                    <input name="notified" type="radio" value="-1" checked="checked" />
                    All</font></td>
                </tr>
                <tr> 
                  <td width="239"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Fire 
                    alarm activated?</font></td>
                  <td width="360"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                    <input type="radio" name="activated" value="1" />
                    yes 
                    <input name="activated" type="radio" value="0" />
                    no 
                    <input name="activated" type="radio" value="-1" checked="checked" />
                    All</font></td>
                </tr>
                <tr> 
                  <td colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td><hr width="85%" align="center" /></td>
                      </tr>
                      <tr> 
                        <td><strong><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Fire 
                          alarm device(s) activated:</font></strong></td>
                      </tr>
                      <tr> 
                        <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td height="17"><div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Pull station</font> </div></td>
                              <td height="17" colspan="5"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <input type="radio" name="pull" value="1" />
  yes
  <input name="pull" type="radio" value="0" />
  no
  <input name="pull" type="radio" value="-1" checked="checked" />
  <span class="style2">All</span></font> </td>
                            </tr>
                            <tr>
                              <td height="17"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Sprinkler system</font></td>
                              <td height="17" colspan="5"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <input type="radio" name="sprinkler" value="1" />
    yes
    <input name="sprinkler" type="radio" value="0" />
    no
    <input name="sprinkler" type="radio" value="-1" checked="checked" />
    <span class="style2">All</span></font>
                                  <div align="left"> </div></td>
                            </tr>
                            <tr>
                              <td height="17"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Smoke detector</font> </td>
                              <td height="17" colspan="5"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <input type="radio" name="smoke" value="1" />
yes
<input name="smoke" type="radio" value="0" />
no
<input name="smoke" type="radio" value="-1" checked="checked" />
<span class="style2">All</span></font> </td>
                            </tr>
                            <tr> 
                              <td width="15%">  
                                <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Stove suppression system</font> </div></td>
                              <td colspan="5"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                                <input type="radio" name="stove" value="1" />
yes
<input name="stove" type="radio" value="0" />
no
<input name="stove" type="radio" value="-1" checked="checked" />
<span class="style2">All</span></font>
                                <div align="left"></div></td>
                            </tr>
                            <tr bgcolor="#FFCC00"> 
                              <td width="15%"> <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Time 
                                  alarm silenced</font></div></td>
                              <td width="4%"><p class="style5">Start: </p>
                              <p class="style5">End:</p></td>
                              <td width="30%"> <p>
                                <select name="silenced_start" id="silenced_start">                                    
                            	<?php echo $time_silenced_select; ?>
                                </select>
                              </p>
                                <p>
                                  <select name="silenced_end" id="silenced_end">                                    
                            	<?php 
								echo $time_silenced_select; 								
								echo "<option value='".$time_silenced_end_default."' selected='selected'>".$time_silenced_end_default."</option>";
								?>
                                </select>                            
                                  </p></td>
                              <td width="13%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Time alarm reset</font></td>
                              <td width="4%"> <div align="left">
                                <p class="style5">Start: </p>
                                <p class="style5">End:</p>
                              </div></td>
                              <td width="34%"> <div align="left"> 
                                  <p>
                                    <select name="reset_start" id="reset_start">                                    
                            	<?php echo $time_reset_select; ?>
                                </select>
                              </p>
                                <p>
                                  <select name="reset_end" id="reset_end">                                    
                            	<?php 
								echo $time_reset_select; 
								echo "<option value='".$time_reset_end_default."' selected='selected'>".$time_reset_end_default."</option>";
								?>
                                </select>
								</p>
                              </div></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                  <td width="1">&nbsp;</td>
                </tr>
              </table>
                  <hr width="85%" align="center" />
              <table width="600" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b>Incident</b></font></td>
                </tr>
                <tr>
                  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="156"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Did a fire occur?</font></td>
                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                          <input name="occur" type="radio" onclick="disable([2,3]);" value="1" />
            yes
            <input name="occur" type="radio" value="0" onclick="disable([1]);" />
            no
            <input name="occur" type="radio" onclick="disable([1]);" value="-1" checked="checked" />
            All </font></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="156"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Type of alarm</font></td>
                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                          <input name="type" type="radio" value="1" />
            True
            <input name="type" type="radio" value="2" />
            Nuisance
            <input type="radio" name="type" value="3" />
            Malicious False <br />
            <input type="radio" name="type" value="5" />
            Threat of fire
            <input name="type" type="radio" value="-1" checked="checked" />
            All </font></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="27%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Area of incident</font></td>
                        <td width="73%"><select name="incident">
                            <option value="-1" selected="selected">All</option>
                            <option value="01">Bathroom</option>
                            <option value="02">Classroom</option>
                            <option value="03">Corridor</option>
                            <option value="13">Dining Room/Area</option>
                            <option value="04">Dumpster</option>
                            <option value="19">Elevator</option>
                            <option value="15">Exterior</option>
                            <option value="16">HVAC</option>
                            <option value="05">Kitchen</option>
                            <option value="06">Laboratory</option>
                            <option value="14">Lounge</option>
                            <option value="07">Mechanical Room</option>
                            <option value="13">Office</option>
                            <option value="09">Patient Room</option>
                            <option value="18">Stairwell</option>
                            <option value="17">Storage Room</option>
                            <option value="10">Student Room</option>
                            <option value="11">Vehicle</option>
                            <option value="12">Other</option>
                          </select>
                        </td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="27%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Cause of fire alarm</font></td>
                        <td width="73%"><div align="left">
                            <select name="cause">
                              <option value="-1" selected="selected">All</option>
                              <option value="01">Arson</option>
                              <option value="02">Candles</option>
                              <option value="03">Chemicals</option>
                              <option value="05">Cooking</option>
                              <option value="06">Dust</option>
                              <option value="07">Electrical</option>
                              <option value="15">Gas Odor</option>
                              <option value="18">Horseplay</option>
                              <option value="08">Maintenance</option>
                              <option value="19">Mechanical</option>
                              <option value="09">Microwave</option>
                              <option value="14">Mulch</option>
                              <option value="10">Smoking</option>
                              <option value="11">Steam</option>
                              <option value="12">Vandalism</option>
                              <option value="16">Weather</option>
                              <option value="17">Welding</option>
                              <option value="13">Other</option>
                            </select>
                        </div></td>
                      </tr>
                      <tr>
                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Responsible Party </font></td>
                        <td><select name="deptinvolved" id="deptinvolved">
                            <option value="-1" selected="selected">All</option>
                            <option value="00">Select department...</option>
                            <option value="01">Campus PPD</option>
                            <option value="04">Child</option>
                            <option value="02">Contractor</option>
                            <option value="03">Faculty</option>
                            <option value="04">Housing</option>
                            <option value="04">Housing Maintenance Staff</option>
                            <option value="05">Med. Ctr. PPD</option>
                            <option value="06">Patient</option>
                            <option value="07">Staff</option>
                            <option value="08">Student</option>
                            <option value="09">Visitor</option>
                            <option value="10">Other</option>
                        </select></td>
                      </tr>
                  </table></td>
                </tr>
                <tr>
                  <td width="155"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Fire extinguisher used?</font></td>
                  <td width="418"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                    <input type="radio" name="extinguisher" value="1" />
      yes
      <input name="extinguisher" type="radio" value="0" />
      no
      <input name="extinguisher" type="radio" value="-1" checked="checked" />
      All </font></td>
                </tr>
                <tr>
                  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="50%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Injuries?
                              <input type="radio" name="injuries" value="1" />
            yes
            <input name="injuries" type="radio" value="0" />
            no
            <input name="injuries" type="radio" value="-1" checked="checked" />
            All </font></td>
                        <td width="50%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Fatality?</font> <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
                          <input type="radio" name="fatality" value="1" />
            yes
            <input name="fatality" type="radio" value="0" />
            no
            <input name="fatality" type="radio" value="-1" checked="checked" />
            All </font></td>
                      </tr>
                  </table></td>
                </tr>
              </table></td>
    </tr>
	<tr>
            <td width="47" valign="top">&nbsp;</td>      <td width="573"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="50%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Property 
                    Damage? 
                      <input type="radio" name="propDamage" value="1" />
                    yes 
                    <input type="radio" name="propDamage" value="0" />
                    no
                    <input name="propDamage" type="radio" value="-1" checked="checked" />
                    All
                  </font></td>
                  <td width="50%">&nbsp;</td>
                </tr>
              </table></td>
    </tr>
    <tr>
            <td width="47" valign="bottom">&nbsp;</td>
      <td width="573"><hr width="85%" align="center" />
    <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr> 
                  <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b>Person 
                    filing report</b></font></td>
      </tr>
      <tr> 
        <td> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr bgcolor="#FFCC00"> 
                  <td width="16%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Filer</font></td>
                  <td width="84%"><select name="filer" id="filer">
                    <?php echo $filer_select; ?>
                  </select> 
              </td>
            </tr>
          </table>
          </td>
      </tr>
    </table>
	</td>
    </tr>
	<tr>
	<td>&nbsp;</td>
	<td><table>
	<tr><td>
    <input type="submit" name="Submit" value="Submit"/>
    <input type="reset" name="Reset" value="Reset" />
	</td>
	</tr>
	</table>
	</td>
	</tr>
  </table>
  </td></tr></table>
</form>
<table  border="0" cellspacing="0" cellpadding="0" align="center" width="147">
  <tr>
    <td width="93"> 
      <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><a href="index.php">Fire 
        Marshal</a></font></div>
    </td>
    <td width="54"> 
      <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><a href="../">EHS</a></font></div>
    </td>
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