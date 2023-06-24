
<?php
trait Session{
  function old_post_value($old_post_value){
    foreach($old_post_value as $key => $value){
      $_SESSION['old'][$key] = $value;
    }
  }
}
?>
