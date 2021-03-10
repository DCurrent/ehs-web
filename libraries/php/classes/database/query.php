<?php

require_once('error.php');

class class_db_line_params implements db_line_params 
{
	private 
		$fetchtype_m	= NULL,		// Line array fetch type.
		$row_m			= NULL,		// Row to access in a result set that uses a scrollable cursor.
		$offset_m		= NULL,		// Row to access if row is absolute or relative. 
		$class_name_m	= NULL,		// Class to instantiate on an object fetch.
		$class_params_m = array();	// Parameter array to pass into class constructor.
	
	public function __construct()
	{
		$this->fetchtype_m = DB_DEFAULTS::FETCHTYPE;
		$this->row_m = DB_DEFAULTS::ROW;
		$this->offset_m = DB_DEFAULTS::OFFSET;
	}
	
	// Accessors
	public function get_fetchtype()
	{		
		return $this->fetchtype_m;
	}
	
	public function get_row()
	{		
		return $this->row_m;
	}	
	
	public function get_offset()
	{		
		return $this->offset_m;
	}
	
	public function get_class_name()
	{
		return $this->class_name_m;
	}
	
	public function get_class_params()
	{
		return $this->class_params_m;
	}
	
	// Mutators
	public function set_class_name($value)
	{		
		$this->class_name_m = $value;
	}
	
	public function set_class_params(array $value)
	{		
		$this->class_params_m = $value;
	}
	
	public function set_fetchtype($value)
	{		
		$this->fetchtype_m = $value;
	}
	
	public function set_row($value)
	{		
		$this->row_m = $value;
	}
	
	public function set_offset($value)
	{		
		$this->offset_m = $value;
	}
}

class class_db_query_options implements db_query_options
{	
	private 
		$scrollable_m 	= NULL,	// Cursor type (http://msdn.microsoft.com/en-us/library/ee376927.aspx).
		$sendstream_m	= NULL,	// Send all stream data at execution (TRUE), or to send stream data in chunks (FALSE)
		$timeout_m 		= NULL;	// Query timeout in seconds.
		
	public function __construct()
	{
		$this->scrollable_m = DB_DEFAULTS::SCROLLABLE;
		$this->sendstream_m = DB_DEFAULTS::SENDSTREAM;
		$this->timeout_m	= DB_DEFAULTS::TIMEOUT;
	}
	
	// Accessors
	public function get_scrollable()
	{			
		return $this->scrollable_m;
	}
	
	public function get_sendstream()
	{		
		return $this->timeout_m;
	}
	
	public function get_timeout()
	{		
		return $this->timeout_m;
	}
	
	// Mutators
	public function set_scrollable($value)
	{		
		$this->scrollable_m = $value;
	}
	
	public function set_sendstream($value)
	{		
		$this->sendstream_m = $value;
	}
	
	public function set_timeout($value)
	{		
		$this->timeout_m = $value;
	}	
}

class class_db_query implements db_query
{
	private 
		$sql_m			= NULL,		// SQL string.
		$params_m 		= array(),	// SQL parameters.
		$options_m		= NULL,		// Query options object.
		$statement_m	= NULL,		// Prepared/Executed query reference.
		$line_params_m	= NULL,		// Line get options.
		$connect_m		= NULL,		// DB connection object.
		$error_m		= NULL;		// Error handler.
	
	public function __construct(class_db_connection $connect, class_db_query_options $options = NULL, class_db_line_params $line_params = NULL)
	{
		$this->connect_m = $connect->get_connection();
				
		// Initialize error handler.
		$this->error_m = new class_db_error();
				
		// Let's set our object parameters fron an object parameter object.
		// If no line line_params parameter object was passed, define a fresh object. 
		if(!$options) $this->options_m = new class_db_query_options();
		
		// Let's set our line parameters fron a line parameter object.
		// If no line line_params parameter object was passed, define a fresh object. 
		if(!$line_params) $this->line_params_m = new class_db_line_params();		
	}
	
	public function _destruct()
	{
		// Free statement resources.
		sqlsrv_free_stmt($this->statement_m);
	}
	
	public function set_options(class_db_query_options $value)
	{
		$this->options_m = $value;
	}
		
	public function get_options()
	{
		return $this->options_m;
	}
	
	public function set_line_params(class_db_line_params $value)
	{
		$this->line_params_m = $value;
	}
	
	public function get_line_params()
	{
		return $this->line_params_m;
	}
	
