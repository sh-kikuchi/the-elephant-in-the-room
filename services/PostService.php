<?php

namespace app\services;

use app\models\repositories\PostRepository;
use app\classes\PostRequest;
use app\models\repositories\UserAuth;
use app\anchor\toolbox\Session;
use app\anchor\toolbox\Page;
use app\models\entities\PostEntity as Post;

require_once 'anchor\toolbox\functions\fragile.php';
require_once 'anchor\toolbox\functions\pagination.php';

require_once 'interfaces\services\IPostService.php';

class PostService implements IPostService {

    public function index(){
        new Session;
    
        $result = UserAuth::checkSign();
        if (!$result) {
          // $_SESSION['signin_err'] = Message::sign_error;
          header('Location: /the-elephant-in-the-room/signin');
          return;
        }
        $repository = new PostRepository();
        $showData   = $repository->show();
        $pagination = paginate($showData, 10);
        $posts    = $pagination['data'];
        $max_page   = $pagination['max_page'];
        $errors      = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
        unset($_SESSION['errors']);

        include "templates/post/index.php";
    }

    public function createForm(){
        new Session;
        $result = UserAuth::checkSign();
        if (!$result) {
          header('Location: /the-elephant-in-the-room/signin');
          return;
        }
        $post_repositories    = new PostRepository();
        $posts          = $post_repositories->show();
        $signin_user    = isset($_SESSION['signin_user']) ? $_SESSION['signin_user']: null;
        $errors         = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
        $old            = isset($_SESSION['old']) ? $_SESSION['old'] : null;
        unset($_SESSION['errors']);
        unset($_SESSION['old']);
    
        return include "templates/post/create_form.php";

    }

    public function updateForm(){
        new Session;
        $result = UserAuth::checkSign();
        if (!$result) {
          header('Location: /the-elephant-in-the-room/signin');
          return;
        }
        $repository = new PostRepository();
        $posts = $repository->getPost(intval($_GET["id"]));
        $result = UserAuth::checkSign();
        $signin_user = isset($_SESSION['signin_user']) ? $_SESSION['signin_user']: null;
        $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
        unset($_SESSION['errors']);
        unset($_SESSION['old']);
    
        include "templates/post/update_form.php";
    }

    public function create(){

        // Create an instance
        $post         = new PostRepository();
        $post_request = $this->makePost($_POST);

        // Execute Query
        $result = $post->create($post_request);

        // Redirect
        if($result){
            header('Location:/the-elephant-in-the-room/post');
            exit();
        }else{
            header('Location:/the-elephant-in-the-room/error');
        }
    }

    public function update(){
        // Create an instance
        $post         = new PostRepository();
        $post_request = $this->makePost($_POST);

        // Execute Query
        $result = $post->update($post_request);

        // Redirect
        if($result){
            header('Location:/the-elephant-in-the-room/post');
            exit();
        }else{
            header('Location:/the-elephant-in-the-room/error');
        }
    }


    public function delete(){
        // Create an instance
        $post = new PostRepository();
        $post_request = new PostRequest($_POST);
        // Validate post request data
        //$post_request->searchConcertData();

        // Execute Query
        $result = $post->delete($post_request);

        //Redirect
        if($result){
            header('Location:/the-elephant-in-the-room/post');
            exit();
        }else{
            header('Location:/the-elephant-in-the-room/templates/error');
            exit();
        }
    }

    public function makePost($post_form){

        $post = new Post();
        $post_request = new PostRequest($post_form);

        if($post_request->getId() !== null){
            $post->setId($post_request->getId());
        }
        $post->setUserId($post_request->getUserId());
        $post->setTitle($post_request->getTitle());
        $post->setBody($post_request->getBody());
        
        return $post;
    }
}