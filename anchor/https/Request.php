<?php

namespace app\anchor\https;

class Request
{
  public Router $router;

  public function getPath()
  {
    preg_match('|' . dirname($_SERVER['SCRIPT_NAME']) . '/([\w%/]*)|', $_SERVER['REQUEST_URI'], $matches);
    $path     = $matches[1];
    $position = strpos($_SERVER['REQUEST_URI'], '?');

    if ($position === false) {
      return $path;
    }
    return substr($path, 0, $position);
  }

  public function getMethod()
  {
    return strtolower($_SERVER['REQUEST_METHOD']);
  }
}