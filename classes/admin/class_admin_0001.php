<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<?php 
	
	/*
	Damon V. Caskey
	20110529
	
	Administrate classes 
	
	Create training quiz from database entries as identified by class ID.
	*/
	
	$cBase		= $cDocroot."libraries/php/";
	require_once($cBase."classes/constants.php");								//Global constants
	require_once($cBase."classes/database_old.php");								//Global database handler.	
	require_once($cBase."classes/droplist_old.php");								//Global droplist handler.
		
	require($cDocroot."libraries/php/class_quiz_questions_0003.php");
	
	//require($cDocroot."libraries/php/auth_verify_0001_old.php");				//LDAP login verification.
	require($cDocroot."libraries/php/facility_0001.php");				//Populate facility list.
	require($cDocroot."libraries/php/department_0001.php");					//Populate department list.	
	require($cDocroot."libraries/php/status_0001.php");						//Populate status list.	
	require($cDocroot."libraries/php/class_0001.php");						//Populate lists.
	require($cDocroot."libraries/php/back_alt_0001.php");					//Alternating table row backgorund colors.
	require($cDocroot."libraries/php/a_cred_master_0001.php");				//DB connection variables.
	require($cDocroot."libraries/php/sqlsrv_aux_0001.php");
	
	
	$i							= 0;	//Counter
	$quiz_id					= NULL;	//Quiz ID field ("id" in database).
	$bClassParams				= NULL; //Class parameter (booloean types) array.
	$cClassParams				= NULL; //Class parameter (string type) array.
	$bClassSetHidden			= 0;	//Hide class from public lists.
	$cClassQOrder				= 0; 	//Order layout of questions.
	$cClassQQuantity			= 0;	//Quantity of questions to be displayed.
	$cClassQLayout				= NULL;	//Display layout (one page at a time, list, etc.).
	$cClassCertParty			= NULL;	//Responsible party for class.
	$cClassTitle				= NULL; //Class title.
	$db_conn					= NULL;	//Database connection pointer.
	$query						= NULL;	//Query string.
	$params					= NULL;	//Query parameter array.
	$result						= NULL;	//Query result pointer.
	$line						= NULL;	//Query field array.
	$oAcc_acct					= NULL;	//User account name.
	$oAcc_type					= NULL;	//User type.
	$cClassLst					= NULL;	//Class droplist.
	$cTime						= NULL;
	$cQuestions					= NULL; //Class questions list.
	$cAnswers					= NULL;	//Class answers list.
	$cNAnswer					= NULL; //New answer code.
	$cAnswerVals				= NULL; //
	$cAnswerValLst				= NULL;
	$cEditMode					= NULL;	//Window to make visible.
	//$cQueQuantityLst			= NULL; //Values for question quantity select box.
	$cResponsiblePartyLst		= NULL; //Values for responsible part selection box.
	$cIDGuid					= NULL;	//Guid ID of record.
	$cQuestionOrder				= NULL;	//Question order.
	$cQuestionVal				= NULL;	//Question value.
	$cQuestionRightAnswer		= NULL;	//Correct answer.
	$cAnswerVal					= NULL;	//Answer value.
	$cAnswerText				= NULL;	//Answer text.
	$bShowMain					= NULL;	//Show main page text.
	$cAccounts					= NULL;	//Accounts list.
	$cAccountText				= NULL;	//Account text.
	$result						= NULL;
	$rStatement					= NULL;
	
	$oDB						= NULL;	//Database class object.
	$oDL						= NULL;	//Droplist class object.
	
	/* Verify user is authorized  */
	//auth_verify_0001(NULL, ADMIN_LIST.", hmtr22, bnels3, ejrous0, dgwebb2, rwtayl4, rdkjel2, bbutl1, jghamo2, jrburn4");
	
	$connect = new class_db_old_connect_params();
	
	$oDB = new class_db($connect);	//Initialize database class object.
	$oDL = new class_dl($connect);	//Initialize droplist class object.
	
	/* Get or default edit mode (parameters, questions, access). */
	$cEditMode = @$_POST['EditMode'];	
	if(!$cEditMode){ $cEditMode = 0; }
	
	/* If the user had previously selected a class (i.e. is editing a class and posted), retain their selection. */
	$cClassID = @$_POST['cClassID'];	
	if(!$cClassID){ $cClassID = @$_SESSION["cClassAdminClassID"]; }

	/* I prefer using GUIDs as a key. Let's run a quick query here to retrieve it using the selected Quiz ID (ex: 15PASSVAN).	*/
	$query = "SELECT 
						guid_id 
	FROM 				tbl_class_train_parameters 
	WHERE     			quiz_id 	= ?";
	
	$oDB->db_basic_select($query, array(&$cClassID), TRUE);	
	$cClassGuid = $oDB->DBLine['guid_id'];
	
	$oAcc_acct 	= @$_SESSION['access_cn'];									//Get account name from session.
	$cTime		= date(DATE_FORMAT);								//Get current time.
					
	/* Populate the class selection list */									
	$cClassLst		= class_0001($cClassID);
	
	/* Handle user events */
	if(@$_POST['Save_Parameters'])					//Save class parameters.
	{	
		$bClassSetHidden			= @$_POST['bClassSetHidden'];	
		$cClassQLayout				= @$_POST['cClassQLayout'];
		$cClassQOrder				= @$_POST['cClassQOrder'];
		$cClassQQuantity			= @$_POST['frm_lst_cClassQQuantity'];
		$cClassCertParty			= @$_POST['frm_lst_cClassCertParty'];

		/* Get string type post parameters. */
		$cClassParams = array(
			"cClassEmail"				=> @$_POST['cClassEmail'],
			"cClassIntro"				=> @$_POST['cClassIntro'],
			"cClassMaterialAboveHead"	=> @$_POST['cClassMaterialAboveHead'],
			"cClassMaterialAbove"		=> @$_POST['cClassMaterialAbove'],
			"cClassMaterialBelowHead"	=> @$_POST['cClassMaterialBelowHead'],
			"cClassMaterialBelow"		=> @$_POST['cClassMaterialBelow'],
			"cClassInstrHead"			=> @$_POST['cClassInstrHead'],
			"cClassInstr"				=> @$_POST['cClassInstr'],
			"cClassCertVerbiage"		=> @$_POST['cClassCertVerbiage']
			);

		/* Get checkmark type post parameters. */
		$bClassParams = array(
			"bClassFieldComments" 	=> @$_POST['bClassFieldComments'],
			"bClassFieldFacility" 	=> @$_POST['bClassFieldFacility'],
			"bClassFieldDept"		=> @$_POST['bClassFieldDept'],
			"bClassFieldAddroom"	=> @$_POST['bClassFieldAddroom'],
			"bClassFieldMail"		=> @$_POST['bClassFieldMail'],
			"bClassFieldEMail"		=> @$_POST['bClassFieldEMail'],
			"bClassFieldTStatus"	=> @$_POST['bClassFieldTStatus'],
			"bClassFieldETrax"		=> @$_POST['bClassFieldETrax'],
			"bClassFieldUKStatus"	=> @$_POST['bClassFieldUKStatus'],
			"bClassFieldUKID"		=> @$_POST['bClassFieldUKID'],
			"bClassFieldSuper"		=> @$_POST['bClassFieldSuper'],
			"bClassFieldPhone"		=> @$_POST['bClassFieldPhone']				
				);
		
		/* Convert checkmark values to boolean. */			
		foreach ($bClassParams as &$value)
		{		
			if ($value)
			{			
				$value = 1;
			}
			else
			{
				$value = 0;
			}
		} 
		unset($value);			
						
		/* Construct class parameter update query. */
		$query = "UPDATE tbl_class_train_parameters
					
					SET 	
						email_list 				= ?,							
						intro					= ?,
						material_above_head		= ?,
						material_above			= ?,								
						material_below_head		= ?,								
						material_below			= ?,
						instr_head				= ?,
						instr					= ?,
						cert_verbiage			= ?,
						field_comments			= ?,
						field_facility			= ?,
						field_dept				= ?,
						field_addroom			= ?,	
						field_mail				= ?,
						field_email				= ?,
						field_training_status	= ?,								
						field_etrax				= ?,								
						field_uk_status			= ?,
						field_ukid				= ?,
						field_supervisor		= ?,
						field_phone				= ?,
						hidden					= ?,
						display_order			= ?,
						question_quantity		= ?,
						responsible_party		= ?
 						
					WHERE guid_id = ?";

		/* Prepare and execute class parameter update query */				
		$oDB->db_basic_action($query, array(
			&$cClassParams['cClassEmail'],							
			&$cClassParams['cClassIntro'],
			&$cClassParams['cClassMaterialAboveHead'],
			&$cClassParams['cClassMaterialAbove'],								
			&$cClassParams['cClassMaterialBelowHead'],								
			&$cClassParams['cClassMaterialBelow'],
			&$cClassParams['cClassInstrHead'],
			&$cClassParams['cClassInstr'],
			&$cClassParams['cClassCertVerbiage'],
			&$bClassParams['bClassFieldComments'],
			&$bClassParams['bClassFieldFacility'],
			&$bClassParams['bClassFieldDept'],
			&$bClassParams['bClassFieldAddroom'],	
			&$bClassParams['bClassFieldMail'],
			&$bClassParams['bClassFieldEMail'],
			&$bClassParams['bClassFieldTStatus'],								
			&$bClassParams['bClassFieldETrax'],								
			&$bClassParams['bClassFieldUKStatus'],
			&$bClassParams['bClassFieldUKID'],
			&$bClassParams['bClassFieldSuper'],
			&$bClassParams['bClassFieldPhone'],
			&$bClassSetHidden,
			&$cClassQOrder,
			&$cClassQQuantity,
			&$cClassCertParty,
			&$cClassGuid));										
	}
	else if(@$_POST["frm_button_class_add"])		//New module.
	{		
		$query = "INSERT INTO tbl_class_train_parameters 
		
			(quiz_id) VALUES (?)";
				
		$oDB->db_basic_action($query, array(&$cClassID));
										
	}
	else if(@$_POST["frm_btn_que_save"])			//Updating questions.
	{					
		$cIDGuid				= @$_POST["id_guid"];				//Guid ID of record.
		$cQuestionOrder			= @$_POST["frm_lst_order"];			//Question order.
		$cQuestionVal			= @$_POST["frm_ta_question_val"];	//Question value.
		$cQuestionRightAnswer	= @$_POST["frm_lst_right_answer"];	//Correct answer.
		
		/* Construct question update query */				
		$query = "UPDATE tbl_class_train_questions
		
		SET 	
			display_order			= ?,							
			question				= ?,
			right_answer			= ?
										
		WHERE guid_id = ?";
		
		/* Prepare and execute question update query */
		$oDB->db_basic_action($query, array(
			&$cQuestionOrder, 
			&$cQuestionVal, 
			&$cQuestionRightAnswer, 
			&$cIDGuid));										
	}
	else if(@$_POST["frm_btn_que_add"])				//Add question.
	{					
		$cQuestionOrder			= @$_POST["frm_lst_order"];			//Question order.
		$cQuestionVal			= @$_POST["frm_ta_question_val"];	//Question value.
		$cQuestionRightAnswer	= @$_POST["frm_lst_right_answer"];	//Correct answer.
		
		/* Construct question insert query */				
		$query = "INSERT INTO tbl_class_train_questions 
	
			(fk_tbl_class_train_parameters_guid_id, 
			display_order, 
			question, 
			right_answer) 
			
			VALUES (?, ?, ?, ?)";
		
		/* Prepare and execute question insert query */
		$oDB->db_basic_action($query, array(
		&$cClassGuid,
		&$cQuestionOrder,
		&$cQuestionVal,
		&$cQuestionRightAnswer));										
	}
	else if(@$_POST["frm_btn_que_delete"])			//Delete question.
	{			
		$cIDGuid				= @$_POST["id_guid"];							//Guid ID of record.	
		
		/* Construct question delete query. */		
		$query = "DELETE from tbl_class_train_questions						
			
			WHERE guid_id = ?";
		
		/* Prepare and execute question delete query. */
		$oDB->db_basic_action($query, array(&$cIDGuid));
		
		/* Construct answer delete query. */		
		$query = "DELETE from tbl_class_train_answers						
			
			WHERE fk_tbl_class_train_questions_guid_id = ?";
			
		/* Prepare and execute answer delete query. */
		$oDB->db_basic_action($query, array(&$cIDGuid));										
	}
	else if(@$_POST["frm_btn_ans_save_x"])			//Updating answers.
	{					
		$cIDGuid				= @$_POST["id_guid"];				//Guid ID of record.
		$cAnswerVal				= @$_POST["frm_lst_answer_val"];	//Answer value.
		$cAnswerText			= @$_POST["frm_ta_answer_text"];	//Answer text.
		
		/* Construct answer update query. */		
		$query = "UPDATE tbl_class_train_answers
			
			SET 	
				text					= ?,							
				value					= ?
											
			WHERE guid_id = ?";
		
		/* Prepare and execute answer update query. */
		$oDB->db_basic_action($query, array(
		&$cAnswerText,
		&$cAnswerVal,
		&$cIDGuid));										
	}
	else if(@$_POST["frm_btn_ans_add_x"])			//Adding answer.
	{					
		$cIDGuid				= @$_POST["id_guid"];				//Guid ID of record.
		$cAnswerVal				= @$_POST["frm_lst_answer_val"];	//Answer value.
		$cAnswerText			= @$_POST["frm_ta_answer_text"];	//Answer text.		
		
		/* Construct answer insert query. */
		$query = "INSERT INTO tbl_class_train_answers 
		
			(fk_tbl_class_train_questions_guid_id, 
			text, 
			value) 
			
			VALUES (?, ?, ?)";
		
		/* Prepare and execute answer insert query. */
		$oDB->db_basic_action($query, array(
		&$cIDGuid,
		&$cAnswerText,
		&$cAnswerVal));										
	}
	else if(@$_POST['frm_btn_ans_delete_x'])		//Delete answer.
	{		
		$cIDGuid				= @$_POST["id_guid"];						//Guid ID of record.	
		
		/* Construct answer delete query. */		
		$query = "DELETE from tbl_class_train_answers						
			
			WHERE guid_id = ?";
		
		/* Prepare and execute answer delete query. */	
		$oDB->db_basic_action($query, array(&$cIDGuid));									
	}
	else if(@$_POST["frm_btn_account_save_x"])		//Updating account.
	{					
		$cIDGuid				= @$_POST["id_guid"];				//Guid ID of record.
		$cAccountText			= @$_POST["frm_txt_account"];		//account value.
		
		/* Construct account update query. */	
		$query = "UPDATE tbl_class_train_users
			
			SET 	
				account					= ?
											
			WHERE guid_id = ?";
		
		/* Prepare and execute account update query. */
		$oDB->db_basic_action($query, array(
		&$cAccountText,
		&$cIDGuid));										
	}
	else if(@$_POST["frm_btn_account_add_x"])		//Adding account.
	{					
		$cIDGuid				= @$_POST["id_guid"];				//Guid ID of record.
		$cAccountText			= @$_POST["frm_txt_account"];		//account value.
				
		/* Construct account insert query. */
		$query = "INSERT INTO tbl_class_train_users 
		
		(fk_class_train_parameters_guid_id, 
		account) 
		
		VALUES (?, ?)";
		
		/* Prepare and execute account update query. */
		$oDB->db_basic_action($query, array(
		&$cClassGuid,
		&$cAccountText));										
	}
	else if(@$_POST['frm_btn_account_delete_x'])	//Delete account.
	{		
		$cIDGuid				= @$_POST["id_guid"];						//Guid ID of record.	
		
		/* Construct account delete query. */		
		$query = "DELETE from tbl_class_train_users						

			WHERE guid_id = ?";
		
		/* Prepare and execute account delete query. */	
		$oDB->db_basic_action($query, array(&$cIDGuid));									
	}	
	
	/* Class ID selected? Load parameters, questions, etc. */
	if($cClassID)	
	{
		/* This code needs to be above page header, but we also need to conceal large portions of the body if no class ID is set. It would be rather silly to echo a whole page worth of static html, so instead we'll set a 			variable here and check it in the body to determine what is shown.	*/		
		$bShowMain = 2;
		
		/* Place class ID selection into a session variable so it isn't lost when posting (reloading) page.	*/
		$_SESSION["cClassAdminClassID"] = $cClassID;
		
		/*	Get quiz parameters. */
		$db_conn = sqlsrv_connect($db_host, $db_connect);						//Connect to DB server.
		
		$query = "SELECT
			*
			FROM 		tbl_class_train_parameters
			WHERE		quiz_id = ?";				
			
		$oDB->db_basic_select($query, array(&$cClassID), TRUE);
			
		if(!$oDB->DBRowCount)
		{         
		  $bShowMain = 1;
		}
		else
		{			
			$quiz_guid_id								= $oDB->DBLine["guid_id"];
			$cClassParams['cClassEmail']				= $oDB->DBLine["email_list"];			
			$cClassParams['cClassIntro']				= $oDB->DBLine["intro"];		
			$cClassParams['cClassMaterialAboveHead']	= $oDB->DBLine["material_above_head"];		
			$cClassParams['cClassMaterialAbove'] 		= $oDB->DBLine["material_above"];				
			$cClassParams['cClassMaterialBelowHead']	= $oDB->DBLine["material_below_head"];
			$cClassParams['cClassMaterialBelow']		= $oDB->DBLine["material_below"];	
			$cClassParams['cClassInstrHead']			= $oDB->DBLine["instr_head"];				
			$cClassParams['cClassInstr']				= $oDB->DBLine["instr"];
			$cClassCertParty							= $oDB->DBLine["responsible_party"];
			$cClassParams['cClassCertVerbiage']			= $oDB->DBLine["cert_verbiage"];						
			$bClassParams['bClassFieldComments']		= $oDB->DBLine["field_comments"];	
			$bClassParams['bClassFieldFacility']		= $oDB->DBLine["field_facility"];
			$bClassParams['bClassFieldDept']			= $oDB->DBLine["field_dept"];
			$bClassParams['bClassFieldAddroom']			= $oDB->DBLine["field_addroom"];	
			$bClassParams['bClassFieldMail']			= $oDB->DBLine["field_mail"];	
			$bClassParams['bClassFieldEMail']			= $oDB->DBLine["field_email"];
			$bClassParams['bClassFieldTStatus']			= $oDB->DBLine["field_training_status"];
			$bClassParams['bClassFieldETrax']			= $oDB->DBLine["field_etrax"];
			$bClassParams['bClassFieldUKStatus']		= $oDB->DBLine["field_uk_status"];
			$bClassParams['bClassFieldUKID']			= $oDB->DBLine["field_ukid"];
			$bClassParams['bClassFieldSuper']			= $oDB->DBLine["field_supervisor"];
			$bClassParams['bClassFieldPhone']			= $oDB->DBLine["field_phone"];		
			$bClassSetHidden							= $oDB->DBLine["hidden"];	
			$cClassQLayout								= $oDB->DBLine["question_layout"];	
			$cClassQOrder								= $oDB->DBLine["display_order"];
			$cClassQQuantity							= $oDB->DBLine["question_quantity"];		
						
			foreach($bClassParams as &$value)
			{			
				if($value){ $value = "checked='checked'"; }
			}
			unset($value);
			
			/* Execute title query.	*/
			$query = "SELECT
			*
			FROM 		tbl_list_class_type
			WHERE		class_type_id = ?";			
			
			$oDB->db_basic_select($query, array(&$cClassID), TRUE);
			
			$cClassTitle	= $oDB->DBLine["class_type_name"];															
						
			/* Execute users query.	*/
			$query = "SELECT
				*
				FROM 		tbl_class_train_users
				WHERE		fk_class_train_parameters_guid_id = ?";			
			
			$oDB->db_basic_select($query, array(&$quiz_guid_id), TRUE);					
			
			$oAcc_acct	.= ", " .$oDB->DBLine["account"];
			$oAcc_type	= $oDB->DBLine["type"];																			
		
			/* Execute questions/answers query. */
			$cQuestions = class_quiz_questions_0003($quiz_guid_id);		
			
			
			
			/* Populate responsible party list.	*/
			$query = "SELECT DISTINCT 
						guid_id, 
						trainer_lname + ', ' + trainer_fname AS name 
			FROM 		tbl_class_trainer 
			ORDER BY 	name";
			
			$cResponsiblePartyLst = $oDL->dl_general($query, NULL, "None", $cClassCertParty, TRUE, array("None" => FALSE_GUID));		
						
			/*
			Populate users list.
			*/
			$query = "SELECT *
			FROM 		tbl_class_train_users
			WHERE		fk_class_train_parameters_guid_id = '$quiz_guid_id'
			ORDER BY	account";	
					
			$result = sqlsrv_query($db_conn, $query, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));				//Execute query.						
			
			$i = 0;		    						
			while($line = sqlsrv_fetch_array($result))
			{
				
				$cAccounts .= "
				<tr>
                	<td>
					  <form id='frm_account_'".$line["guid_id"]."' name='frm_account' method='post' action='".$_SERVER['PHP_SELF']."'>
					  	<input type='hidden' name='EditMode' value='2'  />
						 <input type='hidden' name='id_guid' id='id_guid_'".$line["guid_id"]."' value='".$line["guid_id"]."' />
							<table width='100%' border='0' cellspacing='0' cellpadding='4' bgcolor='".back_alt_0001(++$i)."'>
							  <tr>
								<td><input type='text' name='frm_txt_account' id='frm_txt_account' value ='".$line["account"]."' style='width:100%'/></td>
								<td width='10%' align='center'><input type='image' src='/media/image/icon_save_0001.png' name='frm_btn_account_save' id='frm_btn_save_ans_".$line["guid_id"]."' value='Save' /></td>
								<td width='10%' align='center'><input type='image' src='/media/image/icon_delete_0001.png' name='frm_btn_account_delete' id='frm_btn_delete_ans_".$line["guid_id"]."' value='Delete' /></td>
							  </tr>
						</table>
					  </form>
					</td>
                </tr>";	
			}
			
			$cAccounts .= "<tr>
                	<td>
					  <form id='frm_account_new' name='frm_account' method='post' action='".$_SERVER['PHP_SELF']."'>
					  	<input type='hidden' name='EditMode' value='2'  />
							<table width='100%' border='0' cellspacing='0' cellpadding='4' bgcolor='".back_alt_0001(++$i)."'>
							  <tr>
								<td><input type='text' name='frm_txt_account' id='frm_txt_account' style='width:100%'/></td>
								<td width='20%' align='center'><input type='image' src='/media/image/icon_save_0001.png' name='frm_btn_account_add' id='frm_btn_save_ans_".$line["guid_id"]."' value='Save' /></td>
							  </tr>
						</table>
					  </form>
					</td>
                </tr>";
			
			/*
			Defaults
			*/					
			if(!$bClassSetHidden){	 	$bClassSetHidden 	= 0;	}	
			if(!$cClassQLayout){		$cClassQLayout		= 0;	}	
			if(!$cClassQOrder){			$cClassQOrder		= 0;	}				
		
		sqlsrv_close($db_conn);	//Close DB connection.
		}		
	}
		
