
<?php
  require_once '../../util/fragile.php';
  require_once '../../database/db_connect.php';
  $pdo = db_connect();

    try {
        //SQL文
        $sql  ="select * from comments order by updated_at desc;";
        //PDOのquery機能
        $comments = $pdo->query($sql);
    } catch(\Exception $e) {
      return false;
    }
?>
<?php include('../../layout/header.php'); ?>
  <div class="crud-container">
    <p class="crud-title">コメント一覧</p>
    <a class="crud-create" href="../crud_tutorial/create_form.php">コメントを追加する</a>
    <?php foreach ($comments as $comment){?>
    <div class="crud-card">
        <p class="crud-card-updated_at"><?php echo h($comment["updated_at"]);?></p>
        <h3 class="crud-card-title"> <?php echo h($comment["title"]);?></h3>
        <p class="crud-card-description"><?php echo h($comment["comment"]);?></p>

        <div class="crud-card-detail">
          <div>
              <a class="crud-edit" href="../crud_tutorial/update_form.php?id=<?php echo $comment["id"]; ?>">編集</a>
         </div>
          <div>
              <form name="id"  method="POST" action="../../function/crud_tutorial/delete.php">
                  <input hidden class="crud-form-input" name="id" value="<?php echo h($comment["id"]); ?>">
                  <button type="submit" class="crud-delete">削除</button>
              </form>
          </div>
    </div>
    </div>
  <?php }?>
</div>
<?php include('../../layout/footer.php'); ?>
