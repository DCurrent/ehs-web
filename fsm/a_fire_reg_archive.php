<!--**********Include: <?php echo basename(__FILE__) . ", Last update: " . date(DATE_ATOM,filemtime(__FILE__)); ?>**********-->
<?php 

	$cFile = "/docs/pdf/fs_annual_fire_safety_report_"; //File path string.
?>

<form action="/libraries/php/general_redirect_0001.php" method="post" name="form1" id="form1" target="_blank">
	<select name="select" style="width:125px;background-color:#DDF;font-size:10px;">        
        <option value="<?php print $cFile ?>2010.pdf" selected="selected">2010</option>
        <option value="<?php print $cFile ?>2009.pdf">2009</option>  
  	</select>
	
	<input type="submit" name="Submit" value="Go" />
	             
</form>
<!--**********/Include**********-->


