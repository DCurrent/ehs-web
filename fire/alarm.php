<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<?php	

		$oAcc->access_verify();
		
		$fcode	=	NULL;
		
		if(isset($_GET['buildingname']))
		{
			$fcode = $_GET['buildingname']; //This line is added to take care if your global variable is off
			if(strlen($fcode) > 0 and !is_numeric($fcode))	//Verify data is numeric. No SQL injection for you!
			{
				echo "Data Error";
				exit;
			}		
		}
		
		$db_host		= "gensql\general";			//Database server name.
		$db_user		= "EHSInfo_User";			//Database user name.
		$db_pword		= "ehsinfo";				//Database user password.
		$db_dbase		= "UKSpace";				//Target database.
				
		$db_connect 	= array("Database"=>$db_dbase, "UID"=>$db_user, "PWD"=>$db_pword);
		
		//Connect to DB server.	
		$db_conn = sqlsrv_connect($db_host, $db_connect);	//Connect to DB server.
		
		if(!$db_conn )
		{     		
     		echo "Connection could not be established.<br />";
     		die( print_r( sqlsrv_errors(), true));
		}
		
		//Open database.
		//mssql_query("SET TEXTSIZE 2147483647"); //Set text size to max (no resource loss in doing this, and otherwise text is truncated at around 4000 chars).
					
		//Query for building drop list items.
		$query  = 	"SELECT DISTINCT	BuildingCode, 
										BuildingName,
										StreetAddress1 + ' ' + City + ' ' + State AS full_address										
					FROM         		MasterBuildings
					WHERE     			(BuildingName <> '')
					ORDER BY 			full_address, BuildingName";
								

		$result = sqlsrv_query($db_conn, $query);
		
		$facility_select 	= "<option value=-1 selected='selected'>Select Facility</option>";
		
		//Populate facility drop list variable.
		while($line = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC))
		{			
			if($line[0]==@$fcode)
			{
				//echo "<option selected value='$noticia2[cat_id]'>$noticia2[category]</option>"."<BR>";
				$facility_select = $facility_select . "<option selected='selected' value=$line[0]> $line[2] || $line[1]</option>";
			}
			else
			{
				//echo "<option value='$noticia2[cat_id]'>$noticia2[category]</option>";
				$facility_select = $facility_select . "<option value=$line[0]> $line[2] || $line[1]</option>";
			}			
		}		
	
		if(isset($fcode) and strlen($fcode) > 0)
		{
			$query = "SELECT DISTINCT 
										RoomBarCode,
										RoomID,
										UsageSubDescr,
										BuildingCode										
					FROM         		Rooms_Chematix
					WHERE     			(BuildingCode = '$fcode')
					ORDER BY 			RoomID";			
					
			$result = sqlsrv_query($db_conn, $query);
											
			$room_select = "<option value=-2> Outside Facility</option>";
			
			if(sqlsrv_num_rows($result) < 1)
			{
				$room_select = $room_select ."<option value=-3> Not Available</option>";
			}
			
			//Populate facility drop list variable.
			while($line = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC))
			{				
				$room_select = $room_select . "<option value=$line[0]> $line[1], $line[2]</option>";							
			}		
		}
		else
		{
			$room_select = "<option value=-1> Unavailable; Please select a facility.</option>";
		}
		
		//sqlsrv_close($db_conn);		
?>


<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK Fire Alarm Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
a:link { text-decoration: underline }
a:visited { text-decoration: underline }
a:hover { text-decoration: none }
</style>
<script language="JavaScript" type="text/javascript" src="required.js"></script>
<script language="JavaScript" type="text/javascript" src="limit.js"></script>
<script language="JavaScript" type="text/javascript" src="radio.js"></script>
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
<script language="JavaScript" type="text/javascript">
function reload(form){
var val=form.buildingname.options[form.buildingname.options.selectedIndex].value;
self.location='alarm.php?buildingname=' + val ;
}
</script>
</head>

