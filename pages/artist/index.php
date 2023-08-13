
<?php
    session_start();
    require_once '../../util/fragile.php';
    require_once '../../util/pagination.php';
    require_once '../../models/Artist.php';
    $models     = new Artist();
    $showData   = $models->show();
    $pagination = paginate($showData, 10);
    $artists    = $pagination['data'];
    $max_page   = $pagination['max_page'];
    $errors      = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
    unset($_SESSION['errors']);
?>
<?php include('pages/layouts/header.php'); ?>
<div class="wrapper px-2">
    <?php if (isset($errors)) : ?>
        <ul>
            <?php foreach($errors as $error) {?>
                <li class="text-center" style="list-style:none;"><?php echo h($error);?></li>
            <?php }?>
        </ul>
    <?php endif; ?>
    <h2 class="text-center pt-2">Artists</h2>
    <div class="text-left pl-2"><a href="../home.php">Home</a></div>
    <div class="text-right"><a href="../artist/create_form.php">create a new artist</a></div>
    <div class="flex-box justify-center">
        <table class="mx-3">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Debut</th>
                    <th>Updated_at</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($artists as $artist){?>
                <tr>
                    <td class="text-center">
                      <?php echo h($artist["name"]);?>
                    </td>
                    <td class="text-center">
                      <?php echo h($artist["debut"]);?>
                    </td>
                    <td class="text-center">
                      <?php echo h($artist["updated_at"]);?>
                    </td>
                    <td class="text-center">
                        <div class="flex-box justify-center">
                            <div>
                                <a class="crud-edit " href="../artist/update_form.php?id=<?php echo $artist["id"]; ?>">EDIT</a>
                            </div>
                        </div>
                        <div>
                            <form name="id"  method="POST" action="../../logics/artist/delete.php">
                                <input hidden name="id" value="<?php echo h($artist["id"]); ?>">
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
            <a 
                class="pagenation"
                href="/the-elephant-in-the-room/pages/artist?page_id=<?php echo $i; ?>" 
            > <?php echo  $i ?></a>
        <?php }?>
    </div>
</div>
<?php include('pages/layouts/footer.php'); ?>