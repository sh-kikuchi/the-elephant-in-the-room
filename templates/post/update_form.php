<?php include('templates/layouts/header.php'); ?>
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
        <form name="post_update" method="post"  action="<?php echo Path::ROOT . 'post/update' ?>">
            <input hidden name="csrf_token" value="<?php echo h($csrf); ?>">  
            <?php foreach ($posts as $post){?>
                <input hidden name="id" value="<?php echo h($post["id"]);?>">
                <div class="flex-box">
                    <label for="title" class="label">title</label>
                    <input class="form-input" name="title" placeholder="100字以内" value="<?php echo h($post["title"]);?>">
                </div>
                <div class="flex-box">
                  <label for="body" class="label">body</label>
                  <input type="text" class="form-input" name="body" value="<?php echo h($post["body"]);?>">
                </div>
            <?php } ?>
           <div class="flex-box justify-center">
                <button type="submit" class="button primary">UPDATE</button>
            </div>
        </form>
    </section>
</div>
<?php include('templates/layouts/footer.php'); ?>
