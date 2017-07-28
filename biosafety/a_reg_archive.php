<!--Include: <?php echo basename(__FILE__) . ", Last update: " . date(DATE_ATOM, filemtime(__FILE__)); ?>-->
<?php 

	$cDocroot		= $_SERVER['DOCUMENT_ROOT']."/"; 		// Get siteroot address.
	$cFile			= "/docs/pdf/";							// Newsletter file path.
	$dir    		= $cDocroot."/docs/pdf";
	$cNewsletter	= NULL;				
	
	require($cDocroot.'libraries/php/newsletter_0001.php');	// Populate newsletter selection box.
	
	$cNewsletter = newsletter_0001($dir, "/bio_newsletter*/", $cFile, "listserv", "Listserv Subscription");	
?>

<div id="reg_biosafety" class="SubSideContent">
    <h3>ListServ And Newsletters</h3>
    <form action="/libraries/php/general_redirect_0001.php" method="post" name="frm_biosafety_reg_archive" id="frm_biosafety_reg_archive" target="_blank">
        <select name="select" class="small">
            <?php echo $cNewsletter; ?>         
        </select>
        
        <button type="submit" name="Submit" value="Go" class=""><img src="../media/image/icon_pdf.png" /></button>             
    </form>
</div><!--/reg_biosafety-->

<!--/Include: <?php echo __FILE__; ?>-->


