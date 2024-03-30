<?php

namespace Modules\Admin\Tests\Feature;

use Tests\TestCase;

class UserProfileTest extends TestCase
{
    public function test_render_profile_page(): void
    {
        $this->get(route('admin.profile'))
            ->assertViewIs('Admin::profile');
    }
}