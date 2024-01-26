<!-- vendor/bin/phpunit tests\services\UserServiceTest.php -->
<?php
use PHPUnit\Framework\TestCase;
use app\services\UserService;
use app\models\repositories\UserRepository;

class UserServiceTest extends TestCase {

    public function testMyPageRedirectsWhenNotSignedIn() {
        $userService = new UserService();

        // 未サインインの状態を模倣
        $_SESSION['signin_user'] = null;

        // メソッド実行前のSESSION状態を保存
        $oldSession = $_SESSION;

        // myPageメソッド実行
        $userService->myPage();

        // SESSIONが変更されているか確認
        $this->assertNotEquals($oldSession, $_SESSION);

        // サインイン画面にリダイレクトされるか確認
        $this->assertEquals('/the-elephant-in-the-room/signin', header('Location:'));
    }
}
