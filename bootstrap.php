<?php

require 'axis\AutoloadManager.php';

$autoloader = new AutoloadManager();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$autoloader->registerDir(dirname(__FILE__).'/axis/toolbox/functions');
$autoloader->registerDir(dirname(__FILE__).'/interfaces/form_classes');
$autoloader->registerDir(dirname(__FILE__).'/interfaces/models/repositories');
$autoloader->registerDir(dirname(__FILE__).'/interfaces/services');
$autoloader->registerDir(dirname(__FILE__).'/config');

$autoloader->autoload();




