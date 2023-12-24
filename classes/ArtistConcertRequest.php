<?php

namespace app\classes;

use app\database\DataBaseConnect;
use util\trait\Session;

require_once 'interfaces\classes\IArtistConcertRequest.php';

class ArtistConcertRequest implements IArtistConcertRequest {

    protected int $id;
    protected array $artist_id;
    protected int $concert_id;

    /** Constructor */
    function __construct(?array $data){
        $this->id         = $data['id']         ?? 0;
        $this->artist_id  = $data['artist_id']  ?? [];
        $this->concert_id = $data['concert_id'] ?? 0;
	}

    /** setter */
    public function setId($id){
        $this->id = $id;
    }

    public function setArtistId($artist_id){
        $this->artist_id = $artist_id;
    }

    public function setConcertId($concert_id){
        $this->concert_id = $concert_id;
    }

    /** getter */
    public function getId(){
        return $this->id;
    }

    public function getArtistId(){
        return $this->artist_id;
    }

    public function getConcertId(){
        return $this->concert_id;
    }

    /** get Array Data */
    public function getArrayData(){
        return [
            'id'         => $this->id,
            'artist_id'  => $this->artist_id,
            'concert_id' => $this->concert_id
        ];
    }

    /**
     * Validate POST data.
     * @param
     * @return $void
     */
    public function postValidation() {
        session_start();
        unset($_SESSION['errors']);

        $errors  = [];

        if (isset($this->artist_id) && count($this->artist_id) === 0) {
            array_push($errors,'Please select at least one artist.');
        }

        if (is_array($this->concert_id) && count($this->concert_id) === 0) {
            array_push($errors,'Please make sure to select one concert.');
        }
      
        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            $this->oldPostValue($this->getArrayData());
            header('Location: /the-elephant-in-the-room/pages/artist_concert/create_form.php');
            exit();
        }

        return $this->getArrayData();
    }
    /**
     * Search Concert Data
     * @param
     * @return $void
     */
    public function searchArtistConcertData():void {
        $errors = [];
        $concert_id = $this->concert_id;

        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql = "SELECT *
        FROM artist_concert as ac
        where ac.concert_id = $concert_id";
        $artist_concert_count = $pdo->query($sql);
        $data_count = $artist_concert_count -> fetchAll();

        if (count($data_count)> 0) {
            array_push($errors,'As there is concert data associated with the relevant artist, delete them and then delete the artist again.');
        }
        if (count($data_count)> 0) {
            $_SESSION['errors'] = $errors;
            header('Location: /the-elephant-in-the-room/pages/artist_concert');
            exit();
        }
  }
}

?>
