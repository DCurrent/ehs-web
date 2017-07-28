<div id="thestuff">
<?php		
		
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
	
	$cLRoot		= $cDocroot;	//Local root.
	$cPost		= NULL;			//Copy of post array.
	$params	= NULL;			//Query parameter array.
	$query		= NULL;			//Query string.
	$markup	= NULL;			//HTML markup to echo into page.

	/* SQL string parameter inserts. */
	$sqlAdd	= array("account" 		=> NULL,	//Account 	
						"department"	=> NULL,	//Department.
						"class"			=> NULL,	//Class type.
						"trainer"		=> NULL);	//Trainer.

	/* Get post values. */
	$cPost['range_start'] 		= $utl->utl_get_post('range_start');
	$cPost['range_end'] 		= $utl->utl_get_post('range_end');
	$cPost['department'] 		= $utl->utl_get_post('department');
	$cPost['class'] 			= $utl->utl_get_post('class');
	$cPost['trainer'] 			= $utl->utl_get_post('trainer');
	$cPost['name_l'] 			= $utl->utl_get_post('name_l');
	$cPost['name_f'] 			= $utl->utl_get_post('name_f');
	$cPost['frm_lst_account']	= $utl->utl_get_post('frm_lst_account');
	
	/* Build parameter array. */
	$params = array(
				&$cPost['range_start'],
				&$cPost['range_end']);
	
	/* Insert department parameters. */
	if(is_array($cPost['department']) === TRUE)
	{	
		/* Build parameter string insert for query. */
		$sqlAdd['department'] = " AND (department IN (".str_repeat('?,', count($cPost['department']) - 1). '?'."))";
		
		/* Merge into parameter array. */
		$params = array_merge($params, $cPost['department']);			
	}		
	
	/* Insert class parameters. */
	if(is_array($cPost['class']) === TRUE)
	{	
		/* Build parameter string insert for query. */
		$sqlAdd['class'] = " AND (class_type IN (".str_repeat('?,', count($cPost['class']) - 1). '?'."))";
		
		/* Merge into parameter array. */
		$params = array_merge($params, $cPost['class']);			
	}	
	
	/* Insert trainer parameters. */
	if(is_array($cPost['trainer']) === TRUE)
	{	
		/* Build parameter string insert for query. */
		$sqlAdd['trainer'] = " AND (trainer_id IN (".str_repeat('?,', count($cPost['trainer']) - 1). '?'."))";
		
		/* Merge into parameter array. */
		$params = array_merge($params, $cPost['trainer']);			
	}
				
	$params = array_merge($params, array(&$cPost['name_l'],
				&$cPost['name_l'],
				&$cPost['name_f'],
				&$cPost['name_f']));
		
	if(is_array($cPost['frm_lst_account']) === TRUE)
	{	
		/* Build parameter string insert for query. */
		$sqlAdd['account'] = " AND (account IN (".str_repeat('?,', count($cPost['frm_lst_account']) - 1). '?'."))";
		
		/* Merge into parameter array. */
		$params = array_merge($params, $cPost['frm_lst_account']);	
		$params = array_merge($params, array(NULL));
	}
	
	$query				= "SELECT
					participant_name														AS	'Name',
					department																AS	'Dept',
					desc_title																AS	'Class',
					class_date_char															AS	'Taken',			
					trainer_name															AS	'Trainer',
					cert_link																AS  'Certificate'
													
					FROM vw_class_participant_list
					WHERE
						(class_date BETWEEN ? AND ?)"  
						.$sqlAdd['department']						
						.$sqlAdd['class']
						.$sqlAdd['trainer']."			AND						
						((?='-1') OR (name_l = ?))	 	AND
						((?='-1') OR (name_f = ?))"
						.$sqlAdd['account']
					."ORDER BY name_l, name_f, class_date desc";

	/* Execute query. */
	$oDB->db_basic_select($query, $params, FALSE, TRUE, TRUE, TRUE);
			
	/* Create table markup */
	$markup =	$oTbl->tables_db_output($oDB, TRUE);

	/* Output table markup */
	echo $markup; 	
	
?>
</div>