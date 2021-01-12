<?php

	abstract class SETTINGS
	{
		const TITLE			= 'Lab Sign';
		const PDF_FILE		= 'lab_sign';
		const STREAM_TYPE 	= 'I';		 
	}

	// Post data.			
	class class_data_sign
	{
		private	$department		= NULL;
		private	$room			= NULL;
			
		private	$pi_id			= array();
		private	$pi_name_f		= array();
		private	$pi_name_l		= array();
		private	$super_id		= array();
		private	$super_name_f	= array();
		private	$super_name_l	= array();
			
		private	$ec_id			= array();
		private	$ec_name_f		= array();
		private	$ec_name_l		= array();
		private	$ec_loc			= array();
		private	$ec_phone_o		= array();
		private	$ec_phone_h		= array();
			
        // Agents
		private	$electric		= NULL;
		private	$flammables		= NULL;
		private	$oxidizers		= NULL;
		private	$explosives		= NULL;
		private	$corrosives		= NULL;
		private	$magnetic		= NULL;
		private	$carcinogen		= NULL;
		private	$irritant		= NULL;
		private	$toxicity		= NULL;
		private	$pressure		= NULL;
		private	$laser			= NULL;
		private	$radioactive	= NULL;
		private	$biohazards		= NULL;
		private	$transgenic_p	= NULL;	// Transgenic plants.
		private	$pathogens_p	= NULL;	// Plant pathogens.
		private	$pathogens_h	= NULL; // Human pathogens.
		private	$vectors_v		= NULL;	// Virual vectors.
		private	$bsl			= NULL;
		private	$special		= NULL;				
		
		public function __construct()
		{	
			$this->populate_from_request();		
		}
						
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
		
		// Mutator methods
		public function set_ec_id($value)
		{
			$this->ec_id = $value;
		}
		
		public function set_ec_name_f($value)
		{
			$this->ec_name_f = $value;
		}
			
		public function set_ec_name_l($value)
		{
			$this->ec_name_l = $value;
		}
			
		public function set_ec_loc($value)
		{
			$this->ec_loc = $value;
		}
			
		public function set_ec_phone_h($value)
		{
			$this->ec_phone_h = $value;
		}
			
		public function set_ec_phone_o($value)
		{
			$this->ec_phone_o = $value;
		}
		
		public function set_department($value)
		{
			$this->department = $value;
		}
		
		public function set_room($value)
		{
			$this->room = $value;
		}
		
		public function set_pi_id($value)
		{
			$this->pi_id = $value;
		}
		
		public function set_pi_name_f($value)
		{
			$this->pi_name_f = $value;
		}
			
		public function set_pi_name_l($value)
		{
			$this->pi_name_l = $value;
		}
		
		public function set_super_id($value)
		{
			$this->super_id = $value;
		}
		
		public function set_super_name_f($value)
		{
			$this->super_name_f = $value;
		}
			
		public function set_super_name_l($value)
		{
			$this->super_name_l = $value;
		}
		
		public function set_electric($value)
		{
			$this->electric = $value;
		}
		
		public function set_flammables($value)
		{
			$this->flammables = $value;
		}
			
		public function set_oxidizers($value)
		{
			$this->oxidizers = $value;
		}
			
		public function set_explosives($value)
		{
			$this->explosives = $value;
		}
			
		public function set_corrosives($value)
		{
			$this->corrosives = $value;
		}
			
		public function set_magnetic($value)
		{
			$this->magnetic = $value;
		}
			
		public function set_carcinogen($value)
		{
			$this->carcinogen = $value;
		}
			
		public function set_irritant($value)
		{
			$this->irritant = $value;
		}
			
		public function set_toxicity($value)
		{
			$this->toxicity = $value;
		}
			
		public function set_pressure($value)
		{
			$this->pressure = $value;
		}
			
		public function set_laser($value)
		{
			$this->laser = $value;
		}
			
		public function set_radioactive($value)
		{
			$this->radioactive = $value;
		}
			
		public function set_biohazards($value)
		{
			$this->biohazards = $value;
		}
			
		public function set_transgenic_p($value)
		{
			$this->transgenic_p = $value;
		}
			
		public function set_pathogens_p($value)
		{
			$this->pathogens_p = $value;
		}
			
		public function set_pathogens_h($value)
		{
			$this->pathogens_h = $value;
		}
		
		public function set_vectors_v($value)
		{
			$this->vectors_v = $value;
		}
		
		public function set_bsl($value)
		{
			$this->bsl = $value;
		}
		
		public function set_special($value)
		{
			$this->special = $value;
		} 
		
		// Access methods		
		public function get_ec_id()
		{
			return $this->ec_id;
		}
	
		public function get_ec_name_f()
		{
			return $this->ec_name_f;
		}
		
		public function get_ec_name_l()
		{
			return $this->ec_name_l;
		}
		
		public function get_ec_loc()
		{
			return $this->ec_loc;
		}
		
		public function get_ec_phone_h()
		{
			return $this->ec_phone_h;
		}
		
		public function get_ec_phone_o()
		{
			return $this->ec_phone_o;
		}
	
		public function get_department()
		{
			return $this->department;
		}
	
		public function get_room()
		{
			return $this->room;
		}
		
		public function get_pi_id()
		{
			return $this->pi_id;
		}
		
		public function get_pi_name_f()
		{
			return $this->pi_name_f;
		}
		
		public function get_pi_name_l()
		{
			return $this->pi_name_l;
		}
		
		public function get_super_id()
		{
			return $this->super_id;
		}
		
		public function get_super_name_f()
		{
			return $this->super_name_f;
		}
		
		public function get_super_name_l()
		{
			return $this->super_name_l;
		}
	
		public function get_electric()
		{
			return $this->electric;
		}
	
		public function get_flammables()
		{
			return $this->flammables;
		}
		
		public function get_oxidizers()
		{
			return $this->oxidizers;
		}
		
		public function get_explosives()
		{
			return $this->explosives;
		}
		
		public function get_corrosives()
		{
			return $this->corrosives;
		}
		
		public function get_magnetic()
		{
			return $this->magnetic;
		}
		
		public function get_carcinogen()
		{
			return $this->carcinogen;
		}
		
		public function get_irritant()
		{
			return $this->irritant;
		}
		
		public function get_toxicity()
		{
			return $this->toxicity;
		}
		
		public function get_pressure()
		{
			return $this->pressure;
		}
		
		public function get_laser()
		{
			return $this->laser;
		}
		
		public function get_radioactive()
		{
			return $this->radioactive;
		}
		
		public function get_biohazards()
		{
			return $this->biohazards;
		}
		
		public function get_transgenic_p()
		{
			return $this->transgenic_p;
		}
		
		public function get_pathogens_p()
		{
			return $this->pathogens_p;
		}
		
		public function get_pathogens_h()
		{
			return $this->pathogens_h;
		}
		
		public function get_vectors_v()
		{
			return $this->vectors_v;
		}
		
		public function get_bsl()
		{
			return $this->bsl;
		}
		
		public function get_special()
		{
			return $this->special;
		}
	}

?>