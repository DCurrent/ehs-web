<?php 

	abstract class PATH
	{		
		const ROOT = '../';
		const PARENT = '../fire/';
	}

	abstract class PARAM
	{
		const PUBLIC_YES = TRUE;
		const DURATION	= 365;	
	}
	
	$db			= NULL;	// Database object.
	$query		= NULL;	// Query object.
	$line_all	= NULL;	// Line object array.
	$line		= NULL;	// Line object.
	
	require(PATH::ROOT.'libraries/php/classes/database/main.php'); 	// Database class.
			
	// Initialize database connection and query objects.
	$db		= new class_db_connection();		
	$query	= new class_db_query($db);	
	
	// Prepare query string, parameters and then execute query.
	$query->set_sql("SELECT CONVERT(VARCHAR(19), dbo.tbl_fire_alarm.date_rcvd, 120) AS 'time', 
							UKSpace.dbo.MasterBuildings.BuildingName AS 'location', 
		                    dbo.tbl_fire_alarm.public_desc as 'desc'		                    
				
				FROM         dbo.tbl_fire_alarm LEFT OUTER JOIN
                
						      UKSpace.dbo.MasterBuildings ON dbo.tbl_fire_alarm.building_id = UKSpace.dbo.MasterBuildings.BuildingCode
				
				WHERE     (dbo.tbl_fire_alarm.public_display = ? AND DATEDIFF(DD, dbo.tbl_fire_alarm.date_rcvd, GETDATE()) <= ?)
				ORDER BY dbo.tbl_fire_alarm.date_rcvd DESC");

	$query->set_params(array(PARAM::PUBLIC_YES, PARAM::DURATION));	
	$query->query();
	
	// Populate line object array.
	$line_all = $query->get_line_object_all();	
	
?>

<!DOCtype html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<title>UK - Environmental Health And Safety, Campus Fire Log</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" />
    	<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />    
    	<link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
    	
        <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script> 
        <script src="../libraries/jquery/tablesorter/jquery.tablesorter.js"></script>   	
    </head>
    
    <body>    
        <div id="container">
            <div id="mainNavigation">
                <?php include(PATH::ROOT."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            <div id="subContainer">
                <?php include(PATH::PARENT."a_banner_0001.php"); ?>
                <div id="subNavigation">
                    <?php include(PATH::PARENT."a_subnav_0001.php"); ?> 
                </div><!--/subNavigation-->
                <div id="content">
                    <h1>Campus Fire Log</h1>
                    
                  	<?php 
					
						if(count($line_all) > 0)
						{
						?>
                        	<div id="container_table_obj" class="overflow">
                                <table id="table_fire" class="tablesorter">
                                    <colgroup>                                    	
                                        <col span="2" style="width:20%">                                    	
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Location</th>
                                            <th>Description</th>                                        
                                        </tr>
                                    </thead>
                                    <tfoot>
                                    	<tr>
                                        	<th colspan="3"><a href="#table_fire">Back to top</a></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
										<?php	
                                        foreach($line_all as $line)
                                        {
                                        ?>
                                            <tr>
                                                <td><?php echo $line->time; ?></td>
                                                <td><?php echo ucwords(strtolower($line->location)); ?></td>
                                                <td><?php echo $line->desc; ?></td>
                                            </tr>	
                                        <?php	
                                        }
                                        ?>
                                    </tbody>
                                </table>
                        	</div>
						<?php	
						}
						else
						{
						?>
							No fire incidents.
						<?php
                        }
					
					?>
                    
                    
                </div><!--/content-->
            </div><!--/subContainer-->    
            <div id="sidePanel">		
                <?php include(PATH::PARENT."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            <div id="footer">
                <?php include(PATH::ROOT."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--/container-->
        
        <div id="footerPad">
            <?php include(PATH::ROOT."libraries/includes/inc_footerpad.php"); ?>
        </div><!--/footerPad-->
    <script>
	$(document).ready(function() 
		{ 
			$("#table_fire").tablesorter({ 
				sortInitialOrder: 'desc',
				sortList: [[0,1]],
				headers: {2: {sorter: false}},
			});
			 
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

