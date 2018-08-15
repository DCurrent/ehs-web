<?php	

	abstract class DEFAULTS
	{
		const 
			LDAP_HOST_LIST		= "ldap://ad.uky.edu:3268",		// LDAP host.
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


	//////
	// We'll attempt to bind on all known hosts.
	// Here we loop through each host connection
	// string.
	
	$req_account = 'dvcask2';
	$req_credential = '67CeeHello@!';

	
	// Check connection string integrity and get a connection
	// resource handle. Don't let the name fool you - this 
	// does NOT connect to the LDAP server.
	$ldap = ldap_connect(DEFAULTS::LDAP_HOST_LIST);

	// If we failed to get a connection resource, then 
	// exit this iteration of loop.
	if(!$ldap)
	{
		continue;
	}

	// Need this for win2k3.
	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);

	// Now we will attempt the bind using all
	// possible domain prefixes.

	// Break prefix list into an array.
	//$prefix_list = explode(',', $this->config->get_dn_prefix());
	$prefix_list = array(NULL, 'ad/', 'ad\\', 'mc/', 'mc\\');

	// Keep trying prefixes until there is a bind or we run out.
	foreach($prefix_list as $prefix)
	{		
		$account = $prefix.$req_account;//'.'@uky.edu';

		//echo $account;

		// Attempt to bind with account (prefix included) and password.
		$result = @ldap_bind($ldap, $account, $req_credential);

		// If successfull bind break out of loop.
		if($result == TRUE) 
		{
			break;					
		}
	}

	// If successfull bind.
	if($result == TRUE) 
	{
		//break;				

		// Search goes here.

		// Prepare account filter.
		//$filter = "samaccountname=".$req_account;
		
		// Now list get a list from Active directory.		
		$filter = '(&(sn='.$post->name_l.'*)(givenname='.$post->name_f.'*))';	//Filter string.
		
		//echo 'filter: '.$filter;

		// Pull attributes for the AD domain
		$attributes = array("displayname", "sn", "givenname", "pwdlastset", "cn");

		$sr = ldap_search($ldap, "dc=uky,dc=edu", $filter, $attributes);

		if ($sr != FALSE)
		{
			$count = ldap_count_entries($ldap, $sr);

			// If no entries are found, return 0.
			if ($count) 		 
			{			
					
				// Get entry array.
				$entries 	= ldap_get_entries($ldap, $sr);					

				// Loop entry array
				foreach($entries as $entry)
				{					
					// Domain set? 
					if (isset($entry['dn']))
					{	
						// Populate list array.
						$list->append($entry['cn'][0]);							 
					}		
				}

				// Clear result set.
				ldap_free_result($sr);		
			}						
			//echo "found $count entrie(s)\n";

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