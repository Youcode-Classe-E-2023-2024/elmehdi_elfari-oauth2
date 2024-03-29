<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testRegister()
    {
        $existingUser = User::factory()->create([
            'email' => 'test@example.com',
        ]);

        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'role_id' => '1',
        ];

        $response = $this->json('POST', '/api/auth/register', $userData);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'User registered successfully'
            ]);


    }
}
