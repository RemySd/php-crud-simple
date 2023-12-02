<?php

require_once './database.php';

$productId = empty($_GET['id']) ? null : $_GET['id'];

if (empty($productId)) {
    header('Location: ./index.php');
}

$database = getDatabase();

$statement = $database->prepare('DELETE FROM products WHERE id = :productId');
$statement->bindValue(":productId", $productId, PDO::PARAM_INT);
$statement->execute();

header('Location: ./index.php');
