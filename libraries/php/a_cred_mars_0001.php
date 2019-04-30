<?php
error_reporting(E_ALL);
	/*
	Damon V. Caskey
	11092010
	Credentials for MARS database connection.
	*/

	

	$db_host		= "GENSQLAGL\general";			//Database server name.
	$db_user		= "EHSInfo_User";			//Database user name.
	$db_pword		= "ehsinfo";				//Database user password.
	$db_dbase		= "UKSpace";				//Target database.
	
	$db_connect 	= array("Database"=>$db_dbase, "UID"=>$db_user, "PWD"=>$db_pword);
	
	$db_fail_msg	= "ERROR: Connection to database failed. <br>please contact the <a href=\"mailto:dvcask20@uky.edu\">webmaster</a> immediately. 257-3241";
?>