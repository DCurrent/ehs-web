<?php

class class_sessions implements SessionHandlerInterface
{    

	/*
	class_sessions
	Damon Vaughn Caskey
	2012_12_10
	
	Override PHP's default session handling to store data in an MSSQL table. 
	*/	
	
	const 	c_iLife 	= 1440;	// Default session time out (in seconds)
	
	private	$oDB 		= NULL;	// Databse class object.
	private $iLife		= NULL;	// Session time out.

	function __construct($dep, $iLife=self::c_iLife)
	{
		/*
		Constructor
		Damon Vaughn Caskey
		2012_12_29
		
		Class constructor.
		*/		
								
		// Set class vars.
		$this->iLife = $iLife;	//Session time out.
		
		// Import object dependencies.
		$this->oDB = $dep['DB'];
				
		// Verify object dependencies.
		if(!$this->oDB)	trigger_error("Missing object dependency: Database.", E_USER_ERROR);		
	}
    	
   	public function open($savePath, $sessionName)
    {	
		/*
		open
		Damon Vaughn Caskey
		2012_12_10
		
		Set database class object for other session functions. Called by PHP to open session.
		
		$savePath: 		Path to locate session file. Unused.
		$sessionName:	Name of session file. Unused.
		*/
					
		// Return TRUE.
        return true;
    }

    public function close()
    {	
		/*
		close
		Damon Vaughn Caskey
		2012_12_10
		
		Filler; function is called by PHP to close session.
		*/			
		
		// Return TRUE.
        return true;
    }

    public function read($cID)
    {		
        /*
		read
		Damon Vaughn Caskey
		2012_12_10
		
		Locate and read session data from database.
		
		$cID = Session ID.
		*/
	
		$cData 	= NULL; 				//Final output.
		$query 	= NULL;					//Query string.
		$cTime 	= date(DATE_FORMAT);	//Current time.
		$params	= NULL;					//Parameter array.						
					 
		// Build query string.
		$query = 'SELECT session_data 
					FROM tbl_php_sessions 
					WHERE
							session_id = ? 
						AND 
							expire > ?';
		
		// Apply parameters.
		$params = array(&$cID, &$cTime); 
		
		// Execute query.
		$this->oDB->db_basic_select($query, $params);
						
		// Get result and pass to local var(s).
		if($this->oDB->DBResult)
		{
			// Set line array.
			$this->oDB->db_line();
			
			// Get session data.
			$cData = $this->oDB->DBLine['session_data'];
		}	
		
		// Return results.
		return $cData;
    }

    public function write($cID, $cData)
    {
		/*
		write
		Damon Vaughn Caskey
		2012_12_10
		
		Update or insert session data. Note that only ID, Expire, and Session Data are 
		required. Other data is to aid in debugging.
		
		$cID 	= Session ID.
		$cData	= Session data.
		*/
		
		$query = NULL;	               		//Query string.
		$cTime 	= NULL;						//Current time.
		$cLoc	= $_SERVER['PHP_SELF'];		//Current file.
		$cIP	= $_SERVER['REMOTE_ADDR'];	//Client IP address.
					
		// Calculate epirire time.
		$cTime		= date(DATE_FORMAT, time()+$this->iLife);	
		
		// Ensure IP string is <= 15. Anything over is a MAC or unexpected (and useless) value. */
		$cIP = substr($cIP, 0, 15);
		
		// Build query string.
		$query ='MERGE INTO tbl_php_sessions
		USING 
			(SELECT ? AS Search_Col) AS SRC
		ON 
			tbl_php_sessions.session_id = SRC.Search_Col
		WHEN MATCHED THEN
			UPDATE SET
				session_data	= ?,
				expire			= ?,
				source			= ?,
				ip				= ?
		WHEN NOT MATCHED THEN
			INSERT (session_id, session_data, expire, source, ip)
			VALUES (SRC.Search_Col, ?, ?, ?, ?);';		
		
		// Apply parameters.
		$params = array(&$cID,
				&$cData,
				&$cTime,
				&$cLoc,
				&$cIP,
				&$cData,				
				&$cTime,
				&$cLoc,
				&$cIP);	
		
		// Execute query.
		$this->oDB->db_basic_action($query, $params);
		
		// Return TRUE. 
		return true;
    }

    public function destroy($cID)
    {	
	
		/*
		destroy
		Damon Vaughn Caskey
		2012_12_10
		
		Delete current session.
		
		$cID: Session ID.		 
		*/
				
		$query 	= NULL;	// Query string.
		$params	= NULL;	// Parameter array.
		
		// Build query string.
		$query		= "DELETE FROM tbl_php_sessions WHERE session_id = ?";
		
		// Apply parameters.
		$params	= array(&$cID);
		
		// Execute query.	
		$this->oDB->db_basic_action($query, $params);		
		
		// Return TRUE.
		return true;
    }

    public function gc($maxlifetime)
    {
		/*
		gc (Garbage Cleanup)
		Damon Vaughn Caskey
		2012_12_10
		
		Delete expired session data.
		
		$maxlifetime: Expire time. Unused. 
		*/
		
		$cTime		= date(DATE_FORMAT);	//Current time.	
		$query		= NULL;					//Query string.
		$params 	= NULL;					//Parameter array.
		
		// Build query string.
		$query		= "DELETE FROM tbl_php_sessions WHERE expire < ?";
		
		// Apply parameters.
		$params	= array(&$cTime);

		// Execute query.	
		$this->oDB->db_basic_action($query, $params);
	
		// Return TRUE.
		return true;
    }
}

