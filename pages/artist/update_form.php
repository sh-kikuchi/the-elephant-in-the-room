<?php
  session_start();
  require_once '../../util/fragile.php';
  require_once '../../classes/Artist.php';
  require_once '../../classes/users/userAuth.php';
  $models = new Artist();
  $artists = $models->getArtist(intval($_GET["id"]));
  $result = UserAuth::checkSign();
  $signin_user = isset($_SESSION['signin_user']) ? $_SESSION['signin_user']: null;
  $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
?>
<?php include('../../layouts/header.php'); ?>
<!-- 下記は<body>タグの中身 -->
<div class="crud-container">
    <?php if (isset($errors)) : ?>
      <ul>
      <?php foreach($errors as $error) {?>
        <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
      <?php }?>
      </ul>
    <?php endif; ?>
    <h2 class="text-center">アーティスト編集</h2>
    <section class="flex-box justify-center">
        <form method="post" action="../../logics/artist/update.php">
            <?php foreach ($artists as $artist){?>
              <input hidden name="id" value="<?php echo h($artist["id"]);?>">
              <div class="flex-box">
                <label for="name" class="label">アーティスト名</label>
                <input class="form-input" name="name" placeholder="100字以内" value="<?php echo h($artist["name"]);?>">
              </div>
              <div class="flex-box">
                <label for="debut" class="label">デビュー日</label>
                <input type="text" class="form-input" name="debut" value="<?php echo h($artist["debut"]);?>">
              </div>
              <div class="flex-box">
                <label for="start_date" class="label">結成日</label>
                <input type="text" class="form-input" name="start_date" value="<?php echo h($artist["start_date"]);?>">
              </div>
              <div class="flex-box">
                <label for="end_date" class="label">活動終了日（解散）</label>
                <input type="text" class="form-input" name="end_date" value="<?php echo h($artist["end_date"] = "0000-00-00"? '':$artist["end_date"]);?>">
              </div>
            <?php } ?>
           <div class="flex-box justify-center">
                <button type="submit" class="button primary">更新</button>
            </div>
        </form>
    </section>
</div>
<?php include('../../layouts/footer.php'); ?>
