<?php	
	
	// Configuration file. This should be added to all PHP scripts to set up commonly used includes, 
	// functions, objects, variables and so on.
	
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
	//require_once("error.php");		//Error handler.
	require_once("mail.php");		//Mail handler.
	require_once("session.php");	//Session handler.
	require_once("tables.php");		//Table handler.
	require_once("utility.php");		//Utility functions.	
	
	// Replace default session handler.
	$session_handler	= new class_session();	
	session_set_save_handler($session_handler, TRUE);
	session_start();
			
	// Initialize class objects
	$utl	= new class_utility();											//Utility functions.
	$oMail	= new class_mail();												//E-Mail handler.
	//$err 	= new class_error();											//Error handler.
	
	$connect = new class_db_old_connect_params();
	
	$oDB	= new class_db($connect);										//Database handler.
	
	$oAcc	= new class_access();	//Account based access.
	
	$oTbl 	= new class_tables(array("Utl"=> $utl));									//Tables handler.
	$oFrm 	= new class_forms(array("DB"=> $oDB));										//Forms handler.
		
	$cDocroot = $utl->utl_get_server_value('DOCUMENT_ROOT')."/";
?>