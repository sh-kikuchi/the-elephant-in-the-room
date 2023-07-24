<?php
    require_once 'database/db_connect.php';
    try {
        $pdo = db_connect();
        $sql = 'CREATE TABLE if not exists artist_concert(
              id int not null primary key AUTO_INCREMENT
            , artist_id int not null
            , concert_id int not null
            , created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            , updated_at DATETIME  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            , FOREIGN KEY(concert_id) REFERENCES concerts(id)
            , FOREIGN KEY(artist_id)  REFERENCES artists(id)
          )';
        $pdo->query($sql);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
 ?>

