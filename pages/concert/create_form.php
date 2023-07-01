<?php
    session_start();
    require_once '../../util/fragile.php';
    require_once '../../models/Artist.php';
    require_once '../../models/UserAuth.php';
    $models      = new Artist();
    $artists     = $models->show();
    $result      = UserAuth::checkSign();
    $signin_user = isset($_SESSION['signin_user']) ? $_SESSION['signin_user']: null;
    $errors      = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
    $old         = isset($_SESSION['old']) ? $_SESSION['old'] : null;
    unset($_SESSION['errors']);
    unset($_SESSION['old']);
?>
<?php include('pages/layouts/header.php') ?>
  <div class="crud-container">
  <div>
    <?php if (isset($errors)) : ?>
      <ul>
      <?php foreach($errors as $error) {?>
        <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
      <?php }?>
      </ul>
    <?php endif; ?>
    <h2 class="text-center">Concert Master <br>Registration</h2>
    <section class="flex-box justify-center">
      <form method="post" action="../../logics/concert/create.php">
       <input hidden name="user_id" class="crud-form-input" value="<?php echo h($signin_user['id']);?>">
        <div class="flex-box justify-center my-2">
          <label for="date" class="label">date</label>
          <input type = "date" name="date" class="form-input" value="<?php if($old){echo h($old['date']);}"}"?>">
        </div>
        <div class="flex-box justify-center my-2">
          <label for="name" class="label">name</label>
          <input name="name" class="form-input" placeholder="100字以内" value="<?php if($old){echo h($old['name']);}"}"?>">
        </div>
        <div class="flex-box justify-center my-2">
          <label for="place" class="label">place</label>
          <input name="place" class="form-input" placeholder="100字以内" value="<?php if($old){echo h($old['place']);}"}"?>">
        </div>
        <div class="flex-box justify-center my-2">
              <label for="artist" class="label">artist
              <p>
                <select id="list-num" onchange="change_table();">
                  <option value="" selected>all records</option>
                  <option value="3" selected>3 records</option>
                  <option value="5">5 records</option>
                  <option value="10">10 records</option>
                </select>
             </p>
              </label>
              <table id="list-table">
                <thead>
                  <tr>
                      <th></th>
                      <th>name</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($artists as $artist){?>
                  <tr>
                      <td>
                        <input 
                          type="checkbox" 
                          name="artist_id[]" 
                          value= <?php echo h($artist["id"]);?>
                          />
                      </td>
                      <td>
                          <?php echo h($artist["name"]);?>
                      </td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>
        </div>
        <div class="flex-box justify-center">
          <button type="submit" class="button primary">CREATE</button>
        </div>
      </form>
    </section>
  </div>
</div>
<?php include('pages/layouts/footer.php'); ?>
