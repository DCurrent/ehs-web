<?php

	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
	require_once('../../../libraries/php/classes/database/main.php'); // Database system.
	
	$lroot			= $cDocroot;
	
	const DEBUG = FALSE;		//!= FALSE: Disables all training modules with maintenance alert to users; value is passed as an ETA. 
	
	$auth_lvl			= NULL;	//Authorization level. Must be 1 or higher to view certain trianing (i.e. Select Agents).
	$cAuthorized_List	= NULL; //List of users authorized to view Select Agents training.
	$cAuthorized		= NULL; //Individual user authorized to view Select Agents training.
	$db 				= NULL;	// Database connection object.
	$query				= NULL;	// Query object.
	
	$date_range_start 	= new DateTime();
	$date_range_end 	= new DateTime();
		
	// Verify user is authorized.
	//$oAcc->access_verify();
		
	// Set access level to 1 if user is on a list authorized to view Select Agents training participants.
	$authorized_List = array("dvcask2", "bnels3", "dwhibb0", "glschl1", "rdeldr0", "kmcgu1", "hmtr222", "ejrous0");
	
	// If date range values are not set, populate with defaults.
	// Initialize DB connection and query objects.
	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);	
	
	// If date range values are not set, populate with defaults.
	$query->set_sql("SELECT TOP 1 class_date FROM tbl_class WHERE class_date <> '' ORDER BY class_date");
	$query->query();
	
	// Get timestamp from query and use it to set the timsestamp in date object.
	$date_range_start->setTimestamp($query->get_line_object()->class_date->getTimestamp());	
	
	// If date range values are not set, populate with defaults.
	$query->set_sql("SELECT TOP 1 class_date FROM tbl_class WHERE class_date <> '' ORDER BY class_date DESC");
	$query->query();
	
	// Get timestamp from query and use it to set the timsestamp in date object.
	$date_range_end->setTimestamp($query->get_line_object()->class_date->getTimestamp());
					
?>
<!DOCtype html>
    <head>
        <title>
        	UK - Environmental Health & Safety, Class Participant Search
		</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../../../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../../../libraries/css/print.css" type="text/css" media="print" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
        
        <script language="Javascript" type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script language="Javascript" type="text/javascript" src="//code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <script language="Javascript" type="text/javascript" src="../../../libraries/javascript/jquery_ui_timepicker_addon.js"></script>
    </head>
    
    <body>
    
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div>
            <div id="subContainer">
                <?php include($lroot."a_banner_0001.php"); ?>	
                <div id="subNavigation">
                    <?php include($lroot."a_subnav_0001.php"); ?> 
                </div>
                
                <div id="content"> 
                    <h1>Class Participants</h1>
                    
                    <p class="NoPrint">
                    	Use any combination of the following criteria  to create  a report  of users who have completed training courses provided by UK Environmental Health &amp; Safety.</p>
						<?php if(!$auth_lvl)
                        {
                        ?>
                            <p class="alert">
                            	Notice: Due to security regulations, this list excludes following modules. Please see  your <a href="../transcript.php">personal transcript</a> or contact the listed department for more information:
							</p>
                            
                            <p>
                            	Irradiator - <a href="/radiation">Radiation Safety</a><br />
                            	Select Agents - <a href="/biosafety">Biosafety</a>
                            </p>
                        <?php 
                        }   
                        ?>
                        
                    <div class="table_header NoPrint" >
                        Search Criteria
                    </div>
                
                    <form>
                        <fieldset name="fs_range" id="fs_range" class="">
                            <legend id="fs_range_legend" class="">Date Range</legend>
                            
                            <p>Enter the desired date range of records.</p>
                                                                                            
                            <label for="range_start" id="range_start_label">Start:</label>
                                                    
                            <input 
                                type="text" 
                                name="range_start" 
                                id="range_start" 
                                value="<?php echo $date_range_start->format(DATE_FORMAT); ?>" 
                                readonly 
                                class="date_entry hasDatepicker" />  
                            
                            <label for="range_end" id="range_start_label">End:</label>  
                            
                            <input 
                                type="datetime" 
                                name="range_end" 
                                id="range_end" 
                                value="<?php echo $date_range_end->format(DATE_FORMAT); ?>" 
                                readonly 
                                class="date_entry hasDatepicker" />                      		                          
                        </fieldset>
                    </form>   
            	</div>       
            </div>
            
            <div id="sidePanel">		
                <?php include($cDocroot."a_sidepanel_0001.php"); ?>	
            </div>
            
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div>
        </div>
        
        <div id="footerPad">
        	<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div>
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			 m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			 })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			
			 ga('create', 'UA-40196994-1', 'uky.edu');
			 ga('send', 'pageview');  
			 
			 $(function(){
             	$('#range_start').datetimepicker({dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss', changeYear: true, constrainInput: true, yearRange: '<?php echo $date_range_start->format('Y'); ?>:2014'});
                });  
    	</script>
</body>
</html>