?> 

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Environmental Health And Safety, <?php echo $cClassTitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="/libraries/css/style.css" type="text/css" />

<link rel="stylesheet" href="/libraries/css/print.css" type="text/css" media="print" />
<script language="Javascript" type="text/javascript" src="/libraries/div_update_0001.js"></script>
<script type="text/javascript">

	function confirmSubmit()
		{
		var agree=confirm("Are you sure <?php echo @$_SESSION['access_name_f']; ?>?");
		if (agree)
			return true ;
		else
			return false ;
		}

   	function setCheckedValue(radioObj, newValue) 
	{
		if(!radioObj)
			return;
		var radioLength = radioObj.length;
		if(radioLength == undefined) 
		{
			radioObj.checked = (radioObj.value == newValue.toString());
			return;
		}
		for(var i = 0; i < radioLength; i++) 
		{
			radioObj[i].checked = false;
			if(radioObj[i].value == newValue.toString()) {
				radioObj[i].checked = true;
			}
		}
	}
   
    function toggle_visibility(val) {
       var div1 = document.getElementById("parameters");
	   var div2 = document.getElementById("questions");
	   var div3 = document.getElementById("access");
	   
       
	   if(val == 0)
	   {
		div1.style.display = 'block'; 
		div2.style.display = 'none'; 
		div3.style.display = 'none';   				   
	   }
	   else if(val == 1)
       {
	    div1.style.display = 'none'; 
		div2.style.display = 'block'; 
		div3.style.display = 'none';   	
	   }
	   else if(val == 2)
       {
	    div1.style.display = 'none'; 
		div2.style.display = 'none'; 
		div3.style.display = 'block';  	
	   }	  
    }
	

