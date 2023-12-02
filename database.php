<?php

function getDatabase()
{
    $host = '127.0.0.1';
    $dbName = 'php-crud-product';
    $port = 8889;
    $username = 'root';
    $password = 'root';

    return new PDO("mysql:host={$host};dbname={$dbName};port={$port}", $username, $password);
}
