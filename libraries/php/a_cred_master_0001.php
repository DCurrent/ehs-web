<?php
error_reporting(E_ALL);
	/*
	Damon V. Caskey
	11092010
	Credentials for MARS database connection.
	*/

	//$db_host		= "128.163.184.42";			//Database server name.
	//$db_host		= "sqldeva01\general";			//Database server name.
	$db_host		= "gensql\general";			//Database server name.
	$db_user		= "EHSInfo_User";			//Database user name.
	$db_pword		= "ehsinfo";				//Database user password.
	$db_dbase		= "ehsinfo";				//Target database.
	
	$db_connect 	= array("Database"=>$db_dbase, "UID"=>$db_user, "PWD"=>$db_pword, 'ReturnDatesAsStrings'=> true);
	
	$db_fail_msg	= "ERROR: Connection to database failed. <br>please contact the <a href=\"mailto:dvcask20@uky.edu\">webmaster</a> immediately. 257-3241";
?>