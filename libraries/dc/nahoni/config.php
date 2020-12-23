<?php

namespace dc\nahoni;

abstract class DEFAULTS	
{
	const 	LIFE		= 1440;					// Default session lifetime (seconds).
			
			// Stored procedure default names.
	const	SP_PREFIX	= NULL,							// Prefix for all other SP names.
			SP_CLEAN	= 'dc_nahoni_session_clean',	// SP to remove all expired sessions.
			SP_DESTROY	= 'dc_nahoni_session_destroy',	// SP to remove single session on command.
			SP_GET		= 'dc_nahoni_session_get',		// SP to read session data.
			SP_SET		= 'dc_nahoni_session_set';		// SP to write session data.
}

?>

