<?php

namespace app\services;

interface IUserAuthServiceInterface {
    public function my_page();
    public function signup_form();
    public function signup();
    public function signin_form();
    public function signin();
    public function signout();
    public function mail();
    public function upload();
    public function pdf();
}
