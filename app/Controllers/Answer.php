<?php

namespace Stack\Controllers;

use Stack\Models\Post;
use Stack\Services\Auth\AuthInterface;
use Stack\Controllers\Traits\HasAccess;
use Stack\Repository\PostRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;

class Answer extends Controller
{
    use HasAccess;

    private $auth;

    private $request;

    private $postRepository;

    public function __construct(AuthInterface $auth, Request $request, PostRepositoryInterface $postRepository)
    {
        $this->auth = $auth;
        $this->request = $request;
        $this->postRepository = $postRepository;

        parent::__construct();
    }

    protected function access()
    {
        return $this->auth->user();
    }

    public function __invoke()
    {
        $post = Post::findOrFail($this->routerMatch['post_id']);

        $this->postRepository->createComment(
            $this->request->request->all(),
            $post,
            $this->auth->user()
        );

        return redirect('/#post-' . $post->id);
    }
}
