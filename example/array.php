<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../library/prototipo.php';



// map method
Prototipo::method('map', function($lambda)
{
  foreach ($test = array_shift(Prototipo::get()) as $key => $value)
  {
    $test[$key] = call_user_func($lambda, $value);
  }
  return $test;
});

// each method
Prototipo::method('each', function($lambda)
{
  foreach ($test = array_shift(Prototipo::get()) as $key => $value)
  {
    call_user_func($lambda, $key, $value);
  }
});

// collect method
Prototipo::method('collect', function($lambda)
{
  $output = array();
  foreach ($test = array_shift(Prototipo::get()) as $key => $value)
  {
    if (call_user_func($lambda, $key, $value) === TRUE)
    {
      $output[$key] = $value;
    }
  }
  return $output;
});




// with wrapper
function with()
{
  return Prototipo::set(func_get_args());
}

// iterate shortcode
function iterate($on, $lambda)
{
  Prototipo::set(array($on))->each($lambda);
}

?>

<pre><?php


// iterate over all defined constants and collect only that passes the test
$var = with(get_defined_constants())->collect(function($k, $v)
{
  return strpos($k, 'STR_') !== FALSE;
});

var_dump($var);


// iterate over all the array items
iterate($var, function($k, $v)
{
  echo "$k => $v\n";
});


// simple mapping, identical to array_map('strtolower', array_flip($var))
var_dump(with(array_flip($var))->map(function($v)
{
  return strtolower($v);
}));


?></pre>

