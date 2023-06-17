<?php

class ConcertRequest{
  public function postValidation($post_data) {
    session_start();
    unset($_SESSION['errors']);

    $errors    = [];
    $date      = $post_data['date'];
    $name      = $post_data['name'];
    $place     = $post_data['place'];
    $artist_id = $post_data['artist_id'];

    if(!$name) {
      array_push($errors,'Please fill in concert name.');
    }
    if(!$date) {
      array_push($errors,'Please fill in date.');
    }
    if(!$place) {
      array_push($errors,'Please fill in place.');
    }
    if(isset($artist_id) && empty($artist_id)) {
      array_push($errors,'Please select artist name.');
    }

    if(mb_strlen($name)>100 || mb_strlen($place)>100) {
      array_push($errors,'Please enter up to 100 characters.');
    }

    if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;
      header('Location: /the-elephant-in-the-room/pages/concert/create_form.php');
      return;
    }









  }
}

?>