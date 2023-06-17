<?php
session_start();

// Load other files.
require_once 'classes/users/userAuth.php';
require_once 'classes/rules/userRequest.php';

// Set variables
$logout = filter_input(INPUT_POST, 'logout');

// Create an instance
$user_auth    = new UserAuth();
$user_request = new UserRequest();

// Validate post request data
$user_request->signOutValidation($logout);

/**
 * If the session has expired, 
 * a message is issued asking the user to log in.
 */
$result = $user_auth->checkSign();
if(!$result){
  exit('Session has expired. Please sign in.');
}

// Execute methods
$user_auth->signout();

?>
