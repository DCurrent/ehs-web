<?php 

require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	
function gen_query_0003($cCred, $query, $cskip=NULL, $iDisplayCnt=1, $iLineLimit=NULL, $cButtonName="btn_get_cert"){

//gen_query_0003("a_cred_master_0001", "SELECT object_code AS Code, objec_name AS Name FROM tbl_object_codes ORDER BY name", NULL, 0, NULL);

		/*
		gen_query_0003
		Damon V. Caskey
		Output recordset with button at far end of table for for post actions.
		
		$cCred:			Credential set to include for database connection.
		$query:		Query string.
		$cSkip:			Planned line skipping. No function as of 20120426.
		$iDisplayCnt:	0 = No record count. 1 = Display a record count immediately above table output.
		$iLineLimit:	Number of lines (columns) to display from recordset returned from query.
		$cButtonName:	Post value button will send when clicked by user.
		*/

		$cDocroot 		= $_SERVER['DOCUMENT_ROOT']."/";
		$iFields		= 0;
		$iLine			= 0;	//Row number in recordset. Used to determine if current row is even/odd.
		$mssql_msg		= NULL;
		//$errors		= '';
		$cError_str		= NULL;
		$cOutput		= NULL;		
		$cFields		= NULL;
		$cFieldSize		= NULL;	//Field size.
		$cFieldType		= NULL;	//Field type.
		$result			= NULL;	//Recordset returned by database.
		$row_count		= NULL; //Number of records returned.
		$fieldMetadata	= NULL;	//Column information array (Name, data type, etc.)
		$line			= NULL;	//Column meta array from row in recordset.
		$name			= NULL;	//Column meta information name.
		$value			= NULL; //Column information value.
		
		require($cDocroot."libraries/php/sqlsrv_aux_0001.php");		//Database auxiliary functions.
		require($cDocroot."libraries/php/".$cCred.".php");			//Database connection variables.
		
		//Database connection						
		$db_conn = sqlsrv_connect($db_host, $db_connect);	//Connect to DB server.
		
		sqlsrv_aux_error_0001(0);	//Error trapping.
				
		$result = sqlsrv_query($db_conn, $query, array(), array( "Scrollable" => SQLSRV_CURSOR_STATIC ));				//Execute query.		

		sqlsrv_aux_error_0001(1, $query);	//Error trapping.

		if(!$result)
		{
			$cOutput = "I'm sorry, there appears to be an error with the database. Please contact the webmaster or try again later.";
		}
		else
		{
			$row_count = sqlsrv_num_rows($result); 
			
			sqlsrv_aux_error_0001(2, $query);	//Error trapping. 
	
			if($iDisplayCnt)
			{
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
							$cFields[$iFields] = $value;
							$cOutput .= "$value";							
						}
						else if($name == "Size")
						{
							$cFieldSize[$iFields] = $value;
						}						
						else if($name == "Type")
						{
							$cFieldType[$iFields] = $value;
						}
					} 
					
					$cOutput .= "</th>";
					$iFields++;
				}			
			}	
			
			sqlsrv_aux_error_0001(3, $query);	//Error trapping.
			
			$cOutput .= "<th>Action</th>";	
			
			/*Output query results as table.*/		
			while($line = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)){		
				$cOutput .= "</tr>";
				
				$iLine++;
				
				$cOutput .="<form action='".$_SERVER['PHP_SELF']."' method='post' entype='multipart/form-data' name='frm_$iLine' id='frm_inline'>";
							
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
					if($cFieldType[$i] == SQLSRV_SQLTYPE_UNIQUEIDENTIFIER)
					{
						$cOutput .="<td><input type='text' readOnly='readonly' style='width:175px; font-size:8px' maxlength='".$cFieldSize[$i]."' name='".$cFields[$i]."_val' value='".$line[$i]."'/></td>";					
					}
					else if($cFieldType[$i] == SQLSRV_SQLTYPE_BIT)
					{
						$cOutput .="<td><input type='checkbox' name='".$cFields[$i]."_val' value='".$line[$i]."'/></td>";					
					}
					else if($cFieldType[$i] == SQLSRV_SQLTYPE_DATE || $cFieldType[$i] == SQLSRV_SQLTYPE_DATETIME || $cFieldType[$i] == SQLSRV_SQLTYPE_DATETIME2 || $cFieldType[$i] == 93)
					{
						$cOutput .="<td><input type='text' style='width:50px; font-size:10px' name='".$cFields[$i]."_val' value='".$line[$i]."'/></td>";										
					}
					else
					{
						$cOutput .="<td>$cFieldType[$i]<input type='text' style='width:".($cFieldSize[$i]*8)."px; font-size:10px' maxlength='".$cFieldSize[$i]."' name='".$cFields[$i]."_val' value='".$line[$i]."'/></td>";					
					}
				}		
				
				$cOutput .= "<td>";			
				$cOutput .= "<input type='submit' class='FormButton' name='Update' value='Update'/>";
				$cOutput .= "<input type='submit' class='FormButton' name='Delete' value='Delete'/></form></td></tr></font>";				
			}	
			
			sqlsrv_aux_error_0001(4, $query);	//Error trapping.
			
			//sqlsrv_close($db_conn);
			
			$cOutput .= "</table></div>";			
		}
		
		$cOutput .= sqlsrv_aux_error_mail_0001("gen_query_0003");	//Error logging.
		
		return $cOutput;
}

