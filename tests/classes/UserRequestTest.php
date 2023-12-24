<?php
use app\classes\UserAuthRequest;
use PHPUnit\Framework\TestCase;

class UserAuthRequestTest extends TestCase{
    protected $user;

    public function setup(): void {
      $data=[];
      $this->user = new UserAuthRequest($data);
    }

    public function testGetId(): void {
      $this->user->setId(123456);
      $this->assertEquals($this->user->getId(), 123456);
    }

    public function testGetName(): void {
      $this->user->setName('revue');
      $this->assertEquals($this->user->getName(), 'revue');
    }

    public function testGetEmail(): void {
      $this->user->setEmail('elephant@room.jp');
      $this->assertEquals($this->user->getEmail(), 'elephant@room.jp');
    }

    public function testGetPassword(): void {
      $this->user->setPassword('password');
      $this->assertEquals($this->user->getPassword(), 'password');
    }

    public function testGetPasswordConf(): void {
      $this->user->setPasswordConf('password');
      $this->assertEquals($this->user->getPasswordConf(), 'password');
    }

    public function testGetCsrfToken(): void {
      $this->user->setCsrfToken('xcbnxcjhxjh');
      $this->assertEquals($this->user->getCsrfToken(), 'xcbnxcjhxjh');
    }

    public function testGetArrayData(): void {
        $data['id']             = 0;
        $data['name']           = '';
        $data['email']          = '';
        $data['password']       = '';
        $data['password_conf']  = '';
        $data['csrf_token']     = '';

        $this->assertEquals($this->user->getArrayData(), $data);
    }
}