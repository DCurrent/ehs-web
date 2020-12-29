<?php 

	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.

	$cLRoot		= $cDocroot."ohs/";	
	
	$email_list			= NULL;	//Address list to send alert mail.
	$comments			= NULL;	//Extra comments from user.
	$requiredroom 		= NULL;	//Room number.
	$pi_name_f			= NULL;	//Supervisior or PI's first name.
	$pi_name_l			= NULL;	//Supervisior or PI's last name.	
	$submit_time 		= NULL;
	$query				= NULL;
	$params			= NULL;
	$oDBSpace			= NULL;	//UK Space database.
	$location			= NULL;	//Location display text.
	
	$check				= array('Binder', 
								'ID_Page',
								'Procedures',
								'Perprot',
								'CH10',
								'Training',
								'AppIII',
								'Current',
								'Signage',
								'Flammables');
	
	/* Verify user is authorized  */
	$oAcc->access_verify();	
	
	// Initialize UK Space database object.
	$connect = new class_db_old_connect_params();	
	
	$connect->set_db_name('UKSpace');
	
	$oDBSpace = new class_db($connect);
	
	//Post Vars
	$email_list				= $utl->utl_get_post("email_list");		
	$comments				= $utl->utl_get_post("comments");			
	$requiredroom 			= $utl->utl_get_post("room");		
	$pi_name_f				= $utl->utl_get_post("pi_name_f");			
	$pi_name_l				= $utl->utl_get_post("pi_name_l");				
	$check['Binder']		= $utl->utl_get_post("binder");
	$check['ID_Page']		= $utl->utl_get_post("idpage");
	$check['Procedures']	= $utl->utl_get_post("procedures");
	$check['Perprot']		= $utl->utl_get_post("perprot");
	$check['CH10']			= $utl->utl_get_post("ch10");
	$check['Training']		= $utl->utl_get_post("training");
	$check['AppIII']		= $utl->utl_get_post("appIII");
	$check['Current']		= $utl->utl_get_post("current");
	$check['Signage']		= $utl->utl_get_post("signage");
	$check['Flammables']	= $utl->utl_get_post("flammables");		
	$submit_time 			= date(DATE_FORMAT);
	$oAcc_ip				= $oAcc->get_ip();
	$oAcc_ad				= $oAcc->get_account();
	$filer_fname			= $oAcc->get_name_f();
	$filer_lname			= $oAcc->get_name_l();
	
	/* Build query string. */
	$query ="INSERT INTO 
						tbl_chem_hygiene
								(pi_name_f,
								pi_name_l,
								room,
								chk_binder,
								chk_idpage,
								chk_procedures,
								chk_perprot,
								chk_ch10,
								chk_training,
								chk_appIII,
								chk_current,
								chk_signage,
								chk_flammables,
								comments,
								submit_time,
								submit_user_ad,
								submit_user_ip)			
		OUTPUT INSERTED.id_int
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";		
	
	/* Apply parameters. */
	$params = array(&$pi_name_f,
					&$pi_name_l,
					&$requiredroom,
					&$check['Binder'],
					&$check['ID_Page'],
					&$check['Procedures'],
					&$check['Perprot'],
					&$check['CH10'],
					&$check['Training'],
					&$check['AppIII'],
					&$check['Current'],
					&$check['Signage'],
					&$check['Flammables'],
					&$comments,
					&$submit_time,
					&$oAcc_ad,
					&$oAcc_ip);	
						
		/* Execute query. */	
		$oDB->db_basic_action($query, $params, TRUE);
		
		/* Get ID of created/updated record. */
		$submission_id = $oDB->DBLine["id_int"];	
	
	$query = "SELECT BuildingFull, RoomID FROM Rooms_Chematix WHERE RoomBarCode = ?";
	$params = array(&$requiredroom);		
	$oDBSpace->db_basic_select($query, $params, TRUE);			
		
	$location 			= $oDBSpace->DBLine['RoomID'].', '.$oDBSpace->DBLine['BuildingFull'];	
	$pi_full			= $pi_name_l. ", " .$pi_name_f;
	$filer_full			= $filer_lname. ", " .$filer_fname;
	
	/* Convert checkmark values to "yes" or "No" Text. */
	foreach($check as $key => $val)
	{		
		$check[$key] = $utl->utl_boolean($val, NULL);
	}		
		
	if($comments)
	{
		$comments = "<h3>Comments:</h3> " .$comments;
	}
	
	/*
	$subject	= 	'';									//Subject of email.
	$email_list = 	$email_list.", dvcask2@uky.edu";	//Target addresses.
	$mailcontent=	'';	//Body of mail.	
	
	$mailcontent	= $mailcontent
	
					."\n"				
					."Filer:				".$filer_full." (".$oAcc_ad.", ".$oAcc_ip.") \n"
					."PI/Supervisor:		".$supervisor_full."\n"
					."Room: 				".$room."\n"
					."ID Page: 				".$check['ID_Page']."\n"
					."Procedures:			".$check['Procedures']."\n"
					."Perprot: 				".$check['Perprot']."\n"
					."Chapter 10:			".$check['CH10']."\n"
					."Training:				".$check['Training']."\n"
					."App III: 				".$check['AppIII']."\n"
					."Current: 				".$check['Current']."\n"
					."Signage: 				".$check['Signage']."\n"
					."Flammables:			".$check['Flammables']."\n"										 
					."Comments: 			".$comments."\n"
					."Submitted:			".$submit_time."\n";
					
	$fromaddress	= "EHS No Reply";			
	$subject 		= "CHP Annual Review";			
		
	mail($email_list, $subject, $mailcontent, $fromaddress);
	*/
	
