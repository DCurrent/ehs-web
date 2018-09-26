<!--Include: <?php echo __FILE__ . ", Last update: " . date(DATE_ATOM,filemtime(__FILE__)); ?>-->

<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!--[if lte IE 8]>
    <hr/>
    <h3 class="color_red">Notice: Your browser is out of date or non WC3 standard compliant and may not render portions of this website correctly. We highly recommend upgrading to a more compliant browser such as <a href="//windows.microsoft.com/en-us/internet-explorer/download-ie">IE 9+</a>, <a href="//www.opera.com">Opera</a>, <a href="//www.mozilla.org">Firefox</a>, <a href="//www.google.com/chrome/">Google Chrome</a> or <a href="www.apple.com/safari/‎">Safari</a>.</h3>
    <hr/>
<![endif]-->

<script>
	function printpage()
	{
	  window.print();
	}
</script>

<div id="nav_main" class="nav_main navbar navbar-default">
    <ul class="nav navbar-nav">
    	<li><a href="#" onclick="return false" class="icon_departments" accesskey="r">Resources</a>
            <ul>
            	<li><a href="/">EHS Home</a></li>
            	<li><a href="/biosafety">Biosafety</a></li>
                <li><a href="/env">Environmental Management</a></li>
                <li><a href="/ohs">Occupational Health &amp; Safety</a></li>
                <li><a href="/radiation">Radiation Safety</a></li>
                <li><a href="/fire">University Fire Marshal</a></li>
            </ul>
    	</li>
        
        <li><a href="#" onclick="return false" class="icon_events">Events</a>
        	<ul>
            	<li><a href="/fsm">Campus Fire Safety Month, September</a></li>
      			<li><a href="/docs/pdf/bio_lab_safety_fair.pdf" target="_blank">Lab Safety Fair</a></li>
      			<li><a href="/docs/ppt/StormReady.ppt" title="StormReady Ceremony pictures in PowerPoint" target="_blank" >UK Campus StormReady Ceremony Pictures</a></li>
        	</ul>
        </li>
        
        <li><a href="#" onclick="return false" class="icon_reporting">Report an Incident</a>
        	<ul>
            	<li><a href="/ohs/accident.php">Accidents and Unsafe Conditions</a></li>
                <li><a href="/env/storm_water_quality.php">Illicit Stormwater Discharge</a></li>
                <li><a href="/docs/pdf/bio_ar_reporting_exposures_to_potentially_biohazardous_materials_0001.pdf">Potentially Biohazardous Material Exposure</a></li>
            </ul>        
        </li>
        
        <li><a href="#" onclick="return false" class="icon_committees" title="Safety Committees">Committees</a>
            <ul>
                <li><a href="/chairs.html">Departmental Safety Committees</a></li>
                <li><a href="/chemsafe.html">Chemical Safety Committee</a></li>
                <li><a href="/docs/pdf/AR.pdf">Committee Charges</a></li>
                <li><a href="/docs/pdf/bio_ibc_members_0001.pdf" target="_blank">Institutional Biosafety Committee</a></li>
                <li><a href="/docs/pdf/rad_comm.pdf">Radiation Safety Committee</a></li>
                <li><a href="/docs/pdf/ehs_committees_structure_0001.pdf">Organization Chart</a></li>
            </ul>
        </li>
        
        <li><a href="#" onclick="return false" class="icon_training">Training</a>
        	<ul>
            	<li><a href="/classes">Class List &amp; Schedules</a></li>
        		<li><a href="/classes/participant_list.php" >Participant List</a></li>
        		<li><a href="/classes/transcript.php" title="Click here for a transcript of classes taken and acquire certificates.">Personal Transcript</a></li> 
        	</ul>
        </li>
        
        <li><a href="#" onclick="return false" class="icon_search">Search</a>  	  
        	<ul>
            	<li>
                    <form method="get" action="//diogenes.uky.edu/search" target="new" class="search">          
                        <input type="hidden" name="site" value="uk" />
                        <input type="hidden" name="output" value="xml_no_dtd" />
                        <input type="hidden" name="client" value="uk" />
                        <input type="hidden" name="proxystylesheet" value="uk" />
                        <input type="hidden" name="sitesearch" value="ehs.uky.edu" />
                        <input type="search" placeholder="Search EHS" name="q" size="20" maxlength="100" accesskey="s" style="width:60%; font-size:12px;"/>		
                        <input type="submit" name="btn_search_submit" id="btn_search_submit" value="Go" />
                    </form>
            	</li>
                <li><a href="/site_index.php">A-Z Site Index</a></li>                
        	</ul>
        </li>
        
        <li id="utl_print"><a href="#" onclick="printpage()" class="icon_print">Print</a></li>
        
        <?php

			if(isset($_SESSION[ACCESS_SES_KEY::ACCOUNT]))
			{
			?>
            	<li><a href="<?php echo ACCESS_SETTINGS::AUTHENTICATE_URL; ?>?logoff=<?php echo TRUE; ?>" class="icon_logoff">Log Off</a></li>
            <?php
			}
			else
			{
			?>
				<li><a href="<?php echo ACCESS_SETTINGS::AUTHENTICATE_URL; ?>" class="icon_login">Log In</a></li>
            <?php
			}
		
		?>
                
	</ul>    
    
    <!--Site index letter links-->    
    <ul class="nav navbar-nav" style="z-index: 1;">
		<?php							
            $list 	= NULL;	// List markup.
            $letter	= NULL;	// Letter placeholder.
            
            // Loop range array (A to Z)
            foreach (range('A', 'Z') as $letter)
            {
                // Build link list markup.
                $list .= '<li><a href="/site_index.php#'.$letter.'" class="no_icon">'.$letter.'</a></li>'.PHP_EOL;
            }
            
            // Output markup.
            echo $list;
        ?>
    </ul>
    <!--/Site index letter links-->
    
</div><!--/nav_main-->
<!--/Include: <?php echo __FILE__; ?>-->