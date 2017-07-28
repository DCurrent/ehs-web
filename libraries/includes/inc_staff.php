<!--Include: <?php echo __FILE__ . ", Last update: " .date(DATE_ATOM, filemtime(__FILE__)); ?>-->
<?php

	require_once($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/database/main.php');

	function localize_us_number_side($phone) 
	{
		$finished = NULL;
		$result = '<a href="tel:+'.$phone.'"';	
		
		$numbers_only = preg_replace("/[^\d]/", "", $phone);
		$finished = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $numbers_only);
		
		$result .= ' title="Call '.$finished.'.">'.$finished.'</a>';
		
		return $result;
	}

	$db			= NULL;		// Database object.
	$query		= NULL;		// Query object.
	$markup		= NULL; 	// Result markup.
	$line_all	= NULL;		// Line object array.
	$line 		= NULL; 	// Line object.
	$line_all_phone	= NULL;	// Line object array for phone query.
	$line_phone 	= NULL;	// Line object for phone.
	$phone_arr		= NULL;	// Array of phone numbers/links.
	$phone			= NULL;	// Completed phone string.
	

	$db		= new class_db_connection();		
	$options = new class_db_query_options();	
	$options->set_scrollable(SQLSRV_CURSOR_FORWARD);
	
	$query 	= new class_db_query($db, $options);	
		
	$get = (object)$_GET;
	
	$query->set_sql('SELECT
		id,
		account,
		name_f,
		name_l,
		title,
		email		
			FROM tbl_staff
			WHERE department = ? AND active = 1
			ORDER BY listing_order, name_l');
			
	$query->set_params(array(&$get->cDept));
	$query->query();
	
	$line_all = $query->get_line_object_all();
			
	$query->set_sql('SELECT number FROM tbl_staff_phone WHERE display = 1 AND type = 1 AND fk_id = ?');
	$query->set_params(array(&$id));
	$query->prepare();
	
	foreach($line_all as $line)
	{
		// Default to Link Blue account if email field is blank.
		if(!$line->email)
		{
			$line->email = $line->account.'@uky.edu';
		}
		
		// Set our bound parameter variable, then execute prepared query.
		$id = $line->id;
		$query->execute();
						
		$line_all_phone = $query->get_line_object_all();
						
		if($query->get_row_exists())
		{	
			// Clean phone number array.
			$phone_arr = NULL;
			
			// Populate phone number array with finished link/number strings.
			foreach($line_all_phone as $line_phone)
			{
				$phone_arr[] = localize_us_number_side($line_phone->number);
			}
			
			// Concatenate phone array into comma separated string.
			$phone = implode(', ', $phone_arr);
		}
		else
		{
			$phone = "Phone # NA";
		}
		
		$markup .= '<li><a href="mailto:'.$line->email.'" title="Email '.$line->name_f.' '.$line->name_l.'.">'.$line->name_f.' '.$line->name_l.'</a><br /> '.$line->title.'<br />'.$phone.'</li>'.PHP_EOL;		
	}
	
	// Let's query for the department name.
	$query->set_sql('SELECT name FROM vw_uk_space_department WHERE number = ?');
	
	$query->set_params(array(&$get->cDept));
	$query->query();
	
	$line = $query->get_line_object();
?>

<div id="SubSideContent" class="SubSideContent">
    <h3><a href="/ehsstaff.php"><?php echo ucwords(strtolower($line->name)); ?> Staff</a></h3>
    
    <ul> 
      <?php echo $markup; ?>
    </ul>
    
    <p><a href="/docs/pdf/orgchart.pdf" target="_blank">Organizational Chart</a></p>
    <p><a href="/ehsstaff.php">Complete EHS Staff Listing</a></p>
</div><!--/SubSideContent-->

<!--/Include: <?php echo __FILE__;?>-->