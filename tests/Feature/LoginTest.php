<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;

class LoginTest extends TestCase
{
    #[Test]
    public function user_can_login_with_valid_credentials()
    {
        // Генерираме уникален имейл за потребителя
        $user = User::factory()->create([
            'email' => 'testuser' . Str::random(10) . '@example.com',
            'password' => bcrypt('password123'),
        ]);

        // Изпращаме логин заявка
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        // Проверяваме дали потребителят е автентикиран и редиректва
        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('tasks.index'));
        $response->assertSessionHas('success', 'Logged in!');
    }
}
