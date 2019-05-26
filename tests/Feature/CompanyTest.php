<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCompaniesPage()
    {
        $user = factory(User::class)->make(['role_id' => 3]);
        $this->actingAs($user);
        $response = $this->get('/companies/companies');

        $response->assertStatus(200);
    }

    public function testDetailCompanyPage(){
        $user = factory(User::class)->make(['role_id' => 3]);
        $company = factory(Company::class)->make();

        $this->actingAs($user);
        $response = $this->get('/companies/company', $company->id);
        $response->assertStatus(200);
    }

    public function testAccountRegisterCompanyPage(){
        $user = factory(User::class)->make(['role_id' => 5]);
        $this->actingAs($user);

        $response = $this->get('/account');
        $response->assertSeeText('Bedrijf Registratie');
    }
}
