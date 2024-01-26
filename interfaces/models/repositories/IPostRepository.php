<?php
namespace app\models\repositories;

use app\classes\PostRequest;
use app\models\entities\PostEntity as Post;

interface IPostRepository {

    public function show(): array;

    public function getPost($id): object;

    public function create(Post $post): bool;

    public function update(Post $post): bool;

    public function delete(PostRequest $post_request): bool;
}
