<?php
require_once("../../class/Artist.php");
$artist = new Artist();
$artist->delete($_POST);
?>
