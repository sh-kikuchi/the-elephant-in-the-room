<!-- vendor/bin/phpunit tests\form_classes\PostRequestTest.php -->
<?php
use PHPUnit\Framework\TestCase;
use app\form_classes\PostRequest;

/**
 * Test case for the PostRequest class
 */
class PostRequestTest extends TestCase {
    /**
     * Setup method called before each test
     */
    protected function setUp(): void {
        parent::setUp();
        $postData = [];
        $_SESSION['errors'] = [];
    }

    /**
     * Test the behavior of the validate method
     */
    public function testValidate() {
        $postData = [
            'id'    => 1,
            'user_id' => 2,
            'title' => 'Valid Title',
            'body'  => 'Valid Body'
        ];

        $postRequest = new PostRequest($postData);

        // Ensure that calling the validate method does not cause errors
        $postRequest->validate($postData);

        // Verify that the error session is empty
        $this->assertEmpty($_SESSION['errors']);
    }
}
