<?php

namespace Modules\Auth\Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterTest extends TestCase
{
    public function test_render_register_page(): void
    {
        $response = $this->get(route('auth.register'));

        $response->assertStatus(200);

        $view = $this->view('Auth::register');

        $view->assertSee('Register a new account');
    }

    public function test_post_request_is_valid(): void
    {
        $this->post(route('auth.register'), $this->makeUser())
            ->assertValid()
            ->assertSessionHasNoErrors();
    }

    public function test_name_is_required(): void
    {
        // $this->withExceptionHandling();

        $this->post(route('auth.register'), $this->makeUser(['name' => '']))
            ->assertInValid()
            ->assertSessionHasErrors('name');
    }

    public function test_email_is_required_and_is_valid(): void
    {
        $this->post(route('auth.register'), $this->makeUser(['email' => '']))
            ->assertInValid()
            ->assertSessionHasErrors('email');

        $this->post(route('auth.register'), $this->makeUser(['email' => 'example.com']))
            ->assertInValid()
            ->assertSessionHasErrors('email');
    }

    public function test_password_is_required_and_is_valid(): void
    {
        $this->post(route('auth.register'), $this->makeUser([
            'password' => '',
            'password_confirmation' => '',            
        ]))
            ->assertInValid()
            ->assertSessionHasErrors('password');

        $this->post(route('auth.register'), $this->makeUser([
            'password_confirmation' => Hash::make('not_matched_password'),
        ]))
            ->assertInValid()
            ->assertSessionHasErrors('password');

        $this->post(route('auth.register'), $this->makeUser([
            'password' => '123456',  // Must be at least 8 characters
            'password_confirmation' => '123456',
        ]))
            ->assertInValid()
            ->assertSessionHasErrors('password');
    }

    private function makeUser(array $attributes = []): array
    {
        $user = User::factory()->make();

        return array_merge([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'password_confirmation' => $user->password,
        ], $attributes);
    }
}