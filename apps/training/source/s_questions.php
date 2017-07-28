<?php

	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/database/main.php'); 	// Database class.

	// List of fields from training database questions table. Most of these we can autopopulate from post,
	// but a few will need to be set via mutator.
	class question_fields
	{				
		private 
			$id 			= NULL,	// Primary key.
			$fk_id 			= NULL,	// Foreign key (Module ID)
			$display_order		= NULL,	// Order presented to user (if manual order enabled).
			$title				= NULL,	// Name of question.
			$intro				= NULL,	// Introductory text.
			$response_right		= NULL,	// Response to user when question is answered correctly.
			$response_wrong		= NULL,	// Response to user when question is answered incorrectly.
			$text				= NULL,	// Question text.
			$log_update 		= NULL,	// Time updated.	
			$log_update_account	= NULL,	// Update account name.
			$log_update_ip		= NULL;	// Update IP.
		
		// Mutate methods. 
		public 
			function set_id($value)
			{
				$this->id = $value;
			}
			
			function set_fk_id($value)
			{
				$this->fk_id = $value;
			}
			
			function set_log_update($value)
			{
				$this->log_update = $value;				
			}
			
			function set_log_update_account($value)
			{
				$this->log_update_account = $value;
			}
			
			function set_log_update_ip($value)
			{
				$this->log_update_ip = $value;				
			}
		
		// Access methods
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
			
			function title()
			{
				return $this->title;
			}
			
			function intro()
			{
				return $this->intro;
			}
			
			function response_right()
			{
				return $this->response_right;
			}
			
			function response_wrong()
			{
				return $this->response_wrong;
			}
			
			function text()
			{
				return $this->text;
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
	
	class question_update 
	{
		
		private					
			$db_m			= NULL,
			$query_m 		= NULL,			
			$result_m		= NULL,
			$input_m		= NULL;
			
		public function __construct()
		{
			$this->db_m = new class_db_connection();
			$this->query_m = new class_db_query($this->db_m);
			
			$this->input_m = new question_fields();
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
			$line_obj 	= NULL;	// Line object returned from query.
			
			// Dereference data members.
			$input = $this->input_m;
			$query = $this->query_m;
			
			$query->set_sql("MERGE INTO tbl_class_train_questions
				USING 
					(SELECT ? AS id_col) AS SRC
				ON 
					tbl_class_train_questions.id = SRC.id_col
				WHEN MATCHED THEN
					UPDATE SET
						fk_id			= ?,
						display_order		= ?,
						title				= ?,
						intro				= ?,
						response_right 		= ?,
						response_wrong		= ?,
						text				= ?,
						log_update			= ?,
						log_update_account	= ?,
						log_update_ip		= ?
				WHEN NOT MATCHED THEN
					INSERT (fk_id, display_order, title, intro, response_right,	response_wrong,	text, log_update, log_update_account, log_update_ip)
					VALUES (?, ?, ?, ?, ?,	?, ?, ?, ?, ?)
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
	
	// Get single question.
	class question
	{
		private
			$db_m		= NULL,					
			$query_m 	= NULL,
			$id		= NULL,
			$result		= NULL;
		
		public function __construct()
		{
			$this->db_m = new class_db_connection();
			$this->query_m = new class_db_query($this->db_m);
		}
		
		// Access methods.
		public
			function result()
			{
				return $this->result;
			}
		
		// Mutate methods.
		public	
			function set_id($value)
			{
				$this->id = $value;
			}
			
		// Populate single question object from database.
		public function set_from_db()
		{	
			$result = NULL;

			// Defereence data member.
			$query = $this->query_m;

			try
			{
				if(!$query) throw new Exception('Missing query object.');
							
				$query->set_sql('SELECT * FROM tbl_class_train_questions WHERE id = ?');
				$query->set_params(array(&$this->id));
				$query->query();
				
				if($query->get_row_exists())
				{				
					$query->get_line_params()->set_class_name('question_fields');
					$this->result = $query->get_line_object();
					
					// Reset class name for next use of query object.
					$query->get_line_params()->set_class_name(NULL);
				}
				else
				{
					$this->result = new question_fields();
				}
			}
			catch(Exception $e)
			{
				trigger_error($e->getMessage().', File: '.$e->getFile(), E_USER_ERROR);
			}			
		}		
	}
	
	// Get question list.
	class question_list
	{
		private					
			$query_m 	= NULL,
			$fk_int		= NULL,
			$result		= array();
		
		// Access methods.
		public
			function result()
			{
				return $this->result;
			}
		
		// Mutate methods.
		public
			function set_query($value)
			{
				$this->query_m = $value;
			}
		
			function set_fk($value)
			{
				$this->fk_int = $value;
			}
			
		// Populate question object array from database.
		public function set_from_db()
		{	
			$result = array();

			// Defereence data member.
			$query = $this->query_m;

			try
			{
				if(!$query) throw new Exception('Missing query object.');
							
				$query->set_sql('SELECT * FROM tbl_class_train_questions WHERE fk_id = ? ORDER BY display_order');
				$query->set_params(array(&$this->fk_int));
				$query->query();
				
				if($query->get_row_exists())
				{				
					$query->get_line_params()->set_class_name('question_fields');
					$this->result = $query->get_line_object_all();
					
					// Reset class name for next use of query object.
					$query->get_line_params()->set_class_name(NULL);
				}
				else
				{
					$result[] = new question_fields();
				}
			}
			catch(Exception $e)
			{
				trigger_error($e->getMessage().', File: '.$e->getFile(), E_USER_ERROR);
			}			
		}		
	}

	/* Controller class for question updates, lists, etc.
	class question
	{
		private 
			$db_m			= NULL,
			$query_m		= NULL,
			$ob_single		= NULL,
			$ob_list		= NULL,
			$ob_update		= NULL,
			$ob_post		= NULL,
			$ob_get			= NULL;
		
		public function __construct()
		{
			// Set up database connection and query objects.
			$this->db_m 	= new class_db_connection();
			$this->query_m	= new class_db_query($this->db_m);
		}
		
		// Mutator methods.
		public 
			function set_post($value)
			{
				
			}
		
		public function send_to_db()
		{
			$updater = new question_update();
			$this->query_m->get_row_exists()
			$updater->set_query($this->query_m);
		}		
	}
	*/

?>