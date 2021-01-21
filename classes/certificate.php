<?php 
	
	require($_SERVER['DOCUMENT_ROOT']."/libraries/php/classes/config.php"); //Basic configuration file.
	require('../libraries/php/classes/database/main.php'); 	// Database class.
	require('../libraries/vendor/fpdf182/fpdf.php');	// pdf maker.	
	
	// Initialize pdf maker class.
	//$pdf_gen = new fpdf();
	
	//$pdf_gen->SetTitle('EHS Class Certificate');	
	//$pdf_gen->SetCreator('Caskey, Damon V.');
	//$pdf_gen->AddPage('L', 'pt', 'A4'); // Adds a new page in Landscape orientation	
	
	
	// Initialize utility object.
	$utl	= new class_utility();

	class fields
	{
		public $name		= 'Unavailable';
		public $verbiage	= 'Unavailable';
		public $party		= 'Unavailable';
		public $signature	= 'Unavailable';
		public $department	= '';
		public $taken		= 'Unavailable';
	}
	
	$fields = new fields();
	
	// Convert get array to object.
	class get
	{
		public $id = NULL;
	}
	
	$get = new get();	
	$get = (object)$_GET;
	
	class db_database
	{
		// Structure for multiple database connections.
		public $main = NULL;
		public $space = NULL;
	}
	
	class db_master
	{
		// Simple struct to hold database class objects.
		
		public $connect_params = NULL;
		public $connection = NULL;
		public $query = NULL;
		public $line = NULL;
	}
	
	class db_queries
	{
		// Structure placeholder for multiple query objects.		
		public $train = NULL;
		public $staff = NULL;
	}
	
	$db = new db_database();
	
	// Set up structure objects to help organize our database objects.
	$db->main = new db_queries();
	$db->main->train = new db_master();
	$db->main->staff = new db_master();
		
	$db->space = new db_master();
	
	// Initialize main database connection object. We'll reuse it for both query sets. 
	$db->main->train->connection = new class_db_connection();
	$db->main->staff->connection = $db->main->train->connection;
	
	// Initialize UK Space datbase.
	// Initialize connection object.	
	$db->space->connect_params = new class_db_connect_params();

	// Set UKSpace name.
	$db->space->connect_params->set_name('UKSpace');
	
	// Initialize connection object.
	$db->space->connection = new class_db_connection($db->space->connect_params);
		
	if($get->id)
	{       
		// Verify user is logged in.
		$oAcc->access_verify($_SERVER['PHP_SELF']."?id=".$get->id);
		
		// Initialize a query object for training data.
		$db->main->train->query = new class_db_query($db->main->staff->connection);
		
		// Set SQL String.
		$db->main->train->query->set_sql('SELECT participant_name, department, cert_verbiage, responsible_party, CONVERT(VARCHAR(12), class_date, 107) as taken FROM vw_class_participant_list WHERE id = ?');
		
		// Set parameters.
		$db->main->train->query->set_params(array(&$get->id));				

		// Execute query.
		$db->main->train->query->query();		
		
		// Dereference database line object.	
		$db->main->train->line = $db->main->train->query->get_line_object();
		
		$fields->name		= $db->main->train->line->participant_name;
		$fields->department = $db->main->train->line->department;
		$fields->taken		= $db->main->train->line->taken;				
		$fields->verbiage	= $db->main->train->line->cert_verbiage;	
		$fields->party		= $db->main->train->line->responsible_party;
		
		$db->main->staff->query = new class_db_query($db->main->staff->connection); 
		
		// Set SQL string to get staff information.
		$db->main->staff->query->set_sql('SELECT name_f, name_l, title, sig_image FROM tbl_staff WHERE id = ?');

		// Set parameters.
		$db->main->staff->query->set_params(array(&$db->main->train->line->responsible_party));
		
		// Execute query.
		$db->main->staff->query->query();
		
		// Dereference database line object.		
		$db->main->train->line = $db->main->staff->query->get_line_object();
		
		$fields->party 	= $db->main->train->line->name_f.' '.$db->main->train->line->name_l.', '.$db->main->train->line->title;
		$fields->signature		= $db->main->train->line->sig_image;
				
		// Initialize a query object for department information.
		$db->space->query = new class_db_query($db->space->connection);
		
		// Set SQL string.
		$db->space->query->set_sql('SELECT DeptName FROM vEbarsDepartments WHERE DeptCode = ?');
		
		$department = $fields->department;		
		$department = trim($department);
				
		// Set parameters.
		$db->space->query->set_params(array(&$department));	
		
		//Execute query.
		$db->space->query->query();
		
		// Dereference database line object.
		$db->space->line = $db->space->query->get_line_object();
		
		// If we have the department, let's add the name as well.
		if($department && $department != -1)
		{
			$department = $db->space->line->DeptName;
		}
		
		$fields->verbiage	= $fields->verbiage ? $fields->verbiage : 'Unavailable';
		$fields->party		= $fields->party ? $fields->party : 'Unavailable';
		$fields->signature	= $fields->signature ? $fields->signature : NULL;
		$fields->taken		= $fields->taken ? $fields->taken : 'Unavailable';
		
        
        //////////////
        class PDF extends FPDF
        {
            // Load data
            function LoadData($file)
            {
                // Read file lines
                $lines = file($file);
                $data = array();
                foreach($lines as $line)
                    $data[] = explode(';',trim($line));
                return $data;
            }

            // Simple table
            function BasicTable($header, $data)
            {
                // Header
                foreach($header as $col)
                {
                    $this->Cell(40,7,$col,1);
                }
                $this->Ln();
                
                // Data
                foreach($data as $row)
                {
                    foreach($row as $col)
                    {
                        $this->Cell(40,6,$col,1);
                    }
                    $this->Ln();
                }
            }
            
            // Page header
            function Header()
            {
                // Global broder
                $this->Rect(20, 20, $this->GetPageWidth()-40, $this->GetPageheight()-40, 'D');
                $this->Rect(16, 16, $this->GetPageWidth()-32, $this->GetPageheight()-32, 'D');
                
                /*
                We're going to need our starting positions, so
                lets get them now.
                */
                $pos_y = $this->GetY();
                $pos_x = $this->GetX();
                
                // Logo
                $imgFilename = '../media/image/uk_logo.png';
                
                
                list($width, $height) = getimagesize($imgFilename);
                
                $width = $width * 72 / 96;
                $height = $height * 72 / 96;
                                
                $this->Image($imgFilename, null, $pos_y, $width, $height);
                
                /*
                Logo text. Add the logo width to move us toward the right.
                */
                $pos_x += $width+10;
                $this->SetX($pos_x);
                $this->SetY($pos_y+5, false);
                
                $this->SetFont('Arial', 'B', 12);                
                $this->SetTextColor(0, 51, 160);
                $this->Cell(200, 20, 'University of Kentucky', 0, 1, 'L', false, '');
                
                $this->ln(5);
                $this->SetX($pos_x);
                $this->SetFont('Arial', 'B', 24);
                $this->SetTextColor(0, 51, 160);
                $this->Cell(380, 20, 'Environmental Health and Safety', 0, 1, 'L', false, '');
                
                $this->ln(5);
                $this->SetX($pos_x);
                $this->SetFont('Arial','BI', 10);
                $this->SetTextColor(0, 51, 160);
                $this->Cell(380, 20, 'UK safety begins with you!', 0, 1, 'R', false, '');               
               
                // Line break
                $this->Ln(20);
            }

            // Page footer
            function Footer()
            {
                // Position at 1.5 cm from bottom
                $this->SetY(-35);
                // Arial italic 8
                $this->SetFont('Arial','I',8);
                
                /*
                Just in case we'd like to find the database record from
                certificate, let's create an ID here that includes the
                record ID. Then we add a UUID just to give the certificate
                a timestamp and uniqueness.
                */
                
                $string = 'Certificate ID '.uniqid(dechex($_GET['id']).'.', true);                
                $string_width = $this->GetStringWidth($string);
                
                $this->Cell($string_width, 10, $string, 0, 0, 'L');               
            }
        }
        
        // Initialize pdf maker class.
        $pdf_gen = new pdf('L', 'pt');        
        
        $pdf_gen->AddPage('L', 'A4'); // Adds a new page in Landscape orientation	
        $pdf_gen->SetTitle('EHS Class Certificate');	
        $pdf_gen->SetCreator('Caskey, Damon V.');      
        
        /*
        Certificate title.
        
        Once we set a font, we can figure out the width
        of our string. From there, we are able to set
        the cell width, and do some math to center it.
        */
        $pdf_gen->Ln(80);
        $pdf_gen->SetFont('Arial','B',36); 
        
        $string = 'Certificate of Completion';
        $string_width = $pdf_gen->GetStringWidth($string);       
               
        $pdf_gen->SetX($pdf_gen->GetPageWidth()/2 - ($string_width / 2));
        $pdf_gen->Cell($string_width, 40, 'Certificate of Completion', 'BT', 1, 'C', false, '');
        
        // Name
        $pdf_gen->Ln(30);
        $pdf_gen->SetFont('Times','I',36);
                
        $string = $fields->name;
        $string_width = $pdf_gen->GetStringWidth($string);
        
        $pdf_gen->SetX($pdf_gen->GetPageWidth()/2 - ($string_width / 2)); 
        $pdf_gen->Cell($string_width, 20, $string, 0, 1, 'C', false, '');
        
        // Department
        $pdf_gen->Ln(10);
        $pdf_gen->SetFont('Times','I',14);
                
        $string = $department;
        $string_width = $pdf_gen->GetStringWidth($string);
        
        $pdf_gen->SetX($pdf_gen->GetPageWidth()/2 - ($string_width / 2)); 
        $pdf_gen->Cell($string_width, 20, $string, 0, 1, 'C', false, '');
        
        // Verbiage
        $pdf_gen->Ln(20);
        $pdf_gen->SetFont('Arial','',14);
                
        $string = strip_tags($fields->verbiage);
        $string_width = $pdf_gen->GetStringWidth($string);
        
        $pdf_gen->MultiCell(0, 20, $string, 0, 'C', false);
                
        // Date taken
        $pdf_gen->Ln(10);
        $pdf_gen->SetFont('Times','BI',14);
                
        $string = $fields->taken;
        $string_width = $pdf_gen->GetStringWidth($string);
        
        $pdf_gen->SetX($pdf_gen->GetPageWidth()/2 - ($string_width / 2)); 
        $pdf_gen->Cell($string_width, 20, $string, 0, 1, 'C', false, '');
        
        
        // Responsible party (sig image)        
        $imgFilename = '../media/image/'.$fields->signature;

        //list($width, $height) = getimagesize($imgFilename);

        $width = 200 * 72 / 96;
        $height = 100 * 72 / 96;
        
        $pdf_gen->SetXY($pdf_gen->GetPageWidth() - ($width + 35 + 20), -(60+10+$height));
        $pdf_gen->Image($imgFilename, null, null, $width, $height);
        
        // Responsible Party
        $pdf_gen->SetAutoPageBreak(0);
        $pdf_gen->Ln(10);
        $pdf_gen->SetFont('Times','I',14);
                
        $string = $fields->party;
        $string_width = $pdf_gen->GetStringWidth($string);
        
        $pdf_gen->SetXY(-($string_width+35), -35); 
        $pdf_gen->Cell($string_width, 0, $string, 0, 0, 'R', false, '');
        
        /*
        Now we send the finished .pdf to browser!
        */
        $pdf_gen->Output('ehs_class_certificate.pdf', 'I');
        
        exit;
        //////////////
        
		// Start caching page contents.
		//ob_start();      
        
?>
		
<!DOCtype html>
	<head>
        <title>UK - Environmental Health And Safety</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="../libraries/css/style.css" type="text/css" />

        <link rel="stylesheet" href="../libraries/css/print.css" type="text/css" media="print" />
   		 <style>
		 	html:before, html:after, body:before, body:after {
				content: "";
				position: fixed;
				background: #a5ebff;
			
				/* etc. */
			}
		 
			body
			{
				background:#FFF;
			}
			
			div.container_outer
			{						
				text-align:center;	
				overflow:hidden;
				height:1000px;					
			}
			
			div.container_inner
			{
				text-align:left;
				background:#000 url(../media/image/back_dot.png) repeat;
				border:thin;
				padding:5px 5px 5px 5px;
				/*width:630px;	*/
				margin: 50px auto;
			}
			
			div.container_cert
			{
				background-color:#FFF;
				overflow:auto;						
				padding: 5px 5px 5px 5px;
			}
			
			div.center
			{
				text-align:center;
			}
					
			img.logo
			{			
				height:55;
				width:113;
				border: none;
			}
			
			img.signature
			{
				width:150px;
				height:50px;
				float:right;
			}
			
			.inline
			{
				display:inline;
			}
			
			.left
			{				
				float:left;
			}
			
			.right
			{			
				height:25px;
				width:500px;
				float:right;
				text-align:right;
			}
			
			.title 
			{
				border-bottom:				thick solid;	
				border-top:					thick solid;
				display:					block;
				font-family:				"Palatino Linotype", "Book Antiqua", Palatino, serif;
				font-size:					36px;
				font-weight:				bolder;
				margin-bottom:				20px;
				margin-top:					20px;		
			}
		
		</style>
   
    </head>  
      
    <body>
        <div id="container_outer" class="container_outer">
            <div id="container_inner" class="container_inner">
                <div id="container_cert" class="container_cert">        	
                    <img src="../media/image/uk_logo.png" class="logo" alt="University of Kentucky" title="University of Kentucky" />
                    
                    
                    <div id="container_content" class="center">
        
                        <span class="title">Certificate of Completion</span>
        				<br />
                        <br />
                        <h1><?php echo $fields->name; ?></h1>
                        
                        <?php
                            if($department)
                            {					
                                echo "<h1>".$department."</h1>";
                            }	
                        ?>
                        <br />
                        <br />
                        <h3><?php	echo $fields->verbiage;	?></h3>
        
                    </div><!--/container_content-->
                                
                    <div style="overflow: auto;">
                    	<?php 
							if($fields->signature)
							{
						?>
                        		<img src="../media/image/<?php echo $fields->signature; ?>" class="signature" alt="Signature" title="signature" />
                        <?php
							}
							else
							{
						?>
                        	<br/ ><br />
                            <br/ ><br />
                        <?php
							}
						?>
                    </div>
                                           
                    <div class="left"><?php echo $fields->taken; ?></div>
                    <div class="right"><?php  echo $fields->party; ?></div>
                    
                </div><!--/container_cert-->
            </div><!--/Container_inner-->
        </div><!--/container_outer-->
       
		<?php
            
           }
           else
           {		
               echo "<span class='alert'>You cannot access this page directly. Please take one of the courses in order to get a certificate.</span>";            
           }
        ?>
</body>
</html>

<?php
	///////////////////////////////////////////////////////////////////////////////
	
	// Collect contents from cache and then clean it.
	//$content = ob_get_contents();
	//ob_end_clean();		
	
	//$pdf_gen->SetFooter($footer);
	
	// Send contents to pdf gen.
	//$pdf_gen->WriteHTML($content);

	// Send pdf and exit script.
	//$pdf_gen->Output('ehs_class_certificate.pdf', 'I');
?>