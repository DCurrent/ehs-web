<?php

interface DB_DEFAULTS_old
{
	// Connection options.
	const HOST 			= 'GENSQLAGL\general';		// Database host (server name/address)
	const NAME 			= 'ehsinfo';			// Database logical name.
	const USER 			= 'EHSInfo_User';		// User name to access database.
	const PASSWORD 		= 'ehsinfo';			// Password to access database.
	
	// Query options.
	const SCROLLABLE 	= SQLSRV_CURSOR_STATIC; // Cursor type.
	const SENDSTREAM 	= TRUE;					// Send whole parameter stream, or send chunks.
	const TIMEOUT		= 300;					// Query time out in seconds.	
	const FETCH_TYPE	= SQLSRV_FETCH_ASSOC;	// Default row array fetch type.
	
	// Extras.
}


class class_db_old_query_options implements DB_DEFAULTS_old
{	
	private $scrollable_m 	= NULL;	// Cursor type (http://msdn.microsoft.com/en-us/library/ee376927.aspx).
	private $sendstream_m 	= NULL; // Send all stream data at execution (TRUE), or to send stream data in chunks (FALSE)
	private $timeout_m 		= NULL;	// Query timeout in seconds.
	
	function __construct($scrollable = DB_DEFAULTS_old::SCROLLABLE, $sendstream = DB_DEFAULTS_old::SENDSTREAM, $timeout = DB_DEFAULTS_old::TIMEOUT)
	{
		$this->scrollable_m = $scrollable;
		$this->sendstream_m = $sendstream;
		$this->timeout_m	= $timeout;
	}
	
	public function get_scrollable()
	{
		// Return data member.
		return $this->scrollable_m;
	}
	
	public function get_sendstream()
	{
		// Return data member.
		return $this->timeout_m;
	}
	
	public function get_timeout()
	{
		// Return data member.
		return $this->timeout_m;
	}
	
	public function set_scrollable($value)
	{
		// Set data member.
		$this->scrollable_m = $value;
	}
	
	public function set_sendstream($value)
	{
		// Set data member.
		$this->sendstream_m = $value;
	}
	
	public function set_timeout($value)
	{
		// Set data member.
		$this->timeout_m = $value;
	}
}

class class_db_old_connect_params implements DB_DEFAULTS_old
{	
	/*
	Database connection structure.
	*/
	
	protected $host_m  		= NULL;	// Server name or address.
	protected $name_m	 	= NULL; // Database name.
	protected $user_m	 	= NULL;	// User name to access database.
	protected $password_m 	= NULL;	// Password for user to access database.
	
	function __construct($host = DB_DEFAULTS_old::HOST, $name = DB_DEFAULTS_old::NAME, $user = DB_DEFAULTS_old::USER, $password = DB_DEFAULTS_old::PASSWORD)
	{
		$this->host_m = $host;
		$this->name_m = $name;
		$this->user_m = $user;
		$this->password_m = $password;
	}
	
	public function get_db_host()
	{
		// Return data member.
		return $this->host_m;
	}
	
	public function get_db_name()
	{
		// Return data member.
		return $this->name_m;
	}
	
	public function get_db_user()
	{
		// Return data member.
		return $this->user_m;
	}
	
	public function get_db_password()
	{
		// Return data member.
		return $this->password_m;
	}
	
	public function set_db_host($value)
	{
		// Set data member.
		$this->host_m = $value;
	}
	
	public function set_db_name($value)
	{
		// Set data member.
		$this->name_m = $value;
	}
	
	public function set_db_user($value)
	{
		// Set data member.
		$this->user_m = $value;
	}
	
	public function set_db_password($value)
	{
		// Set data member.
		$this->password_m = $value;
	}
}

class class_db implements DB_DEFAULTS_old { 

	/*
	class_db - //www.caskeys.com/dc/?p=4946
	Damon Vaughn Caskey
	2012-11-13
	
	Expandable MSSQL database handler.
	*/
			
