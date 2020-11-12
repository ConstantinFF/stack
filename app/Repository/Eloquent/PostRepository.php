<?php

namespace Stack\Repository\Eloquent;

use Stack\Models\Post;
use Stack\Models\User;
use Illuminate\Support\Collection;
use Stack\Services\Auth\Session as Auth;
use Stack\Repository\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    private $auth;

    public function __construct(Post $model, Auth $auth)
    {
        $this->auth = $auth;
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function createComment(array $attributes, Post $post, User $user): Post
    {
        $comment = $user->posts()
            ->create($attributes);

        $comment->post()->associate($post);
        $comment->save();

        return $comment;
    }

    public function getAllPostsWithComments(): Collection
    {
        return Post::with(['user', 'comments.user', 'likes' => function ($query) {
            $query->where('user_id', optional($this->auth->user())->id);
        }])
            ->withCount(['positiveLikes', 'negativeLikes'])
            ->onlyPosts()
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
