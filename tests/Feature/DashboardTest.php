<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    public function testRedirectDashboard()
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(302);
    }

    public function testNoRedirectDashboard()
    {
        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);

        $response = $this->get('/dashboard');

        $response->assertStatus(200);
    }
}
