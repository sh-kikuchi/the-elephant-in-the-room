<?php

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use app\anchor\App;
use app\services\UserService;
use app\services\PostService;

$app = new App();

$app->router->get('',      function () { include "templates/welcome.php"; });
$app->router->get('error', function () { include "templates/errors/error.php";});

//users
$app->router->get('signin',  function () {(new UserService)->signinForm();});
$app->router->post('signin', function () {(new UserService)->signin();});
$app->router->get('signup',  function () {(new UserService)->signupForm();});
$app->router->post('signup', function () {(new UserService)->signup();});
$app->router->post('signout',function () {(new UserService)->signout();});
$app->router->get('my_page', function () {(new UserService)->myPage();});
$app->router->get('complete', function () {(new UserService)->complete();});
$app->router->post('mail',   function () {(new UserService)->mail();});
$app->router->post('upload', function () {(new UserService)->upload();});
$app->router->post('pdf',    function () {(new UserService)->pdf();});
//post
$app->router->get('post',         function () { (new PostService)->index(); });
$app->router->get('post/create',  function () { (new PostService)->createForm(); });
$app->router->get('post/update',  function () { (new PostService)->updateForm();  });
$app->router->post('post/create', function () { (new PostService)->create(); });
$app->router->post('post/update', function () { (new PostService)->update(); });
$app->router->post('post/delete', function () { (new PostService)->delete();  });

$app->run();