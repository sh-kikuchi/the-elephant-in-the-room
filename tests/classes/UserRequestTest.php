<!-- vendor/bin/phpunit tests\form_classes\UserRequestTest.php -->
<?php
use PHPUnit\Framework\TestCase;
use app\form_classes\UserRequest;

/**
 * Test case for the UserRequest class
 */
class UserRequestTest extends TestCase {
    /**
     * Instance of the UserRequest class
     *
     * @var UserRequest
     */
    protected $userRequest;

    /**
     * Setup method called before each test
     */
    protected function setUp(): void {
        parent::setUp();
        $this->userRequest = new UserRequest([]);
        $_SESSION['errors'] = [];
        $_SESSION['csrf_token'] = 'valid_csrf_token';
    }

    /**
     * Test the sign-in validation
     */
    public function testSignInValidation() {
        $postData = [
            'email'      => 'test@example.com',
            'password'   => 'password123',
            'csrf_token' => 'valid_csrf_token'
        ];

        $this->userRequest = new UserRequest($postData);
        $this->userRequest->signInValidation();

        // Ensure that there are no errors in the session
        $this->assertEmpty($_SESSION['errors']);
    }

    /**
     * Test the sign-up validation
     */
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

        // Ensure that there are no errors in the session
        $this->assertEmpty($_SESSION['errors']);
    }
}
