<?php

namespace app\services;

interface IUserService {
    public function myPage();
    public function signupForm();
    public function signup();
    public function signinForm();
    public function signin();
    public function signout();
    public function mail();
    public function upload();
    public function makeUser($user_form);
}
