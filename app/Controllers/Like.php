<?php

namespace Stack\Controllers;

use Stack\Models\Post;
use Stack\Services\Auth\AuthInterface;
use Stack\Controllers\Traits\HasAccess;
use Symfony\Component\HttpFoundation\Request;

class Like extends Controller
{
    use HasAccess;

    private $auth;

    private $request;

    public function __construct(AuthInterface $auth, Request $request)
    {
        $this->auth = $auth;
        $this->request = $request;

        parent::__construct();
    }

    protected function access()
    {
        return $this->auth->user();
    }

    public function __invoke()
    {
        $post = Post::findOrFail($this->routerMatch['post_id']);
        
        $this->auth->user()->likePost(
            $post,
            (boolean) $this->request->request->get('like')
        );

        return redirect('/#post-' . $post->id);
    }
}
