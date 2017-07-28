<?php	

function gen_droplist_0001($cCred, $query, $default, $defaultVal, $cLastVal=NULL, $params=NULL){		
		
	/*
	gen_droplist_0001
	Damon Vaughn Caskey
	2011_04_05
	~2012_11_17
	
	Populate html form droplist from query.
	
	cCred		= Database connection include.
	query 		= List query.
	default	= Default display value.
	defaultVal	= Value passed if default is selected.
	cLastVal	= Last value posted by user. If passed, set drop list to this.
	cParams		= Parameter array.
	*/

	$list		=	NULL;	//Output string.
	$cLastVal	=	NULL;
	
	require($cCred.".php");								//Get connection credentials.			
	$db_conn = sqlsrv_connect($db_host, $db_connect);	//Connect to DB server.
	
	/* Query for list items. */
	$result = sqlsrv_query($db_conn, $query, $params, array( "Scrollable" => SQLSRV_CURSOR_STATIC ));				
	
	/* Set a default if provided. */	
	if($default && $defaultVal)
	{
		$list 	= '<option value="'.$defaultVal.'" selected="selected">'.$default.'</option>';
	}
	
	/* Populate list variable. */
	while($line = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC))
	{		
		/* Is this a repost? Retain user's selection. */	
		if($line[0]==$cLastVal)	
		{
			$list = $list . '<option selected="selected" value="'.$line[0].'">'.$line[1].'</option>';
		}
		else
		{
			$list = $list . '<option value="'.$line[0].'">'.$line[1].'</option>';
		}			
	}
	
	/* Close database connection. */
	//sqlsrv_close($db_conn);	
	
	/* Output final list value. */
	return $list;
}
?>



