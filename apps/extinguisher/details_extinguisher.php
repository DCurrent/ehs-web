<?php

define('CMD_NEW', 1);
define('CMD_FIRST', 2);
define('CMD_PREVIOUS', 3);
define('CMD_NEXT', 4);
define('CMD_LAST', 5);
define('CMD_SAVE', 6);
define('CMD_INS_SAVE', 7);

class local_functions
{
	public function inspection_select_options($source = NULL, $default = NULL, $current = NULL)
	{	
		$result = NULL;
	
		if($current == NULL)
		{
			$current = $default;
		}
	
		foreach($source as $object)
		{
			if($object->id === $current)
			{
				$selected = 'selected';
			}
			else
			{
				$selected = NULL;
			}
			
			$result .= '<option value="'.$object->id.'" '.$selected.'>'.$object->memo.'</option>'.PHP_EOL;											
		}
		
		return $result;
	}
}

$local_functions = new local_functions();


	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
	require('../../libraries/php/classes/database/main.php'); 	// Database class. 

	$cLRoot			= $cDocroot.'fire/';
		
	$db				= NULL;	// Database object.
	$query			= NULL;	// Query object.
	$db_space 		= NULL; // Space database object.
	$query_space	= NULL; // 
	$markup			= NULL; // Result markup.
	$live_record 	= 0;	// Record new or filled from database?
	
	// Verify user authorization and get account info.
	$oAcc->access_verify();	
		
	// Convert get array to object.
	class get
	{
		public $id = NULL;
	}
	
	$get = new get();	
	$get = (object)$_GET;
	
	class post
	{
		public $id 			= NULL; 
		public $serial		= NULL;
		public $born 		= NULL;
		public $life 		= NULL;
		public $type 		= NULL;
		public $location	= NULL;
		public $memo 		= NULL;
		
		public $inspection_tbl_extinguisher_id = NULL;
		public $inspection_save = NULL;
		public $inspection_delete = NULL;
		public $inspection_time = NULL;
		public $inspection_condition = NULL;									
		public $inspection_action = NULL;
		public $inspection_memo = NULL;
		
		public $First		= NULL;
		public $Last		= NULL;
		public $Next		= NULL;
		public $Previous	= NULL;
		public $New			= NULL;
	}
	
	$post = new post();	
	$post = (object)$_POST;
	
	class extinguisher
	{
		// Extinguisher output object.
		
		public $id					= NULL;
		public $action				= NULL;
		public $serial				= NULL;
		public $life				= NULL;
		public $remaining			= NULL;
		public $type				= NULL;
		public $size				= NULL;
		public $location			= NULL;
		public $location_desc		= NULL;
		public $memo				= NULL;
		public $log_update_account	= NULL;
		public $log_update_ip		= NULL;
		public $submit				= NULL;
	}
	
	class inspection
	{
		public $id 					= NULL;
		public $fk_tbl_extinguisher_id = NULL;
		public $time 				= NULL;
		public $time_str 			= NULL;
		public $condition 			= NULL;
		public $action 				= NULL;
		public $memo 				= NULL;
		public $log_create 			= NULL;
		public $log_update 			= NULL;
		public $log_update_account 	= NULL;
		public $log_update_ip 		= NULL;
	}
	
	$ext_details = new extinguisher();
	
	// Initialize DB connection and query objects.
	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);
	
	//$db_space_connect_params = new db_connect_params();
	//$db_space_connect_params->set_name('UKSpace');
	
	//$db_space = new class_db_connection($db_space_connect_params);
	//$db_space_query = new class_db_query($db_space);
	
	//$db_space_query->set_sql("SELECT DISTINCT BuildingCode, BuildingName FROM MasterBuildings WHERE (BuildingName <> '') ORDER BY BuildingName");
	//$db_space_query->query();
			
	if($utl->utl_get_post('New'))
	{
	}
	else
	{		
		if($utl->utl_get_post('inspection_delete'))
		{
			$query->set_sql('DELETE FROM tbl_extinguisher_inspection WHERE id = ?');
			$query->set_params(array(&$post->inspection_delete));
			
			// Execute the upsert query.
			$query->query();
					
			// Select by ID used to post as normal.
			$query->set_sql('SELECT TOP 1 * FROM dbo.vw_tbl_extinguisher WHERE id = ?');	
			$query->set_params(array(&$post->inspection_tbl_extinguisher_id));	
	
			// Execute query.
			$query->query();
		}
		else if($utl->utl_get_post('inspection_save'))
		{			
			$inspection_post = new inspection();
			
			$inspection_post->action 		= $utl->utl_get_post('inspection_action_'.$post->inspection_save);
			$inspection_post->condition		= $utl->utl_get_post('inspection_condition_'.$post->inspection_save);
			$inspection_post->id			= $post->inspection_save;
			$inspection_post->log_update	= date(DATE_FORMAT);
			$inspection_post->log_update_ip	= $_SERVER['REMOTE_ADDR'];			
			$inspection_post->memo			= $utl->utl_get_post('inspection_memo_'.$post->inspection_save);	
			$inspection_post->time			= date(DATE_FORMAT, strtotime($utl->utl_get_post('inspection_time_'.$post->inspection_save)));	
						
			// Update or insert main details.
			$query->set_sql('MERGE INTO tbl_extinguisher_inspection
			USING 
				(SELECT ? AS Search_Col) AS SRC
			ON 
				tbl_extinguisher_inspection.id = SRC.Search_Col
			WHEN MATCHED THEN
				UPDATE SET
					time				= ?,									
					condition			= ?,
					action				= ?,									
					memo				= ?,
					log_update			= ?,
					log_update_account	= ?,
					log_update_ip		= ?
			WHEN NOT MATCHED THEN
				INSERT (fk_tbl_extinguisher_id, time, condition, action, memo, log_update, log_update_account, log_update_ip)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?)
				OUTPUT INSERTED.id;');
			
			$query->set_params(array($inspection_post->id,
				&$inspection_post->time,
				&$inspection_post->condition,
				&$inspection_post->action,
				&$inspection_post->memo,
				&$inspection_post->log_update,
				$oAcc->get_account(),
				&$inspection_post->log_update_ip,
				&$post->inspection_tbl_extinguisher_id,
				&$inspection_post->time,
				&$inspection_post->condition,
				&$inspection_post->action,
				&$inspection_post->memo,
				&$inspection_post->time,
				$oAcc->get_account(),
				&$inspection_post->log_update_ip
			));
					
			// Execute the upsert query.
			$query->query();
					
			// Select by ID used to post as normal.
			$query->set_sql('SELECT TOP 1 * FROM dbo.vw_tbl_extinguisher WHERE id = ?');	
			$query->set_params(array(&$post->inspection_tbl_extinguisher_id));	
	
			// Execute query.
			$query->query();
		}
		else if($utl->utl_get_post('First'))
		{
			$query->set_sql('SELECT TOP 1 * FROM dbo.vw_tbl_extinguisher');
			$query->query();
		}
		else if($utl->utl_get_post('Last'))
		{
			$query->set_sql('SELECT TOP 1 * FROM dbo.vw_tbl_extinguisher ORDER BY ID DESC');
			$query->query();
		}
		else if($utl->utl_get_post('Next'))
		{
			// Set query and params to select next ID higher than current.
			$query->set_sql('SELECT TOP 1 * FROM dbo.vw_tbl_extinguisher WHERE id > ?');
			$query->set_params(array(&$get->id));
			
			// Execute query.
			$query->query();
			
			// If no rows returned, default to top record to create "loop back" effect.
			if($query->get_row_exists() == FALSE)
			{
				$query->set_sql('SELECT TOP 1 * FROM dbo.vw_tbl_extinguisher');	
				$query->query();
			}
		}
		else if($utl->utl_get_post('Previous'))
		{
			// Set query and params to select ID lower than current.
			$query->set_sql('SELECT TOP 1 * FROM dbo.vw_tbl_extinguisher WHERE id < ? ORDER BY ID DESC');
			$query->set_params(array(&$get->id));
			
			// Execute query.
			$query->query();
			
			// If no rwos returned, default to last record to create "loop back" effect.
			if($query->get_row_exists() == FALSE)
			{
				$query->set_sql('SELECT TOP 1 * FROM dbo.vw_tbl_extinguisher ORDER BY ID DESC');
				$query->query();
			}	
		}
		else if($utl->utl_get_post('btn_save') === 'Save')
		{			
			// Update or insert main details.
			$query->set_sql('MERGE INTO tbl_extinguisher
			USING 
				(SELECT ? AS Search_Col) AS SRC
			ON 
				tbl_extinguisher.id = SRC.Search_Col
			WHEN MATCHED THEN
				UPDATE SET
					serial				= ?,
					born				= ?,									
					life				= ?,
					type				= ?,					
					location			= ?,									
					memo				= ?,
					log_update			= ?,
					log_update_account	= ?,
					log_update_ip		= ?
			WHEN NOT MATCHED THEN
				INSERT (serial, born, life, type, location, memo, log_update, log_update_account, log_update_ip)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
				OUTPUT INSERTED.id;');
				
			$query->set_sql("MERGE INTO tbl_extinguisher
			USING 
				(SELECT ? AS Search_Col) AS SRC
			ON 
				tbl_extinguisher.id = SRC.Search_Col
			WHEN MATCHED THEN
				UPDATE SET
					serial				= ?,
					born				= ?,									
					life				= ?,
					type				= ?,	
					size				= ?,				
					location			= ?,							
					memo				= ?,
					log_update			= ?,
					log_update_account	= ?,
					log_update_ip		= ?
			WHEN NOT MATCHED THEN
				INSERT (serial, born, life, type, size, location, memo, log_update, log_update_account, log_update_ip)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
				OUTPUT INSERTED.id;");
			
			$time = date(DATE_FORMAT);
			
			$born_in = date(DATE_FORMAT, strtotime($post->born));
			$life = $post->life; // * 365;
			
			$query->set_params(array($post->id,
				&$post->serial,
				&$born_in,
				&$life,
				&$post->type,
				&$post->size,
				&$post->location,
				&$post->memo,
				&$time,
				$oAcc->get_account(),
				&$_SERVER['REMOTE_ADDR'],
				&$post->serial,
				&$born_in,
				&$life,
				&$post->type,
				&$post->size,
				&$post->location,
				&$post->memo,
				&$time,
				$oAcc->get_account(),
				&$_SERVER['REMOTE_ADDR']));			
					
			// Execute the upsert query.
			$query->query();
			
			// Create object array from table fields.	
			$ext_details = $query->get_line_object();
		
			// Set get ID variable to returned from upsert.
			$get->id = $ext_details->id;
					
			// Select by ID used to post as normal.
			$query->set_sql('SELECT TOP 1 * FROM dbo.vw_tbl_extinguisher WHERE id = ?');	
			$query->set_params(array(&$get->id));	
	
			// Execute query.
			$query->query();
		}	
		else
		{			
			// No buttons pushed, must be first time page is opened. Select by incoming ID as normal.
			$query->set_sql('SELECT TOP 1 * FROM dbo.vw_tbl_extinguisher WHERE id = ?');	
			$query->set_params(array(&$get->id));	
	
			// Execute query.
			$query->query();
		}
		
		$live_record = $query->get_row_exists();
			
		if($live_record === TRUE)
		{
			// Create object array from table fields.	
			$ext_details = $query->get_line_object();
		
			// Set get ID variable to current ID (accomidates command handling).
			$get->id = $ext_details->id;
		}
	}
	
	// Location markup.
	// Location fieldset.																		
	//$oFrm->forms_fieldset_addition('instructions', 'Select a facility first, then choose primary room or lab.'); 
											
	//$oFrm->forms_select('facility', class_forms::ID_USE_NAME, 'Facility', class_forms::LABEL_USE_ITEM_KEY, $list['Facility'], class_forms::VALUE_DEFAULT_NONE, class_forms::VALUE_CURRENT_NONE, array('element' => 'room_search'));
			
	//$oFrm->forms_select('room', class_forms::ID_USE_NAME, 'Room/Lab', class_forms::LABEL_USE_ITEM_KEY, $list['Room'], class_forms::VALUE_DEFAULT_NONE, class_forms::VALUE_CURRENT_NONE, array('element' => 'quiz_parameters'), class_forms::EVENTS_NONE);									
									 
	//$oFrm->forms_fieldset('fs_location', 'Location');
	
	$oFrm->forms_input('location', class_forms::ID_USE_NAME, 'Location (room bar code):', class_forms::VALUE_DEFAULT_NONE, $ext_details->location, class_forms::CLASSES_NONE, class_forms::EVENTS_NONE, 'required');
	
	// Serial markup.
	$oFrm->forms_input('serial', class_forms::ID_USE_NAME, 'Serial:', class_forms::VALUE_DEFAULT_NONE, $ext_details->serial, class_forms::CLASSES_NONE, class_forms::EVENTS_NONE, 'required');
	
	// Born markup.	
	if($ext_details->born_str)
	{
		$current_date = $ext_details->born_str;
	}
	else
	{
		$current_date = date(DATE_FORMAT);
	}	
		
	$oFrm->forms_time_html5('born', class_forms::ID_USE_NAME, 'Born:', NULL, date('Y-m-01', strtotime($current_date)), 'date');
	
	// Max life markup.
	foreach (range(1, 12) as $max_years)
	{
		// Life is in days, but for simplicity we want visible selection to be in years.
		$max_life[$max_years] = $max_years * 365;
	}
	
	$oFrm->forms_select('life', class_forms::ID_USE_NAME, 'Max Life:', class_forms::LABEL_USE_ITEM_KEY, $max_life, 6*365, $ext_details->life, class_forms::CLASSES_NONE, class_forms::EVENTS_NONE);
	
	//$oFrm->formElement['life'] = '<div id="life_outer_container"><label for="life">Life:</label><input type="number" name="life" min="1" max="12" step="1" value="'.($ext_details->life / 6).'" /></div><!--/life_outer_container-->';

	// Type markup.
	$query->set_sql('SELECT id, memo FROM tbl_extinguisher_type');
	$query->query();	
	
	$type_object = $query->get_line_object_all();
	
	foreach ($type_object as $type)
	{
		$type_array[$type->memo] = $type->id;
	}
	
	$oFrm->forms_select('type', class_forms::ID_USE_NAME, 'Type:', class_forms::LABEL_USE_ITEM_KEY, $type_array, 1, $ext_details->type, class_forms::CLASSES_NONE, class_forms::EVENTS_NONE);	
	
	// Size markup.
	$query->set_sql('SELECT id, memo FROM tbl_extinguisher_size');
	$query->query();
	
	$size_object = $query->get_line_object_all();
	
	foreach ($size_object as $size)
	{
		$size_array[$size->memo] = $size->id;
	}
	
	$oFrm->forms_select('size', class_forms::ID_USE_NAME, 'Size:', class_forms::LABEL_USE_ITEM_KEY, $size_array, 2, $ext_details->size, class_forms::CLASSES_NONE, class_forms::EVENTS_NONE);
		
	// Memo markup
	$oFrm->formElement['memo'] = '<div id="memo_outer_container" class="" style="margin-top:10px;"><label for="memo">Memo:</label><textarea name="memo" id="memo" cols="50" rows="2">'.$ext_details->memo.'</textarea></div><!--/memo_outer_container-->';
	
	// Combine elements into fieldset.														
	$oFrm->forms_fieldset('fs_details', 'Details');
?>
<!DOCtype html>
    <head>
        <title>
        	UK - Environmental Health & Safety, Extinguisher Inspection <?php echo $ext_details->serial; ?>
		</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
        <style>
			#container
			{
				width:auto;
			}
			
			#subContainer
			{
				width:95%;
				padding:10px;
			}
			
			tr:first-child 
			{
				background-color:#0F9;	
			}
		
			img.cmd_inspection
			{
				height:24px;
				width:24px;
			}
			
			img.cmd
			{
				height:24px;
				width:24px;				
			}
		</style>
        
		<script src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script src="//code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
                       
    </head>
    
    <body>
        <div id="container">
            <div id="mainNavigation">
            	<form name="frm_extinguisher_details_nav" id="frm_extinguisher_details_nav" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$get->id; ?>" method="post">         	    </form>
                                                           
                <button name="First" form="frm_extinguisher_details_nav" type="submit" value="first">First</button>
                <button name="Previous" form="frm_extinguisher_details_nav" type="submit" value="previous">Previous</button>
                <button name="Next" form="frm_extinguisher_details_nav" type="submit" value="next">Next</button>
                <button name="Last" form="frm_extinguisher_details_nav" type="submit" value="last">Last</button>
                <button name="New" form="frm_extinguisher_details_nav" type="submit" value="new">New</button>
                <button name="btn_list" form="frm_extinguisher_details_nav" formaction="." type="submit" value="List">List</button>                
            </div>
            <div id="subContainer">
                        
            <?php //include($cLRoot."a_banner_0001.php"); ?>              
                 
                <h1>Extinguisher <?php echo $ext_details->serial; ?></h1>
                <h2><?php echo $ext_details->location_desc; ?></h2>
                                    
                <?php 
                        if($ext_details->born != NULL && $ext_details->life != NULL)
                        { 
                            if($ext_details->remaining <= 0)
                            {
                ?>
                        <p>Life Remaining: <span class="color_red">Expired <?php echo date(DATE_FORMAT, strtotime($ext_details->expire)); ?></span></p>
                <?php
                            }
                            else
                            {
                        
                ?>			
                
                        <p>Life Remaining: <meter low="0.1" optimum="1" value="<?php echo $ext_details->remaining / $ext_details->life; ?>"></meter> <?php echo $ext_details->remaining; ?> days.</p>
                <?php 
                            }
                        } 
                ?>
                
                <form name="frm_extinguisher_details" id="frm_extinguisher_details" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$get->id; ?>" method="post">                    						                    <input type="hidden" name="id" id="id" value="<?php echo $ext_details->id; ?>" />                                            	
                    <?php
                    	// Insert fieldset markups.
                    	echo $oFrm->forms_fieldset_all_get();	
                    ?>
                    
                                                     
                </form> 
                                            
                <button name="btn_save" id="btn_save" form="frm_extinguisher_details" type="submit" value="Save"><img src="../../media/image/icon_save.png" class="cmd" alt="Save" title="Save"><br />Save Extinguisher</button>      
                                   
                <?php
                
                if($live_record !==0)
                {
                    class inpsection_select
                    {
                        public $id = NULL;
                        public $memo = NULL;
                    }                    
                    
                    // Build array of condition select items (fields as objects).
                    $condition_select = new inpsection_select();
                    
                    $query->set_sql('SELECT id, memo FROM tbl_extinguisher_condition');
                    $query->query();
                    
                    $condition_select = $query->get_line_object_all();
                    
                    // Build array of action select items (fields as objects).
                    $action_select = new inpsection_select();
                    
                    $query->set_sql('SELECT id, memo FROM tbl_extinguisher_action');
                    $query->query();
                    
                    $action_select = $query->get_line_object_all();
                    
                    // Query for inspections.						
                    $query->set_sql('SELECT * FROM vw_tbl_extinguisher_inspection WHERE fk_tbl_extinguisher_id = ? ORDER BY time DESC, log_update DESC');
                    $query->set_params(array(&$ext_details->id));
                    
                    $query->query();
                    
                    ?>                                        
                    
                    <form name="frm_inspection" id="frm_inspection" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="hidden" name="inspection_tbl_extinguisher_id" id="inspection_tbl_extinguisher_id" value="<?php echo $ext_details->id ?>">              
					</form>
                    
                    <table id="tbl_inspections" class="tablesorter">
                        <caption>Inspections</caption>
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Action</th>
                                <th>Condition</th>
                                <th>Memo</th>
                                <th>Record</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>                                       
                            </tr>
                        </tfoot>
                        <tbody>
                        	<!--This row always appears; it is for new entries.-->
                            <tr>
                                <td>
                                    <input type="date" name="inspection_time_-1" id="inspection_time_-1" form="frm_inspection" value="<?php echo date('Y-m-d'); ?>" required class="cell_fill">
                                </td>
                                <td>
                                    <select name="inspection_action_-1" id="inspection_action_-1" form="frm_inspection" class="cell_fill">
                                        <?php echo $local_functions->inspection_select_options($action_select, 2); ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="inspection_condition_-1" id="inspection_condition_-1" form="frm_inspection" class="cell_fill">
                                        <?php echo $local_functions->inspection_select_options($condition_select, 2); ?>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="inspection_memo_-1" id="inspection_memo_-1" form="frm_inspection" cols="20" rows="1" class="cell_fill"></textarea>
                                </td>
                                <td>
                                    <button name="inspection_save" id="inspection_save_-1" form="frm_inspection" type="submit" value="-1" title="Save this item.">
                                    	<img src="../../media/image/icon_pencil.png" class="cmd_inspection" alt="" title="">
                                    </button>
                                </td>
                            </tr>
                            
                            <?php
            
                                if($query->get_row_exists() === TRUE)
                                {
                                    $inspection_array = $query->get_line_object_all();						
                                    
                                    // New inspection object.						
                                    $inspection = new inspection();
                                    
                                    foreach($inspection_array as $inspection)
                                    {									
                            ?>
                            <!--This row code is generated once for each record found.-->
                            <tr>               
                                <td>
                                    <input type="date" name="inspection_time_<?php echo $inspection->id; ?>" id="inspection_time_<?php echo $inspection->id; ?>" form="frm_inspection" value="<?php echo date('Y-m-d', strtotime($inspection->time_str)); ?>" required class="cell_fill">
                                </td>
                                <td>
                                    <select name="inspection_action_<?php echo $inspection->id; ?>" id="inspection_action_<?php echo $inspection->id; ?>" form="frm_inspection" class="cell_fill">
                                        <?php echo $local_functions->inspection_select_options($action_select, 2, $inspection->action); ?>
                                    </select>
                                </td>
                                <td>
                                    <select name="inspection_condition_<?php echo $inspection->id; ?>" id="inspection_condition_<?php echo $inspection->id; ?>" form="frm_inspection" class="cell_fill">
                                        <?php echo $local_functions->inspection_select_options($condition_select, 2, $inspection->condition); ?>
                                    </select>
                                </td>
                                <td>
                                    <textarea name="inspection_memo_<?php echo $inspection->id; ?>" id="inspection_memo_<?php echo $inspection->id; ?>" cols="20" rows="1" form="frm_inspection" class="cell_fill"><?php echo $inspection->memo; ?></textarea>                                            </td>
                                <td>
                                    <button name="inspection_save" id="inspection_save_<?php echo $inspection->id; ?>" form="frm_inspection" type="submit" value="<?php echo $inspection->id; ?>" title="Save this item.">
                                    	<img src="../../media/image/icon_save.png" class="cmd_inspection" alt="Save" title="Save">
                                    </button>                                                                      
                                
                                    <button name="inspection_delete" id="inspection_delete_<?php echo $inspection->id; ?>" form="frm_inspection" type="submit" value="<?php echo $inspection->id; ?>" title="Delete this item.">
                                    	<img src="../../media/image/icon_delete.png" class="cmd_inspection" alt="Delete" title="Delete">
                                    </button>
                                </td>
                            </tr>     
                            <?php	
                                    }
                                }
                            ?>
                        </tbody>                                    
                    </table>                                                                                             
                <?php 
                }
                ?>
            </div><!--/subContainer-->
            
            <div id="footer">
                <?php //include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div>
        
        </div><!--/container-->
        
        <div id="footerPad">
        	<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div>
    <script>
			$(document).ready(function() 
				{ 
					$("#tbl_inspections").tablesorter( {sortList: [[0,1]]} ); 
				} 
			);
	
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			  ga('create', 'UA-40196994-1', 'uky.edu');
			  ga('send', 'pageview');

	</script>
</body>
</html>

