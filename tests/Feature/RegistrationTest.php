<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    public function test_user_can_register()
    {
        $response = $this->post('/api/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $user = User::factory()->create([
            'password' => bcrypt($password = 'rooster'),
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'rooster',
            'device_name' => 'test-device'
        ]);

        $response->assertStatus(200);
    }
}
