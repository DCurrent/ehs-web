<!--Include: <?php echo __FILE__ . ", Last update: " . date(DATE_ATOM,filemtime(__FILE__)); ?>-->

<?php
	include($cLRoot."a_corner_image_0001.php");
    include($cLRoot."a_contact.php");
    include($cDocroot."a_accident.php");
    include($cLRoot."a_reg_archive.php");            					
    
	$_GET['cDept'] = '3he40'; 
	include($cDocroot."/libraries/includes/inc_staff.php");
?>

<!--Include: <?php echo __FILE__; ?>-->