<?php

namespace app\services;

/**
 * Interface IPostService
 *
 * Defines the contract for Post service classes.
 */
interface IPostService {
    public function index();
    public function showCreateForm();
    public function showUpdateForm();
    public function create();
    public function update();
    public function delete();
    public function makePost($post_form);
}
