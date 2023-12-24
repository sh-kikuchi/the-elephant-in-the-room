<!-- vendor/bin/phpunit tests\classes\ConcertRequestTest.php -->
<?php
use app\classes\ConcertRequest';
use PHPUnit\Framework\TestCase;

class ConcertRequestTest extends TestCase{
    protected $concert;

    public function setup(): void {
      $data=[];
      $this->concert = new ConcertRequest($data);
    }

    public function testGetId(): void {
      $this->concert->setId(123456);
      $this->assertEquals($this->concert->getId(), 123456);
    }

    public function testGetName(): void {
      $this->concert->setName('revue');
      $this->assertEquals($this->concert->getName(), 'revue');
    }

    public function testGetDate(): void {
      $this->concert->setDate('2023/10/01');
      $this->assertEquals($this->concert->getDate(), '2023/10/01');
    }

    public function testGetPlace(): void {
      $this->concert->setPlace('TOKIO DOME');
      $this->assertEquals($this->concert->getPlace(), 'TOKIO DOME');
    }

    public function testGetArrayData(): void {
        $data['id']      = 0;
        $data['user_id'] = 0;
        $data['name']    = '';
        $data['date']    = '';
        $data['place']   = '';

        $this->assertEquals($this->concert->getArrayData(), $data);
    }
}