<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../library/prototipo.php';

class Obj extends Prototipo {}



$var = new Obj;

$var->extend = function($self, $prototype)
{
  foreach ($prototype as $name => $lambda)
  {
    $self->$name = $lambda;
  }
};



// various methods
$var->extend(array(
  'begin' => function($self)
  {
    $self->say('This begins...');
  },
  'say' => function($self, $str)
  {
    echo "$str\n";
  },
  'end' => function($self)
  {
    $self->say('...then ends.');
  },
));

?>

<pre><?php


$var->begin()
    ->say('hi!')
    ->end();

var_dump($var);


?></pre>
