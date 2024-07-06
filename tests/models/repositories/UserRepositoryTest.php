<?php

use PHPUnit\Framework\TestCase;
use app\models\repositories\UserRepository;
use app\models\entities\UserEntity as User;
//use PDO;
//use PDOStatement;

class UserRepositoryTest extends TestCase
{
    private $pdo;
    private $userRepository;
    private $user;

    protected function setUp(): void
    {
        $this->pdo = $this->createMock(PDO::class);
        $this->userRepository = new UserRepository($this->pdo);
        $this->user = $this->createMock(User::class);
    }

    public function testSignup()
    {
        $this->user->method('getName')->willReturn('Test User');
        $this->user->method('getEmail')->willReturn('test@example.com');
        $this->user->method('getPassword')->willReturn('password');

        $statement = $this->createMock(PDOStatement::class);
        $statement->expects($this->once())->method('execute')->willReturn(true);

        $this->pdo->method('prepare')->willReturn($statement);
        $this->pdo->expects($this->once())->method('beginTransaction');
        $this->pdo->expects($this->once())->method('commit');

        $result = $this->userRepository->signup($this->user);
        $this->assertTrue($result);
    }

    public function testSignin()
    {
        $this->user->method('getEmail')->willReturn('test@example.com');
        $this->user->method('getPassword')->willReturn('password');

        $user_data = [
            'id' => 1,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => password_hash('password', PASSWORD_DEFAULT)
        ];

        $statement = $this->createMock(PDOStatement::class);
        $statement->method('fetch')->willReturn($user_data);
        $statement->method('execute')->willReturn(true);

        $this->pdo->method('prepare')->willReturn($statement);

        $_SESSION = [];

        $result = $this->userRepository->signin($this->user);
        $this->assertTrue($result);
        $this->assertArrayHasKey('signin_user', $_SESSION);
        $this->assertEquals($user_data, $_SESSION['signin_user']);
    }

    public function testGetUserByEmail()
    {
        $email = 'test@example.com';
        $user_data = [
            'id' => 1,
            'name' => 'Test User',
            'email' => $email,
            'password' => password_hash('password', PASSWORD_DEFAULT)
        ];

        $statement = $this->createMock(PDOStatement::class);
        $statement->method('fetch')->willReturn($user_data);
        $statement->method('execute')->willReturn(true);

        $this->pdo->method('prepare')->willReturn($statement);

        $result = $this->userRepository->getUserByEmail($email);
        $this->assertEquals($user_data, $result);
    }

    public function testCheckSign()
    {
        $_SESSION = [];
        $this->assertFalse($this->userRepository->checkSign());

        $_SESSION['signin_user'] = ['id' => 1];
        $this->assertTrue($this->userRepository->checkSign());
    }

    public function testSignout()
    {
        $_SESSION = ['signin_user' => ['id' => 1]];
        $this->userRepository->signout();
        $this->assertEmpty($_SESSION);
    }
}
