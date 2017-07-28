<?php 

	require('../../libraries/php/classes/database/main.php');
	require('../../libraries/vendor/fpdf/fpdf.php');
	require('../../libraries/vendor/fpdf/extensions/mc_table.php');
	require('../../libraries/vendor/fpdf/extensions/fancy_row.php');

	abstract class CONSTANTS
	{
		const FONT_FAM			= 'Arial';
		const FONT_SIZE			= 6;
		
		const BASE_W_SPACER	= 2;
		const BASE_W_PHONE	= 26;
		const BASE_W_NAME	= 75;
		const BASE_H		= 5;
		
		const BORDER_OFF 	= 0;
		const BORDER_ON 	= 1;
		
		const LINE_RIGHT	= 0;
		const LINE_NEXT		= 1;
		const LINE_BELOW	= 2;
		
		const ALIGN_LEFT	= 'L';
		const ALIGN_RIGHT	= 'R';
		const ALIGN_CENTER	= 'C';
	}	

	abstract class PHONE_TYPES
	{
		const OFFICE = 1;
		const PAGER = 5;
		const CELL = 2;
		const HOME = 4;
	}

	function localize_us_number($phone) 
	{
		$result = NULL;
		
		//$result = '<a href="tel:+'.$phone.'">';	
		
		$numbers_only = preg_replace("/[^\d]/", "", $phone);
		$result .= preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $numbers_only);
		
		//$result .= '</a>';
		
		return $result;
	}

	// Output string list of numbers. Query uses bonded parameters that must
	// be set before function call.
	function phone_numbers($query_phone)
	{
		$result = '';
		$query_phone->execute();
		
		if($query_phone->get_row_exists())
		{																	
			$line_all_phone = $query_phone->get_line_object_all();
				
			// Clean phone number array.
			$phone_arr = NULL;
			
			// Populate phone number array with finished link/number strings.
			foreach($line_all_phone as $line_phone)
			{
				$phone_arr[] = localize_us_number($line_phone->number);
			}
			
			// Concatenate phone array into comma separated string.
			$result = implode(', ', $phone_arr);
		}
		
		return $result;
	}

	function department_set($department)
	{		
		$GLOBALS['dept'] = $department;
			
		$query_staff = $GLOBALS['query_staff'];
		$query_phone = $GLOBALS['query_phone'];
		$pdf = $GLOBALS['pdf'];
		
		$query_staff->execute();	
		$line_arr_staff = $query_staff->get_line_object_all();
		
		// Now loop through each staff result.
		foreach($line_arr_staff as $line_staff)
		{																		
			// Let's get the list of office numbers for this staff entry.
			$GLOBALS['id'] = $line_staff->id;
			
			// Now let's get all of our phone numbers by type.
			$GLOBALS['phone_type'] = PHONE_TYPES::CELL;		
			$phone[PHONE_TYPES::CELL] = phone_numbers($query_phone);	
			
			$GLOBALS['phone_type'] = PHONE_TYPES::HOME;		
			$phone[PHONE_TYPES::HOME] = phone_numbers($query_phone);
			
			$GLOBALS['phone_type'] = PHONE_TYPES::OFFICE;		
			$phone[PHONE_TYPES::OFFICE] = phone_numbers($query_phone);
			
			$GLOBALS['phone_type'] = PHONE_TYPES::PAGER;		
			$phone[PHONE_TYPES::PAGER] = phone_numbers($query_phone);
			
			$name = ' '.$line_staff->name_f.' '.$line_staff->name_l;
			$width = $pdf->GetStringWidth($name)+4;  
										
			$pdf->SetWidths(array(CONSTANTS::BASE_W_SPACER,
								$width,							// Name
								CONSTANTS::BASE_W_NAME-$width,	// Title
								CONSTANTS::BASE_W_SPACER,		
								CONSTANTS::BASE_W_PHONE,	// Office
								CONSTANTS::BASE_W_SPACER,
								CONSTANTS::BASE_W_PHONE,	// Pager
								CONSTANTS::BASE_W_SPACER,
								CONSTANTS::BASE_W_PHONE,	// Cell
								CONSTANTS::BASE_W_SPACER,
								CONSTANTS::BASE_W_PHONE));	// Home
		
			$borders = array(CONSTANTS::BORDER_OFF,
						'LTB',					// Name
						'TBR',					// Title
						CONSTANTS::BORDER_OFF,		
						CONSTANTS::BORDER_ON,	// Office.
						CONSTANTS::BORDER_OFF,		
						CONSTANTS::BORDER_ON,	// pager.
						CONSTANTS::BORDER_OFF,	
						CONSTANTS::BORDER_ON,	// Cell.
						CONSTANTS::BORDER_OFF,		
						CONSTANTS::BORDER_ON);	// Home.
			
			$align = array('', 
							'', 
							'', 
							'', 
							'', 
							'',
							'',
							'',
							'',
							'',
							'');
	
			$style = array('',
							'B',
							'I',
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							'');
			
			if($line_staff->title) $line_staff->title = '- '.$line_staff->title;
							
			$pdf->FancyRow(array('',
						$name,
						$line_staff->title,
						'',
						$phone[PHONE_TYPES::OFFICE],
						'',
						$phone[PHONE_TYPES::PAGER],
						'',
						$phone[PHONE_TYPES::CELL],
						'',
						$phone[PHONE_TYPES::HOME]), $borders, $align, $style);	
		
		}
	}

	$db			= NULL;	// Database object.
	$query		= NULL;	// Query object.
	$markup		= NULL; // Result markup.
	$line_arr_dept	= NULL;	// Line object array.
	$line_dept 		= NULL; // Line object.

	$db		= new class_db_connection();
	$options = new class_db_query_options();	
	
	// We don't need to update, so use fastest cursor.
	$options->set_scrollable(SQLSRV_CURSOR_FORWARD);
	
	// Initialize new query objects.	
	$query 			= new class_db_query($db, $options);	
	$query_staff	= new class_db_query($db, $options);
	$query_phone	= new class_db_query($db, $options);
	
	// Let's get a list of EHS categories.
	$query->set_sql("SELECT
		number, name
			FROM vw_uk_space_department
			WHERE number IN ('3he00', '3he10', '3he20', '3he30', '3he40', '3he50')
			ORDER BY number");
			
	$query->query();
	
	$line_arr_dept = $query->get_line_object_all();

	// Prepare a staff query.
	$query_staff->set_sql('SELECT 
							id,
							account,
							name_f,													
							name_l,
							title,
							email						
										
							FROM tbl_staff
							
							WHERE
								department = ?
								AND
								active = 1
							
							ORDER BY listing_order, name_l');					
	$query_staff->set_params(array(&$dept));
	$query_staff->prepare();


	// Prepare a phone number query.
	$query_phone->set_sql('SELECT number FROM tbl_staff_phone WHERE publish = 1 AND type = ? AND fk_id = ?');
	$query_phone->set_params(array(&$phone_type, &$id));
	$query_phone->prepare();	
		

	$pdf	=	new PDF_FancyRow();
	$pdf->AddPage();
	
	$pdf->SetFont('Arial','B',16);
	
	// Department Header.
	$pdf->Cell(0,10,'Environmental Health & Safety Division', CONSTANTS::BORDER_ON, CONSTANTS::LINE_NEXT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->SetFont(CONSTANTS::FONT_FAM, 'UB', CONSTANTS::FONT_SIZE);

	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_NAME, CONSTANTS::BASE_H, 'Environmental Health & Safety', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);

	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, 'Office', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, 'Pager', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, 'Cell', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, 'Home', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	
	// Line break.
	$pdf->Ln();
	
	// Address
	$pdf->SetFont(CONSTANTS::FONT_FAM);
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_NAME, CONSTANTS::BASE_H, ' 252 East maxwell Street, 0314', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	// Office
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Pager
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Cell
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Home
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
		
	// Line break.
	$pdf->Ln();	
		
	department_set('3he00');
	
	// Biosafety.
	$pdf->SetFont(CONSTANTS::FONT_FAM, 'UB', CONSTANTS::FONT_SIZE);

	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_NAME, CONSTANTS::BASE_H, 'Biological Safety', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);

	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	
	// Line break.
	$pdf->Ln();
	
	// Address
	$pdf->SetFont(CONSTANTS::FONT_FAM);
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_NAME, CONSTANTS::BASE_H, '505 Oldham Court', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	// Office
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Pager
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Cell
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Home
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
		
	// Line break.
	$pdf->Ln();	
		
	department_set('3he20');
	
	// Environmental Management.
	$pdf->SetFont(CONSTANTS::FONT_FAM, 'UB', CONSTANTS::FONT_SIZE);

	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_NAME, CONSTANTS::BASE_H, 'Environmental Management', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);

	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	
	// Line break.
	$pdf->Ln();
	
	// Address
	$pdf->SetFont(CONSTANTS::FONT_FAM);
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_NAME, CONSTANTS::BASE_H, '355 Cooper Drive, 490', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	// Office
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Pager
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Cell
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Home
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
		
	// Line break.
	$pdf->Ln();	
		
	department_set('3he10');
	
	// Occupational Health & Safety.
	$pdf->SetFont(CONSTANTS::FONT_FAM, 'UB', CONSTANTS::FONT_SIZE);

	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_NAME, CONSTANTS::BASE_H, 'Occupational Health & Safety', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);

	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	
	// Line break.
	$pdf->Ln();
	
	// Address
	$pdf->SetFont(CONSTANTS::FONT_FAM);
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_NAME, CONSTANTS::BASE_H, '252 East Maxwell Street, 0314', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	// Office
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Pager
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Cell
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Home
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
		
	// Line break.
	$pdf->Ln();	
		
	department_set('3he40');
	
	// Radiation Safety.
	$pdf->SetFont(CONSTANTS::FONT_FAM, 'UB', CONSTANTS::FONT_SIZE);

	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_NAME, CONSTANTS::BASE_H, 'Radiation Safety', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);

	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	
	// Line break.
	$pdf->Ln();
	
	// Address
	$pdf->SetFont(CONSTANTS::FONT_FAM);
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_NAME, CONSTANTS::BASE_H, '102 Animal Pathology, 0076', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	// Office
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Pager
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Cell
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Home
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
		
	// Line break.
	$pdf->Ln();	
		
	department_set('3he50');
	
	// University Fire Marshal.
	$pdf->SetFont(CONSTANTS::FONT_FAM, 'UB', CONSTANTS::FONT_SIZE);

	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_NAME, CONSTANTS::BASE_H, 'University Fire Marshal', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);

	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	
	// Line break.
	$pdf->Ln();
	
	// Address
	$pdf->SetFont(CONSTANTS::FONT_FAM);
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_NAME, CONSTANTS::BASE_H, '252 East Maxwell Street, 0314', CONSTANTS::BORDER_ON, CONSTANTS::LINE_RIGHT, CONSTANTS::ALIGN_CENTER);
	
	// Office
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Pager
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Cell
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
	
	// Home
	$pdf->Cell(CONSTANTS::BASE_W_SPACER, CONSTANTS::BASE_H, '');
	$pdf->Cell(CONSTANTS::BASE_W_PHONE, CONSTANTS::BASE_H, '', CONSTANTS::BORDER_ON);
		
	// Line break.
	$pdf->Ln();	
		
	department_set('3he30');
	
	$pdf->Output();

?>