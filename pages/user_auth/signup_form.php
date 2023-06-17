<?php
session_start();

require_once '../../util/fragile.php';
require_once '../../classes/users/userAuth.php';

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
<?php if (isset($signin_err)) : ?>
    <p><?php echo $signin_err; ?></p>
<?php endif; ?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/the-elephant-in-the-room/layouts/header.php') ?>
<div class="wrapper">
    <h2 class="text-center">Sign-up</h2>
    <section class="flex-box justify-center">
        <form action="register.php" method="POST">
            <div class="flex-box justify-center my-2">
                <label for="name" class="label">Username：</label>
                <input type="text" name="name" class="form-input">
            </div>
            <div class="flex-box justify-center my-2">
                <label for="email" class="label">E-mail：</label>
                <input type="email" name="email" class="form-input">
            </div>
            <div class="flex-box justify-center my-2">
                <label for="password" class="label">Password：</label>
                <input type="password" name="password" class="form-input">
            </div>
            <div class="flex-box justify-center my-2">
                <label for="password_conf" class="label">Pass-Confirm：</label>
                <input type="password" name="password_conf" class="form-input">
            </div>
              <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
            <div class="flex-box justify-center my-2">
                <input type="submit" value="Register" class="button primary">
            </div>
            <a href="./signin_form.php" class="text-center">サインインはこちら</a>
        </form>
    </section>
</div>
<?php require($_SERVER['DOCUMENT_ROOT'].'/the-elephant-in-the-room/layouts/footer.php') ?>
