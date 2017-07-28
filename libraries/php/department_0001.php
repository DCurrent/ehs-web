<?php	

function department_0001($cAdds = NULL){		
		
	/*
	department_0001
	Damon Vaughn Caskey
	2011_03_02
	
	Populate html form with departments from Master Department List.	
	
	$cAdds:	Array of additional choices.
	*/

	$list	=	NULL;	//Output string.
	$iSel	=	NULL;
	
	/*
	Let's find out if user had already selected a value. If so, we'll use their selection
	as the option list's default selected.
	*/
	if(isset($_GET['requireddepartment']))
	{
		$iSel	=	$_GET['requireddepartment']; 
	
		if(strlen($iSel) > 0 and !is_numeric($iSel))	//Verify numeric value. No SQL injection for you!
		{
			echo "ERROR, ".__FUNCTION__.": Possible SQL injection attack detected. Execution halted.";
			exit;
		}
	}
	
	require("a_cred_mars_0001.php");					//Get connection credentials.			
	$db_conn = sqlsrv_connect($db_host, $db_connect);	//Connect to DB server.
	
	//Query for list items.	
	$query  = "SELECT DISTINCT
									DeptNo, 
									DeptName
				FROM 				MasterDepartment 
				WHERE 				(DeptName <> '')
				ORDER BY 			DeptName";

	$result = sqlsrv_query($db_conn, $query);					
	
	$list 	= "<option value=-1 selected='selected'>Select Department</option>";
	
	if($cAdds)
	{	
		foreach($cAdds as $key => $value)
		{
			if($value == $iSel)
			{
				$list .= "<option selected='selected' value=$value> $value, $key</option>";		
			}
			else
			{
				$list .= "<option value=$value> $value, $key</option>";
			}
		}
	}
	
	//Populate list variable.
	while($line = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC))
	{			
		if($line[0]==@$iSel)	//Is this a repost? Retain user's selection.
		{
			$list .= "<option selected='selected' value=$line[0]> $line[0], $line[1]</option>";
		}
		else
		{
			$list .= "<option value=$line[0]> $line[0], $line[1]</option>";
		}			
	}
	
	//sqlsrv_close($db_conn);	//Close database connection.
	return $list;
}
?>



