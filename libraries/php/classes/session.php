<?php

require_once(__DIR__.'/database/main.php');

abstract class SESSION_SETTINGS	
{
	const LIFE	= NULL;					// Default session lifetime.	
}

class class_session_data
{
	private		
		$session_id 	= NULL,
		$session_data	= '',
		$expire			= NULL,
		$source			= NULL,
		$ip				= NULL;
		
	// Accessors
	public function get_session_data()
	{
		return $this->session_data;
	}
	
	public function set_session_id($value)
	{
		$this->session_id = $value;
	}
}

// Override PHP's default session handling to store data in an MSSQL table. 
class class_session implements SessionHandlerInterface
{    
	
	private	
		$db_conn_m	= NULL,	// Database conneciton object.
		$db_query_m	= NULL,	// Database query object.
		$life		= NULL;	// Maximum lifetime of session.

	function __construct($setup = NULL)
	{
		/*
		Constructor
		Caskey, Damon V.
		2015-05-23
		
		Class constructor.
		
		$setup: Expansion.
		*/		
								
		// Set class vars.
		$this->life = SESSION_SETTINGS::LIFE;			
		
		$this->db_conn_m 	= new class_db_connection();
		$this->db_query_m	= new class_db_query($this->db_conn_m);			
	}
    	
   	public function open($savePath, $sessionName)
    {	
		/*
		open
		Caskey, Damon V.
		2015-05-22
		
		Set database class object for other session functions. Called by PHP to open session.
		
		$savePath: 		Path to locate session file. Unused.
		$sessionName:	Name of session file. Unused.
		*/
					
		// Return TRUE.
        return TRUE;
    }

    public function close()
    {	
		/*
		close
		Caskey, Damon V.
		2015-05-22
		
		Filler; function is called by PHP to close session.
		*/			
		
		// Return TRUE.
        return TRUE;
    }

    public function read($id)
    {		
        /*
		read
		Caskey, Damon V.
		2015-05-22
		
		Locate and read session data from database.
		
		$cID = Session ID.
		*/

		// Dereference query object.
		$db_query = $this->db_query_m;
		
		// String - call stored procedure.
		$db_query->set_sql('{call session_get(@id = ?)}');				

		// Prepare parameter array.
		$params = array(array(&$id, SQLSRV_PARAM_IN));
		
		// Bind parameters and execute query.
		$db_query->set_params($params);				
		$db_query->query();
		
		
		if($db_query->get_row_exists())
		{
			// error_log('found session data');
			
			// Set class and acquire object.
			$db_query->get_line_params()->set_class_name('class_session_data');
			$result = $db_query->get_line_object();	
		}
		else
		{
			$result = new class_session_data();
			$result->set_session_id($id);
			
			// error_log('No session data:');
		}
		
		// Return session data.
		return $result->get_session_data();		
    }

    public function write($id, $data)
    {
		/*
		write
		Caskey, Damon V.
		2015-05-22
		
		Update or insert session data. Note that only ID and Session Data are 
		required. Other data is to aid in debugging.
		
		$id 	= Session ID.
		$data	= Session data.
		*/
				
		$source	= $_SERVER['PHP_SELF'];		// Current file.
		$ip		= $_SERVER['REMOTE_ADDR'];	// Client IP address.					
		
		// Time value so we know when the session has expired. While we have the option
		// to set a time here, for consistency we'll normally just send NULL, and 
		// and let the stored procedure add in the database engine's own current time.
		$time	= NULL; //date(DATE_ATOM);
		
		// Ensure IP string is <= 15. Anything over is a MAC or unexpected (and useless) value. */
		$ip = substr($ip, 0, 15);
		
		// Dereference query object.
		$db_query = $this->db_query_m;
		
		// SQL string - call stored procedure.
		$db_query->set_sql('{call session_set(@id 			= ?,
											@data 			= ?,
											@last_update	= ?,
											@source 		= ?,
											@ip 			= ?)}');				

		// Prepare parameter array.
		$params = array(array(&$id, SQLSRV_PARAM_IN),
						array(&$data, SQLSRV_PARAM_IN),
						array(&$time, SQLSRV_PARAM_IN),
						array(&$source, SQLSRV_PARAM_IN),
						array(&$ip, SQLSRV_PARAM_IN));
								
		// Bind parameters and execute query.
		$db_query->set_params($params);				
		$db_query->query();		
					
		// Return TRUE. 
		return TRUE;
    }

    public function destroy($id)
    {	
	
		/*
		destroy
		Caskey, Damon V.
		2015-05-23
		
		Delete current session.
		
		$id: Session ID.		 
		*/
				
		// Dereference query object.
		$db_query = $this->db_query_m;
		
		// SQL string - call stored procedure.
		$db_query->set_sql('{call session_destroy(@id = ?)}');				

		// Prepare parameter array.
		$params = array(array(&$id, SQLSRV_PARAM_IN));
		
		// Bind parameters and execute query.
		$db_query->set_params($params);				
		$db_query->query();		
		
		// Return TRUE.
		return TRUE;
    }

    public function gc($life_max)
    {
		/*
		gc (Garbage Cleanup)
		Caskey, Damon V.
		2015-05-23
		
		Delete expired session data.
		
		$life_max: Maximum lifetime of a session, in seconds. This is
		passed from the php.ini session.gc_maxlifetime setting.
		*/	
		
		// If local setting isn't NULL, use it to override the default
		// lifetime value.

		if(SESSION_SETTINGS::LIFE != NULL)
		{
			$life_max = SESSION_SETTINGS::LIFE;
		}
		
		// Dereference query object.
		$db_query = $this->db_query_m;
		
		// SQL string - call stored procedure.
		$db_query->set_sql('{call session_clean(@life_max = ?)}');				

		// Prepare parameter array.
		$params = array(array(&$life_max, SQLSRV_PARAM_IN));
		
		// Bind parameters and execute query.
		$db_query->set_params($params);				
		$db_query->query();		
		
		// Return TRUE.
		return TRUE;
    }
}

