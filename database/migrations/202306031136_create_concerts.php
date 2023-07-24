<?php
    require_once 'database/db_connect.php';
    try {
        $pdo = db_connect();
        $sql = 'CREATE TABLE if not exists concerts(
              id int not null primary key AUTO_INCREMENT
            , user_id int not null
            , name varchar(100)
            , date date
            , place varchar(100)
            , created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            , updated_at DATETIME  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            , FOREIGN KEY(user_id)   REFERENCES users(id)
            , FOREIGN KEY(artist_id) REFERENCES artists(id)
          )';
        $pdo->query($sql);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
 ?>

