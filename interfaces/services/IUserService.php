<?php

namespace app\services;

/**
 * Interface IUserService
 *
 * Defines the contract for User service classes.
 */
interface IUserService {
    public function myPage();
    public function showSignUpForm();
    public function signup();
    public function showSignInForm();
    public function signin();
    public function signout();
    public function mail();
    public function upload();
    public function makeUser($user_form, $type);
}
