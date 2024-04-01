<?php

namespace Modules\Admin\Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    private string $tableName = 'users';

    public function test_render_profile_page(): void
    {
        $user = User::factory()->create();

        auth()->login($user);

        $this->get(route('admin.profile'))
            ->assertViewIs('Admin::profile')
            ->assertViewHas(['user']);
    }

    public function test_user_name_is_required(): void
    {
        $user = User::factory()->create();

        auth()->login($user);

        $this->put(route('admin.profile.update', ['user' => $user]), $this->makeUser(['name' => '']))
            ->assertInvalid()
            ->assertSessionHasErrors('name')
            ->assertRedirect();
    }

    public function test_email_is_required_and_valid(): void
    {
        $user = User::factory()->create();

        auth()->login($user);

        $this->put(route('admin.profile.update', ['user' => $user]), $this->makeUser(['email' => '']))
            ->assertInvalid()
            ->assertSessionHasErrors('email')
            ->assertRedirect();

        $this->put(route('admin.profile.update', ['user' => $user]), $this->makeUser(['email' => 'example.com']))
            ->assertInvalid()
            ->assertSessionHasErrors('email')
            ->assertRedirect();

        $this->put(route('admin.profile.update', ['user' => $user]), $this->makeUser(['email' => 'example@.com']))
            ->assertInvalid()
            ->assertSessionHasErrors('email')
            ->assertRedirect();
    }

    public function test_password_is_required_and_valid(): void
    {
        $user = User::factory()->create();

        auth()->login($user);

        $this->put(route('admin.profile.update', ['user' => $user]), $this->makeUser(['password' => '']))
            ->assertInvalid()
            ->assertSessionHasErrors('password')
            ->assertRedirect();

        $this->put(route('admin.profile.update', ['user' => $user]), $this->makeUser(['password' => '123456']))
            ->assertInvalid()
            ->assertSessionHasErrors('password')
            ->assertRedirect();
    }

    public function test_update_user_profile(): void
    {
        $user = User::factory()->create();

        auth()->login($user);

        $response = $this->put(route('admin.profile.update', ['user' => $user]), $this->makeUser([
            'name' => 'John',
        ]));

        $response->assertSessionHas('success');
        $response->assertRedirect();

        $this->assertDatabaseHas($this->tableName, ['name' => 'John']);
        $this->assertDatabaseCount($this->tableName, 1);
        $this->assertEquals(1, User::query()->count());
    }

    private function makeUser(array $attributes = []): array
    {
        $user = User::factory()->make();

        return array_merge([
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ], $attributes);
    }
}