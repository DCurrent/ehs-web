<?php

require_once('interface.php');

class class_db_connect_params implements db_connect_params
{	
	/*
	Database connection structure.
	*/
	
	private
		$host_m		= NULL,	// Server name or address.
		$name_m		= NULL,	// Database name.
		$user_m		= NULL,	// User name to access database.
		$password_m	= NULL,	// Password for user to access database.
		$charset_m	= NULL;	// Character set.
	
	public function __construct()
	{
		$this->charset_m = DB_DEFAULTS::CHARSET;
		$this->host_m = DB_DEFAULTS::HOST;
		$this->name_m = DB_DEFAULTS::NAME;
		$this->user_m = DB_DEFAULTS::USER;
		$this->password_m = DB_DEFAULTS::PASSWORD;
	}
	
	// Accessors.
	public function charset()
	{		
		return $this->charset_m;
	}	
	
	public function get_db_host()
	{		
		return $this->host_m;
	}	
	
	public function get_db_name()
	{		
		return $this->name_m;
	}

	public function get_db_user()
	{		
		return $this->user_m;
	}

	public function get_db_password()
	{		
		return $this->password_m;
	}

	// Mutators.
	public function set_charset($value)
	{		
		$this->charset_m = $value;
	}

	public function set_db_host($value)
	{		
		$this->host_m = $value;
	}

	public function set_db_name($value)
	{		
		$this->name_m = $value;
	}

	public function set_db_user($value)
	{		
		$this->user_m = $value;
	}

	public function set_db_password($value)
	{		
		$this->password_m = $value;
	}
}

class class_db_connection implements db_connection 
{ 

	/*
	class_db_connection
	Damon Vaughn Caskey
	2014-04-04
	
	Database host connection manager.
	*/
			
	private $connect_m = NULL;	// Database connection resource.
			
	public function __construct(class_db_connect_params $connect = NULL)
	{
		/*
		Constructor
		Damon Vaughn Caskey
		2014-04-05
		
		Class constructor.
		*/		
		
		// Set up connection options object.
		$this->connect = new class_db_connect_params();
		
		// If connect parameter object set, use it to define connect member object values.
		if($connect)
		{		
			$this->connect->set_charset($connect->charset());
			$this->connect->set_db_host($connect->get_db_host());
			$this->connect->set_db_name($connect->get_db_name());
			$this->connect->set_db_user($connect->get_db_user());
			$this->connect->set_db_password($connect->get_db_password());
		}
	
		// Connect to database server.
		$this->open_connection();
	}
	
	public function __destruct() 
	{
		/*
		destructor
		Damon Vaughn Caskey
		2012-12-29	
		*/
		
		// Close DB connection.
		$this->close_connection();
   	}
	
	// Return data member.
	public function get_connection()
	{	
		return $this->connect_m;
	}
	
	// Connect to database host. Returns connection.
	public function open_connection()
	{		 
		/*
		open_connection
		Damon Vaughn Caskey
		2014-04-05
		
		Connect to database host.		
		*/
			
		$connect = NULL; // Database connection reference.
		$db_cred = NULL; // Credentials array.
		
		// Dereference member variables.
		$charset = $this->connect->charset();
		$host = $this->connect->get_db_host();
		$name = $this->connect->get_db_name();
		$user = $this->connect->get_db_user();
		$password = $this->connect->get_db_password();
		
		// Set up credential array.
		$db_cred = array('Database' => $name, 
						'UID' => $user, 
						'PWD' => $password,
						'CharacterSet' => $charset);
									
		// Establish database connection.
		$connect = sqlsrv_connect($host, $db_cred);		
				
		// False returned. Database connection has failed.
		if($connect === FALSE)
		{			
			// Stop script and log error.			
		}		
		
		// Set connect data
		$this->connect_m = $connect;
		
		return $connect;
	}
	
	// Close database connection and returns TRUE, or return FALSE if connection does not exist.
	public function close_connection()
	{
		/*
		close_connection
		Damon Vaughn Caskey
		2014-04-05
		
		Close database conneciton.
		*/
				
		$result 	= FALSE;			// Connection present and closed?
		$connect 	= $this->connect_m;	// Database connection.
		
		// Close DB conneciton.
		if($connect)
		{
			
			sqlsrv_close($connect);
			$this->connect_m = NULL;
			$result = TRUE;
		}
		
		return $result;
	}
}

?>