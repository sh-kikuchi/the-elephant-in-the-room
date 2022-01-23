<?php
session_start();
require_once '../controller/userAuth.php';

if (!$logout = filter_input(INPUT_POST, 'logout')) {
  exit('不正なリクエストです。');
}

//　ログインしているか判定し、セッションが切れていたらログインしてくださいとメッセージを出す。
$result = UserAuth::checkLogin();

if (!$result) {
  exit('セッションが切れました。サインインして下さい');
}

// ログアウトする
UserAuth::logout();

?>
