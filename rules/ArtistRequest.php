<?php
require_once 'util/trait/session.php';
require_once 'models/Artist.php';
class ArtistRequest{
    use Session;

    /**
     * Validate POST data.
     * @param array $postData
     * @return $void
     */
    public function postValidation($post_data):void {
        session_start();
        unset($_SESSION['errors']);

        $errors = [];
        $id     = isset($post_data['id']) ? $post_data['id'] : null;
        $name   = $post_data['name'];

        if(!$name) {
            array_push($errors,'Please fill in artist name.');
        }

        if(mb_strlen($name)>100) {
            array_push($errors,'Please enter up to 100 characters.');
        }

        if (count($errors) > 0) {
          $_SESSION['errors'] = $errors;
          $this->oldPostValue($post_data);
          if(!empty($id)){
              $param = '?id='. $id;
              header('Location: /the-elephant-in-the-room/pages/artist/update_form.php'.$param);
              exit();
          }else{
              header('Location: /the-elephant-in-the-room/pages/artist/create_form.php');
              exit();
          }
        }
    }
    /**
     * Search Concert Data
     * @param array $postData
     * @return $void
     */
    public function searchConcertData($post_data):void {
        session_start();
        unset($_SESSION['errors']);

        $errors = [];
        $artist_id = $post_data['id'];

        $pdo = db_connect();
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