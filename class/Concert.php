<?php

require_once '../../database/db_connect.php';

class Concert
{
  /**
   * show artists
   * @param array $postData
   * @return $artists
   */
  public function show(){
    $pdo = db_connect();
    $sql = "SELECT 
              c.id, c.name AS concert_name, date, place, a.name AS artist_name
            FROM concerts AS c 
            LEFT JOIN artists AS a 
            ON c.artist_id = a.id
            ORDER BY c.id ASC;";
    $concerts = $pdo->query($sql);

    return $concerts->fetchAll();
  }
  /**
   * get an artist
   * @param array $postData
   * @return $artists
  */
  public function getConcert($id){
    $pdo = db_connect();
    $sql = "SELECT * FROM concerts WHERE id = $id;";
    $concert = $pdo->query($sql);
    return $concert;
  }
  /**
   * Store Concert
   * @param array $postData
   * @return --
   */
  public function create($postData){
      $pdo = db_connect();

      $user_id    = $postData["user_id"];
      $artist_ids = $postData["artist_id"];
      $name       = $postData["name"];
      $date       = $postData["date"];
      $place      = $postData["place"]; 

      foreach($artist_ids as $artist_id){
        try{
            $sql = "insert into concerts(user_id, artist_id, name, date, place) 
            values(:user_id, :artist_id ,:name, :date, :place)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
            $stmt->bindValue(":artist_id", $artist_id, PDO::PARAM_STR);
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $stmt->bindValue(":date", $date, PDO::PARAM_STR);
            $stmt->bindValue(":place", $place, PDO::PARAM_STR);
            $stmt->execute();
            header('Location:../../../../../the-elephant-in-the-room/page/crud_tutorial/comment.php');
        }catch(Exception $e){
            echo $e -> getMessage();
        }
      }
  }
  /**
   * Delete Concert
   * @param array $postData
   * @return --
   */
  public function update($postData){
      $pdo = db_connect();

      $id    = $postData["id"];
      $name  = $postData["name"];
      $date  = $postData["date"];
      $place = $postData["place"];

      try{
        $sql = "UPDATE concerts SET name = :name, date = :date, place = :place WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":date", $date, PDO::PARAM_STR);
        $stmt->bindValue(":place", $place, PDO::PARAM_STR);
        $stmt->execute();
        //header('Location:../../../../../the-elephant-in-the-room/page/crud_tutorial/comment.php');
        exit;
      }catch(PDOException $e){
          echo '更新に失敗しました。', $e->getmessage();
          exit();
      }
  }
  /**
   * Delete Concert
   * @param array $postData
   * @return --
   */
  public function delete($postData){
      $pdo = db_connect();
      $id = intval($postData["id"]);
      try{
        $sql = "DELETE FROM concerts WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        header('Location:../../../../../the-elephant-in-the-room/page/crud_tutorial/comment.php');
        exit;
      }catch(Exception $e){
        echo $e->getMessage();
      }
  }
}
