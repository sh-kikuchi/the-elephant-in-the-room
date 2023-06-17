<?php
session_start();
  require_once '../../util/fragile.php';
  require_once '../../classes/Concert.php';
  require_once '../../classes/users/userAuth.php';
  $models = new Concert();
  $concerts = $models->getConcert(intval($_GET["id"]));
  $result = UserAuth::checkSign();
   
  $signin_user = isset($_SESSION['signin_user']) ? $_SESSION['signin_user']: null;
  $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
?>
<?php include('../../layouts/header.php'); ?>
<!-- 下記は<body>タグの中身 -->
<div>
    <h2 class="text-center">コンサート編集</h2>
    <section class="flex-box justify-center">
        <form method="post" action="../../logics/concert/update.php">
            <?php foreach ($concerts as $concert){?>
                <div class="flex-box justify-center my-2">
                  <input hidden name="id" value="<?php echo h($concert["id"]);?>">
            </div>
                <div class="flex-box justify-center my-2">
                  <label for="name"  class="label">タイトル</label>
                  <input name="name" class="form-input" placeholder="名前を入力" value="<?php echo h($concert["name"]);?>">
                </div>
                <div class="flex-box justify-center my-2">
                    <label for="date"  class="label">デビュー日</label>
                    <input type="text" name="date" class="form-input" value="<?php echo h($concert["date"]);?>">
                </div>
                <div class="flex-box justify-center my-2">
                    <label for="place" class="label">場所</label>
                    <input type="text" name="place" class="form-input" value="<?php echo h($concert["place"]);?>">
                </div>
            <?php } ?>
            <div class="flex-box justify-center">
                <button type="submit" class="button primary">編集</button>
            </div>    
        </form>
    </section>
</div>
<?php include('../../layouts/footer.php'); ?>
