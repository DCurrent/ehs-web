<?php

	define('DEPARMENT', '3he%');

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	require('../../libraries/php/classes/database/main.php'); 	// Database class.

	// Verify user authorization and get account info.
	$oAcc->access_verify(NULL, 'rdeldr0, dwhibb0');

	$db			= NULL;	// Database object.
	$query		= NULL;	// Query object.
	$markup		= NULL; // Result markup.
	$options	= NULL;	// Option output object.
	$dialog		= NULL;	// Msg to user.	

	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);	
	
	$query->set_sql("SELECT id, name_l, name_m, name_f FROM tbl_staff WHERE department LIKE ? ORDER BY name_l, name_f");
	$query->set_params(array(DEPARMENT));
	$query->query();
	
	$staff_line_all = $query->get_line_object_all();
	
	foreach($staff_line_all as $staff_line)
	{
		$staff_ehs_options .= '<option value="'.$staff_line->id.'">'.$staff_line->name_l.', '.$staff_line->name_f.' '.$staff_line->name_m.'</option>';
	}
	
	$query->set_sql("SELECT id, name_l, name_m, name_f FROM tbl_staff WHERE (department NOT LIKE ? OR department IS NULL) ORDER BY name_l, name_f");
	$query->set_params(array(DEPARMENT));
	$query->query();
	
	$staff_line_all = $query->get_line_object_all();
	
	foreach($staff_line_all as $staff_line)
	{
		$staff_nonehs_options .= '<option value="'.$staff_line->id.'">'.$staff_line->name_l.', '.$staff_line->name_f.' '.$staff_line->name_m.'</option>';
	}
	
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        <link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />    
        <link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
                
        <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    	<script src="../../libraries/jquery/tablesorter/jquery.tablesorter.js"></script>  
        <style>
			.cmd_menu
			{
				width: 100px;
			}
			
			fieldset label, .label
			{
				float:none;
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
                </div><!--/SubNavigation-->
                <div id="content">
          		<datalist id="category_list">
                	<?php echo $category_list; ?>
                </datalist>
                	
                	<h1>Staff Administration</h1> 
                    
                    <h3>Hello ***** what would you like to do?</h3>
                    
                    <form method="post">
                    	<fieldset>
                        	<legend>Staff</legend>	
                            <p>
                            	<button name="details_new" id="details_new" class="cmd_menu">Add</button>
                                <label for="details_new">Add a new staff member to the roster.</label>
                            </p>
                       	  	<p>
                            	<button type="submit" name="list" id="list" class="cmd_menu" formaction="list.php">List</button>
                              	<label for="list">View the complete staff roster.</label>
                          	</p>
                          
                          	<p>
                              	<button type="submit" name="publish" id="publish" class="cmd_menu" formaction="staffroll.php" formtarget="_new">Publish</button>
                              	<label for="publish">Create a printable staff manifest.</label>
                          	</p>
                            <p>
                            	<button name="details" id="details" class="cmd_menu">Details / Edit</button>
                            	<select name="details_id" id="details_id">
                                    <optgroup label="EHS">
                                        <?php echo $staff_ehs_options ?>
                                    </optgroup>
                                    <optgroup label="Non EHS">
                                        <?php echo $staff_nonehs_options; ?>
                                    </optgroup>
                                </select>
                                <label for="details">View and edit staff member details.</label>
                        	</p>
                        </fieldset>
                                                
                        <fieldset>
                        	<legend>Keys</legend>
                        	<button type="submit" name="key" id="key" class="cmd_menu" formaction="keys.php">View / Edit</button>
                            <label for="key">View and edit the list of available keys.</label>
                        </fieldset>
                    </form>				                              
               		
        		</div><!--/content-->       
            </div><!--subContainer-->    
            <div id="sidePanel">		
            	<?php include($cDocroot."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--/container-->
        
        <div id="footerPad">
        	<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--/footerPad-->
        <script>
			$(document).ready(function() 
				{ 
					$("#table_obj").tablesorter( {sortList: [[1,0]], headers: {3: {sorter: false}} } ); 
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