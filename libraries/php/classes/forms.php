<?php 

interface e_fieldset_clear
{
	const FIELDSET_CLEAR_NONE		= 0;	// Do not clear anything.
	const FIELDSET_CLEAR_ELEMENTS	= 1;	// Clear elements only.	
	const FIELDSET_CLEAR_ADDONSA	= 2;	// Clear Addons(above) only.	
	const FIELDSET_CLEAR_ALL		= 3;	// Clear elements array after use.
}

interface e_label_use
{
	const LABEL_USE_NONE		= NULL;		// No label for fieldset item.
	const LABEL_USE_BLANK		= 1;		// Blank label for fieldset item.
	const LABEL_USE_ITEM_KEY	= 2;		// Use the item key of a field for its fieldset label or visible selection.
	const LABEL_USE_ITEM_NAME	= 3;		// Use the item name of a field for its fieldset label or visible selection.
	const LABEL_USE_ITEM_VALUE	= 4;		// Use the item value of a field for its fieldset label or visible selection.
	const LABEL_USE_ITEM_SAME	= 5;		// Key and value are the same, only use value for speed.	
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

interface e_value_default
{
	const VALUE_DEFAULT_NONE	= NULL;		// No default value.
	const VALUE_DEFAULT_NOW		= -1;		// Default to current time for specific field.
}

class class_forms implements e_fieldset_clear, e_label_use, e_label_type, e_read_only, e_select_type, e_value_default {

	/*
	class_forms
	Damon Vaughn Caskey
	2013_01_21
	
	Miscellaneous form input functions.
	*/
		
	// Constants
	const CLASSES_NONE			= NULL;	// Classes string.
	const ATTRIBUTES_NONE		= NULL;	// Generic additional attributes, such as 'required'.
	const ID_USE_NAME			= NULL;	// Use name to generate ID.
	const ITEM_ADDITIONS_NONE	= NULL;	// No manual additions to generated item list.	
	const LEGEND_NONE 			= NULL;	// No legend for fieldset.
	const QUERY_PARAMETERS_NONE	= NULL;	// No query parameters.
	const VALUE_CURRENT_NONE	= NULL;	// Current (last selected) value.
	const EVENTS_NONE			= NULL;	// No events attached to fieldset item.
			
	public $itemsList 			= NULL;	// Array of items list for select/radio/etc.
	public $formElement			= NULL;	// Array to store completed element markup that will be placed in a fieldset.
	private $formElementActions	= NULL;	// Array of actions tied to form element (onchange, onclick, etc.).
	private $fieldset			= NULL;	// Array of completed fieldset markups ready to echo into page.
	private $fieldsetAll		= NULL;	// Combined markup of all generated fieldsets.
	private $fieldsetAddsA		= NULL;	// Array of additional instructions, links, etc. that may be added to fieldset above items.
	
	private $db 				= NULL;	// Database object.
				
	function __construct(array $dep)
	{
		/*
		Constructor
		Damon Vaughn Caskey
		2013-01-21
		
		Class constructor.
		*/
		
		// Import object dependencies.
		$this->db	= $dep['DB'];		
	}
	
	private function forms_events_markup($events=self::EVENTS_NONE)
	{
		/*
		forms_events_markup
		Damon Vaughn Caskey
		2013-03-26
		
		Concatenate HTML markup string for fieldset form item events (onchange, onclick, etc.). Allows
		addition of javascript and server triggers.
		*/
		
		$markup 	= NULL;	// Finished markup to return.	
		$event		= NULL;	// Combined "events".
		$key		= NULL;	// Event name (onchange, onclick, etc.).
		$value		= NULL;	// Event value (script code).
		
		// Verify addon array has values. If so, concatenate each event into a single 
		// markup string. Array Key is used for event trigger (onclick, onchange, etc.). 
		// Value contains the event action (script code).
		if(isset($events))
		{	
			// Loop array of events and concatenate each item into single string.	
			foreach ($events as $key => $value)
			{			
				$event .= $key.'="'.$value.'"';
			}
		}
		
		// Return final markup.
		return $markup;
	}
	
	private function forms_label_markup($style=self::LABEL_USE_NONE, $type=e_label_type::LABEL_TYPE_FIELDSET, $name=NULL, $id=NULL, $key=NULL, $value=NULL, $class=NULL)
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
		$style: 	How to arrange label markup.				
		*/
		