<body bgcolor="#CCCCCC" text="#000000">
<form action="alarmsubmit.php" method="post" name="alarm" id="alarm" onSubmit="return ((checkRadios(this)) && (checkrequired(this)));">
  <table border="1" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF"><tr><td>
  <table width="620" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
    <tr>
            <td width="47" valign="bottom">&nbsp;</td>
      <td width="573">
 <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
                  <td> 
                    <div align="left">
                      <p><img src="firealarm.gif" alt="UK Fire Alarm/False Alarm Report" /></p>
                    </div>
                  </td>
  </tr>
</table>


<br />
    <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr><td colspan="4"></td></tr>
	  <tr> 
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b>Location</b></font></td>
      </tr>
      <tr> 
        <td> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="20%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Facility</font></td>
                        <td width="80%"> 
                          <select name="buildingname" onChange="reload(this.form)">
                          	<?php print $facility_select; ?>
                          </select>
                        </td>
                      </tr>
                      <tr> 
                        <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Room 
                          no.</font></td>
                        <td width="80%">                          
                          <select name="room">
                          	<?php print $room_select; ?>
                          </select>
                        </td>
                      </tr>
                    </table>
        </td>
      </tr>
    </table>
              <div align="center"><br />
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
                        <td width="9%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Date 
                          </font></td>    
                          
                        <td width="34%"> <select name="month" id="month">
                            
                            <?php
								
							  $i = 0;
							  
							  while ($i < 12)
							  {							  
							  	$i++;
							  
								if($i == date("n"))
								{
									echo '<option selected="selected"';
								}
								else
								{
									echo '<option';	
								}
								
								echo ' value = "'.$i.'">'.$i.'</option>';								
							  }
							  
							  ?>
                          </select>
                          <select name="day" id="day">
                            <?php

							  $i = 0;
							  
							  while ($i < 31)
							  {							  
							  	$i++;
							  
								if($i == date("d"))
								{
									echo '<option selected="selected"';
								}
								else
								{
									echo '<option';	
								}
								
								echo ' value = "'.$i.'">'.$i.'</option>';							
							  }
							  
							  ?>
                          </select>
                          <select name="year" id="year">
							<?php

							  $i = 0;
							  
							  while ($i < 2)
							  {							  
							  	$y = date("Y") - $i;
							  
								if($y == date("Y"))
								{
									echo '<option selected="selected"';
								}
								else
								{
									echo '<option';	
								}
								
								echo ' value = "'.$y.'">'.$y.'</option>';
								
								$i++;
							  }
							  
							  ?>                            
                          </select></td>
                        <td width="18%"> 
                          <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Time 
                            </font></div>
                        </td>
                        <td width="39%"> <select name="hour" id="hour">
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                          </select>
                          <select name="mins" id="mins">
						  	<option value="00">00</option>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                            <option value="32">32</option>
                            <option value="33">33</option>
                            <option value="34">34</option>
                            <option value="35">35</option>
                            <option value="36">36</option>
                            <option value="37">37</option>
                            <option value="38">38</option>
                            <option value="39">39</option>
                            <option value="40">40</option>
                            <option value="41">41</option>
                            <option value="42">42</option>
                            <option value="43">43</option>
                            <option value="44">44</option>
                            <option value="45">45</option>
                            <option value="46">46</option>
                            <option value="47">47</option>
                            <option value="48">48</option>
                            <option value="49">49</option>
                            <option value="50">50</option>
                            <option value="51">51</option>
                            <option value="52">52</option>
                            <option value="53">53</option>
                            <option value="54">54</option>
                            <option value="55">55</option>
                            <option value="56">56</option>
                            <option value="57">57</option>
                            <option value="58">58</option>
                            <option value="59">59</option>
                          </select> 
                          <select name="recap">
                            <option value="am">AM</option>
                            <option value="pm">PM</option>
                          </select>
                        </td>
                      </tr>
                      <tr> 
                        <td width="9%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">From 
                          </font></td>
                        <td width="34%"> 
                          <select name="recfrom">
                            <option value="1">911</option>
                            <option value="2">Delta</option>
                            <option value="3">Simplex</option>
                            <option value="4">Station 10 (MC/Hospital)</option>
                            <option value="5">Other</option>
                          </select>
                        </td>
                        <td width="18%"> 
                          <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">if 
                            other, explain</font></div>
                        </td>
                        <td width="39%"> 
                          <input type="text" name="other" />
                        </td>
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
                    <input name="occupied" type="radio" value="0" checked="checked" />
                    no </font></td>
                </tr>
                <tr> 
                  <td width="239"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Building 
                    evacuated?</font></td>
                  <td width="360"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                    <input type="radio" name="evacuated" value="1" />
                    yes 
                    <input name="evacuated" type="radio" value="0" checked="checked" />
                    no </font></td>
                </tr>
                <tr> 
                  <td width="239"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Fire 
                    department notified?</font></td>
                  <td width="360"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                    <input type="radio" name="notified" value="1" />
                    yes 
                    <input name="notified" type="radio" value="0" checked="checked" />
                    no </font></td>
                </tr>
                <tr> 
                  <td width="239"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Fire 
                    alarm activated?</font></td>
                  <td width="360"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                    <input type="radio" name="activated" value="1" />
                    yes 
                    <input name="activated" type="radio" value="0" checked="checked" />
                    no </font></td>
                </tr>
                <tr> 
                  <td colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Fire 
                          alarm device(s) activated:</font></td>
                      </tr>
                      <tr> 
                        <td> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr> 
                              <td width="23%" height="17"> <div align="right"> 
                                  <input type="checkbox" name="pull" value="1" />
                                </div></td>
                              <td width="26%" height="17"> <font face="Verdana, Arial, Helvetica, sans-serif" size="2">Pull 
                                station</font> </td>
                              <td width="19%" height="17"> <div align="right"> 
                                  <input type="checkbox" name="sprinkler" value="1" />
                                </div></td>
                              <td width="32%" height="17"> <font face="Verdana, Arial, Helvetica, sans-serif" size="2">Sprinkler 
                                system</font> </td>
                            </tr>
                            <tr> 
                              <td width="23%"> <div align="right"> 
                                  <input type="checkbox" name="smoke" value="1" />
                                </div></td>
                              <td width="26%"> <font face="Verdana, Arial, Helvetica, sans-serif" size="2">Smoke 
                                detector</font> </td>
                              <td width="19%"> <div align="right"> 
                                  <input type="checkbox" name="stove" value="1" />
                                </div></td>
                              <td width="32%"> <font face="Verdana, Arial, Helvetica, sans-serif" size="2">Stove 
                                suppression system</font> </td>
                            </tr>
                            <tr> 
                              <td width="23%"> <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Time 
                                  alarm silenced</font></div></td>
                              <td width="26%"> <select name="silencedhour" id="silencedhour">
                                  <option value="01">01</option>
                                  <option value="02">02</option>
                                  <option value="03">03</option>
                                  <option value="04">04</option>
                                  <option value="05">05</option>
                                  <option value="06">06</option>
                                  <option value="07">07</option>
                                  <option value="08">08</option>
                                  <option value="09">09</option>
                                  <option value="10">10</option>
                                  <option value="11">11</option>
                                  <option value="12">12</option>
                                </select> <select name="silencedmins" id="silencedmins">
                                  <option value="00">00</option>
                                  <option value="01">01</option>
                                  <option value="02">02</option>
                                  <option value="03">03</option>
                                  <option value="04">04</option>
                                  <option value="05">05</option>
                                  <option value="06">06</option>
                                  <option value="07">07</option>
                                  <option value="08">08</option>
                                  <option value="09">09</option>
                                  <option value="10">10</option>
                                  <option value="11">11</option>
                                  <option value="12">12</option>
                                  <option value="13">13</option>
                                  <option value="14">14</option>
                                  <option value="15">15</option>
                                  <option value="16">16</option>
                                  <option value="17">17</option>
                                  <option value="18">18</option>
                                  <option value="19">19</option>
                                  <option value="20">20</option>
                                  <option value="21">21</option>
                                  <option value="22">22</option>
                                  <option value="23">23</option>
                                  <option value="24">24</option>
                                  <option value="25">25</option>
                                  <option value="26">26</option>
                                  <option value="27">27</option>
                                  <option value="28">28</option>
                                  <option value="29">29</option>
                                  <option value="30">30</option>
                                  <option value="31">31</option>
                                  <option value="32">32</option>
                                  <option value="33">33</option>
                                  <option value="34">34</option>
                                  <option value="35">35</option>
                                  <option value="36">36</option>
                                  <option value="37">37</option>
                                  <option value="38">38</option>
                                  <option value="39">39</option>
                                  <option value="40">40</option>
                                  <option value="41">41</option>
                                  <option value="42">42</option>
                                  <option value="43">43</option>
                                  <option value="44">44</option>
                                  <option value="45">45</option>
                                  <option value="46">46</option>
                                  <option value="47">47</option>
                                  <option value="48">48</option>
                                  <option value="49">49</option>
                                  <option value="50">50</option>
                                  <option value="51">51</option>
                                  <option value="52">52</option>
                                  <option value="53">53</option>
                                  <option value="54">54</option>
                                  <option value="55">55</option>
                                  <option value="56">56</option>
                                  <option value="57">57</option>
                                  <option value="58">58</option>
                                  <option value="59">59</option>
                                </select> <select name="silencedap">
                                  <option value="am">AM</option>
                                  <option value="pm">PM</option>
                                </select> </td>
                              <td width="19%"> <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Time 
                                  alarm reset</font></div></td>
                              <td width="32%"> <div align="left"> 
                                  <select name="resethour" id="resethour">
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                  </select>
                                  <select name="resetmins" id="resetmins">
                                    <option value="00">00</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                    <option value="32">32</option>
                                    <option value="33">33</option>
                                    <option value="34">34</option>
                                    <option value="35">35</option>
                                    <option value="36">36</option>
                                    <option value="37">37</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                    <option value="43">43</option>
                                    <option value="44">44</option>
                                    <option value="45">45</option>
                                    <option value="46">46</option>
                                    <option value="47">47</option>
                                    <option value="48">48</option>
                                    <option value="49">49</option>
                                    <option value="50">50</option>
                                    <option value="51">51</option>
                                    <option value="52">52</option>
                                    <option value="53">53</option>
                                    <option value="54">54</option>
                                    <option value="55">55</option>
                                    <option value="56">56</option>
                                    <option value="57">57</option>
                                    <option value="58">58</option>
                                    <option value="59">59</option>
                                  </select>
                                  <select name="resetap">
                                    <option value="am">AM</option>
                                    <option value="pm">PM</option>
                                  </select>
                                </div></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                  <td width="1">&nbsp;</td>
                </tr>
              </table>
    <br />
              <hr width="85%" align="center" />
              <table width="600" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td>&nbsp;</td>
                </tr>
                <tr> 
                  <td width="156" colspan="2"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b>Incident</b></font></td>
                </tr>
                <tr> 
                  <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="156"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Did 
                          a fire occur?</font></td>
                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                          <input name="occur" type="radio" onClick="disable([2,3]);" value="1" />
                          yes 
                          <input name="occur" type="radio" value="0" onClick="disable([1]);" />
                          no</font></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="156"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Type 
                          of alarm</font></td>
                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                          <input name="type" type="radio" value="1" />
                          True 
                          <input name="type" type="radio" value="2" />
                          Nuisance 
                          <input type="radio" name="type" value="3" />
                          Malicious False 
                          <input type="radio" name="type" value="5" />
                          Threat of fire</font></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="26%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Area 
                          of incident</font></td>
                        <td width="28%"> <select name="incident">
                            <option value="00">Select area......</option>
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
                          </select> </td>
                        <td width="19%"> <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">if 
                            other, explain</font></div></td>
                        <td width="27%"> <input type="text" name="incidentother" size="20" /> 
                        </td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td width="26%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Cause 
                          of fire alarm</font></td>
                        <td width="28%"> <div align="left"> 
                            <select name="cause">
                              <option value="00">Select cause.....</option>
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
                        <td width="19%"> <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">if 
                            other, explain</font></div></td>
                        <td width="27%"> <input type="text" name="causeother" size="20" /> 
                        </td>
                      </tr>
                      <tr> 
                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Responsible 
                          Party </font></td>
                        <td> <select name="deptinvolved" id="deptinvolved">
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
                        <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">if 
                          other, explain</font></td>
                        <td> <input name="deptinvolvedother" type="text" id="deptinvolvedother" size="20" /></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td width="156"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Fire 
                    extinguisher used?</font></td>
                  <td width="444"> <font size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
                    <input type="radio" name="extinguisher" value="1" />
                    yes 
                    <input name="extinguisher" type="radio" value="0" checked="checked" />
                    no </font></td>
                </tr>
                <tr> 
                  <td colspan="2"> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="50%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Injuries? 
                          <input type="radio" name="injuries" value="1" />
                          yes 
                          <input name="injuries" type="radio" value="0" checked="checked" />
                          no </font></td>
                        <td width="50%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Fatality?</font> 
                          <font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
                          <input type="radio" name="fatality" value="1" />
                          yes 
                          <input name="fatality" type="radio" value="0" checked="checked" />
                          no </font></td>
                      </tr>
                    </table></td>
                </tr>
                <tr> 
                  <td colspan="2"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2">If 
                          yes, please describe</font></td>
                      </tr>
                      <tr> 
                        <td> <textarea name="injdescription" cols="50" rows="0"></textarea> 
                        </td>
                      </tr>
                    </table></td>
                </tr>
              </table>
    </td>
    </tr>
    <tr>
            <td width="47" valign="top">&nbsp;</td>
      <td width="573">&nbsp;</td>
    </tr>
	<tr>
            <td width="47" valign="top">&nbsp;</td>      <td width="573"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="50%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Property 
                    Damage 
                    <input type="radio" name="propDamage" value="1" />
                    yes 
                    <input type="radio" name="propDamage" value="0" />
                    no</font></td>
                  <td width="50%">&nbsp;</td>
                </tr>
              </table></td>
    </tr>
	<tr>
            <td width="47" valign="top">&nbsp;</td>
      <td width="573">&nbsp;</td>
    </tr>
    <tr>
            <td width="47" valign="bottom">&nbsp;</td>
      <td width="573"><table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr> 
                  <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Description 
                    of incident</font></td>
      </tr>
      <tr> 
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2">
          <textarea name="requireddescription" cols="50" rows="0" maxlength="250"></textarea>
          </font></td>
      </tr>
    </table>
    <br />
              <hr width="85%" align="center" />
              <br />
    <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr> 
                  <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b>Person 
                    filing report</b></font></td>
      </tr>
      <tr> 
        <td> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
                  <td width="16%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">First
                      Name</font></td>
                  <td width="84%"> 
                <input type="text" disabled="disabled" name="fname" size="30" value="<?php echo $_SESSION['access_name_f']; ?>"/>
              </td>
            </tr>
			<tr>
                        <td width="16%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Last
                            Name</font></td>
                        <td width="84%"> 
                <input type="text" disabled="disabled" name="lname" size="30" value="<?php echo $_SESSION['access_name_l']; ?>"/>
              </td>
            </tr>
          </table>
          </td>
      </tr>
    </table>
	</td>
    </tr>
	<tr>
	        <td valign="top">&nbsp;</td>
	  <td valign="top"> 
	  </td>
	</tr>
	<tr>
	        <td valign="top">&nbsp;</td>
	        <td valign="top"> <input type="checkbox" name="checkbox" value="checkbox" onClick="javascript:document.alarm.Submit.disabled=false" />
              <font size="2" face="Verdana, Arial, Helvetica, sans-serif">Click here if 
              you are ready to submit the form. </font></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td><table>
	<tr><td>
    <input type="submit" name="Submit" value="Submit" disabled />
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