<?php

namespace app\services;

interface IPostService {
    public function index();
    public function createForm();
    public function updateForm();
    public function create();
    public function update();
    public function delete();
}