<?php
session_start();
$signin_user = isset($_SESSION['signin_user'])?$_SESSION['signin_user']:null;
?>
<?php include('pages/layouts/header.php'); ?>
<div class="wrapper">
      <h2 class="text-center pt-2 pb-2">experiment</h2>
      <section class="grid-two-block pa-3">
            <div>
                <section class="px-3 py-2">
                    <h3>1.Artists</h3>
                    <p>Create an artist master before creating a concert record.</p>
                    <div class="text-left pl-2"><a href="../pages/artist">Go</a></div>
                </section>
                <section class="px-3 py-2">
                    <h3>2.Concerts</h3>
                    <p>You can record the name of the concert, the artist and location, and the date. Artists must be master-registered in advance.</p>
                    <div class="text-left pl-2"><a href="../pages/concert">Go</a></div>
                </section>
                <section class="px-3 py-2">
                    <h3>3.Artist_Concert</h3>
                    <p>Junction table (many-to-many) for artists and concerts. This is where concert data and artist data are linked to create a live record.</p>
                    <div class="text-left pl-2"><a href="../pages/artist_concert">Go</a></div>
                </section>
            </div>
            <div>
                <section class="flex-box justify-center" >
                    <img src="../assets/img/home.png" style="width: 80%">
                </section>
            </div>
      </section>

</div>
<?php include('pages/layouts/footer.php'); ?>
