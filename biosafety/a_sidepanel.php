<!--Include: <?php echo __FILE__ . ", Last update: " . date(DATE_ATOM, filemtime(__FILE__)); ?>-->

<?php
	include("a_corner_image.php"); 
	include("a_contact.php"); 
	include("a_reg_archive.php");
	
	$_GET['cDept'] = '3he20'; 
	include($cDocroot."/libraries/includes/inc_staff.php");	
?>

<!--/Include: <?php echo __FILE__; ?>-->