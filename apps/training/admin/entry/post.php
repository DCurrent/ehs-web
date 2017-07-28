<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
	require('../../../../libraries/php/classes/database/main.php');
	
	class post
	{
		public $department 			= NULL;
		public $status 				= NULL;
		public $supervisor_name_f 	= NULL;
		public $supervisor_name_l 	= NULL;
		public $name_f 				= NULL;
		public $name_l 				= NULL;
		public $account 			= NULL;
		public $taken 				= NULL;
		public $class 				= NULL;
		public $trainer 			= NULL;
		public $room 				= NULL;
		public $etrax 				= NULL;
		public $email 				= NULL;
		public $phone 				= NULL;
		
		public function __construct() 
		{		
			// Interate through each class variable.
       		foreach($this as $key => $value) 
			{			
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the post value. 
				if(isset($_POST[$key]))
				{					
					$this->$key = $_POST[$key];           						
				}
			}	
	 	}	
	}

	class mail_head
	{
		public $from	= NULL;
		public $to		= NULL;
		public $subject = NULL;
	}

	// User authorization	
	$oAcc->access_verify();

	$list_id	= NULL;	// Class listing ID.
	$class_id	= NULL;	// Class ID.
	$p_id		= NULL;	// Participant ID.
	$listing_id	= NULL;	// Class listing ID.
	$db 		= NULL;	// Database object.
	$query		= NULL;	// Query object.
	$mail_head	= NULL;	// Mailing header info.
	$line		= NULL;	// Line object.
	$line_all	= NULL;	// Array of line objects.
	$post 		= new post();	// Post object.

	$db 	= new class_db_connection();
	$query 	= new class_db_query($db);
			
	// Build query string.
	$query->set_sql("MERGE INTO tbl_class_participant
		USING 
			(SELECT ? AS Search_Col) AS SRC
		ON 
			tbl_class_participant.account = SRC.Search_Col
		WHEN MATCHED THEN
			UPDATE SET
				name_l				= ?,
				name_f				= ?,									
				room				= ?,
				status				= ?,									
				department			= ?,
				supervisor_name_f	= ?,
				supervisor_name_l	= ?
		WHEN NOT MATCHED THEN
			INSERT (account, name_l, name_f, room, status, department, supervisor_name_f, supervisor_name_l)
			VALUES (SRC.Search_Col, ?, ?, ?, ?, ?, ?, ?)
			OUTPUT INSERTED.id;");		
		
	// Apply parameters.
	$query->set_params(array(&$post->account,
					&$post->name_l,
					&$post->name_f,
					&$post->room,
					&$post->status,
					&$post->department,
					&$post->supervisor_name_f,
					&$post->supervisor_name_l,
					&$post->name_l,
					&$post->name_f,
					&$post->room,
					&$post->status,						
					&$post->department,
					&$post->supervisor_name_f,
					&$post->supervisor_name_l));	
					
	// Execute query.	
	$query->query();
	
	// Get ID of created/updated record.
	$p_id = $query->get_line_object()->id;
	
	// 	User demographics have now been found or inserted. Now we will deal with class type, instructor and time.
	$query->set_sql("INSERT INTO	tbl_class
	
							(class_type,
							trainer_id,
							class_date)
				OUTPUT INSERTED.class_id
							VALUES	(?, ?, ?)");	
	
	$query->set_params(array(&$post->class,
		&$post->trainer,
		&$post->taken));
					
	// Execute query.	
	$query->query();
	
	// Get ID of new record.		
	$class_id = $query->get_line_object()->class_id;
	
				
	// Insert newly created id and participant id to class listing table.		
	$query->set_sql("INSERT INTO tbl_class_listing
	
							(participant_id,
							class_id)
				OUTPUT INSERTED.id
							VALUES (?, ?)");	
	
	$query->set_params(array(&$p_id,
					&$class_id));
					
	// Execute query.
	$query->query();
	
	// Get ID of new record.	
	$list_id =  $query->get_line_object()->id;
			
	$query->set_sql("SELECT
				id, 
				desc_title,																
				class_date_char,																		
				trainer_name,															
				cert_link																						
				FROM vw_class_participant_list
				WHERE (account = ?)
				ORDER BY class_date desc, id desc");	
	
	$query->set_params(array(&$post->account));
	$query->query();
	$line_all = $query->get_line_object_all();	

?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../../../../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../../../../libraries/css/print.css" type="text/css" media="print" />
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>        
        
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
                </div><!--/subNavigation-->
                <div id="content">
                	<h1>Manual Results</h1>                 	
                  		                
                        <p>
                        	<?php 
								if($list_id)
								{
									echo '<h4 class="color_green">Entry succeeded for '.$post->name_f.' '.$post->name_l.'. Record number assigned is: '.$list_id.'.</h4>';
								}
								else
								{
									echo '<h4 class="color_red">Entry failed!</h4>';
								}									
							?>
                        </p>
                        
						<?php 
						if($query->get_row_exists())
						{
						?>
                            <h2>Current Records</h2>
                            
                            <table class="block" id="table_results">
                                                  
                            <colgroup>
                                <col class="cell_name">                            
                            </colgroup>
                            
                            <thead>
                                <tr>
                                    <th>Class</th>
                                    <th>Taken</th>
                                    <th>Trainer</th>
                                    <th>Record ID</th>                                
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php
                                foreach($line_all as $line)
                                {									
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $line->desc_title ?>                                            
                                        </td>
                                        <td>
                                            <?php echo $line->class_date_char; ?>
                                        </td>
                                        <td>
                                            <?php echo $line->trainer_name; ?>
                                        </td>
                                        <td>                                                                       	  
                                            <?php echo $line->id; ?>                                       
                                        </td>
                                    </tr>
                                <?php
                                }							
                                ?>
                            </tbody>
                            
                            <tfoot>                                
                            </tfoot>                        
                        </table>   
                    <?php
					}
					?>                        	       			
               	</div><!--/content-->
            </div><!--/subContainer-->
            <div id="sidePanel">		
				<?php include($cDocroot."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--container-->
        
        <div id="footerPad">
        	<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--/footerPad-->
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

