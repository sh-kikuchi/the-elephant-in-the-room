<?php
require_once 'util\trait\session.php';
class ArtistConcertRequest{
  use Session;

    /**
     * Validate POST data.
     * @param array $postData
     * @return $void
     */
    public function postValidation($post_data) {
        session_start();
        unset($_SESSION['errors']);

        $errors        = [];

        if (isset($post_data["artist_id"]) && count($post_data["artist_id"]) === 0) {
          array_push($errors,'Please select at least one artist.');
        }
        if (is_array($post_data["concert_id"]) && count($post_data["concert_id"]) === 0) {
            array_push($errors,'Please make sure to select one concert.');
        }
      
        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            $this->oldPostValue($post_data);
            header('Location: /the-elephant-in-the-room/pages/artist_concert/create_form.php');
            exit();
        }
    }
    /**
     * Search Concert Data
     * @param array $postData
     * @return $void
     */
    public function searchArtistConcertData($post_data):void {
        $errors = [];
        $concert_id = $post_data['concert_id'];

        $pdo = db_connect();
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
            header('Location: /the-elephant-in-the-room/pages/artist_concert/create_form.php');
            exit();
        }
  }
}

?>