function toggle_visibility_run()
{
  toggle_visibility('<?php echo $cEditMode; ?>')
}

function setCheckedValue_run()
{	
	setCheckedValue(document.forms['EditMode'].elements['EditSel'], '<?php echo $cEditMode; ?>');
}

function setCheckedValue_bClassSetHidden_run()
{	
	setCheckedValue(document.forms['class_parameters'].elements['bClassSetHidden'], '<?php echo $bClassSetHidden; ?>');
}

function setCheckedValue_cClassQOrder_run()
{	
	setCheckedValue(document.forms['class_parameters'].elements['cClassQOrder'], '<?php echo $cClassQOrder; ?>');
}

function setCheckedValue_cClassQLayout_run()
{	
	setCheckedValue(document.forms['class_parameters'].elements['cClassQLayout'], '<?php echo $cClassQLayout;?>');
}

function addLoadEvent(func) 
{
  var oldonload = window.onload;
  
  if (typeof window.onload != 'function') 
  {
  	window.onload = func;
  } else {
    window.onload = function() {
      if (oldonload) {
        oldonload();
      }
      func();
    }
  }
}

addLoadEvent(setCheckedValue_run);
addLoadEvent(setCheckedValue_bClassSetHidden_run);
addLoadEvent(setCheckedValue_cClassQOrder_run);
addLoadEvent(setCheckedValue_cClassQLayout_run);
addLoadEvent(toggle_visibility_run);
</script>

