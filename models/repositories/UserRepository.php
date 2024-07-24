<?php

namespace app\models\repositories;

use app\axis\database\DataBaseConnect;
use app\models\entities\UserEntity as User;
use app\axis\https\Redirect;

require_once 'interfaces/models/repositories/IUserRepository.php';

/**
 * Class UserRepository
 * 
 * Implements the IUserRepository interface for managing users in the database.
 */
class UserRepository implements IUserRepository {

    /**
     * @var \PDO The PDO instance for database interaction.
     */
    private $pdo;

    /**
     * UserRepository constructor.
     * 
     * @param \PDO|null $pdo Optional PDO instance.
     */
    public function __construct($pdo = null)
    {
        if ($pdo === null) {
            $dbConnect = new DataBaseConnect();
            $this->pdo = $dbConnect->getPDO();
        } else {
            $this->pdo = $pdo;
        }
    }
  
    /**
     * Register a user.
     * 
     * @param User $user The user entity to register.
     * @return bool $result True on success, false on failure.
     */
    public function signup(User $user): bool {
        $result = false;
        $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';

        // Putting user data into an array
        $arr = [];
        $arr[] = $user->getName();
        $arr[] = $user->getEmail();
        $arr[] = password_hash($user->getPassword(), PASSWORD_DEFAULT);

        try {    
            $this->pdo->beginTransaction();
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute($arr);
            $this->pdo->commit();
            $result = true;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            error_log($e, 3, '/log/error.log');
        } finally {
            return $result;
        }
    }

    /**
     * Sign in a user.
     * 
     * @param User $user The user entity for sign-in.
     * @return bool $result True on success, false on failure.
     */
    public function signin(User $user): bool {
        $result = false;

        $email = $user->getEmail();
        $password = $user->getPassword();

        // Retrieve user by searching email
        $user_data = $this->getUserByEmail($email);

        if (!$user_data) {
            $_SESSION['msg'] = 'E-mail does not match.';
            return $result;
        }

        // Password verification
        if (password_verify($password, $user_data['password'])) {
            session_regenerate_id(true);
            $_SESSION['signin_user'] = $user_data;
            $result = true;
            return $result;
        }
        $_SESSION['msg'] = $password;

        return $result;
    }

    /**
     * Get user data by email.
     * 
     * @param string $email The email of the user.
     * @return array|bool $user The user data or false on failure.
     */
    public function getUserByEmail(string $email)
    {
        $sql = 'SELECT * FROM users WHERE email = ?';
        $arr = [];
        $arr[] = $email;

        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($arr);
            $user = $stmt->fetch();
            return $user;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Check if the user is signed in.
     * 
     * @return bool $result True if signed in, false otherwise.
     */
    public function checkSign(): bool {
        $result = false;

        // True if there is 'signin_user' in the session
        if (isset($_SESSION['signin_user']) && $_SESSION['signin_user']['id'] > 0) {
            $result = true;
        }
        return $result;
    }

    /**
     * Sign out the user.
     * 
     * @return void
     */
    public function signout(): void {
        $_SESSION = [];
        session_destroy();
        // Back to sign-in page
        Redirect::to('signin');
    }
}
