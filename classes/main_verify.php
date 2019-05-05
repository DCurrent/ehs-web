<?php 

	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php");	//Basic configuration file.   
	require_once($cDocroot."libraries/php/classes/training.php");					//Training class files.
	                    
	$missing	= NULL;	//Missing class parameters?
	$markup		= NULL;	//Final markup.
	$oTra		= NULL;	//Class object: Training.
	$oDBSpace	= NULL;	//Class object, UKSpace.
	$query		= NULL;	//Query string.
	$params		= NULL;	//Parameter array.
	$cDate		= NULL;	//Current date.
	$cMailHead	= NULL;	//Mail out to, from, etc.
	$cMailCont	= NULL;	//Mail out content array.
	$iRecordID	= NULL;	//ID of new training record.
	$key		= NULL;	//Array item key.
	$value		= NULL;	//Array item value.
	$cResults	= NULL;	//Grade results.
	$cEtraxReturn	= NULL;	//Results from sending update to etrax.
	
	$cClassParams = array("trainer" 			=> NULL, 
							"taken" 			=> NULL, 
							"class" 			=> NULL, 
							"name_f" 			=> NULL, 
							"name_l" 			=> NULL, 
							"email" 			=> NULL, 
							"department"		=> NULL, 
							"account" 			=> NULL, 
							"phone" 			=> NULL,
							"desc_title"		=> NULL,
							"status"			=> NULL,
							"trainstatus"		=> NULL,
							"room"				=> NULL,
							"addroom"			=> NULL,
							"supervisor_namef"	=> NULL,
							"supervisor_namel"	=> NULL,
							"external_grade"	=> NULL,
						 	"pass_grade			=> NULL");
	
	/* Get current date. */
	$cDate		= date(DATE_FORMAT);
	
	// Database object for answers query.
	$connect = new class_db_old_connect_params();
	
	$database_ans	= new class_db($connect);	//Database handler.
		
	/* Initialize training class object.*/
	$dependencies 	= new class_training_dependencies();
	
	$dependencies->database		= $oDB;
	$dependencies->database_ans	= $database_ans;
	$dependencies->form 		= $oFrm;
	$dependencies->filter 		= $utl;	
	
	$oTra		= new class_training($dependencies);
	
	// Initialize UK Space database object.
	$connect = new class_db_old_connect_params();	
	
	$connect->set_name('UKSpace');
	
	$oDBSpace = new class_db($connect);
	
	/* Get all values from POST array. */
	foreach($_POST as $key => $value)
	{		
		$cClassParams[$key] = $value;	
	}	
	
	// This is for Captivate posting.
	if(isset($_GET['eg']) == TRUE)
	{
		$cClassParams['external_grade']	= $_GET['eg'];
	}
	
	// Append non post values.
	$cClassParams['trainer'] 	= 0;		//Trainer (0 = online).
	$cClassParams['taken'] 		= $cDate;	//Class taken date.
	
	if(!$cClassParams['class'])
	{
		$markup .= '<h2 class="color_red">No class completed</h2>';
		$markup .= '<p>This area is for providing grade results of training module exams and cannot be accessed directly. Please click <a href="./">here</a> for a list of training and safety course modules offered by UK EHS.</p>';
	}
	else
	{
		// Verify answers and return array with results.
		$cResults = $oTra->training_grade();
					
		$markup .= $cResults["text"];					
		
		echo "<!--Required Score: ".$cClassParams['pass_score']."-->".PHP_EOL;
		echo "<!--External Score: ".$cClassParams['external_grade']."-->".PHP_EOL;
		echo "<!--Assesment Score : ".$cResults["score"]."-->".PHP_EOL;
		
		// If the score is not passing or the grading isn't
		// handled elsewhere, the user failed.
		if ($cResults["score"] < $cClassParams['pass_score'] && !$cClassParams['external_grade'])
		{	
			/* Create failed verbiage markup. */
			$markup .= '<h2 class="color_red">Fail</h2>';
			$markup .= '<p class="color_red">You have failed the course. Please try again.</p>';
			$markup .= '<p class="color_red">Click <a href="javascript:history.back(1)">here</a> to retake the exam now, or you may try again at any other time. Please note that to ensure knowledge of material, questions and the order in which they are presented may be randomized.</p>';
		}				
		else
		{	
			// Create passed verbiage markup.
			$markup .= '<h2 class="color_green">Pass</h2>';		
			$markup .= '<p class="color_green">Congratulations, you have successfully completed the exam. Your completion of this training has been recorded and can be verified any time <a class="link-class" href="transcript.php" target="_blank">here</a> (you will also be able to print a certificate for your own records if needed).</p>';
			
			/* Record to database. */
			$iRecordID = $oTra->training_class_record($cClassParams);
			
			/* Etrax Link. */
			$cClassParams['etrax'] = "https://www.etrax.uky.edu/Chematix/UKYHazWasteTrainingUpdate?action=7"
				."&&FistName="	.$cClassParams['name_f']
				."&&LastName="	.$cClassParams['name_l']
				."&&eMail="		.$cClassParams['email']
				."&&Department=".$cClassParams['department']
				."&&userid="	.$cClassParams['account']
				."&&Phone="		.$cClassParams['phone'];			
			
			/* Add class name */					
			$cClassParams['class'].= ", " .$cClassParams['desc_title'];
			
			/* Get department name */
			if($cClassParams['department'])
			{
				/* Get Department name. */
				$query = "SELECT DeptName FROM MasterDepartment WHERE DeptNo = ?";
				$params = array(&$cClassParams['department']);		
				$oDBSpace->db_basic_select($query, $params, TRUE);			
				$cClassParams['department'].= ", " .$oDBSpace->DBLine['DeptName'];
			}
			
			/* Get facility */
			if($cClassParams['room'])
			{			
				$query = "SELECT BuildingFull, RoomID FROM Rooms_Chematix WHERE RoomBarCode = ?";
				$params = array(&$cClassParams['room']);		
				$oDBSpace->db_basic_select($query, $params, TRUE);			
				$cClassParams['room'].= ", ".$oDBSpace->DBLine['RoomID'].' '.$oDBSpace->DBLine['BuildingFull'];
			}
			
			/* Get status name */
			$query = "SELECT status FROM tbl_uk_status WHERE id = ?";
			$params = array(&$cClassParams['status']);		
			$oDB->db_basic_select($query, $params, TRUE);			
			$cClassParams['status'].= ", " .$oDB->DBLine['status'];								
			
			/* Get training status */			
			if($cClassParams['trainstatus'] != NULL)
			{
				$cClassParams['trainstatus'].= ', '. $cClassParams['trainstatus'] == 1 ? "Annual Refresher" : "Initial";
			}		
			
			/* Email results to responsible party and webmaster. */		  
			$cMailHead['From'] 		= "EHS Online Training";
			$cMailHead['To'] 		= $cClassParams['email_list'];
            $cMailHead['Subject']	= "EHS Online Training: ".$cClassParams['desc_title'];			
			$cMailCont = array(
						"Record ID"					=>	$iRecordID,
						"Etrax Setup Link"			=>	$cClassParams['etrax'],		
						"Class"						=>	$cClassParams['class'],
						"Account"					=>	$cClassParams['account'],
						"Name" 						=>	$cClassParams['name_f'].' '.$cClassParams['name_l'],
						"Department" 				=>	$cClassParams['department'],
						"Location (room/lab)"		=>	$cClassParams['room'],
						"Additonal Rooms/Labs"		=>	$cClassParams['addroom'],						
						"Phone number" 				=>	$cClassParams['phone'],
						"Status" 					=>	$cClassParams['status'],
						"Training Status"			=>	$cClassParams['trainstatus'],
						"Taken"						=>	$cDate,
						"Supervisor"				=>	$cClassParams['supervisor_namef'] .' '.$cClassParams['supervisor_namel']);				
			$oMail->mail_send($cMailCont, $cMailHead['Subject'], $cMailHead['To'], $cMailHead['From'], "dvcask2@uky.edu"); 
			
			/*
			$cEtraxReturn = file_get_contents($cClassParams['etrax']);	
			
			$cMailHead['From'] 		= "EHS Online Training";
            $cMailHead['Subject']	= "ETrax Update: ".$cClassParams['class'];	
			
			$oMail->mail_send($cEtraxReturn, $cMailHead['Subject'], "dvcask2@uky.edu"); 				                						
			*/
		}	
	}
?> 

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
        
        <script language="Javascript" type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script language="Javascript" type="text/javascript" src="//code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <script language="Javascript" type="text/javascript" src="/libraries/javascript/jquery_ui_timepicker_addon.js"></script>
    </head>
    
    <body>
    
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div>
            
            <div id="subContainer">
                <?php include($cDocroot."a_banner_0001.php"); ?>
            
                <div id="subNavigation">
                    <?php include($cDocroot."classes/a_subnav_0001.php"); ?> 
                </div>
            
                <div id="content">
                    <h1>EHS Training</h1>
                    <h3>Exam Results</h3>
                        <p>
                        	See below for results. If you passed, the results will be added to our training records for future verification.<br />
                  		</p>
                    
                    <?php echo $markup;	?>        
                                                 
                    <div class="etrax">
                    </div>
                    
            	</div>
            
            </div>    
            
            <div id="sidePanel">		
            	<?php include($cDocroot."a_sidepanel_0001.php"); ?>	
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

