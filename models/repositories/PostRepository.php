<?php

namespace app\models\repositories;

use app\axis\database\DataBaseConnect;
use app\form_classes\PostRequest;
use app\models\entities\PostEntity as Post;

require_once 'interfaces/models/repositories/IPostRepository.php';

/**
 * Class PostRepository
 * 
 * Implements the IPostRepository interface for managing posts in the database.
 */
class PostRepository implements IPostRepository {
    /**
     * @var \PDO The PDO instance for database interaction.
     */
    private $pdo;

    /**
     * PostRepository constructor.
     * 
     * @param \PDO|null $pdo Optional PDO instance.
     */
    public function __construct($pdo = null)
    {
        if ($pdo === null) {
            $dbConnect = new DataBaseConnect();
            $this->pdo = $dbConnect->getPDO();
        } else {
            $this->pdo = $pdo;
        }
    }
    
    /**
     * Show posts.
     * 
     * @return array $posts List of posts.
     */
    public function show(): array {
        $sql = "SELECT * FROM posts ORDER BY id ASC;";
        $posts = $this->pdo->query($sql);

        return $posts->fetchAll();
    }

    /**
     * Get a post by ID.
     * 
     * @param int $id Post ID.
     * @return array $post The requested post.
     */
    public function getPost($id): array {
        $sql = "SELECT * FROM posts WHERE id = $id;";
        $post = $this->pdo->query($sql);
        return $post->fetch();
    }

    /**
     * Store a post in the database.
     * 
     * @param Post $post The post entity to create.
     * @return bool True on success, false on failure.
     */
    public function create(Post $post): bool {
        $result = false;
        $sql = "INSERT INTO posts(user_id, title, body) VALUES(:user_id, :title, :body)";
        $stmt = $this->pdo->prepare($sql);
    
        $user_id = $post->getUserId();
        $title = $post->getTitle();
        $body = $post->getBody();

        try {
            $this->pdo->beginTransaction();
            $stmt->bindValue(":user_id", $user_id, \PDO::PARAM_INT);
            $stmt->bindValue(":title", $title, \PDO::PARAM_STR);
            $stmt->bindValue(":body", $body, \PDO::PARAM_STR);
            $stmt->execute();
            $this->pdo->commit();
            $result = true;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            error_log($e->getMessage());
        } finally {
            return $result;
        }
    }

    /**
     * Update a post in the database.
     * 
     * @param Post $post The post entity to update.
     * @return bool True on success, false on failure.
     */
    public function update(Post $post): bool {
        $result = false;
        $sql = "UPDATE posts SET title = :title, body = :body WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $id = $post->getId();
        $title = $post->getTitle();
        $body = $post->getBody();

        try {
            $this->pdo->beginTransaction();
            $stmt->bindValue(":id", $id, \PDO::PARAM_INT);
            $stmt->bindValue(":title", $title, \PDO::PARAM_STR);
            $stmt->bindValue(":body", $body, \PDO::PARAM_STR);
            $stmt->execute();
            $this->pdo->commit();
            $result = true;
        } catch (\PDOException $e) {
            $this->pdo->rollBack();
            error_log($e->getMessage());
        } finally {
            return $result;
        }
    }

    /**
     * Delete a post from the database.
     * 
     * @param Post $post The post entity to delete.
     * @return bool True on success, false on failure.
     */
    public function delete(Post $post): bool {
        $result = false;
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $id = intval($post->getId());

        try {
            $this->pdo->beginTransaction();
            $stmt->bindValue(":id", $id, \PDO::PARAM_INT);
            $stmt->execute();
            $this->pdo->commit();
            $result = true;
        } catch (\Exception $e) {
            $this->pdo->rollBack();
            error_log($e->getMessage());
        } finally {
            return $result;
        }
    }
}
