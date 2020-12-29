<?php 
	
	echo 'test';
	
	//require_once($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/config.php'); //Blasic configuration file. 
	require_once($_SERVER['DOCUMENT_ROOT'].'/apps/rocky/source/main.php');
	
	/*
	Damon V. Caskey
	2011/11/01
	~2011/12/08
	~2013/01/14
	
	Create training quiz from database entries as identified by class ID.
	*/	
	
	
	// Record navigation.
	$obj_navigation_rec = new class_record_nav();
	
	// Prepare redirect url with variables.
	$url_query	= new url_query;	
	$url_query->set_data('id', $obj_navigation_rec->get_id());
	
	// User access.
	$access_obj = new class_access();
	$access_obj->access_verify($url_query->return_url());	
		
	// Set up database.
	$db_conn_set = new class_db_connect_params();
	$db_conn_set->set_db_name(DATABASE::NAME);
	$db_conn_set->set_db_user('ehsinfo_public');
	$db_conn_set->set_db_password('eh$inf0');
	
	$db = new class_db_connection($db_conn_set);
	$query = new class_db_query($db);
	
	// Initialize our data objects. This is just in case there is no table
	// data for any of the navigation queries to find, we are making new
	// records, or copies of records. It also has the side effect of enabling 
	// IDE type hinting.
	$_main_data = new class_module_data();	
		
	// Ensure the main data ID member is same as navigation object ID.
	$_main_data->set_id($obj_navigation_rec->get_id());
	
	$query->set_sql('{call module_detail(@id = ?,
								@sort_field 	= ?,
								@sort_order 	= ?,
								@nav_first		= ?,
								@nav_previous	= ?,
								@nav_next		= ?,
								@nav_last		= ?)}');	
	
	$hidden			= NULL;
	$sort_field		= NULL;
	$sort_order		= NULL;	
	$nav_first 		= NULL;
	$nav_previous	= NULL;
	$nav_next		= NULL;
	$nav_last 		= NULL;
					
	$params = array(array($_main_data->get_id(), 	SQLSRV_PARAM_IN),
					array($sort_field, 				SQLSRV_PARAM_OUT, 	SQLSRV_PHPTYPE_INT),
					array($sort_order, 				SQLSRV_PARAM_OUT, 	SQLSRV_PHPTYPE_INT),
					array($nav_first,				SQLSRV_PARAM_OUT, 	SQLSRV_PHPTYPE_INT),
					array($nav_previous, 			SQLSRV_PARAM_OUT, 	SQLSRV_PHPTYPE_INT),
					array($nav_next, 				SQLSRV_PARAM_OUT, 	SQLSRV_PHPTYPE_INT),
					array($nav_last, 				SQLSRV_PARAM_OUT, 	SQLSRV_PHPTYPE_INT));
					
	$query->set_params($params);
	$query->query();
	
	$query->get_line_params()->set_class_name('class_module_data');
	
	if($query->get_row_exists() === TRUE) $_main_data = $query->get_line_object();
	
	//////////////////////////////////
	
	
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety - <?php echo $cCP['desc_title']; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
        <script type="text/javascript" src="../libraries/javascript/validate.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="//code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <script src="../libraries/javascript/options_update.js"></script>
        
        <style>
        #video
        {
            z-index:-100;
        }
        </style>
    </head>
    
    <body>
        <div id="container">
            
            <div id="mainNavigation">
            	<?php //include($_SERVER['DOCUMENT_ROOT']."/libraries/includes/inc_mainnav.php"); ?>
            </div>
            
            <div id="subContainer">
                <?php //include($_SERVER['DOCUMENT_ROOT']."/a_banner_0001.php"); ?>
            
                <div id="subNavigation">
                    <?php //include($_SERVER['DOCUMENT_ROOT']."/a_subnav_0001.php"); ?> 
                </div>
            
                <div id="content">
                
                <form action="main_verify.php" method="post" entype="multipart/form-data" name="class" id="class" onsubmit="return validate_form_inputs('required')" class="class_register">
                        <!-- We're going to submit the class ID as a form value here. Normally that isn't needed, but we need to later
                        know that the user really did register for class. -->
                        <input type="hidden" name="class" 				value="<?php echo $_main_data->get_id(); ?>" />
                        
                
						<?php
                            echo $_main_data->get_field_facility();
                            if($_main_data->get_field_facility())
                            {
                        ?>
                                <fieldset>
                                    <legend>Location</legend>
                                    
                                    <p class="instructions">Select a building first, then choose the area. Buildings are listed in alphabetical order. If you know the building number, you can type the first few numbers to locate it more quickly. Areas are listed by floor, then by area number. You may also type the first few characters of an area number to locate it.</p>              
                    
                                    <div>
                                        <p id="facility_progress" class="load color_red center">
                                            Loading building list...
                                            <img id="img_facility_load_progress" 
                                                src="../../media/image/meter_bar.gif" 
                                                alt="Loading items... " 
                                                title="Loading items..." />
                                        </p>
                                        <label for="facility">Building</label>
                                        <select name="facility" 
                                            id="facility" 
                                            data-current="<?php //echo $post->get_facility(); ?>" 
                                            data-source-url="../../libraries/inserts/facility.php" 
                                            data-extra-options='<option value="">Select Building</option>'
                                            data-grouped="1"
                                            class="room_search">
                                                <!--This option is for valid HTML5; it is overwritten on load.--> 
                                                <option value="0">Select Building</option>                                    
                                                <!--Options will be populated on load via jquery.-->                                 
                                        </select>
                                    </div>
                        
                                    <div>
                                        <p id="area_progress" class="load color_red center display_none">
                                            Loading rooms/area list...
                                            <img id="img_area_load_progress" 
                                                src="../../media/image/meter_bar.gif" 
                                                alt="Loading items... " 
                                                title="Loading items..." />                               
                                        </p>
                                        <label for="area">Area</label>
                                        <select name="area" 
                                            id="area" 
                                            data-current="<?php //echo $post->get_area(); ?>" 
                                            data-source-url="../../libraries/inserts/room.php" 
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
                        
                        <?php
                            }
                        ?>
                	</form>
                                  
                </div><!--#content-->       
            </div>    
            <div id="sidePanel">		
                    <?php //include($_SERVER['DOCUMENT_ROOT']."/a_sidepanel_0001.php"); ?>	
                </div>
            <div id="footer">
                <?php //include($_SERVER['DOCUMENT_ROOT']."/libraries/includes/inc_footer.php"); ?>		
            </div>
        </div>
        
        <div id="footerPad">
        	<?php //include($_SERVER['DOCUMENT_ROOT']."/libraries/includes/inc_footerpad.php"); ?>
        </div>
        
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            
            ga('create', 'UA-40196994-1', 'uky.edu');
            ga('send', 'pageview');    
        
			$('.room_search').change(function(event)
			{	
				options_update(event, null, '#area');	
			});
		
        	$(document).ready(function(event) {		
				//options_update(event, null, '#agent');
				options_update(event, null, '#department');	
				options_update(event, null, '#facility');
				//	$("#department").attr('required', '');
				//('#facility').required = true;				
			});
        </script>
    
    
</body>
</html>

							

