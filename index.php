<?php

require_once __DIR__ . '/vendor/autoload.php';

use app\anchor\App;
use app\services\UserAuthService;
use app\services\ArtistService;
use app\services\ConcertService;
use app\services\ArtistConcertService;

$app = new App();

$app->router->get('',      function () { include "pages/welcome.php"; });
$app->router->get('home',  function () { include "pages/home.php"; });
$app->router->get('home',  function () { include "pages/home.php"; });
$app->router->get('error', function () { include "pages/errors/error.php";});

//users
$app->router->get('signin',  function () {(new UserAuthService)->signin_form();});
$app->router->post('signin', function () {(new UserAuthService)->signin();});
$app->router->get('signup',  function () {(new UserAuthService)->signup_form();});
$app->router->post('signup', function () {(new UserAuthService)->signup();});
$app->router->post('signout',function () {(new UserAuthService)->signout();});
$app->router->get('my_page', function () {(new UserAuthService)->my_page();});
$app->router->get('complete', function () {(new UserAuthService)->complete();});
$app->router->post('mail',   function () {(new UserAuthService)->mail();});
$app->router->post('upload', function () {(new UserAuthService)->upload();});
$app->router->post('pdf',    function () {(new UserAuthService)->pdf();});

//artist
$app->router->get('artist',         function () { (new ArtistService)->index(); });
$app->router->get('artist/create',  function () { (new ArtistService)->read_create_form(); });
$app->router->get('artist/update',  function () { (new ArtistService)->read_update_form();  });
$app->router->post('artist/create', function () { (new ArtistService)->create(); });
$app->router->post('artist/update', function () { (new ArtistService)->update(); });
$app->router->post('artist/delete', function () { (new ArtistService)->delete();  });
//concert
$app->router->get('concert',         function () { (new ConcertService)->index(); });
$app->router->get('concert/create',  function () { (new ConcertService)->read_create_form(); });
$app->router->get('concert/update',  function () { (new ConcertService)->read_update_form();  });
$app->router->post('concert/create', function () { (new ConcertService)->create(); });
$app->router->post('concert/update', function () { (new ConcertService)->update(); });
$app->router->post('concert/delete', function () { (new ConcertService)->delete();  });
//artist_concert
$app->router->get('artist_concert',         function () { (new ArtistConcertService)->index(); });
$app->router->get ('artist_concert/create', function () { (new ArtistConcertService)->read_create_form(); });
$app->router->post('artist_concert/create', function () { (new ArtistConcertService)->create(); });
$app->router->post('artist_concert/delete', function () { (new ArtistConcertService)->delete();  });


$app->run();