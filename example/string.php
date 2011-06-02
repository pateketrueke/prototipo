<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../library/prototipo.php';



// replace method
Prototipo::method('replace', function($from, $to)
{
  Prototipo::set(array_map(function($string) use($from, $to)
  {
    return str_replace($from, $to, $string);
  }, Prototipo::get()));
});

// lower method
Prototipo::method('lower', function()
{
  Prototipo::set(array_map('strtolower', Prototipo::get()));
});

// val method
Prototipo::method('val', function($glue = '')
{
  return join($glue, Prototipo::get());
});




function str()
{
  return Prototipo::set(func_get_args());
}


?>

<pre><?php


$var = str('Hello', 'World!');

$var->replace('Hello', 'Yellow');
$var->lower()->replace('yellow', 'bye');

var_dump($var->val(' '));

echo $var;


?></pre>