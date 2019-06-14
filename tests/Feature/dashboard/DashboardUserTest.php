<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Check if user edit is good.
     *
     * @return void
     */
    public function testViewUser()
    {
        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);
        $editUser = factory(User::class)->make(['role_id' => 1]);
        $response = $this->get(sprintf("/dashboard/users/%s", $editUser->id));
        $response->assertStatus(200);
    }
}
