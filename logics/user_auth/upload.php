
<?php
    //Load other files.
    require_once 'models/UserAuth.php';
    require_once 'rules/UserRequest.php';

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
    header('Location:/the-elephant-in-the-room/pages/user_auth/my_page.php');
    exit();

?>



