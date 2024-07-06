<!-- vendor/bin/phpunit tests\services\UserServiceTest.php -->

<?php

use PHPUnit\Framework\TestCase;
use app\axis\Template;
use app\axis\toolbox\File;
use app\axis\toolbox\Mail;
use app\services\UserService;
use app\models\repositories\UserRepository;
use app\models\entities\UserEntity;
require 'bootstrap.php';

class UserServiceTest extends TestCase {


    public function testMyPage(){

        $_SESSION['signin_user'] = 'testman';
        $_SESSION['errors'] = ['Error message 1', 'Error message 2'];

        // モックを作成する
        $mock = $this->getMockBuilder(UserRepository::class)->getMock();
        $mock->method('checkSign')->willReturn(true);
        $result = $mock->checkSign();

        $this->assertEquals(true, $result);

        $template = new Template(
            'user/index', [
                'signin_user' => $_SESSION['signin_user'],
            ]
        );

        unset($_SESSION['errors']);

        $this->assertArrayNotHasKey('errors', $_SESSION);
        $this->assertNotNull($template);
    }

    public function testSignupForm(){

        $_SESSION['errors'] = ['Error message 1', 'Error message 2'];

        // モックを作成する
        $mock = $this->getMockBuilder(UserRepository::class)->getMock();
        $mock->method('checkSign')->willReturn(true);
        $result = $mock->checkSign();

        $this->assertEquals(true, $result);

        $user_service = new UserService;

        $template = new Template(
            'user/form', [
            'csrf'        => $user_service->setToken('signup'),
            'errors'      => isset($_SESSION['errors']) ? $_SESSION['errors'] : null,
            'old'         => isset($_SESSION['old']) ? $_SESSION['old'] : null
            ]
        );

        unset($_SESSION['errors']);

        $this->assertArrayNotHasKey('errors', $_SESSION);
        $this->assertNotNull($template);
    }

    public function testSignup(){
        $_SESSION['csrf_token']['signup'] = 'valid_token';

        $_POST = [
            'email'      => 'test@test.com',
            'password'   => 'jsfhdjf',
            'csrf_token' => 'valid_token'
        ];

        $user_service = new UserService;

        $token_check = $user_service->checkToken('signup');
    
        $user_data   = $user_service->makeUser($_POST);

        $mock_user_repository = $this->getMockBuilder(UserRepository::class)->getMock();
        $mock_user_repository->method('signup')->willReturn(true);


        $result = $mock_user_repository->signup($user_data);

        $this->assertTrue($token_check);
        $this->assertTrue($result);

    }

    public function testSigninForm(){
        $_SESSION['errors'] = ['Error message 1', 'Error message 2'];

        // モックを作成する
        $mock = $this->getMockBuilder(UserRepository::class)->getMock();
        $mock->method('checkSign')->willReturn(true);
        $result = $mock->checkSign();

        $this->assertEquals(true, $result);

        $user_service = new UserService;

        $template = new Template(
            'user/form', [
            'csrf'        => $user_service->setToken('signin'),
            'errors'      => isset($_SESSION['errors']) ? $_SESSION['errors'] : null,
            'old'         => isset($_SESSION['old']) ? $_SESSION['old'] : null
            ]
        );

        unset($_SESSION['errors']);

        $this->assertArrayNotHasKey('errors', $_SESSION);
        $this->assertNotNull($template);
    }

    public function testSignin(){
        $_SESSION['csrf_token']['signin'] = 'valid_token';

        $_POST = [
            'email'      => 'test@test.com',
            'password'   => 'jsfhdjf',
            'csrf_token' => 'valid_token'
        ];

        $user_service = new UserService;

        $token_check = $user_service->checkToken('signin');
    
        $user_data   = $user_service->makeUser($_POST);

        $mock_user_repository = $this->getMockBuilder(UserRepository::class)->getMock();
        $mock_user_repository->method('signin')->willReturn(true);


        $result = $mock_user_repository->signin($user_data);

        $this->assertTrue($token_check);
        $this->assertTrue($result);

    }

    public function testSignout(){
        $logout = filter_input(INPUT_POST, 'logout');

        $mock_user_repository = $this->getMockBuilder(UserRepository::class)->getMock();
        $mock_user_repository->method('signout');

        $mock_user_repository->expects($this->once())
        ->method('signout');

        $mock_user_repository->signout();
    }

    public function testMail() {

        $_POST = [
            'email' => 'test@test.com',
            'text'  => 'sfhdsjfhdsjfhsdkj',
        ];

        $mock_file = $this->createMock(Mail::class);
        $mock_file->method('sendMail')->willReturn(true);
        
        $mock_user_service = $this->getMockBuilder(UserService::class)
                            ->onlyMethods(['mail'])
                            ->getMock();
        
        $mock_user_service->expects($this->once())
                       ->method('mail');
        
        $mock_user_service->mail();
    }

    public function testUpload() {

        $_FILES['file'] = [
            'name' => 'test.txt',
            'type' => 'text/plain',
            'tmp_name' => '/tmp/phpYzdqkD',
            'error' => 0,
            'size' => 123
        ];

        $mock_file = $this->createMock(File::class);
        $mock_file->method('uploadFile')->willReturn(true);
        
        $mock_user_service = $this->getMockBuilder(UserService::class)
                            ->onlyMethods(['upload'])
                            ->getMock();
        
        $mock_user_service->expects($this->once())
                       ->method('upload');
        
        $mock_user_service->upload();
    }

    public function testMakeUser() {
        
        $user_service = new UserService();
        $user_entity  = new UserEntity();

        $_POST = [
            'id'       => 1,
            'name'     => 'nekotaro',
            'email'    => 'test@test.com',
            'password' => 'dxhdjkshdjkhfdsjfh',
        ];

        $user_entity->setId($_POST['id']);
        $user_entity->setName($_POST['name']);
        $user_entity->setEmail($_POST['email']);
        $user_entity->setPassword($_POST['password']);

        $user_data =  $user_service->makeUser($_POST);

        $this->assertEquals($user_entity, $user_data);
    }
}