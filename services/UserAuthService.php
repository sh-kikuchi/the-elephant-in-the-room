<?php
namespace app\services;

use app\models\repositories\UserAuth;
use app\classes\UserAuthRequest;
use app\anchor\toolbox\Session;
use app\anchor\toolbox\File;
use app\anchor\toolbox\Mail;
use app\anchor\toolbox\PDF;

require_once 'anchor\toolbox\functions\fragile.php';
require_once 'anchor\toolbox\functions\pagination.php';
require_once 'assets/pdf/test.php';

require_once 'interfaces\services\IUserAuthService.php';
class UserAuthService implements IUserAuthServiceInterface {

    public function __construct() {
        $session  = new Session;
    }

    public function my_page(){
        $result = UserAuth::checkSign();
        if (!$result) {
            $_SESSION['signin_err'] = 'Please sign in.';
            header('Location:/the-elephant-in-the-room/signin');
        return;
        }
        $signin_user = $_SESSION['signin_user'];
    
        include "templates/user_auth/my_page.php";
    }

    public function complete(){
        $result = UserAuth::checkSign();
        if (!$result) {
            $_SESSION['signin_err'] = 'Please sign in.';
            header('Location:/the-elephant-in-the-room/signin');
        return;
        }
        $signin_user = $_SESSION['signin_user'];
    
        include "templates/user_auth/complete.php";
    }

    public function signup_form(){
        $repositories = new UserAuth();
        $result = $repositories->checkSign();
        if($result) {
            header('Location:/the-elephant-in-the-room/my_page');
            exit();
        }
        $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
        $old    = isset($_SESSION['old']) ? $_SESSION['old'] : null;
        unset($_SESSION['errors']);
        unset($_SESSION['old']);

        include "templates/user_auth/signup_form.php";
    }

    public function signup(){
        // Set variables.
        $paramPostData = $_POST;

        // Create an instance
        $user_auth    = new UserAuth();
        $user_request = new UserAuthRequest($paramPostData);

        // Validate post request data
        $user_request->signUpValidation();

        // Execute methods
        $result = $user_auth->signup($paramPostData);

        // Transitioning screen
        if($result){
            header('Location:/the-elephant-in-the-room/complete');
            exit();
        }else{
            header('Location:/the-elephant-in-the-room/error');
            exit();
        }
    }

    public function signin_form(){
        $result = UserAuth::checkSign();
        if($result) {
          header('Location:/the-elephant-in-the-room/my_page');
          return;
        }
        $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
        $old    = isset($_SESSION['old']) ? $_SESSION['old'] : null;
        unset($_SESSION['errors']);
        unset($_SESSION['old']);

        include "templates/user_auth/signin_form.php";
    }

    public function signin(){
        //Set variables.
        $paramPostData = $_POST;

        // Create an instance
        $user_auth    = new UserAuth();
        $user_request = new UserAuthRequest($paramPostData);

        // Validate post request data
        $user_request->signInValidation();

        // Execute methods
        $result = $user_auth->signin($paramPostData);

        //Transitioning screen
        if (!$result) {
            header('Location:/the-elephant-in-the-room/signin');
        }else{
            header('Location: /the-elephant-in-the-room/my_page');
        }
    }

    public function signout(){
        // Set variables
        $logout = filter_input(INPUT_POST, 'logout');

        // Create an instance
        $user_auth  = new UserAuth();

        // Execute methods
        $user_auth->signout();
    }

    public function mail(){
        $mail = new Mail();
        $mail->sendMail($_POST);
    }

    public function upload(){
        /*Execute methods
        Return processing results as required.
        */
        $file    = new File();
        $result = $file->uploadFile($_FILES);

        //Transitioning screen
        header('Location:/the-elephant-in-the-room/my_page');
        exit();
    } 

    public function pdf(){

        //Create an instance
        $file = new PDF();

        /*
            Execute methods
            Return processing results as required.
        */
        $file->output($html);
    } 

}