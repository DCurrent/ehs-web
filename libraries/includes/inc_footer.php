<!--Include: <?php echo __FILE__ . ", Last update: " . date(DATE_ATOM,filemtime(__FILE__)); ?>-->

<div id="footer_container" class="footer_container">
    
    <a href="//www.uky.edu" target="_blank" class="no_icon"><img src="../../media/image/uk_logo_0002.gif" alt="University of Kentucky" class="uk_logo" /></a>    
    
    <div id="footer_desc" class="footer_desc">
    	<a href="//www.uky.edu" target="_blank">University of Kentucky</a> - <a href="//www.uky.edu/Home/Web/eo/" target="_blank">An Equal Opportunity University</a>																																							<br />
      Questions/Comments: <a href="mailto:dvcask2@uky.edu">Damon V. Caskey</a><br />
      	Copyright &copy; <?php echo date("Y"); ?>, University of Kentucky<br />
    	<!--Last update: 
					<?php 
					echo date(DATE_ATOM, filemtime($_SERVER['SCRIPT_FILENAME']));  
                    
					if (isset($iReqTime)) 
					{ 
						echo ". Generated in " .round(microtime(true) - $iReqTime,3). " seconds."; 
					} 
					?>-->
    </div><!--/footer_desc-->
                    
    <a href="//validator.w3.org/check?uri=referer" class="no_icon"><img src="//www.w3.org/html/logo/badge/html5-badge-h-css3-semantics.png" class="wc3_logo" alt="HTML5 Powered with CSS3 / Styling, and Semantics" title="HTML5 Powered with CSS3 / Styling, and Semantics" /></a>        
    
</div><!--/footer_container-->
<!--/Include: <?php echo __FILE__; ?>-->