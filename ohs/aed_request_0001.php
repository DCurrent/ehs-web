<?php require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Environmental Health And Safety</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="/libraries/css/style.css" type="text/css" />

<link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />

<?php 
	$cLRoot		= $cDocroot."ohs/"; 								//Get siteroot address.	
?>
</head>

<body>

<div id="container">
	<div id="mainNavigation">
		<?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
	</div>
	<div id="subContainer">
		<?php include($cDocroot."a_banner_0001.php"); ?>
		<div id="subNavigation">
		 	<?php include($cDocroot."a_subnav_0001.php"); ?> 
		</div>
		<div id="content">
		  <h1>AED Request Form</h1>

			<?php
				if (isset($_POST['Submit']))
				{		
					$email_list 		= $_POST['email_list'];
					$requiredlblue 		= $_POST['requiredlblue'];
					$requiredfirstname	= $_POST['requiredfirstname'];
					$requiredlastname	= $_POST['requiredlastname'];
					$requiredDepartment = $_POST['requiredDepartment'];
					$aedlocation 		= $_POST['aedlocation'];
					$aedreason 			= $_POST['aedreason'];
					$comments 			= $_POST['comments'];
					
					if($requiredlblue 
						&& $requiredfirstname 
						&& $requiredlastname 
						&& $requiredDepartment 
						&& $aedlocation 
						&& $aedreason)
					{										
						$department	= value_0001("MasterDepartment", "DeptNo", $requiredDepartment, "DeptName");		//Get dept. name.
			
						$subject	= 	'';									//Subject of email.
						$email_list = 	$email_list.", dvcask2@uky.edu";	//Target addresses.
						$mailcontent=	'';	//Body of mail.
						
						//Setting up email function			
						$mailcontent	= $mailcontent
						
										."\n"
										."Account:			".$requiredlblue."\n"
										."First name: 			".$requiredfirstname."\n"
										."Last name: 			".$requiredlastname."\n"									
										."Department: 			".$department."\n"
										."Location: 			".$aedlocation."\n"
										."Reason: 			".$aedreason."\n"
										."Comments: 			".$comments."\n";
						$fromaddress	= "AED Request";			
						$subject 		= "AED Request";			
						
						$mail = mail($email_list, $subject, $mailcontent, $fromaddress);
						
						if($mail)
						{				
							$presub_display = "none";
							echo "<p>Thank you. Your request has been submitted.</p>";
						}
						else
						{
							echo "<p><span class='alert'>I'm sorry, there was a problem processing your request. Please try again or contact the EHS department directly.</span></p>";						
							
							$presub_display = "yes";
						}
					}
					else
					{
						echo "<p><span class='alert'>One or more fields contained invalid/missing information. All fields are required unless otherwise noted.</span></p>";
						
						$presub_display = "yes";
					}				
				}
				else
				{					
					$presub_display = "yes";
				}
			?>			

		  	<div id="presub" style="display:<?php echo $presub_display; ?>">
              <p>Fill out the following form and click &quot;sumbit&quot; to request an AED. Your request will be sent to EHS for review.</p>
              <form method="post" entype="multipart/form-data" name="class" id="class">
              <input type="hidden" name="email_list" value="lpoor2@uky.edu" />
                  <table width="100%" border="0" bgcolor="#F0F0FF">
                    <tr>
                      <th colspan="2" align="center" valign="middle"> All fields required unless otherwise noted.</th>
                    </tr>
                    <tr>
                      <td width="28%"valign="middle">Department:</td>
                      <td width="72%"><div align="left">
                        <!--select type="select" name="requiredDepartment" id="requiredDepartment" style="width:95%; font-size:10px">
                          <?php //print department_0001(); ?>
                        </select-->
                        
                        <input type="text" name="requiredDepartment" value="" id="requiredDepartment" size="35" style="width:95%;"/>
                        </div></td>
                    </tr>
                    <tr>
                      <td width="28%" valign="middle">First Name:</td>
                      <td width="72%"><div align="left">
                        <input type="text" name="requiredfirstname" value="" id="firstname" size="35" style="width:95%;"/>
                        </div></td>
                    </tr>
                    <tr>
                      <td width="28%" valign="middle">Last Name:</td>
                      <td width="72%"><div align="left">
                        <input type="text" name="requiredlastname" id="lastname" value="" size="35" style="width:95%;"/>
                        </div></td>
                    </tr>
                    <tr>
                      <td width="28%" valign="middle">Link Blue Account:</td>
                      <td width="72%"><div align="left">
                        <input type="text" name="requiredlblue" id="requiredlblue" value="" size="35" style="width:95%;"/>
                        </div></td>
                    </tr>
                    <tr>
                      <td width="28%" valign="middle">Location For AED:</td>
                      <td width="72%">
                        <textarea name="aedlocation" id="aedlocation" cols="30%" rows="3" style="width:95%;"/></textarea></td>
                    </tr>
                    <tr>
                      <td valign="middle">Reason For AED:</td>
                      <td><textarea name="aedreason" id="aedreason" cols="30%" rows="3" style="width:95%;" ></textarea></td>
                    </tr>
                    <tr>
                      <td valign="middle">*Comments:</td>
                      <td><textarea name="comments" id="comments"cols="30%" rows="3" style="width:95%;"></textarea></td>
                    </tr>
                </table>
                  <p>
                    <input type="submit" class="FormButton" name="Submit" value="Submit" />
                    <input type="reset" class="FormButton" name="Reset" value="Reset" />
                </p>
              </form>
	      	</div>
</div>       
	</div>    
	<div id="sidePanel">		
		<?php include($cLRoot."a_sidepanel_0001.php"); ?>		
	</div>
	<div id="footer">
		<?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
	</div>
</div>

<div id="footerPad">
<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
</div>
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