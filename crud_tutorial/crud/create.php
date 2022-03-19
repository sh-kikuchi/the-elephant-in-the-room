<?php
//require_onceでDB接続ファイルの呼び出し
require_once("../../database/db_connect.php");
$pdo = db_connect();

//フォームから値を受け取る
$title = $_POST["name"];
$title = $_POST["title"];
$comment = $_POST["comment"];

try{
  $sql = "insert into comments(name,title,comment) values(:name,:title,:comment)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":name", $title, PDO::PARAM_STR);
  $stmt->bindValue(":title", $title, PDO::PARAM_STR);
  $stmt->bindValue(":comment", $comment, PDO::PARAM_STR);
  $stmt->execute();
  header('Location:../comment.php');
}catch(Exception $e){
  echo $e -> getMessage();
}
?>
