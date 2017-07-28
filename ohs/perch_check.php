<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<?php
	if ($_POST[Submit]) {
			//Setting up email function
			$toaddress = "lpoor2@email.uky.edu";
			$subject = "Perchloric Acid Questionnaire";
			$mailcontent = "Name: ".$_POST[name]."\n"
							."Building: ".$_POST[bldg]."\n"
							."Room: ".$_POST[room]."\n\n"
							."Have you ever used perchloric acid in this lab? ".$_POST[no1]."\n\n"
							."Have you used any chemical that would cause a hazardous condition in the fume hood duct? ".$_POST[no2]."\n\n"
							."If yes, has perchloric acid been used at concentrations greater than 72%? ".$_POST[no3]."\n\n"
							."Has perchloric acid been used at temperatures greater than ambient? ".$_POST[no4]."\n\n"
							."Have you ever had a spill involving perchloric acid? ".$_POST[no5]."\n\n";
			$fromaddress = "Perchloric Acid Questionnaire";
			mail($toaddress, $subject, $mailcontent, $fromaddress);
			//End email function			
			mssql_close();
			
			header("location: exit.php");
	}
?>

<?php echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?".">"; ?>
<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>Perchloric Acid Questionnaire</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
<form action="<?php print $_SELF; ?>" method="post" name="grants" id="grants">
  <table width="650" align="center" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td> 
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr valign="bottom"> 
            <td width="28%"><img src="../media/image/ehslogo.gif" width="175" height="90" alt="UK Envirornmental Health and Safety" /></td>
            <td width="72%" valign="middle"> 
              <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="3"><b>Perchloric 
                Acid Questionnaire</b></font></div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  <tr>
    <td>
        <div align="center"> <img src="../media/image/line2.gif" alt="" width="90%" height="1" /><br />
          <font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b> </b></font><br />
        </div>
      </td>
    </tr>
  <tr>
      <td> <ol>
          <li><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Have 
            you ever used perchloric acid in this lab? </font></b><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
            <input type="radio" name="no1" value="yes" />
            <b>Yes</b> 
            <input type="radio" name="no1" value="no" />
            <b>No</b><br />
            <br />
            </font> </li>
          <li><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Have 
            you used any chemical that would cause a hazardous condition in the 
            fume hood duct? </font></b><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
            <input type="radio" name="no2" value="yes" />
            <b>Yes</b> 
            <input type="radio" name="no2" value="no" />
            <b>No</b><br />
            <br />
            </font> </li>
          <li><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b>If 
            yes, has perchloric acid been used at concentrations greater than 
            72%?<br />
            </b> 
            <input type="radio" name="no3" value="yes" />
            <b>Yes</b> 
            <input type="radio" name="no3" value="no" />
            <b>No</b><br />
            <br />
            </font> </li>
          <li><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Has 
            perchloric acid been used at temperatures greater than ambient?<br />
            </font></b><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
            <input type="radio" name="no4" value="yes" />
            <b>Yes</b> 
            <input type="radio" name="no4" value="no" />
            <b>No</b><br />
            <br />
            </font> </li>
          <li><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Have 
            you ever had a spill involving perchloric acid? </font></b><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> 
            <input type="radio" name="no5" value="yes" />
            <b>Yes</b> 
            <input type="radio" name="no5" value="no" />
            <b>No<br />
            <br />
            </b></font></li>
        </ol>
	  </td>
    </tr>
  <tr>
    <td>
      <center>
          <table width="85%" border="0" cellspacing="0" cellpadding="0">
            <tr valign="middle"> 
              <td width="21%"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Name</font></b></td>
              <td width="79%"> 
                <input type="text" name="name" size="35" />
              </td>
            </tr>
            <tr valign="middle"> 
              <td width="21%"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Building</font></b></td>
              <td width="79%"> 
                <input name="bldg" type="text" id="bldg" size="35" />
              </td>
            </tr>
            <tr valign="middle"> 
              <td width="21%"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Room 
                # </font></b></td>
              <td width="79%"> 
                <input name="room" type="text" id="room" size="35" />
              </td>
            </tr>
            <tr valign="middle"> 
              <td colspan="2"> <br />
                <table width="18%" border="0" cellspacing="0" cellpadding="0" align="left">
                  <tr> 
                    <td width="46%"> 
                      <input class="FormButton" type="submit" name="Submit" value="Submit" />
                    </td>
                    <td width="54%"> 
                      <input class="FormButton" type="reset" name="reset" value="Reset" />
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          <br />
      </center>
        <div align="center">          <font face="Arial"><img src="../media/image/line2.gif" alt="" width="90%" height="1" /><br />
            <br />
          <a href="../"><font size="2" face="Arial, Helvetica, sans-serif"><b>EH&amp;S</b></font></a></font></div>
      </td>
    </tr>
  <tr>
    <td> 
      <p><font color="#999999" size="1" face="Verdana, Arial, Helvetica, sans-serif"> 
          Last Modified 11.30.2004<br />
        Send Comments to <a href="mailto:dvcask2@email.uky.edu" title="Send comments to Jeremy King at jlking0@uky.edu">J. King</a></font></p>
    </td>
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