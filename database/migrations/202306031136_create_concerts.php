<?php
    require_once ('database\db_connect.php');
    try {
        $pdo = db_connect();
        // usersテーブルを作成するためのSQL文を変数$sqlに代入する
        $sql = 'CREATE TABLE if not exists concerts(
              id int not null primary key AUTO_INCREMENT
            , user_id int not null
            , artist_id int not null
            , name varchar(100)
            , date date
            , place varchar(100)
            , created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            , updated_at DATETIME  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            , FOREIGN KEY(user_id)   REFERENCES users(id)
            , FOREIGN KEY(artist_id) REFERENCES artists(id)
          )';
        // SQL文を実行する
        $pdo->query($sql);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
 ?>

