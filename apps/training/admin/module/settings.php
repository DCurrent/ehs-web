<?php 

	require('../../../../libraries/php/classes/config.php'); //Basic configuration file.
	require_once('../../source/s_main.php');
		
	$local_root		= $cDocroot."classes/";
			
	// Post data.			
	class post extends class_module_data 
	{
		private
			$save_main	= NULL,
			$module		= NULL;	// Module currently edited.
		
		public function __construct()
		{
			$this->populate();			
	 	}
		
		// Interate through each class variable.
       	private function populate()
		{
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
		
		// Accessors
		public function get_save_main()
		{
			return $this->save_main;
		}
		
		public function get_module()
		{
			return $this->module;
		}
	}	
			
	//// Global variables.
	$time 			= date(DATE_FORMAT);	// Current date/time.
	$post			= new post();			// POST object.
	$get 			= new get();			// GET object.
	$db				= NULL;					// Database object.
	$query			= NULL;					// Query object.
	$main			= NULL;					// Line object, main table.
	$list_party_all	= NULL;					// Responsible patry list line object array.
	$list_party		= NULL;					// Responsible party list line object.
	$dialog			= NULL;					// Dialog to user.
	
	// Verify login.
	//$oAcc->access_verify();
		
	// Initialize DB connection and query objects.
	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);
	
	//// Process save commands.	
	if($post->get_save_main() == CONSTANTS::SAVE_MAIN)
	{	
		$query->set_sql("MERGE INTO tbl_class_train_parameters
			USING 
				(SELECT ? AS id_col) AS SRC
			ON 
				tbl_class_train_parameters.id = SRC.id_col
			WHEN MATCHED THEN
				UPDATE SET
					desc_title			= ?,
					desc_short			= ?,
					email_list			= ?,
					intro				= ?,
					material_above_head = ?,
					material_above		= ?,
					material_below_head	= ?,
					material_below		= ?,
					instr_head			= ?,
					instr				= ?,
					responsible_party	= ?,
					cert_verbiage		= ?,
					field_comments		= ?,
					field_facility		= ?,
					field_dept			= ?,
					field_addroom		= ?,
					field_mail			= ?,
					field_email			= ?,
					field_training_status	= ?,
					field_etrax			= ?,
					field_uk_status		= ?,
					field_ukid			= ?,
					field_supervisor	= ?,
					field_phone			= ?,
					hidden				= ?,
					question_order		= ?,
					question_quantity	= ?,
					question_layout		= ?,
					log_update			= ?,
					log_update_account	= ?,
					log_update_ip		= ?
			WHEN NOT MATCHED THEN
				INSERT (desc_title,	desc_short,	email_list,	intro, material_above_head,	material_above,	material_below_head, material_below, instr_head, instr, 					responsible_party, cert_verbiage, field_comments, field_facility, field_dept, field_addroom, field_mail, field_email, field_training_status, field_etrax, 					field_uk_status, field_ukid, field_supervisor, field_phone, hidden, question_order, question_quantity, question_layout, log_update, log_update_account, 					log_update_ip)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,	?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
				OUTPUT INSERTED.*;");
	
		$query->set_params(array($get->get_module(),
					$post->get_desc_title(),
					$post->get_desc_short(),
					$post->get_email_list(),
					$post->get_intro(),
					$post->get_material_above_head(),
					$post->get_material_above(),
					$post->get_material_below_head(),
					$post->get_material_below(),
					$post->get_instr_head(),
					$post->get_intr(),
					$post->get_responsible_party(),
					$post->get_cert_verbiage(),
					$post->get_field_comments(),
					$post->get_field_facility(),
					$post->get_field_dept(),
					$post->get_field_addroom(),
					$post->get_field_mail(),
					$post->get_field_email(),
					$post->get_field_training_status(),
					$post->get_field_etrax(),
					$post->get_field_uk_status(),
					$post->get_field_ukid(),
					$post->get_field_supervisor(),
					$post->get_field_phone(),
					$post->get_hidden(),
					$post->get_question_order(),
					$post->get_question_quantity(),
					$post->get_question_layout(),
					&$time,
					$oAcc->get_account(),
					$oAcc->get_ip(),
					$post->get_desc_title(),
					$post->get_desc_short(),
					$post->get_email_list(),
					$post->get_intro(),
					$post->get_material_above_head(),
					$post->get_material_above(),
					$post->get_material_below_head(),
					$post->get_material_below(),
					$post->get_instr_head(),
					$post->get_intr(),
					$post->get_responsible_party(),
					$post->get_cert_verbiage(),
					$post->get_field_comments(),
					$post->get_field_facility(),
					$post->get_field_dept(),
					$post->get_field_addroom(),
					$post->get_field_mail(),
					$post->get_field_email(),
					$post->get_field_training_status(),
					$post->get_field_etrax(),
					$post->get_field_uk_status(),
					$post->get_field_ukid(),
					$post->get_field_supervisor(),
					$post->get_field_phone(),
					$post->get_hidden(),
					$post->get_question_order(),
					$post->get_question_quantity(),
					$post->get_question_layout(),
					&$time,
					$oAcc->get_account(),
					$oAcc->get_ip()));
	
		$query->query();
		$query->get_line_params()->set_class_name('class_module_data');
		$main = $query->get_line_object();

		// Reset class name for next use of query object.
		$query->get_line_params()->set_class_name(NULL);

		$dialog = '<h2 class="color_green">'.$main->desc_title.' saved.</h2>';

	}
	else
	{	
		switch($get->get_module())
		{
			// New module.
			case ITEM_ID::FRESH:
				
				echo '<br />ITEM_ID::FRESH '.ITEM_ID::FRESH;
				
				$dialog = '<h2 class="color_green">New module. After filling out the forms, press Save and the module will be created.</h2>';
				
				// Initialize parameters object with default values.
				$main = new result_main(TRUE);
				break;
			
			// No module selected.
			case ITEM_ID::NONE:
				echo '<br />ITEM_ID::NONE '.ITEM_ID::NONE;
			
			
				$dialog = '<h2 class="color_green">No module selected. Choose a module to update. If you would like to start a new module, select <a href="?module='.ITEM_ID::FRESH.'">Create New Module</a>.</h2>';
				
				// Initialize a blank class module.
				$main = new class_module_data();
				break;
			
			// Previously exisiting module selected.
			default:
				echo '<br />Default';
							
				//// Query for current values in main table.		
				$query->set_sql('SELECT * FROM tbl_class_train_parameters WHERE id = ?');
				$query->set_params(array($get->get_module()));
				$query->query();
				
				// If a record is found, initialize row as class object. Otherwise initialize an
				// empty object so we have default values.
				if($query->get_row_exists())
				{
					$query->get_line_params()->set_class_name('class_module_data');
					$main = $query->get_line_object();
					
					// Reset class name for next use of query object.
					$query->get_line_params()->set_class_name(NULL);
					
					echo '<br />1';
				}
				else
				{
					$main = new class_module_data();
					
					echo '<br />2';
				}		
				break;		
		}
	}	
	
	echo '<br />module: '.$get->get_module();
	
	// Initialize the responsible party list object (creates a list of all responisble parties).
	$list_party_all = new class_list_responsible_party();	
	
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
                        <h1>Module Edit
						<?php 						
							if($main->get_desc_title())
							{
								echo ' - '.$main->get_desc_title(); 
							}
						?>
                        </h1>
                        <div id="banner_slogan" class="slogan">
                            UK Safety Begins with You!
                        </div><!--#banner_slogan-->
                    </div><!--#banner_content-->
                </div><!--#banner_container-->
                <div id="subNavigation">
                    <?php require('a_subnav.php'); ?> 
                </div>
                <div id="content">
                
                	<?php 
						echo $dialog;                     
                	
						if($main)
						{
					?>
                    
                            <div id="settings">
                                <form method="post" name="frm_settings" id="frm_settings">
                                	<input type="hidden" name="module" id="module" value="<?php echo $get->get_module(); ?>">
                                    <fieldset>
                                        <legend>Basic Setup</legend>
                                            
                                        <div>                                  
                                            <span class="label">Access Level</span>
                                            <div class="fieldset_box center">                               
                                                <?php 
                                                    $temp_class = new ReflectionClass ('MODULE_ACCESS');
                                                    $constants = $temp_class->getConstants();
                                                									
                                                    foreach($constants as $hidden_key => $hidden_value) 
													{
														// Set all lower case.
                                                        $hidden_key = strtolower($hidden_key);
                                                        // Set first letter of each word to upper case.
                                                        $hidden_key = ucwords($hidden_key);
                                                ?>
                                                        <input type="radio" 
                                                            name="hidden" 
                                                            id="hidden_<?php echo $hidden_value; ?>" 
                                                            value="<?php echo $hidden_value; ?>" 
                                                            <?php if($main->hidden == $hidden_value) echo "checked"; ?> />
                                                        <label for="hidden_<?php echo $hidden_value; ?>"><?php echo $hidden_key; ?></label>
                                                
                                                <?php												
                                                    }
													
													// Cleanup.
													unset($temp_class);
													$constants = array();
                                                ?>                                    
                                                
                                            </div>
                                        </div>
                                        
                                        <label for="desc_title">Title</label>
                                        <input type="text" name="desc_title" id="desc_title" value="<?php echo $main->get_desc_title(); ?>" placeholder="Class Title" required>
                                        
                                        <label for="desc_short">Descriptive Title</label>
                                        <input type="text" name="desc_short" id="desc_short" value="<?php echo $main->get_desc_short(); ?>" placeholder="Descriptive Class Title">
                                                                 
                                        <label for="email_list">Email List</label>
                                        <input type="email" name="email_list" id="email_list" value="<?php echo $main->get_email_list(); ?>" placeholder="address@domain.ext, address2@domain.ext, ...">
                                        
                                        <p>
                                        	<label for="intro">Introduction</label>
                                        	<textarea name="intro" id="intro" cols="50" rows="6" required><?php echo $main->get_intro(); ?></textarea>
                                    	</p>
                                        
                                    </fieldset>
                                    
                                    <fieldset>
                                        <legend>Material &amp; Instructions</legend>
                                            
                                        <label for="material_above_head">Material Above (Header)</label>                                
                                        <textarea name="material_above_head" id="material_above_head" cols="50" rows="2"><?php echo $main->get_material_above_head(); ?></textarea>
                                        
                                        <label for="material_above">Material Above</label>
                                        <textarea name="material_above" id="material_above" cols="50" rows="2"><?php echo $main->get_material_above(); ?></textarea>
                                        
                                        <label for="instr_head">Instructions Header</label>
                                        <textarea name="instr_head" id="instr_head" cols="50" rows="2"><?php echo $main->get_instr_head(); ?></textarea>
                                        
                                        <label for="instr">Instructions</label>                            
                                        <textarea name="instr" id="instr" cols="50" rows="6"><?php echo $main->get_instr(); ?></textarea>
                                        
                                        <label for="material_below_head">Material Below (Header)</label>
                                        <textarea name="material_below_head" id="material_below_head" cols="50" rows="2"><?php echo $main->get_material_below_head(); ?></textarea>
                                        
                                        <label for="material_below">Material Below</label>
                                        <textarea name="material_below" id="material_below" cols="50" rows="2"><?php echo $main->get_material_below(); ?></textarea>
                                              
                                    </fieldset>
                                   
                                    <fieldset>
                                        <legend>Registration Fields</legend>
                                        
                                        <p>Check any registration fields you would like to appear in module.</p>
                                                        
                                        <ul class="checkbox">                                    
                                            <?php                                       
                                                
												$temp_class = new ReflectionClass ('FIELD_TOGGLE_LIST');
                                                $constants = $temp_class->getConstants();												
												
                                                // Loop through the data members of main table object.
                                                foreach ($constants as $key => $value)
                                                {
													$key = strtolower($key);
													
													$field_method = 'get_'.$value.'()';		                                                                                                                                                
                                            ?>		
                                                    <li>
                                                        <input type="checkbox" 
                                                            name="<?php echo $key; ?>" 
                                                            id="<?php echo $key; ?>" 
                                                            value="<?php echo TRUE; ?>" 
                                                            <?php if($main->$field_method) echo "checked"; ?> />
                                                        <label for="<?php echo $key ?>"><?php echo $value; ?></label>
                                                    </li> 
                                            <?php
                                                    
                                                }
												// Cleanup.
												unset($temp_class);
												$constants = array();												
                                            ?>                                         	
                                        </ul>
                                    </fieldset>
                                   
                                    <fieldset>
                                        <legend>Question Setup</legend>
                                        
                                        <label for="question_quantity">Quantity</label>
                                        <input type="number" step="1" min="0" name="question_quantity" id="question_quantity" value="<?php echo $main->question_quantity; ?>" required>
                                        
                                        <div id="order_container">                                  
                                            <span class="label">Order</span>
                                            <div id="box_question_order" class="fieldset_box center">										
												<?php 
                                                    $temp_class = new ReflectionClass ('QUESTION_ORDER');
                                                    $constants = $temp_class->getConstants();
                                                
													// Cleanup.
													unset($temp_class);
												
                                                    foreach($constants as $question_order_key => $question_order_value) 
													{
														// Set all lower case.
                                                        $question_order_key = strtolower($question_order_key);
                                                        // Set first letter of each word to upper case.
                                                        $question_order_key = ucwords($question_order_key);
                                                ?>
                                                        <input type="radio" 
                                                            name="question_order" 
                                                            id="question_order_<?php echo $question_order_value; ?>" 
                                                            value="<?php echo $question_order_value; ?>" 
                                                            <?php if($main->get_question_order() == $question_order_value) echo "checked"; ?> />
                                                        <label for="question_order_<?php echo $question_order_value; ?>"><?php echo $question_order_key; ?></label>
                                                
                                                <?php
                                                    }
													
													// Cleanup.
													unset($temp_class);
													$constants = array();
                                                ?>
                                    		</div><!--#box_question_order-->
                                        </div><!--#order_container-->                                       
                                        
                                        <div id="layout_container">                                  
                                            <span class="label">Layout</span>
                                            <div id="box_layout" class="fieldset_box center">                             
                                            
                                            	<?php 
                                                    $temp_class = new ReflectionClass ('QUESTION_LAYOUT');
                                                    $constants = $temp_class->getConstants();
                                                
													// Cleanup.
													unset($temp_class);
												
                                                    foreach($constants as $question_layout_key => $question_layout_value) 
													{
														// Set all lower case.
                                                        $question_layout_key = strtolower($question_layout_key);
                                                        // Set first letter of each word to upper case.
                                                        $question_layout_key = ucwords($question_layout_key);
                                                ?>
                                                        <input disabled type="radio" 
                                                            name="question_layout_" 
                                                            id="question_layout_<?php echo $question_layout_value; ?>" 
                                                            value="<?php echo $question_layout_value; ?>" 
                                                            <?php if($main->get_question_layout() == $question_layout_value) echo "checked"; ?> />
                                                        <label for="question_layout_<?php echo $question_layout_value; ?>"><?php echo $question_layout_key; ?></label>
                                                
                                                <?php
                                                    }
													
													// Cleanup.
													unset($temp_class);
													$constants = array();
                                                ?>
                                            
                                            </div><!--#box_layout-->
                                        </div><!--#layout_container-->
                                    
                                    </fieldset>
                                   
                                    <fieldset>
                                        <legend>Certificates</legend>
                                        
                                        <div id="responsible_party_container">
                                            <label for="responsible_party">Responsible Party (Trainer)</label>
                                            <select name="responsible_party" id="responsible_party" required>
                                                <option value="">Select Trainer</option>
                                                <?php                                                    
													foreach($list_party_all->party_list() as $list_party)
													{											
														echo '<option value="'.$list_party->id.'"';
														
														if($main->get_responsible_party() === $list_party->id) echo ' selected ';
														
														echo '>'.$list_party->name_l.', '.$list_party->name_f.'</option>'.PHP_EOL;											
													}                                                   
                                                ?>
                                            </select>
                                        </div><!--#responsible_party_container-->
                                        
                                        <label for="cert_verbiage">Verbiage</label>                            
                                        <textarea name="cert_verbiage" id="cert_verbiage" cols="50" rows="6" required><?php echo $main->get_cert_verbiage(); ?></textarea>
                                    </fieldset>
                                
                                    <button type="submit" name="save_main" id="save_main" value="<?php echo CONSTANTS::SAVE_MAIN; ?>"><img src="/media/image/icon_save.png" class="cmd" alt="Save" title="Save"><br />Save Settings</button>
                                </form>
                        	</div><!--#Settings-->
					<?php
                        }
                    ?>                                                   	           
                </div><!--#content-->       
            </div><!--#subContainer-->    
            <div id="sidePanel">		
				<?php include($cDocroot."a_sidepanel_0001.php"); ?>
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
			
			$(document).ready(function(e) {
                mode_button_state();
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