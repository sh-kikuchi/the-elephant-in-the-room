<?php
    session_start();
    require_once '../../util/fragile.php';
    require_once '../../models/Artist.php';
    require_once '../../models/UserAuth.php';
    require_once '../../config/message.php';
    $models = new Artist();
    $artists = $models->show();
    //Determines if you are logged in and returns you to the new registration screen if you are not.
    $result = UserAuth::checkSign();
    if (!$result) {
      $_SESSION['signin_err'] = MASSAGE::sign_error;
      header('Location: /the-elephant-in-the-room/pages/user_auth/signup_form.php');
      return;
    }
    $signin_user = $_SESSION['signin_user'];
    $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
    $old    = isset($_SESSION['old']) ? $_SESSION['old'] : null;
    unset($_SESSION['errors']);
    unset($_SESSION['old']);
?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/the-elephant-in-the-room/pages/layouts/header.php') ?>
<div class="wrapper">
   <?php if (isset($errors)) : ?>
      <ul>
      <?php foreach($errors as $error) {?>
        <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
      <?php }?>
      </ul>
    <?php endif; ?>
    <h2 class="text-center pt-2">Artist Master <br>Registration</h2>
    <a class="pl-3" href="../artist">BACK</a>
    <section class="flex-box justify-center">
      <form method="post" action="../../logics/artist/create.php">
        <input hidden name="user_id" value="<?php echo h($signin_user["id"]);?>"> 
        <div class="flex-box">
          <label for="name" class="label">name</label>
          <input name="name" class="form-input" placeholder="100 words or less" value="<?php if($old){echo h($old['name']);}?>">
        </div>
        <div class="flex-box">
          <label for="title" class="label">debut</label>
          <input type="date" name="debut" class="form-input"  value="<?php if($old){echo h($old['debut']);}"}"?>">
        </div>
        <div class="flex-box">
          <label for="title" class="label">start date of activity</label>
          <input type="date" name="start_date" class="form-input" value="<?php if($old){echo h($old['start_date']);}?>">
        </div>
        <div class="flex-box">
          <label for="title" class="label">end date of activity</label>
          <input type="date" name="end_date" class="form-input" value="<?php if($old){echo h($old['end_date']);}?>">
        </div>
        <div class="flex-box justify-center">
          <button type="submit" class="button primary">CREATE</button>
        </div>
      </form>
    </section>
</div>
<?php require($_SERVER['DOCUMENT_ROOT'].'/the-elephant-in-the-room/pages/layouts/footer.php') ?>
