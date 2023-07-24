<?php
require_once 'database/db_connect.php';

// $table_name = 'artists';
// $table_cols = 'user_id, name, debut, start_date, end_date, created_at,updated_at';

// $table_name = 'concerts';
// $table_cols = 'user_id,name,date,place,created_at,updated_at';

$table_name = 'artist_concert';
$table_cols = 'artist_id,concert_id,created_at,updated_at';

$pdo = db_connect();
$f = fopen("../database/csv/uploads/" . $table_name . ".csv", "r");
$data = fgetcsv($f);

while($data = fgetcsv($f)){
    $col_arr = [];
    if(implode($data) != null){
        array_shift($data); //Erase the ID in the first column.
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