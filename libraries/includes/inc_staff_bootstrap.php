<!--Include: <?php echo __FILE__ . ", Last update: " .date(DATE_ATOM, filemtime(__FILE__)); ?>-->
<?php

	require_once($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/database/main.php');

	class ehsweb_sidebar_class_staff
	{
		private
			$markup_table_row		= NULL,
			$markup_table_complete 	= NULL,
			$table_main_id			= NULL,
			$table_main_class		= NULL,
			$table_caption			= NULL,
			$_obj_staff_list		= NULL,
			$query_parameters		= NULL;
			
		public
			function get_markup_table_row()
			{
				return $this->markup_table_row;
			}
			
			function get_markup_table_complete()
			{
				return $this->markup_table_complete;
			}
			
			function set_query_parameters($value)
			{
				$this->query_parameters = $value;
			}		
		
		public function populate_from_database()
		{
			$db					= NULL;		// Database object.
			$query_account		= NULL;		// Query object.
			$query_phone		= NULL;
			$markup_email		= NULL;
			$markup				= NULL; 	// Result markup.
			$phone_arr			= NULL;	// Array of phone numbers/links.
			$phone				= NULL;	// Completed phone string.
			$params				= NULL;
			
			
			// Set up database connections
			$db		= new class_db_connection();		
			$options = new class_db_query_options();	
			$options->set_scrollable(SQLSRV_CURSOR_FORWARD);
			
			// Set up queries for staff list and sub list of
			// phone numbers.  
			$query_account 	= new class_db_query($db, $options);	
			$query_phone	= $query_account;		
			
			// Prepare and execute staff list query.
			$query_account->set_sql('SELECT
				id,
				account,
				name_f,
				name_l,
				title,
				email		
					FROM tbl_staff
					WHERE department = ? AND active = ?
					ORDER BY listing_order, name_l');
					
			$params = array($this->query_parameters->get_department(),
							TRUE);	
							
			$params = array('3he00',
							1);	
			
			$query_account->set_params($params);
			$query_account->query();	
			$query_account->get_line_params()->set_class_name('ehsweb_sidebar_class_data_account');
			
			// Prepare holding vars and insert rows from database.
			$_obj_data_account 		= new ehsweb_sidebar_class_data_account();
			$_obj_data_account_list = new SplDoublyLinkedList();
			
			if($query_account->get_row_exists() === TRUE) $_obj_data_account_list = $query_account->get_line_object_list();
			
			// Prepare the phone list query.
			$query_phone->set_sql('SELECT number FROM tbl_staff_phone WHERE display = 1 AND type = 1 AND fk_id = ?');
			$query_phone->set_params(array(&$id));
			$query_phone->prepare();
			$query_phone->get_line_params()->set_class_name('ehsweb_sidebar_class_data_account_phone');
			
			// Prepare holding vars for phone rows.
			$_obj_data_phone 		= new ehsweb_sidebar_class_data_account_phone();
			$_obj_data_phone_list 	= new SplDoublyLinkedList();
			
			// Loop over staff accounts. 
			for($_obj_data_account_list->rewind();	$_obj_data_account_list->valid(); $_obj_data_account_list->next())
			{	                                                               
				$_obj_data_account = $_obj_data_account_list->current();					
				
				echo $_obj_data_account->get_name_f();
				
				// Set our bound parameter variable, then execute prepared query.
				$id = $_obj_data_account->get_id();
				$query_phone->execute();
		
				// Did phone database return rows?			
				if($query_phone->get_row_exists() === TRUE)
				{	
					// Insert rows from phone database.
					$_obj_data_account->set_phone($query_phone->get_line_object_list());					
				}			
			}
			
			$this->_obj_staff_list = $_obj_data_account_list;
			
			return $this->_obj_staff_list;
		}
		
		public function generate_markup_table_complete()
		{
			// Start output caching.
			ob_start();
			
			?>
            <table id="<?php echo $this->table_main_id; ?>" class="<?php echo $this->table_main_class; ?>">
                <caption></caption>
                <thead>
                </thead> 
                <tfoot>
                </tfoot>
                <tbody>
                	<?php echo $this->markup_table_row; ?>
                </tbody>
            </table>
    		<?php
			
			// Collect contents from cache and then clean it.
			$this->markup_table_complete = ob_get_contents();
			ob_end_clean();	
		}
		
		public function generate_markup_table_row()
		{	
			$_obj_staff_list	= $this->_obj_staff_list;
			$_obj_staff 		= new ehsweb_sidebar_class_data_account();
			
			$_obj_phone_list	= NULL;
			$_obj_phone			= NULL;
			
			// Start output caching.
			ob_start();
			
			if($_obj_staff_list	!= NULL)
			{	
				// Loop over staff accounts. 
				for($_obj_staff_list->rewind(); $_obj_staff_list->valid(); $_obj_staff_list->next())
				{	                                                               
					$_obj_staff = $_obj_staff_list->current();					
					
					// Default to Link Blue account if email field is blank.
					if($_obj_staff->get_email())
					{
						$markup_email = $_obj_staff->get_email();	
					}
					else
					{
						$markup_email = $_obj_staff->get_account().'@uky.edu';
					}
					
					$_obj_phone_list = $_obj_staff->get_phone();
			
					// Did phone database return rows?			
					if($_obj_phone_list != NULL)
					{	
						// Clean phone number array.
						$phone_arr = NULL;
						
						for($_obj_phone_list->rewind();	$_obj_phone_list->valid(); $_obj_phone_list->next())
						{	                                                               
							$_obj_phone = $_obj_phone_list->current();
							
							// Start output caching. 
							ob_start();
							
							?>
							<a href="tel:<?php echo $_obj_phone->get_number(); ?>"><?php echo $_obj_phone->get_number(); ?> <span class="glyphicon glyphicon-phone-alt"></span></a>
							<?php
							
							// Collect contents from cache into phone markup array, then 
							// clean cache for next loop.
							$phone_arr[] = ob_get_contents();
							ob_end_clean();
						}
						
						// Concatenate phone array into comma separated string.
						$phone = implode(', ', $phone_arr);
					}
					else
					{
						$phone = "Phone # NA";
					}				
						
					// Now assemble the account and phone markup into into a complete table row markup.
					?>
					<tr>
						<td>
							<p><a href="mailto:<?php echo $markup_email; ?>"><?php echo $_obj_staff->get_name_f().' '.$_obj_staff->get_name_l(); ?> <span class="glyphicon glyphicon-envelope"></span></a>
								<br /><?php echo $_obj_staff->get_title(); ?>
								<br /><?php echo $phone; ?>
							</p>
						</td>
					</tr>            
					<?php						
				}
			}
			// Collect contents from cache and then clean it.
			$this->markup_table_row = ob_get_contents();
			ob_end_clean();	
			
			// Return results.
			return $this->markup_table_row;
		}
	}

	class ehsweb_sidebar_class_data_account
	{
		private
			$account	= NULL,
			$department	= NULL,
			$email		= NULL,
			$id			= NULL,
			$name_f		= NULL,
			$name_l 	= NULL,
			$phone		= NULL,	// This will be an SplDoublyLinkedList of phone sub items.
			$title		= NULL;	
	
	
		public function __construct()
		{
			$this->populate_from_request();
		}
		
		// Populate members from $_REQUEST.
		public function populate_from_request()
		{		
			// Interate through each class method.
			foreach(get_class_methods($this) as $method) 
			{		
				$key = str_replace('set_', '', $method);
							
				// If there is a request var with key matching
				// current method name, then the current method 
				// is a set mutator for this request var. Run 
				// it (the set method) with the request var. 
				if(isset($_REQUEST[$key]))
				{					
					$this->$method($_REQUEST[$key]);					
				}
			}			
		}
		
		// Accessors
		public function  get_account()
		{
			return $this->account;
		}
			
		public function get_department()
		{
			return $this->department;
		}
			
		public function get_email()
		{
			return $this->email;
		}
			
		public function get_id()
		{
			return $this->id;
		}
			
		public function get_name_f()
		{
			return $this->name_f;
		}
			
		public function get_name_l()
		{
			return $this->name_l;
		}
		
		public function get_phone()
		{
			return $this->phone;
		}
			
		public function get_title()
		{
			return $this->title;
		}
			
		// Mutators
		public function set_department($value)
		{
			$this->department = $value;
		}
		
		public function set_phone($value)
		{
			$this->phone = $value;
		}
	}
	
	class ehsweb_sidebar_class_data_account_phone
	{
		private
			$number	= NULL;
		
		// Accessors
		public function  get_number()
		{
			return $this->number;
		}
	}
	
?>