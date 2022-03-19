<?php
/* デバック用
    var_dump($sql);
    echo "<br>";
    print_r($sql);
*/

  require_once("./db_update.php");

  $id = $_POST["id"];
  $name = $_POST["name"];
  $mail = $_POST["mail"];

  try{
    $sql = "UPDATE users SET name = :name, mail = :mail WHERE id = :id";

    var_dump($id);
    echo "<br>";
    print_r($id);

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->bindValue(":name", $name, PDO::PARAM_STR);
    $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);

    $stmt->execute();

    header("Location: list.php");
    exit;

  }catch(Exception $e){
    echo $e->getMessage();
  }

?>
