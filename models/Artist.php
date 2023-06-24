<?php

require_once ('database\db_connect.php');

class Artist
{
  /**
   * show artists
   * @param array $postData
   * @return $artists
   */
  public function show(){
    $pdo = db_connect();
    $sql = "SELECT * FROM artists ORDER BY id ASC;";
    $artists = $pdo->query($sql);
    return $artists->fetchAll();
  }
  /**
   * get an artist
   * @param array $postData
   * @return $artists
  */
  public function getArtist($id){
    $pdo = db_connect();
    $sql = "SELECT * FROM artists WHERE id = $id;";
    $artist_count = $pdo->query($sql);
    return $artist_count;
  }
  /**
   * Store Artist
   * @param array $postData
   * @return --
   */
  public function create($postData){
      $result = false;
      $pdo    = db_connect();
      $sql    = "INSERT INTO artists(user_id, name, debut, start_date, end_date) VALUES(:user_id, :name, :debut, :start_date, :end_date)";
      $stmt   = $pdo->prepare($sql);

      $user_id    = $postData["user_id"];
      $name       = $postData["name"];
      $debut      = $postData["debut"];
      $start_date = $postData["start_date"];
      $end_date   = $postData["end_date"];

      try{
          $pdo->beginTransaction();
          $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
          $stmt->bindValue(":name", $name, PDO::PARAM_STR);
          $stmt->bindValue(":debut", $debut, PDO::PARAM_STR);
          $stmt->bindValue(":start_date", $start_date, PDO::PARAM_STR);
          $stmt->bindValue(":end_date", $end_date, PDO::PARAM_STR);
          $stmt->execute();
          $pdo->commit();
          $result = true;
      }catch(Exception $e){
          $pdo->rollBack();
          error_log($e -> getMessage());
      }finally{
          return $result;
      }
  }
  /**
   * Delete Artist
   * @param array $postData
   * @return --
   */
  public function update($postData){
      $result = false;
      $pdo = db_connect();
      $sql = "UPDATE artists SET name = :name ,debut = :debut ,start_date = :start_date ,end_date = :end_date WHERE id = :id";
      $stmt = $pdo->prepare($sql);

      $id         = $postData["id"];
      $name       = $postData["name"];
      $debut      = $postData["debut"];
      $start_date = $postData["start_date"];
      $end_date   = $postData["end_date"];

      try{
          $pdo->beginTransaction();
          $stmt->bindValue(":id", $id, PDO::PARAM_INT);
          $stmt->bindValue(":name", $name, PDO::PARAM_STR);
          $stmt->bindValue(":debut", $debut, PDO::PARAM_STR);
          $stmt->bindValue(":start_date", $start_date, PDO::PARAM_STR);
          $stmt->bindValue(":end_date", $end_date, PDO::PARAM_STR);
          $stmt->execute();
          $pdo->commit();
          $result = true;
      }catch(PDOException $e){
          $pdo->rollBack();
          error_log($e->getmessage());
      }finally{
          return $result;
      }
  }
  /**
   * Delete Artist
   * @param array $postData
   * @return $result
   */
  public function delete($postData){
      $result = false;
      $pdo = db_connect();
      $sql = "DELETE FROM artists WHERE id = :id";
      $stmt = $pdo->prepare($sql);
      $id = intval($postData["id"]);
      try{
          $pdo->beginTransaction();
          $stmt->bindValue(":id", $id, PDO::PARAM_INT);
          $stmt->execute();
          $pdo->commit();
          $result = true;
      }catch(Exception $e){
          $pdo->rollBack();
          error_log($e->getmessage());
      }finally{
          return $result;
      }
  }
}
