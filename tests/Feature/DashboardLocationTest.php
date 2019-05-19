<?php

namespace Tests\Feature;

use App\Location;
use App\Organisation;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardLocationTest extends TestCase
{
    public function testLocationPage()
    {
        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);

        $response = $this->get('/dashboard/locations');

        $response->assertStatus(200);
    }

    public function testLocationView()
    {
        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);

        $organisation = factory(Organisation::class)->create();
        $location = factory(Location::class)->create();

        $response = $this->get('/dashboard/location/' . $location->id);

        $response->assertStatus(200);
    }
}
