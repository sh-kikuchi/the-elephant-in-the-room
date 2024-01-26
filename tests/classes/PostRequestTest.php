<!-- vendor/bin/phpunit tests\classes\PostRequestTest.php -->
<?php
use PHPUnit\Framework\TestCase;
use app\classes\PostRequest;

class PostRequestTest extends TestCase {
    protected function setUp(): void {
        parent::setUp();
        $postData = [];
        $_SESSION['errors'] = [];
    }

    public function testValidate() {
        $postData = [
            'id'    => 1,
            'user_id' => 2,
            'title' => 'Valid Title',
            'body'  => 'Valid Body'
        ];

        $postRequest = new PostRequest($postData);

        // validateメソッドを呼び出してもエラーが発生しないことを確認
        $postRequest->validate($postData);

        // エラーセッションが空であることを確認
        $this->assertEmpty($_SESSION['errors']);
    }
}
