<?php

namespace Modules\Auth\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_render_register_page(): void
    {
        $response = $this->get(route('auth.register'));

        $response->assertOk();
        $response->assertViewIs('Auth::register');
    }

    public function test_post_request_is_valid(): void
    {
        $this->post(route('auth.register'), $this->makeUser())
            ->assertValid()
            ->assertSessionHasNoErrors()
            ->assertRedirect();
    }

    public function test_name_is_required(): void
    {
        // $this->withExceptionHandling();

        $this->post(route('auth.register'), $this->makeUser(['name' => '']))
            ->assertInValid()
            ->assertSessionHasErrors('name')
            ->assertRedirect();
    }

    public function test_email_is_required_and_is_valid(): void
    {
        $this->post(route('auth.register'), $this->makeUser(['email' => '']))
            ->assertInValid()
            ->assertSessionHasErrors('email')
            ->assertRedirect();

        $this->post(route('auth.register'), $this->makeUser(['email' => 'example.com']))
            ->assertInValid()
            ->assertSessionHasErrors('email')
            ->assertRedirect();
    }

    public function test_password_is_required_and_is_valid(): void
    {
        $this->post(route('auth.register'), $this->makeUser([
            'password' => '',
            'password_confirmation' => '',
        ]))
            ->assertInValid()
            ->assertSessionHasErrors('password')
            ->assertRedirect();

        $this->post(route('auth.register'), $this->makeUser([
            'password_confirmation' => Hash::make('not_matched_password'),
        ]))
            ->assertInValid()
            ->assertSessionHasErrors('password')
            ->assertRedirect();

        $this->post(route('auth.register'), $this->makeUser([
            'password' => '123456',  // Must be at least 8 characters
            'password_confirmation' => '123456',
        ]))
            ->assertInValid()
            ->assertSessionHasErrors('password')
            ->assertRedirect();
    }

    public function test_user_can_register(): void
    {
        $response = $this->post(route('auth.register'), $this->makeUser());

        $response->assertRedirect();
        $this->assertEquals(1, User::query()->count());
    }

    public function test_logged_in_user_can_not_see_register_page(): void
    {
        $user = User::factory()->create();

        auth()->login($user);

        $this->get(route('auth.register'))
            ->assertRedirect();
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
