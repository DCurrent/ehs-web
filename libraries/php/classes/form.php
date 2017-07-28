<?php 



/**
	2013-03-03: Label handling.


 * Class set for creation of form markup.
 *
 * PHP version 5
 *
 * @author     Damon V. Caskey <dc@caskeys.com>
 * @copyright  2014
 * @license    http://www.caskeys.com/dc/?p=5067
 */

interface e_fieldset_clear
{
	const FIELDSET_CLEAR_NONE		= 0;	// Do not clear anything.
	const FIELDSET_CLEAR_ELEMENTS	= 1;	// Clear elements only.	
	const FIELDSET_CLEAR_ADDONSA	= 2;	// Clear Addons(above) only.	
	const FIELDSET_CLEAR_ALL		= 3;	// Clear elements array after use.
}

interface e_id_use
{
	const ID_USE_NAME				= NULL;	// Use the elements name for its ID as well.
}

interface e_label_use
{
	const LABEL_USE_NONE		= NULL;		// No label for fieldset item.
	const LABEL_USE_BLANK		= 1;		// Blank label for fieldset item.
	const LABEL_USE_ITEM_KEY	= 2;		// Use the item key of a field for its fieldset label or visible selection.
	const LABEL_USE_ITEM_NAME	= 3;		// Use the item name of a field for its fieldset label or visible selection.
	const LABEL_USE_ITEM_VALUE	= 4;		// Use the items value of a field for its fieldset label or visible selection.	
}

interface e_label_type
{
	const LABEL_TYPE_FIELDSET	= 0;		// Fieldset label.
	const LABEL_TYPE_TEXT		= 1;		// Label text only; no formatting.	
}

interface e_read_only
{
	const READ_ONLY_OFF			= FALSE;	// Do not lock input element.
	const READ_ONLY_ON			= TRUE;		// Lock input element.
}

interface e_select_type
{
	const SELECT_TYPE_RADIO		= 0;		// Radio type list.
	const SELECT_TYPE_SELECT	= 1;		// Select type list.
}

interface e_value_current
{
	const VALUE_CURRENT_NONE	= NULL;		// No current value.
}

interface e_value_default
{
	const VALUE_DEFAULT_NONE	= NULL;		// No default value.
	const VALUE_DEFAULT_NOW		= -1;		// Default to current time for specific field.
}

class class_formset extends class_form 
{
	public function new_element($name = NULL)
	{
		$this->element[$name] = new element;
	}
}

class class_form {

	/*
	class_formset
	Damon Vaughn Caskey
	2013_01_21
	
	Miscellaneous form input functions.
	*/
		
	// Constants
		
	public $element;
	
	private $action;
	private $name;
	
	function __construct()
	{
		/*
		Constructor
		Damon Vaughn Caskey
		2013-01-21
		
		Class constructor.
		*/			
	}	
	
	public function build_form()
	{
		$action = $this->action;
		$name = $this->name;
	
		$markup = '<form action="'.$action.'">';
		
		$markup .= $element['test'];
		
		$markup .='</form>';
		
		return $markup;
	}	
	
}

class event
{
	// onchange, onclick, etc.
}

class element implements e_id_use, e_label_type, e_label_use, e_value_current, e_value_default
{
	const CLASS_OUTER_CONTAINER	= "hello";
	const CLASS_LABEL 			= "hello";
	const CLASS_ELEMENT 		= "hello";
	const ATTRUBUTES			= NULL;
	
	private $dep			= NULL;	// Object dependencies.
	private $name 			= NULL;	// Name of element.
	private $id				= NULL; // ID of element.
	private $label_use		= NULL;	// label, or what parameter to use for label of element.
	private $label_type		= NULL;	// Type of label (i.e. part of select box, label for a text, etc.)
	private $default_val	= NULL;	// Default value of element.
	private $current_val	= NULL;	// Current value of element (i.e. retained value from user posting form).
	private $classes		= NULL; // Array of class strings for each part of the element (label, element itself, a container div, etc.).
	private $type			= NULL;	// Type (memo vs. text).
	private $attributes		= NULL;	// Other attributes (see http://www.w3schools.com/html/html5_form_attributes.asp)
		
	function __construct(array $dep = NULL, $name = NULL, $default = e_value_default::VALUE_DEFAULT_NONE, $current = e_value_current::VALUE_CURRENT_NONE, $label_use = e_label_use::LABEL_USE_NONE)
	{
		/*
		Constructor
		Damon Vaughn Caskey
		2014-03-03
		
		Class constructor.
		*/
		
		echo 'initialized';
		
		// Initialize array elements.
		$this->classes['element'] 			= self::CLASS_ELEMENT;
		$this->classes['label'] 			= self::CLASS_LABEL;
		$this->classes['outer_container']	= self::CLASS_OUTER_CONTAINER;
				
		// Set member vars.
		$this->name			= $name;		
		$this->default_val 	= $default;
		$this->current_val	= $current;	
		$this->label_use	= $label_use;		
		$this->id			= e_id_use::ID_USE_NAME;
				
		// Set defaults for un defined class parameters.
		$this->element_set_attributes($this->attributes);
		$this->element_set_class_element($this->classes['element']);
		$this->element_set_class_label($this->classes['label']);
		$this->element_set_class_outer_container($this->classes['outer_container']);		
	}	
	
