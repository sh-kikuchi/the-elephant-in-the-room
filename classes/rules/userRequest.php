<?php

class UserRequest{
  public function fileValidation($file){
    if (empty($file['upfile']['full_path'])) {
      $_SESSION['msg'] = 'No files have been uploaded.';
      header('Location: /the-elephant-in-the-room/pages/user_auth/signTest.php');
    }
  }

  public function signInValidation($email, $password){
      $err = [];

      if(!$email) {
        $err['email'] = 'Please fill in your email address.';
      }
      if(!$password) {
        $err['password'] = 'Please fill in your password.';
      }

      if (count($err) > 0) {
        $_SESSION = $err;
        header('Location: /the-elephant-in-the-room/pages/user_auth/signin_form.php');
        return;
      }
  }

  public function signOutValidation($signout){
    if (!$signout) {
      exit('Invalid request.');
    }
  }
}

?>
