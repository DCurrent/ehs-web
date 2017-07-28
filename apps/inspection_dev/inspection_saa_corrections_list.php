<?php

	require(__DIR__.'/source/main.php');

	class local_class_saa_corrections_params extends blair_class_common_data
	{
		private 
			$category 	= NULL,
			$inclusion	= NULL;
			
		public function __construct()
		{
			$this->populate_from_request();
		}
		
		// Accessors
		public function get_category()
		{
			return $this->category;
		}
		
		public function get_inclusion()
		{
			return $this->inclusion;
		}
		
		// Mutators
		public function set_category($value)
		{
			$this->category = $value;
		}
		
		public function set_inclusion($value)
		{
			$this->inclusion = $value;
		}
	}

	// Set up database.
	$db_conn_set = new class_db_connect_params();
	$db_conn_set->set_name(DATABASE::NAME);
	
	$db = new class_db_connection($db_conn_set);
	$query = new class_db_query($db);
	
	// Open local parameters collection object.
	$_obj_params = new local_class_saa_corrections_params();
		
	// Set SQL String/Stored procedure and parameters.
	$query->set_sql('{call inspection_saa_question_list(@category 	= ?,
														@inclusion	= ?)}');
	
	$params = array(array($_obj_params->get_category(), SQLSRV_PARAM_IN),
					array($_obj_params->get_inclusion(), SQLSRV_PARAM_IN));
	
	$query->set_params($params);
	$query->query();
	
	// Set class object we will push rows from datbase into.
	$query->get_line_params()->set_class_name('blair_class_audit_question_data');
	
	// Establish linked list of objects and populate with rows assuming that 
	// rows were returned. 
	$_obj_data_list_list = new SplDoublyLinkedList();
	if($query->get_row_exists() === TRUE) $_obj_data_list_list = $query->get_line_object_list();
		
	// Default option.
	?>
	
    <option value ="">Select Correction</option>
    
    <?php
	// Iterate through linked list of objects, and output markup for each.
	for($_obj_data_list_list->rewind(); $_obj_data_list_list->valid(); $_obj_data_list_list->next())
	{						
		$_obj_data_list = $_obj_data_list_list->current();
		
		?>        
        <option value = "<?php echo $_obj_data_list->get_id(); ?>"><?php echo $_obj_data_list->get_finding(); ?></option>
        <?php
	}	
?>

