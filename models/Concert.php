<?php

namespace app\models;

use app\database\DataBaseConnect;
use app\classes\ConcertRequest;

require_once 'interfaces\models\IConcert.php';

class Concert implements IConcert
{
    /**
     * Show concert lists
     * @param  - 
     * @return array $concerts_array
     */
    public function show():array{
      $concerts_array = [];
      $dbConnect = new DataBaseConnect();
      $pdo       = $dbConnect->getPDO();
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
      $dbConnect = new DataBaseConnect();
      $pdo       = $dbConnect->getPDO();
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
    public function create(ConcertRequest $concert_request):bool{
        $result = false;
        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql              = "INSERT INTO concerts(user_id, name, date, place) VALUES(:user_id ,:name, :date, :place)";
        $stmt             = $pdo->prepare($sql);
        $user_id          = $concert_request->getUserId();
        $name             = $concert_request->getName();
        $date             = $concert_request->getDate();
        $place            = $concert_request->getPlace(); 
        try{
            $pdo->beginTransaction();
            $stmt->bindValue(":user_id", $user_id, \PDO::PARAM_STR);
            $stmt->bindValue(":name", $name, \PDO::PARAM_STR);
            $stmt->bindValue(":date", $date, \PDO::PARAM_STR);
            $stmt->bindValue(":place", $place, \PDO::PARAM_STR);
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
    public function update(ConcertRequest $concert_request):bool{

        $result = false;
        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql    = "UPDATE concerts SET name = :name, date = :date, place = :place WHERE id = :id";
        $stmt   = $pdo->prepare($sql);
        $id     = $concert_request->getId();
        $name   = $concert_request->getName();
        $date   = $concert_request->getDate();
        $place  = $concert_request->getPlace(); 
        try{
          $pdo->beginTransaction();
          $stmt->bindValue(":id", $id, \PDO::PARAM_INT);
          $stmt->bindValue(":name", $name, \PDO::PARAM_STR);
          $stmt->bindValue(":date", $date, \PDO::PARAM_STR);
          $stmt->bindValue(":place", $place, \PDO::PARAM_STR);
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
     * @param  ConcertRequest $concert_request
     * @return boolean        $result
     */
    public function delete(ConcertRequest $concert_request):bool{
        $result    = false;
        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql       = "DELETE FROM concerts WHERE id = :concert_id";
        $id        = intval($concert_request->getId());
        try{
            $pdo->beginTransaction();
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":concert_id", $id , \PDO::PARAM_INT);
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
