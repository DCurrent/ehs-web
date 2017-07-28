<?php
	
	// Common population of lists using common tabel fields (id/label).
	class class_common_list_items
	{
		private 
			$id = NULL,
			$label = NULL;
		
		public function get_id()
		{		
			return $this->id;
		}
		
		public function get_label()
		{
			return $this->label;
		}
		
		public function set_id($value)
		{
			$this->id = $value;
		}
		
		public function set_label($value)
		{
			$this->label = $value;
		}
	}

	class class_check_list
	{	
		private
			$name			= NULL,
			$items_array 	= array(),
			$markup			= NULL,	
			$default_val	= NULL;
		
		// Accessors	
		public function get_markup()
		{
			return $this->markup;
		}
		
		// Mutators
		public function set_name($value)
		{
			$this->name = $value;
		}
		
		public function set_default($value)
		{
			$this->default_val = $value;
		}
				
		public function item_list_from_array($value = array())
		{
			$items_key = NULL;
			
			// make sure items array is clear first.		
			$this->items_array = array();
			
			// is incoming value an array?
			if(is_array($value))
			{
				// Loop over value array and create an array of objects in
				// class items array variable. 
				foreach($value as $key => $temp)
				{
					// Create new element and populate it with object.
					$this->items_array[] = new class_common_list_items();
					
					// Get the newely created key for items array.
					end($this->items_array);         
					$items_key = key($this->items_array);  
					
					// Use key to set properties of object stored in this element of array.
					$this->items_array[$items_key]->set_label($key);
					$this->items_array[$items_key]->set_id($temp);
				}		
			}
		}
		
		public function item_list_from_table()
		{							
			// Initialize DB connection and query objects.
			$db		= new class_db_connection();		
			$query 	= new class_db_query($db);
			
			$table 	= 'tbl_incident_'.$this->name.'_list';
			
			// Get type list items.
			$query->set_sql('SELECT id, label FROM '.$table.' ORDER BY label');
			$query->query();
			
			$query->get_line_params()->set_class_name('class_common_list_items');
			$this->items_array = $query->get_line_object_all();
			
			return $this->items_array;				
		}
				
		public function generate_check_markup()
		{

			// Generate a list of checkmark items from list. Values and
			// ID are taken from ID field in database.
			  
			// Since we are going to send these items as an array, populating
			// from a previous post requires we first get the post array. 
												
			// Cannot dereference array element directly from function, so
			// we'll store it as a combined (key = value) temp variable. This is because the 
			// post array is effectivly a list of IDs. During the item generation loop we
			// can verify if there is an array key that matches the ID. If so we know 
			// the item was previously selected and will add the "checked" markup.
			
			$request = array();
			
			// First, let's dereference the request we need by name from the global request array.
			if(isset($_REQUEST[$this->name])) $request = $_REQUEST[$this->name];
			
			// Is our request item an array? If so combine key and
			// values (See description above). Otherwise there's no value 
			// at all or its somethign we can't use, so we'll replace it
			// with an empty array.
			if(is_array($request))
			{									
				$request = array_combine($request, $request);
			}
			else
			{
				$request = array();
			}		
			
			// Start caching page contents.
			ob_start();			
			
			?>
            	<!--Markup generation: <?php echo __CLASS__.'->'.__FUNCTION__ . ' ('.__FILE__.'), Last update: ' .date(DATE_ATOM,filemtime(__FILE__)); ?>-->
			<?php
			
			// Iterate over each item.
			foreach ($this->items_array as $temp_obj)
			{	
				// Concatenate the data member name with id.
				$prop = $this->name.'_'.$temp_obj->get_id();							                                            
			?>		
				<li>
					<input type="checkbox" 
						name="<?php echo $this->name; ?>[]" 
						id="<?php echo $prop; ?>" 
						value="<?php echo $temp_obj->get_id(); ?>" 
						<?php if(array_key_exists($temp_obj->get_id(), $request) === TRUE) echo " checked "; ?> />
					<label for="<?php echo $prop ?>"><?php echo $temp_obj->get_label(); ?></label>
				</li> 
			<?php		
			}
			
			?>
            	<!--/<?php echo __CLASS__.'->'.__FUNCTION__; ?>-->
			<?php
			
			// Collect contents from cache and then clean it.
			$this->markup = ob_get_contents();
			ob_end_clean();	
			
			return $this->markup;
		}
		
		public function generate_radio_markup()
		{
			$request = NULL;
			
			if(isset($_REQUEST[$this->name])) $request = $_REQUEST[$this->name];				
			
			// Start caching page contents.
			ob_start();			
			
			?>
            	<!--Markup generation: <?php echo __CLASS__.'->'.__FUNCTION__ . ' ('.__FILE__.'), Last update: ' .date(DATE_ATOM,filemtime(__FILE__)); ?>-->
			<?php
			
			// Iterate over each item.
			foreach ($this->items_array as $temp_obj)
			{	
				// Concatenate the data member name with id.
				$prop = $this->name.'_'.$temp_obj->get_id();							                                            
			?>	
            	<span style="white-space:nowrap;">
					<input type="radio" 
						name="<?php echo $this->name; ?>" 
						id="<?php echo $prop; ?>" 
						value="<?php echo $temp_obj->get_id(); ?>" required
						<?php 
							if($temp_obj->get_id() == $request)
							{
								echo ' checked ';
							}
							else if($request == NULL && $temp_obj->get_id() == $this->default_val)
							{
								echo ' checked '; 
							}
						?> 
                        />
					<label for="<?php echo $prop ?>"><?php echo $temp_obj->get_label(); ?></label>
				</span>
			<?php		
			}
			
			?>
            	<!--/<?php echo __CLASS__.'->'.__FUNCTION__; ?>-->
			<?php
			
			// Collect contents from cache and then clean it.
			$this->markup = ob_get_contents();
			ob_end_clean();	
			
			return $this->markup;
		}
	}
?>                                      	
