<?php
require_once 'models/ArtistConcert.php';
require_once 'rules/ArtistConcertRequest.php';

// // Create an instance
$artist_concert         = new ArtistConcert();
$artist_concert_request = new ArtistConcertRequest();

// Validate post request data
$artist_concert_request->postValidation($_POST);

// Execute Query
$result = $artist_concert->delete($_POST);

//Redirect
if($result){
    header('Location:/the-elephant-in-the-room/pages/artist_concert');
    exit();
}else{
    header('Location:/the-elephant-in-the-room/pages/errors/error.php');
    exit();
}
?>
