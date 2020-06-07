<?php

interface E_ORDER
{
    const RANDOM	= 0;
    const TABLE 	= 1;
	const USER		= 2;    
}

class class_training_dependencies
{
	/*
	Dependencies data structure.
	*/
	
	public $session 		= NULL;	// Session handler.
	public $database		= NULL;	// Main database.
	public $database_ans	= NULL; // Secondary database object needed to get answers related to each question from main database object.
	public $form			= NULL;	// Forms generator.
	public $filter			= NULL; // Utility functions (input filter) object.
}

class class_training implements E_ORDER
{    

	/*
	constants
	Damon Vaughn Caskey
	2012_12_18
	
	Global constants. 
	*/		
 		
	private $query		= NULL;
	private $params		= NULL;
	private $cTVarsTD	= NULL;	//Class variable ID array.
	private $cTVars		= NULL;
	private $dependencies = NULL;	// Dependency object.
	
	function __construct(class_training_dependencies $dependencies)
	{
		/*
		Constructor
		Damon Vaughn Caskey
		2012_12_29
		
		Class constructor.
		*/
		
		// Initialize dependencies object.
		$this->dependencies = new class_training_dependencies();
		
		// Import dependencies.		
		$this->dependencies->database_ans	= $dependencies->database_ans;
		$this->dependencies->database	= $dependencies->database;
		$this->dependencies->filter		= $dependencies->filter;
		$this->dependencies->form		= $dependencies->form;
				
		// Verify dependencies.
		if(!$this->dependencies->database_ans)	trigger_error("Missing object dependency: Database (Ans).", E_USER_ERROR);
		if(!$this->dependencies->database)		trigger_error("Missing object dependency: Database.", E_USER_ERROR);
		if(!$this->dependencies->form)			trigger_error("Missing object dependency: Forms.", E_USER_ERROR);	
		if(!$this->dependencies->filter)		trigger_error("Missing object dependency: Filter.", E_USER_ERROR);		
	}
	
	public function training_grade()
	{
		$question_count		= 0;
		$QuestionID 		= NULL;
		$QuestionAssigned 	= NULL;
		$cResponse 			= NULL;
		$cQuizGradeStr		= NULL;
		$iQueCnt			= 0;
		$iCorrectCnt		= 0;
		$cPercentage		= 0;
		$cScore				= 0;
		$Result				= NULL;
		$queryQuestion		= NULL;
		$cParamQuestion		= NULL;
		
		// Get array of questions that were assigned to user.
		$QuestionAssigned = $_SESSION['quiz_questions_assigned'];
		
		// Construct question string.
			$queryQuestion = "SELECT 
					text				
				FROM 	tbl_class_train_questions
				WHERE	id = ?";
		
		// Construct answers query string.
			$this->query = "SELECT 
					id,
					correct,
					value,
					text				
				FROM 	tbl_class_train_answers
				WHERE	id = ?
				ORDER BY value";
		
		// We need to make sure we have an array of questions.
		//
		// The array is a list containing the IDs of questions
		// that were assigned to user. We'll need to use those
		// ID's to look up the question from database and
		// compare its correct answer to answer from user.
		
		if(is_array($QuestionAssigned))
		{	
			// First let's find out how many questions were assigned.
			$iQueCnt = count($QuestionAssigned);
			
			//$cQuizGradeStr.= '<ol>';			
			
			// Loop ID of every question that was assigned to user.		
			foreach($QuestionAssigned as $QuestionID)
			{	
				// Increment the question count by 1. This is used
				// as a number label for end user (question 1, question2, ...).
				$question_count++;
				
				// Run query to select the question using
				// current question ID.
				$cParamQuestion = array(&$QuestionID);							
				
				$this->dependencies->database->db_basic_select($queryQuestion, $cParamQuestion);
					
				// Populate line array.
				$this->dependencies->database->db_line();
					
				$cQuizGradeStr.= '<br><div id="question_grade_'.$QuestionID.'_container">'.PHP_EOL
					.'<span class="TrainQuestionHeader">Question '.$question_count.'</span><br />'.PHP_EOL
					//.'<div class="TrainQuestionText">'
					.$this->dependencies->database->DBLine["text"];
					//." - </div>";
							
				// Get question response.
				$cResponse = $this->dependencies->filter->utl_get_post("Q".$QuestionID);
				
				echo PHP_EOL.'<!--Reponse: '.$cResponse.'-->'; 
				
								
				if (!$cResponse)
				{
					$cQuizGradeStr.= '<span class="icon_no color_red">No Answer.</span>';
				}
				else				
				{					
					// Apply parameters.
					$this->params = array(&$cResponse);
					
					// Run query.
					$this->dependencies->database->db_basic_select($this->query, $this->params);
					
					// Populate line array.
					$this->dependencies->database->db_line();
					
					echo '<!--Correct: '.$this->dependencies->database->DBLine["correct"].'-->';
					
					// Is answer correct?
					if ($this->dependencies->database->DBLine["correct"])
					{
						// Increment right count and text.
						$cQuizGradeStr.= '<span class="icon_yes color_green">Correct!</span>';
						$iCorrectCnt++;
					}
					else
					{
						// Wrong text.
						$cQuizGradeStr.= '<span class="icon_no color_red">Incorrect.</span>';					
					}	
				}
				
				// Close list item.
				$cQuizGradeStr.= '</div><!--/'.$QuestionID.'-->'.PHP_EOL;
			}
			
			//$cQuizGradeStr.= "</ol>";
			
			// Calculate grade percentage.
			if($iCorrectCnt > 0 && $iQueCnt > 0)
			{
				$cScore			= $iCorrectCnt / $iQueCnt;
				$cPercentage	= round($cScore*100);
				
				/* Build grading string. */	
				$cQuizGradeStr.= '<br><span class="TrainQuestionHeader">Final Score</span><p><meter low="0.9" optimum="1" value="'.$cScore.'">'.$iCorrectCnt. ' of '.$iQueCnt. '</meter> ('.$cPercentage.'%)</p>';

			}
			
			if($iQueCnt == 0)
			{
				$cScore = 1;
				$cPercentage	= round($cScore*100);
			}
			
						
			// Prepare output array.
			$Result["ans"] 			= $iCorrectCnt;
			$Result["score"]		= $cScore;
			$Result["percentage"] 	= $cPercentage;
			$Result["text"] 		= $cQuizGradeStr;
		}
        
		// Return results.
		return $Result;		
	}
	
