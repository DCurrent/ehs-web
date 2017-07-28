<?php 

	require('../../libraries/php/classes/database/main.php'); 	// Database class.
	
	// General use constants.
	abstract class CONSTANTS
	{
		const SUBMIT_TRUE = 1;
		
		const
			NO 	= 0,
			YES	= 1;			
	}
	
	// Default settings for outgoing mail.
	abstract class MAILING
	{
		const
			TO		= 'lpoor2@uky.edu, derek.bocard2@uky.edu',
			CC		= '',
			BCC		= 'dvcask2@uky.edu',
			SUBJECT = 'Incident Report',
			FROM 	= 'ehs_noreply@uky.edu';
	}
	
	// tbl_incident columns.			
	class class_incident 
	{
		public 
			$type		= NULL,
			$contact	= NULL,
			$name_f 	= NULL,
			$name_l 	= NULL,
			$account	= NULL,	
			$email		= NULL,
			$department	= NULL,
			$phone		= NULL,
			$time		= NULL,
			$facility	= NULL,
			$room		= NULL,
			$desc		= NULL,	// Description of incident.
			$submit		= NULL;		
	}
	
	// Common population of lists using common tabel fields (id/label).
	class list_populate
	{
		private
			$result = array(),	// Array of line objects from query result.
			$table	= NULL;		// Name of table to query.
		
		public function __construct($table = NULL)
		{
			$this->table = $table;
			$this->populate();
		}
		
		public function result()
		{
			return $this->result;
		}
		
		private function populate()
		{		
			if($this->table)
			{				
				// Initialize DB connection and query objects.
				$db		= new class_db_connection();		
				$query 	= new class_db_query($db);
				
				// Get type list items.
				$query->set_sql('SELECT id, label FROM '.$this->table.' ORDER BY label');
				$query->query();
				$this->result = $query->get_line_object_all();
			}
		}
	}
?>