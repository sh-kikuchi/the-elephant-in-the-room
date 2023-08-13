<?php
    session_start();
    require_once '../../util/fragile.php';
    require_once '../../models/Artist.php';
    require_once '../../models/UserAuth.php';
    $models = new Artist();
    $artists = $models->getArtist(intval($_GET["id"]));
    $result = UserAuth::checkSign();
    $signin_user = isset($_SESSION['signin_user']) ? $_SESSION['signin_user']: null;
    $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
    unset($_SESSION['errors']);
    unset($_SESSION['old']);
?>
<?php include('pages/layouts/header.php'); ?>
<div class="wrapper">
    <?php if (isset($errors)) : ?>
        <ul>
        <?php foreach($errors as $error) {?>
          <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
        <?php }?>
        </ul>
    <?php endif; ?>
    <h2 class="text-center pt-2">Artist Master<br>Edit</h2>
    <a class="pl-3" href="../artist">BACK</a>
    <section class="flex-box justify-center">
        <form method="post" action="../../logics/artist/update.php">
            <?php foreach ($artists as $artist){?>
                <input hidden name="id" value="<?php echo h($artist["id"]);?>">
                <div class="flex-box">
                    <label for="name" class="label">name</label>
                    <input class="form-input" name="name" placeholder="100字以内" value="<?php echo h($artist["name"]);?>">
                </div>
                <div class="flex-box">
                  <label for="debut" class="label">debut</label>
                  <input type="date" class="form-input" name="debut" value="<?php echo h($artist["debut"]);?>">
                </div>
                <div class="flex-box">
                  <label for="start_date" class="label">start date of activity</label>
                  <input type="date" class="form-input" name="start_date" value="<?php echo h($artist["start_date"]);?>">
                </div>
                <div class="flex-box">
                  <label for="end_date" class="label">end date of activity</label>
                  <input type="date" class="form-input" name="end_date" value="<?php echo h($artist["end_date"] = "0000-00-00"? '':$artist["end_date"]);?>">
                </div>
            <?php } ?>
           <div class="flex-box justify-center">
                <button type="submit" class="button primary">UPDATE</button>
            </div>
        </form>
    </section>
</div>
<?php include('pages/layouts/footer.php'); ?>
