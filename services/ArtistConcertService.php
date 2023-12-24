<?php
namespace app\services;

use app\models\Artist;
use app\models\Concert;
use app\models\UserAuth;
use app\models\ArtistConcert;
use app\classes\ArtistConcertRequest;

require_once 'anchor\toolbox\functions\fragile.php';
require_once 'anchor\toolbox\functions\pagination.php';

require_once 'interfaces\services\IArtistConcertService.php';

class ArtistConcertService implements IArtistConcertService {
    public function index(){
        $result = UserAuth::checkSign();
        if (!$result) {
          header('Location: /the-elephant-in-the-room/signin');
          return;
        }
        $models     = new ArtistConcert();
        $showData   = $models->show();
        $pagination = paginate($showData, 10);
        $artists_concerts   = $pagination['data'];
        $max_page   = $pagination['max_page'];
        $signin_user = isset($_SESSION['signin_user'])?$_SESSION['signin_user']:null;
    
        include "pages/artist_concert/index.php";
    }
    public function read_create_form(){
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
    
        return include "pages/artist_concert/create_form.php";
    }

    public function create(){
        // Create an instance
        $artist_concert         = new ArtistConcert();
        $artist_concert_request = new ArtistConcertRequest($_POST);

        // Validate post request data
        $artist_concert_request->postValidation();
        $artist_concert_request->searchArtistConcertData();

        // Execute Query
        $result = $artist_concert->create(new ArtistConcertRequest($_POST));

        //Redirect
        if($result){
            header('Location:/the-elephant-in-the-room/artist_concert');
            exit();
        }else{
            header('Location:/the-elephant-in-the-room/error');
            exit();
        }
    }

    public function delete(){
        //Create an instance
        $artist_concert = new ArtistConcert();

        // Execute Query
        $result = $artist_concert->delete(new ArtistConcertRequest($_POST));

        //Redirect
        if($result){
            header('Location:/the-elephant-in-the-room/artist_concert');
            exit();
        }else{
            header('Location:/the-elephant-in-the-room/error');
            exit();
        }
    }

}