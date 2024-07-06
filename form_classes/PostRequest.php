<?php

namespace app\form_classes;

use app\axis\toolbox\Session;
use app\axis\https\Validator;
use app\models\repositories\PostRepository;
use app\axis\database\DataBaseConnect;

require_once 'interfaces\form_classes\IPostRequest.php';

class PostRequest implements IPostRequest {

    protected ?int    $id;
    protected ?int    $user_id;
    protected ?string $title;
    protected ?string $body;

    /** constructor */
    function __construct(?array $data){
        if(!isset($data['delete'])){
            $this->validate($data);
        }
        $this->id          = $data['id']      ?? 0;
        $this->user_id     = $data['user_id'] ?? 0;
        $this->title       = $data['title']    ?? '';
        $this->body        = $data['body']    ?? '';
	}

    /** setter */
    public function setId($id){
        $this->id = $id;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function setBody($body){
        $this->body = $body;
    }

    /** getter */
    public function getId(){
        return $this->id;
    }

    public function getUserId(){
        return $this->user_id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getBody(){
        return $this->body;
    }

    public function getArrayData(){
        return [
            'id'         => $this->id,
            'user_id'    => $this->user_id,
            'title'       => $this->title,
            'body'      => $this->body,
        ];
    }

    /**
     * Validate POST data.
     * @param
     * @return $array
     */
    public function validate($targetData) {

        unset($_SESSION['errors']);
        $validator       = new Validator;
        $session         = new Session;
        $post_title = $targetData['title'];
        /**
         * $value, $field, $required
         */
        $errors = $validator->validateString($post_title, 'title', true, 0, 100);
        if ($errors !== [] &&  count($errors) > 0) {
          $_SESSION['errors'] = $validator->getErrors();
          $session->oldPostValue($targetData);
          if(!empty($targetData['id'])){
              $param = '?id='. $targetData['id'];
              header('Location: /post/update'.$param);
              exit();
          }else{
              header('Location: /post/create');
              exit();
          }
        }
    }
}

?>