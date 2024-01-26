<?php
    namespace app\database\migrations;
    require_once 'vendor/autoload.php';
    use app\anchor\database\DataBaseConnect;

    class UsersTable {
        public function migrate(){
            try {
                $dbConnect = new DataBaseConnect();
                $pdo       = $dbConnect->getPDO();
                $sql = 'CREATE TABLE if not exists users (
                  id  int(11) NOT NULL,
                  name varchar(255) NOT NULL,
                  email varchar(20) NOT NULL,
                  password  varchar(255) NOT NULL
                )';
                $pdo->query($sql);
            } catch (PDOException $e) {
                exit($e->getMessage());
            }
        }
    }

    $postsTable = new UsersTable();
    $postsTable->migrate();

