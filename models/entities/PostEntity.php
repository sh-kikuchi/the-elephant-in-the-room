<?php

namespace app\models\entities;

class PostEntity
{
    private $id;
    private $userId;
    private $title;
    private $body;
    private $created_at;
    private $updated_at;

    //Getter
    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    //Setter
    public function setId(int $id)
    {
        return $this->id = $id;
    }

    public function setUserId(string $user_id): string
    {
        return $this->userId = $user_id;
    }

    public function setTitle(string $title): string
    {
        return $this->title = $title;
    }

    public function setBody(string $body): string
    {
        return $this->body = $body;
    }

    public function setCreatedAt(string $created_at): string
    {
        return $this->created_at = $created_at;
    }

    public function setUpdatedAt(string $updated_at): string
    {
        return $this->updated_at = $updated_at;
    }
}
