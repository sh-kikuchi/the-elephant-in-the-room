<!-- vendor/bin/phpunit tests\classes\ArtistConcertRequestTest.php -->
<?php
use app\classes\ArtistConcertRequest;
use PHPUnit\Framework\TestCase;

class ArtistConcertRequestTest extends TestCase{
    protected $artist_concert;

    public function setup(): void {
      $data=[];
      $this->artist_concert = new ArtistConcertRequest($data);
    }

    public function testGetId(): void {
      $this->artist_concert->setId(123456);
      $this->assertEquals($this->artist_concert->getId(), 123456);
    }

    public function testGetArtistId(): void {
      $this->artist_concert->setArtistId([1,3,5,7,10,15]);
      $this->assertEquals($this->artist_concert->getArtistId(), [1,3,5,7,10,15]);
    }

    public function testGetConcertId(): void {
      $this->artist_concert->setConcertId(3);

      $this->assertEquals($this->artist_concert->getConcertId(), 3);
    }

    public function testGetArrayData(): void {
        $data['id']         = 0;
        $data['artist_id']  = [];
        $data['concert_id'] = 0;

        $this->assertEquals($this->artist_concert->getArrayData(), $data);
    }
}