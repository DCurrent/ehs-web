<?php 
	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/config.php'); //Basic configuration file. 
	$cLRoot		= $cDocroot.'env/';
?>

<!DOCtype html>
	<head>
		<title>UK - Environmental Management</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
		<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="/libraries/javascript/popup_2.js"></script>
        
		<style>
			div.audit_button li
            {
				border-radius: 	5px;
                list-style:		none;
                display: 		inline-table;
                text-align:		center;
            }
			
			div.audit_button ul
			{
				list-style:none;
				display: 					inline-table;
				text-align:center;
			}
			
			div.audit_button ul li
			{
				display:inline-table;
			}
			
			div.audit_button ul li > a
			{
				color:#FFF;
				background-color:#03C;
				border:thick;
				border-color:#006;
				border-radius:5px;
				border-style:solid;
				display: 					inline-table;
				padding:10px 10px 10px 10px;
				margin-top:5px;
				margin-bottom:5px;
				transition: 				opacity .25s ease-in-out;
			}
			
			div.audit_button ul li > a:hover
			{
				font-style:					normal;
				opacity:					0.5;
			}
			
			div.box
			{
				border: thick solid;
				border-radius: 5px;
				opacity: 1;
				margin: 5px;
				padding: 5px;
				transition: opacity 0.25s ease-in-out 0s;
			}
			
			#pup {
				  position:absolute;
				  z-index:200; /* aaaalways on top*/
				  
				  margin-left: 10px;
				  margin-top: 5px;
				  width: 250px;
				  	background-color: 			#d9d9d9;
					background-image: 			linear-gradient(to bottom right, #F0F0F0 0%, #BDBDBD 100%);
					border: 					#979797 solid 1px;
					border-radius: 				5px;
					padding: 					5px;				
				}
			
		</style>
	</head>

	<body>

		<div id="container">
            <div id="mainNavigation">
                <?php include($cDocroot."libraries/includes/inc_mainnav.php"); ?>
            </div><!--#mainNavigation-->
            
            <div id="subContainer">
            
                <?php include($cLRoot."a_banner.php"); ?>
            
                <div id="subNavigation">
                    <?php include($cLRoot."a_subnav.php"); ?>	
                </div><!--#subNavigation-->
            
                <div id="content">
                	<h1>Environmental Auditing Practice &amp; Charter</h1>

                  	<p>The Environmental Management Department (EMD) is responsible for conducting
                    internal environmental compliance audits of all healthcare, academic, research,
                    and operational entities of the University. This function is authorized through an<br>
                    Environmental Audit Charter from the Executive Vice President for Finance and
                    Administration, the Provost, and the Executive Vice President Health Affairs to the
                  applicable entities in the University.</p>
                  	<p> By routinely monitoring the University areas
                    against function specific audit protocols using the <a href="//www.dakotasoft.com">Dakota Software Proactivity
                    Suite</a> and based on the Environmental Protection
                    Agency (EPA) and state regulatory requirements these audits will assist in
                    recognizing exemplary practices, identifying requirements to facilitate
                    environmental regulatory compliance and achieve potential operational
                    improvements. The process also assists in formulating action plans to address
                  identified opportunities for improvement and tracking the actions to closure.</p>
                    
                    
                  	<div class="audit_button">
                   		<ul>
                            <div class="box">
                                <li><a href="#" onmouseover="nhpup.popup($('#pop_audit_charter').html(), {'width': 400});">Audit Notification</a></li>
                                <li><a href="#" onmouseover="nhpup.popup($('#pop_audit_plan').html(), {'width': 400});">Audit Plan</a></li>
                            </div>
                            <p class="center">
                                <img src="../media/image/icon_arrow_down_lrg.png" width="100" height="104">
                            </p>  
                            <div class="box">
                                <li><a href="#" onmouseover="nhpup.popup($('#pop_opening_meeting').html(), {'width': 400});">Open Meeting (as necessary)</a></li>
                                <li><a href="#" onmouseover="nhpup.popup($('#pop_field_work').html(), {'width': 400});">Field Work</a></li>
                                <li><a href="#" onmouseover="nhpup.popup($('#pop_closing_meeting').html(), {'width': 400});">Closing Meeting (as necessary)</a></li>
                            </div>
                            <p class="center">
                                <img src="../media/image/icon_arrow_down_lrg.png" width="100" height="104">
                            </p>
                            <div class="box">
                                <li><a href="#" onmouseover="nhpup.popup($('#pop_preliminary_draft_report').html(), {'width': 400});">Preliminary Draft Report</a></li>
                                <li><a href="#" onmouseover="nhpup.popup($('#pop_final_draft_report').html(), {'width': 400});">Final Draft Report</a></li>
                            </div>
                            <p class="center">
                                <img src="../media/image/icon_arrow_down_lrg.png" width="100" height="104">
                            </p>
                            <div class="box">
                              <li><a href="#" onmouseover="nhpup.popup($('#pop_follow_up_review').html(), {'width': 400});">Follow Up Review</a></li>
                            </div>
                    	</ul>
                  	</div><!--.audit_button-->
                  	
                    <p class="center">
                    	<a href="//www.dakotasoft.com"><img src="../media/image/logo_dakota_soft_575.png" alt="Dakota Soft" style="border:none;"></a>
                    </p>
                    
                    <div id="pop_audit_charter" style="display:none;">
                        <h2>Audit Notification</h2>
                        <ul>
                        	<li>Custom audit profile and audit protocol developed using web based Dakota Productivity Suite.</li>
                          	<li>Issued by EMD to notify management of the planned audit.</li>
                          	<li>As an attachment, the planned audit protocol to be used may be included as appropriate. </li>
                        </ul>
                    </div>
                    
                    <!--Pop up divs-->                    
                    <div id="pop_audit_plan" style="display:none;">
                        <h2>Audit Plan</h2>
                        <ul>
                        	<li>Environmental Affairs Compliance Manager and department contact collaborate to finalize scope and schdule on the site evaluation.
                          	<li>Department completes preparation, including document gathering as necessary to facilitate the on site evaluation.</li>
                        </ul>
                    </div>
                    
                    <div id="pop_opening_meeting" style="display:none;">
                        <h2>Opening Meeting</h2>
                        <ul>
                        	<li>Meet the persons involved in the audit, answer any questions or concerns, clarify the audit intent, and review the timeline.</li>
                        </ul>
                    </div>
                    
                    <div id="pop_field_work" style="display:none;">
                        <h2>Field Work</h2>
                        <ul>
                        	<li>Evaluation of operation using the previously provided audit protocol.</li>
                            <li>Physical conditions tour.</li>
                            <li>Interview of representative personnel to determine the level of involvement and understanding at the operation.</li>
                        </ul>
                    </div>
                    
                    <div id="pop_closing_meeting" style="display:none;">
                        <h2>Closing meeting</h2>
                        <ul>
                        	<li>Verbal communication of audit results.</li>
                            <li>Achieve clarification and consensus regarding accuracy of the preliminary audit results.</li>                            
                        </ul>
                    </div>
                    
                    <div id="pop_preliminary_draft_report" style="display:none;">
                        <h2>Preliminary Draft Report</h2>
                        <ul>
                        	<li>Collaboration between department contact and auditor to insure accuracy.</li>
                            <li>Corrective actions, responsible persons and due dates are developed.</li>                            
                        </ul>
                    </div>
                    
                    <div id="pop_final_draft_report" style="display:none;">
                        <h2>Final Draft Report</h2>
                        <ul>
                        	<li>Issued by the auditor to the department contact and other applicable parties.</li>                        
                        </ul>
                    </div>
                    
                    <div id="pop_follow_up_review" style="display:none;">
                        <h2>Follow Up Review</h2>
                        <ul>
                        	<li>Department contact will provide updates regarding status of closure of corrective actions.</li>
                            <li>Auditor will conduct a follow up review at the facility to verify closure of corrective actions.</li>                        
                        </ul>
                    </div>
                    <!--/Pop up divs-->
                                 
				</div><!--#content-->
			</div><!--#subContainer-->
            <div id="sidePanel">				
                    <?php include("a_corner_image.php"); ?>
                    <?php include ($cLRoot."a_sidepanel.php"); ?>		
            </div><!--#sidePanel-->
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>
                
            </div><!--#footer-->
        </div><!--#container-->
        
       	
        
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