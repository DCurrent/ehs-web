<?php

	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/database/main.php'); 	// Database class.

	// Base answer class.
	class answer_fields
	{
		// Note, data members are matched by name to fields in
		// answers table. This allows us to populate a object
		// directly from database.				
		private 
			$id 			= NULL,
			$fk_id 			= NULL,
			$display_order		= NULL,
			$text				= NULL,
			$correct			= NULL,
			$picture			= NULL,
			$log_update 		= NULL,
			$log_update_account	= NULL,
			$log_update_ip		= NULL;
		
		// Accessors	
		public
			function id()
			{
				return $this->id;
			}
			
			function fk_id()
			{
				return $this->fk_id;
			}
			
			function display_order()
			{
				return $this->display_order;
			}
			
			function text()
			{
				return $this->text;
			}
			
			function correct()
			{
				return $this->correct;
			}
			
			function picture()
			{
				return $this->picture;
			}
			
			function log_update()
			{
				return $this->log_update;
			}
			
			function log_update_account()
			{
				return $this->log_update_account;
			}
			
			function log_update_ip()
			{
				return $this->log_update_ip;
			}
			
		// Mutators
		public
			function set_id($value)
			{
				$this->id = $value;
			}
			
			function set_fk_id($value)
			{
				return $this->fk_id = $value;
			}
			
			function set_display_order($value)
			{
				return $this->display_order = $value;
			}
			
			function set_text($value)
			{
				return $this->text = $value;
			}
			
			function set_correct($value)
			{
				return $this->correct = $value;
			}
			
			function set_picture($value)
			{
				return $this->picture = $value;
			}
			
			function set_log_update($value)
			{
				return $this->log_update = $value;
			}
			
			function set_log_update_account($value)
			{
				return $this->log_update_account = $value;
			}
			
			function set_log_update_ip($value)
			{
				return $this->log_update_ip = $value;
			}
			
		// Populate datamembers from $_POST.
		public function populate_from_post()
		{
			// Interate through each data member in target object.
			foreach($this as $key => $value) 
			{					
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the POST value. 
				if(isset($_POST[$key]))
				{					
					$this->$key = $_POST[$key];           						
				}				
			}
		} 
	}
	
	class answer_list
	{
		private
			$db_m		= NULL,
			$query_m 	= NULL, 	// Query object.
			$fk_int		= NULL,		// Foreign key.
			$result_m	= array();	// List of answer objects.
		
		public function __construct()
		{
			$this->db_m = new class_db_connection();
			$this->query_m = new class_db_query($this->db_m);			
		}
		
		// Access methods
		public function result()
		{
			return $this->result_m;
		}
		
		// Mutate methods.
		public			
			function set_fk($value)
			{ 
				$this->fk_int = $value;
			}
		
		// Get answer list, will retrieve from database if not set already.
		public function get_answer_list()
		{
			$list = array();
			
			if(isset($_SESSION['ANSWER_LIST'])) $list = $_SESSION['ANSWER_LIST'];
			
			if($list)
			{						
				$this->result_m = $list;
			}
			else
			{
				$this->set_from_db();				
			}			
			
			//$_SESSION['ANSWER_LIST'] = $this->result_m;
		}
		
		// Populate object array from database. This will be called when page is opened but
		// working array is empty. 
		public function set_from_db()
		{		
			// Dereference datamember.
			$query = $this->query_m;
			try
			{
				if(!$query) throw new Exception('Missing query object.');
				
				$query->set_sql('SELECT * FROM tbl_class_train_answers WHERE fk_id = ? ORDER BY value');
				$query->set_params(array(&$this->fk_int));
				$query->query();
				
				if($query->get_row_exists())
				{				
					$query->get_line_params()->set_class_name('answer_fields');
					$this->result_m = $query->get_line_object_all();
					
					// Reset class name for next use of query object.
					$query->get_line_params()->set_class_name(NULL);
				}
			}
			catch(Exception $e)
			{
				trigger_error($e->getMessage().', File: '.$e->getFile(), E_USER_ERROR);
			}
			
			return $this->result_m;
		}
	}
	
	class answer_update 
	{
		
		private					
			$db_m			= NULL,
			$query_m 		= NULL,			
			$result_m		= NULL,
			$input_m		= NULL,
			
			$fk_id		= NULL,
			$answer_id 		= array(),
			$answer_text	= array();
			
		public function __construct()
		{
			$this->db_m = new class_db_connection();
			$this->query_m = new class_db_query($this->db_m);
			
			$this->input_m = new answer_fields();
			$this->input_m->populate_from_post();
		}
		
		// Access methods.
		public
			function result()
			{
				return $this->result_m;
			}
			
		public
			function input()
			{
				return $this->input_m;
			}
		
		public function send_to_db()
		{
			if($this->fk_id)
			{
				return;
			}
			
			$line_obj 	= NULL;	// Line object returned from query.
			
			// Dereference data members.
			$input = $this->input_m;
			$query = $this->query_m;
			
			// Since the user may have removed answers, let's clean out all answers related
			// to this question id. 
			$query->set_sql("DELETE FROM tbl_class_train_answers WHERE fk_id = ?");
			$query->query();
			
			
			$query->set_sql("MERGE INTO tbl_class_train_answers
				USING 
					(SELECT ? AS id_col) AS SRC
				ON 
					tbl_class_train_questions.fk_id = SRC.id_col
				WHEN MATCHED THEN
					UPDATE SET
						correct				= ?,
						text				= ?,
						log_update			= ?,
						log_update_account	= ?,
						log_update_ip		= ?
				WHEN NOT MATCHED THEN
					INSERT (fk_id, correct, text, log_update, log_update_account, log_update_ip)
					VALUES (?, ?, ?, ?, ?, ?)
					OUTPUT INSERTED.*;");			
		
			$query->set_params(array(
						// UPDATE
						$input->id(),
						$input->fk_id(),
						$input->display_order(),
						$input->title(),
						$input->intro(),
						$input->response_right(),
						$input->response_wrong(),
						$input->text(),
						$input->log_update(),
						$input->log_update_account(),
						$input->log_update_ip(),
						// INSERT
						$input->fk_id(),
						$input->display_order(),
						$input->title(),
						$input->intro(),
						$input->response_right(),
						$input->response_wrong(),
						$input->text(),
						$input->log_update(),
						$input->log_update_account(),
						$input->log_update_ip()));
			
			$query->query();
			
			$query->get_line_params()->set_class_name('question_fields');
			$this->result_m = $query->get_line_object();			
			
			return $this->result_m;
		}
	}
	
	// Update database from array of answer objects.
	
	
	/*
		// Answer update.
		private					
			$query_m 		= NULL,	
			$ans_object		= NULL,		
			$ses_values_m	= array();
		
		public function __construct()
		{
			// Initialize DB connection and query objects.
			$this->ans_object = new tbl_class_train_answers();
						
			if(isset($_SESSION[SESSION_KEYS::A_UPDATES]))
			{			
				//$this->ses_values_m	= $_SESSION[SESSION_KEYS::A_UPDATES];
				
				$this->ses_values_m[] = new tbl_class_train_answers();
								
				$this->ses_values_m[0]->set_id(5000);
				$this->ses_values_m[0]->set_fk_id(6000);	
				$this->ses_values_m[0]->set_text('Test answer 0');
				
				$this->ses_values_m[] = new tbl_class_train_answers();
				
				$this->ses_values_m[1]->set_id(5001);
				$this->ses_values_m[1]->set_fk_id(6001);	
				$this->ses_values_m[1]->set_text('Test answer 1');
				$this->ses_values_m[1]->set_correct(TRUE);			
			}
			
			$this->ses_values_m[] = new tbl_class_train_answers();
								
			$this->ses_values_m[0]->set_id(5000);
			$this->ses_values_m[0]->set_fk_id(6000);	
			$this->ses_values_m[0]->set_text('Test answer 0');
			
			$this->ses_values_m[] = new tbl_class_train_answers();
			
			$this->ses_values_m[1]->set_id(5001);
			$this->ses_values_m[1]->set_fk_id(6001);	
			$this->ses_values_m[1]->set_text('Test answer 1');
			$this->ses_values_m[1]->set_correct(TRUE);
		}		
		
		// Get answers output array.
		public function answers()
		{
			return $this->ses_values_m;
		}
		
		public function answer_count()
		{
			return count($this->ses_values_m);
		}
		
		// Set question id.
		public function set_foreign_key($value)
		{
			$this->ans_object->set_fk_id($value);
		}
		
		// Add new blank answer to answers array.
		public function add_answer()
		{
			$id = ITEM_ID::FRESH;	// New key.
			
			// We want to make sure that when the array is UPSERTED to database
			// none of the new entries will have an ID match. We'll start with -1 and
			// keep decrementing until we find an unused ID. When UPSERTED, the database
			// will find no matches for these added entries and INSERT them as new records
			// with properly assigned IDs.
			foreach($this->ses_values_m as $current)
			{
				if($current->fk_id() >= $id) $id--;
			}			
			
			$object = new tbl_class_train_answers();
			$object->set_fk_id($id);
			
			$this->ses_values_m[] = new tbl_class_train_answers();
		}
		
		// Remove answer from answers array by answer id.
		public function remove_answer($value)
		{	
			echo '<br /><br />remove_answer';
								
			foreach($this->ses_values_m as $object)
			{
				// Debug.
				echo '<br />key:    '.$key;
				echo '<br />id: '.$object->id();
				
				if($object->id() == $value)
				{					
				//	unset($this->ses_values_m[$key]);
				}
			}
			
			$_SESSION[SESSION_KEYS::A_UPDATES] = $this->ses_values_m;
		}
		
		// Populate answer output array as nessesary.
		public function populate_answers()
		{
			// Debug.
			echo '<br /><br />Populate answers';
			
			// If array hasn't been populated from previous session, then get values from database.
			if(!$this->ses_values_m)
			{
				echo '<br />Getting database values.'; 
				$this->populate_from_db();
			}		
		}
				
		// Populate answers object array from database. This will be called when page is opened but
		// working array is empty. 
		private function populate_from_db()
		{	
			// Dereference datamember.
			$query = $this->query_m;
			
			$query->set_sql('SELECT * FROM tbl_class_train_answers WHERE fk_id = ? ORDER BY value');
			$query->set_params(array(&$this->fk_id));
			$query->query();
			
			if($query->get_row_exists())
			{				
				$query->get_line_params()->set_class_name('tbl_class_train_answers');
				$this->ses_values_m = $query->get_line_object_all();
				
				// Reset class name for next use of query object.
				$query->get_line_params()->set_class_name(NULL);
			}		
		}
		
		// Populate array from POST values. This is done just before we save to
		// a database, as it will ensure the most recent values from user.
		public function populate_from_post()
		{
			$correct = NULL;
			
			$this->ses_values_m = array(); // Reset answers array.
						
			if(isset($_POST['a_correct'])) $correct = $_POST['a_correct'];
			
			echo '<br />correct : '.$correct;
			
			foreach($_POST as $key => $value) 
			{
				$object = new tbl_class_train_answers();
										
				if(strpos($key, 'a_id') !== FALSE)
				{				
					if(isset($_POST['a_id_'.$value])) $object->set_id($_POST['a_id_'.$value]);				
					if(isset($_POST['a_text_'.$value])) $object->set_text($_POST['a_text_'.$value]);				
	
					// Correct is a radio button shared by every answer, so we cannot give it a unique name.
					// Instead each button's value is the ID of its answer. We know if selected that is meant
					// to be the correct answer, so we'll compare it to the current loop id. If they match,
					// this is the correct answer. Set a value of TRUE to send to the correct field in database.
					// Otherwise we send a fale value.
					if($correct == $object->id()) 
					{
						$object->corect() = TRUE;
					}
					else
					{
						$object->corect() = FALSE;
					}				
				
					// Add object to array.
					$this->ses_values_m[] = $object;	
					
					echo '<br />o id : '.$object->id();
					echo '<br />o text   : '.$object->text();
					echo '<br />o correct: '.$object->corect();			
				}			
			}
			
			echo '<br />';
		}
		
		// Save answers from session array of objects into database.
		public function save_answers()
		{			
			// Dereference query object.
			$query = $this->query_m;
					
			// Before we do anything, make sure there is a foreign key set.
			if(!$this->ans_object->fk_id()) return FALSE;
			
			// Query setup. We're going to run this several times, so we'll use a prepared query
			// for effciancy.
			$query->set_sql("MERGE INTO tbl_class_train_answers
				USING 
					(SELECT ? AS id_col) AS SRC
				ON 
					tbl_class_train_answers.id = SRC.id_col
				WHEN MATCHED THEN
					UPDATE SET
						fk_id			= ?,
						correct				= ?,
						text				= ?
				WHEN NOT MATCHED THEN
					INSERT (fk_id, correct, text)
					VALUES (?, ?, ?)
					OUTPUT INSERTED.id;");		
		
			$query->set_params(array($this->id(),
						$this->fk_id,
						$this->corect(),
						$this->text(),
						$this->fk_id,
						$this->corect(),
						$this->text()));
						
			$query->prepare();		
		
			echo '<br />fk_id: '.$this->fk_id;
		
			// Loop through array of objects.
			foreach ($this->ses_values_m as $ses_value)
			{
				// Update bound parameters with current array object's values.
				$this->ans_object->set_id($ses_value->id);
				$this->ans_object->set_text($ses_value->text);
				$this->ans_object->set_correct($ses_value->correct);
			
								
				echo '<br />text   : '.$this->ans_object->text();
				echo '<br />correct: '.$this->ans_object->corect();
				echo '<br />id : '.$this->ans_object->id();				
				
				// Execute the prepared query.
				$query->execute();
			}		
		}
	}
*/
?>