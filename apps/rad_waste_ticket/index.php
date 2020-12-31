<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
	
	$cLRoot		= $cDocroot."classes/";
	
	// Verify user is authorized.
	$oAcc->access_verify();	
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
		</style>
    </head>
    
    <body>    
        <div id="container">            
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--#mainNavigation-->            
            <div id="subContainer">                            
				<?php include("../../a_banner.php"); ?>                               
                <div id="subNavigation">                
                    <?php include("../../a_subnav_0001.php"); ?>                     
                </div><!--#subNavigation-->                
                <div id="content">                
                    <h1>Welcome</h1>                      
                    
                    <form name="lab_sign" id="lab_sign" class="lab_sign" action="../lab_sign - Copy/lab_sign_out.php" method="post" target="new">                                    
                        
                        
                        <fieldset>
                        	<legend>Authorized User</legend>
                            
                            <label for="au_name_f">First Name</label>
                        	<input name="pi_name_f" id="au_name_f" value="<?php echo $oAcc->get_name_f(); ?>" />
                            
                            <label for="au_name_l">Last name</label>
                            <input name="au_name_l" id="au_name_l" value="<?php echo $oAcc->get_name_l(); ?>" />
						</fieldset>               
                        
                        <fieldset>
                        	<legend>Role</legend>
                            
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
                                    disabled required>
                                        <!--This option is for valid HTML5; it is overwritten on load.--> 
                                        <option value="1">Select Room/Area/Lab</option>
                                        <!--Options will be populated/replaced on load via jquery.-->
                                        <option value="">Select Room/Area/Lab</option>                                  							
                                </select>                                    
                            </div>                                    	
                        </fieldset>
                        
                        <div class="ec">
                            <!--Emergency contacts are added by script here.-->
                        </div>
                        
                        <span class="legend color_green">
                        	<a href="#" title="Add new after hours contact." id="ec_edit" class="ec_edit cmd_add_ec">
                            	<span class="color_green">Add After Cours Contact</span>
                            </a>
                        </span>
                        
                        <fieldset name="fs_hazards" id="fs_hazards" class=""><legend id="fs_hazards_legend" class="">Hazards</legend>
                        
                        <p>Please indicate all known hazards for this room/laboratory.</p>
                        
                        <!--Yes, I know using tables for layout is stupid. This is only a temp solution.-->
                        <table width="90%" border="0">
                          	<tr>
                                <td width="70%">
                                	<label for="flammables">Flammables<br />
                                                            Self Reactives<br />
                                                            Pyrophorics<br />
                                                            Self-Heating<br />
                                                            Emits Flammable Gas<br />
                                                            Organic Peroxides</label>
                                </td>
                                <td width="30%">
                                    <input name="flammables" id="flamables" type="checkbox" value="<?php echo TRUE; ?>" />
                                </td>
                        	</tr>                    
                        </table> 
                           
                        </fieldset>                                      	
						<button type="Submit" value="Submit" name="Submit" id="frm_button">Create Sign</button>				  
				  </form>
                    
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
    
	<script>
	  var $temp_int = 0;
	  
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
		
			ec_append($temp_int);
		});
		
		function ec_append($temp_int)
		{
			$(".ec").append(
				'<fieldset>'
					+'<legend>'
						+'<a href="#" title="Remove this after hours contact."><span class="color_red cmd_remove_ec">Remove</span></a>'
					+'</legend>'
												
					+'<input type="hidden" name="ec_id[]" id="ec_id_' + $temp_int + '" value="'+ $temp_int +'"/>'
												
					+'<div>'
						+'<label for="ec_name_f_' + $temp_int + '">First:</label>'
						+'<input type="text" placeholder="First Name" name="ec_name_f[]" id="ec_name_f_' + $temp_int + '" />'
					+'</div>'
				
					+'<div>'
						+'<label for="ec_name_l_' + $temp_int + '">Last:</label>'
						+'<input type="text" placeholder="Last Name" name="ec_name_l[]" id="ec_name_l_' + $temp_int + '" />'
					+'</div>'
										
					+'<div>'
						+'<label for="ec_loc_' + $temp_int + '">Location:</label>'
						+'<input type="text" placeholder="Office Location" name="ec_loc[]" id="ec_loc_' + $temp_int + '" />'
					+'</div>'
				
					+'<div>'
						+'<label for="ec_phone_o_' + $temp_int + '">Phone # (Office):</label>'
						+'<input type="tel" placeholder="x-xxx-xxx-xxxx" name="ec_phone_o[]" id="ec_phone_o_' + $temp_int + '" />'
					+'</div>'
	
					+'<div>'
						+'<label for="ec_phone_h_' + $temp_int + '">Phone # (Home/Cell):</label>'
						+'<input type="tel" placeholder="x-xxx-xxx-xxxx" name="ec_phone_h[]" id="ec_phone_h_' + $temp_int + '" />'
					+'</div>'
				+'</fieldset>');
		}
		
		// Add new input with associated 'remove' link when 'add' button is clicked.
		$('.cmd_add_ec').click(function(e) {
			e.preventDefault();			
			ec_append();		
			$temp_id++;		
		});
		
		// Remove parent of 'remove' link when link is clicked.
		$('.ec').on('click', '.cmd_remove_ec', function(e) {
			e.preventDefault();
		
			$(this).parent().parent().parent().remove();
		});

	</script>
</body>
</html>