<?php require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	
	/*
	Damon V. Caskey
	2011/11/01
	~2011/12/08
	~2013/01/14
	
	Create training quiz from database entries as identified by class ID.
	*/	
	
	const DEBUG = FALSE;		// != FALSE: Disables all training modules with maintenance alert to users; value is passed as an ETA. 
	
	$quiz_id	= NULL; 	// Class id field.
	$cClassID		= NULL;		// Class ID as assigned by quiz creator (ex. "2").	
	$query			= NULL;		// Query string.
	$params			= NULL;		// Query parameters.
	$cAccess		= NULL;		// Access array.
	$cNoClass		= FALSE;
	$cQuestions		= NULL;		// Questions markup string.
	$oTra			= NULL;		// Class object: Training.
	$cMHidden		= NULL;		// Miscellaneous hidden value.	
	$iRowCount		= NULL; 	// Row count.
	$oDBSpace		= NULL; 	// Database class object for department list.
	$oFrmDept		= NULL;		// Class object to get department list.
	$bRegInfo 		= FALSE;	// Extra registration info requested?
	$line			= NULL;		// Database line array.				
	
	$showField		= NULL;		// Object; which registration fields to display and require.
	$moduleStatus	= NULL;		// Object; basic status values of the training module.
	
	class class_show_field
	{
		// Data struct for "show field" booloeans.
		
		public $comments 	= NULL;
		public $facility 	= NULL;
		public $department 	= NULL;
		public $addroom		= NULL;
		public $smail		= NULL;
		public $email		= NULL;
		public $trainStatus	= NULL;
		public $etrax		= NULL;
		public $ukStatus	= NULL;
		public $ukid		= NULL;
		public $supervisor	= NULL;
		public $phone		= NULL;
	}
	
	$showField = new class_show_field();	
		
	class class_module_status
	{
		public $hidden 		= NULL; // Module hidden, public, or restricted?
		public $order		= NULL;	// Question layout type.
		public $quantity	= NULL;	// Limit of questions to take from pool.
	}
	
	$moduleStatus = new class_module_status();
	
	$cCP						= array('desc_title'	=> NULL,	//Title of class. 
										'Intro' 		=> NULL,	//Introduction text.
										'Email'			=> NULL,	//Email list.
										'MatAboveHead'	=> NULL,	//Material header (shown above instructions).
										'MatAbove'		=> NULL,	//Material (shown above instructions).
										'MatBelowHead'	=> NULL,	//Material header (shown below instructions).
										'MatBelow'		=> NULL,	//Material (shown below instructions).
										'InstrHead'		=> NULL,	//Instructions header.
										'Inst'			=> NULL);	//Instructions.
	
	$cDList						= array('Facility' 		=> NULL,	//Facility select markup.
										'Room' 			=> NULL,	//Room select markup.
										'Dept' 			=> NULL,	//Department select markup.
										'Status' 		=> NULL);	//Status select markup.
	
	$c_vals						= array('phone'			=> NULL,
										'email'			=> NULL,
										'status'		=> NULL,
										'department'	=> NULL,
										'addroom'		=> NULL,
										'room'			=> NULL,
										'supervisor_namef'	=> NULL,
										'supervisor_namel'	=> NULL);
		
	require($cDocroot."libraries/php/classes/training.php");
	
	// Initialize UK Space database object.
	$connect = new class_db_old_connect_params();	
	
	$connect->set_name('UKSpace');
	
	$oDBSpace = new class_db($connect);
	
	// Initialize form object to handle fields sourced from UK Space database.
	$oFrmDept		= new class_forms(array("DB" => $oDBSpace));
	
	// Initialize database object to handle answers.
	$connect = new class_db_old_connect_params();
	
	$database_ans	= new class_db($connect);
	
	// Initialize training object.
	$dependencies 	= new class_training_dependencies();
		
	$dependencies->database		= $oDB;
	$dependencies->database_ans = $database_ans;
	$dependencies->form 		= $oFrm;
	$dependencies->filter 		= $utl;	
	
	$oTra	= new class_training($dependencies);
			
	$cClassID = $utl->utl_get_get('cClassID');
	
	/* Make sure class ID is a number, else the query will throw an error. */								
	if(is_numeric($cClassID)===FALSE){ $cClassID = NULL; }
									
	/* Construct quiz parameters query string. */
	$query = "SELECT
			id, 
			email_list,
			desc_title, 
			intro, 
			material_above_head, 
			material_above, 
			material_below_head, 
			material_below, 
			instr_head, 
			instr, 
			field_comments, 
			field_facility, 
			field_dept, 
			field_addroom, 
			field_mail, 
			field_email, 
			field_training_status, 
			field_etrax, 
			field_uk_status, 
			field_ukid, 
			field_supervisor, 
			field_phone, 
			hidden, 
			question_order, 
			question_quantity
		FROM 		tbl_class_train_parameters
		WHERE		id = ? AND (hidden <> 1 OR hidden <> 3 OR
				  hidden IS NULL)";	
	
	/* Apply parameters. */
	$params = array(&$cClassID);
	
	//if(is_numeric($cClassID))
	//{	
		/* Execute query */
		$oDB->db_basic_select($query, $params, TRUE, TRUE);
		$iRowCount = $oDB->DBRowCount;
		
		// Derference line array.
		$line = $oDB->DBLine;
	//}
	
	if(DEBUG != FALSE)
	{
		$cNoClass = TRUE;
		$cCP['desc_title'] = "<span class='alert'>Class modules not available.</span>";     
	  	$cCP['Intro'] = "The EHS training system is currently in maintenance mode for debugging or upgrades. We apologize for the inconvenience and will bring the system back online quickly as possible. ETA: ".DEBUG;	
	}
	/* Record doesn't exist or is intentionally hidden. */
	else if($iRowCount != 1)
	{
		$cNoClass		= TRUE;
	  	$cCP['desc_title'] = "<span class='alert'>Class module not available.</span>";     
	  	$cCP['Intro'] = "The requested class was not found in our database, is currently unavailable online or you have followed an out of date link. Please see <a href='/classes'>here</a> for the current list of classes provided by EHS.";
	}
	else
	{							
		$quiz_id				= $line['id'];
		
		$cCP['EMail']				= NULL;	// Email recipiant list for completed quiz alert from DB.
		$cCP['desc_title']			= NULL;	// Class title.
		$cCP['Intro']				= NULL;	// Class introduction text.
		$cCP['MatAboveHead']		= NULL;	// Class material link/text, shown above instructions, header.		
		$cCP['MatAbove'] 			= NULL;	// Class material link/text, shown above instructions.	
		$cCP['MatBelowHead']		= NULL;	// Class material link/text, shown below instructions, header.
		$cCP['MatBelow']			= NULL;	// Class material link/text, shown below instructions.	
		$cCP['InstrHead']			= NULL; // Class instructions header.				
		$cCP['Instr']				= NULL;	// Class instructions.					
		
		
		$cCP['EMail']				= $line['email_list'];				// Email recipiant list for completed quiz alert from DB.
		$cCP['desc_title']			= $line['desc_title'];				// Class title.
		$cCP['Intro']				= $line['intro'];					// Class introduction text.
		$cCP['MatAboveHead']		= $line['material_above_head'];		// Class material link/text, shown above instructions, header.		
		$cCP['MatAbove'] 			= $line['material_above'];			// Class material link/text, shown above instructions.	
		$cCP['MatBelowHead']		= $line['material_below_head'];		// Class material link/text, shown below instructions, header.
		$cCP['MatBelow']			= $line['material_below'];			// Class material link/text, shown below instructions.	
		$cCP['InstrHead']			= $line['instr_head'];				// Class instructions header.				
		$cCP['Instr']				= $line['instr'];					// Class instructions.					
		$showField->comments		= $line['field_comments'];			// Include Comments input field?	
		$showField->facility		= $line['field_facility'];			// Include Facility & Room input field?
		$showField->department		= $line['field_dept'];				// Include Department input field?
		$showField->addroom			= $line['field_addroom'];			// Include Additional Labs/Rooms field?
		$showField->smail			= $line['field_mail'];				// Include address field?	
		$showField->email			= $line['field_email'];				// Include email address field?
		$showField->trainStatus		= $line['field_training_status'];	// Include training status field?
		$showField->etrax			= $line['field_etrax'];				// Include E-Trax waste pickup field?
		$showField->ukStatus		= $line['field_uk_status'];			// Include UK status field?
		$showField->ukid			= $line['field_ukid'];				// Include UK ID field?	
		$showField->supervisor		= $line['field_supervisor'];		// Include PI/Supervisor field?
		$showField->phone			= $line['field_phone'];				// Include phone number field?
		$moduleStatus->hidden		= $line['hidden'];					// Show/hide the quiz?
		$moduleStatus->order		= $line['question_order'];			// Question order (random, etc.).
		$moduleStatus->quantity		= $line['question_quantity'];		// Number of questions from pool (NULL = all).															
		
		/* User authorization. */
		switch ($moduleStatus->hidden)
		{
			// Unlisted, usable.
			case 1:
			default:
			
				/* Access is unrestricted. We just need to verify user has an account and is logged in. */
				$oAcc->access_verify($_SERVER['PHP_SELF']."?cClassID=".$cClassID);
				break;
			
			case 2:
				/* Access is restricted. Get a list of allowed accounts for this module and create a string 
				from them to pass into verifying function. */
				
				/* Construct users query string. */
				$query = "SELECT
						account,
						type
					FROM 		tbl_class_train_users
					WHERE		fk_id = ?";
					
				$params = array(&$quiz_id);			
						
				/* Execute query. */
				$oDB->db_query($query, $params);
				
				while($oDB->db_line())
				{	
					// Derference line array.
					$line = $oDB->DBLine;
				
					$cAccess['Account']	.= ", " .$line["account"];
					$cAccess['Type']	= $line["type"];											
				}
				
				$oAcc->access_verify($_SERVER['PHP_SELF']."?cClassID=".$cClassID, $cAccess['Account']);
				break;
				
			// Closed.
			case 3:
				// Direct to listing.				
				header('Location: index.php');
				break;		
					
		}	
		
		/* Populate account values */
		if(isset($_SESSION['access_cn']))
		{		
			$cMHidden['RNameF']		= $_SESSION['access_name_f'];	// User's first name.
    		$cMHidden['RNameL']		= $_SESSION['access_name_l'];	// User's last name.
    		$cMHidden['RNameA']		= $_SESSION['access_cn'];			// User's account name.
		}
		else
		{
			$cMHidden['RNameF']		= NULL;	// User's first name.
    		$cMHidden['RNameL']		= NULL;	// User's last name.
    		$cMHidden['RNameA']		= NULL;	// User's account name.
		}
	
			
		/* Facility And Room. */
		if($showField->facility == TRUE)
		{	
			/* Extra registration formation asked for. */
			$bRegInfo = TRUE;
		
			/* Prepare list arrays. */
			$cDList['Facility']	= $oFrmDept->forms_list_array_from_query("SELECT DISTINCT BuildingCode, BuildingName FROM MasterBuildings WHERE (BuildingName <> '') ORDER BY BuildingName", NULL, array("Select Facility" => NULL));	//Facility.
			$cDList['Room'] 	= $oFrm->forms_list_array_from_query(NULL, NULL, array("Not Available; Please Select a facility." => NULL)); //Room.
								
			$oFrm->forms_fieldset_addition("instructions", "Select a facility first, then choose your primary room or lab.");
											
			$oFrm->forms_select("facility", class_forms::ID_USE_NAME, "Facility", class_forms::LABEL_USE_ITEM_KEY, $cDList['Facility'], NULL, class_forms::VALUE_CURRENT_NONE, array("element" => "room_search required"));
			
			$oFrm->forms_select("room", class_forms::ID_USE_NAME, "Room/Lab", class_forms::LABEL_USE_ITEM_KEY, $cDList['Room'], NULL, $c_vals['room'], array("element" => "quiz_parameters required"), class_forms::EVENTS_NONE, "required");
			
			if($showField->addroom == TRUE)
			{				
				$oFrm->forms_fieldset_addition('instructions_addroom', '<p>Write the barcode numbers of any additional rooms or labs separated by commas (ex: 1234, 5678, …) into the "Additional Rooms/Labs" field . Barcodes are usually found on the inside of a nearby door.</p>');
				
				$oFrm->forms_input("addroom", class_forms::ID_USE_NAME, "Additional Labs/Rooms", class_forms::VALUE_DEFAULT_NONE, $c_vals['addroom'], array("element" => "quiz_parameters"), class_forms::EVENTS_NONE, 'placeholder="1st addtional #, 2nd additional #, ..."');										
			}								 
			
			$oFrm->forms_fieldset("fs_location", "Location");	
		}
												
		/* Department. */
		if($showField->department == TRUE)
		{
			/* Extra registration formation asked for. */
			$bRegInfo = TRUE;
		
			/* Prepare list array. */
			$cDList['Dept'] 	= $oFrmDept->forms_list_array_from_query("SELECT DISTINCT DeptNo, DeptNo, DeptName FROM MasterDepartment WHERE (DeptName <> '') ORDER BY DeptName", NULL, array("Select Department" =>NULL, 'Outside Entity' => -1));	//Department.
											
			$oFrm->forms_select("department", class_forms::ID_USE_NAME, "Department", class_forms::LABEL_USE_ITEM_KEY, $cDList['Dept'], NULL, $c_vals['department'], array("element" => "quiz_parameters required"), class_forms::EVENTS_NONE, "required");
			
			$oFrm->forms_fieldset("fs_department");	
		}
												
		/* UK Status. */
		if($showField->ukStatus == TRUE)
		{	
			/* Extra registration formation asked for. */
			$bRegInfo = TRUE;

			/* Prepare list array. */		
			$cDList['Status'] 	= $oFrm->forms_list_array_from_query("SELECT id, status FROM tbl_uk_status");	//Status.
										
			$oFrm->formElement['status'] = $oFrm->forms_radio("status", class_forms::ID_USE_NAME, class_forms::LABEL_USE_ITEM_KEY, $cDList['Status'], 4, $c_vals['status'], array("element" => "quiz_parameters"), class_forms::EVENTS_NONE, "required");
			
			$oFrm->forms_fieldset("fs_status", "University Status");
			unset($oFrm->formElement);
		}
												
		// Email
		if($showField->email == TRUE)
		{
			// Extra registration formation asked for.
			$bRegInfo = TRUE;
			
			$oFrm->forms_input("email", class_forms::ID_USE_NAME, "E-Mail Address", class_forms::VALUE_DEFAULT_NONE, $c_vals['email'], array("element" => "quiz_parameters required"), class_forms::EVENTS_NONE, 'placeholder="email@domain.com" required', "email");	
																				
			$oFrm->forms_fieldset("fs_email");	
		}
		
		// Phone
		if($showField->phone == TRUE)
		{
			// Extra registration formation asked for.
			$bRegInfo = TRUE;
																	
			$oFrm->forms_input('phone', class_forms::ID_USE_NAME, "Phone #:", class_forms::VALUE_DEFAULT_NONE, $c_vals['phone'], array("element" => "quiz_parameters"), class_forms::EVENTS_NONE, 'placeholder="x-xxx-xxx-xxxx" maxlength="15" required', "tel");
			
			$oFrm->forms_fieldset("fs_phone");
		}
		
		// PI/Supervisor.
		if($showField->supervisor == TRUE)
		{
			// Extra registration formation asked for.
			$bRegInfo = TRUE;
			
			$oFrm->forms_input("supervisor_namef", class_forms::ID_USE_NAME, "First Name", class_forms::VALUE_DEFAULT_NONE, $c_vals['supervisor_namef'], array("element" => "quiz_parameters required"), class_forms::EVENTS_NONE, 'placeholder="Supervisor First Name" maxlength="19" required');	
			$oFrm->forms_input("supervisor_namel", class_forms::ID_USE_NAME, "Last Name", class_forms::VALUE_DEFAULT_NONE, $c_vals['supervisor_namel'], array("element" => "quiz_parameters required"), class_forms::EVENTS_NONE, 'placeholder="Supervisor Last Name" maxlength="19" required');
											
			$oFrm->forms_fieldset("fs_supervisor", "Supervisor"); 								
		}
		
		/* If any extra registration information was asked for, add in a header markup. */
		if($bRegInfo === TRUE)
		{
			$oFrm->forms_fieldset_all_set('<div class="table_header">Registration - All fields required unless otherwise noted.</div> <p>Note that registration information will be published in Chematix and will be available to all registered UK users of Chematix.</p>'. $oFrm->forms_fieldset_all_get());
		}
		
		/* Populate questions list. */
		$markup['questions'] = $oTra->training_quiz_questions($quiz_id, $moduleStatus->order, $moduleStatus->quantity); 
	}		
		
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety - <?php echo $cCP['desc_title']; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
        <script type="text/javascript" src="../libraries/javascript/validate.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="//code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        
        <style>
        #video
        {
            z-index:-100;
        }
        </style>
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
                    <?php 
                        
                        /* Add  */
						echo '<div id="class_module_header">';
                        echo $utl->utl_if_exists($cCP['desc_title'],	'<h1>', 											'</h1>');
                        echo $utl->utl_if_exists($cCP['Intro'], 		'<p class="class_intro">', 							'</p>');
                        echo $utl->utl_if_exists($cCP['MatAboveHead'], 	'<h2>',												'</h2>');
                        echo $utl->utl_if_exists($cCP['MatAbove'], 		'<p class="class_material_above_instructions">', 	'</p>');
                        echo $utl->utl_if_exists($cCP['InstrHead'],		'<h2>',												'</h2>');
                        echo $utl->utl_if_exists($cCP['Instr'],			'<p class="class_instructions">',					'</p>');
                        echo $utl->utl_if_exists($cCP['MatBelowHead'],	'<h2>',												'</h2>');
                        echo $utl->utl_if_exists($cCP['MatBelow'],		'<p class="class_material_below_instructions">',	'</p>');
						echo '</div><!--/class_module_header-->';								
                    ?>
                  
                    <form action="main_verify.php" method="post" entype="multipart/form-data" name="class" id="class" onsubmit="return validate_form_inputs('required')" class="class_register">
                        <input type="hidden" name="class" 				value="<?php echo $quiz_id; ?>" />
                        <input type="hidden" name="desc_title"			value="<?php echo $cCP['desc_title']; ?>" />
                        <input type="hidden" name="email_list" 			value="<?php echo $cCP['EMail']; ?>" />              
                        <input type="hidden" name="name_f"				value="<?php echo $cMHidden['RNameF']; ?>" />
                        <input type="hidden" name="name_l" 				value="<?php echo $cMHidden['RNameL']; ?>" />
                        <input type="hidden" name="account"				value="<?php echo $cMHidden['RNameA']; ?>" />               	
                        
                     <?php
                            
						/* If fieldset markup contains any items, echo them here. */
						echo $oFrm->forms_fieldset_all_get();	//Registration fields and markup.
						echo $markup['questions']; //Questions from database.
                        
                        if($cNoClass != TRUE)
                        {
                        ?>                
                            <p>
                            <input type='submit' class='FormButton' name='Submit' value='Submit'/>
                            </p>
                        <?php
                        }
                        ?>
                        
                    </form>                     
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
        
        <?php 
		
			$addsTop = array("Select Room/Lab" => NULL, "Outside of facility" => -2, "Not available" => -3); 
			
			$addsTopStr = $utl->array_to_url("addsTop", $addsTop);
			
			$addsEndStr = NULL;
		?>
        
        
        
        <script>
        $(".room_search").change(function() {
        
            var $url = '/libraries/inserts/rooms.php<?php echo '?'.$addsTopStr.'&'.$addsEndStr; ?>&attributes=required';
            var $target_element = $('.room');
            var $form = $('.class_register');
            var posting = null;
            
            $target_element.html('<div class="loading_inline"><span class="alert">Loading rooms/labs...</span> <img src="/media/image/meter_bar.gif" class="loadImage_insert" align="middle"></div>');
            
            /* Put the results in a div */
            posting = $.post($url, $form.serialize());
            
            posting.done(function(data) 
            {	
                //alert("test:" + t);	
                //$(".loadImage").hide();
                $target_element.empty().append( data );
                //$(".result_table").show();
            });
        });
        </script>
    
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

