<?php
  //Load other files.
  require_once 'models/UserAuth.php';
  require_once 'assets/pdf/test.php';

  //Create an instance
  $user_auth = new UserAuth();

  /*
    Execute methods
    Return processing results as required.
  */
  $user_auth->output($html);
?>