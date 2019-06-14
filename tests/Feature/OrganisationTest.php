<?php

namespace Tests\Feature;

use App\Organisation;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrganisationTest extends TestCase
{
    public function testOrganisationList()
    {
        $response = $this->get('/organisations');

        $response->assertStatus(200);
    }

    public function testRedirectNonExistingOrganisation()
    {
        $response = $this->get('/organisations/0');

        $response->assertStatus(302);
    }

    public function testOrganisation()
    {
        factory(Organisation::class)->make();
        $response = $this->get('/organisations/' . Organisation::first()->id);

        $response->assertStatus(200);
    }
}
