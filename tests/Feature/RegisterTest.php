<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use Illuminate\Support\Str;


class RegisterTest extends TestCase
{
    #[Test]
    public function user_can_register_successfully()
    {
        $email = 'testuser' . Str::random(10) . '@example.com'; // Генерираме уникален имейл

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => $email,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);

        $response->assertRedirect(route('tasks.index'));
        $response->assertSessionHas('success', 'User registered!');
    }



}
