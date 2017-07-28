

<?php

	// Supplanted with "room".
		
	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
		
	/*
	rooms
	Damon Vaughn Caskey
	2011_03_02
	
	Output room selection box from room_0001 function. Used by ajax to generate room drop list contents when building is selected without reloading page.
	*/
		
	$oFrmSpace 		= NULL;
	$oDBSpace 		= NULL;
	$params			= NULL;
	$list			= NULL;
	$attributes 	= NULL;
	
	$value		= array("current" => class_forms::VALUE_CURRENT_NONE,
						"default" => class_forms::VALUE_DEFAULT_NONE);
	
	$addsTop	= array("Select Item" => NULL);	//Additional items to insert at top/front of list.
	$addsEnd	= array();						//Additional items to insert at end/back of list.
	
	$addsTop		= $utl->utl_get_get("addsTop", $addsTop);	
	$addsEnd		= $utl->utl_get_get("addsEnd", $addsEnd);
	$attributes	= $utl->utl_get_get("attributes", $attributes);
	
	// Initialize UK Space database object.
	$connect = new class_db_old_connect_params();	
	
	$connect->set_name('UKSpace');
	
	$oDBSpace = new class_db($connect);
		
	$oFrmSpace	= new class_forms(array("DB" => $oDBSpace));
	
	$params['facility'] = $utl->utl_get_post('facility');
		
	/* Prepare list arrays. */
	$list = $oFrmSpace->forms_list_array_from_query("SELECT DISTINCT 
									RoomBarCode,
									RoomID,
									UsageSubDescr										
				FROM         		Rooms_Chematix
				WHERE     			(BuildingCode = ?)
				ORDER BY 			RoomID", array(&$params['facility']), $addsTop, $addsEnd);	//Facility.
		
			
	echo $oFrmSpace->forms_select("room", class_forms::ID_USE_NAME, "Room/Lab:", class_forms::LABEL_USE_ITEM_KEY, $list, $value['default'], $value['current'], $cClass=array("element" => "required"), class_forms::EVENTS_NONE, $attributes);	
	
?>