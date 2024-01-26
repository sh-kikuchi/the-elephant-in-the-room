<!-- vendor/bin/phpunit tests\models\entities\PostEntityTest.php -->
<?php
use PHPUnit\Framework\TestCase;
use app\models\entities\PostEntity;

class PostEntityTest extends TestCase {
    public function testGetters() {
        $post = new PostEntity();
        $post->setId(1);
        $post->setUserId('user123');
        $post->setTitle('Sample Title');
        $post->setBody('Sample Body');
        $post->setCreatedAt('2022-01-01 12:00:00');
        $post->setUpdatedAt('2022-01-02 14:30:00');

        $this->assertEquals(1, $post->getId());
        $this->assertEquals('user123', $post->getUserId());
        $this->assertEquals('Sample Title', $post->getTitle());
        $this->assertEquals('Sample Body', $post->getBody());
        $this->assertEquals('2022-01-01 12:00:00', $post->getCreatedAt());
        $this->assertEquals('2022-01-02 14:30:00', $post->getUpdatedAt());
    }

    public function testSetters() {
        $post = new PostEntity();
        $post->setId(1);
        $post->setUserId('user123');
        $post->setTitle('Sample Title');
        $post->setBody('Sample Body');
        $post->setCreatedAt('2022-01-01 12:00:00');
        $post->setUpdatedAt('2022-01-02 14:30:00');

        $this->assertEquals(1, $post->getId());
        $this->assertEquals('user123', $post->getUserId());
        $this->assertEquals('Sample Title', $post->getTitle());
        $this->assertEquals('Sample Body', $post->getBody());
        $this->assertEquals('2022-01-01 12:00:00', $post->getCreatedAt());
        $this->assertEquals('2022-01-02 14:30:00', $post->getUpdatedAt());
    }
}
