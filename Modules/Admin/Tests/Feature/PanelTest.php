<?php

namespace Modules\Admin\Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_auth_users_can_see_dashboard(): void
    {
        $user = User::factory()->make();

        auth()->login($user);

        $this->get(route('admin.panel'))
            ->assertViewIs('Admin::panel');
    }

    public function test_non_auth_users_can_not_see_dashboard(): void
    {
        $this->get(route('admin.panel'))
            ->assertRedirect(route('auth.login'));
    }
}