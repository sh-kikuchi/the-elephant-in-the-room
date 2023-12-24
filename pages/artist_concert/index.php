<?php include('pages/layouts/header.php'); ?>
<div class="wrapper">
    <h2 class="text-center pt-2">LIVE RECORDS</h2>
    <div class="text-left pl-2"><a href="<?php echo Path::ROOT . 'home' ?>">Home</a></div>
    <div class="text-right pr-2 my-2">
        <a class="crud-create" href="<?php echo Path::ROOT . 'artist_concert/create' ?>">create a new concert</a>
    </div>
    <div class="flex-box justify-center">
        <table class="mx-3">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Concert_name</th>
                    <th>Artist_name</th>
                    <th>Place</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artists_concerts as $artist_concert){?>
                <tr>
                    <td class="text-center">
                      <?php echo h($artist_concert["date"]);?>
                    </td>
                    <td class="text-center">
                      <?php echo h($artist_concert["concert_name"]);?>
                    </td>
                    <td class="text-center">
                      <?php echo h($artist_concert["artist_name"]);?>
                    </td>
                    <td class="text-center">
                      <?php echo h($artist_concert["place"]);?>
                    </td>
                    <td class="text-center">
                        <div>
                            <form method="POST" action="<?php echo Path::ROOT . 'artist_concert/delete' ?>">
                                <input hidden class="crud-form-input" name="concert_id" value="<?php echo h($artist_concert["concert_id"]); ?>">
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
        <a class="pagenation" href="/the-elephant-in-the-room/artist_concert?page_id=<?php echo $i; ?>" > <?php echo  $i ?></a>
        <?php }?>
    </div>
</div>
<?php include('pages/layouts/footer.php'); ?>
