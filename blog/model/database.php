<?php


$userName="root";
$password="";
$dbName="blog";

global $pdo;
try {
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ);
    $pdo = new PDO("mysql:host=localhost;dbname=" . $dbName, $userName, $password);
    return $pdo;
}
catch (PDOException $e) {
    echo 'error' . $e->getMessage();
}

function selectFromTable(PDO $pdo, string $tableName, array $columns = ['*'], array $conditions = [])
{
    $columnList = implode(',', $columns);
    $conditionList = '';
    $params = [];
    foreach ($conditions as $column => $value) {
        $conditionList .= $column . '=:' . $column . ' AND ';
        $params[':' . $column] = $value;
    }
    $conditionList = rtrim($conditionList, ' AND ');

    $query = "SELECT $columnList FROM $tableName";
    if (!empty($conditions)) {
        $query .= " WHERE $conditionList";
    }

    $statement = $pdo->prepare($query);
    $statement->execute($params);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function insertIntoTable(PDO $pdo, string $tableName, array $data)
{
    $columns = implode(',', array_keys($data));
    $placeholders = ':' . implode(',:', array_keys($data));
    $values = array_values($data);

    $query = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";
    $statement = $pdo->prepare($query);

    foreach ($data as $column => $value) {
        $statement->bindValue(':' . $column, $value);
    }

    if ($statement->execute()) {
        return $pdo->lastInsertId();
    } else {
        return false;
    }
}

function updateTable(PDO $pdo, string $tableName, array $data, array $conditions = [])
{
    $columnValueList = '';
    $params = [];

    foreach ($data as $column => $value) {
        $columnValueList .= $column . '=:' . $column . ', ';
        $params[':' . $column] = $value;
    }
    $columnValueList = rtrim($columnValueList, ', ');

    $conditionList = '';
    foreach ($conditions as $column => $value) {
        $conditionList .= $column . '=:' . $column . ' AND ';
        $params[':' . $column] = $value;
    }
    $conditionList = rtrim($conditionList, ' AND ');

    $query = "UPDATE $tableName SET $columnValueList";
    if (!empty($conditions)) {
        $query .= " WHERE $conditionList";
    }

    $statement = $pdo->prepare($query);
    $statement->execute($params);
    return $statement->rowCount();
}

function deleteFromTable(PDO $pdo, string $tableName, array $conditions = [])
{
    $conditionList = '';
    $params = [];

    foreach ($conditions as $column => $value) {
        $conditionList .= $column . '=:' . $column . ' AND ';
        $params[':' . $column] = $value;
    }
    $conditionList = rtrim($conditionList, ' AND ');

    $query = "DELETE FROM $tableName";
    if (!empty($conditions)) {
        $query .= " WHERE $conditionList";
    }

    $statement = $pdo->prepare($query);
    $statement->execute($params);
    return $statement->rowCount();
}
