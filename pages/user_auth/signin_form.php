<?php
session_start();
require_once '../../models/UserAuth.php';

$result = UserAuth::checkSign();
if($result) {
  header('Location: my_page.php');
  return;
}
$err = $_SESSION;
$_SESSION = array();
session_destroy();
?>
<?php require('pages/layouts/header.php') ?>
<div class="wrapper">
    <h2 class="text-center">Sign-in</h2>
    <?php if (isset($err['msg'])) : ?>
        <p class="text-center"><?php echo $err['msg']; ?></p>
    <?php endif; ?>
    <section class="flex-box justify-center">
        <form action="../../logics/user_auth/signin.php" method="POST">
            <div class="flex-box justify-center">
              <label for="email" class="label">E-mail:</label>
              <input type="email" name="email" class="form-input">
              <?php if (isset($err['email'])) : ?>
                  <p><?php echo $err['email']; ?></p>
              <?php endif; ?>
            </div>
            <div class="flex-box justify-center">
              <label for="password" class="label">Password：</label>
              <input type="password" name="password" class="form-input">
              <?php if (isset($err['password'])) : ?>
                  <p><?php echo $err['password']; ?></p>
              <?php endif; ?>
              </div>
            <div class="flex-box justify-center my-2">
              <input type="submit" class="button primary " value="Enter"> 
            </div>
            <a href="signup_form.php" class="text-center">Click here to register as a new user.</a>
        </form>
        
    </section>
</div>
<?php require('pages/layouts/footer.php') ?>
