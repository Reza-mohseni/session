<?php
/*$cars=array("x22",'x33','lx10','xl60');
$name=array('reza','ali','hamide','reyhane','alireza');
var_dump($cars);
var_dump($name);*/


$str = 'one|two|three|four';

// positive limit
print_r(explode('|', $str, 3));
echo '<br>';
// negative limit
print_r(explode('|', $str, -5));