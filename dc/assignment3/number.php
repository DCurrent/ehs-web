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

// Calculation examples. We'll use the results in a table.
// Even when OOP isn't necessary, it's still good practice to
// encapsulate variables into a class. If nothing else, just 
// to limit the scope of your variables and keep them organized.
abstract class CALCULATION_DEFAULTS
{
	const VALUE_A = 20;
	const VALUE_B = 11;
}

interface iCalculation_Samples
{	
	// Accessors
	function get_value_a();
	function get_value_b();
	
	// Mutators
	function set_value_a(int $value);
	function set_value_b(int $value);
		
	// Calculations.
	function difference();
	function exponent();
	function modulo();
	function product();
	function quotient();
	function sum();
}


class Calculation_Samples implements iCalculation_Samples
{
	private $value_a;
	private $value_b;
	
	// Magic
	public function __construct()
	{
		$this->value_a = CALCULATION_DEFAULTS::VALUE_A;		
		$this->value_b = CALCULATION_DEFAULTS::VALUE_B;		
	}
	
	// Access & Mutate
	
	public function get_value_a()
	{
		return $this->value_a;
	}
	
	public function set_value_a(int $value)
	{
		$this->value_a = $value;
	}
	
	public function get_value_b()
	{
		return $this->value_b;
	}
	
	public function set_value_b(int $value)
	{
		$this->value_b = $value;
	}
	
	//
	public function difference()
	{
		return $this->value_a - $this->value_b;
	}
	
	public function exponent()
	{
		// Just in cae you are using PHP <5.6. 
		//return exp($this->value_a * log($this->value_b));
		
		return $this->value_a ** $this->value_b;
	}
	
	public function modulo()
	{
		$result = 0;
		
		// Only divide if both values are non-zero.
		if($this->value_a && $this->value_b)
		{
			$result = $this->value_a % $this->value_b;
		}
		
		return $result;
	}
	
	public function product()
	{
		return $this->value_a * $this->value_b;
	}
	
	public function quotient()
	{
		$result = 0;
		
		// Only divide if both values are non-zero.
		if($this->value_a && $this->value_b)
		{
			$result = $this->value_a / $this->value_b;
		}
		
		return $result;
	}
	
	public function sum()
	{
		return $this->value_a + $this->value_b;
	}
}

// Let's initialize the attribute class.
$attributes = new Attributes();

// Initialize calculation samples.
$calculation_samples = new Calculation_Samples();
$test = $calculation_samples->sum();
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

		<h2>Calculations</h2>
		<p>One boon of programing is only needing to solve a formula once - after that, make the computer do it!</p>

		<table>
			<caption>Calculation Examples</caption>
		  	<thead>
				<tr>
			  		<th>Operation</th>
			  		<th>Example</th>
				</tr>
		 	</thead>
		  	<tfoot>
				<tr>
			  		<th>Operation</th>
			  		<th>Example</th>
				</tr>
		  	</tfoot>
		  	<tbody>
				<tr>
					<td>Addition</td>
					<td>$sum(<?php echo $calculation_samples->sum(); ?>) = $addend_a(<?php echo $calculation_samples->get_value_a(); ?>) + $addend_b(<?php echo $calculation_samples->get_value_b(); ?>);</td>
				</tr>
				<tr>
					<td>Subtraction</td>
					<td>$difference(<?php echo $calculation_samples->difference(); ?>) = $minuend(<?php echo $calculation_samples->get_value_a(); ?>) - $subtrahend(<?php echo $calculation_samples->get_value_b(); ?>);</td>
				</tr>
				<tr>
					<td>Multiplication</td>
					<td>$product(<?php echo $calculation_samples->product(); ?>) = $factor_a(<?php echo $calculation_samples->get_value_a(); ?>) * $factor_b(<?php echo $calculation_samples->get_value_b(); ?>);</td>
				</tr>
				<tr>
					<td>Division</td>
					<td>$quotient(<?php echo $calculation_samples->quotient(); ?>) = $dividend(<?php echo $calculation_samples->get_value_a(); ?>) / $divisor(<?php echo $calculation_samples->get_value_b(); ?>);</td>
				</tr>
				<tr>
					<td>Modulo</td>
					<td>$modulo(<?php echo $calculation_samples->modulo(); ?>) = $dividend(<?php echo $calculation_samples->get_value_a(); ?>) % $divisor(<?php echo $calculation_samples->get_value_b(); ?>);</td>
				</tr>
				<tr>
					<td>Exponentiation</td>
					<td>$exponent(<?php echo $calculation_samples->exponent(); ?>) = $base(<?php echo $calculation_samples->get_value_a(); ?>) ** $power(<?php echo $calculation_samples->get_value_b(); ?>);</td>
				</tr>
			</tbody>
		</table>

	</body>
</html>