$cLRoot		= $cDocroot."fire/";


require($cDocroot."libraries/php/gen_query_0001.php");				//General query output.

/*User authorization*/	
$oAcc->access_verify(NULL, ADMIN_LIST);

$bUpdate = @$_POST['Update'];
$bDelete = @$_POST['Delete'];
$bInsert = @$_POST['Insert'];
$cVal	 = NULL;
$cDialog = NULL;

if($bUpdate == True)
{
	$cVal[0] = $_POST['ID_val'];
	$cVal[1] = $_POST['Code_val'];
	$cVal[2] = $_POST['Name_val'];
	
	$query = "UPDATE tbl_object_codes
							
							SET 	
								object_code				= '$cVal[1]',							
								object_name				= '$cVal[2]'								
															
							WHERE guid_id = '$cVal[0]'"; 
	
	gen_query_0001($query);
	
	$cDialog = "<p><span class='success'>Updated record $cVal[0]. <br />Code: $cVal[1]. <br />Name: $cVal[2].</span></p>";
}

if($bDelete == True)
{
	$cVal[0] = $_POST['ID_val'];
	$cVal[1] = $_POST['Code_val'];
	$cVal[2] = $_POST['Name_val'];
	
	$query = "DELETE from tbl_object_codes
																					
							WHERE guid_id = '$cVal[0]'"; 
	
	gen_query_0001($query);
	
	$cDialog = "<p><span class='minor_alert'>Deleted record $cVal[0]. <br />Code: $cVal[1]. <br />Name: $cVal[2].</span></p>";
}

if($bInsert == True)
{
	$cVal[0] = $_POST['ID_val'];
	$cVal[1] = $_POST['Code_val'];
	$cVal[2] = $_POST['Name_val'];
	
	$query = "INSERT INTO tbl_object_codes (object_code, object_name) 
   VALUES ('$cVal[1]', '$cVal[2]')"; 
	
	gen_query_0001($query);
	
	$cDialog = "<p><span class='success'>Added record $cVal[0]. <br />Code: $cVal[1]. <br />Name: $cVal[2].</span></p>";
}


?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Environmental Health And Safety</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

<link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
</head>

<body>

<div id="container">
	<div id="mainNavigation">
		<?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
	</div>
	<div id="subContainer">
		<?php include($cLRoot."a_banner_0001.php"); ?>
		<div id="subNavigation">
		 	<?php include($cLRoot."a_subnav_0001.php"); ?> 
		</div>
		<div id="content">
			<h1>Welcome</h1>
			<form id="frm_input" name="frm_input" method="post" action="">
              <?php echo gen_query_0003("a_cred_master_0001", "SELECT TOP 5
			  
			  			  						guid_id 			AS ID, 
												building_id 		AS Building, 
												room_no 			AS Room,
												date_rcvd			AS Received,
												incident_desc		AS Incident,
												public_desc			AS Description,
												public_display		AS Log												
												
												FROM tbl_fire_alarm 
												ORDER BY date_rcvd DESC", NULL, 0, NULL); ?>
          	</form>
        </div>       
	</div>    
	<div id="sidePanel">		
		<?php include($cLRoot."a_sidepanel_0001.php"); ?>		
	</div>
	<div id="footer">
		<?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
	</div>
</div>

<div id="footerPad">
<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40196994-1', 'uky.edu');
  ga('send', 'pageview');

</script>
</body>
</html>