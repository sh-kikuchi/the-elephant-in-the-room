<?php

namespace app\models\repositories;


interface IUserAuth {

    public static function signup($userData): bool;

    public static function signin(array $userData): bool;

    public static function getUserByEmail(string $email);

    public static function checkSign(): bool;

    public static function signout(): void;
}

