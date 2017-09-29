<?php 

	
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
 
	require($cDocroot."libraries/php/a_cred_master_0001.php");
	
	$c_vals						= array('phone'			=> NULL,
										'email'			=> NULL,
										'status'		=> NULL,
										'department'	=> NULL,
										'addroom'		=> NULL,
										'room'			=> NULL,
										'supervisor_namef'	=> NULL,
										'supervisor_namel'	=> NULL);
	
	$oAcc->access_verify();
	
	$name = $oAcc->get_name_full();	
?>

<!DOCtype html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "//www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="//www.w3.org/1999/xhtml">
<head>
<title>UK - Environmental Health And Safety</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />
<link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
        <script src="../libraries/javascript/jquery_ui_timepicker_addon.js"></script>
        <script src="../libraries/javascript/options_update.js"></script>    
<style>
	.input_coi
	{
		width:90%; 		
	};
	
	#White {
		color: #CCC;
			
		
	}
</style>
<link href="../libraries/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="container">
	<div id="mainNavigation">
		<?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
	</div>
	<div id="subContainer">
		<?php include($cDocroot."a_banner_0001.php"); ?>
		<div id="subNavigation">
		 	<?php include($cDocroot."a_subnav_0001.php"); ?> 
		</div>
		<div id="content">
			
            <p>
  <?php		
	
	if ($_SERVER['REQUEST_METHOD'] == 'GET'){
			
		$coi_select      = "<option value=0>Select COI</option>";      //COI droplist.
		$unit_select     = "<option value=0>Select Unit</option>";     //Unit type droplist.			
			
		//Open database.
		$db_conn = sqlsrv_connect($db_host, $db_connect);
		sqlsrv_query($db_conn, "USE ehs");
					
		//Query for basic page parameters.
		$query  = "SELECT * FROM chem_params";	
		$result = sqlsrv_query($db_conn, $query);
		$params = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC);
		$count  = $params[1] - 1;
					
		//Query for COI drop list items.
		$query  = "SELECT * FROM chem_coi_list ORDER BY coi_desc";
		$result = sqlsrv_query($db_conn, $query);
		
		while($line = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)){
			$coi_select = $coi_select . "<option value=$line[1]> $line[2] || $line[1] || $line[4]</option>";
		}
		
		//Query for unit drop list items.
		$query  = "SELECT DISTINCT * FROM chem_unit_list ORDER BY type";
		$result = sqlsrv_query($db_conn, $query);
		
		while($line = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)){
			$unit_select = $unit_select . "<option value=$line[4]> $line[4]</option>";
		}
				
		//sqlsrv_close($db_conn);
?>

<h1>DHS Chemical Facility Anti-Terrorism Standards</h1></p>
            <p>The Department of Homeland Security has issued a regulation entitled "Chemical Facilities Anti-Terrorism Standards" (CFATS). This rule applies to all entities that possess certain hazardous chemicals and is intended to prevent the intentional misuse of these chemicals via theft, sabotage, or attack. The regulation requires subject facilities to estimate the types and quantities of the chemicals on hand, and, in some cases, to develop site security plans and measures, perform training and drills, and maintain records. The Final Rule requires that University of Kentucky laboratories and non-laboratories collect and submit chemical inventories for a list of chemicals called Chemicals of Interest (COI).
              
            </p>
            <p>All COIs, including those present in a mixture, are required to be submitted. However, only COIs in a mixture at a concentration equal to or greater than ten percent (10%) by weight are required to be submitted.              </p>
            <p>The following six COIs have exceptions and are required to be submitted if the associated minimum concentrations are present:              </p>
            <ul>
              <li>Chlorine CAS# 7782505 - 9.77%              </li>
              <li> Nitric oxide CAS# 10102439 - 3.83% </li>
              <li> Phosgene CAS# 75445 - 0.17% </li>
              <li> Phosphine CAS# 7803512 - 0.67% </li>
              <li> Phosphorus trichloride CAS# 2125683 - 3.48% </li>
              <li> Sulfur tetrafluoride CAS# 7783600 - 1.33% </li>
            </ul>
<p>Inventory Worksheet: <a href="/docs/pdf/cfats_inventory_sheet_0001.pdf">Click Here </a></p>
            <p>Please enter the relevant COI information below. You may enter up to 20 at one time. </p>
