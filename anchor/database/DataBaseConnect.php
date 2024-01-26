<?php

namespace app\anchor\database;

class DataBaseConnect {
    private $pdo;

    public function __construct(){
        $this->pdo = $this->connect();
    }

    private function connect() {

    //    $host = $_ENV['DB_HOST'];
    //    $db   = $_ENV['DB_NAME'];
    //    $user = $_ENV['DB_USER'];
    //    $pass = $_ENV['DB_PASS'];
       $host = 'localhost';
       $db   = 'elephant';
       $user = 'root';
       $pass = '';
       $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

        try {
            $pdo = new \PDO($dsn, $user, $pass, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function getPDO() {
        return $this->pdo;
    }
}
