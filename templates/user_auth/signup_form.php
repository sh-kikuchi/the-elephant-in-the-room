<?php include('templates/layouts/header.php') ?>
<div class="wrapper">
    <?php if (isset($errors)) : ?>
      <ul>
      <?php foreach($errors as $error) {?>
        <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
      <?php }?>
      </ul>
    <?php endif; ?>
    <h2 class="text-center pt-2">Sign-up</h2>
    <section class="flex-box justify-center">
        <form action=<?php echo Path::ROOT."signup" ?> method="POST">
            <input type="hidden" name="csrf_token" value="<?php echo h(setToken()); ?>">
            <div class="flex-box justify-center my-2">
                <label for="name" class="label">Username：</label>
                <input type="text" name="name" class="form-input" value="<?php if($old){echo h($old['name']);}"}"?>">
            </div>
            <div class="flex-box justify-center my-2">
                <label for="email" class="label">E-mail：</label>
                <input type="email" name="email" class="form-input" value="<?php if($old){echo h($old['email']);}"}"?>">
            </div>
            <div class="flex-box justify-center my-2">
                <label for="password" class="label">Password：</label>
                <input type="password" name="password" class="form-input" value="<?php if($old){echo h($old['password']);}"}"?>">
            </div>
            <div class="flex-box justify-center my-2">
                <label for="password_conf" class="label">Pass-Confirm：</label>
                <input type="password" name="password_conf" class="form-input" value="<?php if($old){echo h($old['password_conf']);}"}"?>">
            </div>
            <div class="flex-box justify-center my-2">
                <input type="submit" value="Register" class="button primary">
            </div>
            <a href="./signin" class="text-center">Click here to sign in</a>
        </form>
    </section>
</div>
<?php include('templates/layouts/footer.php') ?>