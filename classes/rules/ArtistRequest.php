<?php

class ArtistRequest{
  public function postValidation($post_data) {
    session_start();
    unset($_SESSION['errors']);

    $errors = [];
    $name = $post_data['name'];

    if(!$name) {
  
      array_push($errors,'Please fill in artist name.');
    }

    if(mb_strlen($name)>100) {
      array_push($errors,'Please enter up to 100 characters.');
    }

    if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;
      header('Location: /the-elephant-in-the-room/pages/artist/create_form.php');
      return;
    }

  }
}

?>