		$closing = NULL;
		$label = NULL;	
			
		if($type === e_label_type::LABEL_TYPE_FIELDSET)
		{
			/* Assemble opening label markup. */
			$label = '<label for="'.$id.'" id="'.$id.'_label" class="'.$class.'">';
			
			/* Assemble closing label markup. */
			$closing = '</label>';	
		}							
			
		switch($style)
		{
			// The item's Key will be used as a label.
			case self::LABEL_USE_ITEM_KEY:				
				
				$label .= $key.$closing;									
				break;
		
			// The item's value will be used as label.
			case self::LABEL_USE_ITEM_NAME:			
				
				$label .= $name.$closing;									
				break;
			
			// The item's name will be used as label.
			case self::LABEL_USE_ITEM_VALUE:
				
				$label .= $value.$closing;											
				break;

			// The label will be left blank.
			case self::LABEL_USE_BLANK:
			
				$label .= $closing;
				break;				
			
			// No label markup at all.
			case self::LABEL_USE_NONE:
			
				$label = NULL;
				break;
			
			// The style variable itself will be used for label's markup.
			default:
				
				$label .= $style.$closing;							
		}
		
		// Return label markup string.
		return $label;
	}
	
	public function forms_clear_adds_above_list()
	{
		// Clear list of fieldset addons.		
		unset($this->fieldsetAddsA);
	}
	
	public function forms_clear_element_actions_list()
	{
		// Clear list of form element actions.		
		unset($this->formElementActions);
	}
	
	public function forms_clear_fieldset_list()
	{
		// Clear list of fieldsets.		
		unset($this->fieldset);
	}
	
	public function forms_clear_fieldset_string()
	{
		// Clear the cumulative fieldset markup.		
		unset($this->fieldsetAll);
	}
	
	public function forms_clear_form_elements_list()
	{
		// Clear list of form elements.		
		unset($this->formElement);
	}
	
	public function forms_fieldset($id = NULL, $legend = self::LEGEND_NONE, array $class=array(), $clear = e_fieldset_clear::FIELDSET_CLEAR_ALL)
	{
		/*
		forms_fieldset
		Damon Vaughn Caskey
		2013-03-25
		
		Concatenate indivdiual form element markups into a complete fieldset markup and return.
		
		$id: 			Fieldset ID.
		$legend: 		Legend label, if any.
		$elements:		Array of indvidual form elements (select lists, radio groups, text boxes, etc).
		$addons:		Direct text add ons (instructions, pictures, etc.) to include inside fieldset.
		$class:			Style classes.
		$clearElements:	If TRUE (default), the forms element list ($this->formElement) is cleared after use. 
		*/
		
		$elementKey	= NULL;	// Single element key.
		$elementVal	= NULL;	// Single element value.
		$markup		= NULL;	// Output markup building string.
		
		// Ensure all class array elements are set.
		if(!isset($class['fieldset'])){ 	$class['fieldset'] 		= NULL; }
		if(!isset($class['legend'])){ 		$class['legend'] 		= NULL; }
		if(!isset($class['adds_element'])){ $class['adds_element']	= NULL;	}
		if(!isset($class['element'])){ 		$class['element']		= 'element'; }		
		
		// Concatenate fieldset initial markup.
		$markup .= PHP_EOL.'<fieldset name="'.$id.'" id="'.$id.'" class="'.$class['fieldset'].'">';
		
		// Concatenate legend.
		if($legend != self::LEGEND_NONE)
		{
			$markup .= PHP_EOL."\t".'<legend id="'.$id.'_legend" class="'.$class['legend'].'">'.$legend.'</legend>';	 
		}		
		
		// Verify addon array has values. If so, concatenate each addon with div tags and markup.
		// Array Key is used for an identifier. Value contains the markup.
		if(isset($this->fieldsetAddsA))
		{					
			foreach($this->fieldsetAddsA as $elementKey => $elementVal)
			{				
				// Assemble additions (top) element span.
				$markup .= PHP_EOL."\t".'<div id="'.$id.'_adds_top_element_'.$elementKey.'" class="'.$class["adds_element"].' '.$elementKey.'">';
				
				// Add element markup.
				$markup .= $elementVal;
				
				// Close additions (top) element span.
				$markup .= PHP_EOL."\t".'</div><!--/'.$id.'_adds_top_element_'.$elementKey.'-->';				
			}				
		}		
		
		// Verify element array has values. If so, concatenate each element with div tags and markup.
		// Array Key is used for an identifier. Value contains the markup.
		if(isset($this->formElement))
		{			
			foreach($this->formElement as $elementKey => $elementVal)
			{				
				// Assemble element div.
				$markup .= PHP_EOL."\t".'<div id="'.$id.'_element_'.$elementKey.'" class="'.$class["element"].' '.$elementKey.'">';
				
				// Add element markup.
				$markup .= $elementVal;
				
				// Close element div.
				$markup .= PHP_EOL."\t".'</div><!--/'.$id.'_element_'.$elementKey.'-->';
			}
		}		
		
		// Close fieldset markup.
		$markup .= PHP_EOL.'</fieldset><!--/'.$id.'_fieldset-->';
		
		// Clear out fieldset variables as needed.
		$this->forms_fieldset_cleanup($clear);
		
		// Place completed markup into class level array of indivdual fieldsets.
		$this->fieldset[$id] = $markup;
		
		// Concatenate completed markup with class level "All fieldsets so far" markup string.
		$this->fieldsetAll .= $markup;
		
		// Return completed fieldset markup.
		return $this->fieldset[$id];
	}
	
