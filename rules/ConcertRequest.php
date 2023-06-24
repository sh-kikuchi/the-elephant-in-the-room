<?php
require_once 'util\trait\session.php';
class ConcertRequest{
  use Session;
  public function postValidation($post_data) {
    session_start();
    unset($_SESSION['errors']);

    $errors    = [];
    $id        = isset($post_data['id'])?$post_data['id']:null;
    $date      = $post_data['date'];
    $name      = $post_data['name'];
    $place     = $post_data['place'];
    $artist_id = isset($post_data['artist_id'])?$post_data['artist_id']:null;

    if(!$name) {
      array_push($errors,'Please fill in concert name.');
    }
    if(!$date) {
      array_push($errors,'Please fill in date.');
    }
    if(!$place) {
      array_push($errors,'Please fill in place.');
    }
    if(empty($artist_id)) {
      array_push($errors,'Please select artist name.');
    }
    if(mb_strlen($name)>100 || mb_strlen($place)>100) {
      array_push($errors,'Please enter up to 100 characters.');
    }

    if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;
      $this->old_post_value($post_data);
      $param =  !$id ? '?id='.$id : '';
      header('Location: /the-elephant-in-the-room/pages/concert/create_form.php'.$param);
      exit();
    }
  }
}

?>