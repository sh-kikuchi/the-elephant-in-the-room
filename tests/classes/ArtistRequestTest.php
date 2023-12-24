<!-- vendor/bin/phpunit tests\classes\ArtistRequestTest.php -->
<?php
use app\classes\ArtistRequest;
use PHPUnit\Framework\TestCase;

class ArtistRequestTest extends TestCase{
    protected $artist;

    public function setup(): void {
      $data=[];
      $this->artist = new ArtistRequest($data);
    }

    public function testGetId(): void {
      $this->artist->setId(123456);
      $this->assertEquals($this->artist->getId(), 123456);
    }

    public function testGetName(): void {
      $this->artist->setName('revue');
      $this->assertEquals($this->artist->getName(), 'revue');
    }

    public function testGetDebut(): void {
      $this->artist->setDebut('2023/10/01');
      $this->assertEquals($this->artist->getDebut(), '2023/10/01');
    }

    public function testGetStartDate(): void {
      $this->artist->setStartDate('2023/10/01');
      $this->assertEquals($this->artist->getStartDate(), '2023/10/01');
    }

    public function testGetEndDate(): void {
      $this->artist->setEndDate('2023/10/01');
      $this->assertEquals($this->artist->getEndDate(), '2023/10/01');
    }

    public function testGetArrayData(): void {
        $data['id']         = 0;
        $data['user_id']    = 0;
        $data['name']       = '';
        $data['debut']      = '';
        $data['start_date'] = '';
        $data['end_date']   = '';

        $this->assertEquals($this->artist->getArrayData(), $data);
    }
}