?>

<!DOCtype html>
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Occupational Health &amp; Safety</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />

<link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
</head>

<body>
<div id="container">
	<div id="mainNavigation">
		<?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
	</div>
	<div id="subContainer">
		<?php include($cLRoot."a_banner_0001.php"); ?>
		<div id="subNavigation">
		 	<?php include($cLRoot."a_subnav_0001.php"); ?> 
		</div>
		<div id="content"> <h1>Chemical Hygiene Plan
Annual	Review	  </h1>
		  <p><span class="NoPrint header_sub">Review submitted. Print 
          this for your records.</span>          
		  <form name="CHP Annual Review" method="post" action="">
		  <table width="100%" border="0" cellspacing="0" cellpadding="1">
		    <tr>
		      <td>Submission ID:</td>
		      <td><?php	echo $submission_id; ?></td>
	        </tr>
		    <tr>
		      <td>Time:</td>
		      <td><?php	echo $submit_time; ?></td>
	        </tr>
		    <tr>
		      <td>Filer:</td>
		      <td><?php	echo $filer_full; ?></td>
	        </tr>
		    <tr>
		      <td width="29%"><h3>PI/Lab Supervisor:</h3></td>
		      <td width="71%"><?php	echo $pi_full; ?></td>
	        </tr>
		    <tr>
		      <td><h3>Location:</h3></td>
		      <td><?php echo $location; ?></td>
	        </tr>		    
		    </table>
		  <br />
		  <hr />
		  <br />
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		    <tr>
		      <td width="7%" align="left" valign="top"><h3><?php	echo $check['Binder']; ?></h3></td>
		      <td width="93%" align="left">Teal 
              binder with model Chemical Hygiene Plan inserted.<br />
	          <br /></td>
	        </tr>
		    <tr>
		      <td width="7%" align="left" valign="top"><h3><?php echo $check['ID_Page']; ?></h3></td>
		      <td width="93%" align="left" valign="top">Plan 
                                  Identification Page (page iii) is filled out 
              and current to within one year.<br />
		        <br /></td>
	        </tr>
		    <tr>
		      <td width="7%" height="18" align="left" valign="top"><h3><?php echo $check['Procedures']; ?></h3></td>
		      <td width="93%" height="18" align="left" valign="top">Standard 
                                  Operating Procedures for work involving hazardous 
              chemicals.<br />
		        <br /></td>
	        </tr>
		    <tr>
		      <td width="7%" align="left" valign="top"><h3><?php echo $check['Perprot']; ?></h3></td>
		      <td width="93%" align="left" valign="top">Personal 
                                  protective equipment for all tasks has been 
              assigned for work involving hazardous chemicals.<br />
		        <br /></td>
	        </tr>
		    <tr>
		      <td width="7%" align="left" valign="top"><h3><?php echo $check['CH10']; ?></h3></td>
		      <td width="93%" align="left" valign="top">Chapter 
                                  10, Special provisions for select carcinogens, 
                                  reproductive toxins and acutely toxic chemicals, 
                                  has been reviewed and procedures completed as 
              applicable.<br />
		        <br /></td>
	        </tr>
		    <tr>
		      <td width="7%" align="left" valign="top"><h3><?php echo $check['Training']; ?></h3></td>
		      <td width="93%" align="left" valign="top">CHP/Lab 
                                  Safety Training Program certificates for all 
              workers.<br />
		        <br /></td>
	        </tr>
		    <tr>
		      <td width="7%" align="left" valign="top"><h3><?php echo $check['AppIII']; ?></h3></td>
		      <td width="93%" align="left" valign="top">Lab 
              specific training records, Appendix III.<br />
		        <br /></td>
	        </tr>
		    <tr>
		      <td width="7%" align="left" valign="top"><h3><?php echo $check['Current']; ?></h3></td>
		      <td width="93%" align="left" valign="top">Current 
              chemical inventory.<br />
		        <br /></td>
	        </tr>
		    <tr>
		      <td width="7%" align="left" valign="top"><h3><?php echo $check['Signage']; ?></h3></td>
		      <td width="93%" align="left" valign="top">Laboratory 
                                  signage, Appendix VIII, filled out and on the 
              lab entry door.<br />
		        <br /></td>
	        </tr>
		    <tr>
		      <td width="7%" align="left" valign="top"><h3><?php	echo $check['Flammables']; ?></h3></td>
		      <td width="93%" align="left" valign="top">Flammables 
                                  stored in the lab do not exceed limits described 
              in UK fact sheet.<br /></td>
	        </tr>
		    </table>
		  <?php	echo $comments; ?>
		  </form>
          </p>		  
      </div>       
	</div>    
	<div id="sidePanel">		
		<?php include($cLRoot."a_sidepanel_0001.php");	?>		
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