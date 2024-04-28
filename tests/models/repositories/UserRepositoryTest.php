<!-- vendor/bin/phpunit tests\models\repositories\UserRepositoryTest.php -->
<?php

use PHPUnit\Framework\TestCase;
use app\models\repositories\UserRepository;
use app\models\entities\UserEntity;
use app\axis\database\DataBaseConnect;

class UserRepositoryTest extends TestCase {
    
    public function testSignup() {
        // Mock DatabaseConnect class
        $dbConnect = new DataBaseConnect;

        // Create UserRepository instance with mocked DatabaseConnect
        $userRepository = new UserRepository($dbConnect);
    
        // Mock UserEntity
        $userEntityMock = $this->createMock(UserEntity::class);
        $userEntityMock->expects($this->once())
            ->method('getName')
            ->willReturn('Test User');
        $userEntityMock->expects($this->once())
            ->method('getEmail')
            ->willReturn('test@example.com');
        $userEntityMock->expects($this->once())
            ->method('getPassword')
            ->willReturn('hashed_password');
    
        // Execute the signup method
        $result = $userRepository->signup($userEntityMock);
    
        // Assert that the result is true
        $this->assertTrue($result);
    }
    
    // Add more test methods for other UserRepository methods (signin, getUserByEmail, checkSign, signout)
}

