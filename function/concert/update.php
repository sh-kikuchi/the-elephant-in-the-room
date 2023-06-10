<?php
require_once("../../class/Concert.php");
$concert = new Concert();
$concert->update($_POST);
?>
