<?php
require_once ('database\db_connect.php');

$table_name = 'artists';
$table_cols = 'user_id, name, debut, start_date, end_date, created_at,updated_at';

$pdo = db_connect();
$f = fopen("../database/csv/downloads/" . $table_name . ".csv", "r");
$data = fgetcsv($f);

while($data = fgetcsv($f)){
    $col_arr = [];
    if(implode($data) != null){
        // 読み込んだ結果を表示します。
        array_shift($data); //remove id
        foreach($data as $col){
          array_push($col_arr, "'".$col."'");   
        }
        $col_str = implode(',', $col_arr);
        $sql = 'INSERT INTO '.$table_name.' (' . $table_cols . ') VALUES('. $col_str . ');';
        $sql = $pdo->prepare($sql);
        $sql ->execute();
    }
}
fclose($f);
?>