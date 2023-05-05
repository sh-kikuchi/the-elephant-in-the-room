<?php
session_start();
require_once '../../class/users/userAuth.php';

$result = UserAuth::checkSign();
if($result) {
  header('Location: signTest.php');
  return;
}

$err = $_SESSION;

$_SESSION = array();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン画面</title>
</head>
<body>
<h2>ログインフォーム</h2>
    <?php if (isset($err['msg'])) : ?>
        <p><?php echo $err['msg']; ?></p>
    <?php endif; ?>
    <section id="signin">
        <form action="../../function/user_auth/signin.php" method="POST">
            <div>
              <label for="email">メールアドレス：</label>
              <input type="email" name="email">
              <?php if (isset($err['email'])) : ?>
                  <p><?php echo $err['email']; ?></p>
              <?php endif; ?>
            </div>
            <div>
              <label for="password">パスワード：</label>
              <input type="password" name="password">
              <?php if (isset($err['password'])) : ?>
                  <p><?php echo $err['password']; ?></p>
              <?php endif; ?>
              </div>
            <div>
              <input type="submit" value="ログイン">
            </div>
        </form>
        <a href="signup_form.php">新規登録はこちら</a>
    </section>
</body>
</html>
