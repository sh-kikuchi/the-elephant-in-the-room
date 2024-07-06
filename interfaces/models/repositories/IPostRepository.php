<?php
namespace app\models\repositories;

use app\form_classes\PostRequest;
use app\models\entities\PostEntity as Post;

interface IPostRepository {

    public function show(): array;

    public function getPost($id): array;

    public function create(Post $post): bool;

    public function update(Post $post): bool;

    public function delete(Post $post): bool;
}
