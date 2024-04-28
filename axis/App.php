<?php

namespace app\axis;

use app\axis\https\Request;
use app\axis\routes\Router;

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
