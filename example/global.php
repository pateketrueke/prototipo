<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../library/prototipo.php';

class Other extends Prototipo {
  public function __toString()
  {
    return sprintf('%s::%s();', __CLASS__, __FUNCTION__);
  }
}



// only parent can assign methods to be used through any descendant class
Prototipo::method('to_s', function($self)
{
  if (method_exists($self, '__toString')) return (string) $self;
  return print_r($self, true);
});

Prototipo::method('to_json', function($self)
{
  return json_encode($self->get());
});



?>

<pre><?php


// the magic here is more like as in Ruby... FTW!
$var = new Other('something', 'cool', 'dude');


echo $var->to_s();
echo "\n";
echo $var->to_json();

?></pre>