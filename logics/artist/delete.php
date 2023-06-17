<?php
require_once("classes/Artist.php");
$artist = new Artist();
$artist->delete($_POST);
?>
