<?php 

	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.

	$cLRoot		= $cDocroot."ohs/";
	
	require($cDocroot."libraries/php/facility_0001.php");		//Populate Facility lists.
	require($cDocroot."libraries/php/room_0001.php");			//Populate Room lists.
	require($cDocroot."libraries/php/a_cred_master_0001.php");	//Master database connection variables.
	
	/* Verify user is authorized  */
	$oAcc->access_verify(NULL, ADMIN_LIST.", jghamo2, lljayn0, lpoor2");	
?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Occupational Health &amp; Safety</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="/libraries/css/style.css" type="text/css" />

<link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
<script language="Javascript" type="text/javascript" src="/libraries/list_update_0001.js"></script>

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
        
		<div id="content"> <h1>Chemical Hygiene Plan Administration</h1>
		  <p>The following annual reviews have been submitted:</p>
		 
<p>

<?php 

$iFields=0;
		
		//Database connection						
		$db_conn = sqlsrv_connect($db_host, $db_connect);	//Connect to DB server.
		
		if( $db_conn == false )
		{
			die( print_r( sqlsrv_errors(), true));
		}

		$query ="SELECT 
			id 																		AS	'ID',
			(pi_fname + ' ' + pi_lname) 											AS 'PI/Supervisor',
			room																	AS	'Room/Lab',
			CASE WHEN		chk_binder			= 0	THEN 'No' 	ELSE 'Yes'	END		AS 	'Binder',
			CASE WHEN		chk_idpage			= 0	THEN 'No' 	ELSE 'Yes'	END		AS 	'Page',
			CASE WHEN		chk_procedures		= 0	THEN 'No' 	ELSE 'Yes'	END		AS 	'Procedures',
			CASE WHEN		chk_perprot			= 0	THEN 'No' 	ELSE 'Yes'	END		AS 	'Perprot',
			CASE WHEN		chk_ch10			= 0	THEN 'No' 	ELSE 'Yes'	END		AS 	'Chapter 10',
			CASE WHEN		chk_training		= 0	THEN 'No' 	ELSE 'Yes'	END		AS 	'Training',
			CASE WHEN		chk_appIII			= 0	THEN 'No' 	ELSE 'Yes'	END		AS 	'App. III',
			CASE WHEN		chk_current			= 0	THEN 'No' 	ELSE 'Yes'	END		AS 	'Current',
			CASE WHEN		chk_signage			= 0	THEN 'No' 	ELSE 'Yes'	END		AS 	'Signage',
			CASE WHEN		chk_flammables		= 0	THEN 'No' 	ELSE 'Yes'	END		AS 	'Flammables',
			comments																AS	'Comments',
			submit_time																AS	'Submitted',
			submit_user_ad															AS	'User ID',
			submit_user_ip															AS	'User IP'
		
			FROM tbl_chem_hygiene
			ORDER BY submit_time desc";
				
		$result = sqlsrv_query($db_conn, $query, array(), array( "Scrollable" => SQLSRV_CURSOR_KEYSET ));				//Execute query.

		$row_count = sqlsrv_num_rows( $result );  

		echo $row_count. " records found.";

?>

<div class="overflow"><table width="100%" border="0" cellpadding="5" cellspacing="0" bgcolor="#CCCCCC"> 
<tr>

<?php			
		
		foreach( sqlsrv_field_metadata( $result ) as $fieldMetadata )
		{
			echo "<th>";
			foreach( $fieldMetadata as $name => $value)
			{					
				if($name == 'Name')
				{					
					echo "$value";
			   		//echo "<td><th>$name: $value</th></td>";
					
				}				
			} 
			//echo "<hr />";
		  	echo "</th>";
			$iFields++;
		}		
		
		/*Output query results as table.
		while($sField = sqlsrv_field_metadata($result)){
			echo "<td><strong>" .$sField->name. "</strong></td>";
			$iFields++; 
		}
		*/		
		$iLine=0;
		while($line = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)){		
			echo "</tr>";
			
			$iLine++;
			
			if($iLine%2)
			{
				// $odd == 1; the remainder of 25/2
				echo '<tr bgcolor="#DDDDFF">';
			}
			else
			{
				// $odd == 0; nothing remains if e.g. $number is 48 instead,
				// as in 48 / 2
				echo '<tr bgcolor="#CECEFF">';
			}
					
			for ($i = 0; $i < $iFields; $i++)
			{						
				echo "<td>".$line[$i]."</td>";			
			}
			
			echo "</tr></font>";
		}	
		
		//sqlsrv_close($db_conn);
				
?></table></div></p>
    </div>       
  </div>
	<div id="sidePanel">		
		<?php include($cLRoot."a_sidepanel_0001.php");	?>		
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