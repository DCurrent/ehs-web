<!--Include: <?php echo __FILE__ . ", Last update: " . date(DATE_ATOM,filemtime(__FILE__)); ?>-->
<?php 
	include($cLRoot."a_corner_image.php");  
	//include($cLRoot."a_fsm_0001.php");     
	include($cLRoot."a_contact.php");
	include($cPRoot."a_reg_archive.php");			
	
	$_GET['cDept'] = '3he30'; 
	include($cDocroot."/libraries/includes/inc_staff.php"); 
?>
<!--/Include: <?php echo __FILE__; ?>-->