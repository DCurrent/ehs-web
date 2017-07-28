
<!--Include: <?php echo __FILE__ . ", Last update: " . date(DATE_ATOM, filemtime(__FILE__)); ?>-->
<form method="post" name="frm_module" id="frm_module">
    <fieldset>
        
        <p>Choose a module and then press the appropriate button to add or edit questions, access, and settings. Note that when creating a new module, you must begin with settings.</p>
        
        <label for="module">Select Module</label>
        <select name="module" id="module">
            <option value="<?php echo ITEM_ID::NONE; ?>">Select Module</option>
            <?php 								
                // New module option.
                echo '<option value="'.ITEM_ID::FRESH.'"';
                if($main->id == ITEM_ID::FRESH) echo ' selected ';
                echo '>New Module</option>'.PHP_EOL;								
                
                // Database generated options.								
                foreach($list_module_all->result() as $list_module)
                {
                    echo '<option value="'.$list_module->id.'"';
                    if($main->id == $list_module->id) echo ' selected ';
                    echo '>'.$list_module->desc_title.'</option>'.PHP_EOL;
                }                                    
            ?>
        </select>                  
    
        <p class="center">
            <button type="submit" name="btn_settings" id="btn_settings" formaction="settings.php" class="color_green" style="font-weight:bold; font-style:italic">Settings</button>
            <button type="submit" name="btn_questions" id="btn_questions" formaction="questions.php">Questions</button>
            <button type="submit" name="btn_access" id="btn_access" formaction="access.php">Access</button>
        </p>
    </fieldset>
</form>

<p>
	<hr style="border: 0; height: 0; border-top: 1px solid rgba(0, 0, 0, 0.1); border-bottom: 1px solid rgba(255, 255, 255, 0.3);" />
</p>

<!--/Include: <?php echo __FILE__; ?>-->
