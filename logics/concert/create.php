<?php
require_once("../../class/Concert.php");
$concert = new Concert();
$concert->create($_POST);
?>
