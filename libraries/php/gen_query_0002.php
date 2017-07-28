<?php 

function gen_query_0002($cCred, $query, $cskip=NULL, $iDisplayCnt=1, $iLineLimit=NULL){

		/*
			gen_query_0002
			Damon Vaughn Caskey
			2011_11_16
			
			Query wrapper. Output record result in preformatted table.
		
			$cCred:			Credential include for database connection.
			$query:		SQL statement to execute.
			$cskip:			No use as of 20120605
			$iDisplayCnt:	1 = Display a count of records returned before table output.
			$iLineLimit:	Last column from returned records to display in table; any subsequent colmuns are ignored.			 
		*/

		$iFields	= 0;
		$cDocroot 	= $_SERVER['DOCUMENT_ROOT']."/";
		$cOutput	= NULL;	

		require($cDocroot."libraries/php/sqlsrv_aux_0001.php");		//Database auxiliary functions.
		require($cDocroot."libraries/php/".$cCred.".php");			//Database connection variables.
		
		//Database connection						
		$db_conn = sqlsrv_connect($db_host, $db_connect);	//Connect to DB server.
		
		sqlsrv_aux_error_0001(0);	//Error trapping.
				
		$result = sqlsrv_query($db_conn, $query, array(), array( "Scrollable" => SQLSRV_CURSOR_STATIC ));				//Execute query.		

		sqlsrv_aux_error_0001(1);	//Error trapping.		  

		if($iDisplayCnt)
		{
			$row_count = sqlsrv_num_rows($result);
			$cOutput .= $row_count. " records found.";
		}

		$cOutput .= '<div class="overflow"><table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#CCCCCC"> 
		<tr>';	
		
		foreach( sqlsrv_field_metadata($result) as $fieldMetadata)
		{
			if($iLineLimit==NULL || $iFields < $iLineLimit)
			{
				$cOutput .= "<th>";
				foreach( $fieldMetadata as $name => $value)
				{					
					if($name == 'Name')
					{					
						$cOutput .= "$value";					
					}				
				} 
				
				$cOutput .= "</th>";
				$iFields++;
			}
		}		
		
		sqlsrv_aux_error_0001(2);	//Error trapping.
		
		/*Output query results as table.*/		
		$iLine=0;
		while($line = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)){		
			$cOutput .= "</tr>";
			
			$iLine++;
			
			if($iLine%2)
			{				
				$cOutput .= '<tr bgcolor="#DDDDFF">';
			}
			else
			{	
				$cOutput .= '<tr bgcolor="#CECEFF">';
			}
					
			for ($i = 0; $i < $iFields; $i++)
			{						
				$cOutput .= "<td>".$line[$i]."</td>";			
			}
			
			$cOutput .= "</tr></font>";
		}	
		
		sqlsrv_aux_error_0001(3);	//Error trapping.
		
		//sqlsrv_close($db_conn);
		
		$cOutput .= "</table></div>";
		
		$cOutput .= sqlsrv_aux_error_mail_0001("gen_query_0002");	//Error trapping.
		
		return $cOutput;		
}
?>
