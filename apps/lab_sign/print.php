<?php 
	
	require('source/main.php');
	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/config.php'); // Basic configuration file. 
	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/database/main.php'); // Database handler.
	require($_SERVER['DOCUMENT_ROOT'].'/libraries/vendor/mpdf/mpdf.php'); // pdf

	// Verify user is authorized.
	//$oAcc->access_verify();

	// Initialize pdf maker class.
	$pdf_gen = new mPDF();
	
	$pdf_gen->SetTitle(settings::TITLE);
	//$pdf_gen->SetAuthor($oAcc->get_name_full());
	$pdf_gen->setAuthor('NA');
	$pdf_gen->SetCreator('Caskey, Damon V.');
	
	///////////////////////////////////////////////////////////////////////////////
	
	$post		= new class_data_sign();	// Post values object.
	$db_space	= NULL;	// Master control object for database handler (UKSpace).
	$height		= 0;	// Height setting for sign alerts.

	unset($oDB);	
	
	
	// We want all the sign alerts to be equal height, so use a default height, 
	// and adjust for sign requests that will need more room.
	$height = 200;	
	//if($post->get_explosives()) $height = 150;	
	//if($post->get_flammables() || $post->get_irritant() || $post->get_carcinogen()) $height = 200;
	
	$department_name = NULL;
	
	$db = new class_db_connection();
	$query = new class_db_query($db);
	
	// Get department label items.
	$query->set_sql('SELECT name
						FROM vw_uk_space_department 
						WHERE     (number = ?)');
	$query->set_params(array($post->get_department()));
	$query->query();
	
	if($query->get_row_exists()) $department_name = $query->get_line_object();
	
	// Get room label items.
	$query->set_sql('SELECT * 
						FROM vw_uk_space_room 
						WHERE     (barcode = ?)');
	$query->set_params(array($post->get_room()));
	$query->query();
	
	if($query->get_row_exists()) $room_data = $query->get_line_object();
	
	// Get laser label items.
	$query->set_sql('SELECT text
						FROM tbl_list_laser 
						WHERE     (id = ?)');
	$query->set_params(array($post->get_laser()));
	$query->query();
	
	if($query->get_row_exists()) $laser = $query->get_line_object();
	
	// Get bsl label items.
	$query->set_sql('SELECT text, image
						FROM tbl_list_bsl 
						WHERE     (id = ?)');
	$query->set_params(array($post->get_bsl()));
	$query->query();
	
	if($query->get_row_exists()) $bsl = $query->get_line_object();	
	
	$signs = array();
	
	// Check each hazard item post and add to signs array if present.
	// To do: Move items to database table.
	if($post->get_flammables())
	{
		$signs[] = '<img src="../../media/image/hazard_flammables.png" alt="Flammables" class="hazard_sign" />
		
		<h4 class="hazard_sign">
			Flammables<br />
			Self Reactives<br />
			Pyrophorics<br />
			Self-Heating<br />
			Emits Flammable Gas<br />
			Organic Peroxides
		</h4>';                     
	}

	if($post->get_oxidizers())
	{
		$signs[] = '                       
			<img src="../../media/image/hazard_oxidizers.png" alt="Oxidizers" class="hazard_sign" />
			
			<h3 class="hazard_sign">
				Oxidizers
			</h3>';                                     
	}
				
	if($post->get_explosives())
	{
		$signs[] = '                                     
			<img src="../../media/image/hazard_explosives.png" alt="Explosives" class="hazard_sign" />
			
			<h4 class="hazard_sign">
				Explosives<br />
				Self Reactives<br />
				Organic Peroxides
			</h4>';
	} 
	
	if($post->get_corrosives())
	{
		$signs[] = '                                       
			<img src="../../media/image/hazard_corrosives.png" alt="Corrosives" class="hazard_sign" />
			
			<h3 class="hazard_sign">
				Corrosives
			</h3>';
	} 

	if($post->get_magnetic())
	{
		$signs[] = '
			<img src="../../media/image/hazard_magnetic.png" alt="Magnetic Field" class="hazard_sign" />
			
			<h3 class="hazard_sign">
				Strong<br /> Magnetic Field
			</h3>'; 
	}
	
	if($post->get_carcinogen())
	{
		$signs[] = '
			<img src="../../media/image/hazard_carcinogen.png" alt="Carcinogen" class="hazard_sign" />
			
			<h4 class="hazard_sign">
				Carcinogen<br />
				Respiratory Sensitizer<br />
				Reproductive Toxicity<br />
				Target Organ Toxicity<br />
				Mutagenicity<br />
				Aspiration Toxicity
			</h4>';
	}							
				   
	if($post->get_irritant())
	{
		$signs[] = '                                       
			<img src="../../media/image/hazard_irritant.png" alt="Irritant" class="hazard_sign" />
			
			<h4 class="hazard_sign">
				Irritant<br />
				Dermal Sensitizer<br />
				Acute toxicity (harmful)<br />
				Narcotic Effects<br />
				Respiratory Tract<br />
				Irritation
			</h4>';
	} 

	if($post->get_toxicity())
	{
		$signs[] = '                                       
			<img src="../../media/image/hazard_toxicity.png" alt="Toxicity" class="hazard_sign" />
			
			<h3 class="hazard_sign">
				Acute Toxicity<br />
				(Severe)
			</h3>';
	} 
	
	if($post->get_pressure())
	{
		$signs[] = '
			<img src="../../media/image/hazard_pressure.png" alt="Pressure" class="hazard_sign" />
			
			<h3 class="hazard_sign">
				Gas Under<br />
				Pressure
			</h3>';
	} 
	
	if($post->get_laser())
	{
		$signs[] = '
			<img src="../../media/image/hazard_laser.png" alt="Laser" class="hazard_sign" />
		
			<h3 class="hazard_sign">
				Class '.$laser->text. 'Laser'.
			'</h3>';
	} 

	if($post->get_radioactive())
	{
		$signs[] = '
			<img src="../../media/image/hazard_radiation.png" alt="Radiation" class="hazard_sign" />
			
			<h3 class="hazard_sign">
				Radioactive<br /> 
				Material
			</h3>';
	}

	if($post->get_biohazards())
	{
		$signs[] = '
			<!--img src="../../media/image/hazard_bio.png" alt="Biohazard" class="hazard_sign" -->
		
			<h3 class="hazard_sign">
				Biohazard<br /> 
				IBC#: '.$post->get_biohazards().
			'</h3>';
	} 

	if($post->get_transgenic_p())
	{
		$signs[] = '
			<img src="../../media/image/hazard_plant_transgenic.png" alt="Transgenic Plants" class="hazard_sign" />
		
			<h3 class="hazard_sign">
				Transgenic Plants
			</h3>';
	} 
	
	if($post->get_pathogens_p())
	{
		$signs[] = '
			<img src="../../media/image/hazard_pathogens_plant.png" alt="Plant Pathogens" class="hazard_sign" />
		
			<h3 class="hazard_sign">
				Plant Pathogens
			</h3>';
	} 
	
	if($post->get_pathogens_h())
	{
		$signs[] = '
			<img src="../../media/image/hazard_pathogens_human.png" alt="Human Pathogens" class="hazard_sign" />
			
			<h3 class="hazard_sign">
				Human<br /> 
				Pathogens
			</h3>';
	}
	
	if($post->get_vectors_v())
	{
		$signs[] = '
			<img src="../../media/image/hazard_viral_vectors.png" alt="Viral Vectors" class="hazard_sign" />
		
			<h3 class="hazard_sign">
				Viral Vectors
			</h3>';
	} 
	
	if($post->get_bsl())
	{
		$tempstr = '';
		
		if ($bsl->image)
		{	
			$tempstr .= '<img src="../../media/image/hazard_'.$bsl->image.'.png" alt="BSL" class="hazard_sign" />';
		}
			
		$tempstr .= '
			<h3 class="hazard_sign">'.
				$bsl->text.                                        
			'</h3>';
													
		$signs[] = $tempstr;
	}
	
	if($post->get_electric())
	{
		$signs[] = '
			<img src="../../media/image/hazard_electric.png" alt="Eletrical" class="hazard_sign" />
		
			<h3 class="hazard_sign">
				Electrical
			</h3>';
	} 
    
	/*
	Hazard sign layout
	
	You can't get much more crude than this method, but unfortunatly the pdf generator
	is right on par with IE6 for ignoring proper CSS and/or creating a series of 
	catch-22's. Had no choice but to generate a table using a horrible combination of ifs 
	and for loops.
	*/
	
	// We'll need to know how many signs the user selected.
	$count = count($signs);
	
	if(!$count)
	{
		//echo 'No hazard items. Make sure to select at least one hazard item. This error can also be caused by a bug in some Adobe Acrobat installations. If you had previously created a sign, close this window and submit again.';
	
		//exit;	
	}
	
	$contacts = $post->get_ec_id();
	
	if(empty($contacts))
	{
		echo 'You have not entered any after hours or emergency contacts. Close this window and add at least one contact, then submit again.';
	
		exit;
	}
	
	// Initial table markup.
	$markup = '<table class="hazard_sign">';
	
	if($count <= 4)
	{
		// If there are going to be four items or less, we'll need a single row
		// and mathematically set cell width to center them.
			
		// Open table row.
		$markup .= '<tr>';
		
		// Divide 100 by count to get cell width.
		$width = 100 / $count;
		
		// Generate individual cell markup. 
		foreach($signs as $sign)
		{		
			$markup .= '<td class="hazard_sign" style="width:'.$width.'%;">'.$sign.'</td>';
		}
		
		// Close table row.
		$markup .= '</tr>';
	}	
	else
	{	
		// With more than four items, we need to divide up our cells into
		// rows of four each.
	
		// Open table row.
		$markup .= '<tr>';
		
		// Generate individual cell markup.	
		foreach($signs as $sign)
		{
			// Increment general purpose counter.
			$i++;		
			
			// Row markup.
			$markup .= '<td class="hazard_sign" style="width:25%">'.$sign.'</td>';
			
			// If we're at or somehow above four cells, reset the count and
			// start a new row.
			if($i >= 4)
			{
				$i = 0;
				$markup .='</tr><tr>';
			}
		}
		
		// Close row.
		$markup .= '</tr>';
	}
	
	// Close table.
	$markup .= '</table>';
	
	// Start caching page contents.
	ob_start();
?>

<!DOCtype html>
    <head>
    	<title><?php echo settings::TITLE; ?></title>      
    	<style>
		
			.center
			{
				text-align:center;
			}
				
			img.hazard_sign
			{
				height:100px;
				width:100px;
				border:none;				
			}
			
			h1.hazard_sign,
			h2.hazard_sign,
			h3.hazard_sign,
			h4.hazard_sign
			{
				margin-top:5px;
				margin-bottom:5px;
				color:#900;
			}
			
			h4.hazard_sign
			{
				font-size:small;
			}
			
			table 
			{
				page-break-inside: avoid;
				width:100%;
			}
			
			caption
			{
				font-size:large;
				font-weight:bold;
				margin-top:5px;
				margin-bottom:5px;
				color:#900;
			}
			
			table.hazard_sign
			{
				table-layout:fixed;
				border-style:solid;
				border-top:thick;
				border-bottom:thick;
								
			}
			
			td, th
			{
				text-align:left;
			}
			
			td.hazard_sign
			{
				vertical-align:top;							
				text-align:center;	
				padding:5px;			
			}
		</style>
    
    </head>
    
    <body>     
                        		
                <h1 class="center" style="color:#C60; text-transform:uppercase;">Authorized personnel only!</h1>                  
                 
                               
                    <h3 class="hazard_sign center" style="margin:auto;">CAUTION: The following hazards are present within this area:</h3>                    
                                           	        
					<?php echo $markup; ?>                                                              
                                        
                    <?php
                        if($post->get_special())
                        {
                    ?>		
                            <div class="hazard_sign" style="width:auto; height:auto;">
                                <h4 class="hazard_sign">
                                    Special procedures required for entry or exit:                                                                                
                                </h4>                                    
                                
                                <?php echo $post->get_special(); ?>
                            </div>								
                            <!--hazard_sign-->
                    <?php 
                        } 
                    ?>  
                   
                           
                    <p>                    	
                        <!--Principal Investigator-->  
                        <table>
                        	<?php if($post->get_room()){ ?>
                                <tr>
                                	<th>Area/Room:</td>
									<td><?php echo $room_data->room.' ('.$post->get_room().'), '.ucwords(strtolower($room_data->useage_desc)); ?><td>
                                </td>
                            <?php } ?>
                            
							<?php if($post->get_department()) { ?>
                            	<tr>
                                	<th>Department:</th>
									<td><?php echo $post->get_department() .', '.$department_name->name; ?></td>
                            	</tr>
                            <?php } ?>
                            
                        	<tr>
                            	<th>Principal Investigator:</th>
                                <td><?php echo $post->get_pi_name_f().' '.$post->get_pi_name_l(); ?></td>
                            </tr>
                            <tr>
                                <th>Lab Supervisor:</th>
                                <td><?php echo $post->get_super_name_f().' '.$post->get_super_name_l(); ?></td>                    
                            </tr>
                        </table>                        
                    </p>
                    <p>
                    	<?php 
							$ec_id = $post->get_ec_id();
							
							if(count($ec_id) > 0)
							{
								$ec_name_f	= $post->get_ec_name_f();
                                $ec_name_l	= $post->get_ec_name_l();
                                $ec_loc		= $post->get_ec_loc();
                                $ec_phone_o	= $post->get_ec_phone_o();
                                $ec_phone_h	= $post->get_ec_phone_h();
						?>							
                                <table>
                                  <caption>
                                    Emergency/After Hours Contacts
                                  </caption>
                                  
                                <tr>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Office Phone</th>
                                    <th>Cell/Home Phone</th>
                                </tr>
                                  
                                  <?php foreach ($post->get_ec_id() as $key => $value)
                                        {                                            						  
                                  ?>
                                            
                                            <tr>
                                                <td><?php 
                                                        if(array_key_exists($key, $ec_name_f)) echo $ec_name_f[$key];
                                                        if(array_key_exists($key, $ec_name_l)) echo ' '.$ec_name_l[$key]; ?></td>
                                                <td><?php if(array_key_exists($key, $ec_loc)) echo $ec_loc[$key]; ?></td>
                                                <td><?php if(array_key_exists($key, $ec_phone_o)) echo $ec_phone_o[$key]; ?></td>
                                                <td><?php if(array_key_exists($key, $ec_phone_h)) echo $ec_phone_h[$key]; ?></td>
                                            </tr>
                                    <?php 
                                        }
                                    ?>                                
                                </table>
                    	<?php
							}
						?>
                   	</p>
                    
                    <p>          
                    <table>                        
                        <!--<tr>
                        	<th>Prepared By:</th>
                            <td><?php //echo $oAcc->get_name_full(); ?></td>
                    	</tr>-->
                        <tr>
                        	<th>Date Posted:</th>
                            <td><?php echo date(DATE_COOKIE); ?></td>
						</tr>
                	</table>       	         
                    </p>
                    
                    <p>
    					The information on this sign must be updated at least annually or in the event of any change of emergency contacts or special hazards.
                    </p>
              
</body>
</html>
	
<?php
	///////////////////////////////////////////////////////////////////////////////
	
	// Collect contents from cache and then clean it.
	$content = ob_get_contents();
	ob_end_clean();		
	
	// Send contents to pdf gen.
	$pdf_gen->WriteHTML($content);

	// Send pdf and exit script.
	$pdf_gen->Output(SETTINGS::PDF_FILE, SETTINGS::STREAM_TYPE);
	exit;
?>
	