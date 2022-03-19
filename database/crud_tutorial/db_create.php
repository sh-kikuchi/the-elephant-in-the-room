
<?php

/* デバック用
    var_dump($sql);
    echo "<br>";
    print_r($sql);
*/

require_once("./db_connect.php");

//「create_form.html」からのフォームの値を受け取るために用意
$name = $_POST["name"];
$mail = $_POST["mail"];

try{
  //$sql = "insert into users(name,mail) values('".$name."','".$mail."')";
  //$stmt = $pdo->query($sql);

  $sql = "insert into users(name,mail) values(:name,:mail)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindValue(":name", $name, PDO::PARAM_STR);
  $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);

$stmt->execute();
  //このファイルはブラウザでは表示されないもの。
  //PDOでのやり取りが終わった最後にheader関数を使って、「list.php」に戻る.
  header("Location: list.php");

}catch(Exception $e){
  echo $e -> getMessage();
}
?>
