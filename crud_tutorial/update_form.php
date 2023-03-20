<?php
//h
  require_once '../util/fragile.php';
//DB接続設定
  require_once '../database/db_connect.php';
  $pdo = db_connect();

  //URLから値を受け取る（GET送信）
  $id = intval($_GET["id"]);

  //SQL文
  $sql  ="SELECT *
          FROM comments
          WHERE id = $id
          ORDER BY updated_at desc;";

  //PDOのquery機能
  $comments = $pdo->query($sql);
?>
<?php include('../layout/header.php'); ?>
<!-- 下記は<body>タグの中身 -->
<div class="crud-container">
    <h2 class="crud-title">コメントを編集します</h2>
    <section class="crud-form-contents">
        <?php foreach ($comments as $comment){?>
        <form method="post" action="../crud_tutorial/crud/update.php">
            <div>
              <input hidden name="id" value="<?php echo h($comment["id"]);?>">
            <div>
              <label for="title">タイトル</label>
              <input name="title" class="crud-form-input" placeholder="名前を入力" value="<?php echo h($comment["title"]);?>">
            </div>
            <div>
              <label for="comment">コメント</label>
              <textarea name="comment" class="crud-form-input" rows="10" cols="20"><?php echo h($comment["comment"]);?></textarea>
            </div>
              <button type="submit" class="crud-form-submit">編集</button>
            </div>
      </form>
      <?php } ?>
    </section>
</div>
<?php include('../layout/footer.php'); ?>
