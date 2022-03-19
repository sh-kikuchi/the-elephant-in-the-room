<?php include('../layout/header.php'); ?>
  <div class="crud-container">
  <div>
    <h2 class="crud-title">コメントを追加しましょう</h2>
    <section class="crud-form-contents">
      <form method="post" action="../crud_tutorial/crud/create.php">
        <div>
          <label for="name">お名前（ニックネーム可）</label>
          <input name="name" class="crud-form-input" placeholder="名前を入力">
        </div>
        <div>
          <label for="title">タイトル</label>
          <input name="title" class="crud-form-input" placeholder="タイトルを入力">
        </div>
        <div>
          <label for="comment">コメント</label>
          <textarea name="comment" class="crud-form-input" rows="10" cols="20" placeholder="150字以内で入力して下さい" maxlength=150 required></textarea>
        </div>
          <button type="submit" class="crud-form-submit">追加</button>
        </div>
      </form>
    </section>
  </div>
</div>
<?php include('../layout/footer.php'); ?>
