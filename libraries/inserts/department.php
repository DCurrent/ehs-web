<?php

	abstract class DEPARTMENT_OPTIONS
	{
		const FROM_EHS_STAFF = 1;
	}

	define('GROUP', '3he%');

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
		
		foreach($line_all as $line)
		{
			$result .= '<option value="'.$line->number.'"';
			
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
				if($line->number == $preset) $result .= ' selected';
			}
			
			$result .= '>'.$line->number.' - '.ucwords(strtolower($line->name)).'</option>'.PHP_EOL;
		}
		
		return $result;
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
	
	
	/*
	Query for department list items and output result.
	*/		
	
	require('../php/classes/database/main.php'); 	// Database class.
	
	$db			= NULL; // Database connection object.
	$query		= NULL; // Query object.
	$result 	= NULL; // Final output.
	$line_all	= NULL;	// Array of line objects for department list.
	$line		= NULL;	// Line object for department list.
	$preset		= NULL; // Initial selected value.
	$post 		= new post(); // Initialize post from standard object.
	
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

	switch ($post->sql_from)
	{
		case DEPARTMENT_OPTIONS::FROM_EHS_STAFF:
			$from = 'FROM dbo.tbl_staff INNER JOIN dbo.vw_uk_space_department ON dbo.tbl_staff.department = dbo.vw_uk_space_department.number';
			break;
		default:
			$from = 'FROM vw_uk_space_department';
			break;			
	}

	if($post->grouped)
	{	
		
		// Query for results.
		$query->set_sql('SELECT DISTINCT number, name '.$from.'  WHERE number LIKE ? ORDER BY name');
		$query->set_params(array(GROUP));		
		$query->query();
		
		
		$line_all = $query->get_line_object_all();		 
		
		$result  = '<optgroup label="EHS">'.PHP_EOL;		
		$result .= line_output($line_all, $preset);
		$result .= '</optgroup>'.PHP_EOL;
		
		
		// Query for results.
		$query->set_sql('SELECT DISTINCT number, name '.$from.' WHERE number NOT LIKE ? ORDER BY name');
		$query->set_params(array(GROUP));
		$query->query();
		$line_all = $query->get_line_object_all();		 
		
		$result .= '<optgroup label="Non EHS">'.PHP_EOL;
		$result .= line_output($line_all, $preset);	
		$result .= '</optgroup>'.PHP_EOL;	
	}
	else
	{
		// Query for results.
		$query->set_sql('SELECT DISTINCT number, name '.$from.' ORDER BY name');
		$query->query();
		$line_all = $query->get_line_object_all();		 
		
		$result = line_output($line_all, $preset);
	}
	
	echo $result;	
	
?>