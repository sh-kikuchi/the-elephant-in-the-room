
<?php
  require_once '../../class/users/userAuth.php';
  $user_auth = new UserAuth();
  $user_auth->sendMail($_POST);
?>
