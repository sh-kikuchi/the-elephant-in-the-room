<?php

namespace app\database;

class DataBaseConnect {
    private $pdo;

    public function __construct(){
        $this->pdo = $this->connect();
    }

    private function connect() {
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
