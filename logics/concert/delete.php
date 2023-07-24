<?php
require_once("models/Concert.php");
// Create an instance
$concert = new Concert();
// Execute query
$result = $concert->delete($_POST);

// Redirect
if($result){
    header('Location:/the-elephant-in-the-room/pages/concert');
    exit();
}else{
    header('Location:/the-elephant-in-the-room/pages/errors/error.php');
    exit();
}
?>
