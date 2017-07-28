<!--Include: <?php echo __FILE__ . ", Last update: " .date(DATE_ATOM, filemtime(__FILE__)); ?>-->
<?php

	$params	= NULL;
	$cOutput	= NULL;
	$cDept		= NULL;
	$cEmail		= NULL;
	
	$cDept		= $_GET['cDept'];
	$cDept 		= '3he00';
		
	$query = "SELECT 
			account,
			name_f,													
			name_l,
			title,
			email,
			phone_o_ac,
			phone_o_lc,
			phone_o_main
						
			FROM tbl_staff
			
			WHERE
				department = ?
				AND
				active = ?		
			
			ORDER BY listing_order, name_l";
	
	$params = array(&$cDept, TRUE);
	
	$oDB->db_basic_select($query, $params);			
	
	while($oDB->db_line())
	{
		/*
		Default to users Link Blue account if email field is blank.
		*/
		$cEmail = $oDB->DBLine['email'];
		$cEmail = $cEmail ? $cEmail : $oDB->DBLine['account']."@uky.edu";
		
		$cOutput .= "<li><a href='mailto:".$cEmail."'>".$oDB->DBLine['name_f']." ".$oDB->DBLine['name_l']."</a>, ".$oDB->DBLine['title']."<br /> (".$oDB->DBLine['phone_o_ac'].") ".$oDB->DBLine['phone_o_lc']."-".$oDB->DBLine['phone_o_main']."</li>";
	}		
?>

<div id="SubSideContent" class="SubSideContent">
    <h3><a href="/ehsstaff.php">Staff</a></h3>
    
    <ul> 
      <?php echo $cOutput; ?>
    </ul>
    
    <p><a href="/docs/pdf/orgchart.pdf" target="_blank">Organizational Chart</a></p>
    <p><a href="/ehsstaff.php">Complete EHS Staff Listing</a></p>
</div><!--/SubSideContent-->

<!--/Include: <?php echo __FILE__;?>-->