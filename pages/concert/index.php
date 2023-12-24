<?php include('pages/layouts/header.php'); ?>
<div class="wrapper">
    <h2 class="text-center pt-2">Concerts</h2>
    <div class="text-left pl-2"><a href="<?php echo Path::ROOT . 'home' ?>">Home</a></div>
    <div class="text-right pr-2 my-2">
        <a class="crud-create" href="<?php echo Path::ROOT . 'concert/create' ?>">create a new concert</a>
    </div>
    <div class="flex-box justify-center">
        <table class="mx-3">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
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
                      <?php echo h($concert["name"]);?>
                    </td>
                    <td class="text-center">
                      <?php echo h($concert["place"]);?>
                    </td>
                    <td class="text-center">
                        <div class="flex-box justify-center">
                            <div>
                              <a class="crud-edit" href="<?php echo Path::ROOT . 'concert/update?id='. h($concert["id"]); ?>">EDIT</a>
                            </div>
                        </div>
                        <div>
                            <form method="POST" action="<?php echo Path::ROOT . 'concert/delete'; ?>">
                                <input hidden class="crud-form-input" name="id" value="<?php echo h($concert["id"]); ?>">
                                <input hidden name="delete" value="">
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
        <a class="pagenation" href="/the-elephant-in-the-room/concert?page_id=<?php echo $i; ?>" > <?php echo  $i ?></a>
        <?php }?>
    </div>
</div>
<?php include('pages/layouts/footer.php'); ?>