	public function forms_fieldset_addition($id, $markup)
	{
		$this->fieldsetAddsA[$id] = $markup;
	}
	
	public function forms_fieldset_cleanup($clear = e_fieldset_clear::FIELDSET_CLEAR_ALL)
	{
		/*
		forms_fieldset_cleanup
		Damon Vaughn Caskey
		2014-02-26

		Clear class level fieldset variables as required.
		
		$clear: Which variables to clear. See e_fieldset_clear.
		*/
		
		// Clear form elements list?
		switch($clear)
		{
			case e_fieldset_clear::FIELDSET_CLEAR_NONE:
			
				break;
			
			case e_fieldset_clear::FIELDSET_CLEAR_ADDONSA:
			
				$this->forms_clear_adds_above_list();
				break;
			
			case e_fieldset_clear::FIELDSET_CLEAR_ELEMENTS:
			
				$this->forms_clear_form_elements_list();
				break;
			
			case e_fieldset_clear::FIELDSET_CLEAR_ALL:
			
				$this->forms_clear_adds_above_list();
				$this->forms_clear_form_elements_list();
				break;
		}
	}
	
	public function forms_fieldset_get($id)
	{
		/*
		forms_fieldset_get
		Damon Vaughn Caskey
		2014-02-27
		
		Return value of fieldset data member.
		
		$id: Array element of datamember to get.
		*/
		
		return $this->fieldset[$id];
	}
	
	public function forms_fieldset_all_get()
	{
		/*
		forms_fieldset_all_get
		Damon Vaughn Caskey
		2014-02-27
		
		Return value of fieldsetAll data member.
		*/
		
		return $this->fieldsetAll;
	}
	
	public function forms_fieldset_all_set($value)
	{
		/*
		forms_fieldset_all_set
		Damon Vaughn Caskey
		2014-02-27
		
		Set fieldsetAll data member.
		
		$value. new value for datamember.
		*/
		
		$this->fieldsetAll = $value;
	}
	
