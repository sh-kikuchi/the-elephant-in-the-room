<!-- vendor/bin/phpunit tests\services\PostServiceTest.php -->
<?php

use PHPUnit\Framework\TestCase;
use app\axis\Service;
use app\axis\Template;
use app\axis\toolbox\Session;
use app\form_classes\PostRequest;
use app\services\PostService;
use app\models\entities\PostEntity;
use app\models\repositories\UserRepository;
use app\models\repositories\PostRepository;

require 'bootstrap.php';

/**
 * Test case for the PostService class
 */
class PostServiceTest extends TestCase
{
    /**
     * Test the index method of the PostService class
     */
    public function testIndex() 
    {
        $_SESSION['errors'] = ['Error message 1', 'Error message 2'];

        // Create a mock of UserRepository
        $mock = $this->getMockBuilder(UserRepository::class)->getMock();
        $mock->method('checkSign')->willReturn(true);
        $result = $mock->checkSign();
        $this->assertEquals(true, $result);

        // Create a mock of PostRepository
        $mock_post_repository = $this->getMockBuilder(PostRepository::class)->getMock();
        $mockPostData = [
            [
                'id' => 1, 
                'title' => 'Post 1',
                'body' => '世田谷給田', 
                'created_at' => '2024-05-02 21:01:11', 
                'updated_at' => '2024-05-02 21:01:11' 
            ],
        ];
        $mock_post_repository->method('show')->willReturn($mockPostData);

        $postShowData = $mock_post_repository->show();
        $this->assertEquals($mockPostData, $postShowData);

        // Create a Template instance
        $template = new Template(
            'post/index', [
                'csrf'     => 'test',
                'posts'    => $postShowData,
                'max_page' => 3,
                'errors'   => isset($_SESSION['errors']) ? $_SESSION['errors'] : null
            ]
        );

        unset($_SESSION['errors']);

        $this->assertArrayNotHasKey('errors', $_SESSION);
        $this->assertNotNull($template);
    }

    /**
     * Test the createForm method of the PostService class
     */
    public function testCreateForm() 
    {
        $mock = $this->getMockBuilder(UserRepository::class)->getMock();
        $mock->method('checkSign')->willReturn(true);

        // Create a Template instance
        $template = new Template(
            'post/create_form', [
                'csrf'        => 'test',
                'signin_user' => 'katuobushi nekotaro',
                'errors'      => null,
                'old'         => null
            ]
        );

        $this->assertNotNull($template);
    }

    /**
     * Test the updateForm method of the PostService class
     */
    public function testUpdateForm() 
    {
        $param = 3;

        $mock = $this->getMockBuilder(UserRepository::class)->getMock();
        $mock->method('checkSign')->willReturn(true);

        $mock_post_repository = $this->getMockBuilder(PostRepository::class)->getMock();
        $mockPostData = [
            'id' => 1,
            'title' => 'Post 1',
            'body' => 'Test Body',
            'created_at' => '2024-05-02 21:01:11',
            'updated_at' => '2024-05-02 21:01:11'
        ];
    
        $mock_post_repository->method('getPost')->willReturn($mockPostData);

        $postUpdateForm = $mock_post_repository->getPost($param);
        $this->assertEquals($mockPostData, $postUpdateForm);

        // Create a Template instance
        $template = new Template(
            'post/update_form', [
                'csrf'        => 'test',
                'posts'       =>  $postUpdateForm,
                'signin_user' =>  null,
                'errors'      =>  null,
            ]
        );

        $this->assertNotNull($template);
    }

    /**
     * Test the makePost method of the PostService class
     */
    public function testMakePost() 
    {
        $post_service = new PostService();
        $post_entity  = new PostEntity();

        $_POST = [
            'user_id' => '1',
            'title' => 'Test Title',
            'body' => 'Test Body',
            'csrf_token' => 'valid_token'
        ];

        $post_entity->setUserId($_POST['user_id']);
        $post_entity->setTitle($_POST['title']);
        $post_entity->setBody($_POST['body']);

        $post_data =  $post_service->makePost($_POST);

        $this->assertEquals($post_entity, $post_data);
    }

    /**
     * Test the create method of the PostService class
     */
    public function testCreate() 
    {
        $post_service = new PostService();

        $mock_post_repository = $this->getMockBuilder(PostRepository::class)->getMock();
        $mock_post_repository->method('create')->willReturn(true);

        $_SESSION['csrf_token']['post_create'] = 'valid_token';

        $_POST = [
            'user_id' => '1',
            'title' => 'Test Title',
            'body' => 'Test Body',
            'csrf_token' => 'valid_token'
        ];
           
        $token_check = $post_service->checkToken('post_create');
        $post_data =  $post_service->makePost($_POST);

        $result = $mock_post_repository->create($post_data);

        $this->assertTrue($token_check);
        $this->assertTrue($result);
    }

    /**
     * Test the update method of the PostService class
     */
    public function testUpdate() 
    {
        $post_service = new PostService();

        $mock_post_repository = $this->getMockBuilder(PostRepository::class)->getMock();
        $mock_post_repository->method('update')->willReturn(true);

        $_SESSION['csrf_token']['post_update'] = 'valid_token';

        $_POST = [
            'id'      => 100,
            'user_id' => '1',
            'title' => 'Test Title',
            'body' => 'Test Body',
            'csrf_token' => 'valid_token'
        ];
           
        $token_check = $post_service->checkToken('post_update');
        $post_data =  $post_service->makePost($_POST);

        $result = $mock_post_repository->update($post_data);

        $this->assertTrue($token_check);
        $this->assertTrue($result);
    }

    /**
     * Test the delete method of the PostService class
     */
    public function testDelete() 
    {
        $post_service = new PostService();

        $mock_post_repository = $this->getMockBuilder(PostRepository::class)->getMock();
        $mock_post_repository->method('delete')->willReturn(true);

        $_SESSION['csrf_token']['post_delete'] = 'valid_token';

        $_POST = [
            'id'      => 100,
            'user_id' => '1',
            'title' => 'Test Title',
            'body' => 'Test Body',
            'csrf_token' => 'valid_token'
        ];
           
        $token_check = $post_service->checkToken('post_delete');
        $post_data =  $post_service->makePost($_POST);

        $result = $mock_post_repository->delete($post_data);

        $this->assertTrue($token_check);
        $this->assertTrue($result);
    }
}
