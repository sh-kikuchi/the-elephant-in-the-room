<?php

namespace app\services;

interface IPostService {
    public function index();
    public function showCreateForm();
    public function showUpdateForm();
    public function create();
    public function update();
    public function delete();
    public function makePost($post_form);
}