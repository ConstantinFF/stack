<?php

namespace Tests\Integration;

use Tests\TestCase;
use Stack\Models\Post;
use Stack\Models\User;

class LikeTest extends TestCase
{
    public function testLikeQuestion()
    {
        $this->setupUserAndPost();

        $response = $this
            ->as($user = User::find(13))
            ->request('post', '/like/33', [
                'like' => 1,
            ]);

        $post = Post::withCount(['positiveLikes', 'negativeLikes'])->find(33);

        $this->assertEquals(1, $post->positive_likes_count);
        $this->assertEquals(0, $post->negative_likes_count);
    }

    public function testDislikeQuestion()
    {
        $this->setupUserAndPost();

        $response = $this
            ->as($user = User::find(13))
            ->request('post', '/like/33', [
                'like' => 0,
            ]);

        $post = Post::withCount(['positiveLikes', 'negativeLikes'])->find(33);

        $this->assertEquals(0, $post->positive_likes_count);
        $this->assertEquals(1, $post->negative_likes_count);
    }

    public function testRemoveLike()
    {
        $this->setupUserAndPost();

        $this->database()
            ->table('likes')
            ->insert([
                ['post_id' => 33, 'user_id' => 13, 'is_positive' => 1],
            ]);

        $response = $this
            ->as($user = User::find(13))
            ->request('post', '/like/33', [
                'like' => 1,
            ]);

        $post = Post::withCount(['positiveLikes', 'negativeLikes'])->find(33);

        $this->assertEquals(0, $post->positive_likes_count);
        $this->assertEquals(0, $post->negative_likes_count);
    }

    public function testRemoveDislike()
    {
        $this->setupUserAndPost();

        $this->database()
            ->table('likes')
            ->insert([
                ['post_id' => 33, 'user_id' => 13, 'is_positive' => 0],
            ]);

        $response = $this
            ->as($user = User::find(13))
            ->request('post', '/like/33', [
                'like' => 0,
            ]);

        $post = Post::withCount(['positiveLikes', 'negativeLikes'])->find(33);

        $this->assertEquals(0, $post->positive_likes_count);
        $this->assertEquals(0, $post->negative_likes_count);
    }

    public function testLikeDislikedPost()
    {
        $this->setupUserAndPost();

        $this->database()
            ->table('likes')
            ->insert([
                ['post_id' => 33, 'user_id' => 13, 'is_positive' => 0],
            ]);

        $response = $this
            ->as($user = User::find(13))
            ->request('post', '/like/33', [
                'like' => 1,
            ]);

        $post = Post::withCount(['positiveLikes', 'negativeLikes'])->find(33);

        $this->assertEquals(1, $post->positive_likes_count);
        $this->assertEquals(0, $post->negative_likes_count);
    }

    private function setupUserAndPost()
    {
        $this->hasSession();
        $this->migrate();

        $this->database()
            ->table('users')
            ->insert([
                ['id' => 13, 'email' => 'konstantin@example.com', 'password' => '123'],
            ]);

        $this->database()
            ->table('posts')
            ->insert([
                ['id' => 33, 'user_id' => 13, 'title' => 'Foo question', 'description' => 'foo bar'],
            ]);
    }
}
