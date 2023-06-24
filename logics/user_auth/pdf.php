<?php
  require_once 'models/UserAuth.php';
  require_once 'assets/pdf/test.php';
  $user_auth = new UserAuth();
  $user_auth->output($html);
?>