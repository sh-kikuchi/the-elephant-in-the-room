<?php
namespace app\services;

use app\models\Artist;
use app\models\Concert;
use app\models\UserAuth;
use app\classes\ConcertRequest;

require_once 'anchor\toolbox\functions\fragile.php';
require_once 'anchor\toolbox\functions\pagination.php';

require_once 'interfaces\services\IConcertService.php';

class ConcertService implements IConcertService {
    public function index(){
      session_start();
      $result = UserAuth::checkSign();
      if (!$result) {
        header('Location: /the-elephant-in-the-room/signin');
        return;
      }
      $models     = new Concert();
      $showData   = $models->show();
      $pagination = paginate($showData, 10);
      $concerts   = $pagination['data'];
      $max_page   = $pagination['max_page'];
      $signin_user = isset($_SESSION['signin_user'])?$_SESSION['signin_user']:null;
  
      include  include "pages/concert/index.php";

    }
    public function read_create_form(){
      session_start();
      $result = UserAuth::checkSign();
      if (!$result) {
        header('Location: /the-elephant-in-the-room/signin');
        return;
      }
      $artist_models  = new Artist();
      $concert_models = new Concert();
      $artists        = $artist_models->show();
      $concerts       = $concert_models->show();
      $signin_user    = isset($_SESSION['signin_user']) ? $_SESSION['signin_user']: null;
      $errors         = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
      $old            = isset($_SESSION['old']) ? $_SESSION['old'] : null;
      unset($_SESSION['errors']);
      unset($_SESSION['old']);
  
      return include "pages/concert/create_form.php";

    }

    public function read_update_form(){
        session_start();
        
        $result = UserAuth::checkSign();
        if (!$result) {
          header('Location: /the-elephant-in-the-room/signin');
          return;
        }
        $models      = new Concert();
        $concerts    = $models->getConcert(intval($_GET["id"]));
        $signin_user = isset($_SESSION['signin_user']) ? $_SESSION['signin_user']: null;
        $errors      = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
        $old         = isset($_SESSION['old']) ? $_SESSION['old'] : null;
        unset($_SESSION['errors']);
        unset($_SESSION['old']);

        include  include "pages/concert/update_form.php";
    }

    public function create(){
        // Create an instance
        $concert = new Concert();
        $concert_request = new ConcertRequest($_POST);

        // Execute query
        $result = $concert->create($concert_request);

        // Redirect
        if($result){
            header('Location:/the-elephant-in-the-room/concert');
            exit();
        }else{
            header('Location:/the-elephant-in-the-room/error');
            exit();
        }
    }

    public function update(){
        // Create an instance
        $concert = new Concert();
        $concert_request = new ConcertRequest($_POST);

        // Validate post request data
        $concert_request->postValidation();

        // Execute query
        $result = $concert->update(new ConcertRequest($_POST));

        // Redirect
        if($result){
            header('Location:/the-elephant-in-the-room/concert');
            exit();
        }else{
            header('Location:/the-elephant-in-the-room/error');
            exit();
        }
    }

    public function delete(){
        // Create an instance
        $concert = new Concert();
        // Execute query
        $result = $concert->delete(new ConcertRequest($_POST));

        // Redirect
        if($result){
            header('Location:/the-elephant-in-the-room/concert');
            exit();
        }else{
            header('Location:/the-elephant-in-the-room/error');
            exit();
        }
    }

}