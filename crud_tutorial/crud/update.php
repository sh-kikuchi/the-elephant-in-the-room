<?php
  require_once("../../database/db_connect.php");
  $pdo = db_connect();

  $id = $_POST["id"];
  $title = $_POST["title"];
  $comment = $_POST["comment"];

  try{
    $sql = "UPDATE comments SET title = :title, comment = :comment WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->bindValue(":title", $title, PDO::PARAM_STR);
    $stmt->bindValue(":comment", $comment, PDO::PARAM_STR);
    $stmt->execute();
    header('Location:../comment.php');
    exit;
  }catch(PDOException $e){
      echo '更新に失敗しました。', $e->getmessage();
      exit();
  }
?>
