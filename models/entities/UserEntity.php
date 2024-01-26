<?php

namespace app\models\entities;

class UserEntity
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $created_at;
    private $updated_at;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function setId(int $id) {
        return $this->id = $id;
    }

    public function setName(string $name) {
        return $this->name = $name;
    }

    public function setEmail(string $email) {
        return $this->email = $email;
    }

    public function setPassword(string $password):string {
        return $this->password = $password;
    }

    public function setCreatedAt(string $created_at): string {
        return $this->created_at = $created_at;
    }

    public function setUpdatedAt(string $updated_at): string {
        return $this->updated_at = $updated_at;
    }

}
