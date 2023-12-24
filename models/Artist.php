<?php

namespace app\models;

use app\database\DataBaseConnect;
use app\classes\ArtistRequest;

require_once 'interfaces\models\IArtist.php';

class Artist implements IArtist
{
    /**
     * show artists
     * @param array $postData
     * @return array $artists
     */
    public function show():array{
        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql = "SELECT * FROM artists ORDER BY id ASC;";
        $artists = $pdo->query($sql);
        return $artists->fetchAll();
    }
    /**
     * get an artist
     * @param array $postData
     * @return $artists
     */
    public function getArtist($id):object{
        $result = false;
        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql = "SELECT * FROM artists WHERE id = $id;";
        $artist_count = $pdo->query($sql);
        return $artist_count;
    }
    /**
     * Store Artist
     * @param array $postData
     * @return --
     */
    public function create(ArtistRequest $artist_request):bool {

        $result = false;
        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql       = "INSERT INTO artists(user_id, name, debut, start_date, end_date) VALUES(:user_id, :name, :debut, :start_date, :end_date)";
        $stmt      = $pdo->prepare($sql);
    
        $user_id    = $artist_request->getUserId();
        $name       = $artist_request->getName();
        $debut      = $artist_request->getDebut();
        $start_date = $artist_request->getStartDate();
        $end_date   = $artist_request->getEndDate();

        try{
            $pdo->beginTransaction();
            $stmt->bindValue(":user_id", $user_id, \PDO::PARAM_INT);
            $stmt->bindValue(":name", $name, \PDO::PARAM_STR);
            $stmt->bindValue(":debut", $debut, \PDO::PARAM_STR);
            $stmt->bindValue(":start_date", $start_date, \PDO::PARAM_STR);
            $stmt->bindValue(":end_date", $end_date, \PDO::PARAM_STR);
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
     * Delete Artist
     * @param array $postData
     * @return --
     */
    public function update(ArtistRequest $artist_request):bool{
        $result = false;
        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql = "UPDATE artists SET name = :name ,debut = :debut ,start_date = :start_date ,end_date = :end_date WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $id         = $artist_request->getId();
        $name       = $artist_request->getName();
        $debut      = $artist_request->getDebut();
        $start_date = $artist_request->getStartDate();
        $end_date   = $artist_request->getEndDate();

        try{
            $pdo->beginTransaction();
            $stmt->bindValue(":id", $id, \PDO::PARAM_INT);
            $stmt->bindValue(":name", $name, \PDO::PARAM_STR);
            $stmt->bindValue(":debut", $debut, \PDO::PARAM_STR);
            $stmt->bindValue(":start_date", $start_date, \PDO::PARAM_STR);
            $stmt->bindValue(":end_date", $end_date, \PDO::PARAM_STR);
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
    public function delete(ArtistRequest $artist_request):bool{
        $result = false;
        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql = "DELETE FROM artists WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $id = intval($artist_request->getId());
        try{
            $pdo->beginTransaction();
            $stmt->bindValue(":id", $id, \PDO::PARAM_INT);
            $stmt->execute();
            $pdo->commit();
            $result = true;
        }catch(Exception $e){
            $pdo->rollBack();
            $e->getmessage();
        }finally{
            return $result;
        }
    }

}
