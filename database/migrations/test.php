 <?php
    require_once ('database\db_connect.php');
    try {
        $pdo = db_connect();
        // usersテーブルを作成するためのSQL文を変数$sqlに代入する
        $sql = 'CREATE TABLE IF NOT EXISTS tests (
            id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(60) NOT NULL,
            furigana VARCHAR(60) NOT NULL,
            email VARCHAR(255) NOT NULL,                    
            age INT(11),
            address VARCHAR(255)                    
        )';
        // SQL文を実行する
        $pdo->query($sql);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
 ?>