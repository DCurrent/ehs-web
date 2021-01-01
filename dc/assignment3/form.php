<?php

// Basic page attributes. If this were a "real" class, we
// would be best off offloading default value data into 
// a configuration class using an injected dependency
// model, and pull mutable data from a DB connection. 
// Additionally we would want our classes in separate
// files. That’s all a bit much to bother with for an 
// example page.

// Basic configuration and default values.
abstract class ATTRIBUTE_DEFAULTS
{
	// Connection options
	const TITLE 	= 'Assignment 3';
	const HEAD		= '<h1 id="page_top">DC Example Site</h1>';
	const INTRO 	= '<p>Welcome to DC&#39;s example website.</p>';
}

interface iAttributes
{	
	// Accessors
	function get_head();
	function get_introduction();
	function get_title();
	
	// Mutators
	function set_head(string $value = NULL);
	function set_introduction(string $value = NULL);
	function set_title(string $value = NULL);
	
	// Append value to existing intro.
	function append_introduction(string $value = NULL);
}

class Attributes implements iAttributes
{
	// Members
	
	private $head			= NULL;
	private	$introduction	= NULL;
	private $title			= NULL;
	
	// Magic
	
	// As noted above, constructors should be used to prepare
	// a class, and this is usually best done by injecting
	// configuration classes. Just for this example we'll
	// set the members up directly with some defaults.
	public function __construct()
	{
		$this->head = ATTRIBUTE_DEFAULTS::HEAD;		
		$this->introduction = ATTRIBUTE_DEFAULTS::INTRO;
		$this->title = ATTRIBUTE_DEFAULTS::TITLE;
	}
	
	public function __destruct()
	{		
	}	
	
	// Access & Mutate
	
	public function get_head()
	{
		return $this->head;
	}
	
	public function set_head(string $value = NULL)
	{
		$this->head = $value;
	}	
	
	public function get_introduction()
	{
		return $this->introduction;
	}
	
	public function set_introduction(string $value = NULL)
	{
		$this->introduction = $value;
	}
	
	public function get_title()
	{
		return $this->title;
	}
	
	public function set_title(string $value = NULL)
	{
		$this->title = $value;
	}
	
	// Operations
	 
	// Shortcut for adding verbiage to an exisiting intro.
	public function append_introduction(string $value = NULL)
	{
		$this->introduction .= $value.PHP_EOL;
	}	
}

klkl

// Let's initialize the attribute class.
$attributes = new Attributes();

?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $attributes->get_title(); ?></title>
	</head>

	<body>
		
		<?php print $attributes->get_head(); ?>
		<?php print $attributes->get_introduction(); ?>

		<h2>Form</h2>
		<p>Let's try out some basic input.</p>
		
		<form id="form_demographics" action="handle_form.php" method="post">
			
			<fieldset id="fs_demographics_name">
				<legend>Demographics:</legend>

				<fieldset id = "fs_demographics_name">
					<legend>Name:</legend>
					
					First: <input type="text" name="demographics_name_f" id = "text_demographics_name_f" value="First Name" required>
					<br>
					Last: <input type="text" name="demographics_name_l" id = "text_demographics_name_l" value="Last Name" required>
					<br>
				</fieldset>				

				<fieldset id = "fs_demographics_gender">
					<legend>Gender:</legend>
						<label>
							<input type="radio" name="demographics_gender" value="0" id="radio_demographics_gender_0" required>Female
						</label>
						<br>

						<label>
							<input type="radio" name="demographics_gender" value="1" id="radio_demographics_gender_1" required>Male
						</label>
						<br>

						<label>
							<input type="radio" name="demographics_gender" value="2" id="radio_demographics_gender_2" required>Other
						</label>
				</fieldset>
				
				<fieldset id = "fs_demographics_gender">
					<legend>Notes:</legend>
					<textarea id = "textarea_demographics_notes" name="demographics_notes"></textarea>
				</fieldset>
			</fieldset>
		
			<br>
			<input type="submit" value="Submit">
		</form>
		
	</body>
</html>