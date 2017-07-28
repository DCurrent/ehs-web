<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
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
<form action="" method="post" name="alarm" id="alarm">
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
              </table>
              <br />
              <b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Print 
              for your records<br />
              <br />
              </font></b> 
              <table width="600" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="4"></td>
                </tr>
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
                          <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["buildingname"];
								echo "</b></font>";
								?>
                        </td>
                        <td width="20%"> 
                          <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Building 
                            use </font></div>
                        </td>
                        <td width="36%"> 
                          <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["type"];
								echo "</b></font>";
								?>
                        </td>
                      </tr>
                      <tr> 
                        <td width="17%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Building 
                          num.</font></td>
                        <td width="27%"> 
                          <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["bldgnum"];
								echo "</b></font>";
								?>
                        </td>
                        <td width="20%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">If 
                          other, explain</font></td>
                        <td width="36%"> 
                          <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["otheruse"];
								echo "</b></font>";
								?>
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
                              <td width="20%" valign="middle"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Date 
                                of fire drill</font></td>
                              <td width="80%" valign="middle"> 
                                <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["date"];
								echo "</b></font>";
								?>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      
                      <tr> 
                        <td width="26%" valign="middle" align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Time 
                          alarm sounded</font></td>
                        <td width="20%" valign="middle" align="left"> 
                          <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["timesounded"];
								echo $_POST["soundedap"];
								echo "</b></font>";
								?>
                        </td>
                        <td width="29%" align="left" valign="middle"> 
                          <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Time 
                            alarm reset</font></div>
                        </td>
                        <td width="25%" align="left" valign="middle"> 
                          <div align="left"> 
                            <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["reset"];
								echo $_POST["resetap"];
								echo "</b></font>";
								?>
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
                    <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["evacuated"];
								echo "</b></font>";
								?>
                  </td>
                </tr>
                <tr> 
                  <td width="205" valign="top"> 
                    <div align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">If 
                      no, explain</font></div>
                  </td>
                  <td width="379" valign="top"> 
                    <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["evacexplain"];
								echo "</b></font>";
								?>
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
                                  <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["minutes"];
								echo "</b></font>";
								?>
Minutes
<?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["seconds"];
								echo "</b></font>";
								?>
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
                    <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["condition"];
								echo "</b></font>";
								?>
                  </td>
                </tr>
                <tr> 
                  <td width="205" valign="top"> 
                    <div align="left"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">General 
                      attitude or conduct of evacuees</font></div>
                  </td>
                  <td width="379" valign="top"> 
                    <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["attitude"];
								echo "</b></font>";
								?>
                  </td>
                </tr>
              </table>
              <br />
              <hr width="85%" align="center" />
              <br />
              <table width="600" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td colspan="2"> </td>
                </tr>
                <tr> 
                  <td colspan="2"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Condition 
                    of exits and doors (including fire escapes)</font></td>
                </tr>
                <tr> 
                  <td colspan="2"> 
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr> 
                        <td> 
                          <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["description"];
								echo "</b></font>";
								?>
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
              <table width="600" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Comments 
                    and recommendations</font></td>
                </tr>
                <tr> 
                  <td><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
                    <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["additional"];
								echo "</b></font>";
								?>
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
                        <td width="18%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Name 
                          and title</font></td>
                        <td width="82%"> 
                          <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["name"];
								echo " ".$_POST["title"];
								echo "</b></font>";
								?>
                        </td>
                      </tr>
                      <tr> 
                        <td width="18%"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Phone</font></td>
                        <td width="82%"> 
                          <?php
								echo "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b>";
								echo $_POST["phone"];
								echo "</b></font>";
								?>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
  </td></tr></table>
</form>
<?php
$todaysdate = date("jS F Y g:ia");

//Setting up email function
				$toaddress = "jdel222@uky.edu";
			$subject = "Fire Drill Report " .$todaysdate;
			$mailcontent = "Today's date: " .$todaysdate."\n\n"
							."Building name: ".$_POST["buildingname"]
							."Building use: ".$_POST["type"]."\n"
							."Building Num: ".$_POST["bdlgnum"]."\n"
							."If other: ".$_POST["otheruse"]."\n\n\n"							
							."Date of fire drill: ".$_POST["date"]
							."Time alarm sounded: ".$_POST["timesounded"] .$_POST["soundedap"]."\n"
							."Time alarm reset: ".$_POST["reset"] .$_POST["resetap"]."\n"
							."Building evacuated: " .$_POST["evacuated"]."\n"
							."If no, explain: " .$_POST["evacexplain"]."\n"
							."Time for complete evacuation: ".$_POST["minutes"]." minutes and ".$_POST["seconds"]."seconds\n"
							."Condition of alarm system: " .$_POST["condition"]."\n"
							."General attitude or conduct of evacuees: " .$_POST["attitude"]."\n"
							."Condition of exits and doors: ".$_POST["description"]."\n"
							."Comments and recommendation: " .$_POST["additional"]."\n"
							."Name: ".$_POST["name"]."\n"
							."Title: ".$_POST["title"]."\n"
							."Phone: ".$_POST["phone"]."\n";							
			$fromaddress = "Fire Drill Report";
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