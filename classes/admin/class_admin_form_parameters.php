<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	
	// Fieldset markup: Hidden
	$oFrm->forms_radio("param_hidden", $cID=class_forms::ID_USE_NAME, $labelStyle=class_forms::LABEL_USE_ITEM_KEY, array("Public" => 0, "Hidden" => 1, "Restricted" => 2), 2, $current=class_forms::VALUE_CURRENT_NONE, $cClass=array(), $events=NULL);
	
	$oFrm->forms_fieldset("fs_param_hidden", "Class Access <span class='param_hidden_help'><img src='/media/image/icon_question_mark_small.gif'></span>");	
	
	// Fieldset markup: Question Order
	$oFrm->formElement['param_display_order'] = $oFrm->forms_radio("param_display_order", $cID=class_forms::ID_USE_NAME, $labelStyle=class_forms::LABEL_USE_ITEM_KEY, array("Linear" => 0, "Manual" => 1, "Random" => 2), 2, $current=class_forms::VALUE_CURRENT_NONE, $cClass=array(), $events=NULL);
	
	$oFrm->forms_fieldset("fs_param_display_order", "Order <span class='param_display_order_help'><img src='/media/image/icon_question_mark_small.gif'></span>");	
		
	// Fieldset markup: Question Layout
	$oFrm->forms_radio("param_question_layout", $cID=class_forms::ID_USE_NAME, $labelStyle=class_forms::LABEL_USE_ITEM_KEY, array("List" => 0, "Paged" => 1), 2, $current=class_forms::VALUE_CURRENT_NONE, $cClass=array(), $events=NULL);
	
	$oFrm->forms_fieldset("fs_param_question_layout", "Layout <span class='param_question_layout_help'><img src='/media/image/icon_question_mark_small.gif'></span>");	
	
	$oFrm->forms_fieldset("fs_param_question_setup", "Question Setup");	
;

?> 

<!DOCtype html>
    <head>
    	<meta http-equiv="Content-type" content="text/html;charset=utf-8" />
        <title>UK - Environmental Health And Safety, <?php //echo $cClassTitle; ?></title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
        
        <script language="Javascript" type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script language="Javascript" type="text/javascript" src="//code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    </head>
    
    <body>
        <div id="container">
            <div id="mainNavigation">
                <?php //include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div>
            
            <div id="subContainer">
				<?php //include($cDocroot."a_banner_0001.php"); ?>
                <div id="subNavigation">
                	<?php //include($cDocroot."a_subnav_0001.php"); ?> 
                </div><!--subNavigation-->
                
                <div id="content">        
                
                    <div id="parameters">
                        <?php
                            // Insert fieldset markups.
                            echo	$oFrm->forms_fieldset_all_get();
                        ?>
                    </div>                         
                    
                </div><!--/Content-->       
            </div>    
            <div id="sidePanel">		
            	<?php //include($cDocroot."a_sidepanel_0001.php"); ?>	
            </div>
            <div id="footer">
            	<?php //include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div>
        </div>
        
        <div id="footerPad">
        	<?php //include($cDocroot."libraries/includes/inc_footerpad.php"); ?>
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
		$(".param_hidden_help").click(function(event) 
			{
				alert('Hidden: General availability of the class module to end users. Restricted setting will limit the module to a defined set of users (if provided).');
			});
		
		$(".param_display_order_help").click(function(event) 
			{
				alert('Question Order: Order in which questions are presented. This is an important setting as it is possible to have more questions available than are actually presented to the end user. Linear setting will simply output questions in the exact order they are found in the database. Manual order will use the designated number that can be assigned to each question. As the name implies Random will select and order questions randomly.');
			});
	
		$(".param_question_layout_help").click(function(event) 
			{
				alert('Question Layout: How questions will be presented. One page at a time, or all questions on a single page.');
			});
	</script>
</html>