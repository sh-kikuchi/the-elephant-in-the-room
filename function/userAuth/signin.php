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
  header('Location:../../../../../the_Elephant_in_the_Room/page/userAuth/signin_form.php');
  return;
}
// ログイン成功時の処理
$userAuth = new UserAuth();
$result = $userAuth->signin($email, $password);
header('Location:../../../../../the_Elephant_in_the_Room/page/userAuth/signTest.php');
// ログイン失敗時の処理
if (!$result) {
   header('Location:../../../../../the_Elephant_in_the_Room/page/userAuth/signin_form.php');
  return;
}

?>