	public function forms_input($name=NULL, $id=self::ID_USE_NAME, $label=self::LABEL_USE_NONE, $default=self::VALUE_DEFAULT_NONE, $current=self::VALUE_CURRENT_NONE, array $class=NULL, $events=self::EVENTS_NONE, $attributes=self::ATTRIBUTES_NONE, $type='text')
	{	
		/*
		forms_input
		Damon Vaughn Caskey
		2013-01-21
		
		Output form text input markup.				
		*/
	
		$markup 	=	NULL;	// Final markup to echo.
		$event		=	NULL;	// Event string.	
		$key		= 	NULL;	// Array key.
		$value		= 	NULL;	// Array value.
		
		// Ensure defaults are set if some but not all elements are passed.
		if(!isset($class['outer_container'])){ 	$class['outer_container'] 	= NULL;	}
		if(!isset($class['label'])){			$class['label']				= NULL;	}
		if(!isset($class['element'])){ 			$class['element'] 			= NULL; }
						
		// Set ID to name?
		if($id === self::ID_USE_NAME)
		{
			$id = $name;	
		}
		
		// If current value empty or NULL, set "No current" cosntant.
		if(!$current)
		{
			$current = self::VALUE_CURRENT_NONE;
		}
		
		//If default is NONE, use NULL. ohterwise use default.
		if($default === self::VALUE_DEFAULT_NONE)
		{
			$default = NULL;
		}
		
		// If no current value is available, use default.
		if(!$current || $current === self::VALUE_CURRENT_NONE)
		{
			$current = $default;
		}
				
		// Parse event actions.
		$event = $this->forms_events_markup($events);			
		
		// Assemble outer container div.
		$markup .='<div id="'.$id.'_outer_container" class="'.$class['outer_container'].'">';
		
		// Prepare label markup.
		$markup .= $this->forms_label_markup($label, e_label_type::LABEL_TYPE_FIELDSET, $name, $id, $key, $value, $class['label']);
					
		$markup .= '<input type="'.$type.'" '.$attributes.' name="'.$name.'" id="'.$id.'" class="'.$class['element'].'" value="'.$current.'" '.$event.' />';
		
		// Close outer container
		$markup .= '</div><!--/'.$id.'_outer_container-->';
		
		// Store in elements array using id as key.
		$this->formElement[$id] = $markup;
		
		//	Return end result.
		return $markup;
	}
	
	public function forms_list_array_from_query($query=NULL, $params=array(self::QUERY_PARAMETERS_NONE), $addsTop=self::ITEM_ADDITIONS_NONE, $addsEnd=self::ITEM_ADDITIONS_NONE){		
		
		/*
		forms_list_array_from_query
		Damon Vaughn Caskey
		2012-12-19
		
		Create list array directly from query results.
		
		$query:		SQL query string.
		$params:	Parameter array.
		$default:	Default selection.
		$current:	Current selection.
		$addsTop:	Additional items to place at top of generated list.
		$addsEnd:	Additional items to place at bottom of generated list.
		*/
	
		$ROWKEY = 0;
		$ROWVAL = 1;
	
		$i		=	NULL;		//Counter.
		$list	=	NULL;		//Output string.
		$key	=	NULL;
		$list	=	array();
		$line 	= 	NULL;		// DB Line array.
		$keycount = 0;
			
		// Verify object dependencies.
		if(!$this->db)	trigger_error('Missing object dependency: Database.', E_USER_ERROR);
		
		if($query)
		{		
			// Query for list items.
			$this->db->db_basic_select($query, $params, FALSE, TRUE, TRUE);
			
			$keycount = $this->db->DBFCount;
					
			// Populate list variable.
			while($this->db->db_line(SQLSRV_FETCH_NUMERIC))
			{	
				// Dereference line array.
				$line = $this->db->DBLine;
			
				if($keycount === 1)
				{			
					$key = $line[$ROWKEY];
				}
				else
				{
					$key = $line[$ROWVAL];
				}
				
				// Get key (used for items visible to user).
				$key = trim(str_replace('&', '&amp;', $key));
				
				// If fields exist beyond first key, append to a single key value.
				if($keycount > 2)
				{	
					// Start with field #2 (third field) and append to key string until last field is reached.
					for($i = 2; $i <= $keycount-1; $i++)
					{
						$key .= '; '. str_replace('&', '&amp;', $line[$i]);	
					}
				}
				
				// Populate list array using visible portion of list values as key.			 
				$list[$key] = $line[$ROWKEY];									
			}
		}
		
		// Merge Additions. (As of 5.4 array_merge() will always reorder indexes).
		if($addsTop && is_array($addsTop))
		{	
			$list = $addsTop + $list;	
		}
		
		if($addsEnd && is_array($addsEnd))
		{	
			$list += $addsEnd;	
		}	
		
		$this->itemsList = $list;
		
		/* Output final list value. */
		return $this->itemsList;
	}
	
