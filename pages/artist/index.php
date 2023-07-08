
<?php
  require_once '../../util/fragile.php';
  require_once '../../util/pagination.php';
  require_once '../../models/Artist.php';
  $models     = new Artist();
  $showData   = $models->show();
  $pagination = paginate($showData, 10);
  $artists    = $pagination['data'];
  $max_page   = $pagination['max_page'];
?>
<?php include('pages/layouts/header.php'); ?>
<div class="wrapper">
    <h2 class="text-center">Artists</h2>
    <div class="text-right"><a href="../artist/create_form.php">add an artist</a></div>
    <?php foreach ($artists as $artist){?>
    <div class="crud-card">
        <p class="crud-card-updated_at"><?php echo h($artist["updated_at"]);?></p>
        <h3 class="crud-card-title"> <?php echo h($artist["name"]);?></h3>
        <p class="crud-card-description"><?php echo h($artist["debut"]);?></p>
        <div class="crud-card-detail">
          <div>
              <a class="crud-edit " href="../artist/update_form.php?id=<?php echo $artist["id"]; ?>">EDIT</a>
         </div>
          <div>
              <form name="id"  method="POST" action="../../logics/artist/delete.php">
                  <input hidden name="id" value="<?php echo h($artist["id"]); ?>">
                  <button type="submit" class="crud-delete">DELETE</button>
              </form>
          </div>
        </div>
    </div>
    <?php }?>
    <!--pagenation-->
    <div class="flex-box justify-center my-2">
      <?php for($i = 1; $i <= $max_page; $i++){?>
        <a href="/the-elephant-in-the-room/pages/artist?page_id=<?php echo $i; ?>" > <?php echo  $i ?></a>
      <?php }?>
    </div>
</div>
<?php include('pages/layouts/footer.php'); ?>
