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
<?php include('pages/layouts/header.php'); ?>
<div class="wrapper">
    <?php if (isset($errors)) : ?>
        <ul>
            <?php foreach($errors as $error) {?>
              <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
            <?php }?>
        </ul>
    <?php endif; ?>
    <h2 class="text-center pt-2">Concert <br> EDIT</h2>
    <a class="pl-3" href="../concert">BACK</a>
    <section class="flex-box justify-center">
        <form method="post" action="../../logics/concert/update.php">
            <?php foreach ($concerts as $concert){?>
                <div class="flex-box justify-center my-2">
                  <input hidden name="id" value="<?php echo h($concert["id"]);?>">
                </div>
                <div class="flex-box justify-center my-2">
                    <label for="name"  class="label">name</label>
                    <input 
                        name="concert_name" 
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
            <table style="width: 500px">
                <thead>
                    <tr>
                        <th style="width: 50px">id</th>
                        <th >name</th>
                    <tr>
                </thead>
                <tbody>
                  <?php foreach ($concert['artists'] as $artist){?>
                  <tr>
                      <td class="text-center">
                        <?php echo h($artist["id"]); ?>
                        <input hidden type="checkbox" name="artist_id[]" value="<?php echo h($artist["id"]);?>" checked>
                      </td>
                      <td class="pl-1">
                          <?php echo h($artist["name"]);?>
                      </td>
                  </tr>
                  <?php }?>
                </tbody>
              </table>
            </div>
            <?php } ?>
            <div class="flex-box justify-center py-2">
                <button type="submit" class="button primary">EDIT</button>
            </div>    
        </form>
    </section>
</div>
<?php include('pages/layouts/footer.php'); ?>
