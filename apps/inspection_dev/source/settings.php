<?php

	abstract class APPLICATION_SETTINGS
	{
		const
			VERSION 		= '0.1.1',
			NAME			= 'Inspector Blair',
			DIRECTORY_PRIME	= '/apps/inspection_dev',
			TIME_FORMAT		= 'Y-m-d H:i:s',
			PAGE_ROW_MAX	= 25;
	}

	abstract class DATABASE
	{
		const NAME	= 'inspection';
	}

	abstract class MAILING
	{
		const
			TO		= '',
			CC		= '',
			BCC		= 'dc@caskeys.com',
			SUBJECT = 'Inspector Blair Alert',
			FROM 	= 'ehs_noreply@uky.edu';
	}
	
	abstract class SESSION_ID
	{
		const
			LAST_BUILDING	= 'id_last_building';	// Last building choosen by user.
	}

?>