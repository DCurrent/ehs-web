<!--Include: <?php echo __FILE__ . ", Last update: " . date(DATE_ATOM,filemtime(__FILE__)); ?>-->

		<?php require __DIR__.'/form_common_location_model.php'; ?>

        <div class="form-group">       
            <label class="control-label col-sm-2" for="last_update">Last Update:</label>
            <div class="col-sm-10">
                <p class="form-control-static"> <a href = "log_list.php&#63;id=<?php echo $_main_data->get_id();  ?>"
                                                    data-toggle	= ""
                                                    title		= "View log for this record."
                                                     target		= "_new" 
                    ><?php if(is_object($_main_data->get_log_update())) echo date(APPLICATION_SETTINGS::TIME_FORMAT, $_main_data->get_log_update()->getTimestamp()); ?></a></p>
            </div>
        </div>
        
        <?php 
        
            $building_code_display = NULL;
            
            if($_main_data->get_building_code())
            {
                $building_code_display = trim($_main_data->get_room_id()).', '. $_main_data->get_building_code().' - '.$_main_data->get_building_name(); 
            }
        
        ?>
        
        <!-- Location display. -->
        <div class="form-group">
            <label class="control-label col-sm-2" for="building">Location:</label>
            <div class="col-sm-10">
                <p class="form-control-static"><a href 		= "area.php&#63;id=<?php echo $_main_data->get_room_code();  ?>"
                    
                    data-toggle	= ""
                    title		= "View location detail."
                    target		= "_new" 
                    ><?php echo trim($building_code_display); ?></a></p>          
            </div>
            
            
        </div>
                
        <!-- Parties -->
        <div class="form-group">                    	
            <div class="col-sm-offset-2 col-sm-10">
                <fieldset>
                    <legend>Party Review</legend>                                
                    <table class="table table-striped table-hover" id="tbl_sub_party"> 
                        <thead>
                            <tr>
                                <th>Party</th>
                                <th></th>                            
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody id="tbody_party" class="parties">                        
                            <?php                              
                            if(is_object($_obj_data_sub_party_list) === TRUE)
                            {        
                                // Generate table row for each item in list.
                                for($_obj_data_sub_party_list->rewind(); $_obj_data_sub_party_list->valid(); $_obj_data_sub_party_list->next())
                                {						
                                    $_obj_data_sub_party = $_obj_data_sub_party_list->current();
                                
                                    // Blank IDs will cause a database error, so make sure there is a
                                    // usable one here.
                                    if(!$_obj_data_sub_party->get_id()) $_obj_data_sub_party->set_id(DB_DEFAULTS::NEW_ID);
                                    
                                ?>
                                    <tr>
                                        <td>     
                                            <!--Party: <?php echo $_obj_data_sub_party->get_party(); ?>-->
                                                                                                    
                                            <select
                                                name 	= "sub_party_party[]"
                                                id		= "sub_party_party_<?php echo $_obj_data_sub_party->get_id(); ?>"
                                                class	= "form-control">
                                                <?php																
                                                if(is_object($_obj_field_source_account_list) === TRUE)
                                                {        
                                                    // Generate table row for each item in list.
                                                    for($_obj_field_source_account_list->rewind();	$_obj_field_source_account_list->valid(); $_obj_field_source_account_list->next())
                                                    {	                                                               
                                                        $_obj_field_source_account = $_obj_field_source_account_list->current();
                                                        
                                                        $sub_account_value 		= $_obj_field_source_account->get_id();																
                                                        $sub_account_label		= $_obj_field_source_account->get_name_l().', '.$_obj_field_source_account->get_name_f();
                                                        $sub_account_selected 	= NULL;
                                                                
                                                        if($_obj_data_sub_party->get_party())
                                                        {
                                                            if($_obj_data_sub_party->get_party() == $sub_account_value)
                                                            {
                                                                $sub_account_selected = ' selected ';
                                                            }								
                                                        }                                                                        
                                                        
                                                        ?>
                                                        <option value="<?php echo $sub_account_value; ?>" <?php echo $sub_account_selected ?>><?php echo $sub_account_label; ?></option>
                                                        <?php                                
                                                    }
                                                }
                                            ?>
                                            </select>
                                        </td>
                                                                               
                                        <td>													
                                            <input 
                                                type	="hidden" 
                                                name	="sub_party_id[]" 
                                                id		="sub_party_id_<?php echo $_obj_data_sub_party->get_id(); ?>" 
                                                value	="<?php echo $_obj_data_sub_party->get_id(); ?>" />
                                        </td>       
                                        <td>
                                            <button 
                                                type	="button" 
                                                class 	="btn btn-danger btn-sm" 
                                                name	="sub_party_row_del" 
                                                id		="sub_party_row_del_<?php echo $_obj_data_sub_party->get_id(); ?>" 
                                                onclick="deleteRow_sub_party(this)"><span class="glyphicon glyphicon-minus"></span></button>        
                                        </td>
                                    </tr>                                    
                            <?php
                                }
                            }
                            ?>                        
                        </tbody>                        
                    </table>                            
                    
                    <button 
                        type	="button" 
                        class 	="btn btn-success" 
                        name	="row_add" 
                        id		="row_add_party"
                        title	="Add new item."
                        onclick	="insRow_party()">
                        <span class="glyphicon glyphicon-plus"></span></button>
                </fieldset>
            </div>                        
        </div>
        <!--/Parties-->
        
        <!--Visits-->
        <div class="form-group">                    	
            <div class="col-sm-offset-2 col-sm-10">
                <fieldset>
                    <legend>Events</legend>                                
                    <table class="table table-striped table-hover" id="tbl_sub_visit"> 
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>By</th>  
                                <th>Time</th>
                                <th></th>                            
                            </tr>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody id="tbody_visit" class="visit">                        
                            <?php                              
                            if(is_object($_obj_data_sub_visit_list) === TRUE)
                            {        
                                // Generate table row for each item in list.
                                for($_obj_data_sub_visit_list->rewind(); $_obj_data_sub_visit_list->valid(); $_obj_data_sub_visit_list->next())
                                {						
                                    $_obj_data_sub_visit = $_obj_data_sub_visit_list->current();
                                
                                    // Blank IDs will cause a database error, so make sure there is a
                                    // usable one here.
                                    if(!$_obj_data_sub_visit->get_id()) $_obj_data_sub_visit->set_id(DB_DEFAULTS::NEW_ID);
                                    
                                ?>
                                    <tr>
                                        <td>
                                            <!--Visit Type: <?php echo $_obj_data_sub_visit->get_visit_type(); ?>-->
                                            <select
                                                name 	= "sub_visit_type[]"
                                                id		= "sub_visit_type_<?php echo $_obj_data_sub_visit->get_id(); ?>"
                                                class	= "form-control">
                                                <?php
                                                if(is_object($_obj_data_list_event_type_list) === TRUE)
                                                {        
                                                    // Generate table row for each item in list.
                                                    for($_obj_data_list_event_type_list->rewind();	$_obj_data_list_event_type_list->valid(); $_obj_data_list_event_type_list->next())
                                                    {	                                                               
                                                        $_obj_data_list_event_type = $_obj_data_list_event_type_list->current();
                                                       
                                                        $sub_visit_type_selected = NULL;         
                                                       
                                                        if($_obj_data_sub_visit->get_visit_type() == $_obj_data_list_event_type->get_id())
                                                        {
                                                            $sub_visit_type_selected = ' selected ';
                                                        }								
                                                        
                                                        
                                                        ?>
                                                        <option value="<?php echo $_obj_data_list_event_type->get_id(); ?>" <?php echo $sub_visit_type_selected ?>><?php echo $_obj_data_list_event_type->get_label(); ?></option>
                                                        <?php                                
                                                    }
                                                }
                                            ?>
                                            </select>
                                            
                                        </td>  
                                        
                                        <td>     
                                            <!--Visit By: <?php echo $_obj_data_sub_visit->get_visit_by(); ?>-->                                           
                                            <select
                                                name 	= "sub_visit_by[]"
                                                id		= "sub_visit_by_<?php echo $_obj_data_sub_visit->get_id(); ?>"
                                                class	= "form-control">
                                                <?php																
                                                if(is_object($_obj_field_source_account_list) === TRUE)
                                                {        
                                                    // Generate table row for each item in list.
                                                    for($_obj_field_source_account_list->rewind();	$_obj_field_source_account_list->valid(); $_obj_field_source_account_list->next())
                                                    {	                                                               
                                                        $_obj_field_source_account = $_obj_field_source_account_list->current();
                                                        
                                                        $sub_account_value 		= $_obj_field_source_account->get_id();																
                                                        $sub_account_label		= $_obj_field_source_account->get_name_l().', '.$_obj_field_source_account->get_name_f();
                                                        $sub_account_selected 	= NULL;
                                                                
                                                        if($_obj_data_sub_visit->get_visit_by())
                                                        {
                                                            if($_obj_data_sub_visit->get_visit_by() == $sub_account_value)
                                                            {
                                                                $sub_account_selected = ' selected ';
                                                            }								
                                                        }
                                                        else
                                                        {
                                                            if($_obj_field_source_account->get_account() == $access_obj->get_account())
                                                            {
                                                                $sub_account_selected = ' selected ';
                                                            }
                                                        }
                                                        
                                                        ?>
                                                        <option value="<?php echo $sub_account_value; ?>" <?php echo $sub_account_selected ?>><?php echo $sub_account_label; ?></option>
                                                        <?php                                
                                                    }
                                                }
                                            ?>
                                            </select>
                                        </td>
                                        
                                        <td>                                                    	
                                            <input 	type="text"                                                        	 
                                                name	="sub_visit_time_recorded[]" 
                                                id		="sub_visit_time_recorded_<?php echo $_obj_data_sub_visit->get_id(); ?>" 
                                                class	="form-control"
                                                value 	= "<?php if($_obj_data_sub_visit->get_time_recorded()) echo date(APPLICATION_SETTINGS::TIME_FORMAT, $_obj_data_sub_visit->get_time_recorded()->getTimestamp()); ?>">
                                        </td>
                                                                                      
                                        <td>													
                                            <input 
                                                type	="hidden" 
                                                name	="sub_visit_id[]" 
                                                id		="sub_visit_id_<?php echo $_obj_data_sub_visit->get_id(); ?>" 
                                                value	="<?php echo $_obj_data_sub_visit->get_id(); ?>" />
                                        </td>       
                                        <td>
                                            <button 
                                                type	="button" 
                                                class 	="btn btn-danger btn-sm" 
                                                name	="sub_visit_row_del" 
                                                id		="sub_visit_row_del_<?php echo $_obj_data_sub_visit->get_id(); ?>" 
                                                onclick="deleteRow_sub_visit(this)"><span class="glyphicon glyphicon-minus"></span></button>        
                                        </td>
                                    </tr>                                    
                            <?php
                                }
                            }
                            ?>                        
                        </tbody>                        
                    </table>                            
                    
                    <button 
                        type	="button" 
                        class 	="btn btn-success" 
                        name	="row_add" 
                        id		="row_add_perm"
                        title	="Add new item."
                        onclick	="insRow_visit()">
                        <span class="glyphicon glyphicon-plus"></span></button>
                </fieldset>
            </div>                        
        </div>
        <!--/Visits-->
                                        
        <!--<div class="form-group">
            <label class="control-label col-sm-2" for="name">Label:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control"  name="label" id="label" placeholder="Inspection Title" value="<?php echo $_main_data->get_label(); ?>">
            </div>
        </div>-->
        
        <div class="form-group">
            <label class="control-label col-sm-2" for="status">Status:</label>
            <!--Status Value: <?php echo $_main_data->get_status(); ?>-->
            
            <div class="col-sm-10">                        
                <?php
                    if(is_object($_obj_data_list_status_list) === TRUE)
                    {
                        for($_obj_data_list_status_list->rewind(); $_obj_data_list_status_list->valid(); $_obj_data_list_status_list->next())
                        {						
                            $_obj_data_list_status = $_obj_data_list_status_list->current();
                            
                            $selected = NULL;
                            
                            if($_obj_data_list_status->get_id() == $_main_data->get_status())
                            {
                                $selected = ' checked ';
                            }
                            ?>
                                <div class="radio">                                      	
                                    <label class="radio">
                                        <input 
                                            type	="radio" 
                                            name	="status" 
                                            id		="status_<?php echo $_obj_data_list_status->get_id(); ?>"
                                            value	="<?php echo $_obj_data_list_status->get_id(); ?>" <?php echo $selected;?> 
                                            required><?php echo $_obj_data_list_status->get_label(); ?>
                                    </label> 
                                </div>                                                   
                            <?php										
                        }
                    }
                   ?> 
            </div>
        </div>
        
        <!-- Room code entry -->                    
        <div class="form-group">
            <label class="control-label col-sm-2" for="room_code">Room Code:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control"  name="room_code" id="room_code" placeholder="Room code" value="<?php echo $_main_data->get_room_code(); ?>">
            </div>
            
            <div class="col-sm-1">
                <a href="#"
                    class		="btn-sm btn-info btn-responsive building_search" 
                    data-toggle	="modal"
                    title		="Find a room barcode."
                    
                    ><span class="glyphicon glyphicon-search"></span></a>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-2" for="details">Notes:</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="5" name="details" id="details"><?php echo $_main_data->get_details(); ?></textarea>
            </div>
        </div>
 
 <script src="../../libraries/javascript/options_update.js"></script>
 
 <script>
 
 	$(document).ready(function(event) {		
				
				
				options_update(event, null, '#facility');
					
			});
 
 	// Room search and add.
	$('.facility_filter').change(function(event)
	{
		options_update(event, null, '#facility');	
	});
 
 	// Room search and add.
	$('.room_search').change(function(event)
	{
		options_update(event, null, '#area');	
	});
  
	$(".building_search").click(function(event){
			
		// Need to populate the model with building drop down.
		//options_update(event, null, '#facility');
		
		//options_update(event, null, '#building_code');
		options_update(event, null, '#area');
		
		$(".modal_building_search").modal();
	});
		
	$('.room_code_insert').click((function() {
	
		$('input[name="room_code"]').val($('.room_code_search').val());
	
	}));
 
 	// Party add/remove.
 	var $temp_id_party = 0;	// Temp id for new party rows.
 
 	// Remove a party row.
 	function deleteRow_sub_party(row)
	{
		var i=row.parentNode.parentNode.rowIndex;
		document.getElementById('tbl_sub_party').deleteRow(i);
	}
 
 	// Inserts a new party row.
	function insRow_party()
	{			
		$('.parties').append(
			'<tr>'
				+'<td>'
					+'<select '
						+'name 	= "sub_party_party[]" '
						+'id	= "sub_party_party_'+$temp_id_party+'" '
						+'class	= "form-control">'
						+'<option value="" selected>Select Party</option> '
						<?php																
						if(is_object($_obj_field_source_account_list) === TRUE)
						{        
							// Generate table row for each item in list.
							for($_obj_field_source_account_list->rewind();	$_obj_field_source_account_list->valid(); $_obj_field_source_account_list->next())
							{	                                                               
								$_obj_field_source_account = $_obj_field_source_account_list->current();
																								
								$sub_account_label		= $_obj_field_source_account->get_name_l().', '.$_obj_field_source_account->get_name_f();
								
								?>
								+'<option value="<?php echo $_obj_field_source_account->get_id(); ?>"><?php echo $sub_account_label; ?></option>'
								<?php                                
							}
						}
					?>
					+'</select>'												
				+'</td>'  
				
				+'<td>'													
					+'<input ' 
						+'type	="hidden" ' 
						+'name	="sub_party_id[]" ' 
						+'id	="sub_party_id_'+$temp_id_party+'" ' 
						+'value	="<?php echo DB_DEFAULTS::NEW_GUID; ?>" />'
				+'</td>'       
				+'<td>'
					+'<button ' 
						+'type	="button" ' 
						+'class ="btn btn-danger btn-sm" ' 
						+'name	="sub_party_row_del" ' 
						+'id	="sub_party_row_del_'+$temp_id_party+'" ' 
						+'onclick="deleteRow_sub_party(this)"><span class="glyphicon glyphicon-minus"></span></button>'        
				+'</td>'
			+'</tr>'
		
		);
			
			$temp_id_party--;
	}
	
	// Visit add/remove
	
	var $temp_id_visit = 0;
	
	function deleteRow_sub_visit(row)
	{
		var i=row.parentNode.parentNode.rowIndex;
		document.getElementById('tbl_sub_visit').deleteRow(i);
	}
	
	function insRow_visit()
	{			
		$('.visit').append(
			'<tr>'
				+'<td>'
					+'<select '
						+'name 	= "sub_visit_type[]" '
						+'id	= "sub_visit_type_'+$temp_id_visit+'" '
						+'class	= "form-control"> '
						+'<option value="" selected>Select Type</option> '							
						<?php
							if(is_object($_obj_data_list_event_type_list) === TRUE)
							{        
								// Generate table row for each item in list.
								for($_obj_data_list_event_type_list->rewind();	$_obj_data_list_event_type_list->valid(); $_obj_data_list_event_type_list->next())
								{	                                                               
									$_obj_data_list_event_type = $_obj_data_list_event_type_list->current();
									
									?>
									+'<option value="<?php echo $_obj_data_list_event_type->get_id(); ?>" ><?php echo $_obj_data_list_event_type->get_label(); ?></option>'
									<?php                                
								}
							}
						?>
						
					+'</select>'						
				+'</td>'  
				
				+'<td>'			                                          
					+'<select '
						+'name 	= "sub_visit_by[]" '
						+'id	= "sub_visit_by_'+$temp_id_visit+'" '
						+'class	= "form-control">'							
						<?php																
						if(is_object($_obj_field_source_account_list) === TRUE)
						{        
							// Generate table row for each item in list.
							for($_obj_field_source_account_list->rewind();	$_obj_field_source_account_list->valid(); $_obj_field_source_account_list->next())
							{	                                                               
								$_obj_field_source_account = $_obj_field_source_account_list->current();
								
								$sub_account_value 		= $_obj_field_source_account->get_id();																
								$sub_account_label		= $_obj_field_source_account->get_name_l().', '.$_obj_field_source_account->get_name_f();
								$sub_account_selected 	= NULL;
								
								if($_obj_field_source_account->get_account() == $access_obj->get_account())
								{
									$sub_account_selected = ' selected ';
								}									
								
								?>
								+'<option value="<?php echo $sub_account_value; ?>" <?php echo $sub_account_selected ?>><?php echo $sub_account_label; ?></option>'
								<?php                                
							}
						}
					?>
					+'</select>'
				+'</td>'
				
				+'<td>'                                                    	
					+'<input 	type="text" '                                                        	 
						+'name	= "sub_visit_time_recorded[]" ' 
						+'id	= "sub_visit_time_recorded_'+$temp_id_visit+'" ' 
						+'class	= "form-control" '
						+'value = "<?php echo date(APPLICATION_SETTINGS::TIME_FORMAT); ?>">'
				+'</td>'
															  
				+'<td>'													
					+'<input ' 
						+'type	="hidden" ' 
						+'name	="sub_visit_id[]" ' 
						+'id	="sub_visit_id_'+$temp_id_visit+'" ' 
						+'value	="<?php echo DB_DEFAULTS::NEW_GUID; ?>" />'
				+'</td>'
						
				+'<td>'
					+'<button ' 
						+'type	="button" ' 
						+'class ="btn btn-danger btn-sm" ' 
						+'name	="sub_visit_row_del" ' 
						+'id	="sub_visit_row_del_'+$temp_id_visit+'" ' 
						+'onclick="deleteRow_sub_visit(this)"><span class="glyphicon glyphicon-minus"></span></button>'        
				+'</td>'
			+'</tr>'
		
		);
		
		$temp_id_visit--;
	}
</script>
<!--/Include: <?php echo __FILE__; ?>-->