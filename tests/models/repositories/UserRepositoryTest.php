<!-- vendor/bin/phpunit tests\models\repositories\UserRepositoryTest.php -->
<?php

use PHPUnit\Framework\TestCase;
use app\models\repositories\UserRepository;
use app\models\entities\UserEntity as User;

/**
 * Test case for the UserRepository class
 */
class UserRepositoryTest extends TestCase
{
    private $pdo;
    private $userRepository;
    private $user;

    /**
     * Set up the test environment
     */
    protected function setUp(): void
    {
        // Create a mock of PDO
        $this->pdo = $this->createMock(PDO::class);
        $this->userRepository = new UserRepository($this->pdo);
        $this->user = $this->createMock(User::class);
    }

    /**
     * Test the signup method of the UserRepository class
     */
    public function testSignup()
    {
        $this->user->method('getName')->willReturn('Test User');
        $this->user->method('getEmail')->willReturn('test@example.com');
        $this->user->method('getPassword')->willReturn('password');

        // Create a mock of PDOStatement
        $statement = $this->createMock(PDOStatement::class);
        $statement->expects($this->once())->method('execute')->willReturn(true);

        // Configure PDO to return the mocked PDOStatement
        $this->pdo->method('prepare')->willReturn($statement);
        $this->pdo->expects($this->once())->method('beginTransaction');
        $this->pdo->expects($this->once())->method('commit');

        $result = $this->userRepository->signup($this->user);
        $this->assertTrue($result);
    }

    /**
     * Test the signin method of the UserRepository class
     */
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

        // Create a mock of PDOStatement
        $statement = $this->createMock(PDOStatement::class);
        $statement->method('fetch')->willReturn($user_data);
        $statement->method('execute')->willReturn(true);

        // Configure PDO to return the mocked PDOStatement
        $this->pdo->method('prepare')->willReturn($statement);

        // Clear the session
        $_SESSION = [];

        $result = $this->userRepository->signin($this->user);
        $this->assertTrue($result);
        $this->assertArrayHasKey('signin_user', $_SESSION);
        $this->assertEquals($user_data, $_SESSION['signin_user']);
    }

    /**
     * Test the getUserByEmail method of the UserRepository class
     */
    public function testGetUserByEmail()
    {
        $email = 'test@example.com';
        $user_data = [
            'id' => 1,
            'name' => 'Test User',
            'email' => $email,
            'password' => password_hash('password', PASSWORD_DEFAULT)
        ];

        // Create a mock of PDOStatement
        $statement = $this->createMock(PDOStatement::class);
        $statement->method('fetch')->willReturn($user_data);
        $statement->method('execute')->willReturn(true);

        // Configure PDO to return the mocked PDOStatement
        $this->pdo->method('prepare')->willReturn($statement);

        $result = $this->userRepository->getUserByEmail($email);
        $this->assertEquals($user_data, $result);
    }

    /**
     * Test the checkSign method of the UserRepository class
     */
    public function testCheckSign()
    {
        // Clear the session and check if user is signed in
        $_SESSION = [];
        $this->assertFalse($this->userRepository->checkSign());

        // Simulate a signed-in user
        $_SESSION['signin_user'] = ['id' => 1];
        $this->assertTrue($this->userRepository->checkSign());
    }

    /**
     * Test the signout method of the UserRepository class
     */
    public function testSignout()
    {
        // Simulate a signed-in user and sign out
        $_SESSION = ['signin_user' => ['id' => 1]];
        $this->userRepository->signout();
        $this->assertEmpty($_SESSION);
    }
}
