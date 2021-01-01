<?php

abstract class STATICS
{
	const MEDIAN = 10;
}

// Common data. 
//
// Note that when dealing with sub
// data, overloading some of the
// set_<>() methods will be nessesary
// to avoid conflicts.
interface iCommon
{
	// Accessors & Mutators

	function get_number();
	function set_number(int $value = NULL);
	
	// Operations

	// Populate data members from $_REQUEST vars.
	function populate_from_request(Common $target); 
}

// See interface for notes.
class Common implements iCommon
{		
	private $number	= NULL;

	
	public function get_number()
	{
		return $this->number;
	}

	public function set_number(int $value = NULL)
	{
		$this->number = $value;
	}

	// Operations
	
	// Populate members from $_REQUEST. We want to filter input
	// through our mutators. This allows us to sanitize input,
	// ignore members from the REQUEST array we don't care
	// about, and overload the set methods with downstream
	// classes. 
	//
	// To do this, we loop through the target object (usually self)
	// methods, and look for "set_". When we find a set method,
	// we look for a request array element that matches the set 
	// method name. Ex: set_id vs. $_REQUEST[id]. If we have a 
	// match, we run the set method with matched request element 
	// as the set method value argument.
	public function populate_from_request(Common $target = NULL)
	{	
		$methods	= NULL;	// Methods array.
		$method		= NULL;	// Method cursor.
		$key		= NULL;	// Request array key.

		// Default to self if no target object
		// is provided.
		if(!is_object($target))
		{
			$target = $this;
		}

		// Get the array of methods for target.
		$methods = get_class_methods($target);

		// Iterate through each class method.
		foreach($methods as $method) 
		{
			// echo '<br />'.$method;

			// Remove 'set_' from $key string, so for
			// example, "set_id" becomes "id". 	
			$key = str_replace('set_', '', $method);

			// Look for a $_REQUEST var with our new
			// $key string. If we find one, that means
			// the class method in this loop iteration
			// is a match. We can run the method and 
			// pass it the $_REQUEST var (using $key string)
			// as its value argument. 
			if(isset($_REQUEST[$key]))
			{
				// Debugging
				// echo '<br /><br />'.$method.'<br />';					
				// var_dump($_REQUEST[$key]);

				$target->$method($_REQUEST[$key]);					
			}
		}			
	}
}


// Initialize data object and run data
// population routine.
$data = new Common();
$data->populate_from_request(NULL);	

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Form Output</title>
	</head>

	<body>
		
		<h1>Example Form Output</h1>
		<p>Let's gather form data and output it here...</p>

		<?php 
		
		// Our collection object already validates input, but
		// we'll do it again here to follow the prompt.
		$number = $data->get_number();
		
		echo $number;
		
		if(is_numeric($number) && (!empty($number) || $number == 0))
		{
			// Is number above or below the target
			// median value? 
			if($number < STATICS::MEDIAN)
			{
		?>
		
				<p>Your number (<?php echo $number; ?>) is less than <?php echo STATICS::MEDIAN; ?>.</p>
		
		<?php
			}
			else
			{
		?>
		
				<p>Your number (<?php echo $number; ?>) is greater than or equal to <?php echo STATICS::MEDIAN; ?>.</p>
		
		<?php
			}
		}
		else
		{
		?>
		
		<p>Please go back and enter a number.</p>
		
		<?php
		}
		?>
		
		<a href="number_form.html">Back To Form</a>
		
	</body>
</html>