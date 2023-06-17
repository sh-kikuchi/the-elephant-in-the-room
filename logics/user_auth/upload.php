
<?php
  //Load other files.
  require_once 'classes/users/userAuth.php';
  require_once 'classes/rules/userRequest.php';

  //Create an instance
  $user_auth    = new UserAuth();
  $user_request = new UserRequest();

  //Validate post request data
  $user_request->fileValidation($_FILES);

  /*Execute methods
    Return processing results as required.
  */
  $result = $user_auth->uploadFile($_FILES);

  //Transitioning screen
  header('Location:/the-elephant-in-the-room/pages/signTest.php');

?>


