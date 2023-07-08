
<?php
trait Session{
  function oldPostValue($oldPostValue){
    foreach($oldPostValue as $key => $value){
      $_SESSION['old'][$key] = $value;
    }
  }
}
?>
