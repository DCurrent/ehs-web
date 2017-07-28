
<div class="name_f">
<?php
	
	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
		
	$current	= NULL;
	$list		= NULL;	
	$cSel		= NULL;
	
	$cSel 		= $utl->utl_get_post('name_l');
		
	/* Prepare list arrays. */
	$list = $oFrm->forms_list_array_from_query("SELECT DISTINCT 
								name_f, name_f																	
			FROM         		tbl_class_participant	
			WHERE     			((name_l = ?) OR (? = '-1')) AND (name_f IS NOT NULL AND name_f <>'')			
			
			ORDER BY 			name_f", array(&$cSel, &$cSel), array("All First Names" => -1));
	
	echo $oFrm->forms_select("name_f", class_forms::ID_USE_NAME, "First Name:", class_forms::LABEL_USE_ITEM_KEY, $list, -1, NULL, array("element" => NULL));

?>
</div>