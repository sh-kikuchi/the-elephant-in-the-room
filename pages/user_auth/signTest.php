<?php
session_start();
require_once '../../classes/users/userAuth.php';
require_once '../../util/fragile.php';
$result = UserAuth::checkSign();
if (!$result) {
  $_SESSION['signin_err'] = 'ユーザを登録してログインしてください！';
  header('Location: signup_form.php');
  return;
}
$signin_user = $_SESSION['signin_user'];
?>
<?php include('../../layouts/header.php'); ?>
<div class="">
    <h2 class="text-center">My page</h2>
    <div class="flex-box justify-center">
      <div>
            <p>username:<?php echo h($signin_user['name']) ?></p>
            <p>email:<?php echo h($signin_user['email']) ?></p>
      </div>
    </div>
    <div>
        <h4 class="text-center">file_upload</h4>
        <div class="flex-box justify-center">
            <form method ="POST" action="../../logics/user_auth/upload.php" enctype="multipart/form-data">
              <input type="hidden" name="max_file_size" value="1000000">
              <input id="upload" type="file" name="upfile" size="40">
              <div class="flex-box justify-center">
                  <input type="submit" class="button primary my-2" value="upload">
              </div>
            </form>
        </div>
    </div>
    <div>
        <h4 class="text-center">send_mail</h4>
        <div class="flex-box justify-center">
            <form id="contactForm" action="../../logics/user_auth/mail.php" method="POST">
                <div class="form-group">
                  <!--お名前-->
                  <label class="label" for="name">お名前</label>
                  <input type="text" id="username" name="username" class="form-input" placeholder="名前を入力してください">
                </div>
                <div class="form-group">
                  <!--メールアドレス-->
                  <label class="label" for="emall">メールアドレス</label>
                  <input type="text" id="mail" name="mail" class="form-input" placeholder="メールアドレスを入力してください">
                </div>
                <div class="form-group">
                  <!--お問い合わせフォーム-->
                  <label class="label" for="comment">問い合わせ内容</label>
                  <textarea id="comment" name="comment" class="form-input" cols="60" rows="10" placeholder="ここに記入して下さい"></textarea>
                </div>
                <div class="flex-box justify-center">
                    <input type="submit" class="button primary my-2" value="upload">
                </div>
            </form>
        </div>
    </div>
    <div>
        <h4 class="text-center">signout</h4>
        <div class="flex-box justify-center">
            <form action="../../logics/user_auth/signout.php" method="POST">
                <input type="submit" name="signout" class="button primary my-2" value="signout">
            </form>
        </div>
    </div>
</div>
<?php include('../../layouts/footer.php'); ?>

