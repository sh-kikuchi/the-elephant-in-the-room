<?php
  require_once("./db_connect.php");

  $id = intval($_GET["id"]); /*POST,GET送信で送られてきた値は文字列型となってしまうため・intval */

  try{
    //$sql = "delete from users where id = '$id'";
    //$stmt = $pdo->query($sql);

    $sql = "DELETE FROM users WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);

    $stmt->execute();

    header("Location: list.php");
    exit;

  }catch(Exception $e){
    echo $e->getMessage();
  }
?>
