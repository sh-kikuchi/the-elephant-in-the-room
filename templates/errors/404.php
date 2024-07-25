<?php include('templates/layouts/header.php'); ?>
<div class="container">
    <h1>404</h1>
    <p>Oops! The page you are looking for does not exist.</p>
    <a href="<?php echo dirname($_SERVER['SCRIPT_NAME']); ?>/">Go Back Home</a>
</div>
<?php include('templates/layouts/footer.php'); ?>