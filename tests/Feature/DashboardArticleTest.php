<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup the database because we need to persist users.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }
    
    /**
     * Check if user edit is good.
     *
     * @return void
     */
    public function testArticleView()
    {
        $user = factory(User::class)->create(['role_id' => 2]);
        $this->actingAs($user);
        $article = factory(Article::class)->create();

        $response = $this->get(sprintf("/dashboard/articles/%s", $article->id));
        $response->assertStatus(200);
    }

    public function testArticleCreate(){
        $user = factory(User::class)->create(['role_id' => 2]);
        $this->actingAs($user);
        $response = $this->get("/dashboard/article/create");
        $response->assertStatus(200);
    }

    public function testArticleList(){
        $user = factory(User::class)->create(['role_id' => 2]);
        $this->actingAs($user);
        $article = factory(Article::class)->create();
        $response = $this->get("/dashboard/articles");
        $response->assertStatus(200);
    }
}
