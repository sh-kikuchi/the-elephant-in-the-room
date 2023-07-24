
<?php
  require_once 'models/UserAuth.php';
  $user_auth = new UserAuth();
  $user_auth->sendMail($_POST);
?>
