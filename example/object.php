<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../library/prototipo.php';



// factory instance
$var = Prototipo::instance();


// extend method
$var->extend = function($prototype) use($var)
{
  foreach ($prototype as $name => $lambda)
  {
    $var->$name = $lambda;
  }
};



// various methods
$var->extend(array(
  'begin' => function() use($var)
  {
    $var->say('This begins...');
  },
  'say' => function($str)
  {
    echo "$str\n";
  },
  'end' => function() use($var)
  {
    $var->say('...then ends.');
  },
));

?>

<pre><?php


$var->begin()
    ->say('hi!')
    ->end();

var_dump($var);
var_dump(Prototipo::instance());


?></pre>