<?php

namespace Moduels\Auth\Tests;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_render_login_page(): void
    {
        $response = $this->get(route('auth.login'));

        $response->assertOk();
        $response->assertViewIs('Auth::login');
    }

    public function test_email_is_required_and_valid(): void
    {
        $this->post(route('auth.login'), $this->makeUser(['email' => '']))
            ->assertInvalid()
            ->assertSessionHasErrors('email')
            ->assertRedirect();

        $this->post(route('auth.login'), $this->makeUser(['email' => 'example.com']))
            ->assertInvalid()
            ->assertSessionHasErrors('email')
            ->assertRedirect();
    }

    public function test_password_is_required_and_valid(): void
    {
        $this->post(route('auth.login'), $this->makeUser(['password' => '']))
            ->assertInvalid()
            ->assertSessionHasErrors('password')
            ->assertRedirect();

        $this->post(route('auth.login'), $this->makeUser(['password' => '123456']))
            ->assertInvalid()
            ->assertSessionHasErrors('password')
            ->assertRedirect();
    }

    public function test_user_can_login(): void
    {
        $user = User::factory()->create();

        auth()->login($user);

        $this->post(route('auth.login'), [
            'email' => $user->email,
            'password' => $user->password,
        ])
            ->assertRedirect(route('admin.panel'));
    }

    private function makeUser(array $attributes = []): array
    {
        $user = User::factory()->make();

        return array_merge([
            'email' => $user->email,
            'password' => $user->password,
        ], $attributes);
    }
}