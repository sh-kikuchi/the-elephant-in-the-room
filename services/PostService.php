<?php

namespace app\services;

use app\axis\Service;
use app\axis\Template;
use app\axis\https\Redirect;
use app\axis\toolbox\Session;
use app\form_classes\PostRequest;
use app\models\entities\PostEntity as Post;
use app\models\repositories\PostRepository;
use app\models\repositories\UserRepository;

/**
 * Class PostService
 *
 * @package app\services
 */
class PostService extends Service implements IPostService {

    /**
     * Display the list of posts with pagination.
     *
     * @return string The rendered template.
     */
    public function index() {
        // Send form name for setting the token. 
        $csrf = $this->setToken('post_delete');

        $user = new UserRepository();
        $result = $user->checkSign();
        if (!$result) {
            // $_SESSION['signin_err'] = Message::sign_error;
            Redirect::to('signin');
            return;
        }

        $repository = new PostRepository();
        $showData = $repository->show();
        $pagination = paginate($showData, 10);

        // Rendering
        $template = new Template(
            'post/index', [
                'csrf' => $this->setToken('post_delete'),
                'posts' => $pagination['data'],
                'max_page' => $pagination['max_page'],
                'errors' => isset($_SESSION['errors']) ? $_SESSION['errors'] : null
            ]
        );

        unset($_SESSION['errors']);

        return $template->render();
    }

    /**
     * Show the form to create a new post.
     *
     * @return string The rendered template.
     */
    public function showCreateForm() {
        new Session;
        $user = new UserRepository();

        // Check authorization
        $result = $user->checkSign();
        if (!$result) {
            Redirect::to('signin');
            return;
        }

        // Rendering
        $template = new Template(
            'post/form', [
                'csrf' => $this->setToken('post_create'),
                'signin_user' => isset($_SESSION['signin_user']) ? $_SESSION['signin_user'] : null,
                'errors' => isset($_SESSION['errors']) ? $_SESSION['errors'] : null,
                'old' => isset($_SESSION['old']) ? $_SESSION['old'] : null
            ]
        );
        unset($_SESSION['errors']);
        unset($_SESSION['old']);

        return $template->render();
    }

    /**
     * Show the form to update an existing post.
     *
     * @return string The rendered template.
     */
    public function showUpdateForm() {
        new Session;
        $user = new UserRepository();
        $result = $user->checkSign();

        if (!$result) {
            Redirect::to('signin');
            return;
        }

        $repository = new PostRepository();
        $post = $repository->getPost(intval($_GET["id"]));

        // Rendering
        $template = new Template(
            'post/form', [
                'csrf' => $this->setToken('post_update'),
                'post' => $post,
                'signin_user' => isset($_SESSION['signin_user']) ? $_SESSION['signin_user'] : null,
                'errors' => isset($_SESSION['errors']) ? $_SESSION['errors'] : null,
            ]
        );
        unset($_SESSION['errors']);
        unset($_SESSION['old']);

        return $template->render();
    }

    /**
     * Create a new post.
     *
     * @return bool
     */
    public function create() {

        // Check token
        $checkTokenResult = $this->checkToken('post_create');

        if (!$checkTokenResult) {
            echo 'Invalid token.';
            return false;
        }

        // Create an instance
        $post = new PostRepository();
        $post_request = $this->makePost($_POST);

        // Execute query
        $result = $post->create($post_request);

        // Redirect
        if ($result) {
            Redirect::to('post');
        } else {
            Redirect::error(500);
        }
    }

    /**
     * Update an existing post.
     *
     * @return bool
     */
    public function update() {
        // Check token
        $checkTokenResult = $this->checkToken('post_update');

        if (!$checkTokenResult) {
            echo 'Invalid token.';
            return false;
        }

        // Create an instance
        $post = new PostRepository();
        $post_request = $this->makePost($_POST);

        // Execute query
        $result = $post->update($post_request);

        // Redirect
        if ($result) {
            Redirect::to('post');
        } else {
            Redirect::error(500);
        }
    }

    /**
     * Delete an existing post.
     *
     * @return bool
     */
    public function delete() {
        // Check token
        $checkTokenResult = $this->checkToken('post_delete');

        if (!$checkTokenResult) {
            echo 'Invalid token.';
            return false;
        }

        // Create an instance
        $post = new PostRepository();
        $post_request = $this->makePost($_POST);

        // Execute query
        $result = $post->delete($post_request);

        // Redirect
        if ($result) {
            Redirect::to('post');
        } else {
            Redirect::error(500);
        }
    }

    /**
     * Create a Post entity from the form data.
     *
     * @param array $post_form The form data.
     * @return Post The Post entity.
     */
    public function makePost($post_form) {
        $post = new Post();
        $post_request = new PostRequest($post_form);

        if ($post_request->getId() !== null) {
            $post->setId($post_request->getId());
        }
        $post->setUserId($post_request->getUserId());
        $post->setTitle($post_request->getTitle());
        $post->setBody($post_request->getBody());

        return $post;
    }
}
