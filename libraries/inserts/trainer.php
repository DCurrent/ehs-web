<?php

	abstract class OPTIONS
	{
		const GROUP = '3he%';
	}

	class post
	{
		public $current = NULL;
		public $default = NULL;
		public $grouped = NULL;
		public $sql_from = NULL;
			
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

	function line_output($line_all, $preset = NULL)
	{
		/*
		
		$line_all: 	Array of line objects.
		$preset:	Value to mark selected if found.
		*/
		
		$line = NULL; 	// Single line object.
		$result = NULL;	// Final result output.
		$preset_ele = NULL; // If needed, placeholder for preset array element.
		
		if($preset != '')
		{
			$preset = explode(',', $preset);
		}
		
		if(is_array($line_all))
		{
			foreach($line_all as $line)
			{
				$result .= '<option value="'.$line->id.'"';
				
				if(is_array($preset))
				{				
					foreach ($preset as $preset_ele)
					{
						echo $preset_ele;
						
						// If this is the preset value, mark it selected.
						if($line->number == $preset_ele) $result .= ' selected';
					}
				}
				else
				{				
					// If this is the preset value, mark it selected.
					if($line->id == $preset) $result .= ' selected';
				}
				
				$result .= '>'.$line->name_l.', '.$line->name_f.'</option>'.PHP_EOL;
			}
		}
		return $result;
	}
	
	
	/*
	Query for list items and output result.
	*/		
	
	require('../php/classes/database/main.php'); 	// Database class.
	
	$db			= NULL; // Database connection object.
	$query		= NULL; // Query object.
	$result 	= NULL; // Final output.
	$line_all	= NULL;	// Array of line objects for department list.
	$line		= NULL;	// Line object for department list.
	$preset		= NULL; // Initial selected value.
	$post 		= new post();
	
	// Let's get the initial selected value. We'll use current if it's not blank. Otherwise
	// fall back to default no matter what its value (if any) is.
	if($post->current)
	{
		$preset = $post->current;
	}
	else
	{
		$preset = $post->default;
	}
		
	// Initialize DB connection and query objects.
	// We don't need to update, so use fastest cursor.	
	$options = new class_db_query_options();	
	$options->set_scrollable(SQLSRV_CURSOR_FORWARD);
	$db		= new class_db_connection();
	$query 	= new class_db_query($db);	

	if($post->grouped)
	{	
		
		// Query for results.
		$query->set_sql('SELECT DISTINCT id, name_f, name_l FROM tbl_staff WHERE instructor = 1 AND department LIKE ? AND active = 1 ORDER BY name_l, name_f');
		$query->set_params(array(OPTIONS::GROUP));		
		$query->query();
		
		
		$line_all = $query->get_line_object_all();		 
		
		$result  = '<optgroup label="EHS (Active)">'.PHP_EOL;		
		$result .= line_output($line_all, $preset);
		$result .= '</optgroup>'.PHP_EOL;
		
		
		// Query for results.
		$query->set_sql('SELECT DISTINCT id, name_f, name_l FROM tbl_staff WHERE instructor = 1 AND department LIKE ? AND active = 0 ORDER BY name_l, name_f');
		$query->set_params(array(OPTIONS::GROUP));		
		$query->query();
		
		
		$line_all = $query->get_line_object_all();		 
		
		$result .= '<optgroup label="EHS (Inactive)">'.PHP_EOL;		
		$result .= line_output($line_all, $preset);
		$result .= '</optgroup>'.PHP_EOL;
		
		// Query for results.
		$query->set_sql("SELECT DISTINCT id, name_f, name_l FROM tbl_staff WHERE instructor = 1 AND (department NOT LIKE ? OR (department IS NULL OR department = '')) ORDER BY name_l, name_f");
		$query->set_params(array(OPTIONS::GROUP));
		$query->query();
		$line_all = $query->get_line_object_all();		 
		
		$result .= '<optgroup label="Other">'.PHP_EOL;
		$result .= line_output($line_all, $preset);	
		$result .= '</optgroup>'.PHP_EOL;	
	}
	else
	{
		// Query for results.
		$query->set_sql('SELECT DISTINCT id, name_f, name_l FROM tbl_staff WHERE instructor = 1 ORDER BY name_l, name_f');
		$query->set_params(array(OPTIONS::GROUP));
		$query->query();
		$line_all = $query->get_line_object_all();		 
		
		$result = line_output($line_all, $preset);
	}
	
	echo $result;
	
?>