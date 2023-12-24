<?php

namespace app\classes;

use app\anchor\toolbox\Session;
use app\anchor\https\Validator;
use app\models\Artist;
use app\database\DataBaseConnect;

require_once 'interfaces\classes\IArtistRequest.php';

class ArtistRequest implements IArtistRequest {

    protected ?int    $id;
    protected ?int    $user_id;
    protected ?string $name;
    protected ?string $debut;
    protected ?string $start_date;
    protected ?string $end_date;

    /** constructor */
    function __construct(?array $data){
        if(!isset($data['delete'])){
            $this->validate($data);
        }
        $this->id          = $data['id']      ?? 0;
        $this->user_id     = $data['user_id'] ?? 0;
        $this->name        = $data['name']    ?? '';
        $this->debut       = $data['debut']    ?? '';
        $this->start_date  = $data['start_date']   ?? '';
        $this->end_date    = $data['end_date']   ?? '';
	}

    /** setter */
    public function setId($id){
        $this->id = $id;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function setDebut($debut){
        $this->debut = $debut;
    }

    public function setStartDate($start_date){
        $this->start_date = $start_date;
    }

    public function setEndDate($end_date){
        $this->end_date = $end_date;
    }

    /** getter */
    public function getId(){
        return $this->id;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function getName(){
        return $this->name;
    }

    public function getDebut(){
        return $this->debut;
    }

    public function getStartDate(){
        return $this->start_date;
    }

    public function getEndDate(){
        return $this->end_date;
    }

    public function getArrayData(){
        return [
            'id'         => $this->id,
            'user_id'    => $this->user_id,
            'name'       => $this->name,
            'debut'      => $this->debut,
            'start_date' => $this->start_date,
            'end_date'   => $this->end_date
        ];
    }

    /**
     * Validate POST data.
     * @param
     * @return $array
     */
    public function validate($targetData) {

        unset($_SESSION['errors']);
        $validator       = new Validator;
        $session         = new Session;
        $artist_name = $targetData['name'];
        /**
         * $value, $field, $required,, 
         */

        $errors = $validator->validateString($artist_name, 'name', true, 0, 100);
        if ($errors !== [] &&  count($errors) > 0) {
          $_SESSION['errors'] = $validator->getErrors();
          $session->oldPostValue($targetData);
          if(!empty($targetData['id'])){
              $param = '?id='. $targetData['id'];
              header('Location: /the-elephant-in-the-room/artist/update'.$param);
              exit();
          }else{
              header('Location: /the-elephant-in-the-room/artist/create');
              exit();
          }
        }
    }

    /**
     * Search Concert Data
     * @param 
     * @return $void
     */
    public function searchConcertData():void {
        session_start();
        unset($_SESSION['errors']);

        $errors = [];
        $artist_id = $this->id;
        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql = "SELECT * FROM artist_concert WHERE artist_id = $artist_id;";
        $artist_concert_count = $pdo->query($sql);
        $data_count = $artist_concert_count->fetchAll();

        if (count($data_count) > 0) {
            array_push($errors,'As there is concert data associated with the relevant artist, delete them and then delete the artist again.');
        }
        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            header('Location: /the-elephant-in-the-room/pages/artist');
            exit();
        }
    }
}

?>