	public	$sql			= NULL;					// Sql string.
	public	$params			= NULL;					// Parameter array.		
	public	$DBLine			= NULL;					// Line array.
	public 	$DBFMeta		= NULL;					// Line metadata array.
	public 	$DBFCount		= NULL;					// Line field count.
	public	$DBRowCount		= NULL;					// Table row count.
	public	$DBRowsAffect	= NULL;					// Number of rows affected by an action query.
	public 	$DBResult		= NULL;					// *Database query result ID resource.
	public 	$DBStatement	= NULL;					// Database prepared query statement ID resource.
	
	private	$DBConn 		= NULL;					// Database connection ID resource.
	private $connect		= NULL;					// Database connection parameters.
	private $query_options	= NULL;					// sqlsrv_query parameters object.
	
	private	$dependencies	= NULL;					// Injected dependencies object.
	private $lines 			= NULL;					// Array of line arrays.
	
	function __construct(class_db_old_connect_params $connect = NULL, class_db_old_query_options $query_options = NULL)
	{
		/*
		Constructor
		Damon Vaughn Caskey
		2012_12_29
		
		Class constructor.
		*/		
		
		// Set up connection options object.
		$this->connect = new class_db_old_connect_params();
		
		// If connect parameter object set, use it to define connect member object values.
		if($connect)
		{		
			$this->connect->set_db_host($connect->get_db_host());
			$this->connect->set_db_name($connect->get_db_name());
			$this->connect->set_db_user($connect->get_db_user());
			$this->connect->set_db_password($connect->get_db_password());
		}
	
		// Connect to database server.
		$this->db_connect();
		
		// Let's set up query options object.
		$this->query_options = new class_db_old_query_options();
		
		// If $query_options parameter object set, use it to define connect member object values.
		if($query_options)
		{
			$this->query_options->set_scrollable($query_options->get_scrollable());
			$this->query_options->set_sendstream($query_options->get_sendstream());
			$this->query_options->set_timeout($query_options->get_timeout());
		}
	}
	
	function __destruct() 
	{
		/*
		destructor
		Damon Vaughn Caskey
		2012-12-29	
		*/
		
		// Close DB connection.
		$this->db_close();
   	}
	
	private function db_error()
	{
		
		/*
		db_error
		Damon Vaughn Caskey
		2012_06_08
		
		Detect database errors, process and send to error handling.
		
		$cLocation:	Instance and code location where error trap was called. Aids in dubugging.
		*/
		
		$errors		= NULL;		// Errors list array.
		$error		= NULL;		// Individual error output array.
		$params		= NULL;		// Parameter array.
		$param		= NULL;		// Individual item from parameter array.
		$details	= NULL; 	// Error detail string.
		$result		= FALSE;	// Final result (FALSE = No Errors, TRUE = Erros).
		
		// Get error collection.
		$errors = sqlsrv_errors();		
		
		return;
		
		// Any errors found?
		if($errors)					
		{			
			// Loop through error collection. 
			foreach($errors as $error)
			{
				// Ignore these codes; they are informational only:
					// 0:		Cursor type changed.
					// 5701:	Changed database context.
					// 5703:	Changed language setting. 
				if($error['code'] != 0 && $error['code'] != 5701 && $error['code'] != 5703)
				{	
					// Concatenate start of detail string.
					$details = 'Function: ' .__METHOD__. ' || SQL String: '.$this->sql. ' || SQL Parameters: ';	
																												
					// Dump parameter array into single string.		
					// Dereference parameter array.
					$params = $this->params;
					
					// Parameter array passed?
					if(isset($params))								
					{
						// Loop parameter collection.
						foreach($params as $param)				
						{
							// Add to error parameter string.
							$details .= $param .", ";				
						}
					}
					
					// Catch and document the exception.								
					try 
					{
						// Throw an exception for this error.
						throw new Exception('Test');
					}
					catch (Exception $e) 
					{
						echo 'Caught exception: ',  $e->getMessage(), "\n";
						trigger_error(date(DATE_ATOM).', DB error(s) at function: ' .__METHOD__.'. See log.', E_USER_ERROR);
					}
					
					$result = TRUE;
				}							
			}			
		}
		
		return $result;				
	}
	
