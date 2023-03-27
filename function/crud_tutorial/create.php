<?php
require_once("../../class/crud_tutorial/Comment.php");
$pdo = db_connect();

$comment = new Comment();
$comment->create($_POST);

?>
