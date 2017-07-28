<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
	require('../../../../libraries/php/classes/database/main.php'); 	// Database class.
	
	abstract class DEFAULTS
	{
		const STATUS = 4; // Default status (4 = Staff).
	}
	
	$db					= NULL;	// Database connection object.
	$query				= NULL;	// Query object.
	$status_line_all	= NULL; // Array of status line objects.
	$status_line		= NULL;	// Status objects.
	
	// User authorization	
	$oAcc->access_verify();
	
	// Initialize DB connection and query objects.
	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);
	
	// Query for status list (Staff, Faculty, etc.).	
	$query->set_sql('SELECT id, status FROM tbl_UK_status');
	$query->query();
	$status_line_all = $query->get_line_object_all();
	
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../../../../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../../../../libraries/css/print.css" type="text/css" media="print" />
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
        <script src="../../../../libraries/javascript/jquery_ui_timepicker_addon.js"></script>
        <script src="../../../../libraries/javascript/options_update.js"></script>
        
        <style>
			.load_progress
			{
				text-align:center;
			}
		</style>
    </head>
    
    <body>
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div>
            <div id="subContainer">
                <?php include($cDocroot."a_banner_0001.php"); ?>
                <div id="subNavigation">
                    <?php include($cDocroot."a_subnav_0001.php"); ?> 
                </div><!--/subNavigation-->
                <div id="content">
                	<h1>Manual Entry</h1>                 	
                  
                  	<form name="entry" id="entry" class="entry NoPrint" action="post.php" target="_new" method="post">
        
        				<fieldset>
                        	<legend>Traning</legend>
                        	<div>
                        		<label for="taken">Taken</label>
                            	<input type="date" name="taken" id="taken" value="<?php date('Y-m-d'); ?>" class="date_entry" placeholder="yyyy-mm-dd hh:mm:ss" readonly />
                        	</div>
                            
                            <div>
                                <p id="class_progress" class="load color_red center">
                                    Loading classes...
                                    <img id="img_class_load_progress" 
                                        src="/media/image/meter_bar.gif" 
                                        alt="Loading items... " 
                                        title="Loading items..." />
                                </p>
                                <label for="class">Class</label>
                                <select name="class" 
                                	id="class" 
                                    data-current="" 
                                    data-source-url="/libraries/inserts/class.php" 
                                    data-extra-options='<option value="">Select class</option>'>                                                                       
                                   		<!--Options will be populated on load via jquery.-->								
                            	</select>
                            </div>
                            
                            <div>
                                <p id="trainer_progress" class="load color_red center">
                                    Loading trainers...
                                    <img id="img_trainer_load_progress" 
                                        src="/media/image/meter_bar.gif" 
                                        alt="Loading items... " 
                                        title="Loading items..." />
                                </p>
                                <label for="trainer">Trainer</label>
                                <select name="trainer" 
                                	id="trainer" 
                                    data-current="" 
                                    data-source-url="/libraries/inserts/trainer.php" 
                                    data-extra-options='<option value="">Select trainer</option><option value="0">Online Class</option>'
                                    data-grouped="1" >                                                                       
                                   		<!--Options will be populated on load via jquery.-->								
                            	</select>
                            </div>     
                        </fieldset>
        
        				<fieldset id="role">
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
                                    data-current="<?php //echo $details_line->department; ?>" 
                                    data-source-url="/libraries/inserts/department.php" 
                                    data-extra-options='<option value="">Select Department</option>'
                                    data-grouped="1" >                                                                       
                                   		<!--Options will be populated on load via jquery.-->								
                            	</select>
                        	</div>
                            
                            <div>                                  
                                <span class="label">Status</span>
                                <div class="fieldset_box">   
                                    
                                    <input type="radio" name="status" id="status_0" value="0" required <?php //if(!$details_line->status) echo 'checked'; ?> />
                                    <label for="status_0">Unknown</label>
                                                                                    
                                    <?php								
                                        // Create a radio button for each UK status possibility, and marked it checked if its value matches main details status.
                                        foreach($status_line_all as $status_line)
                                        {										
                                            echo '<span style="white-space:nowrap;"><input type="radio" name="status" id="status_'.$status_line->id.'" value="'.$status_line->id.'" required';
                                            if($status_line->id === DEFAULTS::STATUS) echo ' checked';
                                            echo '/>'.PHP_EOL.'<label for="status_'.$status_line->id.'">'.$status_line->status.'</label></span>'.PHP_EOL;										
                                        }
                                    ?>                              
                                </div>
                            </div>
                        </fieldset>
        
                        <fieldset name="fs_location" id="fs_location" class="">
                            <legend id="fs_location_legend" class="">Location</legend>  
                            
                            <p class="instructions">Select a facility first, then choose your primary room, lab or area.</p>              
                
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
                                    data-current="<?php //echo $details_line->department; ?>" 
                                    data-source-url="/libraries/inserts/facility.php" 
                                    data-extra-options='<option value="">Select Facility</option>'
                                    data-grouped="1"
                                    class="room_search">                                    
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
                                    data-current="<?php //echo $details_line->department; ?>" 
                                    data-source-url="/libraries/inserts/room.php" 
                                    data-grouped="1" 
                                    data-extra-options='<option value="">Select Room/Area/Lab</option><option value="-3">Unavailable</option>' 
                                    class="disable" 
                                    disabled
                                    required>                                    
                                        <!--Options will be populated/replaced on load via jquery.-->
                                        <option value="">Select Room/Area/Lab</option>                                  							
                                </select>
                        	</div>                                    	
                        </fieldset>
                        
                        <fieldset name="fs_supervisor" id="fs_supervisor" class="">
                            <legend id="fs_supervisor_legend" class="">Supervisor</legend>
                            
                            <label for="supervisor_name_f">First Name</label>
                            <input name="supervisor_name_f" 	
                            	id="supervisor_namef" 
                                placeholder="First Name" />
                                
                            <label for="supervisor_name_l">Last Name</label>
                            <input name="supervisor_name_l" 	
                            	id="supervisor_name_l" 
                                placeholder="Last Name" />   
                        </fieldset>
                        
                        <fieldset name="fs_identity" id="fs_identity" class="">
                            <legend id="fs_identity_legend" class="">Identity</legend>
                            
                            <label for="name_f">First Name</label>
                            <input name="name_f" 	
                            	id="name_f"
                                class="account_search"
                                required 
                                placeholder="First Name" />
                                
                            <label for="name_l">Last Name</label>
                            <input name="name_l" 	
                            	id="name_l" 
                                class="account_search"
                                required
                                placeholder="Last Name" />                         
                                
                            <label for="id">UK ID</label>
                            <input name="id" 	
                            	id="id" 
                                class="account_search"                                
                                placeholder="UK ID" />     
                                                               
                            <div>
                                <label for="account">Account</label>
                                <input name="account" 	
                                    id="account" 
                                    list="dl_account"
                                    required
                                    placeholder="Link Blue or EHS account" />
                                    
                                <datalist id="dl_account" data-source-url="/libraries/inserts/account.php"></datalist>
                                
                                <p id="dl_account_progress" class="load color_red center display_none">
                                        Loading accounts...
                                        <img id="dl_account_load_progress" 
                                            src="/media/image/meter_bar.gif" 
                                            alt="Loading items... " 
                                            title="Loading items..." />
                                </p>
                            </div>
                        </fieldset>     
                        
                               
                        <p>
                            <button type="submit" value="1" name="submit" id="submit">Submit</button>
                        </p>                    
                        
                    </form>                          
                             	       			
               	</div><!--/content-->
            </div><!--/subContainer-->
            <div id="sidePanel">		
				<?php include($cDocroot."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--container-->
        
        <div id="footerPad">
        	<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--/footerPad-->
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40196994-1', 'uky.edu');
  ga('send', 'pageview');


	$(function(){
		$( '.date_entry' ).datetimepicker({dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss', changeYear: true, constrainInput: true});
	});	

	$('.room_search').change(function(event)
	{	
		options_update(event, null, '#room');	
	});

	$('.account_search').change(function(event)
	{	
		options_update(event, null, '#dl_account');	
	});
	
	$(document).ready(function(event) {
		
		options_update(event, null, '#dl_account');
		options_update(event, null, '#class');
		options_update(event, null, '#trainer');
		options_update(event, null, '#department');
		options_update(event, null, '#facility');		
	});
</script>

</body>
</html>

