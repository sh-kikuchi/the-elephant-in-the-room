<?php
require_once 'models/Artist.php';
require_once 'rules/ArtistRequest.php';

// Create an instance
$artist         = new Artist();
$artist_request = new ArtistRequest();

// Validate post request data
$artist_request->postValidation($_POST);

// Execute Query
$result = $artist->create($_POST);

// Redirect
if($result){
    header('Location:/the-elephant-in-the-room/pages/artist');
    exit();
}else{
    header('Location:/the-elephant-in-the-room/pages/errors/error.php');
    exit();
}
?>
