<?php
require_once("../../class/Artist.php");
$pdo = db_connect();

$artist = new Artist();
$artist->create($_POST);

?>
