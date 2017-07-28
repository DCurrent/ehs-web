<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<html>
<head>
<title>CFATS Submission</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" onLoad="MM_preloadImages('../media/image/ehs3_03-over.png','../media/image/ehs3_04-over.png','../media/image/ehs3_05-over.png','../media/image/ehs3_06-over.png')">
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
</table>
<table width="641" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="641"><div align="left"><strong><font size="5">DHS Chemical Facility 
        Anti-Terrorism Standards</font></strong><br />
      </div></td>
  </tr>
</table>
<p> 
<?php	

	$title_text = $_POST["title_text"];		
	$intro_text = $_POST["intro_text"];
	$entry_text = $_POST["entry_text"];
	$max_entries = $_POST["max_entries"];		
	$label1 = $_POST["label1"];
	$label2 = $_POST["label2"];
	$label3 = $_POST["label3"];
	$label4 = $_POST["label4"];
	$label5 = $_POST["label5"];
	$label6 = $_POST["label6"];
	$label7 = $_POST["label7"];
	$label8 = $_POST["label8"];													
	
	//Make sure the user did not forget something or try to be lazy.
	echo "<b>Edits <font color=\"green\">accepted</font color>.";
	
	//Database server connection						
	$db_conn = mssql_connect("128.163.184.42","EHSInfo_User","ehsinfo") or die("Database error;<br>Please contact the webmaster at <a href=\"mailto:dvcask2@uky.edu\">dvcask2@email.uky.edu</a> immediately."); 			
		
	//Select database 
	mssql_select_db("ehs", $db_conn ) or die("Database error;<br>Please contact the webmaster at <a href=\"mailto:dvcask2@uky.edu\">dvcask2@email.uky.edu</a> immediately.");
		
	$query = "UPDATE chem_params 
	SET title_text = '$title_text',
	intro_text = '$intro_text', 
	entry_text = '$entry_text',
	max_entries = '$max_entries',
	label1 = '$label1',
	label2 = '$label2',
	label3 = '$label3',
	label4 = '$label4',
	label5 = '$label5',
	label6 = '$label6',
	label7 = '$label7',
	label8 = '$label8';";	//Finish query construction.						
	
	mssql_query($query);	//Run Query.				
	mssql_close();			//Make sure the database is closed.
			
?>

Click <a title="CFATS Entry" href="../cfats/" class="link">here</a> to return to CFATS entry form.
<br><br>
<table width="640" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <!--Navigation links-->
    <td colspan="3" align="center"> <img src="../media/image/line2.gif" alt="" /> 
      <br /> <font face="Arial, Helvetica, sans-serif" size="2"><b><a title="UK" href="//www.uky.edu/" class="link">UK</a></b></font><b><font face="Arial, Helvetica, sans-serif" size="2"> 
      | <a title="Campus Services" href="//www.uky.edu/Services/" class="link">Campus 
      Services</a></font></b> </td>
  </tr>
  <tr> 
    <!--Address-->
    <td width="200" valign="top"><p><font size="2" face="Arial, Helvetica, sans-serif">252 
        East Maxwell Street<br />
        Lexington, KY 40506-0314 </font></p>
      <p> </p></td>
    <td width="235" valign="top">&nbsp;</td>
    <td width="222" valign="top"><p><font size="2" face="Arial, Helvetica, sans-serif">Phone: 
        (859) 257-1376<br />
        Fax: (859) 257-8787</font></p></td>
  </tr>
  <tr> 
    <td colspan="2" valign="top"><font face="Arial, Helvetica, sans-serif" size="1">Last 
      modified: 04.30 .2008<br />
      Send comments to: <a href="mailto:dvcask2@email.uky.edu" class="link">Damon 
      V. Caskey </a></font></td>
    <td width="222" valign="top"><img src="../media/image/camp_serv.png" alt="Campus Services" title="Campus Services" width="151" height="28" /></td>
  </tr>
  <tr valign="top"> 
    <td colspan="3"><font size="1" face="Arial, Helvetica, sans-serif">Warning 
      - Some Web sites to which these materials provide links for the convenience 
      of users are not managed by the University of Kentucky. The University takes 
      no responsibility for the contents of those sites. </font></td>
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