<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ImportTest extends TestCase
{
    public function testRedirect()
    {
        $response = $this->get('/dashboard/import');

        $response->assertStatus(302);
    }

    public function testAdminNoRedirect()
    {
        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);

        $response = $this->get('/dashboard/import');

        $response->assertStatus(200);
    }

    public function testOrganisationImport()
    {
        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);

        $response = $this->get('/import/organizations');

        $response->assertStatus(200);
    }

    public function testLocationImport()
    {
        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);

        $response = $this->get('/import/locations');

        $response->assertStatus(200);
    }

    public function testMinorImport()
    {
        $user = factory(User::class)->make(['role_id' => 2]);
        $this->actingAs($user);

        $response = $this->get('/import/minors');

        $response->assertStatus(200);
    }
}

// test: .\vendor\bin\phpunit