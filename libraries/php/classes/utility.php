<?php 

class class_utility {

	/*
	Utility
	Damon Vaughn Caskey
	2013-01-09
	
	Miscellaneous utility functions.
	*/
	
	public function array_to_url($id, $list)
	{
		/*
		array_to_url
		Damon V. Caskey
		2013-08-11
		
		Parse array into string that can be passed into URL and later aquired with php "get".
		
		$id: 	Id given to array in url (and to recall with get).
		$list:	Array to parse.
		*/
		
		$result = NULL;	//Final output string.
		$key	= NULL;	//Array element key.
		$val	= NULL;	//Array element value.
	
		// Verify array.
		if(is_array($list))
		{			
			// Iterate through each element.
			foreach($list as $key => $val)
			{
				// Concatenate string with array keys and values.
				$result .= $id."[".$key."]=".$val."&";
			}
			
			/* Trim last ampersand from string. */
			$result = trim($result, "&");			
		}
		
		// Output result.
		return $result;
	}
	
	public function utl_boolean($value, $type)
	{
		/*
		boolean_0001
		Damon V. Caskey
		2011-10-13
		~2013-06-19: moved to class.
		
		Convert boolean value or text to text "yes/No".
			
		$boolean:		Booloean value.
		$value			Output type.
		*/					
		
		$result		= "No";			//Final return value.
					
		if ($value == 1)
		{
			$result = "Yes";
		}
			
		return $result;
	}
		
	public function utl_directory_array($directory, $stat_item = NULL)
	{
		/*
		utl_directory_scan 
		Damon Vaughn Caskey
		2012-10-18
		
		Return array of all items from directory.
		
		$directory: Directory to get items from.
		$stat_item: File stat item to return.
		*/
		
		$dir_handle = FALSE;	//Directory handle.
		$dir_item	= NULL;		//Directory item (file name or FALSE).
		$result		= array();	//Array to return (File Name => Stats).
		$stat		= array();	//File status array.
		
		/* Open directory handle (note: This will throw a warning error on failure). */
		$dir_handle = opendir($directory);
		
		// Directory open?
		if($dir_handle !== FALSE)
		{	
			// Iterate through all items in directory.
			while (($dir_item = readdir($dir_handle)) !== FALSE)
			{
				// Get file status array.
				$stat = stat($directory."/".$dir_item);
				
				// No stat asked for or stat call failed?
				if($stat_item == NULL or !$stat)
				{
					// Use file name.
					$result[$dir_item] = $dir_item;
				}
				else
				{ 
					// Use status item.
					$result[$dir_item] = $stat[$stat_item];
				}
            }
			
			// Release directory handle.
			closedir($dir_handle);
		}
		
		// Return final result.
		return $result;
	}
	
	public function utl_file_select_list_array($directory, $search, $root ="", $remove_from_list = "")
	{	
		$directory_list = array();	//Initial list of items from directory.
		$dir_item_key	= NULL;		//Directory item key.
		$dir_item_val	= NULL;		//Directory item value.
		$match			= FALSE;	//Search match flag.
		$result			= array();	//Final result.
		
		// Get directory items.
		$directory_list = $this->utl_directory_array($directory);
		
		// Interate through directory items.
		foreach($directory_list as $dir_item_key => $dir_item_val)
		{
			$match = preg_match($search, $dir_item_key);
			
			if($match === 1)
			{
				$result[str_replace($remove_from_list, "", $dir_item_val)] = $root.$dir_item_key;
			}
		}
		
		return $result;
	}
		
	public function utl_get_get($cID, $default=NULL)
	{
		/*
		utl_get_get
		Damon Vaughn Caskey
		2013-01-01
		
		Wrapper to obtain get value.
		
		$cID:		Index.
		$default:	Default on not set.
		*/
		
		return $this->utl_validate_isset($_GET[$cID], $default);
	}
	
	public function utl_get_post($cID, $default=NULL)
	{
		/*
		utl_get_post
		Damon Vaughn Caskey
		2013-01-01
		
		Wrapper to obtain post value.
		
		$cID:		Index.
		$default:	Default on not set.
		*/
		
		return $this->utl_validate_isset($_POST[$cID], $default);
	}
	
	public function utl_get_server_value($cID, $default=NULL)
	{
		/*
		utl_get_server_value
		Damon Vaughn Caskey
		2013-01-01
		
		Wrapper to obtain server value.
		
		$cID:		Index.
		$default:	Default on not set.
		*/
		
		return $this->utl_validate_isset($_SERVER[$cID], $default);
	}
	
