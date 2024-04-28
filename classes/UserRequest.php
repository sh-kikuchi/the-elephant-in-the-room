<?php
namespace app\classes;

use app\axis\toolbox\Session;
use app\axis\https\Validator;

require_once 'interfaces\classes\IUserRequest.php';

class UserRequest implements IUserRequest{
    protected int    $id;
    protected string $name;
    protected string $email;
    protected string $password;
    protected string $password_conf;
    protected string $csrf_token;

    /** constructor */
    function __construct(?array $data){
        $this->id            = $data['id']            ?? 0;
        $this->name          = $data['name']          ?? '';
        $this->email         = $data['email']         ?? '';
        $this->password      = $data['password']      ?? '';
        $this->password_conf = $data['password_conf'] ?? '';
        $this->csrf_token    = $data['csrf_token']    ?? '';
	}

    /** setter */
    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setPasswordConf($password_conf) {
        $this->password_conf = $password_conf;
    }

    public function setCsrfToken($csrf_token) {
        $this->csrf_token = $csrf_token;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPasswordConf() {
        return $this->password_conf;
    }

    public function getCsrfToken() {
        return $this->csrf_token;
    }

    public function getArrayData() {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'password'      => $this->password,
            'password_conf' => $this->password_conf,
            'csrf_token'    => $this->csrf_token
        ];
    }

    /**
     * Validate POST data for sign-in
     * @param array $postData
     * @return $void
     */
    public function signInValidation(){
        unset($_SESSION['errors']);
        $validator       = new Validator;
        $session         = new Session;

        $errors = [];
        $email         = $this->email;
        $password      = $this->password;
        $csrf_token    = $this->csrf_token;

        $validator->required($email,'email');
        $validator->required($password,'password'); 

        if (!isset($_SESSION['csrf_token']) || $csrf_token !== $_SESSION['csrf_token']) {
            array_push($errors,'Invalid request.');
        }

        
        if ($errors !== [] &&  count($errors) > 0) {
            $_SESSION['errors'] = $errors;       
            header('Location: /the-elephant-in-the-room/signin');
            exit();
        }
  
        return $this->getArrayData();
    }
    /**
     * Validate POST data for sign-up
     * @param array $postData
     * @return $void
     */
    public function signUpValidation(){
        unset($_SESSION['errors']);
        $validator       = new Validator;
        $session         = new Session;

        $errors        = [];

        $name          = $this->name;
        $email         = $this->email;
        $password      = $this->password;
        $password_conf = $this->password_conf;
        $csrf_token    = $this->csrf_token;

        $validator->required($name,'name');
        $validator->required($email,'email');
        $validator->mailFormat($email,'email');
        $validator->passwordFormat($password,'password');
        $validator->passwordFormat($password, $password_conf);

        $errors = $validator->getErrors();

        if (!isset($_SESSION['csrf_token']) || $csrf_token !== $_SESSION['csrf_token']) {
            array_push($errors,'Invalid request.');
        }

        if ($errors !== [] &&  count($errors) > 0) {
            $_SESSION['errors'] = $errors;        
            $session->oldPostValue($targetData);
            header('Location: /the-elephant-in-the-room/signup');
            exit();
        }

        return $this->getArrayData();
    }
}
?>
