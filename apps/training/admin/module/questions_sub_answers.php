<?php 

	// Display form showing current answers. 

	require('../../source/s_main.php');
	
	// Post data.			
	class post
	{
		private			
			$q_id 	= NULL,	// Question save?							
			$a_edit		= NULL;	// Modify answer list?
		
		public function __construct()
		{	
			$this->populate();		
		}
						
		// Populate datamembers from $_POST.
		private function populate()
		{
			// Interate through each data member in target object.
			foreach($this as $key => $value) 
			{					
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the POST value. 
				if(isset($_POST[$key]))
				{					
					$this->$key = $_POST[$key];           						
				}				
			}
		}
		
		// Access methods
		public
			function id()
			{
				return $this->q_id;
			}
			
			function a_edit()
			{
				return $this->a_edit;
			}
	}
	
	// Initialize post.
	$post = new post();
	
	// Query for current answers.
	$answer_obj = new answer_list;
	$answer_obj->set_fk($post->id());
	$answer_obj->get_answer_list();
	$answers = $answer_obj->result();
	
	switch ($post->a_edit())
	{
		// No changes.
		case NULL:
			break;
			
		// New record slot.
		case ITEM_ID::FRESH:
			// Add new element with blank answer fields object.
			$answers[] = new answer_fields();
			
			// Set our new answer object id to NEW.
			end($answers)->set_id(ITEM_ID::FRESH);
			break;
			
		// Remove slot.
		default:			
	}
	
	// Loop range array (A to Z)
	$letters	= range('A', 'Z');
	$i			= 0;
																		
	foreach($answers as $answer)
	{	
		// increment counter.
		$i++;												
?>                       
		<fieldset class="ans_input" name="a_<?php echo $answer->id(); ?>" id="a_<?php echo $answer->id(); ?>">
			
			<input type="hidden" name="a_id_<?php echo $answer->id(); ?>" value="<?php echo $answer->id(); ?>">
			
			<legend id="a_legend_<?php echo $answer->id(); ?>">
				<?php echo $letters[$i-1]; ?> | <a href="#" title="Remove this answer."><span class="color_red">Remove</span></a>                           
			</legend>
            		
			<p>
				<label for="a_correct_<?php echo $answer->id(); ?>">Correct</label>
				<input 
					type="radio" 
					name="a_correct" 
					id="a_correct_<?php echo $answer->id(); ?>" 
					value="<?php echo $answer->id(); ?>"                                        
					<?php if($answer->correct() == TRUE) echo ' checked '; ?>                                        
				/>                         
			</p>                                
			
			<p>                     
				<label for="a_text_<?php echo $answer->id(); ?>">Text</label>                                
				<textarea name="a_text_<?php echo $answer->id(); ?>" 
					id="a_text_<?php echo $answer->id(); ?>" 
					cols="50" 
					rows="2"><?php echo $answer->text(); ?></textarea>
			</p>                                
		</fieldset>                                	                 
<?php							
	}
?>

