<?php

namespace app\services;

use app\models\Artist;
use app\classes\ArtistRequest;
use app\models\Concert;
use app\models\UserAuth;
use app\anchor\toolbox\Session;
use app\anchor\toolbox\Page;

require_once 'anchor\toolbox\functions\fragile.php';
require_once 'anchor\toolbox\functions\pagination.php';

require_once 'interfaces\services\IArtistService.php';

class ArtistService implements IArtistService {

    public function index(){
        new Session;
    
        $result = UserAuth::checkSign();
        if (!$result) {
          // $_SESSION['signin_err'] = Message::sign_error;
          header('Location: /the-elephant-in-the-room/signin');
          return;
        }
        $models     = new Artist();
        $showData   = $models->show();
        $pagination = paginate($showData, 10);
        $artists    = $pagination['data'];
        $max_page   = $pagination['max_page'];
        $errors      = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
        unset($_SESSION['errors']);

        include "pages/artist/index.php";
    }

    public function read_create_form(){
        new Session;
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
    
        return include "pages/artist/create_form.php";

    }

    public function read_update_form(){
        new Session;
        $result = UserAuth::checkSign();
        if (!$result) {
          header('Location: /the-elephant-in-the-room/signin');
          return;
        }
        $models = new Artist();
        $artists = $models->getArtist(intval($_GET["id"]));
        $result = UserAuth::checkSign();
        $signin_user = isset($_SESSION['signin_user']) ? $_SESSION['signin_user']: null;
        $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
        unset($_SESSION['errors']);
        unset($_SESSION['old']);
    
        include "pages/artist/update_form.php";
    }

    public function create(){
        // Create an instance
        $artist         = new Artist();
        $artist_request = new ArtistRequest($_POST);

        // Execute Query
        $result = $artist->create($artist_request);

        // Redirect
        if($result){
            header('Location:/the-elephant-in-the-room/artist');
            exit();
        }else{
            header('Location:/the-elephant-in-the-room/error');

        }
    }

    public function update(){
        // Create an instance
        $artist         = new Artist();
        $artist_request = new ArtistRequest($_POST);

        // Execute Query
        $result = $artist->update($artist_request);

        // Redirect
        if($result){
            header('Location:/the-elephant-in-the-room/artist');
            exit();
        }else{
            header('Location:/the-elephant-in-the-room/error');
            exit();
        }
    }

    public function delete(){
        // Create an instance
        $artist = new Artist();
        $artist_request = new ArtistRequest($_POST);
        // Validate post request data
        //$artist_request->searchConcertData();

        // Execute Query
        $result = $artist->delete($artist_request);

        //Redirect
        if($result){
            header('Location:/the-elephant-in-the-room/artist');
            exit();
        }else{
            header('Location:/the-elephant-in-the-room/pages/error');
            exit();
        }
    }
}