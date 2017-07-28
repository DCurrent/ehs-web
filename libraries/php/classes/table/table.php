<?php 

interface table_cell
{
	function build_markup();		// Build and return completed cell markup.
	function markup();				// Return markup.
	function set_contents($value);	// Set contents.
	function contents();			// Return contents.
	function set_classname($value);	// Set class.
	function classname();			// Return class.
	function set_colspan($value);	// Set column span.
	function colspan();				// Return column span.
	function set_rowspan($value);	// Set row span.
	function rowspan();				// Return row span.
}

class class_table_cell implements table_cell
{
	private $markup_m;		// Markup of cell.
	private $contents_m;	// Contents displayed in cell.
	private $classname_m;	// Class applied to cell.
	private $colspan_m;		// Column span.
	private $rowspan_m;		// Row span.
	
	// Build and return cell markup.
	public function build_markup()
	{
		$this->markup_m .= '<td class="'.$this->classname_m.'"';
		
		// If column span used, add to markup.
		if($this->colspan_m)
		{
			$this->markup_m .= ' colspan="'.$this->colspan_m.'"';
		}
		
		// If rowspan used, add to markup.
		if($this->rowspan_m)
		{
			$this->markup_m .= ' rowspan="'.$this->rowspan_m.'"';
		}
		
		// Now add cell contents and close cell.
		$this->markup_m .= '>'.$this->contents_m.'</td>';	
	}
}

?>
