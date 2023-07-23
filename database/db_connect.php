<?php
define('DB_HOST', "localhost");
define('DB_NAME', "elephant");
define('DB_USER', "root");
define('DB_PASS', ""); 

function db_connect()
{
    $host = DB_HOST;
    $db   = DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;

    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    } catch (PDOExeption $e) {
        echo $e->getMessage();
        exit();
    }
}
