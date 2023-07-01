
<?php
trait Session{
  function oldPostValue($oldPostValue){
    foreach($oldPostValue as $key => $value){
      $_SESSION['old'][$key] = $value;
    }
  }
  function checkToken( $token){
    $result = false;
    if (isset($_SESSION['csrf_token']) || $token === $_SESSION['csrf_token']) {
      $result = true;
    }
    return $result;
  }
}
?>
