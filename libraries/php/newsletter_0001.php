<?php

	/*
	newsletter_0001
	2012_03_19
	Damon Vaughn Caskey
	
	Populate newsletter selection lists by scanning for uniform file names.
	
	cDir: 		Directory to search.
	cSearch:	Search string.
	cTopEntry:	Undated newsletter, usually an intro or instruction page.
	cTopEntryLabel:	If found, this is label the top entry will be given in selection box.
	*/
	
	require($cDocroot.'libraries/php/date_conv_0001.php');			//String to date conversion.
	require($cDocroot.'libraries/php/dir_scan_0001.php');			//Directory file scanner.

	function newsletter_0001($cDir, $cSearch, $cFile, $cTopEntry, $cTopEntryLabel)
	{	
		$cSel	= NULL;
		$aFiles = direcrtory_scan($cDir, $cSearch, 'name', 1);	
		
		foreach ($aFiles as &$aFilesE)
		{				
			if(strpos($aFilesE, $cTopEntry))
			{					
				$cSel .= "<option value='$cFile$aFilesE' selected='selected'>Listserv Subscription</option>";
			}				
			else
			{												
				$cSel .= "<option value='$cFile$aFilesE'>".date_conv_0001($aFilesE)."</option>";							
			}    			
		}		
		return $cSel;
	}
?>