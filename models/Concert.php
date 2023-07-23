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
    public function show():array{
      $concerts_array = [];
      $pdo = db_connect();
      $sql = "SELECT 
          c.name AS concert_name
          ,c.id
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
    public function getConcert(int $id):array{
      $concerts_array = [];
      $pdo = db_connect();
      $sql = "SELECT 
          c.name AS concert_name
          ,c.id
          ,a.id AS artist_id
          ,date
          ,place
          ,a.name AS artist_name
          FROM artist_concert as ac
          JOIN artists as a
          ON a.id = ac.artist_id 
          JOIN concerts as c
          ON c.id = ac.concert_id
          WHERE c.id = $id
          ORDER BY c.date desc";
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
    public function create(array $postData):bool{
        $result = false;
        $pdo    = db_connect();
        $sql    ="INSERT INTO artist_concert(artist_id, concert_id) VALUES(:artist_id,:concert_id)";
        $stmt   = $pdo->prepare($sql);
        $artist_ids = $postData["artist_id"];
        try{  
            $pdo->beginTransaction();
            $last_concert_id = self::storeConcertData($postData);
            if($last_concert_id !== null){
                foreach($artist_ids as $artist_id){
                    $stmt->bindValue(":artist_id", $artist_id, PDO::PARAM_STR);
                    $stmt->bindValue(":concert_id", $last_concert_id, PDO::PARAM_STR);
                    $stmt->execute();
                };
                $result = true;
            }
            $pdo->commit();
        }catch(Exception $e){
            $pdo->rollBack();
            error_log($e -> getMessage());
        }finally{
            return $result;
        }
    }
    /**
     * Store Concert Data
     * @param  array   $postData
     * @return boolean $last_concert_id
     */
    public function storeConcertData(array $postData):int{
      $last_concert_id  = null;
      $pdo              = db_connect();
      $sql              = "INSERT INTO concerts(user_id, name, date, place) VALUES(:user_id ,:name, :date, :place)";
      $stmt             = $pdo->prepare($sql);
      $user_id          = $postData["user_id"];
      $concert_name     = $postData["concert_name"];
      $date             = $postData["date"];
      $place            = $postData["place"]; 
      try{
          $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
          $stmt->bindValue(":name", $concert_name, PDO::PARAM_STR);
          $stmt->bindValue(":date", $date, PDO::PARAM_STR);
          $stmt->bindValue(":place", $place, PDO::PARAM_STR);
          $stmt->execute();
          $last_concert_id = $pdo->lastInsertId('id'); 
      }catch(Exception $e){
          $pdo->rollBack();
          error_log($e -> getMessage());
      }finally{
        return $last_concert_id;
      }
    }
    /**
     * Update Concert Data
     * @param  array $postData
     * @return boolean $result
     */
    public function update($postData):bool{
        $result       = false;
        $pdo          = db_connect();
        $sql          = "UPDATE concerts SET name = :name, date = :date, place = :place WHERE id = :id";
        $stmt         = $pdo->prepare($sql);
        $id           = $postData["id"];
        $concert_name = $postData["concert_name"];
        $date         = $postData["date"];
        $place        = $postData["place"];
        try{
          $pdo->beginTransaction();
          $stmt->bindValue(":id", $id, PDO::PARAM_INT);
          $stmt->bindValue(":name", $concert_name, PDO::PARAM_STR);
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
    public function delete(array $postData):bool{
        $result      = false;
        $pdo         = db_connect();
        $sql         = "DELETE FROM artist_concert WHERE concert_id = :concert_id";
        $stmt        = $pdo->prepare($sql);
        $concert_id  = intval($postData["id"]);
        try{
            $pdo->beginTransaction();
            self::trashConcertData($concert_id);
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":concert_id", $concert_id, PDO::PARAM_INT);
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
    /**
     * Store Concert Data
     * @param  array   $postData
     * @return boolean $last_concert_id
     */
    public function trashConcertData(int $target_concert_id):bool{
        $result  = false;
        $pdo     = db_connect();
        $sql     = "DELETE FROM concerts WHERE concert_id = :concert_id";
        $stmt    = $pdo->prepare($sql);
        try{
            $stmt->bindValue(":concert_id", $target_concert_id, PDO::PARAM_STR);
            $stmt->execute();
            $result = true;
        }catch(Exception $e){
            //$pdo->rollBack();
            error_log($e -> getMessage());
        }finally{
          return $result;
        }
    }
}
