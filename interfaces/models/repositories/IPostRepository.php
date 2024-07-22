<?php

namespace app\models\repositories;

use app\form_classes\PostRequest;
use app\models\entities\PostEntity as Post;

/**
 * Interface IPostRepository
 *
 * Defines the contract for Post repository classes.
 */
interface IPostRepository {

    public function show(): array;
    public function getPost($id): array;
    public function create(Post $post): bool;
    public function update(Post $post): bool;
    public function delete(Post $post): bool;
}
