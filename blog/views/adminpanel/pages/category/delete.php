<?php
require_once '../../../../controllers/helpers/helpers.php';
require_once '../../../../model/database.php';

if (isset($_GET['cat_id'])&&$_GET['cat_id']!==""){

    global $pdo;
    $tableName = "categories";
    $conditions = [
        "id" => $_GET['cat_id'],
    ];

  deleteFromTable($pdo, $tableName, $conditions);
}
redirect('views/adminpanel/pages/category');

?>