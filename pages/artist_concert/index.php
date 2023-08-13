
<?php
    session_start();
    require_once '../../util/fragile.php';
    require_once '../../util/pagination.php';
    require_once '../../models/ArtistConcert.php';
    $models     = new ArtistConcert();
    $showData   = $models->show();
    $pagination = paginate($showData, 10);
    $artists_concerts   = $pagination['data'];
    $max_page   = $pagination['max_page'];
    $signin_user = isset($_SESSION['signin_user'])?$_SESSION['signin_user']:null;
?>
<?php include('pages/layouts/header.php'); ?>
<div class="wrapper">
    <h2 class="text-center pt-2">LIVE RECORDS</h2>
    <div class="text-left pl-2"><a href="../home.php">Home</a></div>
    <div class="text-right pr-2 my-2">
        <a class="crud-create" href="../artist_concert/create_form.php">create a new concert</a>
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
                            <form method="POST" action="../../logics/artist_concert/delete.php">
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
        <a class="pagenation" href="/the-elephant-in-the-room/pages/artist_concert?page_id=<?php echo $i; ?>" > <?php echo  $i ?></a>
        <?php }?>
    </div>
</div>
<?php include('pages/layouts/footer.php'); ?>
