<?php

namespace app\models\entities;

class UserEntity
{
    private $id;
    private $name;
    private $email;
    private $password;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setId()
    {
        return $this->id;
    }

    public function setName()
    {
        return $this->name;
    }

    public function setEmail()
    {
        return $this->email;
    }

    public function setPassword()
    {
        return $this->password;
    }

    // Add setters if needed

    public function setData(array $data)
    {
        $this->id       = $data['id'] ?? null;
        $this->name     = $data['name'] ?? null;
        $this->email    = $data['email'] ?? null;
        $this->password = $data['password'] ?? null;
    }
}
