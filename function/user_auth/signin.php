<?php
session_start();

require_once '../../class/users/userAuth.php';
// エラーメッセージ
$err = [];

// バリデーション
if(!$email = filter_input(INPUT_POST, 'email')) {
  $err['email'] = 'メールアドレスを記入してください。';
}
if(!$password = filter_input(INPUT_POST, 'password')) {
  $err['password'] = 'パスワードを記入してください。';
}

if (count($err) > 0) {
  // エラーがあった場合は戻す
  $_SESSION = $err;
  header('Location:../../../../../the-elephant-in-the-room/page/user_auth/signin_form.php');
  return;
}
// ログイン成功時の処理
$user_auth = new UserAuth();
$result = $userAuth->signin($email, $password);
header('Location:../../../../../the-elephant-in-the-room/page/user_auth/signTest.php');
// ログイン失敗時の処理
if (!$result) {
   header('Location:../../../../../the-elephant-in-the-room/page/user_auth/signin_form.php');
  return;
}

?>
