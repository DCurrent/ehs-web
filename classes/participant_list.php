<?php

	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
	require_once($cDocroot."libraries/php/classes/forms.php");
	require_once($cDocroot."libraries/php/classes/tables.php");

	$cLRoot			= $cDocroot;
	
	const DEBUG = FALSE;		//!= FALSE: Disables all training modules with maintenance alert to users; value is passed as an ETA. 
	
	$access_cn			= NULL;	//Current user account name.
	$auth_lvl			= NULL;	//Authorization level. Must be 1 or higher to view certain trianing (i.e. Select Agents).
	$cAuthorized_List	= NULL; //List of users authorized to view Select Agents training.
	$cAuthorized		= NULL; //Individual user authorized to view Select Agents training.
		
	// Verify user is authorized.
	$oAcc->access_verify();
		
	$access_cn			= $_SESSION['access_cn'];	
		
	// Set access level to 1 if user is on a list authorized to view Select Agents training participants.
	$cAuthorized_List = array("dvcask2", "bnels3", "dwhibb0", "glschl1", "rdeldr0", "kmcgu1", "hmtr222", "ejrous0");
	
	foreach($cAuthorized_List as $cAuthorized)
	{
		if($access_cn == $cAuthorized)
		{
			$auth_lvl = 1;
			break;	
		}
	}	
	
	// Store query as a session variable to be used by Table script. This ensures the table script cannot work on its own, even with POST data applied.
	$_SESSION['query'] = "SELECT 
					participant_name														AS	'Name',
					department																AS	'Dept',
					class_type_name															AS	'Class',
					CAST(class_date AS varchar(20))											AS	'Taken',			
					trainer_name															AS	'Trainer',
					id
													
					FROM vw_class_participant_list
					WHERE
						(class_date BETWEEN ? AND ?) AND
						((?='-1') OR (department = ?)) AND
						((?='-1') OR (class_type = ?) OR ((class_type = 21 OR class_type = 22 OR class_type = 23 OR class_type = 24 OR class_type = 25) AND ? = 14)) AND	
						((?='-1') OR (trainer_id = ?))	AND						
						((?='-1') OR (name_l = ?))	 	AND
						((?='-1') OR (name_f = ?)) 		AND
						((?='-1') OR (account = ?))
					ORDER BY class_date desc";
					
?>
<!DOCtype html>
    <head>
        <title>
        	UK - Environmental Health & Safety, Class Participant Search
		</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
        
        <script language="Javascript" type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script language="Javascript" type="text/javascript" src="//code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        <script language="Javascript" type="text/javascript" src="/libraries/javascript/jquery_ui_timepicker_addon.js"></script>
        <script>
            $(document).ready(function() {
                
                $(".loadImage_form").show();
                $(".loadImage").hide();
                $(".result_table").hide();
                
                $('.form_set').load('participant_list_form.php', function() {
                    $(".loadImage_form").hide();
					$(".form_set").slideDown(1000);
                });
            });
        </script>
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
                    <h1>Class Participants</h1>
                    
                    <p class="NoPrint">
                    	Use any combination of the following criteria  to create  a report  of users who have completed training courses provided by UK Environmental Health &amp; Safety.</p>
						<?php if(!$auth_lvl)
                        {
                        ?>
                            <p class="alert">
                            	Notice: Due to security regulations, this list excludes following modules. Please see  your <a href="transcript.php">personal transcript</a> or contact the listed department for more information:
							</p>
                            
                            <p>
                            	Irradiator - <a href="/radiation">Radiation Safety</a><br />
                            	Select Agents - <a href="/biosafety">Biosafety</a>
                            </p>
                        <?php 
                        }   
                        ?>
                    
                                       
                    <div class="table_header NoPrint" >
                    	Search Criteria
                    </div>         
                                        
                    <div class="form_set">
                    	<!-- Search criteria form will appear here. -->
                    	<center>
                        	<!-- Image appears while form is loading. -->
                        	<img src="../media/image/meter_circle_loading.gif" class="loadImage_form" align="middle">
                            
                            <p>Please note, due to the large amount of information loading may take several minutes.</p>
						</center>
                    </div>	 
                    
                    <p align="center">
                    	<!-- This image appears while search query is processing. -->
                    	<img src="../media/image/meter_circle_loading.gif" class="loadImage" align="middle">
                    </p>
                    
                    <div class="result_table">
                    	<!-- Result of search is rendered here. -->
                    </div>
            
            	</div>       
            </div>
            
            <div id="sidePanel">		
                <?php include($cDocroot."a_sidepanel_0001.php"); ?>	
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

