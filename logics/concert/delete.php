<?php
require_once("classes/Concert.php");
$concert = new Concert();
$concert->delete($_POST);
?>
