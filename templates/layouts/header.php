<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>/public/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>/public/assets/css/script-styles.css">
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>/public/assets/css/common.css">
    <script type="text/javascript" src="<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>/public/assets/js/script.js" defer></script>
    <title>The-elephant-in-the-room</title>
</head>
<body>
<header>
    <div id="title">
      the-elephant-in-the-room
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
            <li class="nav-item"><a class="nav-item" href="<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>">TOP</a></li>
            <?php if (!isset($_SESSION['signin_user'])) : ?>
                <li class="nav-item"><a class="nav-item" href="<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>/signin">Signin</a></li>
                <li class="nav-item"><a class="nav-item" href="<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>/signup">Signup</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-item" href="<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>/index">My Page</a></li>
                <li class="nav-item flex-box justify-center">
                    <form action="<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>/signout" method="POST">
                        <input type="submit" name="signout" class="input-init" value="Signout" style="font-size:21px; cursor: pointer;">
                    </form>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>