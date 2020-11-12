<?php

namespace Tests\Integration;

use Tests\TestCase;
use Stack\Models\Post;
use Stack\Models\User;

class AnswerTest extends TestCase
{
    public function testAnswerQuestion()
    {
        $this->migrate();

        $this->database()
            ->table('users')
            ->insert([
                ['id' => 13, 'email' => 'konstantin@example.com', 'password' => '123'],
            ]);
            
        $this->database()
            ->table('posts')
            ->insert([
                ['id' => 1, 'user_id' => 13, 'title' => 'Foo Title', 'description' => 'bar'],
            ]);

        $response = $this
            ->as($user = User::find(13))
            ->request('post', '/answer/1', [
                'description' => 'foo answer',
            ]);

        $post = Post::find(1);

        $this->assertEquals([
            'user_id' => '13',
            'parent_id' => '1',
            'title' => null,
            'description' => 'foo answer',
          
        ], $post->comments->first()->only([
            'user_id', 'parent_id', 'title', 'description',
        ]));
    }
}
