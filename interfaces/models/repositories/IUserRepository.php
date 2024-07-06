<?php

namespace app\models\repositories;
use app\models\entities\UserEntity as User;

interface IUserRepository {
    public function signup(User $user): bool;

    public function signin(User $user): bool;

    public function getUserByEmail(string $email);

    public function checkSign(): bool;
    
    public function signout(): void;
}

