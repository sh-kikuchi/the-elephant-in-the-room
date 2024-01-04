<?php
    namespace app\database\migrations;
    require_once 'vendor/autoload.php';
    use app\database\DataBaseConnect;

    class PostsTable {
        public function migrate(){
            try {
                $dbConnect = new DataBaseConnect();
                $pdo       = $dbConnect->getPDO();
                $sql = 'CREATE TABLE if not exists posts (
                  id int NOT NULL primary key AUTO_INCREMENT,
                  user_id int NOT NULL,
                  title varchar(100) NOT NULL,
                  body  varchar(255) NOT NULL,
                  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                  FOREIGN KEY(user_id) REFERENCES users(id)
                )';
                $pdo->query($sql);
            } catch (PDOException $e) {
                exit($e->getMessage());
            }
        }
    }

    $postsTable = new PostsTable();
    $postsTable->migrate();

