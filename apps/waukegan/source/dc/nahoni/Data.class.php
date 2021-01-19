<?php

namespace dc\nahoni;

require_once('Config.php');

class Data
{
	private	$session_id 	= NULL;
    private $session_data	= '';     // Must be empty string. PHP 7.1+ throws error if we return NULL.
    private $expire			= NULL;
    private $source			= NULL;
    private $ip				= NULL;
		
	// Accessors
	public function get_session_data()
	{
		return $this->session_data;
	}
}

?>