	protected function db_rows_affected()
	{
		/*
		db_rows_affected
		Damon Vaughn Caskey
		2014-03-10
		
		Gets number of rows modified by last query, sets to class level data member
		and returns.
		*/
				
		// Get rows affected.
		$rows = sqlsrv_rows_affected($this->DBResult);
	
		// Set rows affected data member.
		$this->DBRowsAffect = $rows;
		
		// Return results.
		return $rows;
	}
	
	public function db_basic_action($query, $params, $line=FALSE)
	{
		/*
		db_basic_action
		Damon Vaughn Caskey
		2012_11_13
		
		Execute an action query with single call.		
		
		$query: 	SQL string.
		$params:	Parameter array.
		$l:		Populate line array with first row (only works if OUTPUT is used)?
		*/
		
		// Execute query.
		$this->db_query($query, $params);
		
		// Set rows affected.
		$this->DBRowsAffect = $this->db_rows_affected();		
		
		// If line is called for, return first row from query.
		if($line===TRUE)
		{
			$this->db_line();			
		}
		
		return $this->DBRowsAffect;
	}	
	
	public function db_basic_select($query, $params, $line=FALSE, $row_count = FALSE, $field_count = FALSE, $metadata = FALSE )
	{
		/*
		basic_select
		Damon Vaughn Caskey
		2012_11_13
		
		Query and populate common variables from database with a single call.
				
		$query: 	SQL string.
		$params:	Parameter array.
		$line:		Populate line array with first row?
		*/
		
		// Execute query.
		$this->db_query($query, $params);
		
		// Get row count.
		if($row_count === TRUE)
		{
			$this->db_get_row_count();	
		}
		
		// Get field count.
		if($row_count === TRUE) 
		{
			$this->db_field_count();
		}
		
		// Get metadata.
		if($metadata === TRUE)
		{
			$this->db_field_metadata();	
		}
		
		if($line===TRUE)
		{
			$this->db_line();			
		}
		
		return $this->DBLine;
	}	
	
	public function db_close()
	{
		/*
		close
		Damon Vaughn Caskey
		2012_11_13
		
		Close current conneciton.
		*/
				
		$result 	= FALSE;			// Connection present and closed?
		$db_conn 	= $this->DBConn;	// Database connection.
		
		// Close DB conneciton.
		if($db_conn)
		{
			sqlsrv_close($db_conn);
			$result = TRUE;
		}
		
		return $result;
	}
	
	public function db_connect()
	{		 
		/*
		db_connect
		Damon Vaughn Caskey
		2012_11_13
		
		Connect to database host and store reference to public variable.		
		*/
			
		$db_cred = NULL; //Credentials array.
		
		// Dereference member variables.
		$host = $this->connect->get_db_host();
		$name = $this->connect->get_db_name();
		$user = $this->connect->get_db_user();
		$password = $this->connect->get_db_password();
		
		//$host = 'GENSQLAGL\general', $name = 'ehsinfo', $user = 'EHSInfo_User', $password = 'ehsinfo'
		
		// Set up credential array.
		$db_cred = array('Database' => $name, 'UID' => $user, 'PWD' => $password);
									
		// Establish database connection.
		$this->DBConn = sqlsrv_connect($host, $db_cred);		
		
		echo "<!-- class_db->DBConn: ".$this->DBConn." -->";
		
		// False returned. Database connection has failed.
		if($this->DBConn === FALSE)
		{
			// Stop script and log error.
			$this->db_error();			
		}	
	}

	public function db_execute()
	{
		/*
		db_execute
		Damon Vaughn Caskey
		2012_11_13
		
		Execute prepared query.		
		*/
	
		// Execute statement.
		$this->DBResult = sqlsrv_execute($this->DBStatement);
		
		// Error trapping.
		$this->db_error();
		
		// Set rows affected.
		$this->DBRowsAffect;
		
		// Return ID resource.
		return $this->DBResult;		
	}

	public function db_field_count()
	{
		/*
		db_field_count
		Damon Vaughn Caskey
		2012_11_13
		
		Get number of fields from query result.		
		*/
		
		// Get field count.
		$this->DBFCount = sqlsrv_num_fields($this->DBResult);
		
		// Error trapping.
		$this->db_error();
		
		// Return field count.
		return $this->DBFCount;
	}
	
