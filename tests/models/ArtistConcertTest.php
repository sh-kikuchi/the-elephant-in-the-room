<!-- vendor/bin/phpunit tests\models\ArtistConcertTest.php -->
<?php
use app\models\ArtistConcert;
use app\classes\ArtistConcertRequest;
use PHPUnit\Framework\TestCase;

class ArtistConcertTest extends TestCase{
    protected $artist_concert;

    public function setup(): void {
      $this->artist_concert = new ArtistConcert();
    }

    public function testCreate(): void {
        $result = false;
        $data = [];
        $data['artist_id']  = [219];
        $data['concert_id'] = 442;

        $result = $this->artist_concert->create(new ArtistConcertRequest($data));
        $this->assertTrue($result);
    }

    public function testDelete(): void {
        $data = [];
        $data['concert_id'] = 442;
        $result = $this->artist_concert->delete(new ArtistConcertRequest($data));
        $this->assertTrue($result);
    }
}
