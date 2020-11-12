<?php

namespace Tests\Integration;

use Tests\TestCase;
use Stack\Models\User;

class HomeTest extends TestCase
{
    public function testUnauthenticatedHomePage()
    {
        $this->migrate();
        $this->hasSession();

        $response = $this->request('get', '/');

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertEquals('/login', $response->headers->get('location'));
    }

    public function testAuthenticatedHomePage()
    {
        $this->migrate();
        $this->database()
            ->table('users')
            ->insert([
                ['id' => 13, 'email' => 'konstantin@example.com', 'password' => '123'],
            ]);

        $this->hasSession();
        $this->as(User::find(13));

        $response = $this->request('get', '/');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testMissingPage()
    {
        $this->migrate();

        $invalidPage = $this->request('get', '/invalid-page-url');

        $this->assertEquals(200, $invalidPage->getStatusCode());
        $this->assertStringContainsString('Error | 404', $invalidPage->getContent());
    }
}
