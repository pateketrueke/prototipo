<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../library/prototipo.php';

class Num extends Prototipo {}



Num::method('times', function($self, $lambda)
{
  $length = array_shift($self->get());
  for ($i = 0; $i < $length; $i += 1)
  {
    call_user_func($lambda);
  }
});


Num::method('hours', function($self)
{
  return array_shift($self->get()) * 3600;
});


Num::method('days', function($self)
{
  return array_shift($self->get()) * 3600 * 24;
});



function Num($value)
{
  return new Num(func_get_args());
}


?>

<pre><?php


Num(4)->times(function()
{
  echo "A\n";
});

var_dump(Num(3)->hours());
var_dump(Num(14)->days());


?></pre>
