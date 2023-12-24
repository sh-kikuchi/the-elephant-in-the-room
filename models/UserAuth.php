<?php

namespace app\models;

use app\database\DataBaseConnect;

require_once 'interfaces\models\IUserAuth.php';

class UserAuth implements IUserAuth {

    /**
     * Register a user
     * @param array $userData
     * @return bool $result
     */
    public static function signup($userData):bool {
        $result    = false;
        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql       = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';

        // putting user data into an array
        $arr   = [];
        $arr[] = $userData['name'];
        $arr[] = $userData['email'];
        $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT);

        try {    
          $pdo->beginTransaction();
          $stmt   = $pdo->prepare($sql);
          $result = $stmt->execute($arr);
          $pdo->commit();
          $result = true;
        } catch(\Exception $e) {
          $pdo->rollBack();
          error_log($e, 3, '/the-elephant-in-the-room/log/error.log');
        }finally{
          return $result;
        }
    }
    /**
     * Sign in
     * @param string $email
     * @param string $password
     * @return bool $result
     */
    public static function signin(array $userData) :bool
    {
        $result = false;
        $email    = $userData['email'];
        $password = $userData['password'];
        // retrieve users by searching email
        $user = self::getUserByEmail($email);

        if (!$user) {
            $_SESSION['msg'] = 'e-mail does not match.';
            return $result;
        }
        // password enquiry
        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['signin_user'] = $user;
            $result = true;
            return $result;
        }
        $_SESSION['msg'] =  $password;


        return $result;
    }
    /**
     * Get User Data By Email
     * @param string $email
     * @return array|bool $user|false
     */
    public static function getUserByEmail(string $email)
    {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $dbConnection = new DataBaseConnect();
        $pdo = $dbConnection->getPDO();

        $arr = [];
        $arr[] = $email;
        try {
          $stmt = $pdo->prepare($sql);
          $stmt->execute($arr);
          $user = $stmt->fetch();
          return $user;
        } catch(\Exception $e) {
          return false;
        }
    }
    /**
     * Sign-in Check
     * @param void
     * @return bool $result
     */
    public static function checkSign():bool
    {
      $result = false;
      // true if there is 'signin_user' in the session
      if (isset($_SESSION['signin_user']) && $_SESSION['signin_user']['id'] > 0) {
        $result = true;
      }
      return $result;
    }
    /**
     * Signout
     * @param void
     * @return void
     */
    public static function signout():void{
        session_destroy();
        //Back to Sign-in Page.
        header('Location: /the-elephant-in-the-room/signin');
    }
}
