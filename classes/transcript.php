<?php 

	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
		
	/*
	Damon V. Caskey
	2011-11-01
	~2011-12-08
	~2012-11-15
		-gen_query_0006
		-Remove uneeded includes.
	~2013-03-20
		-Object oriented. 
	~2013-09-10
		-HTML5.
		-Superfluous requires removed.
	~2014-03-20
		-Certificate link genetated by SQL server (not table code).
	~2015-05-30
		-Correct id_int to id.
	
	Create training quiz from database entries as identified by class ID.
	*/
	
	$quiz_id					= NULL;	//Quiz ID field ("id" in database).
	$cClassEmail				= NULL;	//Email recipiant list for completed quiz alert from DB. 
	$cClassTitle				= NULL;	//Quiz title.	
	$db_conn					= NULL;	//Database connection pointer.
	$query						= NULL;	//Query string.
	$result						= NULL;	//Query result pointer.
	$line						= NULL;	//Query field array.
	$cOutput					= NULL; //Result output.	
	
	/*User authorization*/	
	$oAcc->access_verify();	
		
	$query 	= "SELECT 
				desc_title																AS	'Class',
				class_date_char															AS	'Taken',			
				trainer_name															AS	'Trainer',
				cert_link																AS  'Certificate'						
				FROM vw_class_participant_list
				WHERE (account = ?)
				ORDER BY class_date desc";	
	
	$params = array($oAcc->get_account());

	$oDB->db_basic_select($query, $params, FALSE, TRUE, TRUE, TRUE);
	
	$cOutput =	$oTbl->tables_db_output($oDB, TRUE);		
		
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety, Class Transcript</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="/libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
    </head>
    
    <body>
    
        <div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--/mainNavigation-->
            <div id="subContainer">
                <div id="banner_container" class="banner_container">	
                    <div id="banner_content" class="banner">
                        University of Kentucky
                        <h1>EHS Safety Training - Class Transcript</h1>
                        <div id="banner_slogan" class="slogan">
                            UK Safety Begins with You!
                        </div><!--/banner_slogan-->
                    </div><!--/banner_content-->
                </div><!--/banner_container-->
                
                <div id="subNavigation">
                    <?php include("a_subnav_0001.php"); ?> 
                </div><!--/subNavigation-->
                <div id="content">       
                    <h1><?php echo $oAcc->get_name_f()." ".$oAcc->get_name_l();	?></h1>
                    
                    <p>This <span class="NoPrint">online </span>transcript serves as verification for all safety training taken by <?php echo $oAcc->get_name_f()." ".$oAcc->get_name_l(); ?> from 2012/01/20 as required by UK Environmental Health And Safety.</p> 
                    
                    <p class="NoPrint">You may also <a href="javascript:window.print()">print a copy</a> for your personal records.</p>            
                    
                    <?php echo $cOutput; ?>  
                </div><!--/content-->     
            </div><!--/subcontainer-->
            <div id="sidePanel">		
                <?php include($cDocroot."a_sidepanel_0001.php"); ?>		
            </div><!--/sidePanel-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--/container-->
        
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