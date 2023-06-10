<?php
session_start();
require_once '../../class/users/userAuth.php';

if (!$logout = filter_input(INPUT_POST, 'logout')) {
  exit('不正なリクエストです。');
}

//　ログインしているか判定し、セッションが切れていたらログインしてくださいとメッセージを出す。
$result = UserAuth::checkSign();

if (!$result) {
  exit('セッションが切れました。サインインして下さい');
}

// ログアウトする
UserAuth::logout();

?>