	public function db_field_metadata()
	{
		/*
		db_field_metadata
		Damon Vaughn Caskey
		2012_11_13
		
		Fetch table rows metadata array (column names, types, etc.).		
		*/
		
		// Get metadata array.
		$this->cDBMeta = sqlsrv_field_metadata($this->DBResult);
		
		// Error trapping.
		$this->db_error();
		
		// Return metadata array.
		return $this->cDBMeta;
	}

	protected function db_get_row_count()
	{
		/*
		db_row_count
		Damon Vaughn Caskey
		2014-03-10
		
		Get number of rows returned by last query, set to class level data member
		and return.		
		*/
		
		// Get row count.
		$rows = sqlsrv_num_rows($this->DBResult);
		
		// Set row count data member.
		$this->DBRowCount = $rows;	
		
		// Return count.
		return $this->DBRowCount;
	}

	public function db_line($fetchType = self::FETCH_TYPE)
	{
		/*
		db_line
		Damon Vaughn Caskey
		2012_11_13
		
		Fetch line array from table rows.
				
		$fetchType:	Row key fetch type
		*/
		
		$dbline = NULL;	// Database line array.
		
		// Get line array.
		$dbline = sqlsrv_fetch_array($this->DBResult, $fetchType);
		
		// Set line array data member.
		$this->DBLine = $dbline;		
				
		// Error trapping.
		$this->db_error();
		
		// Return line array.
		return $dbline;
	}
	
	public function db_line_array($fetchType = DB_DEFAULTS_old::FETCH_TYPE)
	{
		/*
		*/
		
		$i = 0;			// Index counter.
		$result = NULL;	// Database line array.
		
		while($oDB->db_line(SQLSRV_FETCH_NUMERIC))
		{
			$result[$i];			
			$i++;
		}
		
		// Populate class array of lines.
		$this->lines = $result;
				
		// Error trapping.
		$this->db_error();
		
		// Return line array.
		return $result;
	}
		
	public function db_prepare($query, $params, db_query_options $options = NULL)
	{
		/*
		db_prepare
		Damon Vaughn Caskey
		2012_11_13
		
		Prepare query statement.		
		
		$query: 	Basic SQL statement to execute.
		$params:	Parameters to pass with query (prevents SQL injection).
		$options:	Options for cursor array, etc.
		*/
	
		$dbstatement 	= NULL; 	// Database statement reference.
		$query_options	= array();	// Query options array.
	
		// Set data members.
		$this->sql = $query;
		$this->params = $params;
	
		// Break down options object to array.
		if($options)
		{
			$query_options['Scrollable'] = $options->get_scrollable();
			$query_options['Sendstream'] = $options->get_sendstream();
			$query_options['Timeout'] = $options->get_timeout();
		}
	
		// Prepare query		
		$dbstatement = sqlsrv_prepare($this->DBConn, $query, $params, $query_options);
		
		// Set DB statement data member.
		$this->DBStatement = $dbstatement;
		
		// Error trapping.
		$this->db_error();
		
		// Return statement reference.
		return $dbstatement;		
	}
	
	public function db_query($query, $params, $options = array("Scrollable" => DB_DEFAULTS_old::SCROLLABLE))
	{
		/*
		db_query
		Damon Vaughn Caskey
		2012_11_13
		
		Prepare and execute query.
		
		$query: 	Basic SQL statement to execute.
		$params:	Parameters to pass with query (prevents SQL injection).
		$options:	Options for cursor array, etc.
		*/
	
		// Set data members.
		$this->sql = $query;
		$this->params = $params;
	
		// Execute query.
		$this->DBResult = sqlsrv_query($this->DBConn, $query, $params, $options);
		
		echo "<!-- class_db->db_query(query): ".$query." -->";
		
		// Error trapping.
		$this->db_error();
		
		// Return query ID resource.
		return $this->DBResult;		
	}
}


//////////////////////////////////////////////////////



?>
