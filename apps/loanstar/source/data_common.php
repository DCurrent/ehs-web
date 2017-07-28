<?php
	class class_common_data
	{
		protected
			$id					= NULL,
			$fk_id				= NULL,
			$log_create			= NULL,
			$log_create_by		= NULL,
			$log_create_ip		= NULL,
			$log_update			= NULL,
			$log_update_by		= NULL,
			$log_update_ip		= NULL,
			$record_deleted		= NULL,
			$label				= NULL,
			$details			= NULL;
		
		// Populate members from $_REQUEST.
		public function populate_from_request()
		{		
			// Interate through each class method.
			foreach(get_class_methods($this) as $method) 
			{		
				$key = str_replace('set_', '', $method);
							
				// If there is a request var with key matching
				// current method name, then the current method 
				// is a set mutator for this request var. Run 
				// it (the set method) with the request var. 
				if(isset($_REQUEST[$key]))
				{					
					$this->$method($_REQUEST[$key]);					
				}
			}			
		}
		
		// Accessors
		public function get_id()
		{
			return $this->id;
		}
		
		public function get_fk_id()
		{
			return $this->fk_id;
		}
		
		public function get_log_create()
		{
			return $this->log_create;
		}
		
		public function get_log_create_by()
		{
			return $this->log_create_by;
		}
		
		public function get_log_create_ip()
		{
			return $this->log_create_ip;
		}
		
		public function get_log_update()
		{
			return $this->log_update;
		}
		
		public function get_log_update_by()
		{
			return $this->log_update_by;
		}
		
		public function get_log_update_ip()
		{
			return $this->log_update_ip;
		}
		
		public function get_record_deleted()
		{
			return $this->record_deleted;
		}
		
		public function get_label()
		{
			return $this->label;
		}
		
		public function get_details()
		{
			return $this->details;
		}
		
		// Mutators
		public function set_id($value)
		{
			$this->id = $value;
		}
		
		public function set_fk_id($value)
		{
			$this->fk_id = $value;
		}
		
		public function set_log_create($value)
		{
			$this->log_create = $value;
		}
		
		public function set_log_create_by($value)
		{
			$this->log_create_by = $value;
		}
		
		public function set_log_create_ip($value)
		{
			$this->log_create_ip = $value;
		}
		
		public function set_log_update($value)
		{
			$this->log_update = $value;
		}
		
		public function set_log_update_by($value)
		{
			$this->log_update_by = $value;
		}
		
		public function set_log_update_ip($value)
		{
			$this->log_update_ip = $value;
		}
		
		public function set_record_deleted($value)
		{
			$this->record_deleted = $value;
		}
		
		public function set_label($value)
		{
			$this->label = $value;
		}
		
		public function set_details($value)
		{
			$this->details = $value;
		}
	}
		
	
?>
