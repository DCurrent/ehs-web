<?php	

	abstract class DEFAULTS
	{
		const 
			LDAP_HOST			= "ukldap.uky.edu",		// LDAP host.
			LDAP_BASE_DN		= "o=uky";				// LDAP Base Domain Name.
	}
	
	abstract class CONNECT
	{
		const 
			HOST 		= 'gensql\general',		// Database host (server name or address)
			NAME 		= 'ehsinfo',			// Database logical name.
			USER 		= 'EHSInfo_User',		// User name to access database.
			PASSWORD 	= 'ehsinfo',			// Password to access database.
			CHARSET		= 'UTF-8';				// Character set. 
	}
	
	// Post data (we'll verify each post and populate it below).
	class post
	{
		public 
			$name_f	= NULL,
		 	$name_l	= NULL,
		 	$id 	= NULL;
		
		public function __construct() 
		{		
			// Interate through each class variable.
       		foreach($this as $key => $value) 
			{			
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the post value. 
				if(isset($_REQUEST[$key]))
				{					
					$this->$key = $_REQUEST[$key];           						
				}
			}	
	 	}
	}
	
	require('../php/classes/database/main.php'); 	// Database class.

	$filter	= NULL; 
	$list 	= new ArrayObject(array(), ArrayObject::STD_PROP_LIST);	
	$markup	= NULL;	// Final markup output.
	$line_object = NULL;
	$line_object_all = NULL;
	
	$post = new post();	
	
	// No reason to continue if no search parameters provided.
	if (!$post->name_l && !$post->name_f) exit;
	
	// Database objects.
	$db		= new class_db_connection();
	$query 	= new class_db_query($db);
	 
	$query->set_sql("SELECT DISTINCT account
    FROM tbl_accounts
    WHERE (name_f LIKE ?) AND (name_l LIKE ?)");
	$query->set_params(array($post->name_f.'%', $post->name_l.'%'));
	$query->query();
	
	// Any records found?
	if($query->get_row_exists())
	{	
		// Get the line object array.
		$line_object_all = $query->get_line_object_all();
	
		// Append each record to our output array.
		foreach($line_object_all as $line_object)
		{
			$list->append($line_object->account);
		}
	}
	
	// Now list get a list from Active directory.		
	$filter = '(&(sn='.$post->name_l.'*)(givenname='.$post->name_f.'*)(workforceid='.$post->id.'*))';	//Filter string.
	
	// Establish ldap connection.
	$ldap = ldap_connect(DEFAULTS::LDAP_HOST);
	
	// Don't follow referal. This speeds things up a bit.	
	ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
		
	// Ldap connected and search string provided?
	if (isset($ldap)) 
	{	
		// search for auth_account dn.
		$result = ldap_search($ldap, DEFAULTS::LDAP_BASE_DN, $filter, array("userid"));
		
		// Valid result returned?
		if ($result != FALSE)
		{		
			// Get entry array.
			$entries 	= ldap_get_entries($ldap, $result);					
			
			// Loop entry array
			foreach($entries as $entry)
			{					
				// Domain set? 
				if (isset($entry['dn']))
				{	
					// Populate list array.
					$list->append($entry['userid'][0]);							 
				}		
			}
			
			// Clear result set.
			ldap_free_result($result);		
		}				
	}	
	
	// Close ldap connection.
	ldap_close($ldap);
	
	// Sort current list into alphabetical order.
	$list->asort();
	
	// Set an interator object.	
	$iterator = $list->getIterator();
	
	// Valid iterator?
	while($iterator->valid()) 
	{	
		// Current index valid?
		if($iterator->current())
		{	
			// Get values and move to next index.
			$markup .= '<option value="'.$iterator->current().'">'.$iterator->current().'</option>'.PHP_EOL;	
			$iterator->next();		
		}
	}
	
	echo $markup;
?>