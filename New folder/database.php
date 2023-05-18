<?php
global $pdo;
try
{
    $options = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ );
    $pdo     = new PDO( "mysql:host=localhost;dbname=session", 'root', '' );
    return $pdo;
}
catch ( PDOException $e )
{
    echo 'error' . $e->getMessage();
}
function insert(){

}
function select(){

}
function update(){

}
function delete(){

}