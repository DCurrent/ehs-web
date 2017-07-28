<?php 

	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/config.php'); // Basic configuration file. 
	require($_SERVER['DOCUMENT_ROOT'].'/libraries/php/classes/database/main.php'); // Database handler.

	// require('../../libraries/php/classes/database/main.php'); // Keep this commented out - it's only for development environment.

	// Verify user is authorized.
	$oAcc->access_verify();

	// Post data.			
	class post
	{
		private			
			$department		= NULL,
			$room			= NULL,
			$pi_name_f		= NULL,
			$pi_name_l		= NULL,
			$super_name_f	= NULL,
			$super_name_l	= NULL,
			
			$ec_id			= array(),
			$ec_name_f		= array(),
			$ec_name_l		= array(),
			$ec_loc			= array(),
			$ec_phone_o		= array(),
			$ec_phone_h		= array(),
			
			// Agents
			$flammables		= NULL,
			$oxidizers		= NULL,
			$explosives		= NULL,
			$corrosives		= NULL,
			$magnetic		= NULL,
			$carcinogen		= NULL,
			$irritant		= NULL,
			$toxicity		= NULL,
			$pressure		= NULL,
			$laser			= NULL,
			$radioactive	= NULL,
			$biohazards		= NULL,
			$pathogens_h	= NULL,
			$vectors_v		= NULL,
			$bsl			= NULL,
			$special		= NULL;				
		
		public function __construct()
		{	
			$this->populate();		
		}
						
		// Populate datamembers from $_POST.
		private function populate()
		{
			// Interate through each data member in target object.
			foreach($this as $key => $value) 
			{					
				// If we can find a matching a post var with key matching
				// key of current object var, set object var to the POST value. 
				if(isset($_POST[$key]))
				{					
					$this->$key = $_POST[$key];    
				}
			}
		}
		
		// Access methods
		public
			function ec_id()
			{
				return $this->ec_id;
			}
		
			function ec_name_f()
			{
				return $this->ec_name_f;
			}
			
			function ec_name_l()
			{
				return $this->ec_name_l;
			}
			
			function ec_loc()
			{
				return $this->ec_loc;
			}
			
			function ec_phone_h()
			{
				return $this->ec_phone_h;
			}
			
			function ec_phone_o()
			{
				return $this->ec_phone_o;
			}
		
			function department()
			{
				return $this->department;
			}
		
			function room()
			{
				return $this->room;
			}
			
			function pi_name_f()
			{
				return $this->pi_name_f;
			}
			
			function pi_name_l()
			{
				return $this->pi_name_l;
			}
			
			function super_name_f()
			{
				return $this->super_name_f;
			}
			
			function super_name_l()
			{
				return $this->super_name_l;
			}
		
			function flammables()
			{
				return $this->flammables;
			}
			
			function oxidizers()
			{
				return $this->oxidizers;
			}
			
			function explosives()
			{
				return $this->explosives;
			}
			
			function corrosives()
			{
				return $this->corrosives;
			}
			
			function magnetic()
			{
				return $this->magnetic;
			}
			
			function carcinogen()
			{
				return $this->carcinogen;
			}
			
			function irritant()
			{
				return $this->irritant;
			}
			
			function toxicity()
			{
				return $this->toxicity;
			}
			
			function pressure()
			{
				return $this->pressure;
			}
			
			function laser()
			{
				return $this->laser;
			}
			
			function radioactive()
			{
				return $this->radioactive;
			}
			
			function biohazards()
			{
				return $this->biohazards;
			}
			
			function pathogens_h()
			{
				return $this->pathogens_h;
			}
			
			function vectors_v()
			{
				return $this->vectors_v;
			}
			
			function bsl()
			{
				return $this->bsl;
			}
			
			function special()
			{
				return $this->special;
			}
	}

	

	$post		= new post;	// Post values object.
	$db_space	= NULL;	// Master control object for database handler (UKSpace).
	$height		= 0;	// Height setting for sign alerts.

	unset($oDB);	
	
	
	// We want all the sign alerts to be equal height, so use a default height, 
	// and adjust for sign requests that will need more room.
	$height = 200;	
	if($post->explosives()) $height = 150;	
	if($post->flammables() || $post->irritant() || $post->carcinogen()) $height = 200;
	
	$department_name = NULL;
	
	$db = new class_db_connection();
	$query = new class_db_query($db);
	
	// Get department label items.
	$query->set_sql('SELECT name
						FROM vw_uk_space_department 
						WHERE     (number = ?)');
	$query->set_params(array($post->department()));
	$query->query();
	
	if($query->get_row_exists()) $department_name = $query->get_line_object();	
	
	
?>

<!DOCtype html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>UK - Environmental Health And Safety</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css" />
		<link rel="stylesheet" href="../../libraries/css/style.css" type="text/css" />
        <link rel="stylesheet" href="../../libraries/css/print.css" type="text/css" media="print" />
        <script>		
			function printpage()
			{
			  window.print();
			}
		</script>
        
    	<style>
			div.hazard_container
			{
				text-align:center;
				display: flex;
				flex-direction: row;
				flex-wrap: wrap;
				justify-content: center;
				align-items: center;
				
				width:650px;
				
				border:medium;
				border-style:solid;
			}
						
			div.hazard_sign
			{
				float:left;
				width:auto;
				height:<?php echo $height; ?>px;
				margin:5px;
				padding:5px;				
				text-align:center;			
			}
			
			img.hazard_sign
			{
				height:100px;
				width:100px;				
			}
			
			h1.hazard_sign,
			h2.hazard_sign,
			h3.hazard_sign,
			h4.hazard_sign
			{
				margin:auto;
				color:#900;
			}
			
			h4.hazard_sign
			{
				font-size:small;
			}
			
			td
			{
				text-align:center;
			}
		</style>
    
    </head>
    
    <body>    
        <div id="container" style="width:670px;">            
            <div id="mainNavigation">
            	<nav id="nav_main" class="nav_main">
                    <ul>
                        <li><a href="#" onclick="printpage()" class="icon_print">Print Lab Sign</a></li>
                    </ul>
                </nav>            
            </div><!--/mainNavigation-->            
            <div id="subContainer" style="width:auto; margin:auto;">                            
	
    			<div id="banner_container" class="banner_container" style="width:660px; height:auto; padding:0px; margin:0px; text-align:center">	
                    <div id="banner_content" class="banner" style="width:100%; height:auto; padding:0px; text-align:center; margin:3px">
                        <h2 style="color:#FFF;">ADMITTANCE TO AUTHORIZED PERSONNEL ONLY</h2>                        
                    </div><!--/banner_content-->
                </div><!--/banner_container--> 	                             
                 
                <div id="content" style="width:auto;">                
                    <h3 class="hazard_sign" style="margin:auto;">CAUTION: The following hazards are present within this area:</h3>                      
                    
                    <div class="hazard_container">                    
                        
						<?php
                            if($post->flammables())
                            {
                        ?>
                                <div class="hazard_sign">
                                    
                                    <img src="/media/image/hazard_flammables.png" alt="Flammables" class="hazard_sign" />
                                    
                                    <h4 class="hazard_sign">
                                        Flammables<br />
                                        Self Reactives<br />
                                        Pyrophorics<br />
                                        Self-Heating<br />
                                        Emits Flammable Gas<br />
                                        Organic Peroxides
                                    </h4>
                                    
                                </div><!--hazard_sign-->
                        <?php 
                            } 
                        ?>
                    
                    
                        <?php
                            if($post->oxidizers())
                            {
                        ?>                                    
                                <div class="hazard_sign">                                       
                                    <img src="/media/image/hazard_oxidizers.png" alt="Oxidizers" class="hazard_sign" />
                                    
                                    <h3 class="hazard_sign">
                                        Oxidizers
                                    </h3>                                        
                                </div><!--hazard_sign-->
                        <?php 
                            } 
                        ?>
                    

                    
                        <?php
                            if($post->explosives())
                            {
                        ?>		
                                <div class="hazard_sign">                                       
                                    <img src="/media/image/hazard_explosives.png" alt="Explosives" class="hazard_sign" />
                                    
                                    <h4 class="hazard_sign">
                                        Explosives<br />
                                        Self Reactives<br />
                                        Organic Peroxides
                                    </h4>                                        
                                </div><!--hazard_sign-->
                        <?php 
                            } 
                        ?>
                        
                        <?php
                            if($post->corrosives())
                            {
                        ?>		
                                <div class="hazard_sign">                                       
                                    <img src="/media/image/hazard_corrosives.png" alt="Corrosives" class="hazard_sign" />
                                    
                                    <h3 class="hazard_sign">
                                        Corrosives
                                    </h3>                                        
                                </div><!--hazard_sign-->
                        <?php 
                            } 
                        ?>
                        
                        <?php
                            if($post->magnetic())
                            {
                        ?>		
                                <div class="hazard_sign">
                                    <h3 class="hazard_sign">
                                        Strong<br /> Magnetic Field
                                    </h3>                                        
                                </div><!--hazard_sign-->
                        <?php 
                            } 
                        ?>      
                        
                        <?php
                            if($post->carcinogen())
                            {
                        ?>		
                                <div class="hazard_sign">                                       
                                    <img src="/media/image/hazard_carcinogen.png" alt="Carcinogen" class="hazard_sign" />
                                    
                                    <h4 class="hazard_sign">
                                    	Carcinogen<br />
                                        Respiratory Sensitizer<br />
                                        Reproductive Toxicity<br />
                                        Target Organ Toxicity<br />
                                        Mutagenicity<br />
                                        Aspiration Toxicity
                                    </h4>                                        
                                </div><!--hazard_sign-->
                        <?php 
                            }							
                        ?>   
                        
                         <?php
                            if($post->irritant())
                            {
                        ?>		
                                <div class="hazard_sign">                                       
                                    <img src="/media/image/hazard_irritant.png" alt="Irritant" class="hazard_sign" />
                                    
                                    <h4 class="hazard_sign">
                                    	Irritant<br />
                                        Dermal Sensitizer<br />
                                        Acute toxicity (harmful)<br />
                                        Narcotic Effects<br />
                                        Respiratory Tract<br />
                                        Irritation
                                    </h4>                                        
                                </div><!--hazard_sign-->
                        <?php 
                            } 
                        ?>
                        
                        <?php
                            if($post->toxicity())
                            {
                        ?>		
                                <div class="hazard_sign">                                       
                                    <img src="/media/image/hazard_toxicity.png" alt="Toxicity" class="hazard_sign" />
                                    
                                    <h3 class="hazard_sign">
                                        Acute Toxicity<br />
                                        (Severe)
                                    </h3>                                        
                                </div><!--hazard_sign-->
                        <?php 
                            } 
                        ?>
                        
                        <?php
                            if($post->pressure())
                            {
                        ?>		
                                <div class="hazard_sign">                                       
                                    <img src="/media/image/hazard_pressure.png" alt="Pressure" class="hazard_sign" />
                                    
                                    <h3 class="hazard_sign">
                                        Gas Under<br />
                                        Pressure
                                    </h3>                                        
                                </div><!--hazard_sign-->
                        <?php 
                            } 
                        ?>
                         
                         <?php
                            if($post->laser())
                            {
                        ?>		
                                <div class="hazard_sign">
                                    <h3 class="hazard_sign">
                                        Class <?php echo $post->laser(); ?> Laser
                                    </h3>                                        
                                </div><!--hazard_sign-->
                        <?php 
                            } 
                        ?> 
                        
                        <?php
                            if($post->radioactive())
                            {
                        ?>		
                                <div class="hazard_sign">
                                    <h3 class="hazard_sign">
                                        Radioactive<br /> 
                                        Material
                                    </h3>                                        
                                </div><!--hazard_sign-->
                        <?php 
                            } 
                        ?> 
                        
                        <?php
                            if($post->biohazards())
                            {
                        ?>		
                                <div class="hazard_sign">
                                    <h3 class="hazard_sign">
                                        Biohazard<br /> 
                                        IBC#: <?php echo $post->biohazards(); ?>
                                    </h3>                                        
                                </div><!--hazard_sign-->
                        <?php 
                            } 
                        ?>
                        
                        <?php
                            if($post->pathogens_h())
                            {
                        ?>		
                                <div class="hazard_sign">
                                    <h3 class="hazard_sign">
                                        Human<br /> 
                                        Pathogens
                                    </h3>                                        
                                </div><!--hazard_sign-->
                        <?php 
                            } 
                        ?> 
                        
                        <?php
                            if($post->vectors_v())
                            {
                        ?>		
                                <div class="hazard_sign">
                                    <h3 class="hazard_sign">
                                        Viral<br /> 
                                        Vectors
                                    </h3>                                        
                                </div><!--hazard_sign-->
                        <?php 
                            } 
                        ?>
                        
                        <?php
                            if($post->bsl())
                            {
                        ?>		
                                <div class="hazard_sign">
                                    <h3 class="hazard_sign">
                                        BSL: <?php echo $post->bsl(); ?>                                        
                                    </h3>                                        
                                </div><!--hazard_sign-->
                        <?php 
                            } 
                        ?>
                        
                        <?php
                            if($post->special())
                            {
                        ?>		
                      <div class="hazard_sign" style="width:95%; height:auto; margin:auto; padding:0;">
                                    <h4 class="hazard_sign">
                                        Special procedures required for entry or exit:                                                                                
                                    </h4>                                    
                                    
                                    <?php echo $post->special(); ?>
                                </div>
                                <p>&nbsp;</p>
                                <p>&nbsp;</p>
                                <!--hazard_sign-->
                        <?php 
                            } 
                        ?>                          
                    </div><!--hazard_container-->
                    
                    <h4>Room Number: <span class="color_black"><?php echo $post->room(); ?></span></h4>
                    <h4>Department: <span class="color_black"><?php echo $post->department() .', '.$department_name->name; ?></span></h4>
                    <h4>
                    	Principal Investigator: <span class="color_black"><?php echo $post->pi_name_f().' '.$post->pi_name_l(); ?></span>,
                    	&nbsp; 
                    	Supervisor: <span class="color_black"><?php echo $post->super_name_f().' '.$post->super_name_l(); ?></span>
                    </h4>
                    
                    <p>
                    	<?php 
							$ec_id = $post->ec_id();
							
							if(count($ec_id))
							{
						?>							
                                <table style="width:650px;">
                                  <caption>
                                    Emergency/After Hours Contacts:
                                  </caption>
                                  
                                <tr>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Office Phone</th>
                                    <th>Cell/Home Phone</th>
                                </tr>
                                  
                                  <?php foreach ($post->ec_id() as $key => $value)
                                        {
                                            $ec_name_f	= $post->ec_name_f();
                                            $ec_name_l	= $post->ec_name_l();
                                            $ec_loc		= $post->ec_loc();
                                            $ec_phone_o	= $post->ec_phone_o();
                                            $ec_phone_h	= $post->ec_phone_h();						  
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
					
                    <p style="text-align:center">
    					<span class="note">The information on this sign must be updated at least annually or in the event of any change of emergency contacts or special hazards.</span>
                    </p>                     
                    <p style="text-align:center">
                        	Prepared By: <?php echo $oAcc->get_full_name(); ?>,
                    		&nbsp;
                        	Date Posted: <?php echo date(DATE_COOKIE); ?>                        
                	</p>      
              	</div><!--/content-->                      
            </div><!--/subContainer--><!--/sidePanel-->
            
            <div id="footer">
                <?php include($cDocroot."libraries/includes/inc_footer.php"); ?>		
            </div><!--/footer-->
        </div><!--container-->
        
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