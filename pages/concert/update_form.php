<?php
  session_start();
  require_once '../../util/fragile.php';
  require_once '../../models/Concert.php';
  require_once '../../models/UserAuth.php';
  $models = new Concert();
  $concerts = $models->getConcert(intval($_GET["id"]));
  $result = UserAuth::checkSign();
  $signin_user = isset($_SESSION['signin_user']) ? $_SESSION['signin_user']: null;
  $errors      = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
  $old         = isset($_SESSION['old']) ? $_SESSION['old'] : null;
  unset($_SESSION['errors']);
  unset($_SESSION['old']);
?>
<?php include('../../page/layouts/header.php'); ?>
<div>
    <h2 class="text-center">Concert Master <br>EDIT</h2>
    <section class="flex-box justify-center">
        <form method="post" action="../../logics/concert/update.php">
            <?php foreach ($concerts as $concert){?>
                <div class="flex-box justify-center my-2">
                  <input hidden name="id" value="<?php echo h($concert["id"]);?>">
                </div>
                <div class="flex-box justify-center my-2">
                    <label for="name"  class="label">name</label>
                    <input 
                        name="name" 
                        class="form-input" 
                        placeholder="名前を入力"
                        value="<?php if($old){
                            echo h($old['concert_name']);
                        }else{
                            echo h($concert["concert_name"]);
                        }?>"
                    />
                </div>
                <div class="flex-box justify-center my-2">
                    <label for="date"  class="label">date</label>
                    <input 
                        type="text" 
                        name="date" 
                        class="form-input" 
                        value="<?php if($old){
                            echo h($old['date']);
                        }else{
                            echo h($concert["date"]);
                        }?>"
                    />
                </div>
                <div class="flex-box justify-center my-2">
                    <label for="place" class="label">place</label>
                    <input 
                        type="text" 
                        name="place" 
                        class="form-input" 
                        value="<?php if($old){
                            echo h($old['place']);
                        }else{
                            echo h($concert["place"]);
                        }?>"
                    />
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
                  <?php foreach ($concert['artists'] as $artist){?>
                  <tr>
                      <td>
                        <input type="checkbox" name="artist_id[]" value="<?php echo h($artist["id"]);?>" disabled>
                      </td>
                      <td>
                          <?php echo h($artist["name"]);?>
                      </td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>
            </div>
            <?php } ?>
            <div class="flex-box justify-center">
                <button type="submit" class="button primary">EDIT</button>
            </div>    
        </form>
    </section>
</div>
<?php include('../../page/layouts/footer.php'); ?>
