<?php
require_once 'models/Concert.php';
require_once 'rules/ConcertRequest.php';

// Create an instance
$concert = new Concert();
$concert_request = new ConcertRequest();

// Validate post request data
$concert_request->postValidation($_POST);

// Execute query
$result = $concert->create($_POST);

// Redirect
if($result){
    header('Location:/the-elephant-in-the-room/pages/concert');
    exit();
}else{
    header('Location:/the-elephant-in-the-room/pages/errors/error.php');
    exit();
}
?>
