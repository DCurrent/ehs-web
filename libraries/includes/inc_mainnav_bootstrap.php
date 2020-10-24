<!--Include: <?php echo __FILE__ . ", Last update: " . date(DATE_ATOM,filemtime(__FILE__)); ?>-->

<?php 

	const NAV_INDENT = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 

	require_once($_SERVER['DOCUMENT_ROOT'].'/apps/rocky/source/main.php');
	
	// Set up database.
	$db_conn_set = new class_db_connect_params();
	$db_conn_set->set_name(ROCKY_DATABASE::NAME);
	$db_conn_set->set_user('ehsinfo_public');
	$db_conn_set->set_password('eh$inf0');
	
	$db = new class_db_connection($db_conn_set);
	$query = new class_db_query($db);
	
	$query->set_sql('{call module_list_client()}');
	$query->query();
	
	$query->get_line_params()->set_class_name('class_module_data');
	$_obj_data_main_list = $query->get_line_object_list();
	
?>

<!--[if lte IE 8]>
    <hr/>
    <h3 class="color_red">Notice: Your browser is out of date or non WC3 standard compliant and may not render portions of this website correctly. We highly recommend upgrading to a more compliant browser such as <a href="//windows.microsoft.com/en-us/internet-explorer/download-ie">IE 9+</a>, <a href="//www.opera.com">Opera</a>, <a href="//www.mozilla.org">Firefox</a>, <a href="//www.google.com/chrome/">Google Chrome</a> or <a href="www.apple.com/safari/‎">Safari</a>.</h3>
    <hr/>
<![endif]-->

<nav class="navbar well well-sm">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav_main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <!--a class="navbar-brand" href="#"></a-->
        </div>
        <div class="collapse navbar-collapse" id="nav_main">
            <ul class="nav navbar-nav">
                <!--<li class="active"><a href="#">Home</a></li>-->
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Resources <span class="caret"></span></a>                    
                    <ul class="dropdown-menu">
                    	<li class="dropdown-header">Departments</li>                        
                            <li><a href="/"><?php echo NAV_INDENT; ?>EHS Home</a></li>
                            <li><a href="/biosafety"><?php echo NAV_INDENT; ?>Biosafety</a></li>
                            <li><a href="/env"><?php echo NAV_INDENT; ?>Environmental Management</a></li>
                            <li><a href="/ohs"><?php echo NAV_INDENT; ?>Occupational Health &amp; Safety</a></li>
                            <li><a href="/radiation"><?php echo NAV_INDENT; ?>Radiation Safety</a></li>
                            <li><a href="/fire"><?php echo NAV_INDENT; ?>University Fire Marshal</a></li>
                    	<li class="divider"></li>
                        <li class="dropdown-header">Applications</li>   
                        	<li><a href="#" title="Inspector Blair is the EHS inspection tracking system."><?php echo NAV_INDENT; ?>Inspector Blair</a></li>	
                            <li><a href="https://etrax.chematix.com" title="Create waste tickets and schedule waste pick up."><?php echo NAV_INDENT; ?>E-Trax</a></li>
                            <li><a href="#" title="Get online safety training, set up in person training, and view safety training records."><?php echo NAV_INDENT; ?>Rocky</a></li>    
                        <li class="divider"></li>
                        <li class="dropdown-header">Other</li>    
                    		<li><a href="/faq.php"><?php echo NAV_INDENT; ?>Frequently Asked Questions</a></li>
                    </ul>
                </li>
                
                <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Events <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/fsm">Campus Fire Safety Month, September</a></li>
                        <li><a href="biosafety/lab_safety_fair.jpg" target="_blank">Lab Safety Fair</a></li>
                        <li><a href="/docs/ppt/StormReady.ppt" title="StormReady Ceremony pictures in PowerPoint" target="_blank" >UK Campus StormReady Ceremony Pictures</a></li>
                    </ul>
                </li>
                
                <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Report an Incident <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                    	<li class="dropdown-header">Accidents</li>
                        	<li><a href="/ohs/accident.php"><?php echo NAV_INDENT; ?>Accidents and Unsafe Conditions</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Hazardous Conditions</li>
                        	<li><a href="/biosafety/bio_ar_reporting_exposures_to_potentially_biohazardous_materials_0001.pdf"><?php echo NAV_INDENT; ?>Potentially Biohazardous Material Exposure</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Stormwater</li>
                        	<li><a href="/env/storm_water_quality.php"><?php echo NAV_INDENT; ?>Illicit Stormwater Discharge</a></li>
                    </ul>        
                </li>
                
                <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Committees <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/chairs.html">Departmental Safety Committees</a></li>
                        <li><a href="/chemsafe.html">Chemical Safety Committee</a></li>
                        <li><a href="/docs/pdf/AR.pdf">Committee Charges</a></li>
                        <li><a href="/docs/pdf/bio_ibc_members_0001.pdf" target="_blank">Institutional Biosafety Committee</a></li>
                        <li><a href="/docs/pdf/rad_comm.pdf">Radiation Safety Committee</a></li>
                        <li><a href="/docs/pdf/ehs_committees_structure_0001.pdf">Organization Chart</a></li>
                    </ul>
                </li>
                
                <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">Training <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">Classes</li>
                        	<?php
								if(is_object($_obj_data_main_list) === TRUE)
								{
									for($_obj_data_main_list->rewind(); $_obj_data_main_list->valid(); $_obj_data_main_list->next())
									{						
										$_obj_data_main = $_obj_data_main_list->current();
								?>
											<li><a href="/apps/rocky/module_list_client.php#<?php echo $_obj_data_main->get_id();?>"><?php echo NAV_INDENT.$_obj_data_main->get_desc_title();?></a></li>                                
								<?php								
									}
								}
							?>
                        <li class="divider"></li>
                        <li class="dropdown-header">Records</li>
                        	<li><a href="/classes/participant_list.php"><?php echo NAV_INDENT; ?>Participant List</a></li>
                        	<li><a href="/classes/transcript.php" title="Click here for a transcript of classes taken and acquire certificates."><?php echo NAV_INDENT; ?>Personal Transcript</a></li> 
                		
                    </ul>
                </li>
            </ul>
            
            
            <ul class="nav navbar-nav navbar-right">
            	<?php
					
					if(isset($_SESSION[ACCESS_SES_KEY::ACCOUNT]))
					{
					?>
						<li><a href="<?php echo ACCESS_SETTINGS::AUTHENTICATE_URL; ?>?logoff=<?php echo TRUE; ?>"><span class="glyphicon glyphicon-log-out"></span> Log Off</a></li>
					<?php
					}
					else
					{
					?>
						<li><a href="<?php echo ACCESS_SETTINGS::AUTHENTICATE_URL; ?>"><span class="glyphicon glyphicon-log-in"></span> Log In</a></li>
					<?php
					}
					
				?>                   
            </ul>
        </div>
    </div>
</nav>

<!--/Include: <?php echo __FILE__; ?>-->