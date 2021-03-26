<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthControllerTest extends TestCase
{


    public function testJwtAuth()
    {
        $response = $this->post('/api/auth/login', [
            'email' => 'test@test.ru',
            'password' => 'password',
        ]);

        $result = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('access_token', $result);
    }


}
