<?php

require_once '../../database/db_connect.php';

class Comment
{
  /**
   * Store Comment
   * @param array $postData
   * @return --
   */
  public function create($postData){
    $pdo = db_connect();
    //フォームから値を受け取る
    $title = $postData["name"];
    $title = $postData["title"];
    $comment = $postData["comment"];

      try{
        $sql = "insert into comments(name,title,comment) values(:name,:title,:comment)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":name", $title, PDO::PARAM_STR);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":comment", $comment, PDO::PARAM_STR);
        $stmt->execute();
        header('Location:../../../../../the_Elephant_in_the_Room/page/crud_tutorial/comment.php');
      }catch(Exception $e){
        echo $e -> getMessage();
      }
  }
  /**
   * Delete Comment
   * @param array $postData
   * @return --
   */
  public function update($postData){
      $pdo = db_connect();

      $id = $postData["id"];
      $title = $postData["title"];
      $comment = $postData["comment"];

      try{
        $sql = "UPDATE comments SET title = :title, comment = :comment WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":comment", $comment, PDO::PARAM_STR);
        $stmt->execute();
        header('Location:../../../../../the_Elephant_in_the_Room/page/crud_tutorial/comment.php');
        exit;
      }catch(PDOException $e){
          echo '更新に失敗しました。', $e->getmessage();
          exit();
      }
  }
  /**
   * Delete Comment
   * @param array $postData
   * @return --
   */
  public function delete($postData){
      $pdo = db_connect();
      $id = intval($postData["id"]);
      try{
        $sql = "DELETE FROM comments WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        header('Location:../../../../../the_Elephant_in_the_Room/page/crud_tutorial/comment.php');
        exit;
      }catch(Exception $e){
        echo $e->getMessage();
      }
  }





}
