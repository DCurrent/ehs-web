<?php 

	require('../../libraries/config.php'); //Basic configuration file.
	require('../../libraries/php/classes/database/main.php'); 	// Database class.
	require('source/main.php');
	
	$cLRoot		= $cDocroot."ohs/";	

	// Get data.			
	class get 
	{	
		public $id = NULL;
						
		public function __construct()
		{		
			// Interate through each class variable.
       		foreach($this as $key => $value) 
			{			
				// If we can find a matching a get var with key matching
				// key of current object var, set object var to the post value. 
				if(isset($_GET[$key]))
				{					
					$this->$key = $_GET[$key];       						
				}
			}	
	 	}		
	}		
	
	// Verify login.
	//$oAcc->access_verify();
		
	// Initialize post/get vars object.
	//$post = new post();
	$get = new get();
	
	$agent_list 	= array();
	$body_list		= array();
	$nature_list	= array();
	
	$details = new class_incident(); // Record object.
	$body 	= NULL;	// Body list row.
	$agent	= NULL;	// Agent list row.
	$nature = NULL;	// Nature list row.
	$facility = NULL; // Facility list row.
	$room 	= NULL; // Room list row.
	$type	= NULL; // Type text.
	$contact = NULL;	// Contact object.
	$time 	= date(DATE_FORMAT);	// Current date/time.
	
		// Initialize DB connection and query objects.
	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);	
		
	
	
	$query->set_sql('SELECT * FROM tbl_incident WHERE id = ?');
	$query->set_params(array(&$get->id));
	$query->query();
	
	if($query->get_row_exists())
	{
		$query->get_line_params()->set_class_name('class_incident');
		$details = $query->get_line_object();
	}

	// Contact string object.
	if($details)
	{	
		$contact = new contact($details->get_contact());
	
		// Get time.
		$details_time = NULL;
		
		if($details->get_time())
		{
			if($details->get_time()->getTimestamp())
			{
				$details_time = date(DATE_FORMAT, $details->get_time()->getTimestamp());
			}
		}
		
		// Get type label items.
		$query->set_sql('SELECT label
							FROM tbl_incident_type_list 
							WHERE     (id = ?)');
		$query->set_params(array($details->get_type()));
		$query->query();
		
		if($query->get_row_exists()) $type = $query->get_line_object();
		
		// Get department label items.
		$query->set_sql('SELECT name
							FROM vw_uk_space_department 
							WHERE     (number = ?)');
		$query->set_params(array($details->get_department()));
		$query->query();
		
		if($query->get_row_exists()) $department = $query->get_line_object();
		
		// Get facilty label items.
		$query->set_sql('SELECT name
							FROM vw_uk_space_facility 
							WHERE     (code = ?)');
		$query->set_params(array($details->get_facility()));
		$query->query();
		
		if($query->get_row_exists()) $facility = $query->get_line_object();
		
		// Get room label items.
		$query->set_sql('SELECT room, useage_desc
							FROM vw_uk_space_room 
							WHERE     (barcode = ?)');
		$query->set_params(array($details->get_area()));
		$query->query();
		
		
		if($query->get_row_exists()) 
		{
			$query->get_line_params()->set_class_name('class_incident_room');
			$room = $query->get_line_object();
		}
		
		// Get type label items.
		$query->set_sql('SELECT label
							FROM tbl_incident_type_list 
							WHERE     (id = ?)');
		$query->set_params(array($details->get_type()));
		$query->query();
		
		if($query->get_row_exists()) $type = $query->get_line_object();
		
		// Get agent list items.
		$query->set_sql('SELECT dbo.tbl_incident_agent_list.label
							FROM dbo.tbl_incident_agent 
							INNER JOIN dbo.tbl_incident_agent_list 
							ON dbo.tbl_incident_agent.item = dbo.tbl_incident_agent_list.id
							WHERE     (dbo.tbl_incident_agent.fk_id = ?)');
		$query->set_params(array($details->get_id()));
		$query->query();
		
		if($query->get_row_exists()) $agent_list = $query->get_line_object_all();
		
		// Get body list items.
		$query->set_sql('SELECT dbo.tbl_incident_body_list.label
							FROM dbo.tbl_incident_body 
							INNER JOIN dbo.tbl_incident_body_list 
							ON dbo.tbl_incident_body.item = dbo.tbl_incident_body_list.id
							WHERE     (dbo.tbl_incident_body.fk_id = ?)');
		$query->set_params(array($details->get_id()));
		$query->query();
		if($query->get_row_exists()) $body_list = $query->get_line_object_all();
		
		// Get nature location list items.
		$query->set_sql('SELECT dbo.tbl_incident_nature_list.label
							FROM dbo.tbl_incident_nature 
							INNER JOIN dbo.tbl_incident_nature_list 
							ON dbo.tbl_incident_nature.item = dbo.tbl_incident_nature_list.id
							WHERE     (dbo.tbl_incident_nature.fk_id = ?)');
		$query->set_params(array($details->get_id()));
		$query->query();
		if($query->get_row_exists()) $nature_list = $query->get_line_object_all();	
	}
?>



<!DOCtype html>
    <head>
        <title>UK - Occupational Health &amp; Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        
        <link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
        <script src="../../libraries/javascript/jquery_ui_timepicker_addon.js"></script>
        <script src="../../libraries/javascript/options_update.js"></script>    
    	
        <style>
						
			.incident {
				font-size:larger;			
			}
			
			ul.checkbox  { 
			  margin: 0; 
			  padding: 0; 
			  margin-left: 20px; 
			  list-style: none; 
			} 
			
			ul.checkbox li input { 
			  margin-right: .25em; 
			} 
			
			ul.checkbox li { 
			  border: 1px transparent solid; 
			  display:inline-block;
			  width:12em;
			} 
			
			ul.checkbox li label { 
			  margin-left: ; 
			} 
			ul.checkbox li:hover, 
			ul.checkbox li.focus  { 
			  background-color: lightyellow; 
			  border: 1px gray solid; 
			  width: 12em; 
			}
			
			table.spaced 
			{
				border-spacing:1px;				
			
			}
		</style>
    
    </head>
    
    <body>    
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div>
            <div id="subContainer">
                <div id="banner_container" class="banner_container">	
                    <div id="banner_content" class="banner">
                        University of Kentucky
                        <h1>Incident Reporting</h1>
                        <div id="banner_slogan" class="slogan">
                            UK Safety Begins with You!
                        </div><!--#banner_slogan-->
                    </div><!--#banner_content-->
                </div><!--#banner_container-->
                <div id="subNavigation">
                    <?php include($cLRoot."a_subnav_0001.php"); ?> 
                </div><!--#subNavigation-->
                <div id="content">
                	<?php					
					// Make sure there is a main record.
					if(!$details)
					{
					?>
                    	<h2 class="color_red">No record match.</h2>
                    <?php	
					}
					else
					{
					?>         	       						
                        <table class="spaced">
                            <thead>
                            <thead>
                            
                            <tfoot>
                            <tfoot>
                            
                            <tbody>
                                <tr>
                                    <th>Time</th>
                                    <td><?php echo $details_time; ?></td>
                                </tr>
                            
                                <tr>
                                    <th>Type</th>
                                    <td><?php if($type) echo $type->label; ?></td>
                                </tr>
                                
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo $details->get_name_l().', '.$details->get_name_f(); ?></td>
                                </tr>
                                
                                <tr>
                                    <th>Account</th>
                                    <td><?php echo $details->get_account(); ?></td>
                                </tr>
                                
                                <tr>
                                    <th>E-Mail</th>
                                    <td>
                                    	<?php 
											if($details->get_email())
											{
										?>
                                    			<a href="mailto:<?php echo $details->get_email(); ?>" title="Click to send email."><?php echo $details->get_email(); ?></a></td>
                                        <?php
											}
										?>
                                </tr>
                                
                                <tr>
                                    <th>Department</th>
                                    <td>
                                        <?php 
                                            echo $details->get_department(); 
                                            if($department) echo ' - '.$department->name; 
                                        ?>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>Phone</th>
                                    <td><?php echo $details->get_phone(); ?></td>
                                </tr>
                                
                                <tr>
                                    <th>Contact</th>
                                    <td><?php if($contact) echo $contact->label(); ?></td>
                                </tr>
                                
                                <tr>
                                    <th>Location</th>
                                    <td>
                                        <?php 
                                            echo $details->get_facility();
                                            if($facility) echo ' - '.ucwords(strtolower($facility->name)); 
                                        
                                        
                                            if($details->get_area() == -2)
                                            {
                                                echo ', Outside';
                                            }
                                            else
                                            {
                                                if($room) echo ', '.$room->get_room().' ('.ucwords(strtolower($room->get_useage_desc())).')';
                                            }									
                                        ?>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <th>Description</th>
                                    <td><?php echo $details->get_description(); ?></td>
                                </tr>
                                
                                <tr>
                                    <th>Agents</th>
                                    <td>
                                        <ul>
                                            <?php 
                                                // Iterate over each item.
                                                foreach ($agent_list as $agent)
                                                {
                                                    echo '<li>'.$agent->label.'</li>';	
                                                }
                                            ?>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Injuries</th>
                                    <td>
                                        <ul>
                                            <?php 
                                                // Iterate over each item.
                                                foreach ($body_list as $body)
                                                {
                                                    echo '<li>'.$body->label.'</li>';	
                                                }
                                            ?>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nature</th>
                                    <td>
                                        <ul>
                                            <?php 
                                                // Iterate over each item.
                                                foreach ($nature_list as $nature)
                                                {
                                                    echo '<li>'.$nature->label.'</li>';	
                                                }
                                            ?>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                	<?php
					}
					?>                        
                </div><!--#content-->       
            </div><!--#subContainer-->    
            <div id="sidePanel">		
                <?php include($cLRoot."a_sidepanel_0001.php"); ?>		
            </div><!--#sidePanel-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--#footer-->
        </div><!--#constainer-->
        
        <div id="footerPad">
            <?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--#footerPad-->
        
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
		
			$(function(){
						$( '#time' ).datetimepicker({dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss', changeYear: true, constrainInput: true});
					});
		
        	$(document).ready(function(event) {		
				//options_update(event, null, '#agent');
				options_update(event, null, '#department');	
				options_update(event, null, '#facility');					
			});
        
        </script>
    </body>
</html>