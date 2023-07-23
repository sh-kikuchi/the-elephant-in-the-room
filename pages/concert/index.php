
<?php
  require_once '../../util/fragile.php';
  require_once '../../util/pagination.php';
  require_once '../../models\Concert.php';
  $models     = new Concert();
  $showData   = $models->show();
  $pagination = paginate($showData, 10);
  $concerts   = $pagination['data'];
  $max_page   = $pagination['max_page'];
?>
<?php include('pages/layouts/header.php'); ?>
<div class="wrapper">
    <h2 class="text-center pt-2">Concerts</h2>
    <div class="text-left pl-2"><a href="../home.php">Home</a></div>
    <div class="text-right pr-2 my-2">
        <a class="crud-create" href="../concert/create_form.php">create a new concert</a>
    </div>
    <div class="flex-box justify-center">
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Concert_name</th>
                    <th>Artist</th>
                    <th>Place</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($concerts as $concert){?>
                <tr>
                    <td class="text-center">
                      <?php echo h($concert["date"]);?>
                    </td>
                    <td class="text-center">
                      <?php echo h($concert["concert_name"]);?>
                    </td>
                    <td class="text-center">
                      <?php echo h($concert["artist_name"]);?>
                    </td>
                    <td class="text-center">
                      <?php echo h($concert["place"]);?>
                    </td>
                    <td class="text-center">
                        <div class="flex-box justify-center">
                            <div>
                              <a class="crud-edit" href="../concert/update_form.php?id=<?php echo h($concert["id"]); ?>">EDIT</a>
                            </div>
                        </div>
                        <div>
                            <form method="POST" action="../../logics/concert/delete.php">
                                <input hidden class="crud-form-input" name="id" value="<?php echo h($concert["id"]); ?>">
                                <button type="submit" class="crud-delete">DELETE</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
    <!--pagenation-->
    <div class="flex-box justify-center my-2">
        <?php for($i = 1; $i <= $max_page; $i++){?>
        <a class="pagenation" href="/the-elephant-in-the-room/pages/concert?page_id=<?php echo $i; ?>" > <?php echo  $i ?></a>
        <?php }?>
    </div>
</div>
<?php include('pages/layouts/footer.php'); ?>
