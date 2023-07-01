
<?php
  require_once '../../util/fragile.php';
  require_once '../../models\Concert.php';
  $models = new Concert();
  $concerts = $models->show();
  define('MAX','10'); // show data per page  
  $concert_count = count($concerts); // Total data
  $max_page = ceil($concert_count / MAX); // Total pages
  $now = !isset($_GET['page_id'])? 1: $_GET['page_id']; //What number?
  $start_no = ($now - 1) * MAX; // What number of the array should I get it from?
  $disp_data = array_slice($concerts, $start_no, MAX, true); // array_slice
?>
<?php include('pages/layouts/header.php'); ?>
<div class="wrapper">
    <h2 class="text-center">Concerts</h2>
    <div class="text-right"><a href="../artist/create_form.php">Go artist list</a></div>
    <div class="text-right  my-2">
        <a class="crud-create" href="../concert/create_form.php">Add a Concert Record</a>
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
                <?php foreach ($disp_data as $concert){?>
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
        <a href="/the-elephant-in-the-room/pages/concert?page_id=<?php echo $i; ?>" > <?php echo  $i ?></a>
        <?php }?>
    </div>
</div>
<?php include('pages/layouts/footer.php'); ?>
