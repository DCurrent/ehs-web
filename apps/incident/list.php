<?php 

	require('../../libraries/php/classes/config.php'); //Basic configuration file.
	require('../../libraries/php/classes/database/main.php'); 	// Database class.
	require('source/main.php');
	
	$cLRoot		= $cDocroot."ohs/";	
		
	// Verify login.
	//$oAcc->access_verify();
		
	// Initialize post/get vars object.
	//$post = new post();
	//$get = new get();
	
	$agent_list 	= array();
	$body_list		= array();
	$nature_list	= array();
	
	$body 	= NULL;	// Body list row.
	$agent	= NULL;	// Agent list row.
	$nature = NULL;	// Nature list row.
	$facility = NULL; // Facility list row.
	$room 	= NULL; // Room list row.
	$type	= NULL; // Type text.
	$contact = NULL;	// Contact object.
	$time 	= date(DATE_FORMAT);	// Current date/time.
	
	// Get request (input) objects.
	$query_request = new class_query_request();
	$request = new class_incident();
	$request->populate_from_post();	
	
	/////testing////////	
	
	if(is_array($request->get_type()))
	{
		echo '<br>yes';
		
		$request->set_type(implode("','", $request->get_type()));
		echo '<br>'.$request->get_type();
			
	}
	else
	{
		echo '<br> no';
	}
	//.implode(',', $request->get_type()).
	
	////////////////////
	
	
	
	
	$incidents  = array();
	
	// Initialize DB connection and query objects.
	/* Set the number of results to display on each page. */
	const PAGE_ROWS = 10;	
	
	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);	
	
	//Now you can use this query to see how many rows you are dealing with
	//Edit $result as your query
	$query->set_sql("SELECT COUNT(id) as row_count FROM tbl_incident WHERE type IN(?)");
	$query->set_params(array($request->get_type()));
	$query->query();
	$rows_ob = $query->get_line_object();
	$rows = $rows_ob->row_count; 
	
	echo '<br>'.$rows;
	exit;
	
	//This is the number of results displayed per page 
	$page_rows = 15; 
	
	//This tells us the page number of our last page 
	$last = ceil($rows/$page_rows); 
	
	//Seeing if the current page we are on is the last
	if (($query_request->get_page_number() > $last) && ($last > 0)) { $query_request->set_page_number($last); }
	
	//This sets the range to display in our query 
	$max = ($query_request->get_page_number() - 1) * $page_rows;
	
	//This is your query again, just spiced up a bit
	// mssql doesnt have that nice limit ability like mysql... so we use this to make it work...
	// the way the table is designed is, "id" is the unique id, and "name" is just a list of names i have in there.	 
	
	$query->set_sql("SELECT TOP(?) * FROM tbl_incident WHERE (id NOT IN (SELECT TOP(?) id FROM tbl_incident ORDER BY id DESC)) AND type IN(?) ORDER BY time DESC");
	$query->set_params(
		array(&$page_rows, 
			&$max,
			$request->get_type()));
	$query->query();
	
	$query->get_line_params()->set_class_name('class_incident');
	$incidents = $query->get_line_object_all();	
	
	// Paging controls
	// First we check if we are on page one. If we are then we don't need a link to the previous page or the first page so we do nothing. If we aren't then we generate links to the 	// first page, and to the previous page.
	if ($query_request->get_page_number() == 1) 
	{ 
		$page_nav.= ' << First ';
		$page_nav.= ' < Previous ';
	} 
	else 
	{
		$page_nav.= ' <a href="'.$_SERVER['PHP_SELF'].'?pagenum=1"> << First</a> ';
		$page_nav.= " ";
		$previous = $query_request->get_page_number()-1;
		$page_nav.= ' <a href="'.$_SERVER['PHP_SELF'].'?pagenum='.$previous.'"> < Previous</a> ';
	} 
	
	// Current page indicator.
	$page_nav.= ' -- Page '.$query_request->get_page_number().' of '.$last.' ('.$rows.' ';
	$page_nav.= ($rows == 1 ? 'record' : 'records');
	$page_nav.= ') -- ';
	
	// This does the same as above, only checking if we are on the last page, and then generating the Next and Last links
	if ($query_request->get_page_number() == $last) 
	{
		$page_nav.= ' Next > ';
		$page_nav.= ' Last >> ';
	} 
	else 
	{
		$next = $query_request->get_page_number()+1;
		$page_nav.= ' <a href="'.$_SERVER['PHP_SELF'].'?pagenum='.$next.'">Next ></a> ';
		$page_nav.= ' ';
		$page_nav.= ' <a href="'.$_SERVER['PHP_SELF'].'?pagenum='.$last.'">Last >></a> ';
	}
	
	// Sub queries to get names/text for relational items.
	if($rows > 0)
	{	
		//$contact = new contact($details->contact);
	
		/* Get time.
		$details_time = NULL;
		
		if($details->time)
		{
			if($details->time->getTimestamp())
			{
				$details_time = date(DATE_FORMAT, $details->time->getTimestamp());
			}
		}
		*/
		
			
		// Prepare type label items query.
		$type_param = NULL;
		$type_ob = NULL;
		
		$query_type = new class_db_query($db);
		
		$query_type->set_sql('SELECT id, label
							FROM tbl_incident_type_list 
							WHERE     (id = ?)');
		$query_type->set_params(array(&$type_param));
		$query_type->prepare();
		
		// Get facilty label items.
		$facility_param = NULL;
		$facility_ob = NULL;
		
		$query_facility = new class_db_query($db);
		
		$query_facility->set_sql('SELECT name
							FROM vw_uk_space_facility 
							WHERE     (code = ?)');
		$query_facility->set_params(array(&$facility_param));
		$query_facility->prepare();
				
		// Get room label items.
		$room_param = NULL;
		$room_ob = new class_incident_room();
		
		$query_room = new class_db_query($db);
		
		$query_room->set_sql('SELECT room, useage_desc
							FROM vw_uk_space_room 
							WHERE     (barcode = ?)');
		$query_room->set_params(array(&$room_param));
		$query_room->prepare();		
	}
	
?>



<!DOCtype html>
    <head>
        <title>UK - Occupational Health &amp; Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        
        <link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />        
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>       
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
    	
                    <table>
                        <caption>Incidents</caption>
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Name</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>         
                    
                                        <?php								
                                            foreach($incidents as $incident)
                                            {
                                                // Execute type query to get the type label.
                                                $type_param = $incident->get_type();
                                                $query_type->execute();
                                                
                                                if($query_type->get_row_exists())
                                                {
                                                    $query_type->get_line_params()->set_class_name('class_incident_type');
                                                    $type_ob = $query_type->get_line_object();
                                                }
                                                else
                                                {
                                                    $type_ob = new class_incident_type();
                                                }
                                                
                                                // Execute facility query to get the facility name.
                                                $facility_param = $incident->get_facility();
                                                $query_facility->execute();
                                                
                                                if($query_facility->get_row_exists())
                                                {
                                                    $query_facility->get_line_params()->set_class_name('class_incident_facility');
                                                    $facility_ob = $query_facility->get_line_object();
                                                    
                                                    // Fix capitalization of facility name.
                                                    $facility_ob->set_name(ucwords(strtolower($facility_ob->get_name())));	
                                                }
                                                else
                                                {
                                                    $facility_ob = new class_incident_facility();
                                                }
                                                
                                                // Execute room query to get the room#.
                                                $room_param = $incident->get_area();
                                                $query_room->execute();
                                                
                                                if($query_room->get_row_exists())
                                                {
                                                    $query_room->get_line_params()->set_class_name('class_incident_room');
                                                    $room_ob = $query_room->get_line_object();
                                                }
                                                else
                                                {
                                                    $room_ob = new class_incident_room();
                                                    
                                                    if($incident->get_area() == CONSTANTS::AREA_OUTSIDE)
                                                    {
                                                        $room_ob->set_room('Outside');
                                                    }
                                                    else
                                                    {
                                                        $room_ob->set_room('NA');
                                                    }
                                                }
                                        ?>
                                                <tr>
                                                    <td><?php echo date(DATE_FORMAT, $incident->get_time()->getTimestamp()); ?></td>
                                                    <td><?php echo $type_ob->get_label(); ?></td>
                                                    <td><?php echo $facility_ob->get_name().', '.$room_ob->get_room(); ?></td>
                                                    <td><a mailto="<?php echo $incident->get_email(); ?>"><?php echo $incident->get_name_l().', '.$incident->get_name_f(); ?></a></td>                                    	<td><a href="details.php?id=<?php echo $incident->get_id(); ?>" target="new">Details</a></td>
                                                </tr>                                            
                                        <?php
                                            }
                                        ?>
                        </tbody>
                    </table>
                    
                    <?php echo $page_nav; ?>
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
        </script>
    </body>
</html>