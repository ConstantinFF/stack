<?php

namespace Tests\Integration;

use Tests\TestCase;
use Stack\Models\User;

class AskTest extends TestCase
{
    public function testPostQuestion()
    {
        $this->hasSession();
        $this->migrate();

        $this->database()
            ->table('users')
            ->insert([
                ['id' => 13, 'email' => 'konstantin@example.com', 'password' => '123'],
            ]);

        $response = $this
            ->as($user = User::find(13))
            ->request('post', '/ask', [
                'title' => 'Awesome question',
                'description' => 'foo description',
            ]);

        $user->load('posts');

        $this->assertEquals([
            'user_id' => '13',
            'title' => 'Awesome question',
            'description' => 'foo description',
          
        ], $user->posts->first()->only([
            'user_id',
            'title',
            'description',
        ]));
    }
}
