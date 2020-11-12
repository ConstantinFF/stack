<?php
namespace Stack\Repository;

use Stack\Models\Post;
use Stack\Models\User;
use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
    public function all(): Collection;

    public function createComment(array $attributes, Post $post, User $user): Post;

    public function getAllPostsWithComments(): Collection;
}
