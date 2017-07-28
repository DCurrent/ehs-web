<?php

require '/libraries/php/classes/session/main.php';
require('/libraries/php/classes/database/main.php'); 	// Database class.

// Initialize DB connection and query objects.
$db		= new class_db_connection();		
$query 	= new class_db_query($db);

$session_options = new class_session_options();

$session_options->set_db_connection($query);

$session = new class_session($session_options);

session_set_save_handler($session, true);
session_start();

// proceed to set and retrieve values by key from $_SESSION

$_SESSION['SOME DATA'] = 'Test, give it to me!';

echo 'Data: '.$_SESSION['SOME DATA'];

session_destroy();

?>

<!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Untitled Document</title>
 		<link rel="stylesheet" href="libraries/css/style.css" type="text/css" />
        <style>
			tr:first-child 
			{
				background-color:#0F9;	
			}
		</style>
    </head>
    
    <body>
    
    	<table>
        	<caption>Table Caption</caption>
            <thead>
            	<tr>
                	<th>Header 1</th>
                    <th>Header 2</th>
                    <th>Header 3</th>
                </tr>
            </thead>
            <tfoot>
            	<tr>
                	<th>Footer 1</th>
                    <th>Footer 2</th>
                    <th>Footer 3</th>
                </tr>
            </tfoot>            
            <tbody>            	
                <tr>
                	<td>A Item 1</td>
                    <td>A Item 2</td>
                    <td>A Item 3</td>
                </tr>
                <tr>
                	<td>B Item 1</td>
                    <td>B Item 2</td>
                    <td>B Item 3</td>
                </tr>
                <tr>
                	<td>C Item 1</td>
                    <td>C Item 2</td>
                    <td>C Item 3</td>
                </tr>                
            </tbody>
            
        </table>
    
    </body>
</html>