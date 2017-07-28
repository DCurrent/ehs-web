<?php	
		
	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/database/main.php');

	/*
	room
	Damon Vaughn Caskey
	2014-07-16
	
	Output room options. Used to generate room drop list contents when facility is selected.
	*/
	
	// Post data (we'll verify each post and populate it below)..
	class post
	{
		public $facility = NULL;
		public $default	 = NULL;
		public $current	 = NULL;


		// 2015-09-17: This is a hack to allow use of name "building_code" for some fields. it is the same as "facility". Will fix ASAP.
		public $building_code = NULL;

		public function __construct() 
		{		
			// Interate through each class variable.
       		foreach($this as $key => $value) 
			{			
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the post value. 
				if(isset($_POST[$key]))
				{					
					$this->$key = $_POST[$key];           						
				}
			}	
	 	}	
	}
	
	$post = new post();
	$params = array();
	$markup	= NULL;	// Final markup output.
	$use	= NULL;	// Room use markup.
	
	// Database objects.
	$db		= NULL;	// Database.
	$query	= NULL;	// Query.	
	
	// Line objects.
	$floors	= NULL;	
	$floor	= NULL;	
	$rooms	= NULL;
	$room	= NULL;	
	
	// If don't have a facility provided, return.
	if(!$post->facility) $post->facility = $post->building_code;
	
	if(!$post->facility) return;
	
	// Initialize DB connection and query objects.			
	$db = new class_db_connection();		
	$query = new class_db_query($db);	
	
	// Handle single facility input or array.
	if(is_array($post->facility))
	{
		$sql_where = "IN (".str_repeat('?,', count($post->facility) - 1). '?'.")";
		$params = array_merge($params, $post->facility);
		$floor_key = count($params);
	}
	else
	{
		$sql_where = "= ?";
		$params[0] = $post->facility;
		$params[1] = NULL;
		$floor_key = 1;
	}
		
	// First let’s get a list of floors. Theoretically we could make this more efficient by just querying for the 
	// max value and using a counter loop later, but some floors have mixed alphanumeric designations.	
	$query->set_sql('SELECT DISTINCT floor FROM vw_uk_space_room WHERE facility '.$sql_where.' ORDER BY floor');	
			
	$query->set_params($params);
	$query->query();		
	$floors = $query->get_line_object_all();		
	
	// Now for each floor, we need a list of rooms.
	foreach($floors as $floor)
	{
		// Add floor to parameter array.
		$params[$floor_key] = $floor->floor;
					
		// Query for the room list.
		$query->set_sql('SELECT barcode, room, useage_desc FROM vw_uk_space_room WHERE facility '.$sql_where.' AND floor = ?');
		$query->set_params($params);		
		$query->query();
		
		// Get all rows.
		$rooms = $query->get_line_object_all();
		
		// Add the Floor as a an optgroup to markup.
		$markup.='<optgroup label="Floor '.$floor->floor.'">'.PHP_EOL;
		
		// Get each room row object.
		foreach ($rooms as $room)
		{
			$selected = NULL;
			
			// If the room use description from database wasn't blank, let's include it.
			if($room->useage_desc) $use = ' - '.ucwords(strtolower($room->useage_desc));
			
			if($post->current && $post->current == $room->barcode)
			{
				$selected = ' selected ';
			}
			
			// Add the completed option value string to markup.        	
			$markup.='<option value="'.$room->barcode.'"'.$selected.'>'.$room->room.$use.'</option>'.PHP_EOL;		                       
		}
		
		// Close the optgroup.
		$markup.='</optgroup>'.PHP_EOL;
	}	
	
	// Output completed markup to page.
	echo $markup;	
?>