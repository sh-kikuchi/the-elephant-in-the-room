<?php
session_start();
require_once '../controller/userAuth.php';
require_once '../../fragile/index.php';

//　ログインしているか判定し、していなかったら新規登録画面へ返す
$result = UserAuth::checkSign();

if (!$result) {
  $_SESSION['signin_err'] = 'ユーザを登録してログインしてください！';
  header('Location: signup_form.php');
  return;
}

$signin_user = $_SESSION['signin_user'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>マイページ</title>
</head>
<body>
<h2>マイページ</h2>
<p>ログインユーザ：<?php echo h($signin_user['name']) ?></p>
<p>メールアドレス：<?php echo h($signin_user['email']) ?></p>
<form action="../controller/signout.php" method="POST">
<input type="submit" name="logout" value="ログアウト">
</form>
<!-- ①ログアウト画面の作成 -->
<!-- ②ログアウトメソッドの作成 -->
</body>
</html>
