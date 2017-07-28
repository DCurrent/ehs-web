<?php

// Caskey, Damon V.
// 2012-03-19
//
// Scan a firectory for files matching filter
// and return an array of matches.
//
// $directory: 			Directory to scan.
// $filter:				Filter string.
// $attribute:			File attribute to aquire. See here for 
// 						list of available attributes: http://php.net/manual/en/function.stat.php
//$order_descending:	FALSE (default) = Order by file name ascending. 
//						TRUE = Order by file name descending. 
function direcrtory_scan($directory, $filter, $attribute = 'name', $order_descending = FALSE)
{	
    $result 			= array();	// Final result.
    $directory_handle 	= NULL; 	// Directory object handle.
	$directory_valid	= FALSE;	// If directory is accessable.
	$stat				= array();	// Attribute array.
	
	// Validate directory.
	$directory_valid = is_readable($directory);
	
	// If the directory is valid, open it
	// and get the object handle.
	if($directory_valid)
	{
		$directory_handle = opendir($directory);
	}
	
	// Do we have a directory handle?
	if($directory_handle) 
	{
		// Scan all items in directory
		// and populate result array with 
		// the attribute of those with
		// names matching our search pattern.
        do 
		{
			// Get first/next item name in the 
			// directory handle.
			$file_name = readdir($directory_handle);
			
			
            if (preg_match($filter, $file_name)) 
			{
                $stat = stat($directory.'/'.$file_name);
				
				// If requested attribute is name, then
				// just pass on the name with directory.
				// Otherwise, pass the requested attribute.
				if($attribute == 'name')
				{
					$result[$file_name] = $file_name;
				}
				else
				{
					$result[$file_name] = $stat[$attribute];
				}
            }
			
        }
		while($file_name !== FALSE);
        
		// Close the directory object.
		closedir($directory_handle);
        
		// Sort the array as requested.
		if ($order_descending)
		{
            arsort($result);
        }
        else
		{
            asort($result);
        }
    }
	
	// Return resulting array.
    return $result;
}

?>