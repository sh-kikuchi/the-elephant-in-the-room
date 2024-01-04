<!-- vendor/bin/phpunit tests\models\repositories\ArtistConcertTest.php -->
<?php
use app\models\repositories\ArtistConcert;
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
        $data['user_id']    = 13;
        $data['name']       = 'dummy_man';
        $data['debut']      = '1990-01-01';
        $data['start_date'] = '1990-01-01';
        $data['end_date']   = '1999-01-01';  

        $result = $this->artist_concert->create(new ArtistConcertRequest($data));
        $this->assertTrue($result);
    }

    public function testUpdate(): void {
        $data = [];
        $data['id']         = 258;
        $data['user_id']    = 13;
        $data['name']       = 'dummy_man_upd';
        $data['debut']      = '2090-01-01';
        $data['start_date'] = '2090-01-01';
        $data['end_date']   = '2099-01-01';  

        $result = $this->artist_concert->update(new ArtistConcertRequest($data));
        $this->assertTrue($result);
    }
    
    public function testDelete(): void {
        $data = [];
        $data['id']         = 258;
        $result = $this->artist_concert->delete(new ArtistConcertRequest($data));
        $this->assertTrue($result);
    }
}
