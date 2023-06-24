<?php
require_once("models/Artist.php");

// Create an instance
$artist = new Artist();

// Execute Query
$result = $artist->delete($_POST);

// Redirect
if($result){
    header('Location:/the-elephant-in-the-room/pages/artist');
    exit();
}else{
    header('Location:/the-elephant-in-the-room/pages/errors/error.php');
    exit();
}
?>
