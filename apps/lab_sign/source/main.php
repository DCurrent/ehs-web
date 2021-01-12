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
		private	$agent_electric	      = NULL;
		private	$agent_flammables     = NULL;
		private	$agent_oxidizers      = NULL;
		private	$agent_explosives     = NULL;
		private	$agent_corrosives     = NULL;
		private	$agent_magnetic	      = NULL;
		private	$agent_carcinogen     = NULL;
		private	$agent_irritant       = NULL;
		private	$agent_toxicity       = NULL;
		private	$agent_pressure       = NULL;
		private	$agent_laser          = NULL;
		private	$agent_radioactive    = NULL;
		private	$agent_biohazards     = NULL;
		private	$agent_transgenic_p   = NULL;	// Transgenic plants.
		private	$agent_pathogens_p    = NULL;	// Plant pathogens.
		private	$agent_pathogens_h    = NULL; // Human pathogens.
		private	$agent_vectors_v      = NULL;	// Virual vectors.
		private	$agent_bsl            = NULL;
		private	$agent_special        = NULL;				
		
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
		
		public function set_agent_electric($value)
		{
			$this->agent_electric = $value;
		}
		
		public function set_agent_flammables($value)
		{
			$this->agent_flammables = $value;
		}
			
		public function set_agent_oxidizers($value)
		{
			$this->agent_oxidizers = $value;
		}
			
		public function set_agent_explosives($value)
		{
			$this->agent_explosives = $value;
		}
			
		public function set_agent_corrosives($value)
		{
			$this->agent_corrosives = $value;
		}
			
		public function set_agent_magnetic($value)
		{
			$this->agent_magnetic = $value;
		}
			
		public function set_agent_carcinogen($value)
		{
			$this->agent_carcinogen = $value;
		}
			
		public function set_agent_irritant($value)
		{
			$this->agent_irritant = $value;
		}
			
		public function set_agent_toxicity($value)
		{
			$this->agent_toxicity = $value;
		}
			
		public function set_agent_pressure($value)
		{
			$this->agent_pressure = $value;
		}
			
		public function set_agent_laser($value)
		{
			$this->agent_laser = $value;
		}
			
		public function set_agent_radioactive($value)
		{
			$this->agent_radioactive = $value;
		}
			
		public function set_agent_biohazards($value)
		{
			$this->agent_biohazards = $value;
		}
			
		public function set_agent_transgenic_p($value)
		{
			$this->agent_transgenic_p = $value;
		}
			
		public function set_agent_pathogens_p($value)
		{
			$this->agent_pathogens_p = $value;
		}
			
		public function set_agent_pathogens_h($value)
		{
			$this->agent_pathogens_h = $value;
		}
		
		public function set_agent_vectors_v($value)
		{
			$this->agent_vectors_v = $value;
		}
		
		public function set_agent_bsl($value)
		{
			$this->agent_bsl = $value;
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
	
		public function get_agent_electric()
		{
			return $this->agent_electric;
		}
	
		public function get_agent_flammables()
		{
			return $this->agent_flammables;
		}
		
		public function get_agent_oxidizers()
		{
			return $this->agent_oxidizers;
		}
		
		public function get_agent_explosives()
		{
			return $this->agent_explosives;
		}
		
		public function get_agent_corrosives()
		{
			return $this->agent_corrosives;
		}
		
		public function get_agent_magnetic()
		{
			return $this->agent_magnetic;
		}
		
		public function get_agent_carcinogen()
		{
			return $this->agent_carcinogen;
		}
		
		public function get_agent_irritant()
		{
			return $this->agent_irritant;
		}
		
		public function get_agent_toxicity()
		{
			return $this->agent_toxicity;
		}
		
		public function get_agent_pressure()
		{
			return $this->agent_pressure;
		}
		
		public function get_agent_laser()
		{
			return $this->agent_laser;
		}
		
		public function get_agent_radioactive()
		{
			return $this->agent_radioactive;
		}
		
		public function get_agent_biohazards()
		{
			return $this->agent_biohazards;
		}
		
		public function get_agent_transgenic_p()
		{
			return $this->agent_transgenic_p;
		}
		
		public function get_agent_pathogens_p()
		{
			return $this->agent_pathogens_p;
		}
		
		public function get_agent_pathogens_h()
		{
			return $this->agent_pathogens_h;
		}
		
		public function get_agent_vectors_v()
		{
			return $this->agent_vectors_v;
		}
		
		public function get_agent_bsl()
		{
			return $this->agent_bsl;
		}
		
		public function get_special()
		{
			return $this->special;
		}
	}

?>