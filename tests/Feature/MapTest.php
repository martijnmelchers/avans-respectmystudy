<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MapTest extends TestCase
{
    public function testMap()
    {
        $response = $this->get('/map');

        $response->assertStatus(200);
    }
}
