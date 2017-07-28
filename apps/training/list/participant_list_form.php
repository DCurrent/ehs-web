<?php

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
	
	$cLRoot			= $cDocroot;
	
	const DEBUG = FALSE;		//!= FALSE: Disables all training modules with maintenance alert to users; value is passed as an ETA. 
	
	$access_cn			= NULL;	//Current user account name.
	$auth_lvl			= NULL;	//Authorization level. Must be 1 or higher to view certain trianing (i.e. Select Agents).
	$cAuthorized_List	= NULL; //List of users authorized to view Select Agents training.
	$cAuthorized		= NULL; //Individual user authorized to view Select Agents training.
		
	$query				= NULL;	//Select query for droplists.
	$p_query			= NULL;	//Select query for training table.
	$oDBSpace			= NULL;	//Class object: Database (UK Space)
	$oFrmSpace			= NULL;	//Class object: Forms (From UK Space)
	$range_start		= NULL;	//Date range start.
	$range_end			= NULL;	//Date range end.	
		
	// Initialize UK Space database object.
	$connect = new class_db_old_connect_params();	
	
	$connect->set_name('UKSpace');
	
	$oDBSpace = new class_db($connect);
	
	$oFrmSpace			= new class_forms(array("DB"=>$oDBSpace, "Err"=>$err, "Utl"=>$utl));
		
	$access_cn			= $_SESSION['access_cn'];	
		
	// Set access level to 1 if user is on a list authorized to view Select Agents training participants.
	$cAuthorized_List = array("dvcask2", "bnels3", "dwhibb0", "glschl1", "rdeldr0", "kmcgu1", "hmtr222", "ejrous0");
	
	foreach($cAuthorized_List as $cAuthorized)
	{
		if($access_cn === $cAuthorized)
		{
			$auth_lvl = 1;
			break;	
		}
	}	
	
	// If date range values are not set, populate with defaults.
	// Initialize DB connection and query objects.
	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);	
	
	// If date range values are not set, populate with defaults.
	$query->set_sql("SELECT TOP 1 class_date FROM tbl_class WHERE class_date <> '' ORDER BY class_date");
	$query->query();
	$date_range_start = new DateTime($query->get_line_object()->class_date);
	
	// If date range values are not set, populate with defaults.
	$query->set_sql("SELECT TOP 1 class_date FROM tbl_class WHERE class_date <> '' ORDER BY class_date DESC");
	$query->query();
	$date_range_end = new DateTime($query->get_line_object()->class_date);
	
		
	$query 	= "SELECT id, desc_title FROM tbl_class_train_parameters";
		
	if($auth_lvl)
	{	
		 $query .= " WHERE (desc_title <> '')";			
	}
	else
	{
		$query 	.= " WHERE NOT id IN (51, 10, 62)";		
	}	
	
	$query			.= " ORDER BY desc_title";
	
	// Fieldset markup: Date Range
	$oFrm->forms_fieldset_addition('instructions', '<p>Enter the desired date range of records.</p>');		
	
	$oFrm->forms_time('range_start', class_forms::ID_USE_NAME, "Start:", $range_start, NULL, "{dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss', changeYear: true, constrainInput: true, yearRange: '".$date_range_start['Year'].":".$date_range_end['Year']."'}");
	
	$oFrm->forms_time('range_end', class_forms::ID_USE_NAME, "End:", $range_end, NULL, "{dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss', changeYear: true, constrainInput: true, yearRange: '".$date_range_start['Year'].":".$date_range_end['Year']."'}");
																	
	$oFrm->forms_fieldset("fs_range", "Date Range");
	
	// Fieldset markup: Account
	$query 		= "SELECT DISTINCT account FROM tbl_class_participant WHERE (account <> '') ORDER BY account";
	
	$oFrm->itemsList = $oFrm->forms_list_array_from_query($query, NULL);	
	
	$oFrm->forms_fieldset_addition('instructions', 'Select account, or leave blank for all accounts. Type the first few letters of an item to quickly locate it in the list. Hold Ctrl (Windows) or Command (Mac) to choose multiple items or remove a previous selection.');
	
	$oFrm->forms_select("frm_lst_account[]", class_forms::ID_USE_NAME, "Account: ", class_forms::LABEL_USE_ITEM_KEY, $oFrm->itemsList, -1, NULL, array("element" => NULL), class_forms::EVENTS_NONE, 'multiple size="6"');
	
	$oFrm->forms_fieldset("fs_account", "Accounts");
	
	// Fieldset markup: Names
	$query 		= "SELECT DISTINCT name_l FROM tbl_class_participant WHERE (name_l IS NOT NULL AND name_l <> '') ORDER BY name_l";
	
	$oFrm->forms_fieldset_addition('instructions', '<p>Choose a last name; the list of first names will then be populated based on your selection.</p>');
	
	$oFrm->itemsList = $oFrm->forms_list_array_from_query($query, NULL, array("All Last Names" => -1));	
	
	$oFrm->forms_select("name_l", class_forms::ID_USE_NAME, "Last Name:", class_forms::LABEL_USE_ITEM_KEY, $oFrm->itemsList, -1, NULL, array("element" => "first_name_search"));
	$oFrm->forms_select("name_f", class_forms::ID_USE_NAME, "First Name:", class_forms::LABEL_USE_ITEM_KEY, array("All First Names" => -1), -1, NULL);
	
	$oFrm->forms_fieldset("fs_name", "Name");	
	
	// Fieldset markup: Dept	
	$query = "SELECT distinct department, department, DeptName FROM ehsinfo.dbo.tbl_class_participant LEFT JOIN UKSpace.dbo.MasterDepartment ON department = UKSpace.dbo.MasterDepartment.DeptNo where department <> '' AND DeptName <> '' order by DeptName";
		
	$oFrm->itemsList = $oFrmSpace->forms_list_array_from_query($query, NULL);	
	
	$oFrm->forms_fieldset_addition('instructions', '<p>Select department, or leave blank for all departments. Type the first few characters of a department number to quickly locate it in the list. Hold Ctrl (Windows) or Command (Mac) to choose multiple items or remove a previous selection.</p>');	
	
	$oFrm->forms_select("department[]", class_forms::ID_USE_NAME, "Department: ", class_forms::LABEL_USE_ITEM_KEY, $oFrm->itemsList, -1, NULL, array("element" => NULL), class_forms::EVENTS_NONE, 'multiple size="6"');		
	$oFrm->forms_fieldset("fs_department", "Department");	
		
	// Fieldset markup: Classes
	$query			= "SELECT id, desc_title FROM tbl_class_train_parameters ORDER BY desc_title";
	
	$oFrm->itemsList = $oFrm->forms_list_array_from_query($query, NULL);	
	
	$oFrm->forms_fieldset_addition('instructions', 'Select class type, or leave blank for all classes. Type the first few letters of an item to quickly locate it in the list. Hold Ctrl (Windows) or Command (Mac) to choose multiple items or remove a previous selection.');
	
	$oFrm->forms_select("class[]", class_forms::ID_USE_NAME, "Class Type:", class_forms::LABEL_USE_ITEM_KEY, $oFrm->itemsList, -1, NULL, array("element" => NULL), class_forms::EVENTS_NONE, 'multiple size="6"');
	
	$oFrm->forms_fieldset("fs_class", "Class Types");	
	
	// Fieldset markup: Trainer
	$query = "SELECT id, name_l + ', ' + name_f AS name FROM tbl_staff WHERE instructor = 1 ORDER BY name_l, name_f";
		
	$oFrm->itemsList = $oFrm->forms_list_array_from_query($query, NULL, array("Online Class" => 0));	
	
	$oFrm->forms_fieldset_addition('instructions', '<p>Select trainer, or leave blank for all trainers. Type the first few letters of an item to quickly locate it in the list. Hold Ctrl (Windows) or Command (Mac) to choose multiple items or remove a previous selection.</p>');
	
	$oFrm->forms_select("trainer[]", class_forms::ID_USE_NAME, "Trainer:", class_forms::LABEL_USE_ITEM_KEY, $oFrm->itemsList, -1, NULL, array("element" => NULL), class_forms::EVENTS_NONE, 'multiple size="6"');
	
	$oFrm->forms_fieldset("fs_trainer", "Trainers");
					
