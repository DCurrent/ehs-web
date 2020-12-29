<?php 

	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."ohs/";
		
	$cDList 	= array('Facility' => NULL, 'Room' => NULL);
	$oDBSpace	= NULL;
	$oFrmSpace	= NULL;
	
	// Initialize UK Space database object.
	$connect = new class_db_old_connect_params();	
	
	$connect->set_db_name('UKSpace');
	
	$oDBSpace = new class_db($connect);
	
	$oFrmSpace			= new class_forms(array("DB" => $oDBSpace));
	
	
	/* Prepare list arrays. */
	$cDList['Facility']	= $oFrmSpace->forms_list_array_from_query("SELECT DISTINCT BuildingCode, BuildingName FROM MasterBuildings WHERE (BuildingName <> '') ORDER BY BuildingName", NULL, array("Select Facility" => NULL));	//Facility.
	
	$cDList['Room'] 	= $oFrmSpace->forms_list_array_from_query(NULL, NULL, array("Not Available; Please Select a facility." => NULL));
	
	$fieldsetInstructions = array('Instructions');	
	
	/* Verify user is authorized  */
	$oAcc->access_verify();		
	
	$oFrm->forms_input("pi_name_f", class_forms::ID_USE_NAME, "First Name", class_forms::VALUE_DEFAULT_NONE, class_forms::VALUE_CURRENT_NONE, array("element" => NULL));	
	$oFrm->forms_input("pi_name_l", class_forms::ID_USE_NAME, "Last Name", class_forms::VALUE_DEFAULT_NONE, class_forms::VALUE_CURRENT_NONE, array("element" => NULL));
																	
	$oFrm->forms_fieldset("fs_pi", "Principal Investigator");
		
	$oFrm->forms_fieldset_addition('instructions', '<p>Select a facility first, then choose your primary room or lab.</p>');
																		
	$oFrm->forms_select("facility", class_forms::ID_USE_NAME, "Facility", class_forms::LABEL_USE_ITEM_KEY, $cDList['Facility'], NULL, class_forms::VALUE_CURRENT_NONE, array("element" => "room_search"));
									
	$oFrm->forms_select("room", class_forms::ID_USE_NAME, "Room/Lab", class_forms::LABEL_USE_ITEM_KEY, $cDList['Room'], NULL, class_forms::VALUE_CURRENT_NONE, array("element" => NULL));									
									 
	$oFrm->forms_fieldset("fs_location", "Location");	
?>

<!DOCtype html>
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Occupational Health &amp; Safety</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="/libraries/css/style.css" type="text/css" />

