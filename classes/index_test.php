<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file. 
	$cLRoot		= $cDocroot."classes/";
?>

<!DOCtype html>
    <head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        
        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        
        <style>
		/* CSS Document */

			@media (max-width: 350px) {
			  .btn-responsive {
				padding:3px 6px;
				font-size:95%;
				line-height: 1.2;
			  }
			}
			
			@media (min-width: 351px) and (max-width: 450px) {
			  .btn-responsive {
				padding:4px 10px;
				font-size:100%;
				line-height: 2;
			  }
			}
			
			@media (min-width: 451px) {
			  .btn-responsive {
				padding:8px 15px;
				font-size:100%;
				line-height: 2;
			  }
			}
			
			.btn a
			{
				color:#FFF;
			}
			
			.icon-bar
			{
				background-color:#FFF;
			}
			
			.navbar a
			{
				color:#FFF;
			}
			
			.navbar a:hover
			{
				color:#000;
			}
			
			.navbar a:focus
			{
				color:#000;
			}
			
			.navbar a.disabled
			{
				color:#CCC;
			}
			/*
			.dropdown-menu
			{
				background-color: 			#224D7A;
			}
			
			.dropdown-menu > li > a
			{
				color:#FFF;
			}
			
			a.navbar-brand:hover
			{	
				text-decoration:			none;
				color:#FFF;
			}
			*/
			
			
			.navbar
			{
				background-color: 			#224D7A;
				background-image: 			linear-gradient(to bottom right, #3981CC 0%, #09131F 100%);
				border-radius:				5px;
				box-shadow: 				0px 5px 5px #888888;
				margin-top:5px;
			}
			
			.table tbody>tr>td.vert-align
			{
				vertical-align: middle;
			}
			
		</style>
        
    </head>
    
    <body>
        <div id="container" class="container">
        	<div class="row">
                <div id="mainNavigation" class="col-xs-12">
                	<?php include($cDocroot."libraries/includes/inc_mainnav_bootstrap.php"); ?>
                </div>
            </div>
            
            <div class="row">
            
                <div id="subContainer" class="col-xs-12">
                    <?php  // include("a_banner_0001.php"); ?>
                    <!--div id="subNavigation" class="col-xs-2">
                        <?php //include("a_subnav_0001.php"); ?> 
                    </div-->
                    
                    <div id="content" class="col-xs-9">
                        <table class="table table-striped table-hover">
                            <caption></caption>
                            <thead>
                            </thead>
                            <tfoot>
                            </tfoot>
                        	<tbody>
                            	
                                <tr>
                            	  <td><h3 id="laser_safety">Laser Safety</h3>
                                    <p>Training for clinicians, principal investigators, operators, etc., who will use Class IIIb or IV lasers. Completion is required upon registration and prior to use of a Class IIIb or IV laser(s).<br />
                                      <br />
                                  Contact <a href="mailto:glschl1@uky.edu">Dave Rich</a> at&nbsp;(859) 323-1008 for more information.</p></td>
                            	  <td class="vert-align"><a href="main.php?cClassID=16" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-play-circle"></span> Go!</a></td>
                          	  </tr>
                                
                                <tr>
                                  <td><h3 id="advanced_radiation_safety">Radiation Safety, Advanced</h3>
                                    <p>Required training for principal investigators, lab   managers, and others who have significant radioactive   materials experience and previous safety training, but   are new to UK. These personnel must complete the on-line class prior to their approval as an authorized user (AU).</p>
                                    <p>Contact <a href="../docs/pdf/rad_worker_reg_form_0001.pdf">Fred Rawlings</a> at  (859) 323-1008 for more information.</p></td>
                                  <td class="vert-align"><a href="main.php?cClassID=26" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-play-circle"></span> Go!</a></td>
                                </tr>
                                <tr>
                                
                                  <td><h3 id="basic_radiation_safety">Radiation Safety, Basic</h3>
                                    <p>Research personnel whose work involves the handling of radioactive materials are required to complete this training upon completing Initial Radiation Safety. Classes are available at the following times and locations:</p>
                                    <table class="table">
                                      <caption>
                                        Class Schedule
                                      </caption>
                                      <tr>
                                        <td>Thursday </td>
                                        <td>July 28</td>
                                        <td>09:00 to 12:00</td>
                                        <td><a href="http://ukcc.uky.edu/cgi-bin/dynamo?maps.391+campus+0076" target="_blank">Animal Pathology Bldg, rm. 202</a></td>
                                      </tr>
                                      <tr>
                                        <td>Wednesday            </td>
                                        <td>August 24</td>
                                        <td>09:00 to 12:00</td>
                                        <td><a href="http://ukcc.uky.edu/cgi-bin/dynamo?maps.391+campus+0076" target="_blank">Animal Pathology Bldg, rm. 202</a></td>
                                      </tr>
                                      <tr>
                                        <td>Thursday  </td>
                                        <td>September 22</td>
                                        <td>09:00 to 12:00</td>
                                        <td><a href="http://ukcc.uky.edu/cgi-bin/dynamo?maps.391+campus+0076" target="_blank">Animal Pathology Bldg, rm. 202</a></td>
                                      </tr>
                                      <tr>
                                        <td>Wednesday      </td>
                                        <td>October 26</td>
                                        <td>09:00 to 12:00</td>
                                        <td><a href="http://ukcc.uky.edu/cgi-bin/dynamo?maps.391+campus+0076" target="_blank">Animal Pathology Bldg, rm. 202</a></td>
                                      </tr>
                                      <tr>
                                        <td>Thursday</td>
                                        <td>November 17</td>
                                        <td>09:00 to 12:00</td>
                                        <td><a href="http://ukcc.uky.edu/cgi-bin/dynamo?maps.391+campus+0076" target="_blank">Animal Pathology Bldg, rm. 202</a></td>
                                      </tr>
                                      <tr>
                                        <td>Wednesday </td>
                                        <td>December 21</td>
                                        <td>09:00 to 12:00</td>
                                        <td><a href="http://ukcc.uky.edu/cgi-bin/dynamo?maps.391+campus+0076" target="_blank">Animal Pathology Bldg, rm. 202</a></td>
                                      </tr>
                                    </table>
                                    <h4>Check in at <a href="http://ukcc.uky.edu/cgi-bin/dynamo?maps.391+campus+0076">room 102</a> prior to class.</h4>
                                  <p>Contact <a href="main.php?cClassID=35">Bill Garner</a> at (859) 323-1009.</p></td>
                                  <td class="vert-align">&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><h3 id="initial_radiation_safety">Radiation Safety, On-Site and Initial for New Radiation Workers</h3>
                                    <p>All  individuals at UK  proposing to work with radioactive material or x-ray must, as per federal and  state regulations, receive On-Site &amp; Initial Radiation Safety Training  before starting as a radiation worker. Daily initial training sessions are available through the Radiation  Safety Office, 102 Animal   Pathology Building.</p>
                                    <p>All  workers must complete the <a href="../docs/pdf/rad_worker_reg_form_0001.pdf" target="_blank">Radiation Worker Registration Form</a> before training.</p>
                                    <p>The  first training is On-Site Training which must be provided by the Authorized  User or unit supervisor at the individual&rsquo;s place of work.&nbsp; A completed<a href="../docs/pdf/rad_research_onsite_training_form_0001.pdf" target="_blank"> Research On-Site Training Form</a> is provided to the individual as evidence of receiving this part of  the training. </p>
                                    <p>The  second part is the Initial Training. &nbsp;Initial Training is held Monday &ndash; Friday at  1:40pm at the Radiation Safety Office, 102 Animal Pathology Bldg. Please arrive  by 1:30pm so the receptionist can process your paperwork.&nbsp; If you cannot make this scheduled time, call  the Radiation Safety Office at 3-6777 to schedule a specific appointment.&nbsp; This training is a video and/or lecture  lasting about fifteen minutes.&nbsp; You will  receive the training form when you come to the training.</p>
                                    <p>The  individual must bring a copy of the signed <a href="../docs/pdf/rad_research_onsite_training_form_0001.pdf" target="_blank">Research On-Site Training Form</a> and a completed, signed <a href="../docs/pdf/rad_worker_reg_form_0001.pdf" target="_blank">Radiation Worker Registration Form</a> to the  Initial Training.&nbsp; If working in a lab,  the Worker Registration form must be signed the AU/PI who holds the license to  the lab.&nbsp; No one will be admitted without  both of these forms.</p>
                                    <p>The  On-Site and Initial training enables an individual to begin as a radiation  worker.&nbsp; Research workers are required to  attend the Basic Radiation Safety course. The Basic course is a three-hour lecture and  demonstration style course that covers radioactive material radiation  characteristics and safety in detail. Specific x-ray safety (diagnostic, veterinary, dental, research) courses  will be scheduled as needed.&nbsp; A  certificate will be awarded upon completion of Basic Radiation Safety.</p>
                                  <p>Contact (859) 323-6276 for more information.</p></td>
                                  <td class="vert-align">&nbsp;</td>
                                </tr>
                                <tr>
                                	<td><h3 id="analytical_xray">X-Ray Safety, On-Site and Analytical </h3>
                                      <p>In order to comply with federal and state regulations, all  individuals at UK  proposing to work with analytical x-ray radiation must register with the  Radiation Safety Office.&nbsp; This is accomplished  by completing the online Analytical X-ray Safety Training. The individual must then bring a copy  of the completed and signed <a href="../docs/pdf/rad_research_onsite_training_form_0001.pdf" target="_top">On-Site X-ray  Safety Training Form</a> and a  completed and signed <a href="../docs/pdf/rad_worker_reg_form_0001.pdf">Radiation Worker Registration  Form</a> to the Radiation  Safety office.
                                      </p>
                                      
                                      <p> Dosimetry will be issued upon submission of these two completed forms. <br />
                                        The On-Site X-ray Safety Training is provided by the Authorized User or unit  supervisor at the individual's place of work. <br />
  <br />
                                    Note: Completion of <a href="../docs/pdf/rad_research_onsite_training_form_0001.pdf" target="_top">On-Site X-ray  Safety Training Form</a> and <a href="../docs/pdf/rad_worker_reg_form_0001.pdf">Radiation Worker Registration  Form</a> plus the Initial  Radiation Safety training enables an individual to begin as a radiation worker;  however, additional, specific x-ray safety (diagnostic, veterinary, dental,  research) courses may be needed at the discretion of the Radiation Safety  Officer.</p></td>
                                    <td class="vert-align"><a href="main.php?cClassID=23" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-play-circle"></span> Go!</a></td>
                                </tr>
                                <tr>
                                  <td><h3 id="diagnostic_xray">X-Ray Safety, On-Site and Diagnostic </h3>
                                    <p>In  order to comply with federal and state regulations, all individuals at UK  proposing to work with diagnostic x-ray radiation must register with the  Radiation Safety Office by submitting a completed and signed <a href="../docs/pdf/rad_worker_reg_form_0001.pdf">Radiation Worker Registration  Form</a>, a completed and signed <a href="main.php?cClassID=35" target="_top">On-Site X-ray  Safety Training Form</a> and completing the Initial Radiation Safety Training.  Initial Training is held Monday &ndash; Friday at 1:40pm at the Radiation Safety  Office, 102 Animal Pathology Bldg. Please arrive by 1:30pm so the receptionist  can process your paperwork. If you  cannot make this scheduled time, call the Radiation Safety Office at 3-6777 to  schedule a specific appointment. This  training is a video and/or lecture lasting about fifteen minutes. You will receive the training form when you  come to the training.<br />
                                      <br />
                                      Dosimetry will be issued upon submission of these two completed  forms and completion of the Initial Radiation Safety Training course. 
                                      The On-Site X-ray Safety Training is provided by the Authorized User or unit  supervisor at the individual's place of work. <br />
                                      <br />
                                    Note: Completion of <a href="main.php?cClassID=35" target="_top">On-Site X-ray  Safety Training Form</a> and <a href="../docs/pdf/rad_worker_reg_form_0001.pdf">Radiation Worker Registration  Form</a> plus the Initial  Radiation Safety training enables an individual to begin as a radiation worker;  however, additional, specific x-ray safety (diagnostic, veterinary, dental,  research) courses may be needed at the discretion of the Radiation Safety  Officer.</p>
Contact (859) 323-6276 for more information.</td>
                                  <td class="vert-align">&nbsp;</td>
                                </tr>
                            	
                            </tbody>
						</table>            
                    </div> 
                    
                  <div id="sidePanel" class="col-xs-3">		
                        <?php //include($cDocroot."a_sidepanel_0001.php"); ?>
                        
                        <div id="contact_ehs" class="SubSideContent">
	<h3>Environmental Health &amp; Safety</h3>
    
    <p>
    	252 East Maxwell Street<br />
    	Lexington, KY 40506-0314
    </p>
    
    <p>
    	Phone: (859) 257-3845<br />
    	Fax: (859) 257-8787  
    </p>  
</div><!--/contact_ehs-->
<!--Include: C:\inetpub\EHS\a_contact_0001.php--><!--Include: C:\inetpub\EHS\a_accident.php, Last update: 2014-11-16T13:04:20-05:00-->
<div id="side_accident_reporting" class="SubSideContent">
    <h3><a href="/ohs/accident.php">Accident Reporting</a></h3>
    
    <p>Work Related <span class="color_red">Employee</span> Injuries <br />800-440-6285</p>
    <p>Student or <span class="color_red">Visitor</span> Injuries<br /> 
    <a href="/ohs/accident.php">Injury and Illness Reporting</a></p>
  <p>Report <span class="color_red">unsafe conditions</span> to EHS<br />(859) 257-3827 or <a href="mailto:dwhibb0@email.uky.edu">send us an e-mail</a>.</p>
    <p> After hours and weekends<br />UKPD (859) 257-1616 <span class="color_red">Emergencies</span> 911!</p> 
</div>


                        
                        <div id="SubSideContent" class="SubSideContent">
    <h3><a href="/ehsstaff.php">Environmental Health & Safety Staff</a></h3>
    
    <ul> 
      <li><a href="mailto:dwhibb0@uky.edu" title="Email David Hibbard.">David Hibbard</a><br /> Director<br /><a href="tel:+18592573845" title="Call 859-257-3845.">859-257-3845</a></li>
<li><a href="mailto:rdeldr0@uky.edu" title="Email Rachel Eldridge.">Rachel Eldridge</a><br /> Business Officer<br /><a href="tel:+18592571376" title="Call 859-257-1376.">859-257-1376</a></li>
<li><a href="mailto:kmcgu1@uky.edu" title="Email Kathryn Childress.">Kathryn Childress</a><br /> Data Coordinator, Sr.<br /><a href="tel:+18592579730" title="Call 859-257-9730.">859-257-9730</a></li>
<li><a href="mailto:dvcask2@uky.edu" title="Email Damon Caskey.">Damon Caskey</a><br /> IS Tech Support Specialist III<br /><a href="tel:+18592573241" title="Call 859-257-3241.">859-257-3241</a></li>
    </ul>
    
    <p><a href="/docs/pdf/orgchart.pdf" target="_blank">Organizational Chart</a></p>
    <p><a href="/ehsstaff.php">Complete EHS Staff Listing</a></p>
</div>		
                	</div>      
                </div>    
                
                
        	</div>
            
            <div id="footer" class="row">
				<?php //include($cDocroot."libraries/includes/inc_footer.php"); ?>		
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