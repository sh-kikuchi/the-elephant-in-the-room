<?php
require_once("../../class/crud_tutorial/Comment.php");
$comment = new Comment();
$comment->update($_POST);
?>