	public function element_set_attributes($class)
	{
		// Set attributes string or reset to default.		
		
		if(!$class)
		{
			$class = self::ATTRUBUTES;
		}	
		
		$this->attributes = $class;
	}
	
	public function element_set_class_element($class)
	{
		// Set label class string or reset to default.		
		
		if(!$class)
		{
			$class = self::CLASS_ELEMENT;
		}	
		
		$this->classes['element'] = $class;
	}
	
	public function element_set_class_label($class)
	{
		// Set label class string or reset to default.		
		
		if(!$class)
		{
			$class = self::CLASS_LABEL;
		}
		
		$this->classes['label'] = $class;
	}
	
	public function element_set_class_outer_container($class)
	{
		// Set outer container class string or reset to default.		
		
		if(!$class)
		{
			$class = self::CLASS_OUTER_CONTAINER;
		}
		
		$this->classes['outer_container'] = $class;
	}
	
	public function element_text($name=NULL)
	{	
		/*
		element_text
		Damon Vaughn Caskey
		2013-01-21
		
		Output form text input markup.				
		*/
	
		$markup 	=	NULL;	// Final markup to echo.
		$id			=   $this->id;
		$event		=	NULL;	// Event string.	
		$key		= 	NULL;	// Array key.
		$value		= 	NULL;	// Array value.
		$current	= 	$this->current_val;	// Current value.	
		$default	=	$this->default_val;	// Default value.
		$classes 	= 	$this->classes;		//Classes string array.
		$label_use	= 	$this->label_use;	//Label use or value.
		$attributes =	$this->attributes;	//Element attributes.
				
		// Set ID to name?
		if($id === e_id_use::ID_USE_NAME)
		{
			$id = $name;	
		}
		
		// If current value empty or NULL, set "No current" cosntant.
		if(!$current)
		{
			$current = e_value_current::VALUE_CURRENT_NONE;
		}
		
		//If default is NONE, use NULL. ohterwise use default.
		if($default === e_value_default::VALUE_DEFAULT_NONE)
		{
			$default = NULL;
		}
		
		// If no current value is available, use default.
		if(!$current || $current === self::VALUE_CURRENT_NONE)
		{
			$current = $default;
		}
				
		// Parse event actions.
		//$event = $this->forms_events_markup($events);			
		
		// Assemble outer container div.
		$markup .='<div id="'.$id.'_outer_container" class="'.$classes['outer_container'].'">';
		
		// Prepare label markup.
		$markup .= $this->element_label_markup($label_use, e_label_type::LABEL_TYPE_FIELDSET, $name, $id, $key, $value);
					
		$markup .= '<input type="text" '.$attributes.' name="'.$name.'" id="'.$id.'" class="'.$classes['element'].'" value="'.$current.'" '.$event.' />';
		
		// Close outer container
		$markup .= '</div><!--/'.$id.'_outer_container-->';
				
		//	Return end result.
		return $markup;
	}
	
	private function element_label_markup($use=e_label_use::LABEL_USE_NONE, $type=e_label_type::LABEL_TYPE_FIELDSET, $name = NULL, $id = NULL, $key = NULL, $value = NULL)
	{
		/*
		forms_label_markup
		Damon Vaughn Caskey
		2013-03-26
		
		Prepare HTML markup string for fieldset form item labels.
		
		$name: 	Name of item.
		$id:		ID of item.
		$key:		Array key of item.
		$value: 	Array value of item.
		$use: 	How to arrange label markup.				
		*/
		
		$closing 	= NULL;
		$label 		= NULL;	
		$class		= $this->classes['label'];
		
		
		if($type === e_label_type::LABEL_TYPE_FIELDSET)
		{
			// Assemble opening label markup.
			$label = '<label for="'.$id.'" id="'.$id.'_label" class="'.$class.'">';
			
			// Assemble closing label markup.
			$closing = '</label>';	
		}							
			
		switch($use)
		{
			// The item's Key will be used as a label.
			case e_label_use::LABEL_USE_ITEM_KEY:				
				
				$label .= $key.$closing;									
				break;
		
			// The item's value will be used as label.
			case e_label_use::LABEL_USE_ITEM_NAME:			
				
				$label .= $name.$closing;									
				break;
			
			// The item's name will be used as label.
			case e_label_use::LABEL_USE_ITEM_VALUE:
				
				$label .= $value.$closing;											
				break;

			// The label will be left blank.
			case e_label_use::LABEL_USE_BLANK:
			
				$label .= $closing;
				break;				
			
			// No label markup at all.
			case e_label_use::LABEL_USE_NONE:
			
				$label = NULL;
				break;
			
			// The style variable itself will be used for label's markup.
			default:
				
				$label .= $style.$closing;							
		}
		
		// Return label markup string.
		return $label;
	}
}

class fieldset
{
}

?>
