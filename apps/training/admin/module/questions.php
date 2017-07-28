<?php 

	require('../../../../libraries/php/classes/config.php'); //Basic configuration file.
	require('../../../../libraries/php/classes/database/main.php'); 	// Database class.
	require('../../source/s_main.php');
		
	$local_root		= $cDocroot."classes/";
	
	// Post data.			
	class post
	{
		public			
			$q_save 	= NULL,	// Question save?
			$q_save_new	= NULL,	// Question save and new?
			$q_del		= NULL,	// Question delete?
			$q_id	= NULL,
			
			$answer_id 	= NULL,
			$answer_correct = NULL,
			$answer_text	= NULL;				
		
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
					echo '<br />Key: '.$key.', Value: '.$this->$key;       						
				}	
				
				//echo '<br />Key: '.$key.', Value: '.$this->$key;
			}
		}
		
		// Access methods
		public
			function question_save()
			{
				return $this->q_save;
			}			
		
			function question_save_new()
			{
				return $this->q_save_new;
			}			
		
			function question_delete()
			{
				return $this->q_del;
			}
	}
	
	print_r($_POST['answer_id']);
	echo '<br />';
	print_r($_POST['answer_correct']);
	echo '<br />';
	print_r($_POST['answer_text']);
	
	//// Global variables.
	$time 		= date(DATE_FORMAT);	// Current date/time.
	$post		= new post();			// POST object.
	$get 		= new get();			// GET object.
	$db			= NULL;					// Database object.
	$query		= NULL;					// Query object.
	$main		= NULL;					// Line object, main table.
	$questions	= NULL;					// Line object, questions table.	
	$answers	= array();
	$answer		= NULL;
	
	// Verify login.
	$oAcc->access_verify();
		
	// Initialize DB connection and query objects.
	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);
		
	if($post->question_save())
	{	
		$question_update = new question_update();
		
		$question_update->input()->set_id($get->question());
		$question_update->input()->set_fk_id($get->module());
		$question_update->input()->set_log_update($time);
		$question_update->input()->set_log_update_account($oAcc->get_account());
		$question_update->input()->set_log_update_ip($oAcc->get_ip());
				
		$question_update->send_to_db();
		
		// If the current question ID doesn't match result from database,
		// then redirect with database result. It is probably a newly saved
		// record.
		if($get->question() != $question_update->result()->id())
		{
			header('Location: ?m='.$get->module().'&q='.$question_update->result()->id());
		}
		
		// Answer update.
						
		// Populate current answers from post vars.
		//$answer_update->populate_from_post();
		//$answer_update->save_answers();
		
	}
	else
	{	
		switch($get->module())
		{
			// New module.
			case ITEM_ID::FRESH:
				
				$dialog = '<h2 class="color_green">This is a new module in progress. You must first save settings before editing questions.</h2>';
				
				// Initialize parameters object with default values.
				$main = new result_main(TRUE);
				break;
			
			// No module selected.
			case ITEM_ID::NONE:
				$dialog = '<h2 class="color_green">No module selected. Choose a module to update. If you would like to start a new module, select <a href="?module='.ITEM_ID::FRESH.'">Create New Module</a>.</h2>';
				break;
			
			// Previously exisiting module selected.
			default:
							
				//// Query for current values in main table.		
				$query->set_sql('SELECT * FROM tbl_class_train_parameters WHERE id = ?');
				$query->set_params(array($get->module()));
				$query->query();
				
				// If a record is found, initialize row as class object. Otherwise initialize an
				// empty object so we have default values.
				if($query->get_row_exists())
				{
					$query->get_line_params()->set_class_name('class_module_data');
					$main = $query->get_line_object();
					
					// Reset class name for next use of query object.
					$query->get_line_params()->set_class_name(NULL);
				}
				else
				{
					$main = new result_main();
				}		
				break;		
		}
	}
	
	// Query for current question.
	$questions = new question();
	$questions->set_id($get->question());
	$questions->set_from_db();
	$question = $questions->result();
			
	// Query for current answers.
	$answer_obj = new answer_list();
	$answer_obj->set_fk($get->question());
	$answer_obj->get_answer_list();
	$answers = $answer_obj->result();
		
?>

