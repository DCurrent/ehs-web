<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
	
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
        
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
        <script src="/libraries/javascript/jquery_ui_timepicker_addon.js"></script>
        <script src="../libraries/javascript/options_update.js"></script>
        
        <style>
			.load_progress
			{
				text-align:center;
			}
		</style>
    </head>
    
    <body>
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div>
            <div id="subContainer">
                <?php include("a_banner_0001.php"); ?>
                <div id="subNavigation">
                    <?php include("a_subnav_0001.php"); ?> 
                </div><!--/subNavigation-->
                <div id="content">
                	<h1>Manual Entry</h1>                 	
                  
                  	<form action="manual_entry_submit.php" method="post" name="manual_entry" id="manual_entry" class="manual_entry NoPrint">
        
                        <fieldset name="fs_location" id="fs_location" class="">
                            <legend id="fs_location_legend" class="">Location</legend>
                            
                            <p class=" instructions">Select a facility first, then choose primary room/area or lab.</p>	
                              
                            <!--This is shown while new items are loaded and the form element directly below is hidden.-->			
                            <p class="facility_options_progress color_red center" style="display:none">
                                Loading facilities...
                                <img name="img_facility_load_progress" id="img_facility_load_progress" src="/media/image/meter_bar.gif" alt="Loading icon" title="Loading rooms" />
                            </p>  
                            <label for="facility" id="facility_label" class="">Facility</label>
                            <select name="facility" id="facility" class="room_search" data-update-selector=".room_options" required>		
                                <option value="" default selected>Select Facility</option>                                                                	               		
                            </select>
                
                            <!--This is shown while new items are loaded and the form element directly below is hidden.-->			
                            <p class="room_options_progress color_red center" style="display:none">
                                Loading Rooms...
                                <img name="img_room_load_progress" id="img_room_load_progress" src="/media/image/meter_bar.gif" alt="Loading icon" title="Loading rooms" />
                            </p>
                            <label for="room" id="room_label" class="label">Room/Lab</label>
                            <select name="room" id="room" class="room_options" data-source-url="../libraries/inserts/room.php" disabled="disabled" required>            	
                                <option value="" selected="">Select Room/Area/Lab</option>                         
                            </select>            	
                        </fieldset>
                                       
                        <p>
                            <button type="Submit" value="1" name="submit" id="submit">Submit</button>
                        </p>
                    </form>                 	       			
               	</div><!--/content-->
            </div><!--/subContainer-->
            <div id="sidePanel">		
				<?php include($cDocroot."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--container-->
        
        <div id="footerPad">
        	<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--/footerPad-->
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

<script>

$('.room_search').change(function(event)
{	
	options_update(event);	
});

$(document).ready(function() {
	
	options_update($('initial_load'));
		
	//$('.form_set').load('manual_entry_form.php', function() {
	//	$(".load_progress").hide();
		
	//});
});
</script>