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

        $response = $this->post('/dashboard/minor/' . $minor->id . '/edit', ['version' => 1, 'name' => "TEST", 'ects' => 30, "contact_hours" => 1]);

        self::assertSame("TEST", Minor::find($minor->id)->first()->name);
        $response->assertRedirect('/dashboard/minor/' . $minor->id . '/?v=1');
        $response->assertStatus(302);
    }

    public function testMinorCreateView()
    {
        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);

        $response = $this->get('/dashboard/minors/create');

        $response->assertStatus(200);
    }

    public function testMinorCreatePost()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);

        $response = $this->post('/dashboard/minors/create', [
            'name' => "Dit is een testminor",
            'ects' => 15,
            "contacthours" => 1,
            "educationtype" => "hbo",
            "language" => "nl",
            "subject" => "BOE",
            "goals" => "BOE",
            "requirements" => "TEST"
        ]);

        $response->assertStatus(302);
        self::assertSame("Dit is een testminor", Minor::first()->name);
    }

    public function testMinorVersionsView()
    {
        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);

        $organisation = factory(Organisation::class)->create();
        $location = factory(Location::class)->create();
        $minor = factory(Minor::class)->create();

        $response = $this->get('/dashboard/minor/' . $minor->id . '/versions');

        $response->assertStatus(200);
    }
}
