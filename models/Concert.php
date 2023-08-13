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
          id 
          ,name
          ,date
          ,place
          FROM concerts
          ORDER BY date desc";
      $concerts = $pdo->query($sql);
      $concerts_array = $concerts->fetchAll();
      return $concerts_array;
    }
    /**
     * Get an concert detail
     * @param  array $postData
     * @return array $concert_array
    */
    public function getConcert(int $id):array{
      $concerts_array = [];
      $pdo = db_connect();
      $sql = "SELECT 
          id
          ,name
          ,date
          ,place
          FROM concerts
          WHERE id = $id
          ORDER BY date desc";
      $concert = $pdo->query($sql);
      $concert_array = $concert->fetchAll();
      return $concert_array;
    }
    /**
     * Store Concert Data
     * @param  array   $postData
     * @return boolean $result
     */
    public function create(array $postData):bool{
        $result = false;
        $pdo              = db_connect();
        $sql              = "INSERT INTO concerts(user_id, name, date, place) VALUES(:user_id ,:name, :date, :place)";
        $stmt             = $pdo->prepare($sql);
        $user_id          = $postData["user_id"];
        $name             = $postData["name"];
        $date             = $postData["date"];
        $place            = $postData["place"]; 
        try{
            $pdo->beginTransaction();
            $stmt->bindValue(":user_id", $user_id, PDO::PARAM_STR);
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
        $name         = $postData["name"];
        $date         = $postData["date"];
        $place        = $postData["place"];
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
    public function delete(array $postData):bool{
        $result  = false;
        $pdo     = db_connect();
        $sql     = "DELETE FROM concerts WHERE id = :concert_id";
        $id      = $postData["id"];
        try{
            $pdo->beginTransaction();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":concert_id", $id , PDO::PARAM_INT);
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
