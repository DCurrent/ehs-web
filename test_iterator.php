
<?php
class MyIterator
{
    private $var = array();

    public function __construct($array)
    {
        if (is_array($array)) {
            $this->var = $array;
        }
    }
     
    public function set_valid($value)
    {
        echo '<br />'.$value;		
    }
	
	public function method_list()
	{
		$class_methods = get_class_methods($this);
		
		foreach ($class_methods as $method_name) 	
		{
			if (strpos($method_name,'set_') !== false) {
				echo '<br />'.$method_name;
			}
			
		}
	}
}

$values = array(1,2,3);
$it = new MyIterator($values);

$it->method_list();

//foreach ($it as $a => $b) {
//    print "$a: $b\n";
//}
?>
