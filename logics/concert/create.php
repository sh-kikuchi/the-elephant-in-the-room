<?php
require_once 'classes/Concert.php';
require_once 'classes/rules/ConcertRequest.php';

// Create an instance
$concert = new Concert();
$concert_request = new ConcertRequest();

// Validate post request data
$concert_request->postValidation($_POST);

$concert->create($_POST);


?>
