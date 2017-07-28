<?php 
	function mark($value)
	{
		$result = NULL;
		
		if($value === 1)
		{
			$result = '<span class="color_green">&#x2714;</span>';
		}
		else
		{
			$result = '<span class="color_red">&#x2718;</span>';
		}
		
		return $result;
	}

	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/config.php'); //Basic configuration file.
	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/database/main.php'); 	// Database class.
		
	$db		= NULL;	// Database object.
	$query	= NULL;	// Query object.
	$markup	= NULL; // Result markup.
	$line_dept = NULL;	// Department line object.
	$department = NULL;	// Completed department string.	
	
	$oAcc->access_verify();
		
	// Initialize post and get from standard object.
	$post = (object)$_POST;
	$get  = (object)$_GET;
		
	// Initialize DB connection and query objects.
	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);	
	
	//Let's give some post items defaults.
	if(!property_exists($post, 'instructor')) $post->instructor = 2;
	if(!property_exists($post, 'active')) $post->active = 2;
	if(!property_exists($post, 'department')) $post->department = NULL;
	
	$sqlAdd = NULL;
	$params = array(&$post->active, 
		&$post->active,
		&$post->instructor,
		&$post->instructor);
	
	if(is_array($post->department) === TRUE)
	{	
		/* Build parameter string insert for query. */
		$sqlAdd = " AND (department IN (".str_repeat('?,', count($post->department) - 1). '?'."))";
		
		/* Merge into parameter array. */
		$params = array_merge($params, $post->department);	
		$params = array_merge($params, array(NULL));
	}
	
	// Set SQL and parameter string.	
	$query->set_sql('SELECT 
						id,
						account,
						name_f,
						name_l,
						department,
						title,
						active,
						instructor,
						email								
						FROM tbl_staff											
						
						WHERE (active = ? OR ? = 2)
						AND	(instructor = ? OR ? = 2)'
						
						.$sqlAdd.
						
						'ORDER BY name_l');
	
	$query->set_params($params);	

	// Execute query.
	$query->query();
	
	$line_all_staff = $query->get_line_object_all();
	
	
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>             
        <script src="../../libraries/javascript/options_update.js"></script>
        <script src="../../libraries/jquery/tablesorter/jquery.tablesorter.js"></script>       
    </head>
    
    <body>    
        <div id="container">
            
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--#mainNavigation-->
            
            <div id="subContainer">
                <div id="banner_container" class="banner_container">	
                    <div id="banner_content" class="banner">
                        <a href="./" class="no_icon">EHS Staff Administration</a>
                        <h1>Staff List</h1>
                        <div id="banner_slogan" class="slogan">                        	
                        </div><!--#banner_slogan-->
                    </div><!--#banner_content-->
                </div><!--#banner_container-->
                <div id="subNavigation">
                    <?php include($cDocroot."a_subnav_0001.php"); ?> 
                </div><!--#SubNavigation-->               
                <div id="content">
                
                	<form name="frm_filter" id="frm_filter" method="post">
                   	  <fieldset>
                        	<legend>Filter</legend>
                            <span class="label">Active</span>
                            
                            <div class="fieldset_box">
                              <input type="radio" name="active" id="active_1" value="1" <?php if($post->active == 1) echo "checked"; ?> />
                              <label for="active_1"><span class="color_green">&#x2714;</span></label>
                                                            
                              <input type="radio" name="active" id="active_0" value="0" <?php if($post->active == 0) echo "checked"; ?> />                          
                              <label for="active_0"><span class="color_red">&#x2718;</span></label>
                                
                              <input type="radio" name="active" id="active_-1" value="2" <?php if($post->active == 2) echo "checked"; ?> />                          
                              <label for="active_-1">All</label>
                            </div>
                            
                            <span class="label">Instructor</span>
                        	<div class="fieldset_box" style="display:block">
                          		<input type="radio" name="instructor" id="instructor_1" value="1" <?php if($post->instructor == 1) echo "checked"; ?> />
                                <label for="instructor_1"><span class="color_green">&#x2714;</span></label>
                                                            
                          		<input type="radio" name="instructor" id="instructor_0" value="0" <?php if($post->instructor == 0) echo "checked"; ?> />                          
                                <label for="instructor_0"><span class="color_red">&#x2718;</span></label>
                                
                          		<input type="radio" name="instructor" id="instructor_-1" value="2" <?php if($post->instructor == 2) echo "checked"; ?> />                          
                                <label for="instructor_-1">All</label>
                          	</div>                           
                           
                        	<div style="clear: both; padding-top:5px;">
                                
                                <p id="department_progress" class="load color_red center">
                                    Loading Departments...
                                    <img name="img_department_load_progress" id="img_department_load_progress" src="/media/image/meter_bar.gif" alt="Loading items... " title="Loading items..." />
                                </p>
                                                                
                                <label for="department">Department</label>
                                <select name="department[]" id="department" form="frm_filter" data-current="<?php if($post->department) echo implode($post->department, ','); ?>" data-source-url="../../libraries/inserts/department.php" data-grouped="1" data-sql_from="1" size="6" multiple>                                    
                                    <!--Options will be populated on load via jquery.-->								
                                </select>                                
                        	</div>
                            </fieldset>
                        
                        <button type="submit" name="filter_sub" id="filter_sub" value="1">Filter</button>                        
                        
                    </form>
                
                	<table class="block" id="table_staff">
                                              
                        <colgroup>
                            <col class="cell_name">
                            <col class="cell_department">
                            <col class="cell_title">
                            <col class="cell_active">
                            <col class="cell_instructor">
                            <col class="cell_record">
                        </colgroup>
                        
                        <thead>
                        	<tr>
                            	<th>Name</th>
                                <th>Department</th>
                                <th>Title</th>
                                <th>Active</th>
                                <th>Trainer</th>
                                <th>Record</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php 
							if($query->get_row_exists())
							{
								foreach($line_all_staff as $line_staff)
								{
									// Default to account if email missing.
									if(!$line_staff->email)
									{
										$line_staff->email = $line_staff->account .'@uky.edu';
									}
									
									$query->set_sql('SELECT	name FROM vw_uk_space_department WHERE number = ?');
									$query->set_params(array(&$line_staff->department));
									$query->query();
									
									$line_dept = $query->get_line_object();
									
									if($query->get_row_exists() === TRUE)
									{
										$department = ucwords(strtolower($line_dept->name)).' ('.$line_staff->department.')';
									}
									else
									{
										$department = NULL;
									}
								?>
									<tr>
										<td>
											<a href="mailto:<?php echo $line_staff->email; ?>">
												<?php echo $line_staff->name_l.', '.$line_staff->name_f; ?>                                         
											</a>
										</td>
										<td>
											<?php echo $department; ?>
										</td>
										<td>
											<?php echo $line_staff->title; ?>
										</td>
										<td class="center">                                                                       	  
											<?php echo mark($line_staff->active); ?>                                       
										</td>
										<td class="center">                                    	  
											<?php echo mark($line_staff->instructor); ?>                                       
										</td>
										<td>
											<a href="details.php?id=<?php echo $line_staff->id; ?>" title="Edit record or view details">Details</a>
										</td>
									</tr>
								<?php
								}
							}
                            ?>
                        </tbody>
                        
                        <tfoot>                                
                        </tfoot>                        
                    </table>                   
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
		$(document).ready(function(event) 
			{ 
				options_update(event, null, '#department');
				$("#table_staff").tablesorter( {sortList: [[0,0]], headers: {5: {sorter: false}} } ); 
			} 
		);
		
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40196994-1', 'uky.edu');
  ga('send', 'pageview');

</script>
</body>
</html>