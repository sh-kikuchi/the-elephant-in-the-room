<?php
    session_start();
    require_once '../../util/fragile.php';
    require_once '../../classes/Artist.php';
    require_once '../../classes/users/userAuth.php';
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
?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/the-elephant-in-the-room/layouts/header.php') ?>
  <div class="crud-container">
  <div>
   <?php if (isset($errors)) : ?>
      <ul>
      <?php foreach($errors as $error) {?>
        <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
      <?php }?>
      </ul>
    <?php endif; ?>
    <h2 class="text-center">アーティスト登録</h2>
    <section class="flex-box justify-center">
      <form method="post" action="../../logics/artist/create.php">
        <input hidden name="user_id" value="<?php echo h($signin_user["id"]);?>"> 
        <div class="flex-box">
          <label for="name" class="label">アーティスト名</label>
          <input name="name" class="form-input" placeholder="100字以内">
        </div>
        <div class="flex-box">
          <label for="title" class="label">デビュー日</label>
          <input type="date" name="debut" class="form-input">
        </div>
        <div class="flex-box">
          <label for="title" class="label">結成日</label>
          <input type="date" name="start_date" class="form-input">
        </div>
        <div class="flex-box">
          <label for="title" class="label">活動終了日（解散）</label>
          <input type="date" name="end_date" class="form-input">
        </div>
        <div class="flex-box justify-center">
          <button type="submit" class="button primary">追加</button>
        </div>
      </form>
    </section>
  </div>
</div>
<?php require($_SERVER['DOCUMENT_ROOT'].'/the-elephant-in-the-room/layouts/footer.php') ?>
