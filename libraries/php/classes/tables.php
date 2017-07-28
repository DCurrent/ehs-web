<?php 

class class_tables {

	/*
	Tables
	Damon Vaughn Caskey
	2013-03-21
	
	Miscellaneous table functions.
	*/
	
	public 	$markup 		= NULL;	//Resulting markup output. Typically a table.
	private $utl			= NULL;	//Utility class object.
	
	function __construct($dep)
	{
		/*
		Constructor
		Damon Vaughn Caskey
		2013_01_21
		
		Class constructor.
		*/
		
		/* Import object dependencies. */
		$this->utl = $dep['Utl'];
						
		/* Verify object dependencies. */
		if(!$this->utl)	trigger_error('Missing object dependency: Utility.', E_USER_ERROR);		
	}
	
	public function tables_db_output($oDB, $bRowCount = TRUE, $cFieldSkip = array())
	{	
		/*
		tables_db_output
		Damon Vaughn Caskey
		2013-03-20
		
		Create complete table markup from database query.
		
		$oDB: Object with object variables populated by query.
		$bRowCount: True = Display a row count preceding table.
		$cFieldSkip['<fieldname>', ...]: Array of fields from query to skip when creating table.
		*/
		
		$i			= 0;	// General working counter.
		$result		= NULL;	// Output string.
		$rowCount 	= NULL;	// Count of records retrieved by query.
		$metaArray	= NULL;	// Array of metadata collections.
		$metadata	= NULL;	// Metadata collection (field name, type, etc.) for database columns.
		$metaValue	= NULL;	// Individual item value from metadata collection.
		$fieldsUsed	= NULL; // Field name array.
		$name		= NULL;	// Table markup write in: Field name.
		$value 		= NULL;	// Table markup write in: Field value.
		$id			= NULL;	// Additional string added to element ID to ensure it is unique.
		
		// We'll use microtime to ensure our element IDs will be unique.
		$id	= microtime(TRUE);
		
		// If a row count is requested, let's add it to the markup here.
		if($bRowCount)
		{
			// Dereference rowcount.
			$rowCount = $oDB->DBRowCount;
			
			// Concatenate rowcount markup. 
			$result .= '<span id="row_count_'.$id.'" class="row_count">' .$rowCount. ' records found.</span>'.PHP_EOL;
		}
		
		$result .= '<div id="container_table_'.$id.'" class="overflow tablesorter">'.PHP_EOL.'<table id="table_'.$id.'">'.PHP_EOL.'<thead>'.PHP_EOL.'<tr>';	
		
		// Make temp flipped copy of fieldskip array.		
		$tmpFieldSkip = array_flip($cFieldSkip);		
		
		//First lets create the table header, along with a list of fields that will
		//actually be used in table cells.
		
		// Dereference array of metadata (coloums).
		$metaArray = $oDB->cDBMeta;
		
		// Loop each item in array of metadata collections.	
		foreach($metaArray as $metadata)
		{	
			// If this is the field's name, derefernce the value.
			$metaValue = $metadata['Name'];
									
			// Compare field name to field skip array.
			// If there is no match, then add the fields name to
			// table header, and populate list of fields that
			// will be ouput to table cells.
			if(!isset($tmpFieldSkip[$metaValue]))
			{						
				// Output to table header markup and populate name array.									
				$result .= '<th>'.$metaValue.'</th>';	
				
				// Populate list of "use this" fields. Use incemented i as element index.
				$fieldsUsed[$i++] = $metaValue;																											
			}		
		}		
		
		$result .= '</tr>'.PHP_EOL.'</thead>'.PHP_EOL.'<tbody>'.PHP_EOL;
				
		// Output query results as table.
		while($oDB->db_line(SQLSRV_FETCH_ASSOC))
		{			
						
			// Insert table row and style.
			$result .= '<tr>';
			
			// Loop through list of useable fields and populate
			// the table markup accordingly.
			foreach($fieldsUsed as $name)
			{			
				$value 	= $oDB->DBLine[$name];
				$result .= '<td>'.$value.'</td>';
			}					
			
			$result .= '</tr>'.PHP_EOL;
		}
		
		// Add closing markup.
		$result .= '</tbody>'.PHP_EOL.'</table>'.PHP_EOL.'</div><!--/container_table_'.$id.'-->'.PHP_EOL;
		
		$this->markup = $result;		
		
		return $result;
	}	
	
