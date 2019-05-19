<?php

namespace Tests\Feature;

use App\Location;
use App\Minor;
use App\Organisation;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardMinorTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testMinorPage()
    {
        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);

        $response = $this->get('/dashboard/minors');

        $response->assertStatus(200);
    }

    public function testMinorViewRedirectNonexisting()
    {
        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);

        $response = $this->get('/dashboard/minor/_error_');

        $response->assertStatus(302);
    }

    public function testMinorViewExisting()
    {
        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);

        $organisation = factory(Organisation::class)->create();
        $location = factory(Location::class)->create();
        $minor = factory(Minor::class)->create();

        $response = $this->get('/dashboard/minor/' . $minor->id);

        $response->assertStatus(200);
    }

    public function testMinorEditView()
    {
        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);

        $organisation = factory(Organisation::class)->create();
        $location = factory(Location::class)->create();
        $minor = factory(Minor::class)->create();

        $response = $this->get('/dashboard/minor/' . $minor->id . '/edit');

        $response->assertStatus(200);
    }

    public function testMinorEditPost()
    {
        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);

        $organisation = factory(Organisation::class)->create();
        $location = factory(Location::class)->create();
        $minor = factory(Minor::class)->create();

//        $response = $this->get('/dashboard/minor/' . $minor->id . '/edit');
        $response = $this->post('/dashboard/minor/' . $minor->id . '/edit', ['name' => "TEST"]);

        $response->assertStatus(302);
        self::assertSame("TEST", Minor::find($minor->id)->first()->name);
    }
}
