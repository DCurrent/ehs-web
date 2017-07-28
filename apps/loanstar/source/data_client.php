<?php
	
	require_once(__DIR__.'/data_common.php');

	// tbl_client
	class class_client_data extends class_common_data
	{
		protected
			$name_f			= NULL,
			$name_m			= NULL,
			$name_l			= NULL,
			$name_c			= NULL,		// cadence (sr., jr. III, etc.)
			$gender			= NULL,
			$address_desc	= NULL,
			$address_city	= NULL,
			$address_county	= NULL,
			$address_state	= NULL,
			$address_code	= NULL,
			$birth_date		= NULL,
			$birth_city		= NULL,
			$birth_state	= NULL,
			$ssn			= NULL,
			$id_code		= NULL,
			$id_type		= NULL,
			$id_expire		= NULL,
			$id_upin		= NULL,
			$demo_height	= NULL,
			$demo_weight	= NULL,
			$demo_race		= NULL,
			$residence_state	= NULL,
			$residence_country	= NULL,
			$alien_id			= NULL;
		
		// Accessors
		public function get_name_f()
		{
			return $this->name_f;
		}
		
		public function get_name_m()
		{
			return $this->name_m;
		}
		
		public function get_name_l()
		{
			return $this->name_l;
		}
		
		public function get_name_c()
		{
			return $this->name_c;
		}
		
		public function get_gender()
		{
			return $this->gender;
		}
		
		public function get_address_desc()
		{
			return $this->address_desc;
		}
		
		public function get_address_city()
		{
			return $this->address_city;
		}
		
		public function get_address_state()
		{
			return $this->address_state;
		}
		
		public function get_address_country()
		{
			return $this->address_county;
		}
		
		public function get_address_code()
		{
			return $this->address_code;
		}
		
		public function get_birth_city()
		{
			return $this->birth_city;
		}
		
		public function get_birth_date()
		{
			return $this->birth_date;
		}
		
		public function get_birth_state()
		{
			return $this->birth_state;
		}
		
		public function get_ssn()
		{
			return $this->ssn;
		}
		
		public function get_id_code()
		{
			return $this->id_code;
		}
		
		public function get_id_expire()
		{
			return $this->id_expire;
		}
		
		public function get_id_type()
		{
			return $this->id_type;
		}
		
		public function get_id_upin()
		{
			return $this->id_upin;
		}
		
		public function get_demo_height()
		{
			return $this->demo_height;
		}
		
		public function get_demo_weight()
		{
			return $this->demo_weight;
		}
		
		public function get_demo_race()
		{
			return $this->demo_race;
		}
		
		public function get_residence_state()
		{
			return $this->residence_state;
		}
		
		public function get_residence_country()
		{
			return $this->residence_country;
		}
		
		public function get_alien_id()
		{
			return $this->alien_id;
		}
		
		// Mutators
		public function set_name_f($value)
		{
			$this->name_f = $value;
		}
		
		public function set_name_m($value)
		{
			$this->name_m = $value;
		}
		
		public function set_name_l($value)
		{
			$this->name_l = $value;
		}
		
		public function set_name_c($value)
		{
			$this->name_c = $value;
		}
		
		public function set_gender($value)
		{
			$this->gender = $value;
		}
		
		public function set_address_desc($value)
		{
			$this->address_desc = $value;
		}
		
		public function set_address_city($value)
		{
			$this->address_city = $value;
		}
		
		public function set_address_state($value)
		{
			$this->address_state = $value;
		}
		
		public function set_address_country($value)
		{
			$this->address_county = $value;
		}
		
		public function set_address_code($value)
		{
			$this->address_code = $value;
		}
		
		public function set_birth_city($value)
		{
			$this->birth_city = $value;
		}
		
		public function set_birth_date($value)
		{
			$this->birth_date = $value;
		}
		
		public function set_birth_state($value)
		{
			$this->birth_state = $value;
		}
		
		public function set_ssn($value)
		{
			$this->ssn = $value;
		}
		
		public function set_id_code($value)
		{
			$this->id_code = $value;
		}
		
		public function set_id_expire($value)
		{
			$this->id_expire = $value;
		}
		
		public function set_id_type($value)
		{
			$this->id_type = $value;
		}
		
		public function set_id_upin($value)
		{
			$this->id_upin = $value;
		}
		
		public function set_demo_height($value)
		{
			$this->demo_height = $value;
		}
		
		public function set_demo_weight($value)
		{
			$this->demo_weight = $value;
		}
		
		public function set_demo_race($value)
		{
			$this->demo_race = $value;
		}
		
		public function set_residence_state($value)
		{
			$this->residence_state = $value;
		}
		
		public function set_residence_country($value)
		{
			$this->residence_country = $value;
		}
		
		public function set_alien_id($value)
		{
			$this->alien_id = $value;
		}		
	}
	
	// tbl_status_list
	class class_status_list_data extends class_common_data
	{
		protected
			$details	= NULL,
			$label		= NULL;
		
		// Accessors
		public function get_details()
		{
			return $this->details;
		}
		
		public function get_label()
		{
			return $this->label;
		}
		
		// Mutators
		public function set_details($value)
		{
			$this->details = $value;
		}
		
		public function set_label($value)
		{
			$this->label = $value;
		}	
	}
	
	// tbl_ticket_journal
	class class_ticket_journal_data extends class_common_data
	{
		protected
			$details	= NULL,
			$label		= NULL;
				
		// Get and return an xml string for database use.
		public function xml()
		{
			$result = '<root>';
						
			foreach($this->id as $key => $id)
			{								
				$result .= '<row id="'.$id.'">';
				$result .= '<label>'.$this->label[$key].'</label>';
				$result .= '<details>'.htmlspecialchars($this->details[$key]).'</details>';
				$result .= '</row>';									
			}
			
			$result .= '</root>';
			
			return $result;
		}
		
		// Accessors		
		public function get_details()
		{
			return $this->details;
		}
		
		public function get_label()
		{
			return $this->label;
		}
		
		// Mutators
		public function set_id($value)
		{			
		}
		
		public function set_details($value)
		{			
		}
		
		public function set_label($value)
		{
		}
		
		public function set_sub_id($value)
		{			
			$this->id = $value;
		}
		
		public function set_sub_details($value)
		{
			$this->details = $value;
		}	
		
		public function set_sub_label($value)
		{
			$this->label = $value;
		}
	}
	
	// tbl_ticket_party
	class class_ticket_party_data extends class_common_data
	{
		protected
			$account		= NULL,
			$description 	= NULL;
		
		// Get and return an xml string for database use.
		public function xml()
		{
			$result = '<root>';
						
			foreach($this->id as $key => $id)
			{								
				$result .= '<row id="'.$id.'">';
				$result .= '<account>'.htmlspecialchars($this->account[$key]).'</account>';
				$result .= '</row>';									
			}
			
			$result .= '</root>';
			
			return $result;
		}
		
		public function add_party($account)
		{
			$this->id[] = DB_DEFAULTS::NEW_ID;
			$this->account[] = $account;
			
			var_dump($this->id);
			echo '<br>';
			var_dump($this->account);
		}
		
		// Accessors
		public function get_description()
		{
			return $this->description;
		}
		
		public function get_account()
		{
			return $this->account;
		}
		
		// Mutators
		public function set_id($value)
		{
						
		}
		
		public function set_account($value)
		{			
		}
		
		public function set_description($value)
		{			
		}
		
		public function set_sub_party_description($value)
		{			
			$this->description = $value;
		}
		
		public function set_sub_party_account($value)
		{
			$this->account = $value;
		}
		
		public function set_sub_party_id($value)
		{			
			$this->id = $value;
		}
	}
?>