	public function tables_db_markup($query, $rowCount = TRUE)
	{	
		/*
		tables_db_markup
		Damon Vaughn Caskey
		2014-06-14
		
		Create complete table markup from database query.
		
		$query: Query object.
		$bRowCount: True = Display a row count preceding table.
		$cFieldSkip['<fieldname>', ...]: Array of fields from query to skip when creating table.
		*/
		
		$i			= 0;	// General working counter.
		$result		= NULL;	// Output string.
		$rowCount 	= NULL;	// Count of records retrieved by query.
		$metaArray	= NULL;	// Array of metadata collections.
		$metadata	= NULL;	// Metadata collection (field name, type, etc.) for database columns.
		$metaValue	= NULL;	// Individual item value from metadata collection.
		$fieldsUsed	= NULL; // Field name array.
		$name		= NULL;	// Table markup write in: Field name.
		$value 		= NULL;	// Table markup write in: Field value.
		$id			= NULL;	// Additional string added to element ID to ensure it is unique.
		
		// We'll use microtime to ensure our element IDs will be unique.
		$id	= 'test';// microtime(TRUE);
		
		// If a row count is requested, let's add it to the markup here.
		if($rowCount)
		{
			// Dereference rowcount.
				//$rowCount = $query->get_row_count();
			
			// Concatenate rowcount markup. 
				//$result .= '<span id="row_count_'.$id.'" class="row_count">' .$rowCount. ' records found.</span>'.PHP_EOL;
		}
		
		$result .= '<div id="container_table_'.$id.'" class="overflow">'.PHP_EOL.'<table id="table_'.$id.'" class="tablesorter">'.PHP_EOL.'<thead>'.PHP_EOL.'<tr>'.PHP_EOL;	
		//
			
		// Let's create the table header.
		
		// Dereference array of metadata (coloums).
		$metaArray = $query->get_field_metadata();
		
		// Loop each item in array of metadata collections.	
		foreach($metaArray as $metadata)
		{	
			// If this is the field's name, derefernce the value.
			$metaValue = $metadata['Name'];		
								
			// Output to table header markup.									
			$result .= '<th>'.$metaValue.'</th>'.PHP_EOL;				
		}		
		
		$result .= '</tr>'.PHP_EOL.'</thead>'.PHP_EOL.'<tfoot>'.PHP_EOL.'<tr>'.PHP_EOL.'</tr>'.PHP_EOL.'</tfoot>'.PHP_EOL.'<tbody>'.PHP_EOL;
		
		// Get the 2D array of rows/columns.
		$line_array = $query->get_line_array_all();			
		
		foreach($line_array as $row)
		{
			// Insert table row and style.
			$result .= '<tr>';
						
			foreach($row as $field)
			{
				$result .= '<td>'.$field.'</td>'.PHP_EOL;
			}
		
			$result .= '</tr>'.PHP_EOL;
		}		
				
		// Add closing markup.
		$result .= '</tbody>'.PHP_EOL.'</table>'.PHP_EOL.'</div><!--/container_table_'.$id.'-->'.PHP_EOL;
		
		$result .= '<script>'.PHP_EOL.
			'$(document).ready(function()'.PHP_EOL. 
				'{'.PHP_EOL. 
					'$("#table_'.$id.'").tablesorter();'.PHP_EOL.
				'}'.PHP_EOL. 
			');'.PHP_EOL.
			'</script>';
		
		$this->markup = $result;		
		
		return $result;
	}	
}
?>
