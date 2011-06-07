<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../library/prototipo.php';

class Arr extends Prototipo {}



Arr::method('map', function($self, $lambda)
{
  foreach ($test = array_shift($self->get()) as $key => $value)
  {
    $test[$key] = call_user_func($lambda, $value);
  }
  return $test;
});


Arr::method('each', function($self, $lambda)
{
  foreach ($test = array_shift($self->get()) as $key => $value)
  {
    call_user_func($lambda, $key, $value);
  }
});


Arr::method('collect', function($self, $lambda)
{
  $output = array();
  foreach ($test = array_shift($self->get()) as $key => $value)
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
  $obj = new Arr;
  return $obj->set(func_get_args());
}

// iterate shortcode
function iterate($on, $lambda)
{
  with($on)->each($lambda);
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