<link href="../../libraries/css/style.css" rel="stylesheet" type="text/css" />
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
        	

          <h1>Training Module Administration</h1>        
          <br />
          
          <table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#F0F0FF">
            <tr>
              <th>Edit Select</th>
            </tr>
            <tr>
              <td><form action="<?php echo $_SERVER['../PHP_SELF']; ?>" method="post" entype="multipart/form-data" name="class_type" id="form">
                    <select type='select' name='cClassID' id='form_droplist' style="width:85%">
                          <?php echo $cClassLst; ?>
                    </select>	
                        <input name="Select" type="Submit" value="Select" />
                    </form></td></td>
                 
                    
          	<tr align="center"><td><form name="EditMode" method="get" action="">
            	<label>
              		<input name="EditSel" type="radio" id="EditMode0" value="0" onClick="toggle_visibility(this.value)" />
              Parameters</label>
                    <label>
                    <input name="EditSel" type="radio" id="EditMode1" value="1" onClick="toggle_visibility(this.value)" />
                      Questions</label>	
                    <label>
                    <input name="EditSel" type="radio" id="EditMode2" value="2" onClick="toggle_visibility(this.value)" />
                      Access</label> 
             </form></td> </tr>
          </table>
             <br /><hr />
             <p>              
  <?php
if($bShowMain==1)
{
?>
             </p>
             <p>No module associated with your class selection. Please make another selection or press OK to start a module for this class.</p>
             <form id="frm_class_new" name="frm_class_new" method="post" action="<?php $_SERVER['../PHP_SELF']; ?>">               
               <input type="submit" name="frm_button_class_add" id="frm_button_class_add" value="OK" />
             </form>             
             <p></p>
  <?php
}
else if($bShowMain==2)
{	
?>
                    
             </p>             
             
             Click <a href="/classes/class_main_0001.php?cClassID=<?php echo $cClassID; ?>" target="_blank">here</a> to view module.
             <br /><br />
             
          <div id="parameters">
            <form action="<?php $_SERVER['../PHP_SELF']; ?>" method="post" entype="multipart/form-data" name="class_parameters" id="form">
    <input type="hidden" name="cClassID" value="<?php echo $cClassID; ?>" />							
				<table width="100%" height="84" border="0" cellpadding="2" cellspacing="0" bgcolor="#F0F0FF">
					<tr>
					    <th colspan="2"><?php echo $cClassTitle; ?> Parameters</th>
			      	</tr>
					<tr bgcolor="#DDDDFF">
					  	<td width="36%">Access</td>
				  	  <td width="64%">
			  	    	<input type="radio" name="bClassSetHidden" id="bClassSetHidden0" value="0" /><label for="bClassSetHidden">Public</label>
                        <input type="radio" name="bClassSetHidden" id="bClassSetHidden1" value="1" /><label for="bClassSetHidden">Hidden</label>
                        <input type="radio" name="bClassSetHidden" id="bClassSetHidden2" value="2" checked="checked" /><label for="bClassSetHidden">Restricted</label>
                      </td>
				  	</tr>
					<tr>
					  <td>Question Order</td>
					  <td><input name="cClassQOrder" type="radio" id="cClassQOrder0" value="0" checked="checked"/>
              Linear</label>
                    <label>
                      <input name="cClassQOrder" type="radio" id="cClassQOrder1" value="1"/>
                      Manual
                    </label>	
                    <label>
                      <input name="cClassQOrder" type="radio" id="cClassQOrder2" value="2"/>
                    Random</label></td>
				  </tr>
					<tr bgcolor="#DDDDFF">
					  <td>Question Layout</td>
					  <td><label>
              <input name="cClassQLayout" type="radio" id="cClassQLayout0" value="0" checked="checked"/>
              List
                    </label>
                      <label>
                      <input name="cClassQLayout" type="radio" id="cClassQLayout1" value="1"/>
                      Paged</label></td>
				  </tr>
					<tr>
					  <td>Question Quantity</td>
					  <td><select name='frm_lst_cClassQQuantity' id='frm_lst_cClassQQuantity'>
						<?php echo $cQueQuantityLst; ?>
					</select></td>
				  </tr>
                    <tr bgcolor="#DDDDFF">
					  	<td>Registration Fields</td>
					  	<td><input type="checkbox" name="bClassFieldComments" id="form_check" <?php echo $bClassParams['bClassFieldComments']; ?> />
				  	    	<label for="form_check_label">Comments</label>
                            
                            <br />
                            <input type="checkbox" name="bClassFieldFacility" id="form_check" <?php echo  $bClassParams['bClassFieldFacility']; ?> />
			  	    	  <label for="form_check_label">Facility/Room</label>
                            
                          <br />
                          <input type="checkbox" name="bClassFieldAddroom" id="form_check" <?php echo  $bClassParams['bClassFieldAddroom']; ?> />
			  	    	  <label for="form_check_label">Additional Labs/Rooms</label>
                            
                          <br />
                          <input type="checkbox" name="bClassFieldDept" id="form_check" <?php echo  $bClassParams['bClassFieldDept']; ?> />
			  	    	  <label for="form_check_label">Department</label>
                            
                          <br />
                          <input type="checkbox" name="bClassFieldMail" id="form_check" <?php echo  $bClassParams['bClassFieldMail']; ?> />
			  	    	  <label for="form_check_label">Mail</label>
                            
                          <br />
                          <input type="checkbox" name="bClassFieldEMail" id="form_check" <?php echo  $bClassParams['bClassFieldEMail']; ?> />
			  	    	  <label for="form_check_label">E-Mail</label>
                            
                          <br />
                          <input type="checkbox" name="bClassFieldTStatus" id="form_check" <?php echo  $bClassParams['bClassFieldTStatus']; ?> />
			  	    	  <label for="form_check_label">Training Status</label>
                            
                          <br />
                          <input type="checkbox" name="bClassFieldETrax" id="form_check" <?php echo  $bClassParams['bClassFieldETrax']; ?> />
			  	    	  <label for="form_check_label">Request Etrax</label>
                        
                   	      <br />
                   	      <input type="checkbox" name="bClassFieldUKStatus" id="form_check" <?php echo  $bClassParams['bClassFieldUKStatus']; ?> />
			  	    	  <label for="form_check_label">UK Status</label>
                            
                            <br />
                            <input type="checkbox" name="bClassFieldUKID" id="form_check" <?php echo  $bClassParams['bClassFieldUKID']; ?> />
			  	    	  <label for="form_check_label">UK ID</label>
                            
                          <br />
                          <input type="checkbox" name="bClassFieldSuper" id="form_check" <?php echo  $bClassParams['bClassFieldSuper']; ?> />
			  	    	  <label for="form_check_label">PI/Supervisor</label>
                            
                          <br />
                          <input type="checkbox" name="bClassFieldPhone" id="form_check" <?php echo  $bClassParams['bClassFieldPhone']; ?> />
				  	    	<label for="form_check_label">Phone</label>
                        
                        </td>
				  	</tr>    
                    <tr>
						<td>Email List</td>
					    <td><textarea name="cClassEmail" rows="2" id="form_memo"><?php echo $cClassParams['cClassEmail']; ?></textarea></td>
				    </tr>                    
					<tr bgcolor="#DDDDFF">
					    <td>Introduction</td>
					    <td><textarea name="cClassIntro" rows="4" id="form_memo"><?php echo $cClassParams['cClassIntro']; ?></textarea></td>
			      	</tr>
					<tr>
				  	  <td>Material Above (Header)</td>
				  	  <td><textarea name="cClassMaterialAboveHead" rows="2" id="form_memo"><?php echo $cClassParams['cClassMaterialAboveHead']; ?></textarea></td>
				  	</tr>	
                    <tr bgcolor="#DDDDFF">
				  	  <td>Material Above</td>
				  	  <td><textarea name="cClassMaterialAbove" rows="4" id="form_memo"><?php echo $cClassParams['cClassMaterialAbove']; ?></textarea></td>
				  	</tr>
                    <tr>
					  	<td>Instructions (Header)</td>
					  	<td><textarea name="cClassInstrHead" rows="2" id="form_memo"><?php echo $cClassParams['cClassInstrHead']; ?></textarea></td>
				  	</tr>	
                    <tr bgcolor="#DDDDFF">
					  	<td>Instructions</td>
					  	<td><textarea name="cClassInstr" rows="8" id="form_memo"><?php echo $cClassParams['cClassInstr']; ?></textarea></td>
			  	  </tr>	
                    <tr>
				  	  <td>Material Below (Header)</td>
				  	  <td><textarea name="cClassMaterialBelowHead" rows="2" id="form_memo"><?php echo $cClassParams['cClassMaterialBelowHead']; ?></textarea></td>
				  	</tr>	
                    <tr bgcolor="#DDDDFF">
				  	  <td>Material Below</td>
				  	  <td><textarea name="cClassMaterialBelow" rows="4" id="form_memo"><?php echo $cClassParams['cClassMaterialBelow']; ?></textarea></td>
				  	</tr>
                    <tr>
					  	<td>Certificate (Responsible Party)</td>
					  	<td><select name="frm_lst_cClassCertParty" id="form_memo"><?php echo $cResponsiblePartyLst; ?></select></td>
				  	</tr> 
                    <tr bgcolor="#DDDDFF">
					  	<td>Certificate (Verbiage)</td>
					  	<td><textarea name="cClassCertVerbiage" rows="4" id="form_memo"><?php echo $cClassParams['cClassCertVerbiage']; ?></textarea></td>
				  	</tr>                                                                         			      
              </table>					
					<p>
					  <input type="submit" name="Save_Parameters" id="form_button" value="Save Parameters" />
</p>
			</form>
</div>
                
                <div id="questions">                
                    <table width="100%" border="0" cellspacing="0" cellpadding="1">
                      <tr>
                        <th width="100%"><?php echo $cClassTitle; ?> Questions</th>
                      </tr>
                    </table>              
                
                	<?php echo $cQuestions;	?>
                </div>
                
                <div id="access">                
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <th>Access Accounts</th>
                </tr>
                <?php echo $cAccounts; ?>
              </table><br />
                </div>                
<?php
	}
	else
	{				
?>						            
		<p>Please select a class module.</p>
<?php			 
	}
?>
            	 
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