<?php

/* Handle user events */
	if($utl->utl_get_post('Save_Parameters'))					//Save class parameters.
	{	
		$bClassSetHidden			= $utl->utl_get_post('bClassSetHidden');	
		$cClassQLayout				= $utl->utl_get_post('cClassQLayout');
		$cClassQOrder				= $utl->utl_get_post('cClassQOrder');
		$cClassQQuantity			= $utl->utl_get_post('frm_lst_cClassQQuantity');
		$cClassCertParty			= $utl->utl_get_post('frm_lst_cClassCertParty');

		/* Get string type post parameters. */
		$cClassParams = array(
			"cClassEmail"				=> $utl->utl_get_post('cClassEmail'),
			"cClassIntro"				=> $utl->utl_get_post('cClassIntro'),
			"cClassMaterialAboveHead"	=> $utl->utl_get_post('cClassMaterialAboveHead'),
			"cClassMaterialAbove"		=> $utl->utl_get_post('cClassMaterialAbove'),
			"cClassMaterialBelowHead"	=> $utl->utl_get_post('cClassMaterialBelowHead'),
			"cClassMaterialBelow"		=> $utl->utl_get_post('cClassMaterialBelow'),
			"cClassInstrHead"			=> $utl->utl_get_post('cClassInstrHead'),
			"cClassInstr"				=> $utl->utl_get_post('cClassInstr'),
			"cClassCertVerbiage"		=> $utl->utl_get_post('cClassCertVerbiage')
			);

		/* Get checkmark type post parameters. */
		$bClassParams = array(
			"bClassFieldComments" 	=> $utl->utl_get_post('bClassFieldComments'),
			"bClassFieldFacility" 	=> $utl->utl_get_post('bClassFieldFacility'),
			"bClassFieldDept"		=> $utl->utl_get_post('bClassFieldDept'),
			"bClassFieldAddroom"	=> $utl->utl_get_post('bClassFieldAddroom'),
			"bClassFieldMail"		=> $utl->utl_get_post('bClassFieldMail'),
			"bClassFieldEMail"		=> $utl->utl_get_post('bClassFieldEMail'),
			"bClassFieldTStatus"	=> $utl->utl_get_post('bClassFieldTStatus'),
			"bClassFieldETrax"		=> $utl->utl_get_post('bClassFieldETrax'),
			"bClassFieldUKStatus"	=> $utl->utl_get_post('bClassFieldUKStatus'),
			"bClassFieldUKID"		=> $utl->utl_get_post('bClassFieldUKID'),
			"bClassFieldSuper"		=> $utl->utl_get_post('bClassFieldSuper'),
			"bClassFieldPhone"		=> $utl->utl_get_post('bClassFieldPhone')				
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
						question_order			= ?,
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
	else if($utl->utl_get_post("frm_button_class_add"))		//New module.
	{		
		$query = "INSERT INTO tbl_class_train_parameters 
		
			(quiz_id) VALUES (?)";
				
		$oDB->db_basic_action($query, array(&$cClassID));
										
	}
	else if($utl->utl_get_post("frm_btn_que_save"))			//Updating questions.
	{					
		$cIDGuid				= $utl->utl_get_post("id_guid");				//Guid ID of record.
		$cQuestionOrder			= $utl->utl_get_post("frm_lst_order");			//Question order.
		$cQuestionVal			= $utl->utl_get_post("frm_ta_question_val");	//Question value.
		$cQuestionRightAnswer	= $utl->utl_get_post("frm_lst_right_answer");	//Correct answer.
		
		/* Construct question update query */				
		$query = "UPDATE tbl_class_train_questions
		
		SET 	
			question_order			= ?,							
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
	else if($utl->utl_get_post("frm_btn_que_add"))				//Add question.
	{					
		$cQuestionOrder			= $utl->utl_get_post("frm_lst_order");			//Question order.
		$cQuestionVal			= $utl->utl_get_post("frm_ta_question_val");	//Question value.
		$cQuestionRightAnswer	= $utl->utl_get_post("frm_lst_right_answer");	//Correct answer.
		
		/* Construct question insert query */				
		$query = "INSERT INTO tbl_class_train_questions 
	
			(fk_tbl_class_train_parameters_guid_id, 
			question_order, 
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
	else if($utl->utl_get_post("frm_btn_que_delete"))			//Delete question.
	{			
		$cIDGuid				= $utl->utl_get_post("id_guid");							//Guid ID of record.	
		
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
	else if($utl->utl_get_post("frm_btn_ans_save_x"))			//Updating answers.
	{					
		$cIDGuid				= $utl->utl_get_post("id_guid");				//Guid ID of record.
		$cAnswerVal				= $utl->utl_get_post("frm_lst_answer_val");	//Answer value.
		$cAnswerText			= $utl->utl_get_post("frm_ta_answer_text");	//Answer text.
		
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
	else if($utl->utl_get_post("frm_btn_ans_add_x"))			//Adding answer.
	{					
		$cIDGuid				= $utl->utl_get_post("id_guid");				//Guid ID of record.
		$cAnswerVal				= $utl->utl_get_post("frm_lst_answer_val");	//Answer value.
		$cAnswerText			= $utl->utl_get_post("frm_ta_answer_text");	//Answer text.		
		
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
	else if($utl->utl_get_post('frm_btn_ans_delete_x'))		//Delete answer.
	{		
		$cIDGuid				= $utl->utl_get_post("id_guid");	//Guid ID of record.	
		
		/* Construct answer delete query. */		
		$query = "DELETE from tbl_class_train_answers						
			
			WHERE guid_id = ?";
		
		/* Prepare and execute answer delete query. */	
		$oDB->db_basic_action($query, array(&$cIDGuid));									
	}
	else if($utl->utl_get_post("frm_btn_account_save_x"))		//Updating account.
	{					
		$cIDGuid				= $utl->utl_get_post("id_guid");			//Guid ID of record.
		$cAccountText			= $utl->utl_get_post("frm_txt_account");	//account value.
		
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
	else if($utl->utl_get_post("frm_btn_account_add_x"))		//Adding account.
	{					
		$cIDGuid				= $utl->utl_get_post("id_guid");			//Guid ID of record.
		$cAccountText			= $utl->utl_get_post("frm_txt_account");	//account value.
				
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
	else if($utl->utl_get_post('frm_btn_account_delete_x'))	//Delete account.
	{		
		$cIDGuid				= $utl->utl_get_post("id_guid");		//Guid ID of record.	
		
		/* Construct account delete query. */		
		$query = "DELETE from tbl_class_train_users						

			WHERE guid_id = ?";
		
		/* Prepare and execute account delete query. */	
		$oDB->db_basic_action($query, array(&$cIDGuid));									
	}
 ?>