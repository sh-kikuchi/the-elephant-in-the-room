<!-- vendor/bin/phpunit tests\models\ArtistTest.php -->
<?php
use app\models\Artist;
use app\classes\ArtistRequest;
use PHPUnit\Framework\TestCase;

class ArtistTest extends TestCase{
    protected $artist;

    public function setup(): void {
      $this->artist = new Artist();
    }

    public function testCreate(): void {
        $result = false;
        $data = [];
        $data['user_id']    = 13;
        $data['name']       = 'dummy_man';
        $data['debut']      = '1990-01-01';
        $data['start_date'] = '1990-01-01';
        $data['end_date']   = '1999-01-01';  

        $result = $this->artist->create(new ArtistRequest($data));
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

        $result = $this->artist->update(new ArtistRequest($data));
        $this->assertTrue($result);
    }
    
    public function testDelete(): void {
        $data = [];
        $data['id']         = 258;
        $result = $this->artist->delete(new ArtistRequest($data));
        $this->assertTrue($result);
    }
}
