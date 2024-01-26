<!-- vendor/bin/phpunit tests\services\PostServiceTest.php -->
<?php
use PHPUnit\Framework\TestCase;
use app\services\PostService;
use app\models\repositories\PostRepository;

class PostServiceTest extends TestCase {

    public function setUp(): void {
        parent::setUp();

        $_SESSION = [];
        // セッションを開始
        session_start();
    }

    public function testIndexRedirectsWhenNotSignedIn() {

        $postService = new PostService();

        $_SESSION['signin_user']['id'] = 9999;

        // indexメソッド実行
        $postService->index();

        // サインイン画面にリダイレクトされるか確認
        $this->assertEquals('/the-elephant-in-the-room/signin', header('Location:'));
    }

    // 同様に他のメソッドに対するテストも追加する

}
