<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); // Basic configuration file.
	
	if(!empty($_REQUEST['download_name']))
	{
		die("No download file name provided.");
	}

	// Get the file name from URL.
	// $file_name = preg_replace( '#[^-\w]#', '', $_REQUEST['download_name']);
	$file_name = urldecode($_REQUEST['download_name']);

	// Verify logged in with UK account.
	$oAcc->access_verify($_SERVER['PHP_SELF']."?download_name=".$file_name);
	
	// Now we need to get the document type so we can send correct headers
	$extension = end(explode('.', $document));
    $mimeType = '';
    switch ($extension) {
        case 'pdf':
            $mimeType = 'pdf';
            break;
        case 'doc':
            $mimeType = 'msword';
            break;
        case 'docx':
            $mimeType = 'msword';
            break;
        case 'xls':
            $mimeType = '';
            break;
        case 'xlsx':
            $mimeType = '';
            break;
        case 'ppt':
            $mimeType = '';
            break;
        case 'pptx':
            $mimeType = '';
            break;
    }       
    header('Content-type: application/' . $mimeType);
	

	$file_object = "{$_SERVER['DOCUMENT_ROOT']}/files/questions/{$file_name}.zip";
	


	if(file_exists( $question_file ))
	{
		header('Cache-Control: public');
		header('Content-Description: File Transfer');
		header("Content-Disposition: attachment; filename={$question_file}");
		header('Content-Type: application/zip');
		header('Content-Transfer-Encoding: binary');
		readfile($question_file);
		exit;
	}
?>