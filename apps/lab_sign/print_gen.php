<?php 
	
	require('source/main.php');
	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/config.php'); // Basic configuration file. 
	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/database/main.php'); // Database handler.
	
	// Verify user is authorized.
	//$oAcc->access_verify();	
	
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
	$query->set_params(array($post->get_agent_laser()));
	$query->query();
	
	if($query->get_row_exists()) $laser = $query->get_line_object();
	
	// Get bsl label items.
	$query->set_sql('SELECT text, image
						FROM tbl_list_bsl 
						WHERE     (id = ?)');
	$query->set_params(array($post->get_agent_bsl()));
	$query->query();
	
	if($query->get_row_exists()) $bsl = $query->get_line_object();	
	
	$pi_array = $post->get_pi_id();
	$super_array = $post->get_super_id();
	$ec_array = $post->get_ec_id();

	if(empty($pi_array))
	{
		echo 'You have not entered any principal investigators. Close this window and add at least one investigator, then submit again.';
	
		exit;
	}

	if(empty($super_array))
	{
		echo 'You have not entered any lab supervisors. Close this window and add at least one supervisor, then submit again.';
	
		exit;
	}

	if(empty($ec_array))
	{
		echo 'You have not entered any after hours or emergency contacts. Close this window and add at least one contact, then submit again.';
	
		exit;
	} 
	
	// Start caching page contents.
	ob_start();
?>


<!DOCtype html>
    <head>
    	<title><?php echo settings::TITLE; ?>b</title>
    	<style>
            @page { 
               
                size: letter;
                 /* change the margins as you want them to be. */               
            } 
            
            @print { 
                @page :footer { 
                    display: none
                } 

                @page :header { 
                    display: none
                } 
            }             
            
            @media print { 
                @page { 
                    margin-top: 0; 
                    margin-bottom: 0; 
                } 
                body { 
                    padding-top: 72px; 
                    padding-bottom: 72px ; 
                } 
            }
            
			.center
			{
				text-align:center;
			}
				
			img.hazard_sign
			{
				height:150px;
				width:150px;
				border:none;				
			}
			
            .print_container
            {               
                break-inside: avoid;  
            }
            
			.auto_grid_container
			{   
                padding-bottom: 10px;
                display: grid;  
                grid: auto / auto auto auto;
                grid-gap: 10px;
                justify-items: center;
                justify-content: center;
                border-bottom-style: double;               
                border-bottom-width: 10px;
                border-top-style: double;
                border-top-width: 10px;                
			}
			
			.hazard_item
			{  
                margin: 5px;
                min-width: 220px;
                text-align: center;
                padding: 2px;                
                text-align: center;  
                
                /*
                border-bottom-right-radius: 10px;
                border-bottom-left-radius: 10px;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                border-style: solid;               
                border-width: thick;
                */
			}
			
			.hazard_label
			{
				font-size: x-large;
				font-weight: bold;
				margin-top:5px;
				margin-bottom:5px;
				color:#900;
			}
			
			.hazard_label_small
			{
				font-size: medium;
				font-weight: bold;
				margin-top:5px;
				margin-bottom:5px;
				color:#900;
			}
						
			table 
			{
                width: 100%;
				page-break-inside: avoid;
				table-layout:auto;
				border-style:none;	
			}
			
			caption
			{
				font-size:large;
				font-weight:bold;
				margin-top:5px;
				margin-bottom:5px;
				color:#900;
			}
			
			td, th
			{
				text-align:left;
                border-style:none;	
			}
		</style>
        
    </head>
    
    <body>          
		<div class="print_container" id="hazard_item_container_outer">
            
        <h1 class="center" style="color:#C60; text-transform:uppercase;">Authorized personnel only!</h1>                  

		<h2 class="hazard_sign center">CAUTION: The following hazards are present within this area:</h2>
            <div class="auto_grid_container" id="hazard_item_container">
				<?php
				/* 
                Check each hazard item post and add to signs array if present.
				
                To do: Move items to database table so we don't need to
                check each item peicemeal.
				*/
                
                if($post->get_agent_flammables())
				{
				?>
                
                <div id="hazard_flammables" class="hazard_item">
                    <img src="../../media/image/hazard_flammables.png" alt="Flammables" class="hazard_sign" />

                    <p class="hazard_label_small">
                        Flammables<br />
                        Self Reactives<br />
                        Pyrophorics<br />
                        Self-Heating<br />
                        Emits Flammable Gas<br />
                        Organic Peroxides<br />
                    </p>
                </div>
                
				<?php
				}

				if($post->get_agent_oxidizers())
				{
				?>
                
                <div id="hazard_oxidizers" class="hazard_item">
                    <img src="../../media/image/hazard_oxidizers.png" alt="Oxidizers" class="hazard_sign" />
                    <p class="hazard_label">
                        Oxidizers 
                    </p>
                </div>
                
				<?php
				}	
                ?>

                <?php
				if($post->get_agent_explosives())
				{
				?>		
                
                <div id="hazard_explosives" class="hazard_item">
                    <img src="../../media/image/hazard_explosives.png" alt="Explosives" class="hazard_sign" />

                    <p class="hazard_label_small">
                        Explosives<br />
                        Self Reactives<br />
                        Organic Peroxides
                    </p>
                </div>
                
				<?php
				} 

				if($post->get_agent_corrosives())
				{
				?>  
                
                <div id="hazard_corrosives" class="hazard_item">
                    <img src="../../media/image/hazard_corrosives.png" alt="Corrosives" class="hazard_sign" />
                    
                    <p class="hazard_label">
                        Corrosives
                    </p>
                </div>
                
				<?php
				} 

				if($post->get_agent_magnetic())
				{							
				?>
                
                <div id="hazard_magnetic" class="hazard_item">
                    <img src="../../media/image/hazard_magnetic.png" alt="Magnetic Field" class="hazard_sign" />

                    <p class="hazard_label">
                        Strong Magnetic Field
                    </p>
                </div>
                
				<?php
				}

				if($post->get_agent_carcinogen())
				{
				?>
                
                <div id="hazard_carcinogen" class="hazard_item">
                    <img src="../../media/image/hazard_carcinogen.png" alt="Carcinogen" class="hazard_sign" />

                    <p class="hazard_label_small">
                        Carcinogen<br />
                        Respiratory Sensitizer<br />
                        Reproductive Toxicity<br />
                        Target Organ Toxicity<br />
                        Mutagenicity<br />
                        Aspiration Toxicity					    
                    </p>
                </div>
						
				<?php
				}							

				if($post->get_agent_irritant())
				{
				?>   
                
                <div id="hazard_irritant" class="hazard_item">
                    <img src="../../media/image/hazard_irritant.png" alt="Irritant" class="hazard_sign" />

                    <p class="hazard_label_small">
                        Irritant<br />
                        Dermal Sensitizer<br />
                        Acute toxicity (harmful)<br />
                        Narcotic Effects<br />
                        Respiratory Tract<br />
                        Irritation
                    </p>
                </div>
                
				<?php
				} 

				if($post->get_agent_toxicity())
				{
				?>		
                <div id="hazard_toxicity" class="hazard_item">                    
                    <img src="../../media/image/hazard_toxicity.png" alt="Toxicity" class="hazard_sign" />

                    <p class="hazard_label">
                        Acute Toxicity (Severe)
                    </p>                    
                </div>
                
				<?php
				} 

				if($post->get_agent_pressure())
				{
				?>
                
                <div id="hazard_pressure" class="hazard_item">                    
                    <img src="../../media/image/hazard_pressure.png" alt="Pressure" class="hazard_sign" />

                    <p class="hazard_label">
                        Gas Under Pressure
                    </p>                    
                </div>
                
				<?php
				} 

				if($post->get_agent_laser())
				{
				?>	
                
                <div id="hazard_laser" class="hazard_item"> 
                    <img src="../../media/image/hazard_laser.png" alt="Laser" class="hazard_sign" />

                    <p class="hazard_label">
                        Class <?php echo $laser->text; ?> Laser
                    </p>
                </div>
                
				<?php
				} 

				if($post->get_agent_radioactive())
				{
				?>
                
                <div id="hazard_radioactive" class="hazard_item">
                    <img src="../../media/image/hazard_radiation.png" alt="Radiation" class="hazard_sign" />

                    <p class="hazard_label">
                        Radioactive Material
                    </p>
                </div>
                
				<?php
				}

				if($post->get_agent_biohazards())
				{
				?>		
                <div id="hazard_biohazards" class="hazard_item">
                    <!-- img src="../../media/image/hazard_bio.png" alt="Biohazard" class="hazard_sign" -->

                    <p class="hazard_label">
                        Biohazard<br /> 
                        IBC#: '<?php echo $post->get_agent_biohazards(); ?>
                    </p>
                </div>
				<?php
				} 

				if($post->get_agent_transgenic_p())
				{
				?>
                <div id="hazard_transgenic_p" class="hazard_item">
                    <img src="../../media/image/hazard_plant_transgenic.png" alt="Transgenic Plants" class="hazard_sign" />

                    <p class="hazard_label">
                        Transgenic Plants
                    </p>
                </div>
				<?php
				} 

				if($post->get_agent_pathogens_p())
				{
				?>
                <div id="hazard_pathogens_p" class="hazard_item">
                    <img src="../../media/image/hazard_pathogens_plant.png" alt="Plant Pathogens" class="hazard_sign" />

                    <p class="hazard_label">
                        Plant Pathogens
                    </p>
                </div>
				<?php
				} 

				if($post->get_agent_pathogens_h())
				{
				?>
                <div id="hazard_pathogens_h" class="hazard_item">
                    <img src="../../media/image/hazard_pathogens_human.png" alt="Human Pathogens" class="hazard_sign" />

                    <p class="hazard_label">
                        Human Pathogens
                    </p>
                </div>
				<?php
				}

				if($post->get_agent_vectors_v())
				{
				?>
                <div id="hazard_vectors_v" class="hazard_item">
                    <img src="../../media/image/hazard_viral_vectors.png" alt="Viral Vectors" class="hazard_sign" />

                    <p class="hazard_label">
                        Viral Vectors
                    </p>
                </div>
				<?php
				} 

				if($post->get_agent_bsl())
				{
                ?>
                
                <div id="hazard_bsl" class="hazard_item">
                    <?php
                    if ($bsl->image)
					{
					?>
                    <img src="../../media/image/hazard_<?php echo $bsl->image; ?>.png" alt="BSL" class="hazard_sign" />							
					<?php
					}
					?>

					<p class="hazard_label">
						<?php echo $bsl->text; ?>                                        
					</p>
                </div>
				
                <?php
				}

				if($post->get_agent_electric())
				{
				?>	
                <div id="hazard_electric" class="hazard_item">
				    <img src="../../media/image/hazard_electric.png" alt="Eletrical" class="hazard_sign" />
                    
                    <p class="hazard_label">
                        Electrical
                    </p>
                </div>
				<?php
				}

			?>
            </div>
        </div>
		    <!--hazard types-->
			
            <?php
            if($post->get_special())
            {
            ?>		
            <div class="hazard_special">
                <h1 class="hazard_label">
                    Special procedures required for entry or exit:                                                                                
                </h1>                                    

                <p>
                    <?php echo $post->get_special(); ?>
                </p>
            </div>								
			<?php
            }
			?>  
            <div class="print_container" id="contact_information_container">
                
                <!-- Principal Investigator -->
                <?php 
                    $pi_id = $post->get_pi_id();
                    $pi_count = count($pi_id);	

                    if($pi_count > 0)
                    {
                        $pi_name_f	= $post->get_pi_name_f();
                        $pi_name_l	= $post->get_pi_name_l();
                ?>                        
                        <table style="">
                          <caption>
                            Principal Investigator<?php if($pi_count > 1){ ?>s<?php } ?>
                          </caption>
                          <tbody>
                          <?php foreach ($post->get_pi_id() as $key => $value)
                                {                                            						  
                          ?>                                            
                                    <tr>
                                        <td class="center"><?php 
                                                if(array_key_exists($key, $pi_name_f)) echo $pi_name_f[$key];
                                                if(array_key_exists($key, $pi_name_l)) echo ' '.$pi_name_l[$key]; ?></td>
                                    </tr>
                            <?php 
                                }
                            ?>   
                            </tbody>
                        </table>
                <?php
                    }
                ?>                   	
                    
					<!-- Lab Supervisor -->					
                    <?php 
                        $super_id = $post->get_super_id();
                        $super_count = count($super_id);	

                        if($super_count > 0)
                        {
                            $super_name_f	= $post->get_super_name_f();
                            $super_name_l	= $post->get_super_name_l();
                    ?>							
                            <table>
                              <caption>
                                Lab Supervisor<?php if($super_count > 1){ ?>s<?php } ?>
                              </caption>
                              <tbody>
                              <?php foreach ($post->get_super_id() as $key => $value)
                                    {                                            						  
                              ?>                                            
                                        <tr>
                                            <td class="center"><?php 
                                                    if(array_key_exists($key, $super_name_f)) echo $super_name_f[$key];
                                                    if(array_key_exists($key, $super_name_l)) echo ' '.$super_name_l[$key]; ?></td>
                                        </tr>
                                <?php 
                                    }
                                ?>  
                                </tbody>
                            </table>
                    <?php
                        }
                    ?>
                   
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
                                <caption>Emergency/After Hours Contacts</caption>
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Office Phone</th>
                                        <th>Cell/Home Phone</th>
                                    </tr>
                                </thead>

                                <tbody>
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
                                </tbody>
                            </table>
                    <?php
                        }
                    ?>
              		                         
                    <table>
                        <caption></caption>
                        <tbody>
                        <?php if($post->get_room()){ ?>
                            <tr>
                                <th>Area/Room</th>
                                <td><?php echo $room_data->room.' ('.$post->get_room().'), '.ucwords(strtolower($room_data->useage_desc)); ?></td>
                            </tr>
                        <?php } ?>

                        <?php if($post->get_department()) { ?>
                            <tr>
                                <th>Department</th>
                                <td><?php echo $post->get_department() .', '.$department_name->name; ?></td>
                            </tr>
                        <?php } ?>

                            <tr>
                                <th>Date Posted</th>
                                <td><?php echo date(DATE_COOKIE); ?></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <p class="center">
                        The information on this sign must be updated at least annually or in the event of any change of emergency contacts or special hazards.
                    </p>
                    
              </div>
</body>
</html>
	
<?php
	///////////////////////////////////////////////////////////////////////////////
	
	// Collect contents from cache and then clean it.
	$content = ob_get_contents();
	ob_end_clean();		
	
	echo $content;
?>
	