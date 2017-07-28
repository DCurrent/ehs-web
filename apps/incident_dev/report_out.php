<?php 

	// Set the number of results to display on each page.
	const PAGE_ROWS = 50;
	
	require('../../libraries/php/classes/database/main.php'); 	// Database class.
	require('source/main.php');
	
	require('../../libraries/php/classes/config.php'); //Basic configuration file.
	
	
	$cLRoot		= $cDocroot."ohs/";	
		
	// Verify login.
	$oAcc->access_verify();
	
	$query_request = new class_query_request();
	$request = new class_incident();
	
	// Get current post values that match incident item names. We'll use these for building a query.
	$request->populate_from_post();
	
	foreach ($it as $a => $b) 
	{
    	print $a.':'. $b.'<br />';
	}