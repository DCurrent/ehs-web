<?php

function facility_0001(){

	/*
	facility_0001
	Damon Vaughn Caskey
	2011_03_02
	~2011_10_11 - Updated to use Microsoft SQL Drivers.
	
	
	Populate html form with facilities from Master Building List.
	
	iSel:	Previous building selection, if any.
	*/

	$list	=	'';	//Output string.
	$iSel	= 	NULL;
	
	/*
	Let's find out if user had already selected a facility. If so, we'll use their selection
	as the option list's default selected value.
	*/
	if(isset($_GET['requiredbuilding']))
	{
		$iSel	=	$_GET['requiredbuilding']; 
	
		if(strlen($iSel) > 0 and !is_numeric($iSel))	//Verify numeric value. No SQL injection for you!
		{
			echo "ERROR, facility_0001: Possible SQL injection attack detected. Execution halted.";
			exit;
		}
	}
	
	require("a_cred_mars_0001.php");					//Get connection credentials.			
	$db_conn = sqlsrv_connect($db_host, $db_connect);	//Connect to DB server.		
		
	
	//Query for building drop list items.
	$query  = "SELECT DISTINCT
									BuildingCode, 
									BuildingName
				FROM 				MasterBuildings 
				WHERE 				(BuildingName <> '')
				ORDER BY 			BuildingName";
	
	$result = sqlsrv_query($db_conn, $query);					
	
	$list 	= "<option value=-1 selected='selected'>Select Facility</option>";
	
	//Populate facility drop list variable.
	while($line = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC))
	{			
		if($line[0]==$iSel)	//Is this a repost? Retain user's selection.
		{
			$list = $list . "<option selected='selected' value=$line[0]> $line[0], $line[1]</option>";
		}
		else
		{
			$list = $list . "<option value=$line[0]> $line[0], $line[1]</option>";
		}			
	}
	
	//sqlsrv_close($db_conn);	//Close database connection.
	return $list;
}
?>