<?php

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	require('libraries/php/classes/database/main.php'); 	// Database class.

	class post
	{
		public $detail_save;
		public $detail_id;
		public $detail_title;
		public $detail_rate;
		public $detail_description;
		public $code_delete;
		public $code_save;
		public $code_code;
		public $code_name;
	}

	// Verify user authorization and get account info.
	$oAcc->access_verify(NULL, 'kmcgu1, rdeldr0, dwhibb0');

	$db			= NULL;	// Database object.
	$query		= NULL;	// Query object.
	$markup		= NULL; // Result markup.
	$options	= NULL;	// Option output object.
	$dialog		= NULL;	// Msg to user.
	$time 		= date(DATE_FORMAT);	// Current date/time.
	
	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);	
	
	$post = new post();	
	$post = (object)$_POST;
	
	// Details saved? Save and output, otherwise just output.
	if(isset($post->detail_save))
	{		
		// Update or insert main details.
		$query->set_sql('MERGE INTO tbl_object_codes_options
		USING 
			(SELECT ? AS Search_Col) AS SRC
		ON 
			tbl_object_codes_options.id = SRC.Search_Col
		WHEN MATCHED THEN
			UPDATE SET
				title			= ?,									
				rate			= ?,
				description		= ?,
				log_update		= ?, 
				log_update_account = ?, 
				log_update_ip	= ?
		WHEN NOT MATCHED THEN
			INSERT (title, rate, description, log_update, log_update_account, log_update_ip)
			VALUES (?, ?, ?, ?, ?, ?)
			OUTPUT INSERTED.*;');
		
		$query->set_params(array($post->detail_id,
			&$post->detail_title,
			&$post->detail_rate,
			&$post->detail_description,
			&$time,
			$oAcc->get_account(),
			$oAcc->get_ip(),
			&$post->detail_title,
			&$post->detail_rate,
			&$post->detail_description,
			&$time,
			$oAcc->get_account(),
			$oAcc->get_ip()
		));
		
		$dialog = 'Details saved.';
	}
	else
	{
		// Set SQL and parameter string.
		$query->set_sql('SELECT TOP 1 * FROM tbl_object_codes_options');
	}
	
	$query->query();
	$options = $query->get_line_object();	
	
	// Save or delete code?
	if(isset($post->code_delete))
	{		
		// Delete code.
		$query->set_sql('DELETE FROM tbl_object_codes OUTPUT DELETED.* WHERE id = ?');
		$query->set_params(array(&$post->code_delete));
	
		$query->query();
		$dialog_obj = $query->get_line_object();
		
		$dialog = 'Code '.$dialog_obj->code.', '.$dialog_obj->name.' deleted.';
	}
	else if(isset($post->code_save))
	{
		
		// Update or insert main details.
		$query->set_sql('MERGE INTO tbl_object_codes
		USING 
			(SELECT ? AS Search_Col) AS SRC
		ON 
			tbl_object_codes.id = SRC.Search_Col
		WHEN MATCHED THEN
			UPDATE SET
				code			= ?,									
				name			= ?,
				log_update		= ?,
				log_update_account = ?,
				log_update_ip = ?
		WHEN NOT MATCHED THEN
			INSERT (code, name, log_update, log_update_account, log_update_ip)
			VALUES (?, ?, ?, ? ,?)
			OUTPUT INSERTED.*;');
		
		// Set the post values we need based on id sent by pushed button.
		$post->code_code = $utl->utl_get_post('code_code_'.$post->code_save);
		$post->code_name = $utl->utl_get_post('code_name_'.$post->code_save);
		
		$query->set_params(array($post->code_save,
			&$post->code_code,
			&$post->code_name,
			&$time,
			$oAcc->get_account(),
			$oAcc->get_ip(),
			&$post->code_code,
			&$post->code_name,
			&$time,
			$oAcc->get_account(),
			$oAcc->get_ip()));
		
		$query->query();
		$dialog_obj = $query->get_line_object();
		
		$dialog = 'Code '.$dialog_obj->code.', '.$dialog_obj->name.' saved.';
	}
	
	// Create table row markup.
	// Set SQL and parameter string.	
	$query->set_sql('SELECT * FROM tbl_object_codes ORDER BY name');
	$query->query();

?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        <link rel="stylesheet" href="libraries/css/style.css" type="text/css" />    
        <link rel="stylesheet" href="libraries/css/print.css" type="text/css" media="print" />
        <style>
			tr.new 
			{
				background-color:#0F9;	
			}
			
			.cell_fill
			{
				width:95%;
				margin:2px;
			}
			
			img.cmd_inspection
			{
				height:24px;
				width:24px;
			}
			
			img.cmd
			{
				height:24px;
				width:24px;
			}
			table:button
			{
				height:32px;
				width:64px;
				
			}
		</style>
        
        <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    	<script src="libraries/jquery/tablesorter/jquery.tablesorter.js"></script>    
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
                </div><!--/SubNavigation-->
                <div id="content">
          			
                	<h1><?php echo $options->title; ?> Administration</h1>
                
                	<p>Use the following settings to modify content and appearance of <a href="objcodes.php" target="_blank" title="Go to <?php echo $options->title; ?>."><?php echo $options->title; ?></a> page. Any changes are reflected immediately and will appear on the next load/refresh.</p>
                
                	<?php
						
						// Status alert for user.
						if($dialog != '')
						{	
                			echo '<h3 class="color_green">'.$dialog.'</h3>'; 
						}
					?>
                
                	<form name="frm_detail" id="frm_detail" method="post">
                    	<input type="hidden" name="detail_id" id="detail_id" value="<?php echo $options->id; ?>" />                                                    
                     
                        <fieldset id="details">
                            <legend>Details</legend>
                            
                            <label for="detail_title">Title:</label>
                            <input type="text" name="detail_title" id="detail_title" form="frm_detail" value="<?php echo $options->title; ?>" maxlength="50" />
                                                   
                            <label for="detail_rate">Current Rate:</label>
                            <input type="number" name="detail_rate" id="detail_rate" form="frm_detail" value="<?php echo $options->rate; ?>" maxlength="10" step="0.00001" />&#37;
                                                  
                            <label for="detail_description">Description:</label>
                            <textarea name="detail_description" id="detail_description" form="frm_detail" cols="55"><?php echo $options->description; ?></textarea>
                        
                            <p class="center">
                                <button name="detail_save" id="detail_save" form="frm_detail" type="submit" value="1">
                                    <img src="media/image/icon_save.png" class="cmd" alt="Save" title="Save">
                                    <br />Save Details
                                </button>
                            </p>
                        </fieldset>
               		</form>
               
               		<form name="frm_code" id="frm_code" method="post">      
                        <div id="container_table_obj" class="overflow">
                            <table id="table_obj" class="tablesorter">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Record</th>
                                    </tr>
                                    
                                    <!--This row is for new record inserts. Placed in table header so it will not be sorted by jquery tablesorter.-->
                                    <tr class="new">										
                                        <td><input type="number" name="code_code_-1" id="code_code_-1" form="frm_code" class="cell_fill" value="" placeholder="New code" maxlength="6" /></td>
                                        <td><input type="text" name="code_name_-1" id="code_name_-1" form="frm_code" class="cell_fill" value="" placeholder="New name" maxlength="35" /></td>
                                        <td>
                                            <button type="submit" name="code_save" id="code_save_-1" form="frm_code" value="-1" title="Add new item.">
                                                <img src="media/image/icon_pencil.png" class="cmd" alt="Add" title="Add">
                                            </button>                    
                                        </td>											
                                    </tr>
                                </thead>
                                
                                <tfoot>
                                    <tr>
                                        <th colspan="3"><a href="#table_obj">Back to top</a></th>
                                    </tr>
                                </tfoot>
                                
                                <tbody>       	
                                                        
                                    <?php
                                    
                                    // Rows found in database?
                                    if($query->get_row_exists() === TRUE)
                                    {		
                                        // Get the 2D array of rows/columns.
                                        $line_object = $query->get_line_object_all();			
                                        
                                        foreach($line_object as $row)
                                        {
                                            
                                            $row->name = str_replace('&', '&amp;', $row->name);
                                        ?>
                                            <tr>										
                                                <td>
                                                	<!--Output an invisible copy of data outside form field for jquery tablesorter.-->
                                                    <span class="display_none"><?php echo $row->code; ?></span>
                                                    <input type="number" name="code_code_<?php echo $row->id; ?>" id="code_code_<?php echo $row->id; ?>" form="frm_code" class="cell_fill" value="<?php echo $row->code; ?>" placeholder="Code" />
                                                    
                                                </td>
                                                
                                                <td>
                                                	<!--Output an invisible copy of data outside form field for jquery tablesorter.-->                        	                          
                                                    <span class="display_none"><?php echo $row->name; ?></span>
                                                    <input type="text" name="code_name_<?php echo $row->id; ?>" id="code_name_<?php echo $row->id; ?>" form="frm_code" class="cell_fill" value="<?php echo $row->name; ?>" placeholder="Name" maxlength="35" /></td>
                                                <td>
                                                    <button type="submit" name="code_save" id="code_save_<?php echo $row->id; ?>" form="frm_code" value="<?php echo $row->id; ?>" title="Save this item.">
                                                        <img src="media/image/icon_save.png" class="cmd" alt="Save" title="Save">
                                                    </button>
                                                    <button type="submit" name="code_delete" id="code_delete_<?php echo $row->id; ?>" form="frm_code" value="<?php echo $row->id; ?>" title="Delete this item.">
                                                        <img src="media/image/icon_delete.png" class="cmd" alt="Delete" title="Delete">
                                                    </button>                                                
                                                </td>											
                                            </tr>
                                        <?php
                                        }				
                                    }
                                    else
                                    {
									?>	
                                    	<tr>
                                        	<td colspan="3">
                                            	<h3 class="color_red">No Records</h3>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    
                                    ?>
                                </tbody>
                            </table>
                        </div><!--/container_table_obj-->                                                      	
                    </form>
        		</div><!--/content-->       
            </div><!--subContainer-->    
            <div id="sidePanel">		
            	<?php include($cDocroot."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--/container-->
        
        <div id="footerPad">
        	<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--/footerPad-->
        <script>
			$(document).ready(function() 
				{ 
					$("#table_obj").tablesorter( {sortList: [[1,0]], headers: {2: {sorter: false}} } ); 
				} 
			);
		
		
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        
          ga('create', 'UA-40196994-1', 'uky.edu');
          ga('send', 'pageview');
        
        </script>
    </body>
</html>