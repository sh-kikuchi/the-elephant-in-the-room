<?php

namespace app\services;

use app\axis\Service;
use app\axis\Template;
use app\axis\toolbox\Session;
use app\classes\PostRequest;
use app\models\entities\PostEntity as Post;
use app\models\repositories\PostRepository;
use app\models\repositories\UserRepository;

require_once 'axis\toolbox\functions\fragile.php';
require_once 'axis\toolbox\functions\pagination.php';
require_once 'interfaces\services\IPostService.php';

class PostService extends Service implements IPostService {

    public function index(){
        // send form name for setting the token. 
        $csrf = $this->setToken('post_delete');

        $user   = new UserRepository();
        $result = $user->checkSign();
        if (!$result) {
          // $_SESSION['signin_err'] = Message::sign_error;
          header('Location: /the-elephant-in-the-room/signin');
          return;
        }

        $repository = new PostRepository();
        $showData   = $repository->show();
        $pagination = paginate($showData, 10);

        // rendering
        $template = new Template(
            'post/index', [
                'csrf'     => $this->setToken('post_delete'),
                'posts'    => $pagination['data'],
                'max_page' => $pagination['max_page'],
                'errors'   => isset($_SESSION['errors']) ? $_SESSION['errors'] : null
            ]
        );

        unset($_SESSION['errors']);

        return $template->render();
    }

    public function createForm(){
        new Session;
        $user   = new UserRepository();

        // check authorization
        $result = $user->checkSign();
        if (!$result) {
          header('Location: /the-elephant-in-the-room/signin');
          return;
        }

        $post_repositories    = new PostRepository();

        // rendering
        $template = new Template(
            'post/create_form', [
                'csrf'        => $this->setToken('post_create'),
                'posts'       => $post_repositories->show(),
                'signin_user' => isset($_SESSION['signin_user']) ? $_SESSION['signin_user']: null,
                'errors'      => isset($_SESSION['errors']) ? $_SESSION['errors'] : null,
                'old'         => isset($_SESSION['old']) ? $_SESSION['old'] : null
            ]
        );
        unset($_SESSION['errors']);
        unset($_SESSION['old']);

        return $template->render();
    }

    public function updateForm(){
        new Session;
        $user   = new UserRepository();
        $result = $user->checkSign();

        if (!$result) {
          header('Location: /the-elephant-in-the-room/signin');
          return;
        }

        $repository = new PostRepository();

        // rendering
        $template = new Template(
            'post/update_form', [
                'csrf'        => $this->setToken('post_update'),
                'posts'       => $repository->getPost(intval($_GET["id"])),
                'signin_user' => isset($_SESSION['signin_user']) ? $_SESSION['signin_user']: null,
                'errors'      => isset($_SESSION['errors']) ? $_SESSION['errors'] : null,
            ]
        );
        unset($_SESSION['errors']);
        unset($_SESSION['old']);

        return $template->render();
    }

    public function create(){

        //check_token
        $checkTokenResult = $this->checkToken('post_create');

        if(!$checkTokenResult){
            echo 'Invalid token.';
            return false;
        }

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

        //check_token
        $checkTokenResult = $this->checkToken('post_update');

        if(!$checkTokenResult){
            echo 'Invalid token.';
            return false;
        }

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
        //check_token
        $checkTokenResult = $this->checkToken('post_delete');

        if(!$checkTokenResult){
            echo 'Invalid token.';
            return false;
        }

        // Create an instance
        $post = new PostRepository();
        $post_request = new PostRequest($_POST);

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