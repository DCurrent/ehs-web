<?php	
	
	// Configuration file. This should be added to all PHP scripts to set up commonly used includes, 
	// functions, objects, variables and so on.
	
	/*

	const	ADMIN_LIST		= "dvcask2, dwhibb0, kmcgu1, rdeldr0";		//Default "all access" user accounts.
	const	DATE_FORMAT		= "Y-m-d H:i:s";							//Default date format.
	
	$iReqTime 	= $_SERVER['REQUEST_TIME_FLOAT'];
	$cDocroot 	= NULL; //Document root.	
	$oDB		= NULL;	//Database class object.
	$err		= NULL;	//Error class object.
	$oMail		= NULL;	//E-Mail handler class object.
	$utl		= NULL;	//Utility class object.
	$oFrm		= NULL;	//Forms class object.
		
	// Get needed includes.
	require_once("access_old/main.php");		//Account based access.
	require_once("database.php");	//Database handler.
	require_once("forms.php");		//Forms handler.
	require_once("error.php");		//Error handler.
	require_once("mail.php");		//Mail handler.
	require_once("session.php");	//Session handler.
	require_once("tables.php");		//Table handler.
	require_once("utility.php");		//Utility functions.	
	
	// Replace default session handler.
	$session_handler	= new class_session();	
	session_set_save_handler($session_handler, TRUE);
			
	// Initialize class objects
	$utl	= new class_utility();											//Utility functions.
	$oMail	= new class_mail();												//E-Mail handler.
	$err 	= new class_error();											//Error handler.
	
	$connect = new class_db_old_connect_params();
	
	$oDB	= new class_db($connect);										//Database handler.
	
	$oAcc	= new class_access();	//Account based access.
	
	$oTbl 	= new class_tables(array("Utl"=> $utl));									//Tables handler.
	$oFrm 	= new class_forms(array("DB"=> $oDB));										//Forms handler.
		
	$cDocroot = $utl->utl_get_server_value('DOCUMENT_ROOT')."/";
	
	*/
	
	require_once($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/location/main.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/url_query/main.php'); 			// URL request var builder.
	require_once($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/session.php');					// Session class.
	
	//require_once($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/sorting/main.php'); 				// record sorting.
	//require(__DIR__.'/dc/cache/main.php'); 		// Page cache.

	//require_once(__DIR__.'/navigation.php');
	//require_once(__DIR__.'/data_main.php');
	
	// Load class using namespace.
	function app_load_class($class_name) 
	{
        $file_name = '';
        $namespace = '';

		//echo '<!-- Class request: '.$class_name.' -->'.PHP_EOL;
		error_log('<!-- Class request: '.$class_name.' -->'.PHP_EOL, 0);
		
        // Sets the include path as the "src" directory
        //$include_path = __DIR__;
		$include_path = $_SERVER['DOCUMENT_ROOT'].'\libraries';
		
		// Find the string position of the last namespace separator (\) in class name.
		$lastNsPos = strripos($class_name, '\\');

		
		
		// If we found the namespace separator, let's build a 
		// file name string.
        if ($lastNsPos)
		{
			// Namespace is the portion of of class name starting
			// from 0 and ending at last namespace separator.
            $namespace = substr($class_name, 0, $lastNsPos);
			
			error_log('<!-- namespace: '.$namespace.' -->'.PHP_EOL, 0);
			
			// Crop namespace from class name to leave only class name itself.
            $class_name = substr($class_name, $lastNsPos + 1);
			
			error_log('<!-- class_name: '.$class_name.' -->'.PHP_EOL, 0);
			
			// Add directory separator to namespace to start a file path.
            $file_name = str_replace('\\', DIRECTORY_SEPARATOR, $namespace).DIRECTORY_SEPARATOR;
			
			error_log('<!-- file_name: '.$file_name.' -->'.PHP_EOL, 0);
        }
		
		// Add suffix to file name, then add include path to build
		// full file name path.
        $file_name .= $class_name.'.class.php';
		
		error_log('<!-- file_name: '.$file_name.' -->'.PHP_EOL, 0);
		
        $file_name_full = $include_path . DIRECTORY_SEPARATOR . $file_name;
		
		error_log('<!-- file_name_full: '.$file_name_full.' -->'.PHP_EOL, 0);
		
	   
	   	// If complete file path exists, then load it.
        if (file_exists($file_name_full)) 
		{
            require($file_name_full);
			
        	echo $file_name_full.', loaded successfully. -->'.PHP_EOL;
		} 
		else 
		{
            echo '<-- '.$file_name_full.' not found. -->'.PHP_EOL;
        }
    }
	
    spl_autoload_register('app_load_class');

	$connect_config = new \dc\yukon\ConnectConfig();

	$nahoni_config = new \dc\nahoni\SessionConfig();

	// Replace default session handler.
	//$session_handler = new class_session();
	//session_set_save_handler($session_handler, TRUE);
	
	
	
?>