	public function utl_var_dump($type = NULL, $sets = array('Get' => TRUE, 'Session' => TRUE, 'Post' => TRUE))
	{
		
		/*
		utl_global_dump
		Damon Vaughn Caskey
		2013-06-18
		
		Dump vars into string or single array and return results.
		
		$type: Dump style. NULL = String.
		$sets: Types to include in dump.		
		*/
		
		$result = NULL;
		
		if($sets['Get'] && isset($_GET))
		{
			foreach($_GET as $key => $value)
			{
				if(is_array($value))
				{
					$value = implode(", ", $value);					
				}
				
				$result .= "GET[".$key."]: ".$value." || ";
			}
		}
		
		if($sets['Post'] && isset($_POST))
		{
			foreach($_POST as $key => $value)
			{
				if(is_array($value))
				{
					$value = implode(", ", $value);					
				}
				
				$result .= "POST[".$key."]: ".$value." || ";
			}
		}
		
		if($sets['Session'] && isset($_SESSION))
		{
			foreach($_SESSION as $key => $value)
			{
				if(is_array($value))
				{
					$value = implode(", ", $value);					
				}
				
				$result .= "SESSION[".$key."]: ".$value." || ";
			}
		}
		
		return $result;
	}
	
	public function utl_str_to_array($list=NULL, $cDel=",")
	{	
		/*
		str_to_array
		Damon Vaughn Caskey
		2013-01-09
		
		Break string into indexed array with no spaces.
		
		$list:	List array to break up.
		$cDel:	Delimiter.
		*/
	
		// If list is populated remove spaces and break into array.
		if($list)									//List populated?								
		{
			$list = str_replace (" ", "", $list);	//Remove spaces.
			$list = explode($cDel, $list);		//Break into array.
		}
		
		// Return end result.
		return $list;
	}
	
	public function utl_redirect($cURL=NULL)
	{	
		/*
		utl_redirect
		Damon Vaughn Caskey
		2013-01-09
		
		Send header that redirects client to new page.
		
		$cURL:	Target address.
		*/

		$result = TRUE;

		// If headers haven't been sent, redirect user to an error page. Otherwise we'll just have to die and settle for a plain text message.		
		if(headers_sent())
		{ 
			// Good coding will always avoid attempting to resend headers, but let's make sure to catch them here before PHP throws a nasty error.			
			$result = FALSE;
		}
		else
		{			
			header('Location: '.$cURL);
		}
		
		// Return end result.
		return $result;
	}
	
	public function utl_validate_email(&$value, $default=NULL)
	{
		/*
		utl_validate_email
		Damon Vaughn Caskey
		2013_01_01
		
		Validate email variable.
		
		$value:	Email value.
		$default:	Default on fail.
		*/
				
		if(filter_var($value, FILTER_VALIDATE_EMAIL)) 
		{			
			list($user,$domaine)=explode("@", $value, 2);
			
			if(!checkdnsrr($domaine, "MX")&& !checkdnsrr($domaine, "A"))
			{
				/*
				Bad domain.
				*/
				$value = FALSE;
			}
			else 
			{
				//Domain OK.
			}
		}
		else 
		{		
			/*
			Bad address.
			*/	
			$value = FALSE;
		} 
		
		if($value == FALSE)
		{
			$value = $default;
		}
		
		return $value;
	}
	
	public function utl_validate_ip(&$value, $default=NULL)
	{
		/*
		utl_validate_ip
		Damon Vaughn Caskey
		2013-01-01
		
		Validate ip variable.
		
		$value:	ip value.
		$default:	Default on fail.
		*/
		
		$value = filter_var($value, FILTER_VALIDATE_IP);		
		
		if($value == FALSE)
		{
			$value = $default;
		}
		
		return $value;
	}
	
	public function utl_validate_isset(&$value, $default=NULL)
	{
		/*
		utl_validate_isset
		Damon Vaughn Caskey
		2013-01-01
		
		Return default if variable is not set.
		
		$value:	Value.
		$default:	Default on not set.
		*/
		
		if(!isset($value))
		{
			$value = $default;
		}
		
		return $value;
	}
	
	public function utl_if_exists($value, $cValPrefix=NULL, $cValCadence=NULL, $cAlt=NULL)
	{
		/*
		utl_
		Damon Vaughn Caskey
		2013-01-01
		
		Return self if self has a value, or $cAlt if $value is empty or null. Reduces need to retype and 
		potentiality mix up variable names or array keys twice in common "echo <X> if it has a value" situations.

		Preconditions:
			$value: Value to test and return if it exists.
			$cValPrefix: Add to front of $value on return.
			$cValCadence: Add to end of $value on return.
			$cAlt: Value to return if $value is NULL.
		*/
		
		/* Vaiables */
		$cReturn = $cAlt;	//Final value to return.
		
		/* Value exists? */
		if($value)
		{
			/* Tack on additions and return value. */			
			$cReturn = $cValPrefix.$value.$cValCadence;
		}
		
		return $cReturn;		
	}
}
?>
