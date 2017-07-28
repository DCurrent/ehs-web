<!--Include: <?php echo __FILE__ . ", Last update: " . date(DATE_ATOM,filemtime(__FILE__)); ?>-->
<?php	
	require('../../source/s_main.php');
	
	$list_module_all 	= new class_list_module();
	$list_module		= NULL;
	
	$subnav_request 	= new get();
	$subnav_module_data	= new class_module_data();
?>

<nav id="nav_sub" class="nav_sub">
    <ul id="toplevel">        
        <li><a href="#" onlick="return false" class="fly">Edit</a>
            <ul>
                <li><a href="settings.php?module=<?php echo $subnav_request->get_module(); ?>">Settings</a></li>
                <li><a href="questions.php?module=<?php echo $subnav_request->get_module(); ?>">Questions</a></li>
                <li><a href="access.php?module=<?php echo $subnav_request->get_module(); ?>">Access</a></li>
            </ul>
        </li>
        
        <li><a href="#" onlick="return false" class="fly">Module</a>
            <ul>
            	<?php 								
                    // New module option.
                    echo '<li><a href="settings.php?m='.ITEM_ID::FRESH.'"><span';
                    if($subnav_module_data->get_id() == ITEM_ID::FRESH) echo ' class="color_red" ';
                    echo '>Create New Module</span></a></li>'.PHP_EOL;								
                    
                    // Database generated options.								
                    foreach($list_module_all->module_list() as $list_module)
                    {
                        echo '<li><a href="?m='.$list_module->get_id().'"><span';
                        if($subnav_module_data->get_id() == $list_module->get_id()) echo ' class="color_red" ';
                        echo '>'.$list_module->get_desc_title().'</span></a></li>'.PHP_EOL;
                    }                                    
                ?>				
    		</ul>
		</li>               
    </ul>
</nav><!--/nav_sub-->
<!--/Include: <?php echo __FILE__; ?>-->