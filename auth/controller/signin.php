<?php
session_start();

require_once '../controller/userAuth.php';

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
  header('Location:../view/signup_form.php');
  return;
}
// ログイン成功時の処理
$result = UserAuth::signin($email, $password);
header('Location:../view/signTest.php');
// ログイン失敗時の処理
if (!$result) {
  header('Location:../view/signTest.php');
  return;
}

?>
