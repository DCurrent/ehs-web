<?php		

function gen_query_0005($query, $params)
{
	/*
		gen_query_0005
		Damon Vaughn Caskey
		2011_11_16
		~2012_06_19 - Enhanced error trapping.
		
		Simple query wrapper for Master Database.
		
		$query:	Basic query to run.
		$params: 	Parameter array to prepare query with. Ex: array($firstname, $surname);	
	*/
	
	$cLastID	= NULL;
	$rStmt		= NULL;
		
	require("a_cred_master_0001.php");							//Connection credentials.	
	require("sqlsrv_aux_0001.php");								//Supplemental sqlsrv functions.		
		
	$db_conn = sqlsrv_connect($db_host, $db_connect);			//Connect to DB server.
	
	sqlsrv_aux_error_0001(0, $query);							//Error trapping.	
	
	$rStmt = sqlsrv_prepare($db_conn, $query, $params);		//Prepare query
		
	sqlsrv_aux_error_0001(1, $query);							//Error trapping.
	
	sqlsrv_execute($rStmt);										//Execute statement.
	
	sqlsrv_aux_error_0001(2, $query);							//Error trapping.
  	
	sqlsrv_free_stmt($rStmt);		  
  	//sqlsrv_close($db_conn);										//Close the database connection.
	
	sqlsrv_aux_error_mail_0001("gen_query_0005");				//Error log.
	
	return $cLastID;
}

?>