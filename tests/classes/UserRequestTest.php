<!-- vendor/bin/phpunit tests\classes\UserRequestTest.php -->
<?php
use PHPUnit\Framework\TestCase;
use app\classes\UserRequest;

class UserRequestTest extends TestCase {
    protected $userRequest;

    protected function setUp(): void {
        parent::setUp();
        $this->userRequest = new UserRequest([]);
        $_SESSION['errors'] = [];
        $_SESSION['csrf_token'] = 'valid_csrf_token';
    }

    public function testSignInValidation() {

        $postData = [
            'email'      => 'test@example.com',
            'password'   => 'password123',
            'csrf_token' => 'valid_csrf_token'
        ];

        $this->userRequest = new UserRequest($postData);
        $this->userRequest->signInValidation();
       
        $this->assertEmpty($_SESSION['errors']);
    }

    public function testSignUpValidation() {
        $postData = [
            'name'           => 'John Doe',
            'email'          => 'john.doe@example.com',
            'password'       => 'StrongPass123',
            'password_conf'  => 'StrongPass123',
            'csrf_token'     => 'valid_csrf_token'
        ];

        $this->userRequest = new UserRequest($postData);
        $this->userRequest->signUpValidation();

        $this->assertEmpty($_SESSION['errors']);
    }
}
