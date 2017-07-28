<?php 

abstract class SESSION_DEFAULT
{
	const MAXLIFE = 0;	// Session time out adjustment (in seconds).
}

interface session_options
{	
	// Structure of parameters used for database connection attempt.
	
	function maxlife();					// Return time out.
	function set_maxlife($value);		// Set time out.
	function set_db_connection($value);	// Set database connection.
}

?>