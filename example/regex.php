<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../library/prototipo.php';



// exec method
Prototipo::method('exec', function($subject)
{
  return preg_match(array_shift(Prototipo::get()), $subject);
});

// match method
Prototipo::method('matches', function($subject)
{
  preg_match_all(array_shift(Prototipo::get()), $subject, $output);
  return $output;
});

// replace method
Prototipo::method('replace', function($subject, $with)
{
  return preg_replace(array_shift(Prototipo::get()), $with, $subject);
});


function Ä($value)
{
  return Prototipo::set(func_get_args());
}


?>

<pre><?php


var_dump(Ä('/b/')->exec('abc'));
var_dump(Ä('/^B/')->exec('bar'));
var_dump(Ä('/\w/')->matches('buzz'));
var_dump(Ä('/a/i')->replace('A@A', '#'));


?></pre>