?>	 	         
        <form action="../participant_list_table.php" method="post" name="class_participants" id="class_participants" class="class_participants NoPrint">
        <input type="hidden" name="form_name" 	value="class_participants">         
         
         
        <fieldset name="fs_range" id="fs_range" class="">
            <legend id="fs_range_legend" class="">Date Range</legend>
            
            <p>Enter the desired date range of records.</p>
                                                                            
            <label for="range_start" id="range_start_label" class="">Start:</label>
                                    
            <input type="text" required name="range_start" id="range_start" value="1900-01-01 00:00:00" readonly class="date_entry hasDatepicker" >        
                                      
        </fieldset>
                    	
            	    		    
		<?php
			// Insert fieldset markups.
			echo $oFrm->forms_fieldset_all_get();	
		?>
        
          <p align="center">
            <input type="Submit" value="Begin Search" name="Submit" id="frm_button"/>
          </p>
         </form>

<script>         
/* attach a submit handler to the form */
$(".class_participants").submit(function(event) 
{
	/* stop form from submitting normally */
	event.preventDefault();

	$(".loadImage").show();
	$(".result_table").hide();
	
	/* get some values from elements on the page: */
	var $form = $(this),
	url = $form.attr('action');
	
	/* Send the data using post */
	var posting = $.post(url, $form.serialize());
	
	/* Put the results in a div */
	posting.done(function( data ) 
	{
		$(".loadImage").hide();
		$(".result_table").empty().append( data );
		$(".result_table").show();
	});
});


$(".first_name_search").change(function() {
	
	var $url = '/libraries/inserts/first_names.php';
	var $target_element = $('.name_f');
	var $form = $('.class_participants');
	var posting = null;
	
	$target_element.html('<div class="loading_inline"><span class="alert">Loading first names...</span> <img src="/media/image/meter_bar.gif" class="loadImage_insert" align="middle" alt="Working..." title="Working..." /></div>');
	
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