<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../library/prototipo.php';

class RegExp extends Prototipo {}



RegExp::method('exec', function($self, $subject)
{
  return preg_match(array_shift($self->get()), $subject);
});


RegExp::method('matches', function($self, $subject)
{
  preg_match_all(array_shift($self->get()), $subject, $output);
  return $output;
});


RegExp::method('replace', function($self, $subject, $with)
{
  return preg_replace(array_shift($self->get()), $with, $subject);
});


function RegExp($value)
{
  return new RegExp(func_get_args());
}


?>

<pre><?php


var_dump(RegExp('/b/')->exec('abc'));
var_dump(RegExp('/^B/')->exec('bar'));
var_dump(RegExp('/\w/')->matches('buzz'));
var_dump(RegExp('/a/i')->replace('A@A', '#'));


?></pre>
