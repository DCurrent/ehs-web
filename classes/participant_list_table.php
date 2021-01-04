<div id="container_table_">
<?php		
		
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
		
	function append_like_char($value)
	{
		return ($value.'%');
	};
	
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
	$cPost['name_l'] 			= $utl->utl_get_post('name_l').'%';
	$cPost['name_f'] 			= $utl->utl_get_post('name_f').'%';
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
		//$sqlAdd['account'] = " AND (account IN (".str_repeat('?,', count($cPost['frm_lst_account']) - 1). '?'."))";
		
		$sqlAdd['account'] = " AND (".str_repeat('account LIKE ? OR ', count($cPost['frm_lst_account']) - 1). 'account LIKE ?'.")";
		
		// Adds the '%' to end of every string in array.'
		$cPost['frm_lst_account'] = array_map('append_like_char', $cPost['frm_lst_account']);
		
		/* Merge into parameter array. */
		$params = array_merge($params, $cPost['frm_lst_account']);	
		$params = array_merge($params, array(NULL));
	}
	
	$query				= "SELECT
					id,
					account																	AS  'Account',
					participant_name														AS	'Name',
					department																AS	'Dept',
					desc_title																AS	'Class',
					class_date_char															AS	'Taken',			
					trainer_name															AS	'Trainer'
													
					FROM vw_class_participant_list
					WHERE
						(class_date BETWEEN ? AND ?)"  
						.$sqlAdd['department']						
						.$sqlAdd['class']
						.$sqlAdd['trainer']."			AND						
						((?='-1') OR (name_l LIKE ?))	 	AND
						((?='-1') OR (name_f LIKE ?))"
						.$sqlAdd['account']
					."ORDER BY name_l, name_f, class_date desc";

	echo "<!-- QUERY: ";
	echo $query;
	echo " -->";
	
	/* Execute query. */
	$oDB->db_basic_select($query, $params, FALSE, TRUE, TRUE, TRUE);
	
	?>
	<style>		
		.clickable-row:hover {
          background-color: #CCCCCC;
			cursor: pointer;
        }
	</style>
	
	<?php
		$row_text = '';
		$row_count = $oDB->DBRowCount;
	
		switch($row_count)
		{
			default:
				
				if($row_count > 300)
				{
					$row_text = $row_count.' records found, displaying first 300.';
				}
				else
				{
					$row_text = $row_count.' records found.';
				}
				break;
			case 0:
				$row_text = 'No records found.';
				break;
			case 1:
				$row_text = '1 record found.';
				break;
		}
	
	?>
	
	<p><?php echo $row_text; ?>&nbsp;Click a record to generate its certificate of completiton.</p>
	
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Dept.</th>
				<th>Class</th>
				<th>Time</th>
				<th>Trainer</th>				
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Name</th>
				<th>Dept.</th>
				<th>Class</th>
				<th>Time</th>
				<th>Trainer</th>
			</tr>
		</tfoot>
		<tbody>
	<?php
	
	$row_print_count = 0;
			
	// Output query results as table.
	while($oDB->db_line(SQLSRV_FETCH_ASSOC))
	{	
		
		?>
			<tr class="clickable-row" role="button" data-href="<?php echo $oDB->DBLine['id']; ?>">
				<td><?php echo $oDB->DBLine['Name']; ?></td>
				<td><?php echo $oDB->DBLine['Dept']; ?></td>
				<td><?php echo $oDB->DBLine['Class']; ?></td>
				<td><?php echo $oDB->DBLine['Taken']; ?></td>
				<td><?php echo $oDB->DBLine['Trainer']; ?></td>
			</tr>
		<?php
		if(++$row_print_count > 300)
		{
			break;
		?>
			</tbody>
		</table>
	
		<p>Showing first 300 entries.</p>
		<?php
		}
	}	
			
	?>
		</tbody>
	</table>	
	
	<script>
		// Clickable table row.
		jQuery(document).ready(function($) {
			$(".clickable-row").click(function() {
				window.open('certificate.php?id=' + $(this).data("href"));
			});
		});
	</script>
	
</div>