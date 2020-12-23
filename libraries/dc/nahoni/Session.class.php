<?php

namespace dc\nahoni;

require_once('config.php');

interface iSession
{
	function get_config();
	function set_config(SessionConfig $value);
}

// Override PHP's default session handling to store data in an MSSQL table. 
class Session implements \SessionHandlerInterface, iSession
{    
	
	private	$config	= NULL;	// Config options.

	function __construct(SessionConfig $config = NULL)
	{
		// Set connection parameters member. If no argument
		// is provided, then create a blank connection
		// parameter instance.
		if($config)
		{
			$this->set_config($config);
		}
		else
		{
			$this->set_config(new SessionConfig);
		}		
	}
	
	function __destruct()
	{
		// echo '__destruct';		
	}
	
	// Accessors
	public function get_config()
	{
		return $this->config;
	}
	
	// Mutators
	public function set_config(SessionConfig $value)
	{
		$this->config = $value;
	}
    
	// Called by PHP to open session. Construct does all the work
	// we'd normally put here, so leave it blank.
   	public function open($savePath, $sessionName)
    {	
		// echo 'open';		
		
		// $savePath: 		Path to locate session file. Unused.
		// $sessionName:	Name of session file. Unused.

		// Return TRUE.
        return TRUE;
    }
	
	// Called by PHP to close session.
    public function close()
    {	
		// echo 'close';
		
		// Return TRUE.
        return TRUE;
    }

	// Locate and read session data from database.
    public function read($id)
    {		
		error_log('read: '.$id);        

		$dbh_pdo_connection = $this->config->get_database();
		
		// Populate database class members with 
		// the SQL string of our stored procedure
		// and its parameter array. Then we can 
		// execute.
		
		$sql_string = 'EXEC '.$this->config->get_sp_prefix().$this->config->get_sp_get().' :id';
		error_log('sql_string: '.$sql_string);
				
		$dbh_pdo_statement = $dbh_pdo_connection->prepare($sql_string);
		
		$dbh_pdo_statement->bindParam(':id', $id, \PDO::PARAM_INT);
		$rowcount = $dbh_pdo_statement->execute();
		
		if($rowcount)
		{			
			$result = $dbh_pdo_statement->fetchObject (__NAMESPACE__.'\Data' );
		}
		else
		{
			$result = new Data();
		}
		
		
		/*
		$sql_string = '{call '.$this->config->get_sp_prefix().$this->config->get_sp_get().'(@id = ?)}';
		
		$iDatabase->set_sql($sql_string);
		
		$params = array(array(&$id, SQLSRV_PARAM_IN));
		$iDatabase->set_param_array($params);
		
		$iDatabase->query_run();		
		
		// If there is a row returned from the 
		// database we need to send the name
		// of our data class so our database
		// handler can populate it (data class) 
		// as an object with the row data.
		//
		// If we got no rows returned, then
		// establish a blank copy of our
		// data class instead.
		//
		// Either way, we get and return the
		// value of "session_data" member. 
		
		if($iDatabase->get_row_exists())
		{
			// Set class and acquire object.
			$iDatabase->get_line_config()->set_class_name(__NAMESPACE__.'\Data');
			$result = $iDatabase->get_line_object();	
		}
		else
		{
			$result = new Data();
		}
		
		// 7.1+ throws an error when returning a
		// NULL value on session start up. If our
		// session_data member is NULL, return
		// an empty string instead.
		*/
		
		$output = $result->get_session_data();	
		
		if(is_null($output))
		{
			$output = '';			
		}
		
		error_log('read (output): '.$output);
		return $output;		
    	
	}

	// Update or insert session data. Note that only ID and Session Data are 
	// required. Other data is to aid in debugging.
    public function write($id, $data)
    {
		error_log('write: '.$id);
						
		$source	= $_SERVER['PHP_SELF'];		// Current file.
		$ip		= $_SERVER['REMOTE_ADDR'];	// Client IP address.					
		
		// Time value so we know when the session has expired. While we have the option
		// to set a time here, for consistency we'll normally just send NULL, and 
		// and let the stored procedure add in the database engine's own current time.
		$time	= NULL; //date(DATE_ATOM);
		
		// Ensure IP string is <= 15. Anything over is a MAC or unexpected (and useless) value.
		$ip = substr($ip, 0, 15);
		
		$dbh_pdo_connection = $this->config->get_database();
		
		// Populate database class members with 
		// the SQL string of our stored procedure
		// and its parameter array. Then we can 
		// execute.
		
		$sql_string = 'EXEC '.$this->config->get_sp_prefix().$this->config->get_sp_set().' :id, :data, :source, :ip';
		error_log('sql_string: '.$sql_string);
			
		$dbh_pdo_statement = $dbh_pdo_connection->prepare($sql_string);
		
		$dbh_pdo_statement->bindParam(':id', $id);
		$dbh_pdo_statement->bindParam(':data', $data);
		$dbh_pdo_statement->bindParam(':source', $source);
		$dbh_pdo_statement->bindParam(':ip', $ip);
		
		$rowcount = $dbh_pdo_statement->execute();
		$error = $dbh_pdo_connection->errorInfo();
		print_r($error);
		error_log('error_info: '.$error[2]);
				
		// Return TRUE. 
		return TRUE;
    }

	// Delete current session.
    public function destroy($id)
    {	
		// echo 'Destroy';

		$iDatabase = $this->config->get_database();
		
		// Populate database class members with 
		// the SQL string of our stored procedure
		// and its parameter array. Then we can 
		// execute.
				
		$sql_string = '{call '.$this->config->get_sp_prefix().$this->config->get_sp_destroy().'(@id = ?)}';		
		$iDatabase->set_sql($sql_string);				

		$params = array(array(&$id, SQLSRV_PARAM_IN));
		$iDatabase->set_param_array($params);				
		
		$iDatabase->query_run();		
				
		return TRUE;
    }

	// Delete expired session data.
		
	//	$life_max: Maximum lifetime of a session, in seconds. This is
	//	passed from the php.ini session.gc_maxlifetime setting.
    public function gc($life_max)
    {
		// echo 'gc';
		
		// If local setting isn't NULL, use it to override the default
		// lifetime value.
		if($this->config->get_life() != NULL)
		{
			$life_max = $this->config->get_life();
		}
		
		// Populate database class members with 
		// the SQL string of our stored procedure
		// and its parameter array. Then we can 
		// execute.
		
		$iDatabase = $this->config->get_database();		
		
		$sql_string = '{call '.$this->config->get_sp_prefix().$this->config->get_sp_clean().'(@life_max = ?)}';
		$iDatabase->set_sql($sql_string);				

		$params = array(array(&$life_max, SQLSRV_PARAM_IN));
		$iDatabase->set_param_array($params);				

		$iDatabase->query_run();		
		
		// Return TRUE.
		return TRUE;
    }
}

