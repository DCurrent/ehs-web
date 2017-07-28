<?php

	require_once(__DIR__.'/data_common.php');
	
	class blair_class_area_data extends blair_class_common_data
	{
		private			
			$biosafety_level		= NULL,
			$bio_agent				= NULL,
			$building_id			= NULL,
			$building_name			= NULL,
			$code					= NULL,
			$chemical_safety		= NULL,
			$chemical_risk			= NULL,
			$department				= NULL,			
			$fire_code_class		= NULL,
			$floor					= NULL,
			$hazardous_waste		= NULL,
			$room_id				= NULL,
			$radiation				= NULL,
			
						
			$use_code				= NULL,
			$use_definition			= NULL,
			$use_description_short	= NULL,
			$xray					= NULL;
			
			
		// Accessors
		public 
			function get_building_id()
			{
				return $this->building_id;
			}
			
			function get_building_name()
			{
				return $this->building_name;
			}
			
			function get_code()
			{
				return $this->code;
			}
			
			function get_floor()
			{
				return $this->floor;
			}
			
			function get_room_id()
			{
				return $this->room_id;
			}
			
			function get_use_code()
			{
				return $this->use_code;
			}
			
			function get_use_definition()
			{
				return $this->use_definition;
			}
			
			function get_use_description_short()
			{
				return $this->use_description_short;
			}
		
		
		// Mutators
		public 
			function set_building_id($value)
			{
				$this->building_id = $value;
			}
			
			function set_building_name($value)
			{
				$this->building_name = $value;
			}
		
			function set_code($value)
			{
				$this->code = $value;
			}
			
			function set_floor($value)
			{
				$this->floor = $value;
			}
			
			function set_room_id($value)
			{
				$this->room_id = $value;
			}
			
			function set_use_code($value)
			{
				$this->use_code = $value;
			}
			
			function set_use_definition($value)
			{
				$this->use_definition = $value;
			}
			
			function set_use_description_short($value)
			{
				$this->use_description_short = $value;
			}
			
					
	}	
	
?>