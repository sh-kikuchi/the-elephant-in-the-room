<?php

require_once '../../database/db_connect.php';

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
      $pdo = db_connect();

      $user_id    = $postData["user_id"];
      $name       = $postData["name"];
      $debut      = $postData["debut"];
      $start_date = $postData["start_date"];
      $end_date   = $postData["end_date"];

      try{
        $sql = "insert into artists(user_id, name, debut, start_date, end_date) 
        values(:user_id, :name, :debut, :start_date, :end_date)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":debut", $debut, PDO::PARAM_STR);
        $stmt->bindValue(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindValue(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->execute();
        header('Location:../../../../../the-elephant-in-the-room/page/artist');
      }catch(Exception $e){
        echo $e -> getMessage();
      }
  }
  /**
   * Delete Artist
   * @param array $postData
   * @return --
   */
  public function update($postData){
      $pdo = db_connect();

      $id         = $postData["id"];
      $name       = $postData["name"];
      $debut      = $postData["debut"];
      $start_date = $postData["start_date"];
      $end_date   = $postData["end_date"];

      try{
        $sql = "UPDATE artists SET name = :name, debut = :debut, start_date = :start_date, end_date = :end_date WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":debut", $debut, PDO::PARAM_STR);
        $stmt->bindValue(":start_date", $start_date, PDO::PARAM_STR);
        $stmt->bindValue(":end_date", $end_date, PDO::PARAM_STR);
        $stmt->execute();
        header('Location:../../../../../the-elephant-in-the-room/page/artist');
        exit;
      }catch(PDOException $e){
          echo '更新に失敗しました。', $e->getmessage();
          exit();
      }
  }
  /**
   * Delete Artist
   * @param array $postData
   * @return --
   */
  public function delete($postData){
      $pdo = db_connect();
      $id = intval($postData["id"]);
      try{
        $sql = "DELETE FROM artists WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        header('Location:../../../../../the-elephant-in-the-room/page/artist');
        exit;
      }catch(Exception $e){
        echo $e->getMessage();
      }
  }
}
