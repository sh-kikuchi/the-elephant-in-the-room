<?php require('templates/layouts/header.php') ?>
<div class="wrapper">
    <?php if (isset($errors)) : ?>
      <ul>
      <?php foreach($errors as $error) {?>
        <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
      <?php }?>
      </ul>
    <?php endif; ?>
    <h2 class="text-center pt-2">Sign-in</h2>
    <section class="flex-box justify-center">
        <form name ="signin" action="/the-elephant-in-the-room/signin" method="POST">
          <input type="hidden" name="csrf_token" value="<?php echo h($csrf); ?>">  
          <div class="flex-box justify-center">
              <label for="email" class="label">E-mail:</label>
              <input type="email" name="email" class="form-input" value="<?php if($old){echo h($old['email']);}"}"?>">
            </div>
            <div class="flex-box justify-center">
              <label for="password" class="label">Password：</label>
              <input type="password" name="password" class="form-input" value="<?php if($old){echo h($old['password']);}"}"?>">
            </div>
            <div class="flex-box justify-center my-2">
              <input type="submit" class="button primary " value="Enter"> 
            </div>
            <a href="/the-elephant-in-the-room/signup" class="text-center">Click here to register as a new user.</a>
        </form>
    </section>
</div>
<?php require('templates/layouts/footer.php') ?>
