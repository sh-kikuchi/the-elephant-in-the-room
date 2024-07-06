<?php

namespace app\services;

use app\axis\Service;
use app\axis\Template;
use app\axis\https\Redirect;
use app\axis\toolbox\Session;
use app\axis\toolbox\File;
use app\axis\toolbox\Mail;
use app\models\entities\UserEntity as User;
use app\models\repositories\UserRepository;
use app\form_classes\UserRequest;

/**
 * Class UserService
 *
 * @package app\services
 */
class UserService extends Service implements IUserService {

    /**
     * UserService constructor.
     */
    public function __construct() {
        $session  = new Session;
    }

    /**
     * Display the user's personal page.
     *
     * @return string The rendered template.
     */
    public function myPage() {
        $user_repository = new UserRepository();
        $result = $user_repository->checkSign();
        if (!$result) {
            $_SESSION['signin_err'] = 'Please sign in.';
            header('Location:' .  dirname($_SERVER['SCRIPT_NAME']) . '/signin');
            return;
        }
        $signin_user = $_SESSION['signin_user'];
    
        // Rendering
        $template = new Template(
            'user/index', [
                'signin_user' => $_SESSION['signin_user']
            ]
        );
        return $template->render();
    }

    /**
     * Show the sign-up form.
     *
     * @return string The rendered template.
     */
    public function showSignUpForm() {
        $user_repository = new UserRepository();
        $result = $user_repository->checkSign();
        if ($result) {
            Redirect::to('index');
            exit();
        }

        // Rendering
        $template = new Template(
            'user/form', [
                'csrf' => $this->setToken('signup'),
                'errors' => isset($_SESSION['errors']) ? $_SESSION['errors'] : null,
                'old' => isset($_SESSION['old']) ? $_SESSION['old'] : null,
                'form_name' => 'signup'
            ]
        );

        unset($_SESSION['errors']);
        unset($_SESSION['old']);

        return $template->render();
    }

    /**
     * Handle the sign-up process.
     *
     * @return bool
     */
    public function signup() {
        // Check token
        $checkTokenResult = $this->checkToken('signup');
        if (!$checkTokenResult) {
            echo 'Invalid token.';
            return false;
        }

        // Set variables & Create an instance
        $user = new UserRepository();
        $user_request = $this->makeUser($_POST);

        // Execute methods
        $result = $user->signup($user_request);

        // Transitioning screen
        if ($result) {
            Redirect::to('index');
            exit();
        } else {
            Redirect::error(500);
            exit();
        }
    }

    /**
     * Show the sign-in form.
     *
     * @return string The rendered template.
     */
    public function showSignInForm() {
        $user_repository = new UserRepository();
        $result = $user_repository->checkSign();
        if ($result) {
            Redirect::to('index');
            return;
        }

        // Rendering
        $template = new Template(
            'user/form', [
                'csrf' => $this->setToken('signin'),
                'errors' => isset($_SESSION['errors']) ? $_SESSION['errors'] : null,
                'old' => isset($_SESSION['old']) ? $_SESSION['old'] : null,
                'form_name' => 'signin'
            ]
        );

        unset($_SESSION['errors']);
        unset($_SESSION['old']);

        return $template->render();
    }

    /**
     * Handle the sign-in process.
     *
     * @return bool
     */
    public function signin() {
        // Check token
        $checkTokenResult = $this->checkToken('signin');
        if (!$checkTokenResult) {
            echo 'Invalid token.';
            return false;
        }

        // Set variables & Create an instance
        $user = new UserRepository();
        $user_request = $this->makeUser($_POST);

        // Execute methods
        $result = $user->signin($user_request);

        // Transitioning screen
        if (!$result) {
            Redirect::to('signin');
        } else {
            Redirect::to('index');
        }
    }

    /**
     * Handle the sign-out process.
     */
    public function signout() {
        // Set variables
        $logout = filter_input(INPUT_POST, 'logout');

        // Create an instance
        $user = new UserRepository();

        // Execute methods
        $user->signout();
    }

    /**
     * Handle sending mail.
     */
    public function mail() {
        $mail = new Mail();
        $mail->sendMail($_POST);
    }

    /**
     * Handle file upload.
     *
     * @return bool
     */
    public function upload() {
        // Execute methods
        // Return processing results as required.
        $file = new File();
        $result = $file->uploadFile($_FILES);

        // Transitioning screen
        Redirect::to('index');
        exit();
    } 

    /**
     * Create a User entity from the form data.
     *
     * @param array $user_form The form data.
     * @return User The User entity.
     */
    public function makeUser($user_form) {
        $user = new User();
        $user_request = new UserRequest($user_form);

        if ($user_request->getId() !== null) {
            $user->setId($user_request->getId());
        }
        $user->setId($user_request->getId());
        $user->setName($user_request->getName());
        $user->setEmail($user_request->getEmail());
        $user->setPassword($user_request->getPassword());
        
        return $user;
    }

}
