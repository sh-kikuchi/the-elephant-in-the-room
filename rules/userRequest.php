<?php
require_once 'util\trait\session.php';
class UserRequest{
  use Session;
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
        exit();
      }
  }
  public function signUpValidation($post_data){
    $errors        = [];
    $name          = $post_data['name'];
    $email         = $post_data['email'];
    $password      = $post_data['password'];
    $password_conf = $post_data['password_conf'];
    $csrf_token    = $post_data['csrf_token'];
    if(!$name) {
      array_push($errors,'Please fill in concert name.');
    }
    if(!$email) {
      array_push($errors,'Please fill in concert email.');
    }
    if (!preg_match("/\A[a-z\d]{8,100}+\z/i",$password)) {
      array_push($errors,'The password must be at least 8 alphanumeric characters and no more than 100 characters.');
    }
    if ($password !== $password_conf) {
      array_push($errors,'Password and confirmation password do not match.');
    }
    if (!isset($_SESSION['csrf_token']) || $csrf_token !== $_SESSION['csrf_token']) {
      array_push($errors,'Invalid request.');
    }
    if (count($errors) > 0) {
      $_SESSION['errors'] = $errors;
      $this->oldPostValue($post_data);
      header('Location: /the-elephant-in-the-room/pages/user_auth/signup_form.php');
      exit();
    }
  }
  public function signOutValidation($signout){
    if (!$signout) {
      exit('Invalid request.');
    }
  }
}

?>
