<?php

namespace app\models\repositories;

use app\database\DataBaseConnect;
use app\classes\PostRequest;
use app\models\entities\PostEntity as Post;

require_once 'interfaces\models\repositories\IPostRepository.php';

class PostRepository implements IPostRepository
{
    /**
     * show posts
     * @param array $postData
     * @return array $posts
     */
    public function show():array{
        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql = "SELECT * FROM posts ORDER BY id ASC;";
        $posts = $pdo->query($sql);

        // $post = new PostEntity();
        // $post->hydrate($data);

        return $posts->fetchAll();
    }
    /**
     * get an post
     * @param array $postData
     * @return $posts
     */
    public function getPost($id):object{
        $result = false;
        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql = "SELECT * FROM posts WHERE id = $id;";
        $post_count = $pdo->query($sql);
        return $post_count;
    }
    /**
     * Store Post
     * @param array $post
     * @return --
     */
    public function create(Post $post):bool {

        $result = false;
        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql       = "INSERT INTO posts(user_id, title, body) VALUES(:user_id, :title, :body)";
        $stmt      = $pdo->prepare($sql);
    
        $user_id   = $post->getUserId();
        $title     = $post->getTitle();
        $body      = $post->getBody();

        try{
            $pdo->beginTransaction();
            $stmt->bindValue(":user_id", $user_id, \PDO::PARAM_INT);
            $stmt->bindValue(":title", $title, \PDO::PARAM_STR);
            $stmt->bindValue(":body", $body, \PDO::PARAM_STR);
            $stmt->execute();
            $pdo->commit();
            $result = true;
        }catch(PDOException $e){
            $pdo->rollBack();
            error_log($e -> getMessage());
        }finally{
            return $result;
        }
    }
    /**
     * Delete Post
     * @param array $postData
     * @return --
     */
    public function update(Post $post):bool{
        $result = false;
        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql = "UPDATE posts SET title = :title ,body = :body WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        $id        = $post->getId();
        $title     = $post->getTitle();
        $body      = $post->getBody();

        try{
            $pdo->beginTransaction();
            $stmt->bindValue(":id", $id, \PDO::PARAM_INT);
            $stmt->bindValue(":title", $title, \PDO::PARAM_STR);
            $stmt->bindValue(":body", $body, \PDO::PARAM_STR);
            $stmt->execute();
            $pdo->commit();
            $result = true;
        }catch(PDOException $e){
            $pdo->rollBack();
            error_log($e->getmessage());
        }finally{
            return $result;
        }
    }
    /**
     * Delete Post
     * @param array $postData
     * @return $result
     */
    public function delete(PostRequest $post_request):bool{
        $result = false;
        $dbConnect = new DataBaseConnect();
        $pdo       = $dbConnect->getPDO();
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $id = intval($post_request->getId());
        try{
            $pdo->beginTransaction();
            $stmt->bindValue(":id", $id, \PDO::PARAM_INT);
            $stmt->execute();
            $pdo->commit();
            $result = true;
        }catch(Exception $e){
            $pdo->rollBack();
            $e->getmessage();
        }finally{
            return $result;
        }
    }

}
