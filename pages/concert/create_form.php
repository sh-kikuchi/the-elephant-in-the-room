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
<div class="wrapper">
    <?php if (isset($errors)) : ?>
        <ul>
            <?php foreach($errors as $error) {?>
              <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
            <?php }?>
        </ul>
    <?php endif; ?>
    <h2 class="text-center pt-2">Concert <br>Registration</h2>
    <a class="pl-3" href="../concert">BACK</a>
    <section class="flex-box justify-center">
        <form method="post" action="../../logics/concert/create.php">
            <input hidden name="user_id" class="crud-form-input" value="<?php echo h($signin_user['id']);?>">
            <div class="flex-box justify-center my-2">
                <label for="date" class="label">date</label>
                <input type = "date" name="date" class="form-input" value="<?php if($old){echo h($old['date']);}"}"?>">
            </div>
            <div class="flex-box justify-center my-2">
                <label for="name" class="label">name</label>
                <input name="concert_name" class="form-input" placeholder="100 words or less" value="<?php if($old){echo h($old['concert_name']);}"}"?>">
            </div>
            <div class="flex-box justify-center my-2">
                <label for="place" class="label">place</label>
                <input name="place" class="form-input" placeholder="100 words or less" value="<?php if($old){echo h($old['place']);}"}"?>">
            </div>
            <div class="flex-box justify-center my-2">
                <label for="artist" class="label pl-2">artist
                    <p>
                        <select id="list-num" onchange="change_table();">
                            <option value="" selected>all records</option>
                            <option value="3">3 records</option>
                            <option value="5">5 records</option>
                            <option value="10">10 records</option>
                        </select>
                    </p>
                </label>
                <div style="width: 500px; height: 250px; overflow-y: scroll">
                <table id="list-table">
                    <thead>
                      <tr>
                          <th style="width: 50px"></th>
                          <th >name</th>
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
                          <td class="pa-1">
                              <?php echo h($artist["name"]);?>
                          </td>
                      </tr>
                      <?php }?>
                    </tbody>
                </table>
                      </div>
            </div>
            <div class="flex-box justify-center py-2">
                <button type="submit" class="button primary">CREATE</button>
            </div>
        </form>
    </section>
</div>
<?php include('pages/layouts/footer.php'); ?>