<p>
    <form method="post" name="manual_entry" >
    
    <fieldset>
        <legend>Demographic</legend>
    
        <label for="user_date">Time</label>
        <input name="user_date" type="text" id="user_date" value="<?php echo (date(DATE_FORMAT)); ?>" class="datetimepicker" readonly /></td>
      
        <label for="party">Responsible Party</label>
        <input name="party" type="text" id="party2" value = "<?php echo $name; ?>" /> </td>
    </fieldset>
   		
        <fieldset>
                            	<legend>Location</legend>
                                
                                <p class="instructions">Select a facility first, then choose the area where incident or condition occurred. If the incident was outside, choose the nearest facility and select <span style="font-style:italic">Outside</span> in the Room field.</p>              
                
                                <div>
                                    <p id="facility_progress" class="load color_red center">
                                        Loading facilities...
                                        <img id="img_facility_load_progress" 
                                            src="../media/image/meter_bar.gif" 
                                            alt="Loading items... " 
                                            title="Loading items..." />
                                    </p>
                                    <label for="facility">Facility</label>
                                    <select name="facility" 
                                        id="facility" 
                                        data-current="<?php //echo $post->facility; ?>" 
                                        data-source-url="../libraries/inserts/facility.php" 
                                        data-extra-options='<option value="">Select Facility</option>'
                                        data-grouped="1"
                                        class="room_search">
                                        	<!--This option is for valid HTML5; it is overwritten on load.--> 
                                        	<option value="0">Select Facility</option>                                    
                                            <!--Options will be populated on load via jquery.-->                                 
                                    </select>
                                </div>
                    
                                <div>
                                    <p id="room_progress" class="load color_red center display_none">
                                        Loading rooms...
                                        <img id="img_room_load_progress" 
                                            src="../media/image/meter_bar.gif" 
                                            alt="Loading items... " 
                                            title="Loading items..." />                               
                                    </p>
                                    <label for="room">Room</label>
                                    <select name="room" 
                                        id="room" 
                                        data-current="<?php //echo $post->room; ?>" 
                                        data-source-url="../libraries/inserts/room.php" 
                                        data-grouped="1" 
                                        data-extra-options='<option value="">Select Room/Area/Lab</option><option value="-2">Outside</option>' 
                                        class="disable" 
                                        disabled required>
                                        	<!--This option is for valid HTML5; it is overwritten on load.--> 
                                        	<option value="1">Select Room/Area/Lab</option>
                                            <!--Options will be populated/replaced on load via jquery.-->
                                            <option value="">Select Room/Area/Lab</option>                                  							
                                    </select>                                    
                                </div>                                    	
                            </fieldset>  
 

