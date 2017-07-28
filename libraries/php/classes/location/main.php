<?php	
		
	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/database/main.php');

	class location_class_common_data
	{
		private 
			$building_code	= NULL,
			$building_name	= NULL,
			$room_barcode	= NULL,
			$room_floor		= NULL,
			$room_use		= NULL,
			$room_id		= NULL;
			
		public
			// Accessors
			function get_building_code()
			{
				return $this->building_code;
			}
			
			function get_building_name()
			{
				return $this->building_name;
			}
			
			function get_room_barcode()
			{
				return $this->room_barcode;
			}
			
			function get_room_id()
			{
				return $this->room_id;
			}
			
			function get_room_floor()
			{
				return $this->room_floor;
			}
			
			function get_room_use()
			{
				return $this->room_use;
			}
		
			// Mutators
			function set_room_barcode($value)
			{
				$this->room_barcode = $value;
			}
		
	}

	class location_class_location
	{
		private
			$room_barcode		= NULL,
			$building_code		= NULL,
			$markup				= NULL,
			$db					= NULL,
			$db_query			= NULL;
			
		public 
			// Accessors
			function get_markup()
			{
				return $this->markup;
			}
			
			// Mutators
			function set_room_barcode($value)
			{
				$this->room_barcode = $value;
			}
		
		public function __construct()
		{
			$db_conn_set = new class_db_connect_params();
			$db_conn_set->set_name('UKSpace'); 
			
			// Initialize DB connection and query objects.			
			$this->db 		= new class_db_connection($db_conn_set);		
			$this->db_query = new class_db_query($this->db);
		}
		
		private function get_building_from_room()
		{
			$result	= NULL;
			$query 	= $this->db_query;
			
			// First thing is to get the building our current room is in.
			$query->set_sql('SELECT DISTINCT Building AS building_code FROM Rooms WHERE LocationBarcodeID = ?');
			
			$params = array($this->room_barcode);
			
			$query->set_params($params);
			$query->query();
			
			$query->get_line_params()->set_class_name('location_class_common_data');
			$obj_line = $query->get_line_object();
			
			$result = $obj_line->get_building_code();
			
			return $result;			
		}
		
		// Build and return a let of floors from current building.
		private function create_floor_list_from_building()
		{
			$result = array();
			$query 	= $this->db_query;
			
			$query->set_sql('SELECT DISTINCT Floor AS room_floor FROM Rooms WHERE Building = ? ORDER BY floor');	
			
			$params = array($this->building_code);
					
			$query->set_params($params);
			$query->query();
						
			// If there is a valid result, then create an object list.
            if($query->get_row_exists() === TRUE) 
			{
				$query->get_line_params()->set_class_name('location_class_common_data');
				$result = $query->get_line_object_list();
			}
			
			return $result;
		}
		
		// Create a select list of rooms by floor, extracted from current room.
		public function create_room_list_from_room()
		{
			$query_room 	= $this->db_query;
			$building_code	= NULL;
			$room_floor		= NULL;
			$use			= NULL;
			
			// Get the building code from given room.
			$this->building_code = $this->get_building_from_room();
			
			$_obj_floor_list = $this->create_floor_list_from_building();
			
			// Prepare a room list query.
			$query_room->set_sql('SELECT 
									_main.LocationBarCodeID AS room_barcode, 
									_main.RoomID AS room_id,
									_use.UsageCodeDescr AS room_use
									FROM Rooms AS _main
									LEFT JOIN MasterRoomUsageCodes AS _use ON _use.UsageCode = _main.RoomUsage
									WHERE _main.floor = ? AND _main.Building = ?');
			
			$query_room->set_params(array(&$room_floor, &$building_code));
			$query_room->prepare();		
			
			if(is_object($_obj_floor_list) === TRUE)
			{        
				// Generate table row for each item in list.
				for($_obj_floor_list->rewind(); $_obj_floor_list->valid(); $_obj_floor_list->next())
				{		
					// Get current item from this loop.				
					$_obj_floor = $_obj_floor_list->current();
					
					// Populate our bound parameters from current loop data.
					$room_floor		= $_obj_floor->get_room_floor();
					$building_code 	= $this->building_code;
					
					// Add the Floor as a an optgroup to markup.
					$this->markup.='<optgroup label="Floor '.$room_floor.'">'.PHP_EOL;					
					
					// Execute the room query.
					$query_room->execute();
					
					// Create an empty list, just in case there is no data.
					$_obj_room_list = array();
					
					// If there is a valid result, then create an object list.
					if($query_room->get_row_exists() === TRUE) 
					{
						$query_room->get_line_params()->set_class_name('location_class_common_data');
						$_obj_room_list = $query_room->get_line_object_list();
					}
					
					// Now we need to loop through the room results and create markup.
					if(is_object($_obj_room_list) === TRUE)
					{        
						// Generate select markup for each item in list.
						for($_obj_room_list->rewind(); $_obj_room_list->valid(); $_obj_room_list->next())
						{												
							// Get current item this from loop.				
							$_obj_floor = $_obj_room_list->current();
							
							$use = $_obj_floor->get_room_use();
							
							// If the room use description from database wasn't blank, let's include it.
							if($use) $use = ' - '.trim(ucwords(strtolower($use)));
							
							// If the current barcode matches barcode from this loop, then add selected
							// markup.
							if($this->room_barcode == $_obj_floor->get_room_barcode())
							{
								$selected = ' selected ';
							}
							else
							{
								$selected = NULL;
							}							
							
							// Add the completed option value string to markup.        	
							$this->markup.='<option value="'.trim($_obj_floor->get_room_barcode()).'"'.$selected.'>'.trim($_obj_floor->get_room_id()).$use.'</option>'.PHP_EOL;
						}
					}
					
					// Close the optgroup markup.
					$this->markup.='</optgroup>'.PHP_EOL;
				}
			}
		}
	}
	
?>