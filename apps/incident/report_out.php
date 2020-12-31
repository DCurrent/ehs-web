<?php 

	// Set the number of results to display on each page.
	const PAGE_ROWS = 50;
	
	require('../../libraries/php/classes/database/main.php'); 	// Database class.
	require('source/main.php');
	
	require('../../libraries/config.php'); //Basic configuration file.
	
	
	$cLRoot		= $cDocroot."ohs/";	
		
	// Verify login.
	$oAcc->access_verify(NULL, NULL);
	
	$query_request = new class_query_request();
	$request = new class_incident();
	
	// Get current post values that match incident item names. We'll use these for building a query.
	$request->populate_from_post();
	
	// The request object contains the criteria we'll be using to build
	// a query with. We need to know if this is a new post from the report
	// building screen or the user clicking a local paging link.
	//
	// If this is a fresh submission, submit will be TRUE and we know
	// user just requested a report. Set submission value to FALSE 
	// and store our request object into a session. 
	//
	// Otherwise the user must be using a local paging control. In that
	// case we'll get the request object from session.
	//
	// If there is no submit and nothing to get from session, user probably
	// came here by mistake. In that case we'll redirect them to the 
	// report building page.	
	if($request->get_submit() == CONSTANTS::SUBMIT_TRUE)
	{
		$request->set_submit(CONSTANTS::SUBMIT_FALSE);
		$_SESSION[CONSTANTS::INCIDENT_OB_SES_KEY] = serialize($request);
	}
	else
	{
		if(isset($_SESSION[CONSTANTS::INCIDENT_OB_SES_KEY]))
		{
			$request = unserialize($_SESSION[CONSTANTS::INCIDENT_OB_SES_KEY]);
		}
		else
		{
			header("Location: report.php");
			die();		
		}
	}
	
	$incidents  = array();
	
	// Initialize DB connection and query objects.		
	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);
	
	// Initialize parameter building class.
	$parameter_build = new class_parameter_build();
	
	// Parameter setups.
	$params = array();
	$sql	= NULL;
	
	// Type.
	$parameter_build->set_name('type');
	$parameter_build->set_value($request->get_type());
	$parameter_build->assemble();
	
	// First name.
	$parameter_build->set_name('name_f');
	$parameter_build->set_value($request->get_name_f());
	$parameter_build->assemble();
	
	// Last name.
	$parameter_build->set_name('name_l');
	$parameter_build->set_value($request->get_name_l());
	$parameter_build->assemble();
	
	// Account.
	$parameter_build->set_name('account');
	$parameter_build->set_value($request->get_account());
	$parameter_build->assemble();
	
	// Email.
	$parameter_build->set_name('email');
	$parameter_build->set_value($request->get_email());
	$parameter_build->assemble();
	
	// Department.
	$parameter_build->set_name('department');
	$parameter_build->set_value($request->get_department());
	$parameter_build->assemble();
	
	// Contact.
	$parameter_build->set_name('contact');
	$parameter_build->set_value($request->get_contact());
	$parameter_build->assemble();
	
	// Location.
	$parameter_build->set_name('facility');
	$parameter_build->set_value($request->get_facility());
	$parameter_build->assemble();
	
	$parameter_build->set_name('area');
	$parameter_build->set_value($request->get_area());
	$parameter_build->assemble();
	
	// Agent, body, and list items are stored in sub tables and require 
	// a subquery string to filter by. For now we'll hard code the sql
	// concatenation and array merging here.	
	$sql 	= $parameter_build->get_sql();
	$params	= $parameter_build->get_params();
	
	if(is_array($request->get_agent()))
	{
		$sql .= " AND Exists (
                Select 1
                From tbl_incident_agent
                Where fk_id = _incident.id
                AND item IN (".str_repeat('?,', count($request->get_agent()) - 1). '?'."))";
		
		// Merge value array into parameter array.
		$params = array_merge($params, $request->get_agent());
	}
	
	if(is_array($request->get_body()))
	{
		$sql .= " AND Exists (
                Select 1
                From tbl_incident_body
                Where fk_id = _incident.id
                AND item IN (".str_repeat('?,', count($request->get_body()) - 1). '?'."))";
		
		// Merge value array into parameter array.
		$params = array_merge($params, $request->get_body());
	}
	
	if(is_array($request->get_nature()))
	{
		$sql .= " AND Exists (
                Select 1
                From tbl_incident_nature
                Where fk_id = _incident.id
                AND item IN (".str_repeat('?,', count($request->get_nature()) - 1). '?'."))";
		
		// Merge value array into parameter array.
		$params = array_merge($params, $request->get_nature());
	}
	
	// For paging, we need to know how many rows are returned.
	$query->set_sql("SELECT COUNT(id) as row_count FROM vw_tbl_incident _incident WHERE id IS NOT NULL".$sql);
		
	$query->set_params($params);	
	$query->query();
	$rows_ob = $query->get_line_object();
	$rows = $rows_ob->row_count; 
	
	// This is the number of results displayed per page 
	$page_rows = PAGE_ROWS; 
	
	// This tells us the page number of our last page 
	$last = ceil($rows / $page_rows); 
	
	// Seeing if the current page we are on is the last
	if (($query_request->get_page_number() > $last) && ($last > 0)) { $query_request->set_page_number($last); }
	
	//This sets the range to display in our query 
	$max = ($query_request->get_page_number() - 1) * $page_rows;
	
	// MSSQL doesnt have LIMIT like MYSQL. We'll use a sub query 
	// and TOP to get the same effect.	 	
	$query->set_sql("SELECT TOP(?) time, type_label, facility_label, area_label, email, name_l, name_f, id FROM vw_tbl_incident _incident WHERE id NOT IN (SELECT TOP(?) id FROM vw_tbl_incident ORDER BY id DESC)".$sql." ORDER BY time DESC");
	
	$params = array_merge(array(&$page_rows, &$max), $params);
	$query->set_params($params);
	$query->query();
	
	$query->get_line_params()->set_class_name('class_incident');
	$incidents = $query->get_line_object_all();	
	
	// Paging controls
	$page_nav = NULL;
	
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
                        <caption></caption>
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Name</th> 
                                <th class="NoPrint">Action</th>
                            </tr>
                        </thead>
                        <tfoot></tfoot>
                        <tbody>                   
							<?php								
                                foreach($incidents as $incident)
                                {                                                
                            ?>
                                    <tr>
                                        <td><?php echo date(DATE_FORMAT, $incident->get_time()->getTimestamp()); ?></td>
                                        <td><?php echo $incident->get_type_label(); ?></td>
                                        <td><?php echo ucwords(strtolower($incident->get_facility_label())).', '.$incident->get_area_label(); ?></td>
                                        <td><a mailto="<?php echo $incident->get_email(); ?>"><?php echo $incident->get_name_l().', '.$incident->get_name_f(); ?></a></td>                                    	<td class="NoPrint"><a href="details.php?id=<?php echo $incident->get_id(); ?>" target="new">Details</a></td>
                                    </tr>                                            
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    
                    <?php echo '<span class="NoPrint">'.$page_nav.'</span>'; ?>
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