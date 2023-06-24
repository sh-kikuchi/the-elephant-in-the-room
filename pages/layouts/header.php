

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/the-elephant-in-the-room/config/path.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'].'/the-elephant-in-the-room/config/label.php'); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/the-elephant-in-the-room/assets/css/style.css">
  <script type="text/javascript" src="/the-elephant-in-the-room/assets/js/script.js" defer></script>
  <title>The-elephant-in-the-room</title>
</head>
<body>
<header>
    <div id="title">
        <?php echo LABEL::HEADER['title'] ?>
    </div>
    <div id="menu">
        <div id="js-hamburger" class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <nav class="header-nav nav" id="js-nav">
        <ul class="nav-items">
            <li class="nav-item"><a class="nav-item" href=<?php echo Path::ROOT ?> >TOP</a></li>
            <li class="nav-item"><a class="nav-item" href=<?php echo Path::ROOT."pages/user_auth/signin_form.php" ?>>Signin</a></li>
            <li class="nav-item"><a class="nav-item" href=<?php echo Path::ROOT."pages/user_auth/signup_form.php" ?>>Signup</a></li>
        </ul>
    </nav>
</header>