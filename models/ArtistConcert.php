<?php
require_once 'database/db_connect.php';
require_once 'util/trait/file.php';

class ArtistConcert
{
    /**
     * Show ArtistConcert lists
     * @param  - 
     * @return array $concerts_array
     */
    public function show():array{
      $concerts_array = [];
      $pdo = db_connect();
      $sql = "SELECT 
          c.name AS concert_name
          ,c.id  AS concert_id
          ,date
          ,place
          ,a.name AS artist_name
          FROM artist_concert as ac
          JOIN artists as a
          ON a.id = ac.artist_id 
          JOIN concerts as c
          ON c.id = ac.concert_id
          ORDER BY c.date desc";
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
            'concert_id' => $concert[0]['concert_id'],
            'date' =>  $concert[0]['date'],
            'place' =>  $concert[0]['place'],
            'artist_name' => implode( ",", $artist_names )
          ];
          array_push($concerts_array, $concert_data);
      }
      return $concerts_array;
    }
    /**
     * Store ArtistConcert Data
     * @param  array   $postData
     * @return boolean $result
     */
    public function create(array $postData):bool{
        $result = false;
        $pdo    = db_connect();
        $sql    ="INSERT INTO artist_concert(artist_id, concert_id) VALUES(:artist_id,:concert_id)";
        $stmt   = $pdo->prepare($sql);
        $concert_id = $postData["concert_id"];
        $artist_ids = $postData["artist_id"];
        try{  
            $pdo->beginTransaction();
            foreach($artist_ids as $artist_id){
                $stmt->bindValue(":artist_id", $artist_id, PDO::PARAM_STR);
                $stmt->bindValue(":concert_id", $concert_id, PDO::PARAM_STR);
                $stmt->execute();
            };
            $result = true;
            $pdo->commit();
        }catch(Exception $e){
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
    public function delete(array $postData):bool{
        $result = false;
        $pdo    = db_connect();
        $sql    = "DELETE FROM artist_concert WHERE concert_id = :concert_id";
        $stmt   = $pdo->prepare($sql);
        $id     = intval($postData["concert_id"]);
        try{
            $pdo->beginTransaction();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":concert_id", $id, PDO::PARAM_INT);
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
