<?php
session_start();

// Load other files.
require_once 'models/UserAuth.php';
require_once 'rules/UserRequest.php';

//Set variables.
$paramPostData = $_POST;

// Create an instance
$user_auth    = new UserAuth();
$user_request = new UserRequest();

// Validate post request data
$user_request->signInValidation($paramPostData);

// Execute methods
$result = $user_auth->signin($paramPostData);

//Transitioning screen
if (!$result) {
  header('Location:/the-elephant-in-the-room/pages/user_auth/signin_form.php');
}else{
  header('Location: /the-elephant-in-the-room/pages/user_auth/my_page.php');
}

?>
