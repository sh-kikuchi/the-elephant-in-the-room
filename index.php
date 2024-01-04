<?php

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use app\anchor\App;
use app\services\UserAuthService;
use app\services\PostService;

$app = new App();

$app->router->get('',      function () { include "templates/welcome.php"; });
$app->router->get('error', function () { include "templates/errors/error.php";});

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
//post
$app->router->get('post',         function () { (new PostService)->index(); });
$app->router->get('post/create',  function () { (new PostService)->createForm(); });
$app->router->get('post/update',  function () { (new PostService)->updateForm();  });
$app->router->post('post/create', function () { (new PostService)->create(); });
$app->router->post('post/update', function () { (new PostService)->update(); });
$app->router->post('post/delete', function () { (new PostService)->delete();  });

$app->run();