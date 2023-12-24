<?php include('pages/layouts/header.php') ?>
<div class="wrapper">
    <?php if (isset($errors)) : ?>
        <ul>
            <?php foreach($errors as $error) {?>
              <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
            <?php }?>
        </ul>
    <?php endif; ?>
    <h2 class="text-center pt-2">Artist_Concert <br>Registration</h2>
    <a class="pl-3" href="<?php echo Path::ROOT . 'artist_concert' ?>">BACK</a>
    <section class="flex-box justify-center">
        <form method="post" action="<?php echo Path::ROOT . 'artist_concert/create' ?>">
            <input hidden name="user_id" class="crud-form-input" value="<?php echo h($signin_user['id']);?>">
            <div class="flex-box justify-center">
            <div class="my-2">
                <h3 class="text-center mb-3">Concerts</h3>
                <div style="width: 500px; height: 250px; overflow-y: scroll">
                <table id="list-table">
                    <thead>
                      <tr>
                          <th style="width: 50px"></th>
                          <th >name</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($concerts as $concert){?>
                      <tr>
                          <td>
                              <input 
                                type="radio" 
                                name="concert_id" 
                                value= <?php echo h($concert["id"]);?>
                                />
                          </td>
                          <td class="pa-1">
                              <?php echo h($concert["name"]);?>
                          </td>
                      </tr>
                      <?php }?>
                    </tbody>
                </table>
                      </div>
            </div>
            <div class="my-2 ml-1">
                <h3 class="text-center mb-3">Artists</h3>
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
                      </div>
            <div class="flex-box justify-center py-2">
                <button type="submit" class="button primary">MATCH</button>
            </div>
        </form>
    </section>
</div>
<?php include('pages/layouts/footer.php'); ?>
