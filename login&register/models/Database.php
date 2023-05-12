<?php
$userName="{{dbusername}}";
$password="{{dbpassword}}";
$dbName="{{dbname}}";

global $pdo;
try {
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);
    $pdo = new PDO("mysql:host=localhost;dbname=" . $dbName, $userName, $password);
    return $pdo;
}
catch (PDOException $e) {
    echo 'error' . $e->getMessage();
}


class queryFunctions
{
public function selecte(){
    try {

    }
    catch (PDOException $e) {
        echo 'error' . $e->getMessage();
    }
}

}