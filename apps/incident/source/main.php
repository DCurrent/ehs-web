<?php

	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/database/main.php'); 	// Database class.
	require(__DIR__.'/s_list_markup.php'); 	// Module quiz questions.
	
	// General use constants.
	abstract class CONSTANTS
	{
		const AREA_OUTSIDE = -2;
		const SUBMIT_TRUE = 1;
		const SUBMIT_FALSE = FALSE;
		const INCIDENT_OB_SES_KEY = 'incident_object';
		//const ACCESS_REPORT = 'dwhibb0, lpoor2, trobert, jghamo2, mla263, asof224';
		const ACCESS_REPORT = '';
		
		
		const
			NO 	= 0,
			YES	= 1;			
	}
	
	// Default settings for outgoing mail.
	abstract class MAILING
	{
		const
			TO		= 'lpoor2@uky.edu, asof224@uky.edu, jlyoun3@uky.edu, mla263@uky.edu',
			CC		= '',
			BCC		= 'dvcask2@uky.edu',
			SUBJECT = 'Incident Report',
			FROM 	= 'ehs_noreply@uky.edu';
	}
	
	class contact
	{
		private $label_m = NULL;
		
		public function __construct($value = NULL)
		{
			if($value == 1)
			{
				$this->label_m = 'Yes';
			}
			else
			{
				$this->label_m = 'No';
			}
		}
		
		public function label()
		{
			return $this->label_m;
		}
	}
	
	// tbl_incident columns.
	// Also used for post values. Note: Some data members will be dynmaically 
	// added on entry. See index.php for details.			
	class class_incident 
	{
		private 
			$time_range_start	= NULL,
			$time_range_end		= NULL,
			$account 			= NULL,
			$agent				= NULL,
			$agent_list			= NULL,	// Combined items from sub table tbl_agents.
			$agent_list_label 	= NULL,	// Combined items from sub table tbl_agents w/name taken from tbl_agents_list
			$area 				= NULL,
			$area_label			= NULL,
			$body				= NULL,
			$body_list			= NULL,
			$body_list_label	= NULL,
			$contact 			= NULL,
			$department 		= NULL,	// Department number.
			$department_label 	= NULL,	// Department name
			$description		= NULL,
			$email 				= NULL,
			$facility 			= NULL,
			$facility_label		= NULL,	// Facility name.
			$id 				= NULL,
			$name_f 			= NULL,
			$name_l 			= NULL,
			$nature				= NULL,
			$nature_list		= NULL,
			$nature_list_label	= NULL,
			$phone 				= NULL,
			$submit 			= NULL,	// Page submitted?
			$time 				= NULL,
			$type 				= NULL,
			$type_label			= NULL;		
						
		// Accessors
		public function get_time_range_start()
		{
			return $this->time_range_start;
		}
		
		public function get_time_range_end()
		{
			return $this->time_range_end;
		}
			
		
		public function get_area()
		{
			return $this->area;
		}
		
		public function get_area_label()
		{
			return $this->area_label;
		}
				
		public function get_account()
		{
			return $this->account;
		}
		
		public function get_agent()
		{
			return $this->agent;
		}
		
		public function get_agent_list()
		{
			return $this->agent_list;
		}
		
		public function get_agent_list_label()
		{
			return $this->agent_list_label;
		}
		
		public function get_body()
		{
			return $this->body;
		}		
		
		public function get_body_list()
		{
			return $this->body_list;
		}
		
		public function get_body_list_label()
		{
			return $this->body_list_label;
		}
		
		public function get_contact()
		{
			return $this->contact;
		}
		
		public function get_department()
		{
			return $this->department;
		}
		
		public function get_department_label()
		{
			return $this->department_label;
		}
		
		public function get_description()
		{
			return $this->description;
		}
		
		public function get_email()
		{
			return $this->email;
		}
		
		public function get_facility()
		{
			return $this->facility;
		}
		
		public function get_facility_label()
		{
			return $this->facility_label;
		}
		
		public function get_id()
		{
			return $this->id;
		}
		
		public function get_name_f()
		{
			return $this->name_f;
		}
		
		public function get_name_l()
		{
			return $this->name_l;
		}
		
		public function get_nature()
		{
			return $this->nature;
		}
		
		public function get_nature_list()
		{
			return $this->nature_list;
		}
		
		public function get_nature_list_label()
		{
			return $this->nature_list_label;
		}
		
		public function get_phone()
		{
			return $this->phone;
		}
				
		public function get_submit()
		{
			return $this->submit;
		}
		
		public function get_time()
		{
			return $this->time;
		}
		
		public function get_type()
		{
			return $this->type;
		}
		
		public function get_type_label()
		{
			return $this->type_label;
		}
					
		// Mutators
		public function set_time_range_start($value)
		{
			$this->time_range_start = $value;
		}
		
		public function set_time_range_end($value)
		{
			$this->time_range_end = $value;
		}
		
		public function set_account($value)
		{
			$this->account = $value;
		}
		
		public function set_agent($value)
		{
			$this->agent = $value;
		}
		
		public function set_area($value)
		{
			$this->area = $value;
		}
		
		public function set_body($value)
		{
			$this->body = $value;
		}
		
		public function set_contact($value)
		{
			$this->contact = $value;
		}
		
		public function set_department($value)
		{
			$this->department = $value;
		}
		
		public function set_description($value)
		{
			$this->description = $value;
		}
		
		public function set_email($value)
		{
			$this->email = $value;
		}
		
		public function set_facility($value)
		{
			$this->facility = $value;
		}
		
		public function set_id($value)
		{
			$this->id = $value;
		}
		
		public function set_name_f($value)
		{
			$this->name_f = $value;
		}
		
		public function set_name_l($value)
		{
			$this->name_l = $value;
		}
		
		public function set_nature($value)
		{
			$this->nature = $value;
		}
		
		public function set_phone($value)
		{
			$this->phone = $value;
		}			
					
		public function set_submit($value)
		{
			$this->submit = $value;
		}	
		
		public function set_time($value)
		{
			$this->time = $value;
		}
		
		public function set_type($value)
		{
			$this->type = $value;
		}
		
		// Populate members from $_REQUEST.
		public function populate_from_post()
		{		
			// Interate through each class variable.
			foreach($this as $key => $value) 
			{			
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the post value. 
				if(isset($_REQUEST[$key]))
				{
					// Add 'set_' prefix so member name is now a mutator method name.
					$method = 'set_'.$key;
					
					// If a mutator method by the current name exists, run it and
					// pass current request value. 
					if(method_exists($this, $method)=== TRUE)
					{										
						$this->$method($_REQUEST[$key]);
					}
				}
			}	
		}	
	}
	
	class class_query_request
	{
		private
			$pagenum = NULL;
				
		public function __construct()
		{			
			$this->self_populate();
			
			// Make sure the page number request is a positive numeric value.
			if ((!is_numeric($this->pagenum)) || ($this->pagenum < 1))
			{ 
				$this->pagenum = 1; 
			}						
		}
		
		private function self_populate()
		{
			// Interate through each class variable.
			foreach($this as $key => $value) 
			{			
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the post value. 
				if(isset($_REQUEST[$key]))
				{
					// Add 'set_' prefix so member name is now a mutator method name.
					$method = 'set_'.$key;
					
					// If a mutator method by the current name exists, run it and
					// pass current request value. 
					if(method_exists($this, $method)=== TRUE)
					{										
						$this->$method($_REQUEST[$key]);
					}
				}
			}
		}
		
		public function get_page_number()
		{
			return $this->pagenum;
		}	
		
		public function set_page_number($value)
		{
			$this->pagenum = $value;
		}		
	}
	
	class class_incident_type
	{
		private
			$id		= NULL,
			$label	= NULL;		
		
		// Accessors
		public function get_id()
		{
			return $this->id;
		}
		
		public function get_label()
		{
			return $this->label;
		}
		
		// Mutators
		public function set_id($value)
		{
			$this->id = $value;
		}
		
		public function set_label($value)
		{
			$this->label = $value;
		}
	}
	
	class class_incident_facility
	{
		private
			$code	= NULL,
			$name	= NULL;			
		
		// Accessors
		public function get_code()
		{
			return $this->code;
		}
		
		public function get_name()
		{
			return $this->name;
		}
		
		// Mutators
		public function set_code($value)
		{
			$this->code = $value;
		}
		
		public function set_name($value)
		{
			$this->name = $value;				
		}
	}
	
	class class_incident_room
	{
		private 
			$room			= NULL,
			$useage_desc	= NULL;		
			
		// Accessors
		public function get_room()
		{
			return $this->room;
		}
		
		public function get_useage_desc()
		{
			return $this->useage_desc;
		}
		
		// Mutators
		public function set_room($value)
		{
			$this->room = $vlaue;
		}
		
		public function set_useage_desc($value)
		{
			$this->useage_desc = $value;
		}
	}	
	
	
	
	// Build parameter array and SQL string for when parameter posts are array values.
	class class_parameter_build
	{
		private 
			$name 	= NULL,		// Name of the table field that we are going to query against.
			$value 	= NULL,		// Value list that will be compared with 'name'.
			$sql	= NULL,		// Working SQL string to output.
			$params	= array();	// Working parameter array to output.
			
		
		public function __construct()
		{
		}
		
		public function assemble()
		{
			// If the value isn't set, we're going to use "all" anyway, so stop right
			// here and don't bother adding to the sql string or parameter array.
			if(!isset($this->value)) return;
			
			// Building query string and parameter array to that determines what itmes we'll get from database.
			if(is_array($this->value) === TRUE)	
			{
				// Incoming value is an array.
					
				// Build sql string to accomidate correct number of parameters.
				$this->sql .= " AND (".$this->name." IN (".str_repeat('?,', count($this->value) - 1). '?'."))";
				
				// Merge value array into parameter array.
				$this->params = array_merge($this->params, $this->value);			
			}
			else
			{
				// Incoming value is a single var.
				
				if($this->value == NULL) return;
								
				// Add an ISNULL to sql string to query by value, or get all if value is empty.
				$this->sql .= " AND ? = ".$this->name;
				
				$this->params[] = $this->value;
			}
		}
		
		// Dates are a special case because we need the between cause.
		public function assemble_date()
		{
			// If the value isn't set, we're going to use "all" anyway, so stop right
			// here and don't bother adding to the sql string or parameter array.
			if(!isset($this->value)) return;
			
			// Building query string and parameter array to that determines what itmes we'll get from database.
			if(is_array($this->value) === TRUE)	
			{					
				// Build sql string to accomidate correct number of parameters.
				$this->sql .= " AND (time ".$this->name." IN (".str_repeat('?,', count($this->value) - 1). '?'."))";
				
				// Merge value array into parameter array.
				$this->params = array_merge($this->params, $this->value);			
			}
			else
			{
				// Incoming value is a single var.
				
				if($this->value == NULL) return;
								
				// press_coverage_date BETWEEN '2000-01-01' and '2001-01-01'
				// Add an ISNULL to sql string to query by value, or get all if value is empty.
				$this->sql .= " AND (time BETWEEN ? AND ? )";
				
				$this->params[] = $this->
				$this->params[] = $this->value;
			}
		}
		
		// Accessors
		public function get_params()
		{
			return $this->params;
		}
		
		public function get_sql()
		{
			return $this->sql;
		}
		
		// Mutators
		public function set_name($value)
		{
			$this->name = $value;
		}
		
		public function set_params($value)
		{
			$this->params = $value;
		}
		
		public function set_sql($value)
		{
			$this->sql = $value;
		}
		
		public function set_value($value)
		{
			$this->value = $value;
		}
	}
?>