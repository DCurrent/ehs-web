<!--Include: <?php echo __FILE__ . ", Last update: " . date(DATE_ATOM,filemtime(__FILE__)); ?>-->

<?php 
	include($cDocroot."/a_corner_image_0001.php");
	include($cDocroot."/a_contact_0001.php");
	include($cDocroot."/a_accident.php");
	include($cDocroot."/a_reg_archive_0001.php"); 
	
	$_GET['cDept'] = '3he00'; 
	include($cDocroot."/libraries/includes/inc_staff.php"); 
?>

<!--/Include: <?php echo __FILE__; ?>-->