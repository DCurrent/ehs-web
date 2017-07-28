<?php	
		
	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/database/main.php');
	
	class department_grouped_data_common
	{
		private
			$id 	= NULL,
			$label	= NULL;
			
		public
			function get_id()
			{
				return $this->id;
			}
			
			function get_label()
			{
				return $this->label;
			}
	}

	$db			= NULL;	// Database object.
	$query		= NULL;	// Query object.
	$markup		= NULL; // Result markup.
	$line_arr_dept	= NULL;	// Line object array.
	$line_dept 		= NULL; // Line object.

	$db		= new class_db_connection();
	$options = new class_db_query_options();	
	
	// We don't need to update, so use fastest cursor.
	$options->set_scrollable(SQLSRV_CURSOR_FORWARD);
	
	// Initialize new query objects.	
	$query 			= new class_db_query($db, $options);	
	$query_staff	= new class_db_query($db, $options);
	$query_phone	= new class_db_query($db, $options);
	
	// Let's get a list of EHS categories.
	$query->set_sql("SELECT DISTINCT
							dbo.InitCap(_main.DeptDivisionName) AS label						
										
							FROM UKSpace.dbo.Departments AS _main
							WHERE _main.DeptDivisionName <> '' AND _main.DeptName <> ''
							ORDER BY label");
	
	//$query->set_params($params);
	
	$query->get_line_params()->set_class_name('department_grouped_data_common');
	$query->query();
	
	$line_arr_dept = $query->get_line_object_all();

	// Prepare a staff query.
	$query_staff->set_sql("SELECT DISTINCT
							_main.Dept_ID AS id,
							dbo.InitCap(_main.DeptName) AS label						
										
							FROM UKSpace.dbo.Departments AS _main
							WHERE _main.DeptName <> ''
							ORDER BY label");	
	$query_staff->prepare();


	// Prepare a phone number query.
	//$query_phone->set_sql('SELECT DISTINCT number FROM tbl_staff_phone WHERE display = 1 AND type = 1 AND fk_id = ?');
	//$query_phone->set_params(array(&$id));
	//$query_phone->prepare();
	
	// We'll loop through the category results.				
	foreach($line_arr_dept as $line_dept)
	{
		
		// Set our bound parameter and execute query for staff..
		//$dept = $line_dept->number;
		//$query_staff->execute();
		
		//$line_arr_staff = $query_staff->get_line_object_all();
		
	?>		
		<?php //echo $line_dept->id; ?>
		<?php echo $line_dept->get_label(); ?></br>
			
				<?php 
				
				/* Now loop through each staff result.
				foreach($line_arr_staff as $line_staff)
				{
		
					// Default to account if email missing.
					if(!$line_staff->email)
					{
						$line_staff->email = $line_staff->account .'@uky.edu';
					}
													
					// Let's get the list of office numbers for this staff entry.
					$id = $line_staff->id;
					$query_phone->execute();
					
					if($query_phone->get_row_exists())
					{																	
						$line_all_phone = $query_phone->get_line_object_all();
							
						// Clean phone number array.
						$phone_arr = array();
						
						// Populate phone number array with finished link/number strings.
						foreach($line_all_phone as $line_phone)
						{
							$phone_arr[] = $line_phone->number;
						}
						
						// Concatenate phone array into comma separated string.
						$phone = implode(', ', $phone_arr);
					}
					else
					{
						$phone = "NA";
					}
				?>
					<tr>
						<td>
							<a href="mailto:<?php echo $line_staff->email; ?>"><?php echo $line_staff->name_f.' '.$line_staff->name_l; ?>                                         </a>
						</td>
						<td>
							<?php echo $line_staff->title; ?>
						</td>
						<td>
							<?php echo $phone; ?>
						</td>
					</tr>
				<?php
				}*/
				?>
			
	<?php
	}
?>