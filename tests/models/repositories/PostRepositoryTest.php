<!-- vendor/bin/phpunit tests\models\repositories\PostRepositoryTest.php -->
<?php

use PHPUnit\Framework\TestCase;
use app\models\repositories\PostRepository;
use app\models\entities\PostEntity;
use app\anchor\database\DataBaseConnect;

class PostRepositoryTest extends TestCase
{
    public function testShow()
    {
        // Mock DatabaseConnect class
        $dbConnect = new DataBaseConnect;
        
        // Create PostRepository instance with mocked DatabaseConnect
        $postRepository = new PostRepository($dbConnect);

        // Execute the show method
        $result = $postRepository->show();

        // Assert that the result is an array
        $this->assertIsArray($result);
    }

    // Similar test methods can be created for other methods in PostRepository
}

