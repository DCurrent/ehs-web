<?php

	require_once(__DIR__.'/data_common.php');
	
	// tbl_account_role
	class class_account_role_data extends blair_class_common_data
	{
		private
			$fk_id		= NULL,
			$role		= NULL;
		
		// Get and return an xml string for database use.
		public function xml()
		{
			$result = '<root>';
			
			if(is_array($this->id) === TRUE)			
			{
				foreach($this->id as $key => $id)
				{								
					$result .= '<row id="'.$id.'">';
					$result .= '<role>'.$this->role[$key].'</role>';
					$result .= '</row>';									
				}			
			}
			
			$result .= '</root>';
			
			return $result;
		}
		
		// Accessors
		public function get_fk_id()
		{
			return $this->details;
		}
		
		public function get_role()
		{
			return $this->role;
		}
		
		// Mutators
		// "sub" mutators prevent multiple instances of the same
		// data member name from different classes on a form
		// from interfering with each other.
		public function set_role($value)
		{
		}
		
		public function set_id($value)
		{
		}
		
		public function set_fk_id($value)
		{
			$this->fk_id = $value;
		}
		
		public function set_sub_role_id($value)
		{			
			$this->id = $value;			
		}
							
		public function set_sub_role_role($value)
		{
			$this->role = $value;			
		}
	}
	
	// tbl_role
	class class_role_data extends blair_class_common_data
	{
		private
			$role		= NULL;
		
		// Accessors
		public function get_role()
		{
			return $this->role;
		}
		
		
		// Mutators		
		public function set_role($value)
		{
			$this->role = $value;
		}
	}
	
	// tbl_role_access
	class class_role_access_data extends blair_class_common_data
	{
		private 
			$fk_id 	= NULL,
			$access	= NULL;
		
		// Get and return an xml string for database use.
		public function xml()
		{
			$result = '<root>';
						
			foreach($this->id as $key => $id)
			{								
				$result .= '<row id="'.$id.'">';
				$result .= '<access>'.$this->access[$key].'</access>';
				$result .= '</row>';									
			}
			
			$result .= '</root>';
			
			return $result;
		}
		
		// Accessors
		public function get_access()
		{
			return $this->access;
		}
		
		public function get_fk_id()
		{
			return $this->fk_id;
		}
		
		// Mutators
		// "sub" mutators prevent multiple instances of the same
		// data member name from different classes on a form
		// from interfering with each other.
		public function set_access($value)
		{
		}
		
		public function set_id($value)
		{
		}
		
		public function set_fk_id($value)
		{
			$this->fk_id = $value;
		}
		
		public function set_sub_access_id($value)
		{			
			$this->id = $value;			
		}
							
		public function set_sub_access_access($value)
		{
			$this->access = $value;			
		}
	}
?>