<table>
	<tr> 
        <th>Chemical of Interest (COI || CAS#)</th>
        <th>Quantity</th>
        <th>Percentage</th>
        <th>Units/<a href="/docs/pdf/cfats_cylinder_comp_chart.pdf" target="_blank" id="White">Cylinder Size</a></th>
	</tr>
<?php 
  	
		for($i=0; $i<=$count; $i++)
		{
		?>	
			
            <tr> 
            	<td><select name="coi_<?php echo $i; ?>"        size="1"    id="coi_<?php echo $i; ?>"        class="input_coi"><?php echo $coi_select; ?></option> </select></td>
            	<td><input  name="quan_<?php echo $i; ?>"       type="text" id="quan_<?php echo $i; ?>"       value="1" size="10" class="input_coi"/></td>
            	<td><input  name="percentage_<?php echo $i; ?>" type="text" id="percentage_<?php echo $i; ?>" value="100" size="10" class="input_coi" /></td>
            	<td><select name="unit_<?php echo $i; ?>"       size="1"    id="unit_<?php echo $i; ?>"       class="input_coi"><?php echo $unit_select; ?></select></td>
            </tr>
		<?php
        }
	  
		echo '</table><br />
			 <input type="submit" name="Submit" value="Submit" />';
		 
	}else{
	 	
		//If user refreshes page, reload all and exit (otherwise code below will be run and spam database).
	 	//if(!$_SESSION['sent'] = true){ 
		//header('location:'.$_SERVER['SCRIPT_NAME']);
		//exit(); 
		//} 
		
		$oAcc_date = addslashes($_POST["user_date"]); //Posting time.
		$party     = addslashes($_POST["party"]);     //"Party" post value.
		$facility  = addslashes($_POST["facility"]);  //"Facility" post value.
		$room      = addslashes($_POST["room"]);      //"Room/area" post value.
		$i         = 0;             						   //Loop counter.
		$insert;											   //Query builing placeholder.
		
		//Make sure the user did not forget something or try to be lazy.
		if ($party && $facility && $room && addslashes($_POST["coi_" .$i]) != 0){		
			echo "<b>Submission <font color=\"green\">accepted</font color>. The following entries have been recorded:</b><br><br><table width=\"100%\" border=\"0\" cellpadding=\"1\">
				  <tr><td width=\"8%\"><b>Date/Time<b/></td><td width=\"92%\">$oAcc_date</td></tr><tr><td><b>Party</b></td><td>$party</td></tr><tr><td><b>Facility</b></td><td>
				  $facility</td></tr><tr><td><b>Area</b></td><td>$room</td></tr></table><br><table width=\"50%\" border=\"1\" cellpadding=\"0\" bgcolor=\"#F0F0FF\"><tr bgcolor=\"#CCCCCC\"> 
				  <td width=\"55\" height=\"19\"> <div align=\"center\"><strong>COI #</strong></div></td>
				  <td width=\"35\"><div align=\"center\"><strong> Percentage</strong></div></td>
				  <td width=\"35\"><div align=\"center\"><strong> Quantity</strong></div></td>
				  <td width=\"79\"><div align=\"center\"><strong>Units</strong></div></td></tr>";
			
			$db_connect 	= array("Database"=>$db_dbase, "UID"=>$db_user, "PWD"=>$db_pword);
			
			//Select database 
			$db_conn = sqlsrv_connect($db_host, $db_connect);
			sqlsrv_query($db_conn, "USE ehs");
			
			$query = '';
			
			//Loop through each possible coi entry. If a coi# is entered, insert record into database and output feedback for user.
			while(addslashes($_POST["coi_" .$i]) != 0){											
				$coi[$i]        = addslashes($_POST["coi_" .$i]);        //"Chemical of Interest (COI)" post value.
				$percentage[$i] = addslashes($_POST["percentage_" .$i]); //"Percentage" post value.
				$quan[$i]       = addslashes($_POST["quan_" .$i]);	      //"Quantity" post value.
				$units[$i]      = addslashes($_POST["unit_" .$i]);       //"Unit" post value.
							
				echo "<tr><td>" .$coi[$i] ."</td><td>" .$percentage[$i] ."</td><td>" .$quan[$i] ."</td><td>" .$units[$i] ."</td></tr>";	//Output values to page for visual feedback.
	
				if ($i>0) { $query = $query ." UNION ALL SELECT " ; } 																								//Add the needed kywords to create a union insert. This is so we run the insert query once below instead of banging on the server X times.
				$query = $query . "'$oAcc_date', '$party', '$facility', '$room', '" .$coi[$i] ."', '" .$percentage[$i] ."', '" .$quan[$i] ."', '" .$units[$i] ."'";	//Add insert values to query.
				$i++;																																				//Increment counter.
			}
			
			echo "</table><br>"; //Close table.
			
			$query = "INSERT INTO chem_main(user_date, party, facility, area, coi, percentage, quantity, units) SELECT " .$query .";"; //Finish query construction.						
			sqlsrv_query($db_conn, $query);																									   //Run query.
			//sqlsrv_close($db_conn);																											   //Make sure the database is closed.
			$_SESSION['sent'] = true;																								   //Close session.
		
		//User either forgot or tried to get lazy with entering some information. Do nothing, and send them a reminder.		
		}else{
			echo "<b>Submission <font color=\"red\">denied</font>. Please correct one or more of the following:</b><br>"; //Static message.
			if (!$party) {	echo "<br>Responsible Party missing."; }													  //Responsible party missing alert.
			if (!$facility) {	echo "<br>Facility missing."; }															  //Facility missing alert.
			if (!$room) {	echo "<br>Area/Room missing."; }															  //Area/room missing alert.
			if (!addslashes($_POST["coi_" .$i]) != 0) { echo "<br>No COIs provided."; }                          //COI missing alert.
			echo "<br><br><b>Click <a href=" .$_SERVER['SCRIPT_NAME'] .">here</a> to return</b>.";                        //Provie link to reset entry page.
			
		}

	}
	 
?>
</table></div></div>
<div id="sidePanel">		
			<?php 
				include($cDocroot."a_sidepanel_0001.php");        		 
             ?>		
		</div>
<div id="footer">
		<?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
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
        
			$('.room_search').change(function(event)
			{	
				options_update(event, null, '#room');	
			});
		
			$(function(){
						$( '.datetimepicker' ).datetimepicker({dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss', changeYear: true, constrainInput: true});
					});
		
        	$(document).ready(function(event) {		
				//options_update(event, null, '#agent');
				options_update(event, null, '#department');	
				options_update(event, null, '#facility');
				//	$("#department").attr('required', '');
				//('#facility').required = true;				
			});
        
        </script>
</body>
</html>