	public function forms_list_numeric($type=NULL, $query=NULL, $params=NULL, $default=NULL, $current=NULL, $key=self::LABEL_USE_ITEM_KEY, $start=0, $addsTop=NULL, $addsEnd=NULL)
	{		
		/*
		forms_list_numeric
		Damon V. Caskey
		2012-12-19		
		
		Generate a simple numeric list with maximum value based number of rows returned by query.
		
		$type: 	
		$query:		SQL query string.
		$params:	Parameter array.
		$default:	Default selection.
		$current:	Current selection.
		$key:		Use key as item label?
		$start:		First numeric value of generated list.
		$addsTop:	Additional items to place at top of generated list.
		$addsEnd:	Additional items to place at bottom of generated list.
		*/
		
		$i		= NULL;	//Counter.
		$list	= NULL;	//Item list array.			
		$list	= array();
		$count	= 0;
		
		// Verify object dependencies.
		if(!$this->db)	trigger_error('Missing object dependency: Database.', E_USER_ERROR);
				
		$this->db->db_basic_select($query, $params);	
		
		$count = $this->db->DBRowCount;
			
		for($i = $start; $i <= $count; $i++)
		{		
			$list[$i] = $i;
		}				
		
		/* Merge Additions. (As of 5.4 array_merge() will always reorder indexes). */
		if($addsTop && is_array($addsTop))
		{	
			$list = $addsTop + $list;	
		}
		
		if($addsEnd && is_array($addsEnd))
		{	
			$list += $addsEnd;	
		}
		
		switch ($type)
		{
			case self::SELECT_TYPE_RADIO:
				//$this->cDLListCode = $this->forms_select_options($list, $default, $current, $key);
			default:
				$this->cDLListCode = $this->forms_select_options($list, $default, $current, $key);
		}
		
		return $this->cDLListCode;
	}	
					
	public function forms_radio($name=NULL, $id=self::ID_USE_NAME, $labelStyle=self::LABEL_USE_ITEM_KEY, $list=array(NULL), $default=NULL, $current=self::VALUE_CURRENT_NONE, $class=array('Item' => NULL), $events=self::EVENTS_NONE, $attributes=self::ATTRIBUTES_NONE, $type='radio')
	{
		/*
		forms_radio
		Damon Vaughn Caskey
		2013-03-24	
	
		Generate radio or check form element. 
		
		$name: 			Name of element.
		$id:			ID of element. Value is added to ensure ID is unique and valid.
		$labelStyle:	Layout of attached element label.
		$list:			Item array element list will be created from.
		$default:		Default selected value from item list.
		$current:		Optional currently selected value. Overrides default.
		$class:			Array of div container names to enable custom styling.
		$events:		Array of event calls, typically for Javascript triggers.
		$attributes:	Open string to add other miscellaneous items to element.
		$type:			Type of element.
		*/		
								
		$key		=	NULL;	//Array key.
		$value		=	NULL;	//Array value.
		$checked	= 	NULL;	//Checked (default/current)?
		$markup 	=	NULL;	//Final markup to echo.
		$label		=	NULL;	//Item label markup.
		$idFinal	= 	NULL;	//Final ID inserted into markup.
		$event		=	NULL;	//Event call inserts.
		
		/* Ensure defaults are set if some but not all elements are passed. */
		if(!isset($class['Container_Item'])){ 	$class['Container_Item'] = NULL; } 
		if(!isset($class['Container_All'])){ 	$class['Container_All'] = 'Show Me'; 	}
		
		$markup .='<div class="'.$class['Container_All'].'">';
		
		/* Set ID to name? */
		$id = $id != self::ID_USE_NAME ? $id : $name;
		
		/* If current value empty or NULL, set "No current" cosntant */
		$current = $current ? $current : self::VALUE_CURRENT_NONE;
		
		/* Parse event actions. */
		$event = $this->forms_events_markup($events);		
		
		if(isset($list))
		{
			foreach ($list as $key => $value)
			{				
				/* If $value matches $current, or $current not provided but $value matches $default, add 'checked' to make this the default list item selected. */	
				if ($current === $value || ($current === self::VALUE_CURRENT_NONE && $value === $default))
				{
					$checked = 'checked';
				}
				else
				{
					$checked = NULL;
				}		
						
				/* IDs must be unique, so we'll combine ID with value. */
				$idFinal = $id."_".$value;			
				
				/* Prepare label markup. */
				$markup .= $this->forms_label_markup($labelStyle, e_label_type::LABEL_TYPE_FIELDSET, $name, $idFinal, $key, $value);			
				
				$markup .= '<div class="'.$class['Container_Item'].'"><input type="'.$type.'" name="'.$name.'" id="'.$idFinal.'" value="'.$value.'" '.$checked.' '.$event.' '.$attributes.' /></div>';			
			}
		}
		
		$markup .= '</div>';
		
		/* Return end result. */
		return $markup;
	
	}
	
