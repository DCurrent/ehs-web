<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/database/main.php");
	
	$cLRoot		= $cDocroot."classes/";
	
	// Database objects.
	$db			= NULL;	// Database.
	$query		= NULL;	// Query.
	
	// UK Space database objects.	
	$line_all	= NULL;	// Line object array.
	$line		= NULL;	// Individual line.
	
	$markup		= NULL; // Result markup.	
	
	// Initialize DB connection and query objects.			
	$db = new class_db_connection();		
	$query = new class_db_query($db);	
	
	// Set SQL and parameter string.	
	$query->set_sql("SELECT code, name FROM vw_uk_space_facility order by name");	
	$query->query();
	
	$line_all = $query->get_line_object_all();
		
	foreach ($line_all as $line)
	{
		$facility_options .= '<option value="'.$line->code.'">'.ucwords(strtolower($line->name)).'</option>'.PHP_EOL;
	} 
?>
    <form action="manual_entry_submit.php" method="post" name="manual_entry" id="manual_entry" class="manual_entry NoPrint">
        
    	<fieldset name="fs_location" id="fs_location" class="">
			<legend id="fs_location_legend" class="">Location</legend>
            
			<p class=" instructions">Select a facility first, then choose primary room/area or lab.</p>	
    			
			<label for="facility" id="facility_label" class="">Facility</label>
            <select name="facility" id="facility" class="room_search" data-child-selector=".room_options" required>		
            	<option value="" default selected>Select Facility</option>				
                <optgroup label="Facility">
                    <?php echo $facility_options; ?>
            	</optgroup>               		
			</select>

			<!--This is shown while new tiems are loaded and the form element directly below is hidden.-->			
            <p class="room_options_progress load color_red center" style="display:none">
            	Loading Rooms...
            	<img name="img_room_load_progress" id="img_room_load_progress" src="/media/image/meter_bar.gif" alt="Loading icon" title="Loading Rooms" />
            </p>
			<label for="room" id="room_label" class="label">Room/Lab</label>
            <select name="room" id="room" class="room_options" data-source-url="../libraries/inserts/room.php" disabled="disabled" required>            	
                <option value="" selected="">Select Room/Area/Lab</option>                         
            </select>            	
		</fieldset>
    
		<?php
			// Insert fieldset markups.
			echo $oFrm->forms_fieldset_all_get();	
        ?>
    
        <p align="center">
            <input type="Submit" value="Submit" name="Submit" id="frm_button"/>
        </p>
    </form>

<script>
$('.room_search').change(function(event)
{	
	options_update(event);	
});
</script>
