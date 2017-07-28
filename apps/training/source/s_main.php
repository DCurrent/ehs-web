<?php 

	require_once(__DIR__.'/s_questions.php'); 	// Module quiz questions.
	require_once(__DIR__.'/s_answers.php'); 		// Module quiz answers.
	require_once(__DIR__.'/s_lists.php');		// Items list generation.
	require_once(__DIR__.'/s_settings.php'); 	// Flags and constants.
	require_once(__DIR__.'/s_input.php'); 		// POST and GET.
	
	// Development type hinting only. Remove for production.
	//require('s_questions.php'); 	// Module quiz questions.
	//require('s_answers.php'); 	// Module quiz answers.
	//require('s_lists.php');		// Items list generation.
	//require('s_settings.php'); 	// Flags and constants. 
	
	class get
	{
		private
			$m		= NULL,	// Current module.
			$q 		= NULL,	// Current question.
			$a_del	= NULL;	// Delete answer.
			
		public function __construct()
		{	
			$this->populate();	
		}
		
		// Populate all data members with matching GET key.
		private function populate()
		{
			// Interate through each class variable.
       		foreach($this as $key => $value) 
			{			
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the get value. 
				if(isset($_GET[$key]))
				{					
					$this->$key = $_GET[$key];           						
				}
			}
		}
		
		// Access methods.
		public
			function get_module()
			{
				return $this->m;
			}			
		
			function get_question()
			{
				return $this->q;
			}			
		
			function get_answer_delete()
			{
				return $this->a_del;
			}
		
	}
				
	// List of fields from training database parameters table.
	class class_module_data
	{
		private 
			$new_record 			= FALSE;	// Object is being initialized as a blank record.
		
		private					 
			$cert_verbiage			= NULL,
			$desc_short				= NULL,
			$desc_title 			= NULL,
			$email_list				= NULL,						
			$field_addroom			= NULL,
			$field_comments			= NULL,
			$field_dept				= NULL,
			$field_email			= NULL,
			$field_etrax			= NULL,
			$field_facility			= NULL,
			$field_mail				= NULL,
			$field_training_status	= NULL,			
			$field_uk_status		= NULL,
			$field_ukid				= NULL,
			$field_phone			= NULL,
			$field_supervisor		= NULL,
			$hidden					= NULL,
			$id 				= NULL,		// Primary key.
			$intro					= NULL,
			$instr_head				= NULL,
			$instr					= NULL,
			$material_above			= NULL,
			$material_above_head 	= NULL,			
			$material_below			= NULL,
			$material_below_head	= NULL,
			$question_layout		= NULL,
			$question_order			= NULL,
			$question_quantity		= NULL,
			$responsible_party		= NULL;

		// Accessors
		public function get_new_record()
		{
			return $this->new_record;
		}
		
		public function get_cert_verbiage()
		{
			return $this->cert_verbiage;
		}
		
		public function get_desc_short()
		{
			return $this->desc_short;
		}
		
		public function get_desc_title()
		{
			return $this->desc_title;
		}
		
		public function get_email_list()
		{
			return $this->email_list;
		}
		
		public function get_field_addroom()
		{
			return $this->field_addroom;
		}
		
		public function get_field_comments()
		{
			return $this->field_comments;
		}
		
		public function get_field_dept()
		{
			return $this->field_dept;
		}
		
		public function get_field_email()
		{
			return $this->field_email;
		}
		
		public function get_field_etrax()
		{
			return $this->field_etrax;
		}
		
		public function get_field_facility()
		{
			return $this->field_facility;
		}
		
		public function get_field_mail()
		{
			return $this->field_mail;
		}
		
		public function get_field_training_status()
		{
			return $this->field_training_status;
		}
		
		public function get_field_uk_status()
		{
			return $this->field_uk_status;
		}
		
		public function get_field_ukid()
		{
			return $this->field_ukid;
		}
		
		public function get_field_phone()
		{
			return $this->field_phone;
		}
		
		public function get_field_supervisor()
		{
			return $this->field_supervisor;
		}
		
		public function get_hidden()
		{
			return $this->hidden;
		}
		
		public function get_id()
		{
			return $this->id;
		}
		
		public function get_intro()
		{
			return $this->intro;
		}
		
		public function get_instr_head()
		{
			return $this->instr_head;
		}
		
		public function get_instr()
		{
			return $this->instr;
		}
		
		public function get_material_above()
		{
			return $this->material_above;
		}
		
		public function get_material_above_head()
		{
			return $this->material_above_head;
		}
		
		public function get_material_below()
		{
			return $this->material_below;
		}
		
		public function get_material_below_head()
		{
			return $this->material_below_head;
		}
		
		public function get_question_layout()
		{
			return $this->question_layout;
		}
		
		public function get_question_order()
		{
			return $this->question_order;
		}
		
		public function get_question_quantity()
		{
			return $this->question_quantity;
		}
		
		public function get_responsible_party()
		{
			return $this->responsible_party;
		}		
			
		public function __construct($new_record = FALSE)
		{
			$this->new_record = $new_record;
			$this->set_defaults();
		}
		
		// Set default values for data members.
		private function set_defaults()
		{
			if($this->new_record === TRUE)
			{
				$this->id				= ITEM_ID::FRESH;
				$this->desc_title			= 'New Module, '.date(DATE_FORMAT);
				$this->instr_head			= 'Instructions';
				$this->instr				= 'Review the course material. When you are ready to take the exam answer all of the following questions, then click "Submit." When you "Submit" your registration and test, the results will be graded. You must answer 100% of the questions correctly to pass this course.';
				$this->field_comments		= TRUE;
				$this->field_dept			= TRUE;
				$this->field_uk_status		= TRUE;
				$this->hidden				= MODULE_ACCESS::HIDDEN;
				$this->question_order		= QUESTION_ORDER::RANDOM;
				$this->question_quantity	= CONSTANTS::QUANTITY;
				$this->question_layout		= QUESTION_LAYOUT::LISTED;
			}
		}
	}	
	
	class information_schema
	{
		public	
			$COLUMN_DEFAULT				= NULL,
			$CHARACTER_MAXIMUM_LENGTH	= NULL;
	}
	
	
	
?>