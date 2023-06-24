<?php

require_once 'database/db_connect.php';
require_once 'util/trait/file.php';

class Concert
{
  use File; 
  /**
   * Show concert lists
   * @param  - 
   * @return array $concerts_array
   */
  public function show(){
    $concerts_array = [];
    $pdo = db_connect();
    $sql = "SELECT 
              c.name AS concert_name
              ,c.id
              , date
              , place
              , a.name AS artist_name
            FROM concerts AS c 
            LEFT JOIN artists AS a 
            ON c.artist_id = a.id
            ORDER BY c.id ASC;";
    $concerts = $pdo->query($sql);
    $result = $concerts->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP);
    foreach($result as $key => $concert){
      $artist_names = [];
      $concert_data = [];
      foreach($concert as $artist){
        array_push($artist_names, $artist['artist_name']); 
      }
      $concert_data = [
        'concert_name' => $key,
        'id' => $concert[0]['id'],
        'date' =>  $concert[0]['date'],
        'place' =>  $concert[0]['place'],
        'artist_name' => implode( ",", $artist_names )
      ];
      array_push($concerts_array, $concert_data);
    }
    return $concerts_array;
  }
  /**
   * Get an concert detail
   * @param  array $postData
   * @return array $concerts_array
  */
  public function getConcert($id){
    $concerts_array = [];
    $pdo = db_connect();
    $sql = "SELECT 
              c.name AS concert_name
              ,c.id
              , date
              , place
              , a.id   AS artist_id
              , a.name AS artist_name
            FROM concerts AS c 
            LEFT JOIN artists AS a 
            ON c.artist_id = a.id
            WHERE c.id = $id
            ORDER BY c.id ASC;";
    $concerts = $pdo->query($sql);
    $result = $concerts->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP);
    foreach($result as $key => $concert){
        $concert_data = [];
        $artists_data = [];
        foreach($concert as $artist){
          array_push($artists_data, [
            'id'   =>  $artist['artist_id'],
            'name' =>  $artist['artist_name']
          ]); 
        }
        $concert_data = [
          'concert_name'=> $key,
          'id'          => $concert[0]['id'],
          'date'        => $concert[0]['date'],
          'place'       => $concert[0]['place'],
          'artists'     => $artists_data,
        ];
        array_push($concerts_array, $concert_data);
    }
    return $concerts_array;
  }
  /**
   * Store Concert Data
   * @param  array   $postData
   * @return boolean $result
   */
  public function create($postData){
      $result = false;
      $pdo    = db_connect();
      $sql    = "INSERT INTO concerts(user_id, artist_id, name, date, place) VALUES(:user_id, :artist_id ,:name, :date, :place)";
      $stmt   = $pdo->prepare($sql);
      $user_id    = $postData["user_id"];
      $artist_ids = $postData["artist_id"];
      $name       = $postData["name"];
      $date       = $postData["date"];
      $place      = $postData["place"]; 
      foreach($artist_ids as $artist_id){
        try{
            $pdo->beginTransaction();
            $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
            $stmt->bindValue(":artist_id", $artist_id, PDO::PARAM_STR);
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $stmt->bindValue(":date", $date, PDO::PARAM_STR);
            $stmt->bindValue(":place", $place, PDO::PARAM_STR);
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
  }
  /**
   * Update Concert Data
   * @param  array $postData
   * @return boolean $result
   */
  public function update($postData){
      $result = false;
      $pdo    = db_connect();
      $sql    = "UPDATE concerts SET name = :name, date = :date, place = :place WHERE id = :id";
      $stmt   = $pdo->prepare($sql);
      $id     = $postData["id"];
      $name   = $postData["name"];
      $date   = $postData["date"];
      $place  = $postData["place"];
      try{
        $pdo->beginTransaction();
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":date", $date, PDO::PARAM_STR);
        $stmt->bindValue(":place", $place, PDO::PARAM_STR);
        $stmt->execute();
        $pdo->commit();
        $result = true;
      }catch(PDOException $e){
        $pdo->rollBack();
        error_log($e -> getMessage());
      }finally{
        return $result;
      }
  }
  /**
   * Delete Concert Data
   * @param  array   $postData
   * @return boolean $result
   */
  public function delete($postData){
      $result = false;
      $pdo    = db_connect();
      $sql    = "DELETE FROM concerts WHERE id = :id";
      $stmt   = $pdo->prepare($sql);
      $id     = intval($postData["id"]);
      try{
          $pdo->beginTransaction();
          $stmt = $pdo->prepare($sql);
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
