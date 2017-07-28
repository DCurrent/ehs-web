<!--Include: <?php echo __FILE__ . ", Last update: " . date(DATE_ATOM,filemtime(__FILE__)); ?>-->

<?php 	
	
	include($_SERVER['DOCUMENT_ROOT'].'/libraries/includes/inc_staff_bootstrap.php');
	
	class ehsweb_class_sidebar_general
	{	
		public function output_markup()
		{
			$markup = NULL;
			
			$_obj_staff_parameters	= new ehsweb_sidebar_class_data_account();
			$_obj_staff_parameters->set_department('3he00');
			
			$_obj_staff_markup 		= new ehsweb_sidebar_class_staff();
			$_obj_staff_markup->set_query_parameters($_obj_staff_parameters);
			$_obj_staff_markup->populate_from_database();
			$_obj_staff_markup->generate_markup_table_row();
			$_obj_staff_markup->generate_markup_table_complete();
			
			
			// Start output caching.
			ob_start();	
			?>
            
            <img class="img-responsive img-rounded" src="/media/image/building_ehs_front.jpg" alt="EHS Building" style="margin-bottom:20px"> 
                                       
                    <div id="contact_ehs" class="well well-sm">
                        <h4><a href="/">Environmental Health &amp; Safety</a></h4>

                        <p><a href ="http://ukcc.uky.edu/cgi-bin/dynamo?maps.391+campus+0314" target="_blank">252 East Maxwell Street<br />
                            Lexington, KY 40506-0314</a>
                        </p>
                        
                        <p>
                            Phone: <a href="tel:+18592573845" title="Call 859-257-3845.">859-257-3845</a><br />
                            Fax: <a href="tel:+18592578787" title="Call 859-257-8787.">859-257-8787</a>  
                        </p>  
                    </div><!--/contact_ehs-->
                    
                    <!--Include: C:\inetpub\EHS\a_contact_0001.php--><!--Include: C:\inetpub\EHS\a_accident.php, Last update: 2014-11-16T13:04:20-05:00-->
                    <div id="side_accident_reporting" class="well well-sm">
                        <h4><a href="/ohs/accident.php">Accident Reporting</a></h4>
                        
                        <p>Work Related <span class="color_red">Employee</span> Injuries <br />800-440-6285</p>
                        <p>Student or <span class="color_red">Visitor</span> Injuries<br /> 
                        <a href="/ohs/accident.php">Injury and Illness Reporting</a></p>
                      <p>Report <span class="color_red">unsafe conditions</span> to EHS<br />(859) 257-3827 or <a href="mailto:dwhibb0@email.uky.edu">send us an e-mail</a>.</p>
                        <p> After hours and weekends<br />UKPD <a href="tel:+18592571616" title="Call 859-257-1616.">859-257-1616</a> <span class="color_red">Emergencies</span> <a href="tel:+911" title="Call 911.">911!</a></p> 
                    </div>
                    
                    <div id="SubSideContent" class="well well-sm">
                        <h4><a href="/ehsstaff.php">Environmental Health & Safety Staff</a></h3>
            
            
            <?php
				echo $_obj_staff_markup->get_markup_table_complete();
			?>
            	<p><a href="/docs/pdf/orgchart.pdf" target="_blank">Organizational Chart</a></p>
                <p><a href="/ehsstaff.php">Complete EHS Staff Listing</a></p>
			
			<?php
			
			// Collect contents from cache and then clean it.
			$markup = ob_get_contents();
			ob_end_clean();	
			
			return $markup;	
		}
	}

	$_obj_ehsweb_sidebar_general = new ehsweb_class_sidebar_general();
	echo $_obj_ehsweb_sidebar_general->output_markup();

?>

<!--/Include: <?php echo __FILE__; ?>-->