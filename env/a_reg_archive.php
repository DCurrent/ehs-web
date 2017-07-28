<!--Include: <?php echo __FILE__ . ", Last update: " . date(DATE_ATOM,filemtime(__FILE__)); ?>-->
<?php 

	$cFile			= "/docs/pdf/";									//Newsletter file path.
	$dir    		= $cDocroot."/docs/pdf";
	$cNewsletter	= NULL;				
	
	require($cDocroot.'libraries/php/newsletter_0001.php');			//Populate newsletter selection box.
	
	$cNewsletter = newsletter_0001($dir, "/emm_era*/i", $cFile, NULL, NULL);	
?>
<div id="env_reg_archive" class="SubSideContent">
    <h3>Environmental Register Archive</h3>
    <form action="/libraries/php/general_redirect_0001.php" method="post" name="form1" id="form_env_reg_archive" target="_blank">
        <select name="select" class="small">
            <?php echo $cNewsletter; ?>         
        </select>
        
        <input type="submit" name="Submit" value="Go" class="icon_pdf">
                        
    </form>
</div><!--/env_reg_archive-->
<!--/Include: <?php echo __FILE__; ?>-->