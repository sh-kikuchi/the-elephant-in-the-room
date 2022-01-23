<?php
session_start();
require_once '../controller/auth.php';

//エラーメッセージ
$error = [];

//ヴァリデーション
if(!$email = filter_input(INPUT_POST,'email')){
    $err['email'] = "メールアドレスを記入してください。";
}

if(!$password = filter_input(INPUT_POST,'password')){
    $err['password'] = "パスワードを記入してください。";
}

if(count($error)>0){
    $_SESSION = $error;
    header('Location: login.php');
    return;
}

//ログイン成功
// $result = UserAuth::login($email, $password);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
</head>
<body>
    <div class="container">
        <h2>サインイン</h2>
        <section class="signin">
            <form action ="./index.html" method="POST">
              <div class="form-item">
                <label for="email">User Name</label>
                <input type="email" name="email">
              </div>
              <div class="form-item">
                <label for="password">Email</label>
                <input type="password" name="password">
              </div>
              <div class="form-submit">
                  <input type="submit" value="Login">
              </div>
            </form>
            <a href="signup_form.php">Register as a user</a>
        </section>
    </div>
</body>
</html>
