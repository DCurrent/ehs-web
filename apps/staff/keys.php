<?php

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	require('../../libraries/php/classes/database/main.php'); 	// Database class.

	class post
	{		
		public $key_delete;
		public $key_save;
		public $number;
		public $possession;
		public $access;
	}

	// Verify user authorization and get account info.
	$oAcc->access_verify(NULL, 'rdeldr0, dwhibb0');

	$db			= NULL;	// Database object.
	$query		= NULL;	// Query object.
	$markup		= NULL; // Result markup.
	$options	= NULL;	// Option output object.
	$dialog		= NULL;	// Msg to user.	

	$db		= new class_db_connection();		
	$query 	= new class_db_query($db);	
	
	$post = new post();	
	$post = (object)$_POST;
	
	// Save or delete code?
	if(isset($post->key_delete))
	{		
		// Delete code.
		$query->set_sql('DELETE FROM tbl_key OUTPUT DELETED.* WHERE id = ?');
		$query->set_params(array(&$post->key_delete));
	
		$query->query();
		$dialog_obj = $query->get_line_object();
		
		$dialog = 'Key '.$dialog_obj->number.' deleted.';
	}
	else if(isset($post->key_save))
	{		
		// Update or insert key.
		$query->set_sql('MERGE INTO tbl_key
		USING 
			(SELECT ? AS Search_Col) AS SRC
		ON 
			tbl_key.id = SRC.Search_Col
		WHEN MATCHED THEN
			UPDATE SET
				number		= ?,													
				access		= ?,
				category	= ?
		WHEN NOT MATCHED THEN
			INSERT (number, access, category)
			VALUES (?, ?, ?)
			OUTPUT INSERTED.*;');
		
		// Set the post values we need based on id sent by pushed button.
		$post->number = $utl->utl_get_post('key_number_'.$post->key_save);		
		$post->access = $utl->utl_get_post('key_access_'.$post->key_save);
		$post->category = $utl->utl_get_post('key_category_'.$post->key_save);
		
		$query->set_params(array($post->key_save,
			&$post->number,			
			&$post->access,
			&$post->category,
			&$post->number,			
			&$post->access,
			&$post->category));
		
		$query->query();
		$dialog_obj = $query->get_line_object();
		
		$dialog = 'Key '.$dialog_obj->number.' saved.';
	}
		
	// Create table row markup.
	// Set SQL and parameter string.	
	$query->set_sql('SELECT * FROM tbl_key ORDER BY access');
	$query->query();
	
	$line_object = $query->get_line_object_all();
	
	// Query for category items.
	$query->set_sql("SELECT DISTINCT category FROM tbl_key WHERE category <> '' ORDER BY category");
	$query->query();
	
	$category_line_all = $query->get_line_object_all();
	
	// Lets create a data list of categories.
	foreach($category_line_all as $category_line)
	{
		$category_list .= '<option value="'.$category_line->category.'">'.PHP_EOL;
	}
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
        <link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />    
        <link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
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
    	<script src="../../libraries/jquery/tablesorter/jquery.tablesorter.js"></script>    
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
          		<datalist id="category_list">
                	<?php echo $category_list; ?>
                </datalist>
                	
                	<h1>Key Inventory</h1> 

					<?php
					
						// Status alert for user.
						if($dialog != '')
						{	
                			echo '<h3 class="color_green">'.$dialog.'</h3>'; 
						}
					?>
                              
               		<form name="frm_list" id="frm_list" method="post">      
                        <div id="container_table_obj" class="overflow">
                            <table id="table_obj" class="tablesorter">
                                <thead>
                                    <tr>
                                    	<th>Category</th>
                                        <th>Key #</th>                                         
                                        <th>Access</th>
                                        <th>Record</th>
                                    </tr>
                                    
                                    <!--This row is for new record inserts. Placed in table header so it will not be sorted by jquery tablesorter.-->
                                    <tr class="new">
                                    	<td>
                                        	<input type="text" name="key_category_0" id="key_category_0" form="frm_list" class="cell_fill" placeholder="Category" maxlength="50" list="category_list" />
                                        </td>										
                                        <td>
                                        	<input type="text" name="key_number_0" id="key_number_0" form="frm_list" class="cell_fill" placeholder="New Key #" maxlength="50"/>
                                        </td>
                                        <td>                                        	
                                            <textarea name="key_access_0" id="key_access_0" form="frm_list" class="cell_fill" rows="1" placeholder="New Key Access"></textarea>
                                        </td>                                        
                                        <td>
                                            <button type="submit" name="key_save" id="key_save_0" form="frm_list" value="0" title="Add new item.">
                                                <img src="../../media/image/icon_pencil.png" class="cmd" alt="Add" title="Add">
                                            </button>                    
                                        </td>											
                                    </tr>
                                </thead>
                                
                                <tfoot>
                                    <tr>
                                        <th colspan="4"><a href="#table_obj">Back to top</a></th>
                                    </tr>
                                </tfoot>
                                
                                <tbody>       	
                                	<?php
                                    
                                    // Rows found in database?
                                    if($query->get_row_exists() === TRUE)
                                    {	     		
                                        foreach($line_object as $row)
                                        {                                          
                                        ?>
                                            <tr>
                                            	<td>
                                                	<!--Output an invisible copy of data outside form field for jquery tablesorter.-->
                                                    <span class="display_none"><?php echo $row->category; ?></span>
                                                    <input type="text" name="key_category_<?php echo $row->id; ?>" id="key_category_<?php echo $row->id; ?>" form="frm_list" class="cell_fill" placeholder="Category" maxlength="50" value="<?php echo $row->category; ?>" list="category_list" />
                                                </td>                                            	                                            										
                                                <td>
                                                	<!--Output an invisible copy of data outside form field for jquery tablesorter.-->
                                                    <span class="display_none"><?php echo $row->number; ?></span>                                                  
                                                    <input type="text" name="key_number_<?php echo $row->id; ?>" id="key_number_<?php echo $row->id; ?>" form="frm_list" class="cell_fill" placeholder="Key #" maxlength="50" value="<?php echo $row->number; ?>"/>                               
                                                    
                                                </td>
                                                
                                                <td>
                                                	<!--Output an invisible copy of data outside form field for jquery tablesorter.-->                        	                          
                                                    <span class="display_none"><?php echo $row->access; ?></span>                                                  
                                                    <textarea name="key_access_<?php echo $row->id; ?>" id="key_access_<?php echo $row->id; ?>" form="frm_list" class="cell_fill" rows="1" placeholder="Key Access"><?php echo $row->access; ?></textarea>                                                    
                                                </td>                                                
                                                <td>
                                                    <button type="submit" name="key_save" id="key_save_<?php echo $row->id; ?>" form="frm_list" value="<?php echo $row->id; ?>" title="Save this item.">
                                                        <img src="../../media/image/icon_save.png" class="cmd" alt="Save" title="Save">
                                                    </button>
                                                    <button type="submit" name="key_delete" id="key_delete_<?php echo $row->id; ?>" form="frm_list" value="<?php echo $row->id; ?>" title="Delete this item.">
                                                        <img src="../../media/image/icon_delete.png" class="cmd" alt="Delete" title="Delete">
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
                                        	<td colspan="4">
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
					$("#table_obj").tablesorter( {sortList: [[1,0]], headers: {3: {sorter: false}} } ); 
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