<!DOCtype html>
    <head>
        <title>UK - Occupational Health &amp; Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        
        <link rel="stylesheet" href="../../../../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../../../../libraries/css/print.css" type="text/css" media="print" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
        <script src="../../../../libraries/javascript/jquery_ui_timepicker_addon.js"></script>
        <script src="../../../../libraries/javascript/options_update.js"></script>    
    	
        <style>
			ul.checkbox  { 
				
			 	-webkit-column-count: 4;  				
				-moz-column-count: 4;				
			  column-count: 4;			 
			  margin: 0; 
			  padding: 0; 
			  margin-left: 20px; 
			  list-style: none;			  
			} 
			
			ul.checkbox li input { 
			  margin-right: .25em; 
			  cursor:pointer;
			} 
			
			ul.checkbox li { 
			  border: 1px transparent solid; 
			  display:inline-block;
			  width:12em;			  
			} 
			
			ul.checkbox li label { 
			  margin-left: ;
			  cursor:pointer;			  
			} 
			ul.checkbox li:hover, 
			ul.checkbox li.focus  { 
			  background-color: lightyellow; 
			  border: 1px gray solid; 
			  width: 12em; 
			}
			
			.legend {
				display:			inline-block;
				background-color:	#E1E1FF;
				border:				1px solid;
				border-color:		#000;
				border-radius: 		5px;
				font-size:			90%;
				font-weight:		bold;
				padding-top: 		0.2em;
				padding-bottom:		0.2em;
				padding-left: 		0.5em;
				padding-right: 		0.5em; 	
				text-align:			right;
				margin-top: 		5px;
			}
		</style>
    
    </head>
    
    <body>    
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div>
            <div id="subContainer">
                <div id="banner_container" class="banner_container">	
                    <div id="banner_content" class="banner">
                        University of Kentucky
                        <h1>Training Module Edit</h1>
                        <div id="banner_slogan" class="slogan">
                            UK Safety Begins with You!
                        </div><!--#banner_slogan-->
                    </div><!--#banner_content-->
                </div><!--#banner_container-->
                <div id="subNavigation">
                    <?php include('a_subnav.php'); ?> 
                </div>
                <div id="content">
                	<?php                
                		echo $dialog;                
                  	?>
                    <form name="frm_question" id="frm_question" method="post">    
                    	<!--So the answers sub page knows which question ID-->
                    	<input type="hidden" name="q_id" value="<?php echo $question->id(); ?>" />                                                   
                        <fieldset>
                        	<legend>Action</legend>                   
                            <p class="center">                            	
                                <button type="button" name="cancel" id="q_cancel" onClick="history.go(0)">Cancel</button>
                                <button type="submit" name="q_save" id="q_save" value="<?php echo TRUE; ?>">Save</button>
                                <button type="submit" name="nav" id="nav_5" value="5">Save and Create Another</button>
                            </p>
                        </fieldset>               	
                    
                    	<fieldset>
                        	
                            <legend>Question Setup</legend>
                            
                        	<label for="title">Title</label>
                            <input type="text" name="title" id="title" placeholder="Question Title" value="<?php echo $question->title() ?>">
                            
                            <label for="order">Display Order</label>
                            <input type="number" step="1" min="0" max="<?php echo $main->question_quantity; ?>" name="display_order" id="display_order" value="<?php echo $question->display_order(); ?>" required>
                            
                            <label for="q_intro">Introduction</label>                                
                            <textarea name="intro" id="intro" cols="50" rows="2"><?php echo $question->intro(); ?></textarea>
                            
                            <label for="response_right">Response (Right)</label>                                
                            <textarea name="response_right" id="response_right" cols="50" rows="2"><?php echo $question->response_right(); ?></textarea>
                            
                            <label for="response_wrong">Response (Wrong)</label>                                
                            <textarea name="response_wrong" id="response_wrong" cols="50" rows="2"><?php echo $question->response_wrong(); ?></textarea>
                            
                            <label for="text">Text</label>                                
                            <textarea name="text" id="text" cols="50" rows="2"><?php echo $question->text(); ?></textarea>
                            
                        </fieldset>
                        
                        <div class="table_header">Answers</div>
                        
                        <div class="answer_list">
							<?php
                                foreach($answers as $answer)
                                {												
                            ?>                       
                                    <fieldset class="ans_input" name="answer_<?php echo $answer->id(); ?>" id="answer_<?php echo $answer->id(); ?>">
                                        
                                        <input type="hidden" name="answer_id[]" value="<?php echo $answer->id(); ?>">
                                        
                                        <legend id="answer_legend_<?php echo $answer->id(); ?>">
                                            <a href="#" title="Remove this answer."><span class="color_red cmd_remove_answer">Remove</span></a>                           
                                        </legend>
                                                
                                        <p>
                                            <label for="answer_correct_<?php echo $answer->id(); ?>">Correct</label>
                                            <input 
                                                type="radio" 
                                                name="answer_correct" 
                                                id="answer_correct_<?php echo $answer->id(); ?>" 
                                                value="<?php echo $answer->id(); ?>"                                        
                                                <?php if($answer->correct() == TRUE) echo ' checked '; ?>                                        
                                            />                         
                                        </p>                                
                                        
                                        <p>                     
                                            <label for="answer_text_<?php echo $answer->id(); ?>">Text</label>                                
                                            <textarea name="answer_text[]" 
                                                id="answer_text_<?php echo $answer->id(); ?>" 
                                                cols="50" 
                                                rows="2"><?php echo $answer->text(); ?></textarea>
                                        </p>                                
                                    </fieldset>                                	                 
                            <?php							
                                }
                            ?>
                        
                        	<!--Answer fieldsets are inserted here by jQuery-->
                        </div>        
                          
                                
                    	<span class="legend color_green">
                        	<a href="#" title="Add new answer." id="answer_edit" class="answer_edit cmd_add_answer" data-a-edit="<?php echo ITEM_ID::FRESH; ?>">
                            	<span class="color_green">New Answer</span>
                            </a>
                        </span>
                    
                    	
                    
                    </form>   	           
                </div><!--#content-->       
            </div><!--#subContainer-->    
            <div id="sidePanel">		
				<?php include('a_question_nav.php'); ?>
            </div><!--#sidePanel-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--#footer-->
        </div><!--#constainer-->
        
        <div id="footerPad">
            <?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--#footerPad-->
        
        <script>	
		    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            
            ga('create', 'UA-40196994-1', 'uky.edu');
            ga('send', 'pageview');  
			
			var $temp_id = <?php echo ITEM_ID::FRESH; ?>;
			
			$(document).ready(function(e) {
                mode_button_state();					
				
            });
			
			// Add new input with associated 'remove' link when 'add' button is clicked.
			$('.cmd_add_answer').click(function(e) {
				e.preventDefault();
			
				$(".answer_list").append(
						'<fieldset class="ans_input" name="answer_' + $temp_id +'" id="answer_' + $temp_id +'">'
			
						+'<input type="hidden" name="answer_id[]" value="' + $temp_id +'">'
			
						+'<legend id="answer_legend_' + $temp_id +'">'
							+'<a href="#" title="Remove this answer."><span class="color_red cmd_remove_answer">Remove</span></a>'
						+'</legend>'					
					
						+'<p>'
						+'<label for="answer_correct_' + $temp_id +'">Correct</label>'
							+'<input type="radio" name="answer_correct" id="answer_correct_' + $temp_id +'" value="' + $temp_id +'" />'                         
						+'</p>'
						
						+'<p>'
							+'<label for="answer_text_' + $temp_id +'">Text</label> '
							+'<textarea name="answer_text[]" '
								+'id="answer_text_' + $temp_id +'" '
								+'cols="50" '
								+'rows="2"></textarea>'
						+'</p>'						
						);
					
					$temp_id--;
			});
			
			// Remove parent of 'remove' link when link is clicked.
			$('.answer_list').on('click', '.cmd_remove_answer', function(e) {
				e.preventDefault();
			
				$(this).parent().parent().parent().remove();
			});
			
			// Disable all but settings if new module is selected.
			$('#module').change(function(event)
			{	
				mode_button_state();	
			}); 
			
			function mode_button_state()
			{
				if($("#module").val() == <?php echo ITEM_ID::FRESH; ?>)
				{						
					$('#btn_questions').prop('disabled',true);
					$('#btn_access').prop('disabled',true);					
				}
				else
				{						
					$('#btn_questions').prop('disabled',false);
					$('#btn_access').prop('disabled',false);
				}
			}	
			
			
        </script>
    </body>
</html>