	public function training_quiz_questions($cQuizID, $cOrder=NULL, $cQuantity=NULL)
	{
		/*
		training_quiz_questions
		Damon V. Caskey
		2011_11_29
		~2012_12_23: DB Class.
		
		Populate question list and possible answers from database from Quiz ID.
		
		$cQuizID:	Quiz ID to get quiz questions from. 
		*/		
  					
		$cQuizStr 			= NULL;								//Final output string to be placed into page.
		$QuestionID			= NULL;								//Current question ID in question loop.	
		$cQuestionCount		= 0;								//Include ID into question header.		
		$cQuestionRight		= NULL;								
		$QuestionsAssigned	= array();
		
		switch($cOrder)
		{
			default:
			case E_ORDER::RANDOM:
				$cOrder = "ORDER BY	newid()";
				break;
			case E_ORDER::TABLE:
				$cOrder = NULL;
				break;
			case E_ORDER::USER:
				$cOrder = "ORDER BY	display_order";
				break;
		}
		
		$cQuantity = $cQuantity ? "TOP ".$cQuantity : NULL;
		
		/* Construct questions query string. */
		$this->query = "SELECT "
			.$cQuantity
			." id,
				text
			FROM 		tbl_class_train_questions
			WHERE		fk_id = ? AND (record_deleted IS NULL OR record_deleted = 0)"
			.$cOrder;	
		
		// Apply parameters.
		$this->params = array(&$cQuizID);
		
		// Execute questions query.
		$this->dependencies->database->db_basic_select($this->query, $this->params);
		
		// Construct answers query string.
		$this->query = "SELECT 
				id,
				value,
				text				
			FROM 	tbl_class_train_answers
			WHERE	fk_id = ? AND (record_deleted IS NULL OR record_deleted = 0)
			ORDER BY value";
		
		// Apply parameters.
		$this->params = array(&$QuestionID);
		
		while($this->dependencies->database->db_line())
		{
			$QuestionID = $this->dependencies->database->DBLine["id"];
			
			// Get answer set matching current question ID.
			$this->params = array(&$QuestionID);
			
			// Record question to "assigned" array.	
			$QuestionsAssigned[] = $this->dependencies->database->DBLine["id"];
						
			// Build question string.
			$cQuizStr 	.= PHP_EOL
						.'<br>&nbsp;'.PHP_EOL
						.'<div id="question_'.$QuestionID.'_container">'.PHP_EOL
						
						.'<div id="question_'.$QuestionID.'_header">'.PHP_EOL
						.'<span class="TrainQuestionHeader">Question '.++$cQuestionCount.'</span><br />'.PHP_EOL
						//.'<span class="TrainQuestionText">'
						.$this->dependencies->database->DBLine['text']		
						//.'</span>'
						.PHP_EOL.'</div>'.PHP_EOL;			
			
			/* Execute answers query. */
			$this->dependencies->database_ans->db_basic_select($this->query, $this->params);
			
			$cQuizStr .= '<div id="question_'.$QuestionID.'_answer_container">'.PHP_EOL;
			
			while ($this->dependencies->database_ans->db_line())
    		{			
				$cQuizStr	.=	'<input required type="radio" name="Q'
							.$QuestionID
							.'" value="'	
							.$this->dependencies->database_ans->DBLine['id']
							.'" />'
							.'<span class="TrainQuestionAnswerHeader">'									
							.$this->dependencies->database_ans->DBLine['value']
							.')'
							.'</span> '
							//.'<span class="TrainQuestionAnswerText">'										
							.$this->dependencies->database_ans->DBLine['text']
							//.'</span>'
							.'<br />'.PHP_EOL;							
			}
			
			// Close answer container
			$cQuizStr .= '</div>'.PHP_EOL;
			
			// Close question container.
			$cQuizStr .= '</div>'.PHP_EOL;
		}			
		
		if(!$cQuizStr)
		{
			//$cQuizStr = "<h2><span class='alert'>No questions available.</span></h2>";
		}
		
		$_SESSION['quiz_questions_assigned'] = $QuestionsAssigned;
				
		return $cQuizStr;
	}
	
