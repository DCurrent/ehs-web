<?php
	
	abstract class DEFAULTS
	{	
		// General defaults.
	
		const 
			PHONE_TYPE		= 1,
			PHONE_DISPLAY	= 0,	
			PRECISION		= 2;
	}
	
	// Generic get data.
	class get
	{
		public $id = NULL;
		
		public function __construct() 
		{		
			// Interate through each class variable.
       		foreach($this as $key => $value) 
			{			
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the post value. 
				if(isset($_GET[$key]))
				{					
					$this->$key = $_GET[$key];           						
				}
			}	
	 	}
	}
	
	// Generic post data
	class post
	{
		// Commands
		public $cmd_nav			= NULL;
		public $btn_save		= NULL;
		public $phone_save 		= NULL;
		public $phone_delete	= NULL;
		public $key_save		= NULL;
		public $key_delete		= NULL;
		public $sal_save		= NULL;
		public $sal_delete		= NULL;
		
		// Detail values.
		public $name_f			= NULL;
		public $name_m			= NULL;
		public $name_l			= NULL;
		public $title			= NULL;
		public $active			= NULL;
		public $instructor		= NULL;
		public $listing_order	= NULL;
		public $department		= NULL;
		public $status			= NULL;
		public $email			= NULL;
		public $dob				= NULL;
		public $memo			= NULL;
		public $sig_image		= NULL;	
		
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
	
	// Key post data.
	class key_post
	{						
		public $key 	= NULL;
		public $memo 	= NULL;
		
		private $postkey = NULL;
		
		public function __construct($id = NULL) 
		{		
			// Interate through each class variable.
			foreach($this as $varkey => $value) 
			{	
				$this->postkey = 'key_'.$varkey.'_'.$id;
						
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the post value. 
				if(isset($_POST[$this->postkey]))
				{					
					$this->$varkey = $_POST[$this->postkey];           						
				}
			}	
		}
	}
	
	// Phone post data.
	class phone_post
	{						
		public $type 	= NULL;
		public $number 	= NULL;
		public $display	= NULL;
		public $publish = NULL;
		
		private $postkey = NULL;
		
		public function __construct($id = NULL) 
		{		
			// Interate through each class variable.
			foreach($this as $varkey => $value) 
			{	
				$this->postkey = 'phone_'.$varkey.'_'.$id;			
					
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the post value. 
				if(isset($_POST[$this->postkey]))
				{										
					$this->$varkey = $_POST[$this->postkey];           						
				}
			}	
		}
	}
	
	// Salary post data.
	class sal_post
	{					
		public $year 			= NULL;
		public $grade 			= NULL;
		public $pe 				= NULL;
		public $salary			= NULL;
		public $service_date	= NULL;
		public $education 		= NULL;
		public $experience		= NULL;		
		
		private $postkey = NULL;
		
		public function __construct($id = NULL) 
		{		
			// Interate through each class variable.
			foreach($this as $varkey => $value) 
			{	
				$this->postkey = 'sal_'.$varkey.'_'.$id;
						
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the post value. 
				if(isset($_POST[$this->postkey]))
				{					
					$this->$varkey = $_POST[$this->postkey];           						
				}
			}
			
			// Empty date post would have been set 0 which gives us garbage 
			// date in MSSQL, let's make sure it's NULL.
			if(!$this->dob) $this->dob = NULL;	
		}
	}
	
	class dialog
	{
		// Output messages to user.
		
		public $phone 	= NULL;
		public $key		= NULL;
		public $sal		= NULL;
	}
		
	// Format number from +1xxxxxxxxx to xxx-xxx-xxxx.
	function localize_us_number_side_form($phone) 
	{
		$finished = NULL;
				
		$numbers_only = preg_replace("/[^\d]/", "", $phone);
		$finished = preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $numbers_only);
				
		return $finished;
	}
			
	// Generate options markup for phone types.
	function phone_type_options($source = NULL, $default = NULL, $current = NULL)
	{	
		$result = NULL;
	
		if($current == NULL)
		{
			$current = $default;
		}
	
		foreach($source as $object)
		{		
			if($object->id == $current)
			{
				$selected = 'selected';
			}
			else
			{
				$selected = NULL;
			}
			
			$result .= '<option value="'.$object->id.'" '.$selected.'>'.$object->type.'</option>'.PHP_EOL;											
		}
		
		return $result;
	}
	
	// Generate options markup for key selection.
	function key_number_options($source = NULL, $default = NULL, $current = NULL)
	{	
		$result = NULL;
	
		if($current == NULL)
		{
			$current = $default;
		}
	
		foreach($source as $object)
		{		
			if($object->id == $current)
			{
				$selected = 'selected';
			}
			else
			{
				$selected = NULL;
			}
			
			$result .= '<option value="'.$object->id.'" '.$selected.'>'.$object->number.' - '.$object->access.'</option>'.PHP_EOL;											
		}
		
		return $result;
	}
	
	require('../../libraries/php/classes/config.php'); //Basic configuration file.
	require('../../libraries/php/classes/database/main.php'); 	// Database class. 
	
	$get				= NULL;	// Get object.
	$post 				= NULL;	// Post object.
	$db					= NULL;	// Database connection object.
	$query				= NULL;	// Query object.
	$details_line		= NULL;	// Line object for main details.
	
	$title_line_all		= NULL;	// Array of line objects for title list.
	$title_line			= NULL;	// Line object for title list.	
	
	$nav_line			= NULL;	// Line object for navigation id button value inserts.
	
	$phone_line_count 	= NULL;	// Count of phone records.
	$phone_line_all		= NULL;	// Array of line objects for phone records.
	$phone_line			= NULL;	// Line object for phone records.
	$phone_input		= NULL; // Object for holding post values to insert into database.
	
	$key_line_count 	= NULL;	// Count of key records.
	$key_line_all		= NULL;	// Array of line objects for key records.
	$key_line			= NULL;	// Line object for key records.
	$key_input			= NULL; // Object for holding post values to insert into database.
	
	$sal_line_all		= NULL;	// Array of line objects for salary records.
	$sal_line			= NULL;	// Line object for salary records.
	$sal_input			= NULL; // Object for holding post values to insert into database.
	
	$keynum_line_all	= NULL;	// Array of line objects for key number.
	$keynum_line		= NULL;	// Line object for key number.
	
	$dialog				= NULL;	// Dialog object for sending output messages to user.
	$time				= date(DATE_FORMAT); // Current date/time.
	
	// Initialize user object and populate data.
	$oAcc->access_verify();	
	
	// Initialize dialog object.
	$dialog = new dialog();
	
	// Initialize post and get from standard object.
	$post = new post;
	$get  = new get;

	// Initialize DB connection and query objects.
	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);	
	
	if($post->btn_save)
	{
		// Save the main details.		
		
		// Let's set up an UPSERT query so the database will add a new record or update
		// an existing one as needed.
		$query->set_sql("MERGE INTO tbl_staff
			USING 
				(SELECT ? AS Search_Col) AS SRC
			ON 
				tbl_staff.id = SRC.Search_Col
			WHEN MATCHED THEN
				UPDATE SET
					account				= ?,									
					name_f				= ?,
					name_m				= ?,									
					name_l				= ?,
					title				= ?,
					active				= ?,
					instructor			= ?,
					listing_order		= ?,
					department			= ?,
					status				= ?,
					email				= ?,
					dob					= ?,
					memo				= ?,
					sig_image			= ?,
					log_update			= ?,
					log_update_account	= ?,
					log_update_ip		= ?
			WHEN NOT MATCHED THEN
				INSERT (account, name_f, name_m, name_l, title, active, instructor, listing_order, department, status, email, dob, memo, sig_image, log_update, log_update_account, log_update_ip)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
				OUTPUT INSERTED.id;");
				
		$query->set_params(array(&$get->id,
			&$post->account,
			&$post->name_f,
			&$post->name_m,
			&$post->name_l,
			&$post->title,
			&$post->active,
			&$post->instructor,
			&$post->listing_order,
			&$post->department,
			&$post->status,
			&$post->email,
			&$post->dob,
			&$post->memo,
			&$post->sig_image,
			&$time,
			$oAcc->get_account(),
			$oAcc->get_ip(),
			&$post->account,
			&$post->name_f,
			&$post->name_m,
			&$post->name_l,
			&$post->title,
			&$post->active,
			&$post->instructor,
			&$post->listing_order,
			&$post->department,
			&$post->status,
			&$post->email,
			&$post->dob,
			&$post->memo,
			&$post->sig_image,
			&$time,
			$oAcc->get_account(),
			$oAcc->get_ip()));
			
		$query->query();
	}
	else if($post->phone_save)
	{	
		// Save phone number.
		
		// Initialize object to get $_POST values.
		$phone_input = new phone_post($post->phone_save);				
		
		// Convert NULL/True to bit values.		
		$phone_input->display	= $phone_input->display ? 1 : 0;
		$phone_input->publish	= $phone_input->publish ? 1 : 0;
		
		// Add number to user dialog before we sanitize it so the number looks like user expects. 
		// We'll add finishing text depending on results of the sanitize attempt.
		$dialog->phone = 'Number '.$phone_input->number;
		
		// Next, we need to sanitize the number to remove non numeric characters, and add the 1.
		$phone_input->number = '1' . preg_replace('/[^0-9]/', '', $phone_input->number);
		
		// After sanitizing and adding country code, do we have 11 numbers?
		if(strlen($phone_input->number) === 11) 
		{
			//Phone is 10 characters in length (###) ###-####
			
			$query->set_sql("MERGE INTO tbl_staff_phone
			USING 
				(SELECT ? AS Search_Col) AS SRC
			ON 
				tbl_staff_phone.id = SRC.Search_Col
			WHEN MATCHED THEN
				UPDATE SET
					fk_id				= ?,									
					type				= ?,
					number				= ?,									
					display				= ?,
					publish				= ?,
					log_update			= ?,
					log_update_account	= ?,
					log_update_ip		= ?										
			WHEN NOT MATCHED THEN
				INSERT (fk_id, type, number, display, publish, log_update, log_update_account, log_update_ip)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?)
				OUTPUT INSERTED.id;");
				
			$query->set_params(array(&$post->phone_save,
				&$get->id,
				&$phone_input->type,
				&$phone_input->number,
				&$phone_input->display,
				&$phone_input->publish,
				&$time,
				$oAcc->get_account(),
				$oAcc->get_ip(),
				&$get->id,
				&$phone_input->type,
				&$phone_input->number,
				&$phone_input->display,
				&$phone_input->publish,
				&$time,
				$oAcc->get_account(),
				$oAcc->get_ip()
				));
				
			$query->query();
			
			// Finish up dialog.
			$dialog->phone = '<span class="color_green">'.$dialog->phone.' saved.</span>';		
		}
		else
		{
			// Sanitizing failed to produce an 11 digit number. Set dialog to alert user 
			// that nothing was saved.
			$dialog->phone = '<span class="color_red">'.$dialog->phone.' could not be saved. Make sure to input a ten digit US phone number (xxx-xxx-xxxx).</span>';			
		}		
	}
	else if($post->phone_delete)
	{
		// Delete a phone number.
		
		// Let's build a dialog to alert the user.
		$dialog->phone = '<p class="color_orange">Number '.$_POST['phone_number_'.$post->phone_delete].' deleted.</p>';
		
		// Now set up and run the delete query.
		$query->set_sql("DELETE FROM tbl_staff_phone WHERE id = ?;");
		$query->set_params(array(&$post->phone_delete));				
		$query->query();
	}
	else if($post->key_save)
	{	
		// Save key.
	
		// Initialize object to get $_POST values.
		$key_input = new key_post($post->key_save);				
		
		$query->set_sql("MERGE INTO tbl_staff_key
		USING 
			(SELECT ? AS Search_Col) AS SRC
		ON 
			tbl_staff_key.id = SRC.Search_Col
		WHEN MATCHED THEN
			UPDATE SET
				fk_id				= ?,									
				key_id				= ?,
				memo				= ?,									
				log_update			= ?,
				log_update_account	= ?,
				log_update_ip		= ?										
		WHEN NOT MATCHED THEN
			INSERT (fk_id, key_id, memo, log_update, log_update_account, log_update_ip)
			VALUES (?, ?, ?, ?, ?, ?)
			OUTPUT INSERTED.id;");
			
		$query->set_params(array(&$post->key_save,
			&$get->id,
			&$key_input->key,
			&$key_input->memo,
			&$time,
			$oAcc->get_account(),
			$oAcc->get_ip(),
			&$get->id,
			&$key_input->key,
			&$key_input->memo,
			&$time,
			$oAcc->get_account(),
			$oAcc->get_ip()
			));
			
		$query->query();
		
		// Finish up dialog.
		$dialog->key = '<p class="color_green">Key saved.</p>';		
	}
	else if($post->key_delete)
	{
		// Delete a key number.
		
		// Let's build a dialog to alert the user.
		$dialog->key = '<p class="color_orange">Key deleted.</p>';
		
		// Now set up and run the delete query.
		$query->set_sql("DELETE FROM tbl_staff_key WHERE id = ?;");
		$query->set_params(array(&$post->key_delete));				
		$query->query();
	}
	else if($post->sal_save)
	{
		// Save the salary.	
		
		// Initialize object to get $_POST values.
		$sal_input = new sal_post();
		
		$query->set_sql("MERGE INTO tbl_staff_salary
		USING 
			(SELECT ? AS Search_Col) AS SRC
		ON 
			tbl_staff_salary.id = SRC.Search_Col
		WHEN MATCHED THEN
			UPDATE SET
				fk_id				= ?,									
				year				= ?,
				grade				= ?,
				pe					= ?,
				salary				= ?,
				service_date		= ?,
				education			= ?,
				experience			= ?,									
				log_update			= ?,
				log_update_account	= ?,
				log_update_ip		= ?										
		WHEN NOT MATCHED THEN
			INSERT (fk_id, year, grade, pe, salary, service_date, education, experience, log_update, log_update_account, log_update_ip)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
			OUTPUT INSERTED.id;");
			
		$query->set_params(array(&$post->sal_save,
			&$get->id,
			&$sal_input->year,
			&$sal_input->grade,
			&$sal_input->pe,
			&$sal_input->salary,
			&$sal_input->service_date,
			&$sal_input->education,
			&$sal_input->experience,
			&$time,
			$oAcc->get_account(),
			$oAcc->get_ip(),
			&$get->id,
			&$sal_input->year,
			&$sal_input->grade,
			&$sal_input->pe,
			&$sal_input->salary,
			&$sal_input->service_date,
			&$sal_input->education,
			&$sal_input->experience,
			&$time,
			$oAcc->get_account(),
			$oAcc->get_ip()
			));
			
		$query->query();
		
		// Finish up dialog.
		$dialog->sal = '<p class="color_green">Salary info saved.</p>';		
	}
	else if($post->sal_delete)
	{
		// Delete a salary entry.
		
		// Let's build a dialog to alert the user.
		$dialog->sal = '<p class="color_orange">Salary entry deleted.</p>';
		
		// Now set up and run the delete query.
		$query->set_sql("DELETE FROM tbl_staff_salary WHERE id = ?;");
		$query->set_params(array(&$post->sal_delete));				
		$query->query();
	}
	else if($post->cmd_nav)
	{
		// User pressed one of the navigation buttons. We'll use the button's value to 
		// find out which one it is and act accordingly.		
		$get->id = $post->cmd_nav;		
	}
	
	// Query for current details display using id from user ($get->id).
	// Once done, we won't need the $get->id any more since we can use 
	// value obtained from database.
	if($get->id)
	{
		$query->set_sql('SELECT * FROM tbl_staff WHERE id = ?');
		$query->set_params(array(&$get->id));
	}
	else
	{
		$query->set_sql('SELECT TOP 1 * FROM tbl_staff ORDER BY name_l, name_f');		
	}
	$query->query();
	$details_line = $query->get_line_object();	
	
	// Query for current phone numbers.
	$query->set_sql('SELECT * FROM tbl_staff_phone WHERE fk_id = ?');
	$query->set_params(array(&$details_line->id));
	$query->query();
	
	$phone_line_count = $query->get_row_exists();
	$phone_line_all = $query->get_line_object_all();
	
	// Query for current keys.
	$query->set_sql('SELECT * FROM tbl_staff_key WHERE fk_id = ?');
	$query->set_params(array(&$details_line->id));
	$query->query();
	
	$key_line_count = $query->get_row_exists();
	$key_line_all = $query->get_line_object_all();
	
	// Query for current salary info.
	$query->set_sql('SELECT * FROM vw_tbl_staff_salary WHERE fk_id = ?');
	$query->set_params(array(&$details_line->id));
	$query->query();
	
	$sal_line_count = $query->get_row_exists();
	$sal_line_all = $query->get_line_object_all();	
		
	// Query for title list.	
	$query->set_sql("SELECT DISTINCT title FROM tbl_staff WHERE title <> ''");
	$query->query();
	$title_line_all = $query->get_line_object_all();
	
	// Query for status list (Staff, Faculty, etc.).	
	$query->set_sql('SELECT id, status FROM tbl_UK_status');
	$query->query();
	$status_line_all = $query->get_line_object_all();
	
	// Query for phone number type (office, cell, home, etc.).
	$query->set_sql('SELECT id, type FROM tbl_staff_phone_type');
	$query->query();
	
	$phone_type_line_all = $query->get_line_object_all();
	
	// Query for key number (Key ID from key list).
	$query->set_sql('SELECT id, number, access FROM tbl_key');
	$query->query();
	
	$keynum_line_all = $query->get_line_object_all();
	
	// Query for navigation button values.
	if($details_line->id)
	{			
		$query->set_sql("WITH CTE AS (SELECT ROW_NUMBER() OVER (ORDER BY name_l, name_f) 
					AS row, id FROM tbl_staff)	
			SELECT
			(SELECT TOP 1 id FROM tbl_staff ORDER BY name_l + name_f) AS first_id,
			(SELECT TOP 1 id FROM tbl_staff ORDER BY name_l + name_f DESC) as last_id,
			
			prev.id prev_id,			
			nex.id next_id		
						
			FROM CTE
			LEFT JOIN CTE prev ON prev.row = CTE.row - 1
			LEFT JOIN CTE nex ON nex.row = CTE.row + 1
			WHERE CTE.id = ? OR ? = NULL");
		$query->set_params(array(&$details_line->id, &$details_line->id));
	}
	else
	{
		$query->set_sql("WITH CTE AS (SELECT 

				(SELECT TOP 1 id FROM tbl_staff ORDER BY name_l + name_f) AS first_id,
				(SELECT TOP 1 id FROM tbl_staff ORDER BY name_l + name_f DESC) as last_id,
			
			id FROM tbl_staff)
			
			SELECT TOP 1			
			
			CTE.first_id,			
			CTE.first_id prev_id,		
			CTE.last_id next_id,			
			CTE.last_id
					
			FROM CTE");
	}
	
	$query->query();
	$nav_line = $query->get_line_object();
?>
<!DOCtype html>
    <head>
        <title>
        	UK - Environmental Health & Safety, Staff
		</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" href="../../libraries/css/hint.css" />

        <style>
			#mainNavigation
			{
				padding-top:10px;
			}
			
			
			.cmd_record img
			{
				height:24px;
				width:24px;				
			}
			
			tr.new 
			{
				background-color:#0F9;	
			}
						
			.cell_fill
			{
				width:95%;
				margin:2px;
			}				
				
		</style>
        
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>  
        <script src="../../libraries/javascript/jquery_ui_timepicker_addon.js"></script>
		<script src="../../libraries/jquery/cookie/jquery.cookie.js"></script>      
        <script src="../../libraries/javascript/options_update.js"></script>
            
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
                        <h1>Details:
                        
                        	<?php 
                        
							if($details_line->id)
							{
								echo ' '.$details_line->name_f.' '.$details_line->name_l; 
							}
							else
							{
								echo ' <span class="color_green">New Record</span>';
							}
							?>
                        
                        </h1>
                        <div id="banner_slogan" class="slogan">
                        	<form name="frm_nav" id="frm_nav" method="post">                                                       
                                <button name="cmd_nav" id="first" form="frm_nav" type="submit" value="<?php echo $nav_line->first_id; ?>" class="nav_backward" title="Go to first record." >First</button>
                                <button name="cmd_nav" id="prev" form="frm_nav" type="submit" value="<?php echo $nav_line->prev_id; ?>" class="nav_backward" title="Go to previous record.">Previous</button>
                                <button name="cmd_nav" id="next" form="frm_nav" type="submit" value="<?php echo $nav_line->next_id; ?>" class="nav_forward" title="Go to next record.">Next</button>
                                <button name="cmd_nav" id="last" form="frm_nav" type="submit" value="<?php echo $nav_line->last_id; ?>" class="nav_forward" title="Go to last record.">Last</button>
                                <button name="cmd_nav" id="new" form="frm_nav" type="submit" value="-1">New</button>                	
                                <button name="cmd_nav" id="list" form="frm_nav" type="submit" value="1" formaction="list.php">List</button>
                           </form>
                        </div><!--#banner_slogan-->
                    </div><!--#banner_content-->
                </div><!--#banner_container-->
                <div id="subNavigation">
                    <?php include($cDocroot."a_subnav_0001.php"); ?> 
                </div><!--#SubNavigation-->
                <div id="content"> 
					                                                   
                    <form name="frm_details" id="frm_details" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$details_line->id; ?>">
                        <input type="hidden" name="id" id="id" value="<?php echo $details_line->id; ?>" />                                            	
                        
                        <fieldset id="fs_account"> 
                            <legend>Account</legend>
                                         
                            <label for="account">Link Blue</label>
                            <input type="text" name="account" id="account" form="frm_details" placeholder="Link Blue Account" value="<?php echo $details_line->account; ?>" />
                            
                            <label for="email">E-Mail</label>
                            <input type="text" name="email" id="email" form="frm_details" placeholder="Email Address" value="<?php echo $details_line->email; ?>" />
                        </fieldset>
    
                        <fieldset id="fs_name">
                            <legend>Name</legend>
                        
                            <label for="name_f">First</label>
                            <input type="text" name="name_f" id="name_f" form="frm_details" placeholder="First Name" value="<?php echo $details_line->name_f; ?>" />
                            
                            <label for="name_m">Middle</label>
                            <input type="text" name="name_m" id="name_m" form="frm_details" placeholder="Middle Name" value="<?php echo $details_line->name_m; ?>" /> 
                            
                            <label for="name_l">Last</label>
                            <input type="text" name="name_l" id="name_l" form="frm_details" placeholder="Last Name" value="<?php echo $details_line->name_l; ?>" />
                        </fieldset>
                        
                        <fieldset id="fs_role">
                            <legend>Role</legend>                 
                            <div>
                                <p id="department_progress" class="load color_red center">
                                    Loading Departments...
                                    <img name="img_department_load_progress" id="img_department_load_progress" src="../../media/image/meter_bar.gif" alt="Loading items... " title="Loading items..." />
                                </p>
                                <label for="department">Department</label>
                                <select name="department" id="department" form="frm_details" data-current="<?php echo $details_line->department; ?>" data-source-url="../../libraries/inserts/department.php" data-grouped="1" >
                                    <option value="">Select Department</option>
                                    <!--Options will be populated on load via jquery.-->								
                                </select>
                            </div>          	  	
                           
                            <div>
                                <datalist id="list_title">
                                  <?php
                                        foreach($title_line_all as $title_line)
                                        {										
                                            echo '<option>'.$title_line->title.'</option>';
                                        }
                                    ?>
                                </datalist>
                            
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" form="frm_details" placeholder="Title" list="list_title" value="<?php echo $details_line->title; ?>" />
                            </div>               
                                        
                            <div>                                  
                                <span class="label">Status</span>
                                <div class="fieldset_box">   
                                    
                                    <input type="radio" name="status" id="status_0" value="0" required <?php if(!$details_line->status) echo 'checked'; ?> />
                                    <label for="status_0">Unknown</label>
                                                                                    
                                    <?php								
                                        // Create a radio button for each UK status possibility, and marked it checked if its value matches main details status.
                                        foreach($status_line_all as $status_line)
                                        {										
                                            echo '<span style="white-space:nowrap;"><input type="radio" name="status" id="status_'.$status_line->id.'" value="'.$status_line->id.'" required';
                                            if($status_line->id == $details_line->status) echo ' checked';
                                            echo '/>'.PHP_EOL.'<label for="status_'.$status_line->id.'">'.$status_line->status.'</label></span>'.PHP_EOL;										
                                        }
                                    ?>                              
                                </div>
                            </div>
                        
                            <div>                                  
                                <span class="label">Active</span>
                                <div class="fieldset_box">                        	                        
                                    <input type="radio" name="active" id="active_1" value="1" <?php if($details_line->active) echo "checked"; ?> />
                                    <label for="active_1">Yes</label>
                                                                
                                    <input type="radio" name="active" id="active_0" value="0" <?php if(!$details_line->active) echo "checked"; ?> />                          
                                    <label for="active_0">No</label>
                                </div>
                            </div>
                            
                            <div>
                                <span class="label">Instructor</span>
                                <div class="fieldset_box">                              
                                    <input type="radio" name="instructor" id="instructor_1" value="1" <?php if($details_line->instructor) echo "checked"; ?> />
                                    <label for="Instructor_1">Yes</label>
                                                                
                                    <input type="radio" name="instructor" id="instructor_0" value="0" <?php if(!$details_line->instructor) echo "checked"; ?> />                          
                                    <label for="Instructor_0">No</label>
                                </div>
                            </div>
                        </fieldset>                              
                            
                        <fieldset id="fs_other">
                            <legend>Other</legend>
                            <div>
                            	<?php								
									$details_date = NULL;
									if($details_line->dob)
									{
										if($details_line->dob->getTimestamp())
										{
											$details_date = date('Y-m-d', $details_line->dob->getTimestamp());
										}
									}
								?>
                            
                                <label for="dob">Date of Birth</label>                                
                                <input type="date" name="dob" id="dob" value="<?php echo $details_date; ?>" class="date_entry" placeholder="yyyy-mm-dd" readonly />
                            </div>
                            
                            <div>
                                <label for="listing_order">Listing Order</label>
                                <input type="number" name="listing_order" id="listing_order" form="frm_details" placeholder="Listing Order" value="<?php echo $details_line->listing_order; ?>" />
                            </div>
                            
                            <div>
                                <label for="sig_image">Signature Image</label>
                                <input type="text" name="sig_image" id="sig_image" form="frm_details" placeholder="Signature image name" value="<?php echo $details_line->sig_image; ?>" />  
                            </div>
                            
                            <div>
                                <label for="memo">Memo</label>
                                <textarea name="memo" id="memo" cols="50" rows="2"><?php echo $details_line->memo; ?></textarea> 
                            </div>
                            
                        </fieldset>
                                             
                        <button name="btn_save" id="btn_save" form="frm_details" type="submit" value="Save">
                            <img src="../../media/image/icon_save.png" class="cmd" alt="Save" title="Save"><br />Save Details
                        </button>
                    
                    </form>   
                    
                    <p>
                        <hr>
                    </p>
                    
                    <?php 
					if($details_line->id)
					{
                    ?>
                    <form name="frm_phone" id="frm_phone" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$details_line->id; ?>" >
                        <fieldset>
                            <legend>Phone Numbers</legend>
                             <table id="tbl_phone" class="tablesorter">                            
                                <thead>
                                
                                    <?php if($dialog->phone) echo $dialog->phone; ?>
                                
                                    <tr>
                                        <th>Number</th>
                                        <th>Type</th>
                                        <th>Display</th>
                                        <th>Publish</th>
                                        <th>Record</th>
                                    </tr>
                                    
                                    <!--This row always appears; it is for new entries.-->
                                    <tr class="new">
                                        <td>
                                            <input type="tel" name="phone_number_-1" id="phone_number_-1" form="frm_phone" value="<?php echo $phone_line->number; ?>" class="cell_fill" placeholder="xxx- xxx-xxxx">
                                        </td>
                                        <td>                                    	
                                            <select name="phone_type_-1" id="phone_type_-1" form="frm_phone" class="cell_fill">
                                                <?php echo phone_type_options($phone_type_line_all, DEFAULTS::PHONE_TYPE, $phone_line->type); ?>
                                            </select>
                                        </td>
                                        <td class="center">                                 
                                            <input type="checkbox" name="phone_display_-1" id="phone_display_-1" value="1" />                                                                       
                                        </td>
                                        <td class="center">    
                                            <input type="checkbox" name="phone_publish_-1" id="phone_publish_-1" value="1" checked />
                                        </td>
                                        <td>
                                            <button name="phone_save" id="phone_save_-1" form="frm_phone" type="submit" value="-1" class="scroll_restore cmd_record" title="Save this item.">
                                                <img src="../../media/image/icon_pencil.png" class="" alt="Save" title="">
                                            </button>
                                        </td>
                                    </tr>                            
                                </thead>
                                <tfoot>
                                    <tr>                                       
                                    </tr>
                                </tfoot>
                                <tbody> 
                                
                                    <?php 
                                        if(!$phone_line_count)
                                        {
                                    ?>
                                        <tr>
                                            <p class="color_red">No current phone records.</p>
                                        </tr>
                                    <?php
                                        }
                                        else
                                        {
                                            foreach($phone_line_all as $phone_line)
                                            {
                                    ?>
                                            
                                            <tr>
                                                <td>
                                                    <span class="display_none"><?php echo $phone_line->number; ?></span>
                                                    <input type="text" name="phone_number_<?php echo $phone_line->id; ?>" id="phone_number_<?php echo $phone_line->id; ?>" form="frm_phone" value="<?php echo localize_us_number_side_form($phone_line->number); ?>" class="cell_fill" placeholder="xxx-xxx-xxxx" required>
                                                </td>
                                                <td>
                                                    <span class="display_none"><?php echo $phone_line->type; ?></span>
                                                    <select name="phone_type_<?php echo $phone_line->id; ?>" id="phone_type_<?php echo $phone_line->id; ?>" form="frm_phone" class="cell_fill" required>
                                                        <?php echo phone_type_options($phone_type_line_all, DEFAULTS::PHONE_TYPE, $phone_line->type); ?>
                                                    </select>
                                                </td>
                                                <td class="center">                                            	      
                                                    <span class="display_none"><?php echo $phone_line->display; ?></span>                                                                     
                                                    <input type="checkbox" name="phone_display_<?php echo $phone_line->id; ?>" id="phone_display_<?php echo $phone_line->id; ?>" value="1" <?php if($phone_line->display) echo 'checked'; ?> />                                                       
                                                </td>
                                                <td class="center">    
                                                    <span class="display_none"><?php echo $phone_line->publish; ?></span>                                                                          
                                                    <input type="checkbox" name="phone_publish_<?php echo $phone_line->id; ?>" id="phone_publish_<?php echo $phone_line->id; ?>" value="1" <?php if($phone_line->publish) echo 'checked'; ?> />                                             
                                                </td>
                                                <td>
                                                    <button name="phone_save" id="phone_save_<?php echo $phone_line->id; ?>" form="frm_phone" type="submit" value="<?php echo $phone_line->id; ?>" class="scroll_restore cmd_record" title="Save this item.">
                                                        <img src="../../media/image/icon_save.png" class="" alt="Save" title="">
                                                    </button>
                                                    
                                                    <button name="phone_delete" id="phone_delete_<?php echo $phone_line->id; ?>" form="frm_phone" type="submit" value="<?php echo $phone_line->id; ?>" class="scroll_restore cmd_record" title="Delete this item.">
                                                        <img src="../../media/image/icon_delete.png" class="" alt="Save" title="">
                                                    </button>
                                                </td>
                                            </tr>                         
                                    
                                    <?php
                                            }
                                        }
                                    ?>
                                </tbody>                                    
                            </table>
                        </fieldset>
                    </form>               
                    
                    <form name="frm_key" id="frm_key" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$details_line->id; ?>" >
                        <fieldset>
                            <legend>Keys</legend>
                             <table id="tbl_key" class="tablesorter">                            
                                <thead>
                                
                                    <?php if($dialog->key) echo $dialog->key; ?>
                                
                                    <tr>
                                        <th>Key</th>
                                        <th>Memo</th>
                                        <th>Record</th>
                                    </tr>
                                    
                                    <!--This row always appears; it is for new entries.-->
                                    <tr class="new">
                                        <td>                                    	
                                            <select name="key_key_-1" id="key_key_-1" form="frm_key" class="cell_fill">
                                                <option value="">Select Key</option>
                                                <?php echo key_number_options($keynum_line_all, NULL, $key_line->key_id); ?>
                                            </select>
                                        </td>
                                        <td>                                 
                                            <textarea name="key_memo_-1" id="key_memo_-1" form="frm_key" cols="10" rows="1" class="cell_fill"></textarea>                               
                                        </td>
                                        <td>
                                            <button name="key_save" id="key_save_-1" form="frm_key" type="submit" value="-1" class="scroll_restore cmd_record" title="Save this item.">
                                                <img src="../../media/image/icon_pencil.png" class="" alt="Save" title="">
                                            </button>
                                        </td>
                                    </tr>                            
                                </thead>
                                <tfoot>
                                    <tr>                                       
                                    </tr>
                                </tfoot>
                                <tbody> 
                                
                                    <?php 
                                        if(!$key_line_count)
                                        {
                                    ?>
                                        <tr>
                                            <p class="color_red">No current key records.</p>
                                        </tr>
                                    <?php
                                        }
                                        else
                                        {
                                            foreach($key_line_all as $key_line)
                                            {
                                    ?>
                                            
                                            <tr>
                                                <td>
                                                    <span class="display_none"><?php echo $key_line->key_id; ?></span>
                                                    <select name="key_key_<?php echo $key_line->id; ?>" id="key_key_<?php echo $key_line->id; ?>" form="frm_key" class="cell_fill">
                                                        <option value="">Select Key</option>
                                                        <?php echo key_number_options($keynum_line_all, NULL, $key_line->key_id); ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <span class="display_none"><?php echo $key_line->memo; ?></span>
                                                    <textarea name="key_memo_<?php echo $key_line->id; ?>" id="key_memo_<?php echo $key_line->id; ?>" form="frm_key" cols="10" rows="1" class="cell_fill"><?php echo $key_line->memo; ?></textarea>
                                                </td>
                                                <td>
                                                    <button name="key_save" id="key_save_<?php echo $key_line->id; ?>" form="frm_key" type="submit" value="<?php echo $key_line->id; ?>" class="scroll_restore cmd_record" title="Save this item.">
                                                        <img src="../../media/image/icon_save.png" class="" alt="Save" title="">
                                                    </button>
                                                    
                                                    <button name="key_delete" id="key_delete_<?php echo $key_line->id; ?>" form="frm_key" type="submit" value="<?php echo $key_line->id; ?>" class="scroll_store cmd_record" title="Delete this item.">
                                                        <img src="../../media/image/icon_delete.png" class="" alt="Delete" title="Delete">
                                                    </button>
                                                </td>
                                            </tr>                         
                                    
                                    <?php
                                            }
                                        }
                                    ?>
                                </tbody>                                    
                            </table>
                        </fieldset>
                    </form>
                    
                    
                    <form name="frm_sal" id="frm_sal" method="post" action="<?php echo $_SERVER['PHP_SELF'].'?id='.$details_line->id; ?>" >
                        <div style="overflow:scroll">
                        <fieldset>
                            <legend>Salary</legend>
                                                            
                                <table id="tbl_sal" class="tablesorter" style="width:2200px">                            
                                    <thead>
                                    
                                        <?php if($dialog->sal) echo $dialog->sal; ?>
                                    
                                        <tr>
                                            <th>Fiscal<br />Year</th>
                                            <th>Grade</th>
                                            <th>PE</th>
                                            <th>Salary</th>
                                            <th>Minimum</th>
                                            <th>Difference<br />(Minimum)</th>
                                            <th>First<br />Quartile</th>
                                            <th>Difference<br />1st Qtr.)</th>                                    
                                            <th>Midpoint</th>
                                            <th>Difference<br />(Midpoint)</th>
                                            <th>Difference %<br />(Midpoint)</th>
                                            <th>Regular<br />Service Date</th>
                                            <th>Education</th>
                                            <th>Experience</th>
                                            <th>Combined</th>
                                            <th>UK Exp.</th>
                                            <th>Record</th>
                                        </tr>
                                        
                                        <!--This row always appears; it is for new entries.-->
                                        <tr class="new">
                                            <td>                                    	
                                                <input type="number" name="sal_year_-1" id="sal_year_-1" placeholder="yyyy" />
                                            </td>
                                            <td>                                    	
                                                <input type="number" name="sal_grade_-1" id="sal_grade_-1" class="cell_fill" placeholder="Grade" />
                                            </td>
                                            <td>                                    	
                                                <input type="number" name="sal_pe_-1" id="sal_pe_-1" class="cell_fill" step="0.1" placeholder="PE Score" />
                                            </td>
                                            <td>                                 
                                                <input type="number" name="sal_salary_-1" id="sal_salary_-1" class="cell_fill" step="0.01" placeholder="$00.00" />                              
                                            </td>
                                            <td class="center">                                 
                                                -                              
                                            </td>
                                            
                                            <td class="center">                                 
                                                -                              
                                            </td>
                                            <td class="center">                                 
                                                -                              
                                            </td>
                                            <td class="center">                                 
                                                -                              
                                            </td>                                    
                                            <td class="center">                                 
                                                -                              
                                            </td>
                                            <td class="center">                                 
                                                -                              
                                            </td>
                                            <td class="center">                                 
                                                -                              
                                            </td>
                                            <td>
                                                <input type="date" name="sal_service_date_-1" id="sal_service_date_-1" class="date_entry" placeholder="yyyy-mm-dd" readonly />
                                            </td>
                                            <td>                                 
                                                <input type="number" name="sal_education_-1" id="sal_education_-1" class="cell_fill" placeholder="Education" />                              
                                            </td>
                                            <td>                                 
                                                <input type="number" name="sal_experience_-1" id="sal_experience_-1" class="cell_fill" step="0.01" placeholder="Experience" />                              
                                            </td>
                                            <td class="center">                                 
                                                -                              
                                            </td>
                                            <td class="center">                                 
                                                -                              
                                            </td>
                                            <td>
                                                <button name="sal_save" id="sal_save_-1" form="frm_sal" type="submit" value="-1" class="scroll_restore cmd_record" title="Save this item.">
                                                    <img src="../../media/image/icon_pencil.png" class="" alt="Save" title="">
                                                </button>
                                            </td>
                                        </tr>                            
                                    </thead>
                                    <tfoot>
                                        <tr>                                       
                                        </tr>
                                    </tfoot>
                                    <tbody> 
                                    
                                        <?php 
                                            if(!$sal_line_count)
                                            {
                                        ?>
                                            <tr>
                                                <p class="color_red">No current salary records.</p>
                                            </tr>
                                        <?php
                                            }
                                            else
                                            {
                                                foreach($sal_line_all as $sal_line)
                                                {
                                        ?>
                                                
                                                <tr>
                                                    <td>
                                                        <span class="display_none"><?php echo $sal_line->year; ?></span>                                 	
                                                        <input type="number" name="sal_year_<?php echo $sal_line->id; ?>" id="sal_year_<?php echo $sal_line->id; ?>" placeholder="yyyy" readonly value="<?php echo $sal_line->year; ?>" />
                                                    </td>                                     	
                                                    <td>
                                                        <span class="display_none"><?php echo $sal_line->sal_grade; ?></span>                                    	
                                                        <input type="number" name="sal_grade_<?php echo $sal_line->id; ?>" id="sal_grade_<?php echo $sal_line->id; ?>" class="cell_fill" placeholder="Grade" value="<?php echo $sal_line->grade; ?>" />
                                                    </td>
                                                    <td>
                                                        <span class="display_none"><?php echo $sal_line->pe; ?></span>                                    	
                                                        <input type="number" name="sal_pe_<?php echo $sal_line->id; ?>" id="sal_pe_<?php echo $sal_line->id; ?>" class="cell_fill" placeholder="PE Score" step="0.1" value="<?php echo $sal_line->pe; ?>" />
                                                    </td>
                                                    <td>                                 
                                                        <input type="number" name="sal_salary_<?php echo $sal_line->id; ?>" id="sal_salary_<?php echo $sal_line->id; ?>" class="cell_fill" placeholder="$00.00" step="0.01" value="<?php echo round($sal_line->salary, DEFAULTS::PRECISION); ?>" />                              
                                                    </td>
                                                    <td>                                 
                                                        <?php echo number_format($sal_line->min, DEFAULTS::PRECISION); ?>                              
                                                    </td>
                                                    
                                                    <td>                                 
                                                        <?php echo number_format($sal_line->min_diff, DEFAULTS::PRECISION); ?>                              
                                                    </td>
                                                    <td>                                 
                                                        <?php echo number_format($sal_line->first, DEFAULTS::PRECISION); ?>                              
                                                    </td>
                                                    <td>                                 
                                                        <?php echo number_format($sal_line->first_diff, DEFAULTS::PRECISION); ?>                               
                                                    </td>                                    
                                                    <td>                                 
                                                        <?php echo number_format( $sal_line->mid, DEFAULTS::PRECISION); ?>                              
                                                    </td>
                                                    <td>                                 
                                                        <?php echo number_format($sal_line->mid_diff, DEFAULTS::PRECISION); ?>                             
                                                    </td>
                                                    <td>                                 
                                                        <?php echo round($sal_line->mid_diff_per, DEFAULTS::PRECISION); ?>                              
                                                    </td>
                                                    <td>
                                                        <span class="display_none"><?php if($sal_line->service_date) echo date('Y-m-d', $sal_line->service_date->getTimestamp()); ?></span>
                                                        <input type="date" name="sal_service_date_<?php echo $sal_line->id; ?>" id="sal_service_date_<?php echo $sal_line->id; ?>" class="date_entry" placeholder="yyyy-mm-dd" readonly value="<?php if($sal_line->service_date) echo date('Y-m-d', $sal_line->service_date->getTimestamp()); ?>" />
                                                    </td>
                                                    <td>
                                                        <span class="display_none"><?php echo $sal_line->education; ?></span>                                 
                                                        <input type="number" name="sal_education_<?php echo $sal_line->id; ?>" id="sal_education_<?php echo $sal_line->id; ?>" class="cell_fill" placeholder="Education" value="<?php echo $sal_line->education; ?>" />                              
                                                    </td>
                                                    <td>
                                                        <span class="display_none"><?php echo $sal_line->experience; ?></span>                                 
                                                        <input type="number" name="sal_experience_<?php echo $sal_line->id; ?>" id="sal_experience_<?php echo $sal_line->id; ?>" class="cell_fill" placeholder="Experience" step="0.01" value="<?php echo $sal_line->experience; ?>" />                              
                                                    </td>
                                                    <td>                                 
                                                        <?php echo round($sal_line->combined, DEFAULTS::PRECISION); ?>                              
                                                    </td>
                                                    <td class="center">                                 
                                                        <?php echo round($sal_line->uk_exp,DEFAULTS::PRECISION); ?>                              
                                                    </td>
                                                    <td>
                                                        <button name="sal_save" id="sal_save_<?php echo $sal_line->id; ?>" form="frm_sal" type="submit" value="<?php echo $sal_line->id; ?>" class="scroll_restore cmd_record" title="Save this item.">
                                                            <img src="../../media/image/icon_save.png" class="" alt="Save" title="">
                                                        </button>
                                                        
                                                        <button name="sal_delete" id="sal_delete_<?php echo $key_line->id; ?>" form="frm_sal" type="submit" value="<?php echo $sal_line->id; ?>" class="scroll_store cmd_record" title="Delete this item.">
                                                            <img src="../../media/image/icon_delete.png" class="" alt="Delete" title="Delete">
                                                        </button>
                                                    </td>
                                                </tr>                         
                                        
                                        <?php
                                                }
                                            }
                                        ?>
                                    </tbody>                                    
                                </table>                 
                                       
                        </fieldset>
                        </div>                    
                    </form>  
                    <?php 
					}
					else
					{
					?>
                    	<h2>Save main record details before entering subrecords.</h2>
                    <?php
					}
					?>
				</div><!--#content-->
            </div><!--#subContainer-->
            <div id="sidePanel">		
            	<?php include($cDocroot."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--#footer-->        
        </div><!--#container-->
        
        <div id="footerPad">
        	<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--#footerPad-->
    <script>
			function disable($selector, $val)
			{	
				// Disable or enable targeted element as needed.
			
				$element = $($selector);
				$disable = false;
				
				if(!$val)
				{					
					$disable = true;
				}
				
				$element.prop('disabled', $disable);
			}
			
			function scrollset($scroll_v)
			{
				// If cookie is set, scroll to the position saved in the cookie.
				if ($scroll_v !== null) 
				{
					$(document).scrollTop($scroll_v);
				}			
			}
	
			$(document).ready(function(event) 
				{ 
					options_update(event, null, '#department'); 
					disable('.nav_backward', <?php echo $nav_line->prev_id ? $nav_line->prev_id : 0; ?>);
					disable('.nav_forward', <?php echo $nav_line->next_id ? $nav_line->next_id : 0; ?>);
					
					// If cookie is set, scroll to the position saved in the cookie.
					if ( $.cookie("scroll") !== null ) 
					{
						$(document).scrollTop( $.cookie("scroll") );
					}

					// When a button is clicked...
					$('.scroll_restore').on("click", function() 
					{
				
						// Set a cookie that holds the scroll position.
						$.cookie("scroll", $(document).scrollTop() );
				
					});										 
				} 
			);
			
			$(function(){
				$('.date_entry').datepicker({dateFormat: 'yy-mm-dd', changeYear: true, constrainInput: true, yearRange: "-110:+00"});
			});
					
	
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-40196994-1', 'uky.edu');
		  ga('send', 'pageview');

	</script>
</body>
</html>