<link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
<script language="Javascript" type="text/javascript" src="/libraries/javascript/validate.js"></script>
<script language="Javascript" type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
<script language="Javascript" type="text/javascript" src="//code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
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
		<div id="content"> <h1>Chemical Hygiene Plan Annual Review</h1>
		  <p>OSHA's lab standard 29 CFR 1910.1450 requires labs conducting research with hazardous chemicals on a laboratory scale to have written, specific and current chemical hygiene plans. All labs should have a copy of the Model CHP and have filled it out to make it specific for that lab. An annual review is also required to keep the plan current. The following checklist has been provided for your assistance. Please complete the following form. After submitting the report you will be given an opportunity to print out a final copy for your records. If you have any questions regarding the form, contact <a href="mailto:Jacquelyn.rhinehart@uky.edu">Jackie Rhinehart</a>.</p>
          
          
          <div class="table_header">
          	Demographics
          </div>
          <form action="anrev_complete.php" method="post" name="CHP_Annual_Review" id="CHP_Annual_Review" class="standard_entry">
          <input type="hidden" name="email_list" value="Jacquelyn.rhinehart@uky.edu" />
		                  
          <?php 
		  	echo $oFrm->forms_fieldset_get("fs_pi");
		  	echo $oFrm->forms_fieldset_get("fs_location");		  
		  ?>
          
          <br/>
          <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr bgcolor="#DDDDFF">
              <th colspan="2" valign="top">Checklist</th>
            </tr>
            <tr bgcolor="#DDDDFF">
              <td valign="top"><input type="checkbox" name="binder" value="1" /></td>
              <td>Teal 
                binder with model Chemical Hygiene Plan inserted.
              </td>
            </tr>
            <tr bgcolor="#CECEFF">
              <td valign="top"><input type="checkbox" name="idpage" value="1" /></td>
              <td valign="top">Plan 
                Identification Page (page iii) is filled out 
              and current to within one year.</td>
            </tr>
            <tr bgcolor="#DDDDFF">
              <td height="18" valign="top"><input type="checkbox" name="procedures" value="1" /></td>
              <td height="18" valign="top">Standard 
                Operating Procedures for work involving hazardous 
                chemicals.
                <br />
              </td>
            </tr>
            <tr bgcolor="#CECEFF">
              <td valign="top"><input type="checkbox" name="perprot" value="1" /></td>
              <td valign="top">Personal 
                protective equipment for all tasks has been 
              assigned for work involving hazardous chemicals.</td>
            </tr>
            <tr bgcolor="#DDDDFF">
              <td valign="top"><input type="checkbox" name="ch10" value="1" /></td>
              <td valign="top">Chapter 
                10, Special provisions for select carcinogens, 
                reproductive toxins and acutely toxic chemicals, 
                has been reviewed and procedures completed as 
                applicable.
              </td>
            </tr>
            <tr bgcolor="#CECEFF">
              <td valign="top"><input type="checkbox" name="training" value="1" /></td>
              <td valign="top">CHP/Lab 
                Safety Training Program certificates for all 
                workers.
              </td>
            </tr>
            <tr bgcolor="#DDDDFF">
              <td valign="top"><input type="checkbox" name="appIII" value="1" /></td>
              <td valign="top">Lab 
                specific training records, Appendix III.
              </td>
            </tr>
            <tr bgcolor="#CECEFF">
              <td valign="top"><input type="checkbox" name="current" value="1" /></td>
              <td valign="top">Current 
                chemical inventory.
              </td>
            </tr>
            <tr bgcolor="#DDDDFF">
              <td valign="top"><input type="checkbox" name="signage" value="1" /></td>
              <td valign="top">Laboratory 
                signage, Appendix VIII, filled out and on the 
              lab entry door.
              </td>
            </tr>
            <tr bgcolor="#CECEFF">
              <td valign="top"><input type="checkbox" name="flammables" value="1" /></td>
              <td valign="top">Flammables 
                stored in the lab do not exceed limits described 
                in UK fact sheet <a href="/fire/flstpol1.html">/fire/flstpol1.html</a>.<br />
              </td>
            </tr>
          </table>
          
          <h2>Comments:<br />
            <textarea name="comments" cols="30%" rows="3"></textarea>
            <br />
            <br />
            <input type="submit" class="FormButton" name="Submit" value="Submit" />
            <input type="reset" class="FormButton" name="Reset" value="Reset" />
          </h2>
          </form>
		</div>       
	</div>    
	<div id="sidePanel">		
		<?php include($cLRoot."a_sidepanel_0001.php");	?>		
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

<script>
$(".room_search").change(function() {

	var $url = '/libraries/inserts/rooms.php?attributes=required';
	var $target_element = $('.room');
	var $form = $('.standard_entry');
	var posting = null;
	
	$target_element.html('<div class="loading_inline"><span class="alert">Loading rooms/labs...</span> <img src="/media/image/meter_bar.gif" class="loadImage_insert" align="middle" alt="Working..." title="Working..." /></div>');
	
	/* Put the results in a div */
	posting = $.post($url, $form.serialize());
	
	posting.done(function(data) 
	{	
		//alert("test:" + t);	
		//$(".loadImage").hide();
		$target_element.empty().append( data );
		//$(".result_table").show();
	});
});
</script>

</html>
