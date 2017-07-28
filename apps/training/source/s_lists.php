<?php 

	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/database/main.php'); 	// Database class.
	
	class class_module
	{
		private
			$id,
			$desc_title;
		
		public function get_id()
		{
			return $this->id;
		}
		
		public function get_desc_title()
		{
			return $this->desc_title;
		}
	}
	
	// Generate a list of modules.
	class class_list_module extends class_list_skeleton
	{		
		public function module_list()
		{				
			// Dereference data members.
			$query 	= $this->get_query();
			
			// Query for module list.
			$query->set_sql('SELECT id, desc_title FROM tbl_class_train_parameters ORDER BY desc_title');			
			$query->query();
		
			$query->get_line_params()->set_class_name('class_module');
		
			if($query->get_row_exists()) $this->set_result($query->get_line_object_all());
			
			return $this->get_result();
		}	
	}
		
	class class_responsible_party
	{
		private 
			$id,
			$name_f,
			$name_l;
			
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
	}
		
	// Generate a list of responsible parties (trainers).
	class class_list_responsible_party extends class_list_skeleton
	{		
		public function party_list()
		{	
			// Dereference data members.	
			$query = $this->get_query();			
			
			// Query for responsible party list.
			$query->set_sql('SELECT id, name_f, name_l FROM tbl_staff WHERE instructor = ? AND active = ? ORDER BY name_l, name_f');
			$query->set_params(array(TRUE, TRUE));
			$query->query();
			
			$query->get_line_params()->set_class_name('class_responsible_party');
						
			if($query->get_row_exists()) $this->set_result($query->get_line_object_all());
			
			return $this->get_result();
		}	
	}
	
	// Skeleton class for creating basic list arrays.
	abstract class class_list_skeleton
	{
		private 			 
			$result_m 	= array(),	// Result array.
			$db_m 		= NULL,		// Database connection object.
			$query_m	= NULL;		// Database query object.
		
		public function __construct()
		{
			// Initialize DB connection and query objects.
			$this->db_m		= new class_db_connection();		
			$this->query_m 	= new class_db_query($this->db_m);		
		}
		
		protected function get_query()
		{
			return $this->query_m;
		}
		
		protected function get_result()
		{
			return $this->result_m;
		}
		
		protected function set_result($value)
		{
			$this->result_m = $value;
		}
	}
	
?>