	public function training_class_record($cTrainingParams)
	{		
		/*
		training_class_record_0001
		Damon Vaughn Caskey
		2013-03-27 (Converted to function class_record_0001 include)
		
		Inserts user variables into class participant database.	
		*/
		
		$query		= NULL;	//Query string.
		$params	= NULL;	//Parameter array.
		$cClassID	= NULL;	//Class ID.
		$p_id		= NULL;	//Participant ID.
		$listing_id	= NULL;	//Class listing ID.
		
		/* Build query string. */
		$query ="MERGE INTO tbl_class_participant
		USING 
			(SELECT ? AS Search_Col) AS SRC
		ON 
			tbl_class_participant.account = SRC.Search_Col
		WHEN MATCHED THEN
			UPDATE SET
				name_l				= ?,
				name_f				= ?,									
				room				= ?,
				status				= ?,
				paraquat			= ?,
				paraquat_assured	= ?,
				phone				= ?,									
				department			= ?,
				supervisor_name_f	= ?,
				supervisor_name_l	= ?
		WHEN NOT MATCHED THEN
			INSERT (account, name_l, name_f, room, status, paraquat, paraquat_assured, phone, department, supervisor_name_f, supervisor_name_l)
			VALUES (SRC.Search_Col, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
			OUTPUT INSERTED.id;";		
		
		/* Apply parameters. */
		$params = array(&$cTrainingParams['account'],
						&$cTrainingParams['name_l'],
						&$cTrainingParams['name_f'],
						&$cTrainingParams['room'],
						&$cTrainingParams['status'],
						&$cTrainingParams['paraquat'],
						&$cTrainingParams['paraquat_assured'],
						&$cTrainingParams['phone'],
						&$cTrainingParams['department'],
						&$cTrainingParams['supervisor_name_f'],
						&$cTrainingParams['supervisor_name_l'],
						&$cTrainingParams['name_l'],
						&$cTrainingParams['name_f'],
						&$cTrainingParams['room'],
						&$cTrainingParams['status'],
						&$cTrainingParams['paraquat'],
						&$cTrainingParams['paraquat_assured'],
						&$cTrainingParams['phone'],
						&$cTrainingParams['department'],
						&$cTrainingParams['supervisor_name_f'],
						&$cTrainingParams['supervisor_name_l']);	
		
		var_dump($params);
		
		/* Execute query. */	
		$this->dependencies->database->db_basic_action($query, $params, TRUE);
		
		/* Get ID of created/updated record. */
		$p_id = $this->dependencies->database->DBLine["id"];
				
		/* 	User demographics have now been found or inserted. Now we will deal with class type, instructor and time. */		
		$query = "INSERT INTO	tbl_class
		
								(class_type,
								trainer_id,
								class_date)
					OUTPUT INSERTED.class_id
								VALUES	(?, ?, ?)";	
		
		$params = array(&$cTrainingParams['class'],
			&$cTrainingParams['trainer'],
			&$cTrainingParams['taken']);
						
		/* Execute query. */	
		$this->dependencies->database->db_basic_action($query, $params, TRUE);
		
		/* Get ID of new record. */		
		$cClassID = $this->dependencies->database->DBLine["class_id"];
		
					
		/* Insert newly created id and participant id to class listing table. */		
		$query = "INSERT INTO tbl_class_listing
		
								(participant_id,
								class_id)
					OUTPUT INSERTED.id
								VALUES (?, ?)";	
		
		$params = array(&$p_id,
						&$cClassID);
						
		/* Execute query. */	
		$this->dependencies->database->db_basic_action($query, $params, TRUE);
		
		/* Get ID of new record. */		
		return $this->dependencies->database->DBLine["id"];			  
	}
	
	public function training_vars_get()
	{
		//foreach ($this->cClassVars as $key => $val)
		//{
		//	$this 		
		//}
	}
}

