<?php
  require_once("../../database/db_connect.php");
  $pdo = db_connect();

  $id = intval($_POST["id"]);

  try{
    $sql = "DELETE FROM comments WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    header('Location:../comment.php');
    exit;
  }catch(Exception $e){
    echo $e->getMessage();
  }
?>
