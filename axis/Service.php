<?php

namespace app\axis;

use app\axis\Template;
use app\axis\toolbox\Session;

class Service {

    public function __construct() {
      $session  = new Session;
    }
    /**
     * token generation
     * @param  void
     * @return $csrf_token
     */
    function setToken($form_name) :string {

      $csrf_token = bin2hex(random_bytes(32));
      $_SESSION['csrf_token'][$form_name] = $csrf_token;

      return $csrf_token;
    }

    /**
     * check generation
     * @param  void
     * @return $csrf_token
     */
    function checkToken($form_name): bool{
        $result;
        
        if(!isset($_SESSION['csrf_token'][$form_name])) { return false; }

        if(($_POST["csrf_token"] !== $_SESSION['csrf_token'][$form_name])) {
            $result = false;
        }else{
            $result = true;
        }

        return $result;
    }

    /**
     * Rendering a template file
     * @param  void
     * @return $template->render();
     */
    function render(): mixed {
        $template = new Template;

        return $template->render();
    }

}