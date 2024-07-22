<?php

function route($target_route){
  $url = dirname($_SERVER['SCRIPT_NAME']) . '/' . $target_route;
  return $url;
}

?>