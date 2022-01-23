<?php
    // session_start();
    require_once('../../database/db_connect.php');
    require_once '../controller/auth.php';
    require_once '../../csrf/index.php';

    /**
     * ログイン判定
     * function:UserAuth from auth.php
     */
    // $result = UserAuth::authCheck();
    // if($result){
    //     header('Location: loginTest.php');
    //     return;
    // }

    // $login_err = isset($_SESSION['login_err'])? $_SESSION['login_err']:null;
    // unset($_SESSION['login_err'])
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
</head>
<body>
    <div class="container">
        <section class="signup">
            <h2>ユーザー登録</h2>
            <?php if(isset($error['login_err'])): ?>
                <p><?php echo $login_err; ?></p>
            <?php endif; ?>
            <form action ="../view/register.php" method="POST">
                <div class="form-item">
                  <label for="name">name</label>
                  <input type="text" name="name">
                </div>
                <div class="form-item">
                  <label for="email">Email</label>
                  <input type="email" name="email">
                </div>
                <div class="form-item">
                  <label for="pass">Password</label>
                  <input type="password" name="pass">
                </div>
                <div class="form-item">
                  <label for="password">Password(Confirmation)</label>
                  <input type="password" name="pass_conf">
                </div>
                <div class="form-submit">
                    <input type="submit" value="Register">
                </div>
            </form>
        </section>
    </div>
</body>
</html>
