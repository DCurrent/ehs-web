<?php

if(!function_exists('value_0001'))
{
	function value_0001($table, $id_name, $id_value, $value_name){
			
		/*
		value_name_0001
		Damon V. Caskey
		11092010
		Extract singular value from MARS database by ID parameter. Primary
		use is to aquire department or building names by ID number.
			
		$table:			Table to extract values from.
		$id_name:		Field name to extract value by.
		$id_value: 		Field value to extract value by.
		$value_name:	Value to extract.
		*/		
			
		$db_conn;								//Database connection string.
		$query;									//Query string.
		$result;								//DB output.
		$line;									//Returned columns array.
		$return		= "Unavailable";			//Final return value.
					
		require("a_cred_mars_0001.php");					//Get connection credentials.			
		$db_conn = sqlsrv_connect($db_host, $db_connect);	//Connect to DB server.
					
		$query  = "SELECT $id_name, $value_name FROM $table WHERE $id_name = '$id_value'";
		$result = sqlsrv_query($db_conn, $query);
		$line 	= sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);
		$return	= $line[0]. ", " .$line[1];
			
		//sqlsrv_close($db_conn);
	
		return $return;			
	}
}
//$query  = "SELECT DeptNo, DeptName FROM MasterDepartment WHERE DeptNo = '$requiredDepartment'";

?>

