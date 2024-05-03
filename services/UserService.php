<?php
namespace app\services;

use app\axis\Service;
use app\axis\Template;
use app\axis\toolbox\Session;
use app\axis\toolbox\File;
use app\axis\toolbox\Mail;
use app\models\entities\UserEntity as User;
use app\models\repositories\UserRepository;
use app\classes\UserRequest;

class UserService extends Service implements IUserService {

    public function __construct() {
        $session  = new Session;
    }

    public function myPage(){
        $user_repository = new UserRepository();
        $result = $user_repository->checkSign();
        if (!$result) {
            $_SESSION['signin_err'] = 'Please sign in.';
            header('Location:/the-elephant-in-the-room/signin');
        return;
        }
        $signin_user = $_SESSION['signin_user'];
    
        // rendering
        $template = new Template(
            'user/my_page', [
                'signin_user'   =>  $_SESSION['signin_user']
            ]
        );
        return $template->render();
    }

    public function signupForm(){
        $user_repository = new UserRepository();
        $result = $user_repository->checkSign();
        if($result) {
            header('Location:/the-elephant-in-the-room/my_page');
            exit();
        }

        // rendering
        $template = new Template(
            'user/signup_form', [
                'csrf'         => $this->setToken('signup'),
                'errors'      => isset($_SESSION['errors']) ? $_SESSION['errors'] : null,
                'old'         => isset($_SESSION['old']) ? $_SESSION['old'] : null
            ]
        );

        unset($_SESSION['errors']);
        unset($_SESSION['old']);

        return $template->render();
    }

    public function signup(){
        //check_token
        $checkTokenResult = $this->checkToken('signup');
        if(!$checkTokenResult){
            echo 'Invalid token.';
            return false;
        }

        // Set variables & Create an instance
        $user         = new UserRepository();
        $user_request = $this->makeUser($_POST);

        // Execute methods
        $result = $user->signup($user_request);

        // Transitioning screen
        if($result){
            header('Location:/the-elephant-in-the-room/my_page');
            exit();
        }else{
            header('Location:/the-elephant-in-the-room/error');
            exit();
        }
    }

    public function signinForm(){
        $user_repository = new UserRepository();
        $result = $user_repository->checkSign();

        if($result) {
          header('Location:/the-elephant-in-the-room/my_page');
          return;
        }

        // rendering
        $template = new Template(
            'user/signin_form', [
                'csrf'         => $this->setToken('signin'),
                'errors'      => isset($_SESSION['errors']) ? $_SESSION['errors'] : null,
                'old'         => isset($_SESSION['old']) ? $_SESSION['old'] : null
            ]
        );

        unset($_SESSION['errors']);
        unset($_SESSION['old']);

        return $template->render();
    }

    public function signin(){

        //check_token
        $checkTokenResult = $this->checkToken('signin');

        if(!$checkTokenResult){
            echo 'Invalid token.';
            return false;
        }

        // Set variables & Create an instance
        $user         = new UserRepository();
        $user_request = $this->makeUser($_POST);

        // Execute methods
        $result = $user->signin($user_request);

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
        $user  = new UserRepository();

        // Execute methods
        $user->signout();
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

    public function makeUser($user_form){

        $user = new User();
        $user_request = new UserRequest($user_form);

        if($user_request->getId() !== null){
            $user->setId($user_request->getId());
        }
        $user->setId($user_request->getId());
        $user->setName($user_request->getName());
        $user->setEmail($user_request->getEmail());
        $user->setPassword($user_request->getPassword());
        
        return $user;
    }

}