	public function forms_select($name=NULL, $id=self::ID_USE_NAME, $labelStyle=self::LABEL_USE_ITEM_KEY, $keyStyle=self::LABEL_USE_ITEM_KEY, $list=array(NULL => NULL), $default=NULL, $current=self::VALUE_CURRENT_NONE, $class=array(), $events=self::EVENTS_NONE, $attributes=self::ATTRIBUTES_NONE)
	{
		/*
		forms_select
		Damon Vaughn Caskey
		2013-03-24	
		*/
								
		$key		=	NULL;	//Array key.
		$value		=	NULL;	//Array value.
		$checked	= 	NULL;	//Checked (default/current)?
		$markup 	=	NULL;	//Final markup to echo.
		$label		=	NULL;	//Item label markup.
		$event		=	NULL;	
		$cItems		=	NULL;	//Select options.
		
		// Ensure defaults are set if some but not all elements are passed. 
		if(!isset($class['outer_container'])){ 	$class['outer_container'] 	= NULL;	}
		if(!isset($class['label'])){			$class['label']				= NULL;	}
		if(!isset($class['element'])){ 			$class['element'] 			= NULL; 	}		
		
		// Set ID to name?
		$id = $id != self::ID_USE_NAME ? $id : $name;		
		
		// Parse event actions.
		$event = $this->forms_events_markup($events);		
		
		// Ensure list is an array.
		if (!is_array($list))
		{
			$list = array(NULL => NULL);
		}
		
		// Assemble outer container div.
		$markup .= PHP_EOL.'<div id="'.$id.'_outer_container" class="'.$class['outer_container'].'">';
		
		foreach ($list as $key => $value)
		{				
			// If $value matches $current, or $current not provided but $value matches $default, add 'checked' to make this the default list item selected.
			if ($current === $value || ($current === self::VALUE_CURRENT_NONE && $value === $default))
			{
				$checked = ' selected';
			}
			else
			{
				$checked = '';
			}		
				
			// Prepare label markup.
			$label = $this->forms_label_markup(self::LABEL_USE_ITEM_KEY, e_label_type::LABEL_TYPE_TEXT, $name, $id, $key, $value, $class['label']);
			
			$cItems.="\t\t".'<option value="'.$value.'"'.$checked.'>' . $label . '</option>'.PHP_EOL;			
		}		
		
		// Prepare label markup.
		$label = $this->forms_label_markup($labelStyle, e_label_type::LABEL_TYPE_FIELDSET, $name, $id, $key, $value);			
		
		$markup .= "\t".$label.'<select name="'.$name.'" id="'.$id.'" class="'.$class['element'].'" '.$event.' '.$attributes.'>'.$cItems.'</select>'.PHP_EOL;
		
		// Close outer container.
		$markup .= PHP_EOL.'</div><!--/'.$id.'_outer_container-->';
		
		// Store in elements array using id as key.
		$this->formElement[$id] = $markup;
		
		//	Return end result.
		return $markup;
	
	}
					
