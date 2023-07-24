<?php
    require_once 'database/db_connect.php';
    try {
        $pdo = db_connect();
        $sql = 'CREATE TABLE if not exists artists(
            id int not null primary key AUTO_INCREMENT
            , user_id int not null
            , name varchar(100) unique
            , debut date
            , start_date date
            , end_date date
            , created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            , updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            , FOREIGN KEY(user_id)   REFERENCES users(id)
          )';
        $pdo->query($sql);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
 ?>

