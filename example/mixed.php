<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../library/prototipo.php';


$var = Prototipo::instance();

$var->foo = 'bar';
$var->candy = function() { echo "does\n"; };


?>

<pre><?php

echo "$var\n";
echo "$var->foo\n";


var_dump($var->candy);
var_dump($var->foo());

$var->candy();

?></pre>
