<?php	

function gen_droplist_0002($cItems, $default=NULL, $current=NULL){		
		
	/*
	gen_droplist_0002
	Damon Vaughn Caskey
	2011_04_05
	
	Populate html form droplist from array.
		
	default	= Default display (key in array).
	current	= Last selected item.
	cItems		= Arracy of items.
	*/

	$list	=	NULL;	//Output string.
		
	foreach ($cItems as $key => $value)
	{		
		if ($current == $key || (!$current && $key == $default))
		{			
			$list .= "<option value='$value' selected>" . $key . "</option>";
		}
		else
		{
			$list .= "<option value='$value'>" . $key . "</option>";		
		}
	}
		
	return $list;
}
?>



