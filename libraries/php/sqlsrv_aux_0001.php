<?php 

if(!function_exists('sqlsrv_aux_error_0001'))
{

	function sqlsrv_aux_error_0001($cLocation = NULL, $sql = NULL)
	{
		
		/*
			sqlsrv_aux_error_0001
			Damon Vaughn Caskey
			2012_06_08
			
			Wrapper for sqlsrv_errors(). Parses error array to string for later intert into email.
		*/
		
		$cOutput		= NULL;	//Output message.
		$aErrors		= NULL;	//Errors list array.
		$aError			= NULL;	//Error output array.
		$mysqli			= NULL;
		$query			= NULL;
		$stmt			= NULL;
		$val			= NULL;
		
	
		if(($aErrors = sqlsrv_errors()) != null)					
		{		
			/*
			$mysqli = new mysqli('box406.bluehost.com', 'caskeysc_ehsinfo', 'caskeysc_ehsinfo_user', 'caskeysc_uk');
			
			foreach($aErrors as $aError)
			{
				/*
					Ignore these codes; they are informational only:
						0:		Cursor type changed.
						5701:	Changed database context.
						5703:	Changed language setting.
				
				if($aError['code'] != 0 && $aError['code'] != 5701 && $aError['code'] != 5703)
				{
					$cOutput .= 
					"\n Code Location: ".$cLocation. 
					"\n SQLSTATE: ".$aError['SQLSTATE'].
					"\n Code: ".$aError['code'].
					"\n Message: ".$aError[ 'message']."\n";
					
					if (!$mysqli->connect_error) 
					{			
						$query = "INSERT INTO tbl_query_errors (codel, state, code, msg, query, source, ip) VALUES (?,?,?,?,?,?,?)";
						$stmt = $mysqli->prepare($query);
						
						$stmt->bind_param("sssssss", $val[0], $val[1], $val[2], $val[3], $val[4], $val[5], $val[6]);
						
						if($stmt != false)
						{
							$val[0] = $cLocation;
							$val[1] = $aError['SQLSTATE'];
							$val[2] = $aError['code'];
							$val[3] = $aError['message'];
							$val[4] = $sql;
							$val[5] = $_SERVER["PHP_SELF"];
							$val[6] = $_SERVER['REMOTE_ADDR'];
							
							$stmt->execute();
							$stmt->close();
						}
					}
				}
				
			}
			
			$mysqli->close();
			*/
			//$_SESSION['cSqlsrv_Errors'] = $cOutput;
			return true;		
		}
		
		return false;	
	}
}

if(!function_exists('sqlsrv_aux_error_mail_0001'))
{

	function sqlsrv_aux_error_mail_0001($cFName)
	{
		/*
			sqlsrv_aux_error_0001
			Damon Vaughn Caskey
			2012_06_08
			
			Alert webmaster of any database errors recorded.
			
			$cFName: Current function name.
		*/
		
		$cOutput 			= NULL; 								//Output message.
		$cErrors			= NULL;									//Error message string.
		$cMailFromAddress	= "EHS Web";							//Email from address.
		$cMailToAddress 	= "dvcask2@uky.edu, dc@caskeys.com";	//Email to address.
		$cMailSubject		= NULL;									//Email subject line.
		$cMailBody			= NULL;									//Email body content.		
		
		//$cErrors = @$_SESSION['cSqlsrv_Errors'];
		
		//$_SESSION['cSqlsrv_Errors'] = NULL;
		
		if ($cErrors)
		{		
			$cOutput = "<br /><br /><span class='alert'>A database error has occurred. Please contact the webmaster immediately.<br /><br /></span>";
				
			$cMailSubject	= "Query failure: ".$cFName;
			$cMailBody 		=   $_SERVER["PHP_SELF"]." \n\n"							
								."Errors detected: \n"
								."Error: 				".$cErrors."\n\n";
			
			mail($cMailToAddress, $cMailSubject, $cMailBody, $cMailFromAddress);	
		}
		
		echo $cOutput;
	}
}
?>
