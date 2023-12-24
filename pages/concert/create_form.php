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
    <a class="pl-3" href="<?php echo Path::ROOT . 'concert' ?>">BACK</a>
    <section class="flex-box justify-center">
        <form method="post" action="<?php echo Path::ROOT . 'concert/create' ?>">
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
