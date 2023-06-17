<?php
require_once 'classes/Artist.php';
require_once 'classes/rules/ArtistRequest.php';

// Create an instance
$artist         = new Artist();
$artist_request = new ArtistRequest();

// Validate post request data
$artist_request->postValidation($_POST);

$artist->update($_POST);


?>
