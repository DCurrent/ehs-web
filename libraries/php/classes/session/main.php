<?php 

require_once('interface.php');

class class_session_options implements session_options
{
	protected $maxlife_m	= NULL;	// Session time out.
	protected $db_query_m	= NULL; // Database query.
	
	function __construct()
	{		
		$this->db_query_m = NULL;
		$this->maxlife_m = SESSION_DEFAULT::MAXLIFE;		
	}
	
	// Return data member.
	public function maxlife()
	{		
		return $this->maxlife_m;
	}
	
	// Set data member.
	public function set_maxlife($value)
	{		
		$this->maxlife_m = $value;
	}
	
	// Return data member.
	public function db_query()
	{		
		return $this->db_query_m;
	}
	
	// Set data member.
	public function set_db_query($value)
	{
		$this->db_query_m = $value;
	}	
}

class class_session implements SessionHandlerInterface
{
	
	private $maxlife_m	= NULL;	// Session options object.
	private $query_m	= NULL;	// Database query object.
			
	function __construct(class_session_options $options = NULL)
	{
		/*
		Constructor
		Damon Vaughn Caskey
		2014-04-05
		
		Class constructor.
		*/		
		
		// Set up session options object.
		$this->options_m = new class_session_options();
		
		// If options parameter object set, use it to define session member object values.
		if($options)
		{		
			$this->query_m = $options->db_query();
			$this->maxlife_m = $options->maxlife();
		}
			
		//if(!$options->db_query())	trigger_error("Missing object dependency: Database.", E_USER_ERROR);		
	}

    public function open($savePath, $sessionName)
    {
		// Nothing to do here as are session work is handled by the DB elsewhere.
		return true;
    }

    public function close()
    {
		/*
		close
		Damon Vaughn Caskey
		2014-04-05
		
		Filler; function is called by PHP to close session.
		*/			
		
		// Return TRUE.        
        return true;
    }

    public function read($id)
    {
         /*
		read
		Damon Vaughn Caskey
		2012_12_10
		
		Locate and read session data from database. If session data is found, it will be updated with current data/time.
		
		$cID = Session ID.
		*/
	
		$result = NULL; 			// Final output.
		$time 	= date(DATE_ATOM); 	// Current time.
		$line	= NULL;				// Line object.						
		
		error_log('session_read: '.$time);
		error_log('session_read: '.$id);
					
		// Set SQL.
		$this->query_m->set_sql('MERGE INTO tbl_legacy_session
			USING 
				(SELECT ? AS search_col) AS SRC
			ON 
				tbl_legacy_session.session_id = SRC.search_col
			WHEN MATCHED THEN
				UPDATE SET
					updated = ?			
				OUTPUT INSERTED.session_data;');
		
		// Set params		
		$this->query_m->set_params(array(&$id, &$time));
		
		// Execute the query.
		$this->query_m->query();	
		
		// Is there a row?
		if($this->query_m->get_row_exists())
		{
			// Get the line.
			$line = $this->query_m->get_line_object();
			
			// Set results.
			$result = $line->session_data;
		}
		
		// Return results.	
		return $result;
    }

    public function write($id, $value)
    {
        /*
		write
		Damon Vaughn Caskey
		2014-08-15
		
		Update or insert session data. Note that only ID, Expire, and Session Data are 
		required. Other data is to aid in debugging.
		
		$id 	= Session ID.
		$value	= Session data.
		*/
		
		$result	= FALSE;
		$line  	= NULL;	               		// Line object.
		$source	= $_SERVER['PHP_SELF'];		// Current file.
		$ip		= $_SERVER['REMOTE_ADDR'];	// Client IP address.
		$time	= date(DATE_ATOM);
		
		
		
		// Ensure IP string is <= 15. Anything over is a MAC or unexpected (and useless) value.
		$ip = substr($ip, 0, 15);
		
		// Set query string.
		$this->query_m->set_sql('MERGE INTO tbl_legacy_session
		USING 
			(SELECT ? AS search_col) AS SRC
		ON 
			tbl_legacy_session.session_id = SRC.search_col
		WHEN MATCHED THEN
			UPDATE SET
				session_data	= ?,
				updated			= ?,
				source			= ?,
				ip				= ?
		WHEN NOT MATCHED THEN
			INSERT (session_id, session_data, updated, source, ip)
			VALUES (SRC.Search_Col, ?, ?, ?, ?);');		
		
		// Set parameters.
		$this->query_m->set_params(array(&$id, 
			&$value, 
			&$time, 
			&$source, 
			&$ip,
			&$value, 
			&$time, 
			&$source, 
			&$ip)); 
		
		// Execute query.
		$this->query_m->query();
				
		// Return results.
		return TRUE;		
    }

    public function destroy($id)
    {
        /*
		destroy
		Damon Vaughn Caskey
		2014-08-15
		
		Delete session data.
		
		$id 	= Session ID.
		*/		
				
		// Set query string.
		$this->query_m->set_sql('DELETE FROM tbl_legacy_session WHERE session_id = ?;');
		
		// Set parameters.
		$this->query_m->set_params(array(&$id)); 
		
		// Execute query.
		$this->query_m->query();		

        return TRUE;
    }

    public function gc($maxlifetime)
    {
        /*
		destroy
		Damon Vaughn Caskey
		2014-08-15
		
		Delete all expired session data.
		
		$id 	= Session ID.
		*/		
		
		// Calculate expired time.
  		$expired = date(DATE_ATOM, time() - ($maxlifetime + $this->maxlife_m));
 				
		// Set query string.
		$this->query_m->set_sql('DELETE FROM tbl_legacy_session WHERE updated < ?;');
		
		// Set parameters.
		$this->query_m->set_params(array(&$expired)); 
		
		// Execute query.
		$this->query_m->query();		

        return TRUE;
    }
}

?>