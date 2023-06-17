
<?php
  require_once 'classes/users/userAuth.php';
  $user_auth = new UserAuth();
  $user_auth->sendMail($_POST);
?>
