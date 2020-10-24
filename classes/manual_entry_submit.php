<div id="thestuff">
<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php");	//Basic configuration file.   
	require($cDocroot."libraries/php/classes/training.php");					//Training class files.
	                    
	$missing	= NULL;	//Missing class parameters?
	$markup	= NULL;	//Final markup.
	$oTra		= NULL;	//Class object: Training.
	$oDBSpace	= NULL;	//Class object, UKSpace.
	$query		= NULL;	//Query string.
	$params	= NULL;	//Parameter array.
	$cDate		= NULL;	//Current date.
	$cMailHead	= NULL;	//Mail out to, from, etc.
	$cMailCont	= NULL;	//Mail out content array.
	$iRecordID	= NULL;	//ID of new training record.
	$key		= NULL;	//Array item key.
	$value		= NULL;	//Array item value.	
		
	// Initialize database object to handle answers.
	$connect = new class_db_old_connect_params();
	
	$database_ans	= new class_db($connect);
	
	// Initialize training class object.
	$dependencies 	= new class_training_dependencies();
	
	$dependencies->database		= $oDB;
	$dependencies->database_ans	= $database_ans;
	$dependencies->filter 		= $utl;
	$dependencies->form 		= $oFrm;
		
	$oTra		= new class_training($dependencies);
	
	// Initialize UK Space database object.
	$connect = new class_db_old_connect_params();	
	
	$connect->set_name('UKSpace');
	
	$oDBSpace = new class_db($connect);
	
	 // Get all values from POST array. 
	foreach($_POST as $key => $value)
	{		
		$cClassParams[$key] = $value;	
	}
	
	/* Record to database. */
	$iRecordID = $oTra->training_class_record($cClassParams);
			
	
	///////////////////////////////
	
	$mail_head = new mail_head();	
		
	/* Etrax Link. */
	if($post->etrax) //If user generates waste (needs ETRAX), let's build a servlet link to send the ETRAX program.
	{
		$mail_head->subject = "(REQUIRES ETRAX) ";												
	}
	
	class string_out
	{
		public $class = NULL;
		public $etrax = NULL;
		public $department = NULL;
		public $room = NULL;
	}
	
	$string_out = new string_out();
	
	$string_out->etrax = "https://etrax.chematix.com/Chematix/UKYHazWasteTrainingUpdate?action=7"
		."&&FistName="	.$post->name_f
		."&&LastName="	.$post->name_l
		."&&eMail="		.$post->email
		."&&Department=".$post->department
		."&&userid="	.$post->account
		."&&Phone="		.$post->phone."\n";
		
	// Get class name.
	$query->set_sql("SELECT desc_title FROM tbl_class_train_parameters WHERE id = ?");
	$query->set_params(array(&$post->class));		
	$query->query();			
	$string_out->class = $post->class.", " .$query->get_line_object()->desc_title;
	
	if($post->department)
	{
		// Get Department name.
		$query->set_sql("SELECT DeptName FROM MasterDepartment WHERE DeptNo = ?");
		$query->set_params(array(&$post->department));		
		$query->query();			
		$string_out->class = $post->class.", " .$query->get_line_object()->DeptName;
	}
	
	// Get facility
	if($cClassParams['room'])
	{			
		$query = "SELECT BuildingFull, RoomID FROM Rooms_Chematix WHERE RoomBarCode = ?";
		$params = array(&$cClassParams['room']);		
		$oDBSpace->db_basic_select($query, $params, TRUE);			
		$cClassParams['room'].= ", ".$oDBSpace->DBLine['RoomID'].' '.$oDBSpace->DBLine['BuildingFull'];
	}
	
	// Get location.
	if($post->room)
	{
		// Get Department name.
		$query->set_sql("SELECT DeptName FROM MasterDepartment WHERE DeptNo = ?");
		$query->set_params(array(&$post->department));		
		$query->query();			
		$string_out->class = $post->class.", " .$query->get_line_object()->DeptName;
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
	$mail_head->from 		= "EHS Online Training";
	$mail_head->to 			= $cClassParams['email_list'];
	$mail_head->subject		.= "EHS Online Training: ".$cClassParams['class'];			
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
				"Taken"						=>	$cClassParams['taken'],
				"Supervisor"				=>	$cClassParams['supervisor_namef'] .' '.$cClassParams['supervisor_namel']);				
	$oMail->mail_send($cMailCont, $cMailHead['Subject'], $cMailHead['To'], $cMailHead['From'], "dvcask2@uky.edu"); 			
	
	if (is_array($cMailCont))
	{
		/*
		Initial html and table markup.
		*/
		$markup = "<div class='table_header'>Submitted:</div>
		<table cellpadding='3'>";
		
		/*
		Get each item in array and place into two column table row.
		*/
		foreach($cMailCont as $key => $value)
		{			
			$markup .= "<tr><td>".$key.":</td><td>".$value."</td></tr>";			
		}	
		
		/*
		Add closing markup.
		*/
		$markup .= "</table>";
	}
	
	
	
	
	
?> 
</div>

