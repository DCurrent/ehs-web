<?php 

	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 

	$formElement 	= NULL;	//Form fieldset elements.
	$cPosts			= NULL;	//Post array.
	$query			= NULL;	//Query string.
	$params		= NULL;	//Parameter array.

	// Initialize UK Space database object.
	$connect = new class_db_old_connect_params();	
	
	$connect->set_name('UKSpace');
	
	$oDBSpace = new class_db($connect);
	
	$oFrmSpace			= new class_forms(array("DB"=>$oDBSpace, "Err"=>$err, "Utl"=>$utl));

	/* Previously posted values. */
	$cPosts		= $utl->utl_get_post('facility');
	$cPosts		= $utl->utl_get_post('room');
	
	/* Create item list array from query.*/
	$fieldsetInstructions['Instructions'] = 'Select a facility first, then choose a room. If fire took place outside, choose the nearest facility and select "Outisde of Facility".<br /><br />';
	
	$query = "SELECT DISTINCT BuildingCode, BuildingName FROM MasterBuildings WHERE (BuildingName <> '') ORDER BY BuildingName";
	$oFrm->itemsList =	$oFrmSpace->forms_list_array_from_query($query, NULL, array("Select Facility" => NULL));
	
	$oFrm->forms_select("facility", class_forms::ID_USE_NAME, "Facility:", class_forms::LABEL_USE_ITEM_KEY, $oFrm->itemsList, $cPosts['facility'], class_forms::VALUE_CURRENT_NONE, array("element" => "standard"));
		
	$oFrm->itemsList = $oFrm->forms_list_array_from_query(NULL, NULL, array("Not Available; Please Select a facility." => NULL));	
									
	$oFrm->forms_select("room", class_forms::ID_USE_NAME, "Room:", class_forms::LABEL_USE_ITEM_KEY, $oFrm->itemsList, $cPosts['room'], class_forms::VALUE_CURRENT_NONE, array("element" => "standard"));												 
									
	$oFrm->forms_fieldset("fs_location", "Location");	
	/////
	
	$i = 0;
							  
	while ($i < 12)
	{							  
		$i++;
		
		if($i == date("n"))
		{
			echo '<option selected="selected"';
		}
		else
		{
			echo '<option';	
		}
	
		echo ' value = "'.$i.'">'.$i.'</option>';								
	}
	
	// Fieldset markup: Time
	$oFrm->forms_fieldset_addition('Instructions', '<p>Choose the maximum number of records that may be displayed.</p>');
		
	/* Create item list array from query.*/
	$oFrm->itemsList = array("25" => "TOP 25", 
								"50" => "TOP 50", 
								"100" => "TOP 100", 
								"500" => "TOP 500",
								"All" => NULL);	
	
	/* Create individiual field elements. */	
	$oFrm->formElement[0] = $oFrm->forms_radio("limit", class_forms::ID_USE_NAME, class_forms::LABEL_USE_ITEM_KEY, $oFrm->itemsList, NULL, $cLimitLst);
	
	/* Combine elements to single fieldset. */	
	$oFrm->forms_fieldset("fs_limit", "Display Limit");	
	//////////////////////////////////////////////////////////////////////////////////////

?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Environmental Health And Safety</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

<link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
<script language="Javascript" type="text/javascript" src="/libraries/javascript/update_content.js"></script>

<?php 
	$cLRoot		= $cDocroot."fire/";
?>

</head>

<body>

<div id="container">
	<div id="mainNavigation">
		<?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
	</div>
	<div id="subContainer">
		<?php include($cLRoot."a_banner_0001.php"); ?>
		<div id="subNavigation">
		 	<?php include($cLRoot."a_subnav_0001.php"); ?> 
		</div>
		<div id="content">
			<h1>Campus Fire Alarm Report</h1>
		  <p>Please use the selections below to create fire alarm report. When complete press &quot;Submit&quot;. </p>
		  <h2>&nbsp;</h2>
          
          <?php
		  	echo	$oFrm->forms_fieldset_get_all(); 
		  ?>
	  </div>       
	</div>    
	<div id="sidePanel">		
		<?php include($cLRoot."a_sidepanel_0001.php"); ?>		
	</div>
	<div id="footer">
		<?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
	</div>
</div>

<div id="footerPad">
<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-40196994-1', 'uky.edu');
  ga('send', 'pageview');

</script>
</body>
</html>