<?php 
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."fire/";
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
        
        <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="//code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <script type="text/javascript" src="/libraries/javascript/jquery_ui_timepicker_addon.js"></script>
        
        <script>
			$(function(){
				$( '.date_entry' ).datetimepicker({dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss', changeYear: true, constrainInput: true, yearRange: ':'});
			});
		</script>
    </head>
    
    <body>    
        <div id="container">
            
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            
            <div id="subContainer">
                
				<?php include($cLRoot."a_banner_0001.php"); ?>
                
                <div id="subNavigation">
                    <?php include($cLRoot."a_subnav_0001.php"); ?> 
                </div><!--/subNavigation-->
                
                <div id="content">               	
                               
                    <form name="frm_drill" id="frm_drill">
                    
                    	<fieldset id="fieldset_location">
                        	<legend>Location</legend>
	
                            <label for="facility" id="facility_label" class="">Facility</label>
                            <select name="facility" id="facility" class="room_search required">		
                                    <option value="" selected="">Select Facility</option>
                                    <option value="0286">ASTeCC</option>
                                    <option value="9906">Lee Co. Homepl</option>
                                    <option value="9833">Audubon Med Pl East</option>		
                            </select>                                                                         	 
                            
                        </fieldset>
                    
                    	<fieldset id="fieldset_time">
                        	<legend>Time</legend>                    	
							
                            <label for="start" id="lbl_start" class="">Drill Start:</label>														
							<input type="text" required name="start" id="start" value="" readonly class="date_entry" />
                            
                            <label for="reset" id="lbl_start" class="">Alarm Reset:</label>														
							<input type="text" required name="reset" id="reset" value="" readonly class="date_entry" />						
                        </fieldset>
                        
                        <fieldset id="fieldset_result">
                        	<legend>Result</legend>
                            
                            <fieldset id="fieldset_evacuated">
                                <label for="evacuated" id="lbl_evacuated">Yes</label>
                                <input type="radio" name="evacuated" value="1">
                                
                                <label for="evacuated" id="lbl_evacuated">No</label>
                                <input type="radio" name="evacuated" value="0" />                                
                            </fieldset>
                            
                            <label for="evacuation_complete" id="lbl_evacuation_complete" class="">Evacuation Completed:</label>														
							<input type="text" required name="evacuation_complete" id="evacuation_complete" value="" readonly class="date_entry" />
                        </fieldset>
                       
                    	                    
                    </form>
                                        
                </div><!--/content-->
            
            </div><!--/subContainer-->
            
            <div id="sidePanel">		
                <?php include($cLRoot."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
            
        </div><!--/container-->
        
        <div id="footerPad">
        	<?php include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
        </div><!--/footerPad-->
        
        <script>
        $(".room_search").change(function() {
        
            var $url = '/libraries/inserts/rooms.php<?php echo '?'.$addsTopStr.'&'.$addsEndStr; ?>&attributes=required';
            var $target_element = $('.room');
            var $form = $('.class_register');
            var posting = null;
            
            $target_element.html('<div class="loading_inline"><span class="alert">Loading rooms/labs...</span> <img src="/media/image/meter_bar.gif" class="loadImage_insert" align="middle"></div>');
            
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