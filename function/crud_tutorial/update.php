<?php
//require_onceでDB接続ファイルの呼び出し
require_once("../../database/db_connect.php");
require_once("../../class/crud_tutorial/Comment.php");
$comment = new Comment();
$comment->update($_POST);
?>
