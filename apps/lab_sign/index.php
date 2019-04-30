<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/database/main.php"); //Basic configuration file.
	
	$cLRoot		= $cDocroot."classes/";
	
	// Common population of lists using common tabel fields (id/label).
	class list_populate
	{
		private
			$db = NULL,
			$query = NULL,
			$result = array(),	// Array of line objects from query result.
			$table	= NULL;		// Name of table to query.
		
		public function __construct($table = NULL)
		{
			$this->table = $table;
			$this->populate();
		}
		
		public function result()
		{
			return $this->result;
		}
		
		private function populate()
		{		
			if($this->table)
			{				
				// Initialize DB connection and query objects.
				$db		= new class_db_connection();		
				$query 	= new class_db_query($db);
				
				// Get type list items.
				$query->set_sql('SELECT id, text FROM '.$this->table.' ORDER BY text');
				$query->query();
				$this->result = $query->get_line_object_all();
			}
		}
	}
	
	
	// Verify user is authorized.
	//$oAcc->access_verify();	

	$bsl = new list_populate('tbl_list_bsl');
	$laser = new list_populate('tbl_list_laser');
	
?>

<!DOCtype html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>UK - Environmental Health And Safety</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" />
		<link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
        <script src="/libraries/javascript/jquery_ui_timepicker_addon.js"></script>
        <script src="/libraries/javascript/options_update.js"></script>    
        
        <style>
			.legend {
				display:			inline-block;
				background-color:	#E1E1FF;
				border:				1px solid;
				border-color:		#000;
				border-radius: 		5px;
				font-size:			90%;
				font-weight:		bold;
				padding-top: 		0.2em;
				padding-bottom:		0.2em;
				padding-left: 		0.5em;
				padding-right: 		0.5em; 	
				text-align:			right;
				margin-top: 		5px;
			}
			
			.cmd_add_ec, .cmd_remove_ec {
				font-size:xx-large;
			}
			
			.haz_icon {
				width:100px;
				height:100px;
			}
		</style>
    </head>
    
    <body>    
        <div id="container">            
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--#mainNavigation-->            
            <div id="subContainer">                            
				<div id="banner_container" class="banner_container">	
                    <div id="banner_content" class="banner">
                        University of Kentucky
                        <h1>Lab Sign</h1>
                        <div id="banner_slogan" class="slogan">
                            UK Safety Begins with You!
                        </div><!--#banner_slogan-->
                    </div><!--#banner_content-->
                </div><!--#banner_container-->                               
                <div id="subNavigation">                
                    <?php include("../../a_subnav_0001.php"); ?>                     
                </div><!--#subNavigation-->                
                <div id="content">                
                    <h3>Build Lab Sign</h3>
                    <p>Fill out the form below, indicate any hazards present in your lab, and press the "Create Sign" button. A <span class="icon_pdf">pdf</span> lab sign will then be sent to your broswer.</p>                      
                    
                    <form name="lab_sign" id="lab_sign" class="lab_sign" action="print.php" method="post" target="_blank">                                    
                        
                        
                        <fieldset name="fs_pi" id="fs_pi">
							<legend>Principal Investigator</legend>
							
							<p>Principal Investigators. Press the <span class="color_green" style="font-weight:bold;">+</span> button to add more investigators. At least one principal investigator is required.</p> 
							
                            <div class="pi">
								<!-- Principal Investigators are added by script here. -->
							</div>
							
							<span class="legend color_green">
                                <a href="#" title="Add a principal investigator." id="pi_edit" class="pi_edit cmd_add_pi">
                                    <img src="/media/image/icon_plus.ico" alt="+" title="Add new item." style="border:none; margin:0px 0px 0px 0px; padding: 0px 0px 0px 0px">
                                </a>
                            </span>
							
						</fieldset>						
                        
						<fieldset name="fs_super" id="fs_super">
							<legend>Lab Supervisor</legend>
							
							<p>Lab supervisors. Press the <span class="color_green" style="font-weight:bold;">+</span> button to add more lab supervisors. At least one lab supervisor is required.</p> 
							
                            <div class="super">
								<!-- Lab supervisors are added by script here. -->
							</div>
							
							<span class="legend color_green">
                                <a href="#" title="Add a lab supervisor." id="super_edit" class="super_edit cmd_add_super">
                                    <img src="/media/image/icon_plus.ico" alt="+" title="Add new item." style="border:none; margin:0px 0px 0px 0px; padding: 0px 0px 0px 0px">
                                </a>
                            </span>
							
						</fieldset>
                        
                        <fieldset>
                        	<legend>Department</legend>
                            
                            	<div>
                                    <p id="department_progress" class="load color_red center">
                                        Loading departments...
                                        <img id="img_department_load_progress" 
                                            src="/media/image/meter_bar.gif" 
                                            alt="Loading items... " 
                                            title="Loading items..." />
                                    </p>
                                    <label for="department">Department</label>
                                    <select name="department" 
                                        id="department" 
                                        data-current="<?php //echo $post->department(); ?>" 
                                        data-source-url="/libraries/inserts/department.php" 
                                        data-extra-options='<option value="">Select Department</option><option value="-1">No UK Affiliation</option>'
                                        data-grouped="0"> 
                                            <!--This option is for valid HTML5; it is overwritten on load.--> 
                                            <option value="0">Select Department</option>                                                                      
                                            <!--Options will be populated on load via jquery.-->								
                                    </select>
                                </div>
                        </fieldset>
    
    					<fieldset>
                            <legend>Location</legend>
                            
                            <p class="instructions">Select a facility first, then choose the area/lab.</p>              
            
                            <div>
                                <p id="facility_progress" class="load color_red center">
                                    Loading facilities...
                                    <img id="img_facility_load_progress" 
                                        src="/media/image/meter_bar.gif" 
                                        alt="Loading items... " 
                                        title="Loading items..." />
                                </p>
                                <label for="facility">Facility</label>
                                <select name="facility" 
                                    id="facility" 
                                    data-current="<?php //echo $post->facility; ?>" 
                                    data-source-url="/libraries/inserts/facility.php" 
                                    data-extra-options='<option value="">Select Facility</option>'
                                    data-grouped="1"
                                    class="room_search">
                                        <!--This option is for valid HTML5; it is overwritten on load.--> 
                                        <option value="0">Select Facility</option>                                    
                                        <!--Options will be populated on load via jquery.-->                                 
                                </select>
                            </div>
                
                            <div>
                                <p id="room_progress" class="load color_red center display_none">
                                    Loading rooms...
                                    <img id="img_room_load_progress" 
                                        src="/media/image/meter_bar.gif" 
                                        alt="Loading items... " 
                                        title="Loading items..." />                               
                                </p>
                                <label for="room">Room</label>
                                <select name="room" 
                                    id="room" 
                                    data-current="<?php //echo $post->room; ?>" 
                                    data-source-url="/libraries/inserts/room.php" 
                                    data-grouped="1" 
                                    data-extra-options='<option value="">Select Room/Area/Lab</option>' 
                                    class="disable" 
                                    disabled>
                                        <!--This option is for valid HTML5; it is overwritten on load.--> 
                                        <option value="1">Select Room/Area/Lab</option>
                                        <!--Options will be populated/replaced on load via jquery.-->
                                        <option value="">Select Room/Area/Lab</option>   
                                                                       							
                                </select>                                    
                            </div>                                    	
                        </fieldset>
                    
                    	<fieldset name="fs_ec" id="fs_ec">
                            <legend>After Hours Contact</legend>
                            
                            <p>After hours contacts for the lab. Press the <span class="color_green" style="font-weight:bold;">+</span> button to add more contacts. At least one contact is required.</p> 
                            
                            <div class="ec">
                                <!--Emergency contacts are added by script here.-->
                            </div>
                            
                            <span class="legend color_green">
                                <a href="#" title="Add new after hours contact." id="ec_edit" class="ec_edit cmd_add_ec">
                                    <img src="/media/image/icon_plus.ico" alt="+" title="Add new item." style="border:none; margin:0px 0px 0px 0px; padding: 0px 0px 0px 0px">
                                </a>
                            </span>
                        </fieldset>
                        
                        <fieldset name="fs_hazards" id="fs_hazards" class=""><legend id="fs_hazards_legend" class="">Hazards</legend>
                        
                        <p>Please indicate all known hazards for this room/laboratory.</p>
                        
                        <!--Yes, I know using tables for layout is stupid. This is only a temp solution.-->
                        <table width="90%" border="0">
                          <tr>
                            <td width="15%"><img src="../../media/image/hazard_flammables .png" class="haz_icon" alt="Flamables"></td>
                            <td width="64%"><label for="flammables">Flammables<br />
                                                        Self Reactives<br />
                                                        Pyrophorics<br />
                                                        Self-Heating<br />
                                                        Emits Flammable Gas<br />
                                                        Organic Peroxides</label>
							</td>
                            <td width="21%">
                                <input name="flammables" id="flamables" type="checkbox" value="<?php echo TRUE; ?>" />
                                </td>
                          </tr>
                          <tr>
                            <td><img src="../../media/image/hazard_oxidizers.png" alt="Oxidizers" width="1017" height="1017" class="haz_icon"></td>
                            <td><label for="oxidizers">Oxidizers</label></td>
                            <td>
                            	<input name="oxidizers" id="oxidizers" type="checkbox" value="<?php echo TRUE; ?>" />
                            </td>
                          </tr>
                          <tr>
                            <td><img src="../../media/image/hazard_explosives.png" alt="Explosives" width="1017" height="1017" class="haz_icon"></td>
                            <td>
                            	<label for="explosives">Explosives<br />
                                                        Self Reactives<br />
                                                        Organic Peroxides 
                                </label>
                            </td>
                            <td>
                            	<input name="explosives" id="explosives" type="checkbox" value="<?php echo TRUE; ?>" />
                            </td>
                          </tr>
                          <tr>
                            <td><img src="../../media/image/hazard_corrosives.png" alt="Corrosives" width="1017" height="1017" class="haz_icon"></td>
                            <td><label for="corrosives">Corrosives</label></td>
                            <td>
                            	<input name="corrosives" id="corrosives" type="checkbox" value="<?php echo TRUE; ?>" />
                            </td>
                          </tr>
                          <tr>
                            <td><img src="../../media/image/hazard_magnetic.png" alt="Strong Magnetic Field" width="281" height="281" class="haz_icon"></td>
                            <td><label for="magnetic">Strong Magnetic Field</label></td>
                            <td>
                            	<input name="magnetic" id="magnetic" type="checkbox" value="<?php echo TRUE; ?>" />
                            </td>
                          </tr>
                          <tr>
                            <td><img src="../../media/image/hazard_carcinogen.png" alt="Carcinogen" width="1017" height="1017" class="haz_icon"></td>
                            <td><label for="carcinogen">Carcinogen<br />
                                                    Respiratory Sensitizer<br />
                                                    Reproductive Toxicity<br />
                                                    Target Organ Toxicity<br />
                                                    Mutagenicity<br />
                                                    Aspiration Toxicity</label>
							</td>
                            <td>
                            	<input name="carcinogen" id="carcinogen" type="checkbox" value="<?php echo TRUE; ?>" />
                            </td>
                          </tr>
                          <tr>
                            <td><img src="../../media/image/hazard_irritant.png" alt="Irritant" width="1017" height="1017" class="haz_icon"></td>
                            <td><label for="irritant">Irritant<br />
                                                        Dermal Sensitizer<br />
                                                        Acute toxicity (harmful)<br />
                                                        Narcotic Effects<br />
                                                        Respiratory Tract<br />
                                                        Irritation </label>
							</td>
                            <td>
                            	<input name="irritant" id="irritant" type="checkbox" value="<?php echo TRUE; ?>" />
                            </td>
                          </tr>
                          <tr>
                            <td><img src="../../media/image/hazard_toxicity.png" alt="Acute Toxicity" width="1017" height="1017" class="haz_icon"></td>
                            <td><label for="toxicity">Acute Toxicity (severe)</label></td>
                            <td>
                            	<input name="toxicity" id="toxicity" type="checkbox" value="<?php echo TRUE; ?>" />
                            </td>
                          </tr>
                          <tr>
                            <td><img src="../../media/image/hazard_pressure.png" alt="Gas Under Pressure" width="1017" height="1017" class="haz_icon"></td>
                            <td><label for="pressure">Gas Under Pressure</label></td>
                            <td>
                            	<input name="pressure" id="pressure" type="checkbox" value="<?php echo TRUE; ?>" />
                            </td>
                          </tr>
                          <tr>
                            <td><img src="../../media/image/hazard_electric.png" alt="Electric" width="360" height="316" class="haz_icon"></td>
                            <td><label for = "electric">Electrical</label></td>
                            <td><input name="electric" id="electric" type="checkbox" value="<?php echo TRUE; ?>" /></td>
                          </tr>
                          <tr>
                            <td><img src="../../media/image/hazard_laser.png" alt="Laser" width="233" height="232" class="haz_icon"></td>
                            <td><label for="laser">Laser (class)</label></td>
                            <td>
                            	<select name="laser" id="laser">
                                	<option value="0">None</option>
                            	<?php 
									foreach($laser->result() as $value) 
									{
								?>
										<option value="<?php echo $value->id; ?>"><?php echo $value->text; ?></option>								
								<?php												
									}
									// Cleanup.
									$value = NULL;
								?>
                            	</select>
                            
                          	</td>
                          </tr>
                          <tr>
                            <td><img src="../../media/image/hazard_radiation.png" alt="Radiation" width="253" height="237" class="haz_icon"></td>
                            <td><label for="radioactive">Radioactive Material</label></td>
                            <td>
                            	<input name="radioactive" id="radioactive" type="checkbox" value="<?php echo TRUE; ?>" />
                            </td>
                          </tr>
                          <tr>
                            <td>No Icon</td>
                            <td><label for="biohazards">Biohazards (Indicate IBC#)</label></td>
                            <td><input name="biohazards" id="biohazards" type="text" /></td>
                          </tr>
                          <tr>
                            <td><img src="../../media/image/hazard_pathogens_human.png" alt="Pathogens (Human)" width="470" height="470" class="haz_icon"></td>
                            <td><label for="pathogens_h">Human pathogens</label></td>
                            <td>
                            	<input name="pathogens_h" id="pathogens_h" type="checkbox" value="<?php echo TRUE; ?>" />
                            </td>
                          </tr>
                          <tr>
                            <td><img src="../../media/image/hazard_plant_transgenic.png" alt="Tansgenic Plants" width="150" height="150" class="haz_icon"></td>
                            <td><label for="transgenic_p">Transgenic Plants</label></td>
                            <td><input name="transgenic_p" id="transgenic_p" type="checkbox" value="<?php echo TRUE; ?>" /></td>
                          </tr>
                          
                          <tr>
                            <td><img src="../../media/image/hazard_pathogens_plant.png" alt="Pathogens (Plant)" width="150" height="145" class="haz_icon"></td>
                            <td><label for="pathogens_p">Plant Pathogens</label></td>
                            <td><input name="pathogens_p" id="pathogens_p" type="checkbox" value="<?php echo TRUE; ?>" /></td>
                          </tr>
                          
                          <tr>
                            <td><img src="../../media/image/hazard_viral_vectors.png" alt="Viral Vectors" width="139" height="150" class="haz_icon"></td>
                            <td><label for="vectors_v">Viral vectors</label></td>
                            <td>
                            	<input name="vectors_v" id="vectors_v" type="checkbox" value="<?php echo TRUE; ?>" />
                            </td>
                          </tr>
                          
                          <tr>
                            <td><img src="../../media/image/hazard_bio.png" alt="Biohazard" width="125" height="150" class="haz_icon"></td>
                            <td><label for="bsl">BSL</label></td>
                            <td>
                            	<select name="bsl" id="bsl">
                                	<option value="0">None</option>
                            	<?php 
									foreach($bsl->result() as $value) 
									{
								?>
										<option value="<?php echo $value->id; ?>"><?php echo $value->text; ?></option>								
								<?php												
									}
								?>
                            	</select>
                            </td>
                          </tr> 
                          
                          <tr>
                            <td><img src="../../media/image/hazard_caution.png" alt="Special Procedures" width="211" height="187" class="haz_icon"></td>
                            <td><label for="special">Special procedures (entry/exit)</label></td>
                            <td><textarea name="special" id="special" cols="20" rows=""></textarea></td>
                          </tr>                         
                          
                        </table> 
                           
                        </fieldset>                                      	
						<button type="Submit" value="Submit" name="Submit" id="frm_button"><span class="icon_pdf">Create Sign</span></button>				  
				  </form>
                  <br>
                    
              	</div><!--#content-->                      
            </div><!--#subContainer-->
            
            <div id="sidePanel">
                <?php include($cDocroot."a_sidepanel_0001.php"); ?>		
            </div><!--#sidePanel-->
            
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--#footer-->
        </div><!--#container-->
        
        <div id="footerPad">
        	<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--#footerPad-->
    
	<script src="source/javascript/dc_guid.js"></script>
	<script>	  
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-40196994-1', 'uky.edu');
	  ga('send', 'pageview');

		$('.room_search').change(function(event)
		{	
			options_update(event, null, '#room');	
		});

		$(document).ready(function(event) {
			options_update(event, null, '#department');	
			options_update(event, null, '#facility');							
		
			pi_append();
			super_append();
			ec_append();
		});
		
		function pi_append()
		{
			var $temp_guid = dc_guid(); 
			
			$(".pi").append(
				'<fieldset>'
					+'<legend>'
						+'<a href="#" title="Remove this item." class="pi_edit cmd_remove_pi"><img src="/media/image/icon_minus.ico" alt="-" title="Remove this item." style="border:none; margin:0px 0px 0px 0px; padding: 0px 0px 0px 0px"></a>'
					+'</legend>'
												
					+'<input type="hidden" name="pi_id[]" id="pi_id_' + $temp_guid + '" value="'+ $temp_guid +'"/>'
												
					+'<div>'
						+'<label for="pi_name_f_' + $temp_guid + '">First:</label>'
						+'<input type="text" placeholder="PI First Name" name="pi_name_f[]" id="pi_name_f_' + $temp_guid + '" />'
						
						+'<label for="pi_name_l_' + $temp_guid + '">Last:</label>'
						+'<input type="text" placeholder="PI Last Name" name="pi_name_l[]" id="pi_name_l_' + $temp_guid + '" />'
				
					+'</div>'			
				+'</fieldset>');
		}
		
		// Add new input with associated 'remove' link when 'add' button is clicked.
		$('.cmd_add_pi').click(function(e) {
			
			alert('test');
			
			e.preventDefault();			
			pi_append();
		});
		
		// Remove parent of 'remove' link when link is clicked.
		$('.pi').on('click', '.cmd_remove_pi', function(e) {
			e.preventDefault();
		
			$(this).parent().parent().remove();
		});
		
		//  Lab Supervisor
		function super_append()
		{
			var $temp_guid = dc_guid(); 
			
			$(".super").append(
				'<fieldset>'
					+'<legend>'
						+'<a href="#" title="Remove this item." class="pi_edit cmd_remove_super"><img src="/media/image/icon_minus.ico" alt="-" title="Remove this item." style="border:none; margin:0px 0px 0px 0px; padding: 0px 0px 0px 0px"></a>'
					+'</legend>'
												
					+'<input type="hidden" name="super_id[]" id="super_id_' + $temp_guid + '" value="'+ $temp_guid +'"/>'
												
					+'<div>'
						+'<label for="super_name_f_' + $temp_guid + '">First:</label>'
						+'<input type="text" placeholder="Supervisor First Name" name="super_name_f[]" id="super_name_f_' + $temp_guid + '" />'
						
						+'<label for="super_name_l_' + $temp_guid + '">Last:</label>'
						+'<input type="text" placeholder="Supervisor Last Name" name="super_name_l[]" id="super_name_l_' + $temp_guid + '" />'
				
					+'</div>'			
				+'</fieldset>');
		}
		
		// Add new input with associated 'remove' link when 'add' button is clicked.
		$('.cmd_add_super').click(function(e) {
			
			e.preventDefault();			
			super_append();
		});
		
		// Remove parent of 'remove' link when link is clicked.
		$('.super').on('click', '.cmd_remove_super', function(e) {
			e.preventDefault();
		
			$(this).parent().parent().remove();
		});
		
		// Emergency contact
		function ec_append()
		{
			var $temp_guid = dc_guid();
			
			$(".ec").append(
				'<fieldset>'
					+'<legend>'
						+'<a href="#" title="Remove this item." class="ec_edit cmd_remove_ec"><img src="/media/image/icon_minus.ico" alt="-" title="Remove this item." style="border:none; margin:0px 0px 0px 0px; padding: 0px 0px 0px 0px"></a>'
					+'</legend>'
												
					+'<input type="hidden" name="ec_id[]" id="ec_id_' + $temp_guid + '" value="'+ $temp_guid +'"/>'
												
					+'<div>'
						+'<label for="ec_name_f_' + $temp_guid + '">First:</label>'
						+'<input type="text" placeholder="First Name" name="ec_name_f[]" id="ec_name_f_' + $temp_guid + '" />'
					+'</div>'
				
					+'<div>'
						+'<label for="ec_name_l_' + $temp_guid + '">Last:</label>'
						+'<input type="text" placeholder="Last Name" name="ec_name_l[]" id="ec_name_l_' + $temp_guid + '" />'
					+'</div>'
										
					+'<div>'
						+'<label for="ec_loc_' + $temp_guid + '">Location:</label>'
						+'<input type="text" placeholder="Office Location" name="ec_loc[]" id="ec_loc_' + $temp_guid + '" />'
					+'</div>'
				
					+'<div>'
						+'<label for="ec_phone_o_' + $temp_guid + '">Phone # (Office):</label>'
						+'<input type="tel" placeholder="x-xxx-xxx-xxxx" name="ec_phone_o[]" id="ec_phone_o_' + $temp_guid + '" />'
					+'</div>'
	
					+'<div>'
						+'<label for="ec_phone_h_' + $temp_guid + '">Phone # (Home/Cell):</label>'
						+'<input type="tel" placeholder="x-xxx-xxx-xxxx" name="ec_phone_h[]" id="ec_phone_h_' + $temp_guid + '" />'
					+'</div>'
				+'</fieldset>');
		}
		
		// Add new input with associated 'remove' link when 'add' button is clicked.
		$('.cmd_add_ec').click(function(e) {
			e.preventDefault();			
			ec_append();
		});
		
		// Remove parent of 'remove' link when link is clicked.
		$('.ec').on('click', '.cmd_remove_ec', function(e) {
			e.preventDefault();
		
			$(this).parent().parent().remove();
		});

	</script>
</body>
</html>