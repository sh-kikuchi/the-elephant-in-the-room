<?php

require 'axis\AutoloadManager.php';

$autoloader = new AutoloadManager();

$autoloader->registerDir(dirname(__FILE__).'/axis/toolbox/functions');
$autoloader->registerDir(dirname(__FILE__).'/interfaces/classes');
$autoloader->registerDir(dirname(__FILE__).'/interfaces/models/repositories');
$autoloader->registerDir(dirname(__FILE__).'/interfaces/services');
$autoloader->registerDir(dirname(__FILE__).'/config');

$autoloader->autoload();




