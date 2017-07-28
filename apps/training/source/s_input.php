<?php 

	// Values taken from URL embedded variables.
	class global_get
	{
		protected
			$m		= NULL,	// Module, current.
			$m_del	= NULL,	// Module, delete.
			$q 		= NULL,	// Question, current
			$q_del	= NULL,	// Question, delete.
			$a_del	= NULL;	// Answer, delete.	
		
		public function __construct()
		{	
			$this->keys();	
		}
		
		// Accessors
		public 
			function module()
			{	
				return $this->m();	
			}			
				
			function module_delete()
			{
				return $this->m_del;
			}
				
			function question()
			{
				return $this->q;
			}
				
			function question_delete()
			{
				return $this->q_del();
			}
				
			function answer_delete()
			{
				return $this->a_del;
			}
		
		// Populate all data members with matching GET key.
		private function keys()
		{
			// Interate through each class variable.
       		foreach($this as $key => $value) 
			{			
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the get value. 
				if(isset($_GET[$key]))
				{					
					$this->$key = $_GET[$key];           						
				}
			}
		}
	}
	
	class global_post
	{
		public function __construct()
		{	
			$this->post_keys();	
		}
		
		// Populate all data members with matching GET key.
		private function post_keys()
		{
			// Interate through each class variable.
       		foreach($this as $key => $value) 
			{			
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the get value. 
				if(isset($_GET[$key]))
				{					
					$this->$key = $_POST[$key];           						
				}
			}
		}
	}
	
	
	class input
	{
		private
			$target = NULL;
		
		public function __construct()
		{
		}
		
		// Mutators
		public function set_target($value)
		{
			$this->target = $value;
		}
		
		// Populate all data members in target object with matching GET key.
		public function populate_from_get()
		{
			$key = NULL;
			$value = NULL;
			
			// Dereference data member.
			$target = $this->target;
			
			// Interate through each data member in target object.
       		foreach($target as $key => $value) 
			{			
				// If we can find a matching a GET var with key matching
				// key of current object var, set object var to the GET value. 
				if(isset($_POST[$key]))
				{					
					$this->$key = $_POST[$key];           						
				}
			}
		}
		
		// Populate all data members in target object with matching POST key.
		public function populate_from_post()
		{
			echo '<br/ >populate_from_post';
			$key = NULL;
			$value = NULL;
			
			// Dereference data member.
			$target = $this->target;
			
			// Interate through each data member in target object.
       		foreach($target as $key => $value) 
			{	
				echo '<br />Key: '.$key.', Value: '.$value;
					
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the POST value. 
				if(isset($_POST[$key]))
				{					
					$target->$key = $_POST[$key];           						
				}
			}
		}
	}
	
?>