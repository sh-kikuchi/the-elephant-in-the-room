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
 * Handles business logic related to posts, including creation, updating,
 * deletion, and rendering of post-related views.
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
                'errors' => $_SESSION['errors'] ?? null
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
                'signin_user' => $_SESSION['signin_user'] ?? null,
                'errors' => $_SESSION['errors'] ?? null,
                'old' => $_SESSION['old'] ?? null
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
                'signin_user' => $_SESSION['signin_user'] ?? null,
                'errors' => $_SESSION['errors'] ?? null,
            ]
        );
        unset($_SESSION['errors']);
        unset($_SESSION['old']);

        return $template->render();
    }

    /**
     * Create a new post.
     *
     * @return bool True on success, false on failure.
     */
    public function create() {
        // Check token
        if (!$this->checkToken('post_create')) {
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
     * @return bool True on success, false on failure.
     */
    public function update() {
        // Check token
        if (!$this->checkToken('post_update')) {
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
     * @return bool True on success, false on failure.
     */
    public function delete() {
        // Check token
        if (!$this->checkToken('post_delete')) {
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
    public function makePost(array $post_form):Post {
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
