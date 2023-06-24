<?php
session_start();

// Load other files.
require_once 'models/UserAuth.php';

// Set variables
$logout = filter_input(INPUT_POST, 'logout');

// Create an instance
$user_auth    = new UserAuth();

// Execute methods
$user_auth->signout();

?>
