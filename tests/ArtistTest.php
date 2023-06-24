<?php

use PHPUnit\Framework\TestCase;

require_once('models\Artist.php');
require_once('database\db_connect.php');

 
class ArtistTest extends TestCase{

/**
* A basic test example.
*
*
*/

  public function create() {
    $pdo = db_connect();

    $artist = new Artist();


    $response = $artist->create([
      "user_id"    => 1,
      "name"       => 'unitTest',
      "debut"      => null,
      "start_date" => null,
      "end_date"   => null
    ]);


    $response->assertRedirect('/pages/artist');
  }



}