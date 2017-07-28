<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	require('../../../libraries/php/classes/database/main.php'); 	// Database class.

	class rooms
	{
		private
			$barcode 		= NULL,
			$facility		= NULL,
			$floor			= NULL,
			$room 			= NULL,			
			$useage			= NULL,
			$useage_desc	= NULL;
			
		
		public function __construct()
		{	
		}
		
		// Accessors
		public 
						
			function barcode()
			{
				return $this->barcode;
			}
			
			function facility()
			{
				return $this->facility;
			}
			
			function floor()
			{
				return $this->floor;
			}
			
			function room()
			{
				return $this->room;
			}
			
			function useage()
			{
				return $this->useage;
			}
			
			function useage_desc()
			{
				return $this->useage_desc;
			}
	}

	$db			= NULL;	// Database object.
	$query		= NULL;	// Query object.
	$markup		= NULL; // Result markup.

	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);	
	
	// Create table row markup.
	// Set SQL and parameter string.	
	$query->set_sql('SELECT TOP 100 * FROM vw_uk_space_room');
	$query->query();	
	
	$query->get_line_params()->set_class_name('rooms');
	
	// Rows found in database?
	if($query->get_row_exists() === TRUE)
	{		
		// Get the 2D array of rows/columns.
		$line_object = $query->get_line_object_all();			
		
		foreach($line_object as $row)
		{
			//$row->room() = str_replace('&', '&amp;', $row->name);
			
			// Insert table row.
			$markup .= '<tr>';
			
			// Individual fields.
			$markup .= '<td>'.$row->barcode().'</td>';
			$markup .= '<td>'.$row->facility().'</td>';
			$markup .= '<td>'.$row->floor().'</td>';
			$markup .= '<td>'.$row->room().'</td>';
			$markup .= '<td>'.$row->useage().'</td>';
			$markup .= '<td>'.$row->useage_desc().'</td>';
				
			$markup .= '</tr>'.PHP_EOL;
		}				
	}
	else
	{
		$markup = '<h2 class="color_red">No Records</h2>';
	}

?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        <link rel="stylesheet" href="../../../libraries/css/style.css" type="text/css" />    
        <link rel="stylesheet" href="../../../libraries/css/print.css" type="text/css" media="print" />
        <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    	<script src="../../../libraries/jquery/tablesorter/jquery.tablesorter.js"></script>    
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
                </div>
                <div id="content">
                    <div id="container_table_obj" class="overflow">
                    	<table id="table_obj" class="tablesorter">
                        	<thead>
                            	<tr>
                                	<th>Barcode</th>
                                    <th>Facility</th>
                                    <th>Floor</th>
                                    <th>Room</th>
                                    <th>Usage</th>
                                    <th>Usage Desc</th>
                                </tr>
                            </thead>
                            
                            <tfoot>
                            	<tr>
                                	<th colspan="6"><a href="#table_obj">Back to top</a></th>
                                </tr>
                            </tfoot>
                            
                    		<tbody>                    			
                  				<?php echo $markup; ?>
                  			</tbody>
                        </table>
                    </div><!--/container_table-->
                <a href="../../../objcodes_admin.php" class="small">Administration</a> </div><!--/content-->       
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
					$("#table_obj").tablesorter( {sortList: [[1,0]]} ); 
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