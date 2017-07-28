<?php

function room_0001($iSel=NULL){

	/*
	room_0001
	Damon Vaughn Caskey
	2011_03_02
	
	Populate html form with rooms from Master Building List.	
	*/

	$list	=	NULL;	//Output string.
	
	/*
	Let's find out if user had already selected a facility.  
	*/	
	if(isset($_GET['requiredbuilding']) && !isset($iSel))
	{
		$iSel	=	$_GET['requiredbuilding']; 
	}	
	
	/*
	An unfiltered room list would be far too large to load into the page, so if no facility selection has been made 
	we will instead populate room list with instructions to select a facility first.*/
	if(isset($iSel) and strlen($iSel) > 0)
	{	
		require("a_cred_mars_0001.php");					//Get connection credentials.			
		$db_conn = sqlsrv_connect($db_host, $db_connect);	//Connect to DB server.
	
		//Query master list for rooms in selected facility.
		$query = "SELECT DISTINCT 
									RoomBarCode,
									RoomID,
									UsageSubDescr,
									BuildingCode										
				FROM         		Rooms_Chematix
				WHERE     			(BuildingCode = ?)
				ORDER BY 			RoomID";			
				
		$result = sqlsrv_query($db_conn, $query, array(&$iSel), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));								//Execute query.
		$list 	= "<option value=-2> Area outside of facility</option>";		//Add "Outside" line for fire use.
		
		if(sqlsrv_num_rows($result) == FALSE)										//No rooms found?
		{
			$list = $list ."<option value=-3> Not Available</option>";		//Add "Unavailable" option.
		}
		
		//Populate room drop list variable.
		while($line = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC))
		{				
			$list = $list . "<option value=$line[0]> $line[1], $line[2]</option>";							
		}		

		//sqlsrv_close($db_conn);	//Close database connection.
	}
	else
	{
		$list = "<option value=-1> Unavailable; Please select a facility.</option>";
	}
	
	
	return $list;
}
?>