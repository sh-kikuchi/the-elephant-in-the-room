<?php
  require_once 'database/db_connect.php';
    try{
        $table_name = 'users';
        $filepath = 'csv/downloads/'. $table_name .'.csv';
        $fp = fopen($filepath, 'w');
        $pdo = db_connect();
        $sql = 'SELECT * FROM '. $table_name;
        $sql = $pdo->prepare($sql);
        $sql ->execute();
        foreach ($sql as $key => $row) {
            $output = '';
            $row_tmp = '"';
            $row_tmp .= implode('","', $row);
            $row_tmp .= '"' . "\n";
            $output .= $row_tmp;
            fwrite($fp, $output);
        }
        fclose($fp);
        exit;
    }catch (PDOException $e) {
      print "[ERROR] {{$e->getMessage()}}\n";
      die();
    }
?>