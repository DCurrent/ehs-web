<!--Include: <?php echo __FILE__ . ", Last update: " . date(DATE_ATOM,filemtime(__FILE__)); ?>-->
<?php 
	include(PATH::PARENT."a_corner_image.php");  
	include(PATH::PARENT."a_fsm.php");     
	include(PATH::PARENT."a_contact.php");
	include(PATH::PARENT."a_reg_archive.php");			
	
	$_GET['cDept'] = '3he30'; 
	include(PATH::ROOT."/libraries/includes/inc_staff.php"); 
?>
<!--/Include <?php echo __FILE__; ?>-->