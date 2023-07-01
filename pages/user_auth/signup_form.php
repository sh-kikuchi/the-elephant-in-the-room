<?php
session_start();
require_once '../../util/fragile.php';
require_once '../../models/UserAuth.php';
$result      = UserAuth::checkSign();
if($result) {
    header('Location: my_page.php');
    exit();
}
$errors      = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
$old         = isset($_SESSION['old']) ? $_SESSION['old'] : null;
unset($_SESSION['errors']);
unset($_SESSION['old']);
?>
<body>
<?php include('pages/layouts/header.php') ?>
<div class="wrapper">
    <?php if (isset($errors)) : ?>
      <ul>
      <?php foreach($errors as $error) {?>
        <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
      <?php }?>
      </ul>
    <?php endif; ?>
    <h2 class="text-center">Sign-up</h2>
    <section class="flex-box justify-center">
        <form action="../../logics/user_auth/signup.php" method="POST">
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
            <a href="./signin_form.php" class="text-center">Click here to sign in</a>
        </form>
    </section>
</div>
<?php include('pages/layouts/footer.php') ?>