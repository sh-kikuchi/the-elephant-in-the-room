<?php
session_start();
require_once '../../util/fragile.php';
require_once '../../models/UserAuth.php';
require_once '../../models/UserAuth.php';
$result = UserAuth::checkSign();
if($result) {
  header('Location: my_page.php');
  return;
}
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
$old    = isset($_SESSION['old']) ? $_SESSION['old'] : null;
unset($_SESSION['errors']);
unset($_SESSION['old']);
?>
<?php require('pages/layouts/header.php') ?>
<div class="wrapper">
    <?php if (isset($errors)) : ?>
      <ul>
      <?php foreach($errors as $error) {?>
        <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
      <?php }?>
      </ul>
    <?php endif; ?>
    <h2 class="text-center pt-2">Sign-in</h2>
    <section class="flex-box justify-center">
        <form action="../../logics/user_auth/signin.php" method="POST">
          <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">  
          <div class="flex-box justify-center">
              <label for="email" class="label">E-mail:</label>
              <input type="email" name="email" class="form-input" value="<?php if($old){echo h($old['email']);}"}"?>">
            </div>
            <div class="flex-box justify-center">
              <label for="password" class="label">Password：</label>
              <input type="password" name="password" class="form-input" value="<?php if($old){echo h($old['password']);}"}"?>">
            </div>
            <div class="flex-box justify-center my-2">
              <input type="submit" class="button primary " value="Enter"> 
            </div>
            <a href="signup_form.php" class="text-center">Click here to register as a new user.</a>
        </form>
    </section>
</div>
<?php require('pages/layouts/footer.php') ?>
