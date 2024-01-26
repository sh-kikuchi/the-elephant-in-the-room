<?php require($_SERVER['DOCUMENT_ROOT'].'/the-elephant-in-the-room/templates/layouts/header.php') ?>
<div class="wrapper">
   <?php if (isset($errors)) : ?>
      <ul>
      <?php foreach($errors as $error) {?>
        <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
      <?php }?>
      </ul>
    <?php endif; ?>
    <h2 class="text-center pt-2">Posts</h2>
    <a class="pl-3" href="<?php echo Path::ROOT . 'post' ?>">BACK</a>
    <section class="flex-box justify-center">
      <form name ="post_create" method="post" action="<?php echo Path::ROOT . 'post/create' ?>">
        <input hidden name="csrf_token" value="<?php echo h($csrf); ?>">  
        <input hidden name="user_id" value="<?php echo h($signin_user["id"]);?>"> 
        <div class="flex-box">
          <label for="title" class="label">title</label>
          <input type="text" name="title" class="form-input" placeholder="100 words or less" value="<?php if($old){echo h($old['title']);}?>">
        </div>
        <div class="flex-box">
          <label for="body" class="label">body</label>
          <input type="text" name="body" class="form-input"  value="<?php if($old){echo h($old['body']);}"}"?>">
        </div>
        <div class="flex-box justify-center">
          <button type="submit" class="button primary">CREATE</button>
        </div>
      </form>
    </section>
</div>
<?php require($_SERVER['DOCUMENT_ROOT'].'/the-elephant-in-the-room/templates/layouts/footer.php') ?>
