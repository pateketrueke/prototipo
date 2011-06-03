<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../library/prototipo.php';

class Str extends Prototipo {}

Str::method('replace', function($self, $from, $to)
{
  $self->set(array_map(function($string) use($from, $to)
  {
    return str_replace($from, $to, $string);
  }, $self->get()));
});

Str::method('lower', function($self)
{
  $self->set(array_map('strtolower', $self->get()));
});

Str::method('val', function($self, $glue = '')
{
  return join($glue, $self->get());
});


function Str()
{
  return new Str(func_get_args());
}


?>

<pre><?php


$var = Str('Hello', 'World!');

$var->replace('Hello', 'Yellow');
$var->lower()->replace('yellow', 'bye');

var_dump($var->val(' '));

echo $var;


?></pre>
