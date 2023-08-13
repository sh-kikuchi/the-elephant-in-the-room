<?php
require_once 'util\trait\session.php';
class ConcertRequest{
  use Session;

    /**
     * Validate POST data.
     * @param array $postData
     * @return $void
     */
    public function postValidation($post_data) {
        session_start();
        unset($_SESSION['errors']);

        $errors        = [];
        $id            = isset($post_data['id'])?$post_data['id']:null;
        $date          = $post_data['date'];
        $name          = $post_data['name'];
        $place         = $post_data['place'];

        if(!$name) {
          array_push($errors,'Please fill in concert name.');
        }
        if(!$date) {
          array_push($errors,'Please fill in date.');
        }
        if(!$place) {
          array_push($errors,'Please fill in place.');
        }
        if(mb_strlen($name)>100 || mb_strlen($place)>100) {
          array_push($errors,'Please enter up to 100 characters.');
        }
        if (count($errors) > 0) {
            $_SESSION['errors'] = $errors;
            $this->oldPostValue($post_data);
            if(!empty($id)){
                $param =  !empty($id) ? '?id='. $id : '';
                header('Location: /the-elephant-in-the-room/pages/concert/update_form.php'.$param);
                exit();
            }else{
                header('Location: /the-elephant-in-the-room/pages/concert/create_form.php');
                exit();
            }
        }
    }
}

?>