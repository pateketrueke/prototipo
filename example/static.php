<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../library/prototipo.php';

class State extends Prototipo {
  public static $_config = array();
}




// a simple static object can be extended by adding several methods
// but these cannot use $self instance by it self, dumb...
State::method('configure', function($key, $value)
{
  State::$_config[$key] = $value;
});

State::method('option', function($item, $default = FALSE)
{
  return isset(State::$_config[$item]) ? State::$_config[$item] : $default;
});


?>

<pre><?php


// no more sub-classing to do some magic!
State::configure('foo', 'bar');
State::configure('candy', array('does' => 'nothing'));


var_dump(State::option('foo'));
var_dump(State::option('baz', 'buzz'));
var_dump(State::option('candy'));

?></pre>