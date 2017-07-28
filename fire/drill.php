<?xml version="1.0" encoding="iso-8859-1"?>
<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK Fire Drill Report</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
a:link { text-decoration: underline }
a:visited { text-decoration: underline }
a:hover { text-decoration: none }
</style>
</head>
<body bgcolor="#CCCCCC" text="#000000">
<form action="drillsubmit.php" method="post" name="alarm" id="alarm">
  <table border="1" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF"><tr><td>
  <table width="620" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
    <tr>
            <td width="47" valign="bottom">&nbsp;</td>
      <td width="573">
 <table width="600" border="0" cellspacing="0" cellpadding="0">
  <tr>
                  <td> 
                    <div align="left"><img src="../media/image/fs_firedrill.gif" alt="UK Fire Drill Report" /></div>
                  </td>
  </tr>
</table><br />
    <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr><td colspan="4"></td></tr>
	  <tr> 
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b>Building</b></font></td>
      </tr>
      <tr> 
        <td> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr> 
                        <td width="17%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Building 
                          name</font></td>
                        <td width="27%"> 
                          <input type="text" name="buildingname" />
                        </td>
                        <td width="20%"> 
                          <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Building 
                            use </font></div>
                        </td>
                        <td width="36%">
                          <select name="type">
                            <option value="Administration">Administration</option>
                            <option value="Assembly">Assembly</option>
                            <option value="Classroom">Classroom</option>
                            <option value="Daycare">Day Care</option>
                            <option value="Dorm">Dorm</option>
                            <option value="Fraternity">Fraternity</option>
                            <option value="Gymnasium">Gymnasium</option>
                            <option value="Hospital">Hospital</option>
                            <option value="Lab">Laboratory</option>
                            <option value="Library">Library</option>
                            <option value="Maintenance Facility">Maintenance Facility</option>
                            <option value="Sorority">Sorority</option>
                            <option value="Other">Other</option>
                          </select>
                        </td>
                      </tr>
                      <tr> 
                        <td width="17%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Building 
                          num.</font></td>
                        <td width="27%"> 
                          <input type="text" name="bldgnum" />
                        </td>
                        <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">If 
                          other, explain</font></td>
                        <td width="36%">
                          <input type="text" name="otheruse" />
                        </td>
                      </tr>
                    </table>
        </td>
      </tr>
    </table>
              <div align="center"><br />
                <hr width="85%" align="center" />
                <br />
              </div>
              <table width="600" border="0" cellspacing="0" cellpadding="0">
     
      <tr> 
        <td> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr>
					  	<td colspan="4">
							
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="19%" valign="middle"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Date 
                                of fire drill</font></td>
                              <td width="81%" valign="middle"> 
                                <input type="text" name="date" />
                        </td>                        
                        </tr>
						</table>
						</td>
					  </tr>
                      
                      <tr> 
                        <td width="23%" valign="middle" align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Time 
                          alarm sounded</font></td>
                        <td width="25%" valign="middle" align="left"> 
                          <input type="text" name="timesounded" size="10" />
                          <select name="soundedap">
                            <option value="am">AM</option>
                            <option value="pm">PM</option>
                          </select>
                        </td>
                        <td width="21%" align="left" valign="middle"> 
                          <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Time 
                            alarm reset</font></div>
                        </td>
                        <td width="31%" align="left" valign="middle"> 
                          <div align="left"> 
                            <input type="text" name="reset" size="10" />
                            <select name="resetap">
                              <option value="am">AM</option>
                              <option value="pm">PM</option>
                            </select>
                          </div>
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
      <td width="573">
              <table width="600" border="0" cellspacing="0" cellpadding="2">
                <tr> 
                  <td width="205"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Building 
                    evacuated?</font></td>
                  <td width="379"> 
                    <input type="radio" name="evacuated" value="yes" />
                    yes 
                    <input type="radio" name="evacuated" value="no" />
                    no </td>
                </tr>
                <tr> 
                  <td width="205" valign="top"> 
                    <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">If 
                      no, explain</font></div>
                  </td>
                  <td width="379" valign="top"> 
                    <input type="text" size="40" name="evacexplain" />
                  </td>
                </tr>
				<tr> 
                        <td colspan="4">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td width="35%" valign="middle">
                                <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Time 
                                  for complete evacuation</font></div>
                              </td>
                              <td width="65%" valign="middle">                                <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
                            <input type="text" name="minutes" size="1" />
                                  Minutes
                                  <input type="text" name="seconds" size="1" />
Seconds</font></div>
                              </td>                        
                        </tr>
						</table>
                  </td>
                </tr>
                <tr> 
                  <td width="205"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Condition 
                    of alarm system</font></td>
                  <td width="379"> 
                    <input type="text" name="condition" size="40" />
                  </td>
                </tr>
                <tr> 
                  <td width="205" valign="top"> 
                    <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">General 
                      attitude or conduct of evacuees</font></div>
                  </td>
                  <td width="379" valign="top"> 
                    <input type="text" size="40" name="attitude" />
                  </td>
                </tr>
                
              </table>
    <br />
              <hr width="85%" align="center" />
              <br />
              <table width="600" border="0" cellspacing="0" cellpadding="0">
               
                <tr> 
                  <td colspan="2"> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td>
						<table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr> 
                              <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Condition 
                                of exits and doors (including fire escapes)</font></td>
      </tr>
      <tr> 
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2">
                                <textarea name="description" cols="50" rows="2"></textarea>
          </font></td>
      </tr>
    </table></td>
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
      <td width="573">
	  <table width="600" border="0" cellspacing="0" cellpadding="0">
      <tr> 
                  <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Comments 
                    and recommendations</font></td>
      </tr>
      <tr> 
        <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2">
                    <textarea name="additional" cols="50" rows="2"></textarea>
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
                    <table width="100%" border="0" cellspacing="0" cellpadding="2">
                      <tr> 
                        <td width="8%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Name</font></td>
                        <td width="39%"> 
                          <input type="text" name="name" size="30" />
                        </td>
						<td width="7%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Title</font></td>
						<td width="46%"> 
                          <input type="text" name="title" size="30" />
                        </td>
                      </tr>
                      <tr> 
                        <td width="8%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Phone</font></td>
                        <td width="39%"> 
                          <input type="text" name="phone" size="30" />
                        </td>
						<td width="7%"></td>
						<td width="46%"></td>
                      </tr>
                    </table>
          </td>
      </tr>
    </table>
	</td>
    </tr>
	<tr>
	        <td valign="top">&nbsp;</td>
	  <td valign="top">&nbsp; </td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td><table>
	<tr>
                  <td> 
                    <input type="submit" name="Submit" value="Submit" />
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
