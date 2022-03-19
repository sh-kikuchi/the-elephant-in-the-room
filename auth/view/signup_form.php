<?php
session_start();

require_once '../../fragile/index.php';
require_once '../controller/userAuth.php';

$result = UserAuth::checkSign();
if($result) {
  header('Location: signTest.php');
  return;
}

$signin_err = isset($_SESSION['signin_err']) ? $_SESSION['signin_err'] : null;
unset($_SESSION['signin_err']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザ登録画面</title>
</head>
<body>
<h2>ユーザ登録フォーム</h2>
<?php if (isset($signin_err)) : ?>
    <p><?php echo $signin_err; ?></p>
<?php endif; ?>
<section id="signup">
    <form action="register.php" method="POST">
        <div>
          <label for="name">ユーザ名：</label>
          <input type="text" name="name">
      </div>
        <div>
          <label for="email">メールアドレス：</label>
          <input type="email" name="email">
      </div>
      <div>
          <label for="password">パスワード：</label>
          <input type="password" name="password">
      </div>
      <div>
          <label for="password_conf">パスワード確認：</label>
          <input type="password" name="password_conf">
      </div>
        <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
      <div>
          <input type="submit" value="新規登録">
      </div>
    </form>
    <a href="./signin_form.php">サインインはこちら</a>
</section>
</body>
</html>
