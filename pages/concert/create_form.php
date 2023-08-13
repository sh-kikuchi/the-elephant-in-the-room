<?php
    session_start();
    require_once '../../util/fragile.php';
    require_once '../../models/Artist.php';
    require_once '../../models/UserAuth.php';
    $models      = new Artist();
    $artists     = $models->show();
    $result      = UserAuth::checkSign();
    $signin_user = isset($_SESSION['signin_user']) ? $_SESSION['signin_user']: null;
    $errors      = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
    $old         = isset($_SESSION['old']) ? $_SESSION['old'] : null;
    unset($_SESSION['errors']);
    unset($_SESSION['old']);
?>
<?php include('pages/layouts/header.php') ?>
<div class="wrapper">
    <?php if (isset($errors)) : ?>
        <ul>
            <?php foreach($errors as $error) {?>
              <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
            <?php }?>
        </ul>
    <?php endif; ?>
    <h2 class="text-center pt-2">Concert <br>Registration</h2>
    <a class="pl-3" href="../concert">BACK</a>
    <section class="flex-box justify-center">
        <form method="post" action="../../logics/concert/create.php">
            <input hidden name="user_id" class="crud-form-input" value="<?php echo h($signin_user['id']);?>">
            <div class="flex-box justify-center my-2">
                <label for="date" class="label">date</label>
                <input type = "date" name="date" class="form-input" value="<?php if($old){echo h($old['date']);}"}"?>">
            </div>
            <div class="flex-box justify-center my-2">
                <label for="name" class="label">name</label>
                <input name="name" class="form-input" placeholder="100 words or less" value="<?php if($old){echo h($old['name']);}"}"?>">
            </div>
            <div class="flex-box justify-center my-2">
                <label for="place" class="label">place</label>
                <input name="place" class="form-input" placeholder="100 words or less" value="<?php if($old){echo h($old['place']);}"}"?>">
            </div>
            <div class="flex-box justify-center py-2">
                <button type="submit" class="button primary">CREATE</button>
            </div>
        </form>
    </section>
</div>
<?php include('pages/layouts/footer.php'); ?>
