<?php
    require_once ('database\db_connect.php');
    try {
        $pdo = db_connect();
        // usersテーブルを作成するためのSQL文を変数$sqlに代入する
        $sql = 'CREATE TABLE if not exists users (
          id  int(11) NOT NULL,
          name varchar(255) NOT NULL,
          email varchar(20) NOT NULL,
          password  varchar(255) NOT NULL
        )';
        // SQL文を実行する
        $pdo->query($sql);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
 ?>

