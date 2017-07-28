<?php

function date_conv_0001($cString, $cFormat="Y F")
{
	/*
	date_conv_0001
	Damon Vaughn Caskey
	Convert a big endian string month/year file name label to usable date. 

	cString = Date string.
	cFormat = Output format.
	
	Use: 
	
	$str = date_conv_0001("....2012_12.pdf", "Y F");
	echo $str
	
	"2012 December"
	*/
	
	$iYear 	= substr($cString, -11, 4);	//Extract year
	$iMonth	= substr($cString, -6, 2);	//Extract month.
	
    $timestamp = mktime(0, 0, 0, $iMonth, 1, $iYear);
    
    return date("Y F", $timestamp);
}

?>