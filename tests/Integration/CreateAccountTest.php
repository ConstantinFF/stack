<?php

namespace Tests\Integration;

use Tests\TestCase;
use Stack\Models\User;

class CreateAccountTest extends TestCase
{
    public function testCreateUser()
    {
        $this->migrate();

        $response = $this->request('post', '/register', [
            'email' => 'foo@bar.com',
            'password' => '123456',
            'confirm_password' => '123456',
        ]);

        $user = User::first();

        $this->assertEquals('foo@bar.com', $user->email);
        $this->assertNotEquals('123456', $user->password);
        $this->assertTrue(password_verify('123456', $user->password));
    }
}
