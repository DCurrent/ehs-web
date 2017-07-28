<?php require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. ?>

<!DOCtype html>
<html xmlns="//www.w3.org/1999/xhtml">
    <head>
        <title>UK - Occupational Health &amp; Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
        <script language="Javascript" type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
        <script language="Javascript" type="text/javascript" src="//code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
        
        <?php 
            $cLRoot		= $cDocroot."ohs/";
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
                    <h1>Respiratory Protection</h1>
                    <p>It is essential that respiratory protective equipment be properly fitted to the employee when it is issued.  All the care that went into the design and manufacture of a respirator to maximize protection will not protect the wearer if there is an improper match between facepiece and wearer or if the wearer follows improper wearing practices.  There are two considerations with respect to proper fit. </p>
                    <ol>
                      <li>Assuming that there are several brands of a particular type of facepiece available (you should provide several to choose from), which one fits best? </li>
                      <li>How does the user know when the respirator fits properly? </li>
                  </ol>
                    <p> The answers to the above questions can be determined by the use of a fit test.</p>
                    <hr>                    
                  <h2><a name="enrollment"></a>Program Enrollment</h2>
                    <p>Click a category to view. If you are unsure of which category applies to your work, please contact Occupational Health and Safety at 859-257-3827 for assistance.</p>
                    
<h3><a href="#" onClick="return false" class="category_select animal">Animal Handlers</a></h3>
                    <h3><a href="#" onClick="return false" class="category_select non_animal">Non-Animal Handlers</a></h3>
					                    
                    
                    <div class="program_enrollment"><!--Jquery will load content here-->                      
                    </div>
                    <hr>
                    
<h2>Written Program</h2>
                    <h2><a href="/docs/pdf/ohs_resp_program_template_0001.pdf">Template</a></h2>
                    <p>To develop a site specific written respiratory protection program. </p>
                    
                    <hr>
                    
                <h2>                  Useful Links</h2>
                    <p><a href="//www.youtube.com/watch?v=ovSLAuY8ib8">Respirators VS Surgical Masks</a><br />
                    <a href="/classes">UK OHS Respiratory Protection Training</a></p>
                    
                    <hr>
                    
                <h2>Chemical Cartridge Change Schedules</h2>
                    <p><a href="//www3.3m.com/SLSWeb/home.html?region=AMERICA®lId=20&langCode=EN&countryName=United States" class="no_icon"><img src="../media/image/3m.jpg" alt="" border="0" /></a>
                    <a href="//www.osha.gov/SLTC/etools/respiratory/change_schedule.html" class="no_icon"><img src="../media/image/osha2.jpg" alt="" border="0" /></a></p>
                    
                  <h2>NIOSH</h2>
                    <h2><a href="//www.cdc.gov/niosh/topics/respirators/" class="no_icon"><img src="../media/image/niosh.jpg" alt="" border = "0" /></a></h2>
                    <h2>OSHA Respirator Info</h2>
                    <h2><a href="//www.osha.gov/SLTC/respiratoryprotection/index.html" class="no_icon"><img src="../media/image/osha2.jpg" alt="" border = "0" /></a></h2>
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
			$(".category_select").click(function() {					
				element_select(this);			 			
			});
		
			function element_select($this)
			{
				var $url 			= 'respgate_content.php';
				var $target_element = $('.program_enrollment');
				var $loading		= '<div class="loading_inline"><span class="alert">Loading content...</span> <img src="/media/image/meter_bar.gif" class="loadImage_insert" align="middle" alt="Working..." title="Working..." /></div><div class="new_content"></div>';
				var $sub_div		= '.new_content';
				
				var	$source_div		= null;				
				var $class 			= null;
						
				$class 		= $($this).attr('class');
				$source_div = $class.substr($class.lastIndexOf(' ') + 1);							
				
				if($($this).hasClass("close"))
				{		
					$($sub_div).slideUp("slow", function(){
						$(target_element).empty();
					});				
				}
				else
				{					
					$($target_element).empty().append($loading).children($sub_div).hide().load($url+" ."+$source_div, function()
					{
						$(".loading_inline").remove(); 							  
						$($sub_div).slideDown("slow");					
					});
				}
				
			}	
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