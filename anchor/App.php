<?php

namespace app\anchor;

use app\anchor\https\Request;
use app\anchor\routes\Router;

class App
{
  public Router  $router;
  public Request $request;

  public function __construct()
  {
    $this->request = new Request();
    $this->router  = new Router($this->request);
  }

  public function run()
  {
    $this->router->resolve();
  }
}
