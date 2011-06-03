<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../library/prototipo.php';

class Mix extends Prototipo {}



Mix::method('MoreY', function()
{
  return function()
  {
  };
});


$var = new Prototipo;

$var->foo = 'bar';
$var->candy = function($self)
{
  $self->testA();
  echo "does{$self->foo}\n";
};



Prototipo::method('testA', function($self)
{
  $self->testB('fromA');
});
Prototipo::method('testB', function($self, $str = '')
{
  echo "$str\n";
});





$other = new Mix;

$other->baz = 'buzz';
$other->does = array('nothing');

?>

<pre><?php

echo "$var\n";
echo "$var->foo\n";

var_dump($var->candy);
var_dump($var->foo());

$var->candy();
echo "\n\n";
#var_dump(Prototipo::$_public);
echo "\n\n";
var_dump($other->does());

#$other->testA();

?></pre>
