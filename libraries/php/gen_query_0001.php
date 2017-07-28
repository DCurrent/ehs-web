<?php		

function gen_query_0001($query)
{
	/*
		gen_query_0001
		Damon Vaughn Caskey
		2011_11_16
		~2012_06_19 - Enhanced error trapping.
		
		Simple query wrapper for Master Database.	
	*/
	
	$cLastID	= NULL;
		
	require("a_cred_master_0001.php");							//Connection credentials.	
	require("sqlsrv_aux_0001.php");								//Supplemental sqlsrv functions.		
		
	$db_conn = sqlsrv_connect($db_host, $db_connect);			//Connect to DB server.
	
	sqlsrv_aux_error_0001(0,$query);									//Error trapping.	
	
	$result = sqlsrv_query($db_conn, $query." SELECT SCOPE_IDENTITY() AS ID", array(), array( "Scrollable" => SQLSRV_CURSOR_STATIC ));								//Execute query.
		
	sqlsrv_aux_error_0001(1,$query);									//Error trapping.
	
	sqlsrv_next_result($result);
	sqlsrv_fetch($result);
	$cLastID = sqlsrv_get_field($result, 0);
	
	sqlsrv_aux_error_0001(2,$query);							//Error trapping.
  			  
  	//sqlsrv_close($db_conn);										//Close the database connection.
	
	sqlsrv_aux_error_mail_0001("gen_query_0001");				//Error log.
	
	return $cLastID;
}

?>