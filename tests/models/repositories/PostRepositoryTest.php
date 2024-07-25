<!-- vendor/bin/phpunit tests\models\repositories\PostRepositoryTest.php -->
<?php

use PHPUnit\Framework\TestCase;
use app\models\repositories\PostRepository;
use app\models\entities\PostEntity as Post;

/**
 * Test case for the PostRepository class
 */
class PostRepositoryTest extends TestCase
{
    private $pdo;
    private $postRepository;
    private $post;

    /**
     * Set up the test environment
     */
    protected function setUp(): void
    {
        // Create a mock of PDO
        $this->pdo = $this->createMock(PDO::class);
        $this->postRepository = new PostRepository($this->pdo);
        $this->post = $this->createMock(Post::class);
    }

    /**
     * Test the show method of the PostRepository class
     */
    public function testShow()
    {
        // Create a mock of PDOStatement
        $statement = $this->createMock(PDOStatement::class);
        $statement->method('fetchAll')->willReturn([
            ['id' => 1, 'user_id' => 1, 'title' => 'Test Title', 'body' => 'Test Body']
        ]);

        // Configure the query method to return the mocked PDOStatement
        $this->pdo->method('query')->willReturn($statement);

        // Execute the show method and verify the result
        $result = $this->postRepository->show();
        var_dump($result[count($result)-1]['title']);
        $this->assertCount(1, $result);
        $this->assertEquals('Test Title', $result[count($result)-1]['title']);
    }

    /**
     * Test the getPost method of the PostRepository class
     */
    public function testGetPost()
    {
        $expectedPost = [
            'id' => 1,
            'title' => 'Test Post',
            'content' => 'This is a test post.'
        ];

        $statement = $this->createMock(PDOStatement::class);

        $statement->method('fetch')->willReturn($expectedPost);

        $this->pdo->method('query')->willReturn($statement);

        $result = $this->postRepository->getPost(1);

        $this->assertEquals($expectedPost, $result);
    }

    /**
     * Test the create method of the PostRepository class
     */
    public function testCreate()
    {
        $this->post->method('getUserId')->willReturn(1);
        $this->post->method('getTitle')->willReturn('Test Title');
        $this->post->method('getBody')->willReturn('Test Body');

        $statement = $this->createMock(PDOStatement::class);
        $statement->expects($this->once())->method('execute')->willReturn(true);

        $this->pdo->method('prepare')->willReturn($statement);
        $this->pdo->expects($this->once())->method('beginTransaction');
        $this->pdo->expects($this->once())->method('commit');

        $result = $this->postRepository->create($this->post);
        $this->assertTrue($result);
    }

    /**
     * Test the update method of the PostRepository class
     */
    public function testUpdate()
    {
        $this->post->method('getId')->willReturn(1);
        $this->post->method('getTitle')->willReturn('Updated Title');
        $this->post->method('getBody')->willReturn('Updated Body');

        $statement = $this->createMock(PDOStatement::class);
        $statement->expects($this->once())->method('execute')->willReturn(true);

        $this->pdo->method('prepare')->willReturn($statement);
        $this->pdo->expects($this->once())->method('beginTransaction');
        $this->pdo->expects($this->once())->method('commit');

        $result = $this->postRepository->update($this->post);
        $this->assertTrue($result);
    }

    /**
     * Test the delete method of the PostRepository class
     */
    public function testDelete()
    {
        $this->post->method('getId')->willReturn(1);

        $statement = $this->createMock(PDOStatement::class);
        $statement->expects($this->once())->method('execute')->willReturn(true);

        $this->pdo->method('prepare')->willReturn($statement);
        $this->pdo->expects($this->once())->method('beginTransaction');
        $this->pdo->expects($this->once())->method('commit');

        $result = $this->postRepository->delete($this->post);
        $this->assertTrue($result);
    }
}
