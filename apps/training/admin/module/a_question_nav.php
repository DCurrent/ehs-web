<!--Include: <?php echo __FILE__ . ", Last update: " . date(DATE_ATOM,filemtime(__FILE__)); ?>-->

<?php
	$question_list_obj = new question_list();
	$question_list_obj->set_query($query);
	$question_list_obj->set_fk($get->module());
	$question_list_obj->set_from_db();
	
	$title = NULL;
?>

<div class="SubSideContent">
	<h3>Questions</h3>
    <nav id="" class="">
        <ul id="">                      
            <?php 								
                // New module option.
                echo '<li><a href="settings.php?m='.ITEM_ID::FRESH.'"><span';
                //if($question->id == ITEM_ID::FRESH) echo ' class="color_red" ';
                echo '>Create New Question</span></a></li>'.PHP_EOL;								
                
                // Database generated options.								
                foreach($question_list_obj->result() as $question_list_item)
                {
					// Let get our title text.
					$title = $question_list_item->title();
					
					// if there is no title text, call back to question text.
					if(!$title)
					{						
						$title = $question_list_item->text();					
					}
					
					// If the title is too long, trim it back and add continuation mark.
					if(strlen($title) > CONSTANTS::TITLE_LENGTH)
					{
						$title = substr($title, 0, CONSTANTS::TITLE_LENGTH).'...';
					}
					
			?> 										
                    <li>
                    	<a href="?m=<?php echo $get->module(); ?>&amp;q=<?php echo $question_list_item->id(); ?>" 
                        	title="<?php echo $question_list_item->text(); ?>"><?php echo $title; ?></a>
                    </li>
            <?php
                }                                    
            ?>
        </ul>
    </nav><!--/-->
</div>
<!--Include: <?php echo __FILE__; ?>-->