<?php
/*
  ///////////////////////////////////////////////////////////
  //
  //  FILENAME      : CLASS.TABLE.PHP
	//  PROJECT       : 
  //  AUTHOR        : Thomas Andersen
	//  DATE          : 24.02.2003
	//  LAST MODIFIED : 24.02.2003
  //  MODIFIED BY   :
	//  ----------------------------------------------
	//  FILE HISTORY:
	//  ----------------------------------------------
	//  COMMENTS:
	//
  //  A procedure is the same as a function except that is does not 
	//  return anything. The same as a void function i C/C++.
	//
	//  Properties are variables declared in the class scope (not in the
	//  function/procedure scope).
	//
	//  Methods are functions and procedures declared in the class.
	//  ----------------------------------------------
  //	DESCRIPTION:
  //
  //
  //	class cls_cell inherits cls_font
  //    properties:
  //			bold      : bool
  //			italic    : bool
  //			underline : bool
  //			color   	: string
  //			align  	  : string
  //			valign 	  : string
  //			value  	  : string
  //			width  	  : int
	//			css_class : string
  //      font      : cls_font
  //    methods:
  //      public:
  //        constructor cls_cell
  //
	//				procedure set_bold(value : bool)
	//				procedure set_italic(value : bool)
	//				procedure set_underline(value : bool)
	//				procedure set_color(value : string)
	//				procedure set_align(value : string)
	//				procedure set_valign(value : string)
	//				procedure set_value(value : string)
	//				procedure set_width(value : string)
	//				procedure set_class(value : string)
  //
	//				function get_bold() : bool
	//				function get_italic() : bool
	//				function get_underline() : bool
	//				function get_color() : string
	//				function get_align() : string
	//				function get_valign() : string
	//				function get_value() : string
	//				function get_width() : string
	//				function get_class() : string
  //      private:
  //    events:
  //      public:
  //        procedure on_mouse_move(action_script: string)
  //
	//
	//
  //	class cls_table inherits cls_cell
  //    properties:
  //			rows 						 : int
  //			columns 				 : int
 	//			background_color : string
  //			width 					 : string
  //			border    			 : bool
	//			css_class 			 : string
	//			height 					 : array() of int
	//			cell 						 : array() of cls_cell
  //      font             : cls_font
  //    methods:
  //      public:
	//				procedure initialize(columns, rows : int)
	//				procedure finalize()
  //  
  //        procedure add_row()
  //        procedure add_column()
  //        procedure delete_row()
  //        procedure delete_column()
  //
	//				procedure set_column_width(column, value : string)
	//				procedure set_column_bold(column : int, value : bool)
	//				procedure set_column_italic(column : int, value : bool)
	//				procedure set_column_underline(column : int, value : bool)
	//				procedure set_column_color(column : int, value : string)
	//				procedure set_column_align(column : int, value : string)
	//				procedure set_column_valign(column : int, value : string)
	//				procedure set_column_class(column : int, value : string)
	//				procedure set_row_width(row : int, value : string)
	//				procedure set_row_height(row : int, value : string)
	//				procedure set_row_bold(row : int, value : bool)
	//				procedure set_row_italic(row : int, value : bool)
	//				procedure set_row_underline(row : int, value : bool)
	//				procedure set_row_color(row : int, value : string)
	//				procedure set_row_align(row : int, value : string)
	//				procedure set_row_valign(row : int, value : string)
	//				procedure set_row_class(row : int, value : string)
	//
	//        procedure set_rows(value : int)
	//        procedure set_columns(value : int)
	//        procedure set_width(value : string)
	//        procedure set_color(value : string)
	//        procedure set_border(value : bool)
	//        procedure set_value($column, $row, $value) // complete content of matrix delivered in an array
	//      	procedure set_row_values($row, $value) // complete content of a row in the matrix delivered in an array
	//        procedure set_column_values($column, $value) // complete content of a column in the matrix delivered in an array
  //        procedure set_values($value) // complete content of matrix delivered in an array
	//        procedure set_class(value : string)
  //        procedure set_cellspacing(value : int)
	//        function build() : string
  //      private:
  //    events:
  //      public:
  //        procedure on_mouse_move_row(action_script: string)
  //        procedure on_mouse_move_column(action_script: string)
*/

  require_once('class.font.php');
  
  
  class cls_cell extends cls_font
	{
		var $bold      = false;
		var $italic    = false;
		var $underline = false;
		var $color   	 = '';
		var $align  	 = '';
		var $valign 	 = '';
		var $value  	 = '';
		var $width  	 = '';
		var $css_class = '';
    
    var $font;

		
    function cls_cell()
    {
      $this->font = new cls_font;
    }

		function set_bold($value)
		{
			$this->bold = $value;
		}
		
		function set_italic($value)
		{
			$this->italic = $value;
		}
		
		function set_underline($value)
		{
			$this->underline = $value;
		}
		
		function set_color($value)
		{
			$this->color = '#'.$value;
		}
		
		function set_align($value)
		{
			$this->align = $value;
		}
		
		function set_valign($value)
		{
			$this->valign = $value;
		}
		
		function set_value($value)
		{
			$this->value = $value;
		}
		
		function set_width($value)
		{
			$this->width = $value;
		}
		
		function set_class($value)
		{
			$this->css_class = $value;
		}
		


		function get_bold()
		{
			return (($this->bold != '') ? $this->bold : false);
		}
		
		function get_italic()
		{
			return (($this->italic != '') ? $this->italic : false);
		}
		
		function get_underline()
		{
			return (($this->underline != '') ? $this->underline : false);
		}

		function get_color()
		{
			return (($this->color != '') ? $this->color : false);
		}
		
		function get_align()
		{
			return (($this->align != '') ? $this->align : false);
		}
		
		function get_valign()
		{
			return (($this->valign != '') ? $this->valign : false);
		}
		
		function get_value()
		{
			return (($this->value != '') ? $this->value : false);
		}
		
		function get_width()
		{
			return (($this->width != '') ? $this->width : false);
		}
		
		function get_class()
		{
			return (($this->css_class != '') ? $this->css_class : false);
		}
    
    
		//////////////////////////////////////////////
		//
		//  EVENTS
		//
    function on_mouse_over($action_script)
    {
    }
	}
	


	
	class cls_table extends cls_cell
  {
    var $rows = 1;
    var $columns = 1;

    var $background_color = '#ffffff';
    var $width = '100%';
    var $border = false;
		var $css_class = '';
    var $cellspacing = '0';
    var $font;
    
		var $height = array();		
		
		var $cell = array();
		
		
    function cls_table()
    {
      $this->font = new cls_font;
    }
    
		//////////////////////////////////////////////
		//
		//  INITIALIZE TABLE
		//
		function initialize($columns, $rows)
		{
			$this->columns = $columns;
			$this->rows = $rows;
			
			for ($int_x = 0; $int_x < $this->columns; $int_x++)
				for ($int_y = 0; $int_y < $this->rows; $int_y++)
					$this->cell[$int_x][$int_y] = new cls_cell;
		}
		
		function finalize()
		{
			$this->columns = 1;
			$this->rows = 1;

			$this->height_array = array();		
			
			$this->cell = array();
		}
				
				
    function add_row()
    {
      $this->row = $this->row + 1;

			for ($int_x = 0; $int_x < $this->columns; $int_x++)
  			$this->cell[$int_x][$this->row] = new cls_cell;
    }
    
        
    function add_column()
    {
      $this->column = $this->column + 1;
    
			for ($int_y = 0; $int_y < $this->rows; $int_y++)
  			$this->cell[$this->column][$int_y] = new cls_cell;
    }


    function delete_row()
    {
			for ($int_x = 0; $int_x < $this->columns; $int_x++)
        unset($this->cell[$int_x][$this->row]);
        
      $this->row = $this->row - 1;
    }
    
    
    function delete_column()
    {
			for ($int_y = 0; $int_y < $this->rows; $int_y++)
  			unset($this->cell[$this->column][$int_y]);

      $this->column = $this->column - 1;
    }
    
    
		//////////////////////////////////////////////
		//
		//  COLUMN FUNCTIONS
		//
		function set_column_width($column, $value)
		{
			for ($int_y = 0; $int_y < $this->rows; $int_y++)
				$this->cell[$column][$int_y]->set_width($value);
		}
		
		function set_column_bold($column, $value)
		{
			for ($int_y = 0; $int_y < $this->rows; $int_y++)
				$this->cell[$column][$int_y]->set_bold($value);
		}
		
		function set_column_italic($column, $value)
		{
			for ($int_y = 0; $int_y < $this->rows; $int_y++)
				$this->cell[$column][$int_y]->set_italic($value);
		}

		function set_column_underline($column, $value)
		{
			for ($int_y = 0; $int_y < $this->rows; $int_y++)
				$this->cell[$column][$int_y]->set_underline($value);
		}
		
		function set_column_color($column, $value)
		{
			for ($int_y = 0; $int_y < $this->rows; $int_y++)
				$this->cell[$column][$int_y]->set_color($value);
		}
		
		function set_column_align($column, $value)
		{
			for ($int_y = 0; $int_y < $this->rows; $int_y++)
				$this->cell[$column][$int_y]->set_align($value);
		}
		
		function set_column_valign($column, $value)
		{
			for ($int_y = 0; $int_y < $this->rows; $int_y++)
				$this->cell[$column][$int_y]->set_valign($value);
		}
		
		function set_column_class($column, $value)
		{
			for ($int_y = 0; $int_y < $this->rows; $int_y++)
				$this->cell[$column][$int_y]->set_class($value);
		}
		


		//////////////////////////////////////////////
		//
		//  ROW FUNCTIONS
		//
		function set_row_width($row, $value)
		{
			for ($int_x = 0; $int_x < $this->columns; $int_x++)
				$this->cell[$int_x][$row]->set_width($value);
		}
		
		function set_row_height($row, $value)
		{
			$this->height[$row] = $value;
		}
		
		function set_row_bold($row, $value)
		{
			for ($int_x = 0; $int_x < $this->columns; $int_x++)
				$this->cell[$int_x][$row]->set_bold($value);
		}
		
		function set_row_italic($row, $value)
		{
			for ($int_x = 0; $int_x < $this->columns; $int_x++)
				$this->cell[$int_x][$row]->set_italic($value);
		}
		
		function set_row_underline($row, $value)
		{
			for ($int_x = 0; $int_x < $this->columns; $int_x++)
				$this->cell[$int_x][$row]->set_underline($value);
		}

		function set_row_color($row, $value)
		{
			for ($int_x = 0; $int_x < $this->columns; $int_x++)
				$this->cell[$int_x][$row]->set_color($value);
		}
		
		function set_row_align($row, $value)
		{
			for ($int_x = 0; $int_x < $this->columns; $int_x++)
				$this->cell[$int_x][$row]->set_align($value);
		}
		
		function set_row_valign($row, $value)
		{
			for ($int_x = 0; $int_x < $this->columns; $int_x++)
				$this->cell[$int_x][$row]->set_valign($value);
		}
		
		function set_row_class($row, $value)
		{
			for ($int_x = 0; $int_x < $this->columns; $int_x++)
				$this->cell[$int_x][$row]->set_class($value);
		}


			
		//////////////////////////////////////////////
		//
		//  GENERAL TABLE FUNCTIONS
		//
		function set_rows($value)
		{
			$this->rows = $value;
		}
		
		function get_rows()
		{
			return $this->rows;
		}

		function set_columns($value)
		{
			$this->columns = $value;
		}
		
		function get_columns()
		{
			return $this->columns;
		}

		function set_width($value)
		{
			$this->width = $value;
		}
		
		function set_color($value)
		{
      if ($value != '')
			  $this->background_color = '#'.$value;
      else
        $this->background_color = '';
		}
		
		function set_border($value)
		{
			$this->border = $value;
		}
    
    function set_cellspacing($value)
    {
      $this->cellspacing = $value;
    }

    // Insert a value in a single cell		
    function set_value($column, $row, $value)
    {
 			$this->cell[$column][$row]->set_value($value);
    }
    
    // Insert values for an entire row
		function set_row_values($row, $value) // complete content of a row in the matrix delivered in an array
    {
  		for ($int_x = 0; $int_x < $this->columns; $int_x++)
  			$this->cell[$int_x][$row]->set_value($value[$int_x]);
    }

    // Insert values for an entire column
		function set_column_values($column, $value) // complete content of a column in the matrix delivered in an array
    {
  		for ($int_y = 0; $int_y < $this->columns; $int_y++)
  			$this->cell[$column][$int_y]->set_value($value[$int_y]);
    }

    // Insert values for the whole table
		function set_values($value) // complete content of matrix delivered in an array
		{
			$int_count = 0;
			
			for ($int_y = 0; $int_y < $this->rows; $int_y++)
				for ($int_x = 0; $int_x < $this->columns; $int_x++)
				{
					$this->cell[$int_x][$int_y]->set_value($value[$int_count]);
					$int_count++;
				}
		}
		
		function set_class($value)
		{
			$this->css_class = $value;
		}		
		
		
		function build()
		{
			// begin table
			$result = '<table '.$this->font->get();
      if ($this->cellspacing != '')
        $result = $result.' cellspacing="'.$this->cellspacing.'"';
			// set table attributes
    	if ($this->background_color != '')
				$result = $result.' bgcolor="'.$this->background_color.'"';
    	if ($this->width != '')
				$result = $result.' width="'.$this->width.'"';
    	if ($this->border != '')
				$result = $result.' border="1"';
    	if ($this->css_class != '')
				$result = $result.' class="'.$this->css_class.'"';
			$result = $result.'>'.chr(13);
			
			// build rows and columns
			for ($int_y = 0; $int_y < $this->rows; $int_y++)
			{
				// begin row
				$result = $result.'  <tr';
				if ($this->height[$int_y] != '')
					$result = $result.' height="'.$this->height[$int_y].'"';
				$result = $result.'>'.chr(13);
				// build columns in each row
				for ($int_x = 0; $int_x < $this->columns; $int_x++)
				{
					// begin cell
					$result = $result.'    <td';
          // add font to cell
          if ($this->cell[$int_x][$int_y]->font->changed)
            $result = $result.' '.$this->cell[$int_x][$int_y]->font->get();
					// add align to cell
					if ($this->cell[$int_x][$int_y]->get_align() != false)
						$result = $result.' align="'.$this->cell[$int_x][$int_y]->get_align().'"';
					// add valign to cell
					if ($this->cell[$int_x][$int_y]->get_valign() != false)
						$result = $result.' valign="'.$this->cell[$int_x][$int_y]->get_valign().'"';
					// add color to cell
					if ($this->cell[$int_x][$int_y]->get_color() != false)
						$result = $result.' bgcolor="'.$this->cell[$int_x][$int_y]->get_color().'"';
					// add width to cell
					if ($this->cell[$int_x][$int_y]->get_width() != false)
						$result = $result.' width="'.$this->cell[$int_x][$int_y]->get_width().'"';
					// add class to cell
					if ($this->cell[$int_x][$int_y]->get_class() != false)
						$result = $result.' class="'.$this->cell[$int_x][$int_y]->get_class().'"';
          // finalize start table cell tag
					$result = $result.'>';
          
					// add bold style to cell
					if ($this->cell[$int_x][$int_y]->get_bold() != false)
						$result = $result.'<b>';
					// add italic style to cell
					if ($this->cell[$int_x][$int_y]->get_italic() != false)
						$result = $result.'<i>';
					// add underline style to cell
					if ($this->cell[$int_x][$int_y]->get_underline() != false)
						$result = $result.'<u>';
					// insert value into cell
					$result = $result.$this->cell[$int_x][$int_y]->get_value();

					// finalize bold style in cell
					if ($this->cell[$int_x][$int_y]->get_bold() != false)
						$result = $result.'</b>';
					// finalize italic style in cell
					if ($this->cell[$int_x][$int_y]->get_italic() != false)
						$result = $result.'</i>';
					// finalize underline style in cell
					if ($this->cell[$int_x][$int_y]->get_underline() != false)
						$result = $result.'</u>';

					// finalize cell
					$result = $result.'</td>'.chr(13);
				}				
				// finalize row
				$result = $result.'  </tr>'.chr(13);
			}		
			// finish table
			$result = $result.'</table>'.chr(13);
			

			return $result;
		}
        
		//////////////////////////////////////////////
		//
		//  EVENTS
		//
    function on_mouse_move_row($action_script)
    {
    }

    function on_mouse_move_column($action_script)
    {
    }
  } 
?>