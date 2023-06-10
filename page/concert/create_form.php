<?php
    session_start();
    require_once '../../util/fragile.php';
    require_once '../../class/Artist.php';
    require_once '../../class/users/userAuth.php';
    $models = new Artist();
    $artists = $models->show();

    //　ログインしているか判定し、していなかったら新規登録画面へ返す
    $result = UserAuth::checkSign();
   
    $signin_user = $_SESSION['signin_user'];
?>
<?php require($_SERVER['DOCUMENT_ROOT'].'/the-elephant-in-the-room/layout/header.php') ?>
  <div class="crud-container">
  <div>
    <h2 class="text-center">コンサート登録</h2>
    <section class="flex-box justify-center">
      <form method="post" action="../../function/concert/create.php">
       <input hidden name="user_id" class="crud-form-input" value="<?php echo h($signin_user["id"]);?>"> <!--とりあえずきめうち-->
        <div class="flex-box justify-center my-2">
          <label for="date" class="label">日付</label>
          <input type = "date" name="date" class="form-input">
        </div>
        <div class="flex-box justify-center my-2">
          <label for="name" class="label">コンサート名</label>
          <input name="name" class="form-input" placeholder="100字以内">
        </div>
        <div class="flex-box justify-center my-2">
          <label for="place" class="label">場所</label>
          <input name="place" class="form-input" placeholder="100字以内">
        </div>
        <div class="flex-box justify-center my-2">
          <label for="artist" class="label">アーティスト</label>
              <table>
                <thead>
                  <tr>
                      <th></th>
                      <th>name</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($artists as $artist){?>
                  <tr>
                      <td>
                        <input type="checkbox" name="artist_id[]" value="<?php echo h($artist["id"]);?>">
                      </td>
                      <td>
                          <?php echo h($artist["name"]);?>
                      </td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>
        </div>
        <div class="flex-box justify-center">
          <button type="submit" class="button primary">追加</button>
        </div>
      </form>
    </section>
  </div>
</div>
<?php include('../../layout/footer.php'); ?>