	// Return number of fields from query result.
	public function get_field_count()
	{
		/*
		field_count
		Damon Vaughn Caskey
		2014-04-05		
		*/
		
		$count = 0;
		
		// Get field count.
		$count = sqlsrv_num_fields($this->statement_m);
		
		// Error trapping.
		$this->error_m->error();
		
		// Return field count.
		return $count;
	}
	
	// Fetch and return table row's metadata array (column names, types, etc.).
	public function get_field_metadata()
	{
		/*
		db_field_metadata
		Damon Vaughn Caskey
		2014-04-06		
		*/
		
		$meta = array();
		
		// Get metadata array.
		$meta = sqlsrv_field_metadata($this->statement_m);
		
		// Error trapping.
		$this->error_m->error();
		
		// Return metadata array.
		return $meta;
	}
	
	// Fetch line array from table rows.
	public function get_line_array()
	{
		/*
		line_array
		Damon Vaughn Caskey
		2014-04-06
		*/
		
		$line		= FALSE;	// Database line array.
		$statement	= NULL; 	// Query result reference.
		$fetchType	= NULL;		// Line array fetchtype.
		$row		= NULL;		// Row type.
		$offset		= NULL;		// Row position if absolute.
		
		// Dereference data members.
		$statement 	= $this->statement_m;
		$fetchType	= $this->line_params_m->get_fetchtype();
		$row		= $this->line_params_m->get_row();
		$offset		= $this->line_params_m->get_offset();		
		
		// Valid statement and rows found?
		//if($statement && $query->get_row_exists())
		//{				
			// Get line array.
			$line = sqlsrv_fetch_array($statement, $fetchType, $row, $offset);
		//}
		
		// Error trapping.
		$this->error_m->error();
		
		// Return line array.
		return $line;
	}
	
	// Create and return a 2D array consisting of all line arrays from database query.
	public function get_line_array_all()
	{
		/*
		line_array_all
		Damon Vaughn Caskey
		2014-04-06
		*/
	
		$line_array	= FALSE;	// 2D array of all line arrays.
		$line		= NULL;		// Database line array.
				
		// Loop all rows from database results.
		while($line = $this->get_line_array())
		{	
			// Error trapping.
			$this->error_m->error();
				
			// Add line array to 2D array of lines.
			$line_array[] = $line;				
		}		
		
		// Return line array.
		return $line_array;
	}	
	
	// Create and return a linked list consisting of all line objects from database query.
	public function get_line_array_list()
	{
		/*
		line_array_list
		Damon Vaughn Caskey
		2015-06-15
		*/
		
		$result = new SplDoublyLinkedList();		
		$line	= NULL;		// Database line array.
		
		// Loop all rows from database results.
		while($line = $this->get_line_array())
		{				
			// Add line array to list of arrays.
			$result->push($line);
		}
	
		// Return results.
		return $result;
	}
	
	// Fetch and return line object from table rows.
	public function get_line_object()
	{
		/*
		line_object
		Damon Vaughn Caskey
		2014-04-06
		*/
		
		$line			= NULL;		// Database line object.
		$statement		= NULL;		// Query result reference.
		$fetchType		= NULL;		// Line array fetchtype.
		$row			= NULL;		// Row type.
		$offset			= NULL;		// Row position if absolute.
		$class_name		= NULL;		// Class name.
		$class_params	= array();	// Class parameter array.
		
		// Dereference data members.
		$statement 		= $this->statement_m;
		$fetchType		= $this->line_params_m->get_fetchtype();
		$row			= $this->line_params_m->get_row();
		$offset			= $this->line_params_m->get_offset();
		$class			= $this->line_params_m->get_class_name();
		$class_params	= $this->line_params_m->get_class_params();
		
		// Valid statement and rows exist?		
		//if($statement !== FALSE && $this->get_row_exists())
		//{		
			// Get line object.
			$line = sqlsrv_fetch_object($statement, $class, $class_params, $row, $offset);
					
			// Error trapping.
			$this->error_m->error();
		//}
		
		// Return line object.
		return $line;
	}
	
	// Create and return a 2D array consisting of all line arrays from database query.
	public function get_line_object_all()
	{
		/*
		line_object_all
		Damon Vaughn Caskey
		2014-04-06
		*/
		
		$line_array	= array();	// 2D array of all line objects.
		$line		= NULL;		// Database line objects.
		
		// Loop all rows from database results.
		while($line = $this->get_line_object())
		{				
			// Add line object to array of object.
			$line_array[] = $line;
		}
	
		// Return line object.
		return $line_array;
	}
	