	public function forms_time($name=NULL, $id=self::ID_USE_NAME, $label=self::LABEL_USE_NONE, $default=NULL, $current=NULL, $options='{dateFormat: "yy-mm-dd", timeFormat: "HH:mm:ss", controlType: "select", changeYear: true, constrainInput: true}', $function='datetimepicker', $readOnly=self::READ_ONLY_ON, $class=NULL, $attributes='required', $events=NULL)
	{	
		/*
		forms_time
		Damon Vaughn Caskey
		2013-01-21
		
		Output form date/time input markup.
		*/
	
		$markup 	=	NULL;	//Final markup to echo.
		$event		=	NULL;	//Event string.	
		
		// Ensure defaults are set if some but not all elements are passed.
		if(!isset($class['Container_Item'])){ 	$class['Container_Item'] = 'date_entry'; } 
		if(!isset($class['Container_All'])){ 	$class['Container_All'] = 'Show Me'; 	}
				
		$markup .='<div class="'.$class['Container_All'].'">'.PHP_EOL;
				
		// Set ID to name?
		$id = $id != self::ID_USE_NAME ? $id : $name;
		
		// If current value empty or NULL, set "No current" cosntant.
		$current = $current ? $current : self::VALUE_CURRENT_NONE;
		
		$default = $default == self::VALUE_DEFAULT_NONE ? NULL : $default; 
		
		// If no current value is available, use default.
		if(!$current || $current == self::VALUE_CURRENT_NONE)
		{
			$current = $default;
		}
		 						
		// Parse event actions.
		$event = $this->forms_events_markup($events);			
		
		// Prepare label markup.
		$markup .= $this->forms_label_markup($label, e_label_type::LABEL_TYPE_FIELDSET, $name, $id, NULL, NULL);		
		
		$markup .= PHP_EOL."\t<script>".PHP_EOL."$(function(){
						$( '#".$id."' ).".$function."(".$options.");
					});".PHP_EOL."\t</script>".PHP_EOL;

		$markup .= "\t".'<div class="'.$class["Container_Item"].'">'.PHP_EOL."\t\t".'<input type="text" '.$attributes.' name="'.$name.'" id="'.$id.'" value="'.$current.'"';
		
		if ($readOnly==TRUE)
		{
			$markup .= ' readonly';
		}
		
		$markup .= ' class="date_entry" />'.PHP_EOL."\t".'</div><!--/'.$class['Container_Item'].'-->'.PHP_EOL.'</div><!--/'.$class['Container_All'].'-->'.PHP_EOL;
		
		// Store in elements array using id as key.
		$this->formElement[$id] = $markup;
		
		// Return end result.
		return $markup;
	}	
	
	public function forms_time_html5($name=NULL, $id=self::ID_USE_NAME, $label=self::LABEL_USE_NONE, $default=NULL, $current=NULL, $options='datetime-local', $function='', $readOnly=self::READ_ONLY_OFF, $class=NULL, $attributes='required', $events=NULL)
	{	
		/*
		forms_time_html5
		Damon Vaughn Caskey
		2014-06-16
		
		Output form date/time input markup.
		*/
	
		$markup 	=	NULL;	//Final markup to echo.
		$event		=	NULL;	//Event string.	
		
		// Ensure defaults are set if some but not all elements are passed.
		if(!isset($class['Container_Item'])){ 	$class['Container_Item'] = 'date_entry'; } 
		if(!isset($class['Container_All'])){ 	$class['Container_All'] = 'Show Me'; 	}
				
		$markup .='<div class="'.$class['Container_All'].'">'.PHP_EOL;
				
		// Set ID to name?
		$id = $id != self::ID_USE_NAME ? $id : $name;
		
		// If current value empty or NULL, set "No current" cosntant.
		$current = $current ? $current : self::VALUE_CURRENT_NONE;
		
		$default = $default == self::VALUE_DEFAULT_NONE ? NULL : $default; 
		
		// If no current value is available, use default.
		if(!$current || $current == self::VALUE_CURRENT_NONE)
		{
			$current = $default;
		}
				 						
		// Parse event actions.
		$event = $this->forms_events_markup($events);			
		
		// Prepare label markup.
		$markup .= $this->forms_label_markup($label, e_label_type::LABEL_TYPE_FIELDSET, $name, $id, NULL, NULL);		

		$markup .= "\t".'<div class="'.$class["Container_Item"].'">'.PHP_EOL."\t\t".'<input type="'.$options.'" '.$attributes.' name="'.$name.'" id="'.$id.'" value="'.$current.'"';
		
		if ($readOnly==TRUE)
		{
			$markup .= ' readonly';
		}
		
		$markup .= ' class="date_entry" />'.PHP_EOL."\t".'</div><!--/'.$class['Container_Item'].'-->'.PHP_EOL.'</div><!--/'.$class['Container_All'].'-->'.PHP_EOL;
		
		// Store in elements array using id as key.
		$this->formElement[$id] = $markup;
		
		// Return end result.
		return $markup;
	}	
	
				
}
?>
