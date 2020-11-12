<?php

namespace Stack\Controllers;

use Stack\Services\Auth\AuthInterface;
use Stack\Controllers\Traits\HasAccess;
use Stack\Repository\PostRepositoryInterface;

class Home extends Controller
{
    use HasAccess;

    private $auth;

    private $postRepository;

    public function __construct(AuthInterface $auth, PostRepositoryInterface $postRepository)
    {
        $this->auth = $auth;

        $this->postRepository = $postRepository;

        parent::__construct();
    }

    protected function access()
    {
        return $this->auth->user();
    }

    public function __invoke()
    {
        return view('home', [
            'posts' => $this->postRepository->getAllPostsWithComments(),
            'user' => $this->auth->user(),
        ]);
    }
}