	// Create and return a linked list consisting of all line objects from database query.
	public function get_line_object_list()
	{
		/*
		line_object_list
		Damon Vaughn Caskey
		2015-06-15
		*/
		
		$result = new SplDoublyLinkedList();		
		$line	= NULL;		// Database line objects.
		
		// Loop all rows from database results.
		while($line = $this->get_line_object())
		{				
			// Add line object to list of object.
			$result->push($line);
		}
	
		// Return line object.
		return $result;
	}
	
	// Move to and return next result set.
	public function get_next_result()
	{
		$result = FALSE;
		
		$result = sqlsrv_next_result($this->statement_m);
	
		// Error trapping.
		$this->error_m->error();
		
		return $result;
	
	}
	
	// Execute prepared query with current parameters.
	public function execute()
	{
		/*
		db_execute
		Damon Vaughn Caskey
		2014-04-04
		*/
		
		$result     = FALSE;	// Result of execution.
		
		sqlsrv_execute($this->statement_m);
				
		// Error trapping.
		$this->error_m->error();
		
		return $result;	
	}
	
	// Prepare query. Returns statement reference and sends to data member.
	public function prepare()
	{
		/*
		db_prepare
		Damon Vaughn Caskey
		2012-11-13
		~2014-04-03
		*/
	
		$connect	= NULL;		// Database connection reference.
		$statement	= NULL;		// Database statement reference.			
		$sql		= NULL;		// SQL string.
		$params		= array(); 	// Parameter array.
		$options	= NULL;		// Query options object.
		$options_a	= array();	// Query options array.
		
		// Dereference data members.
		$connect = $this->connect_m;
		$sql = $this->sql_m;
		$params = $this->params_m;
		$options = $this->options_m;
	
		// Break down options object to array.
		if($options)
		{
			$options_a['Scrollable'] = $options->get_scrollable();
			$options_a['SendStreamParamsAtExec'] = $options->get_sendstream();
			$options_a['QueryTimeout'] = $options->get_timeout();
		}
	
		// Prepare query		
		$statement = sqlsrv_prepare($connect, $sql, $params, $options_a);
		
		// Error trapping.
		$this->error_m->error();
		
		// Set DB statement data member.
		$this->statement_m = $statement;
		
		// Return statement reference.
		return $statement;		
	}
	
	// Set query sql string data member.
	public function set_sql($value)
	{
		$this->sql_m = $value;
	}
	
	// Return query sql string data member.
	public function get_sql()
	{
		return $this->sql_m;
	}
	
	// Set query sql parameters data member.
	public function set_params(array $value)
	{		
		$this->params_m = $value;
	}
	
	// Return number of records from query result.	
	public function get_row_count()
	{
		/*
		row_count
		Damon Vaughn Caskey
		2014-04-06	
		*/
		
		$count = 0;
		
		// Get row count.
		$count = sqlsrv_num_rows($this->statement_m);	
		
		// Error trapping.
		$this->error_m->error();	
		
		// Return count.
		return $count;
	}
	
	// Verify result set contains any rows.	
	public function get_row_exists()
	{
		/*
		row_exists
		Damon Vaughn Caskey
		2014-08-08	
		*/
		
		$result = FALSE;
		
		// Get row count.
		$result = sqlsrv_has_rows($this->statement_m);	
		
		// Error trapping.
		$this->error_m->error();	
		
		// Return result.
		return $result;
	}
	
	// Prepare and execute query.
	public function query()
	{
		/*
		query
		Damon Vaughn Caskey
		2014-11-13
		*/
		
		$connect	= NULL;		// Database connection reference.
		$statement	= NULL;		// Database result reference.			
		$sql		= NULL;		// SQL string.
		$params 	= array(); 	// Parameter array.
		$options	= NULL;		// Query options object.
		$options_a	= array();	// Query options array.
				
		// Dereference data members.
		$connect = $this->connect_m;
		$sql = $this->sql_m;
		$params = $this->params_m;
		$options = $this->options_m;
	
		// Break down options object to array.
		if($options)
		{
			$options_a['Scrollable'] = $options->get_scrollable();
			$options_a['SendStreamParamsAtExec'] = $options->get_sendstream();
			$options_a['QueryTimeout'] = $options->get_timeout();
		}
	
		// Execute query.
		$statement = sqlsrv_query($connect, $sql, $params, $options_a);
		
		// Error trapping.
		$this->error_m->error();
		
		// Set data member.
		$this->statement_m = $statement;
		
		// Return query ID resource.
		return $statement;
	}
	
	// Return query statement data member.
	public function get_statement()
	{
		return $this->statement_m;
	}
}

?>