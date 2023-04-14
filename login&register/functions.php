<?php
//config
define('BASE_URL','http://localhost/programmer/session/login&register/');

function redirect($url){
    header('Location'.trim(BASE_URL, '/ '). '/'. trim($url,'/ '));
    exit;
}
function url($url)
{
    return trim(BASE_URL,'/ '). '/' . trim($url,'/ ');

}
 function dd($var){
    echo '<pree>';
    var_dump($var);
    exit;
 }

function nationalcode($nationalcode)
{

    $cDigitLast = substr($nationalcode , strlen($nationalcode)-1);
    $fnationalcode = strval(intval($nationalcode));

    if((str_split($fnationalcode))[0] == "0" && !(8 <= strlen($fnationalcode)  && strlen($fnationalcode) < 10)) return false;

    $nineLeftDigits = substr($nationalcode , 0 , strlen($nationalcode) - 1);

    $positionNumber = 10;
    $result = 0;

    foreach(str_split($nineLeftDigits) as $chr){
        $digit = intval($chr);
        $result += $digit * $positionNumber;
        $positionNumber--;
    }

    $remain = $result % 11;

    $controllerNumber = $remain;

    if(2 < $remain){
        $controllerNumber = 11-$remain;
    }

    return $cDigitLast == $controllerNumber;

}

