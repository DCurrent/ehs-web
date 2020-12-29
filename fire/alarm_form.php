<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."fire/";
	
	$addsTop 		= NULL;	//Array of items to add to top of drop list.
	$addsEnd 		= NULL;	//Array of items to add to end of drop list.
	$addsEndStr 	= NULL;	//String to pass item adds (top) to insert script through url get.
	$addsEndStr	= NULL;	//String to pass item adds (end) to insert script through url get.
	$time 			= date(DATE_FORMAT);
	
	$cDList			= array("Facility"	=> NULL,
						"Room"		=> NULL);	
	
	$date_range_end['Year'] = date('Y');
	$date_range_start['Year'] = $date_range_end['Year'] - 1;
	
	// Initialize UK Space database object.
	$connect = new class_db_old_connect_params();	
	
	$connect->set_db_name('UKSpace');
	
	$oDBSpace = new class_db($connect);
	
	$oFrmSpace			= new class_forms(array("DB" => $oDBSpace));
		
	/* Prepare fieldsets. */
	
	/* Location */
	$oFrm->itemsList['facility']	= $oFrmSpace->forms_list_array_from_query("SELECT DISTINCT BuildingCode, 
										BuildingName,
										StreetAddress1 + ' ' + City + ' ' + State AS full_address										
					FROM         		MasterBuildings
					WHERE     			(BuildingName <> '')
					ORDER BY 			full_address, BuildingName", NULL, array("Select Facility" => NULL));	//Facility.
					
	$oFrm->itemsList['room'] 	= $oFrm->forms_list_array_from_query(NULL, NULL, array("Not Available; Please Select a facility." => NULL)); //Room.
						
	$oFrm->forms_fieldset_addition('instructions', '<p>Select a facility address first, then choose the room or area.</p>');
										
	$oFrm->forms_select("facility", class_forms::ID_USE_NAME, "Facility", class_forms::LABEL_USE_ITEM_KEY, $oFrm->itemsList['facility'], class_forms::VALUE_CURRENT_NONE, class_forms::VALUE_CURRENT_NONE, array("element" => "room_search required"));
	
	$oFrm->forms_select("room", class_forms::ID_USE_NAME, "Room/Area", class_forms::LABEL_USE_ITEM_KEY, $oFrm->itemsList['room'], class_forms::VALUE_CURRENT_NONE, $c_vals['room'], array("element" => "quiz_parameters required"), class_forms::EVENTS_NONE, "required");							 
	
	$oFrm->forms_fieldset("fs_location", "Location");	

	$addsTop = array("Select Room/Area" => NULL, "Outside of facility" => -2, "Not available" => -3); 
			
	$addsTopStr = $utl->array_to_url("addsTop", $addsTop);
	
	// Event
	
	// Fieldset markup: Date Range	
	$oFrm->forms_fieldset_addition('instructions', '<p>Enter the time of alarm events.</p>');		
	
	$oFrm->formElement['time_received'] = $oFrm->forms_time('time_received', class_forms::ID_USE_NAME, "Received", $time, class_forms::VALUE_CURRENT_NONE, "{dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss', changeYear: true, constrainInput: true, yearRange: '".$date_range_start['Year'].":".$date_range_end['Year']."'}");
	
	$oFrm->formElement['time_silenced'] = $oFrm->forms_time('time_silenced', class_forms::ID_USE_NAME, "Slienced", $time, class_forms::VALUE_CURRENT_NONE, "{dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss', changeYear: true, constrainInput: true, yearRange: '".$date_range_start['Year'].":".$date_range_end['Year']."'}");
	
	$oFrm->formElement['time_reset'] = $oFrm->forms_time('time_reset', class_forms::ID_USE_NAME, "Reset", $time, class_forms::VALUE_CURRENT_NONE, "{dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss', changeYear: true, constrainInput: true, yearRange: '".$date_range_start['Year'].":".$date_range_end['Year']."'}");
																	
	$oFrm->forms_fieldset("fs_time", "Time");
	
	// Event details
		
		// Source
		$oFrm->itemsList = array("911" => 1, "Delta" => 2, "Simplex" => 3, "Station 10 (MC/Hospital)" => 4, "Other" => 5);	
				
		$oFrm->formElement['recfrom'] = $oFrm->forms_radio("recfrom", class_forms::ID_USE_NAME, class_forms::LABEL_USE_ITEM_KEY, $oFrm->itemsList, class_forms::VALUE_DEFAULT_NONE, class_forms::VALUE_CURRENT_NONE, array("element" => NULL), class_forms::EVENTS_NONE, "required");												
			
		$oFrm->forms_fieldset("fs_from", "Source");	
		
		// Details.
		// Building occupied.
		$oFrm->itemsList = array("Yes" => 1, "No" => 0);
		
		$oFrm->forms_radio("occupied", class_forms::ID_USE_NAME, class_forms::LABEL_USE_ITEM_KEY, $oFrm->itemsList, class_forms::VALUE_DEFAULT_NONE, class_forms::VALUE_CURRENT_NONE, array("element" => NULL), class_forms::EVENTS_NONE, "required");
		
		$oFrm->forms_fieldset("fs_occupied", "Building occupied");
		
		// Building evacuated.
		$oFrm->forms_radio("evacuated", class_forms::ID_USE_NAME, class_forms::LABEL_USE_ITEM_KEY, $oFrm->itemsList, class_forms::VALUE_DEFAULT_NONE, class_forms::VALUE_CURRENT_NONE, array("element" => NULL), class_forms::EVENTS_NONE, "required");
		
		$oFrm->forms_fieldset("fs_evacuated", "Building evacuated");
		
		//Fire dept. notified.
		$oFrm->formElement['notified'] = $oFrm->forms_radio("notified", class_forms::ID_USE_NAME, class_forms::LABEL_USE_ITEM_KEY, $oFrm->itemsList, class_forms::VALUE_DEFAULT_NONE, class_forms::VALUE_CURRENT_NONE, array("element" => NULL), class_forms::EVENTS_NONE, "required");
		
		$oFrm->forms_fieldset("fs_notified", "Fire department notified");
		
		//Alarm activated.
		$oFrm->formElement['activated'] = $oFrm->forms_radio("activated", class_forms::ID_USE_NAME, class_forms::LABEL_USE_ITEM_KEY, $oFrm->itemsList, class_forms::VALUE_DEFAULT_NONE, class_forms::VALUE_CURRENT_NONE, array("element" => NULL), class_forms::EVENTS_NONE, "required");
			
		$oFrm->forms_fieldset("fs_activated", "Fire alarm activated");
		
		/* Nest previous fieldsets (This will need rework as of 2014-02-27 
		$oFrm->formElement['fs_time'] = $oFrm->fieldset['fs_time'];
		$oFrm->formElement['fs_from'] = $oFrm->fieldset['fs_from'];
		$oFrm->formElement['fs_occupied'] = $oFrm->fieldset['fs_occupied'];
		$oFrm->formElement['fs_evacuated'] = $oFrm->fieldset['fs_evacuated'];
		$oFrm->formElement['fs_notified'] = $oFrm->fieldset['fs_notified'];
		$oFrm->formElement['fs_activated'] = $oFrm->fieldset['fs_activated'];
		
		$oFrm->forms_fieldset("fs_event_details", "Event");*/
?>


                                   
<form action="alarmsubmit.php" method="post" name="alarm" id="alarm" class="alarm_input">
    <?php 
		echo $oFrm->forms_fieldset_get_all('fs_location');
	?>
</form>

<script>
        $(".room_search").change(function() {
        
            var $url = '/libraries/inserts/rooms.php<?php echo '?'.$addsTopStr.'&'.$addsEndStr; ?>&attributes=required';
            var $target_element = $('.room');
            var $form = $('.alarm_input');
            var posting = null;
            
            $target_element.html('<div class="loading_inline"><span class="alert">Loading rooms/labs...</span> <img src="/media/image/meter_bar.gif" class="loadImage_insert" align="middle"></div>');
            
            /* Put the results in a div */
            posting = $.post($url, $form.serialize());
            
            posting.done(function(data) 
            {	
                //alert("test:" + t);	
                //$(".loadImage").hide();
                $target_element.empty().append( data );
                //$(".result_table").show();
            });
        });
</script>       
                