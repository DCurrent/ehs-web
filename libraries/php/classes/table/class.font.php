<?php
/*
  ///////////////////////////////////////////////////////////
  //
  //  FILENAME      : CLASS.FONT.PHP
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
	//  return anything. The same as a void-function i C/C++.
	//
	//  Properties are variables declared in the class scope (not in the
	//  function/procedure scope).
	//
	//  Methods are functions and procedures declared in the class.
	//  ----------------------------------------------
  //	DESCRIPTION:
  //
  //	class cls_font_style
  //    properties:
  //      bold      : bool
  //      italic    : bool
  //      underline : bool
  //    methods:
  //      public:
  //        constructor cls_font_style()
  //
  //        function get() : string
  //
  //
  //
  //	class cls_font inherits cls_font_style
  //    properties:
  //      name  : string
  //      size  : int
  //      color : string
  //      style : cls_font_style
  //    methods:
  //      public:
  //        constructor cls_font()
  //        
  //        procedure set_name(value : string)
  //        procedure set_size(value : int)
  //        procedure set_color(value : string)
  //        procedure set_bold(value : bool)
  //        procedure set_italic(value : bool)
  //        procedure set_underline(value : bool)
  //        function get() : string
  //
  //
*/



  class cls_font_style
  {
    var $bold;
    var $italic;
    var $underline;
    
    
    function cls_font_style()
    {
      $this->bold = false;
      $this->italic = false;
      $this->underline = false;
    }
    
    function get()
    {
      $result = ' font-weight: '.(($this->bold) ? 'bold;' : 'normal;');
      $result = $result.' font-style: '.(($this->italic) ? 'italic;' : 'normal;');
      $result = $result.' text-decoration: '.(($this->underline) ? 'underline;' : 'none;');
      
      return $result;
    }
  }
  
  
  class cls_font extends cls_font_style 
  {
    var $name;
    var $size;
    var $color;
    
    var $style;
    var $changed;
    
    
    function cls_font()
    {
      $this->name = 'verdana';
      $this->size = 10;
      $this->color = '000000';
      
      $this->style = new cls_font_style;
      
      $this->changed = false;
    }
    
    function set_name($value)
    {
      $this->name = $value;
      $this->changed = true;
    }
    
    function set_size($value)
    {
      $this->size = $value;
      $this->changed = true;
    }
    
    function set_color($value)
    {
      $this->color = $value;
      $this->changed = true;
    }
    
    function set_bold($value)
    {
      $this->style->bold = $value;
      $this->changed = true;
    }
    
    function set_italic($value)
    {
      $this->style->italic = $value;
      $this->changed = true;
    }

    function set_underline($value)
    {
      $this->style->underline = $value;
      $this->changed = true;
    }

    function get()
    {
      $result = 'style="';
      $result = $result.'font-family: '.$this->name.';';
      $result = $result.' font-size: '.$this->size.'px;';
      $result = $result.' color: #'.$this->color.';';
      $result = $result.$this->style->get();
      $result = $result.'"';
      
      return $result;
    }
  }
?>