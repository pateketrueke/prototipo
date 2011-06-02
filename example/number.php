<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../library/prototipo.php';



// times method
Prototipo::method('times', function($lambda)
{
  $length = array_shift(Prototipo::get());
  for ($i = 0; $i < $length; $i += 1)
  {
    call_user_func($lambda);
  }
});

// hours method
Prototipo::method('hours', function()
{
  return array_shift(Prototipo::get()) * 3600;
});

// days method
Prototipo::method('days', function()
{
  return array_shift(Prototipo::get()) * 3600 * 24;
});



function in($value)
{
  return Prototipo::set(func_get_args());
}


?>

<pre><?php


in(4)->times(function()
{
  echo "A\n";
});

var_dump(in(3)->hours());
var_dump(in(14)->days());


?></pre>