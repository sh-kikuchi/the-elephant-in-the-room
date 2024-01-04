<?php

namespace app\models\entities;

class PostEntity
{
    private $id;
    private $userId;
    private $title;
    private $body;
    private $createdAt;
    private $updatedAt;

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
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
        return $this->createdAt = $created_at;
    }

    public function setUpdatedAt(string $updatedAt): string
    {
        return $this->updatedAt = $updated_at;
    }
}
