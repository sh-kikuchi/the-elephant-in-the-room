<?php
    session_start();
    require_once '../../util/fragile.php';
    require_once '../../models/Artist.php';
    require_once '../../models/UserAuth.php';
    $models = new Artist();
    $artists = $models->show();
    //　ログインしているか判定し、していなかったら新規登録画面へ返す
    $result = UserAuth::checkSign();
    if (!$result) {
      $_SESSION['signin_err'] = 'ユーザを登録してログインしてください！';
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
  <div class="crud-container">
  <div>
   <?php if (isset($errors)) : ?>
      <ul>
      <?php foreach($errors as $error) {?>
        <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
      <?php }?>
      </ul>
    <?php endif; ?>
    <h2 class="text-center">Artist Master <br>Registration</h2>
    <section class="flex-box justify-center">
      <form method="post" action="../../logics/artist/create.php">
        <input hidden name="user_id" value="<?php echo h($signin_user["id"]);?>"> 
        <div class="flex-box">
          <label for="name" class="label">name</label>
          <input name="name" class="form-input" placeholder="100字以内" value="<?php if($old){echo h($old['name']);}?>">
        </div>
        <div class="flex-box">
          <label for="title" class="label">debut</label>
          <input type="date" name="debut" class="form-input"  value="<?php if($old){echo h($old['debut']);}"}"?>">
        </div>
        <div class="flex-box">
          <label for="title" class="label">start date of AC</label>
          <input type="date" name="start_date" class="form-input" value="<?php if($old){echo h($old['start_date']);}?>">
        </div>
        <div class="flex-box">
          <label for="title" class="label">end date of AC</label>
          <input type="date" name="end_date" class="form-input" value="<?php if($old){echo h($old['end_date']);}?>">
        </div>
        <div class="flex-box justify-center">
          <button type="submit" class="button primary">CREATE</button>
        </div>
      </form>
    </section>
  </div>
</div>
<?php require($_SERVER['DOCUMENT_ROOT'].'/the-elephant-in-the-room/pages/layouts/footer.php') ?>
