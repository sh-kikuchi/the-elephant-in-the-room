
<?php
trait Session{
    /**
     * When returning to the screen on a validation error, 
     * the value that was entered is also returned.
     * @param array $oldPostValue 
     * @return void
     */
    function oldPostValue($oldPostValue){
      foreach($oldPostValue as $key => $value){
          $_SESSION['old'][$key] = $value;
      }
    }
}
?>
