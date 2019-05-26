<?php

namespace Tests\Feature;

use App\User;
use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
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
    public function testViewArticle()
    {
        $user = factory(User::class)->create(['role_id' => 1]);
        $this->actingAs($user);

        $article = factory(Article::class)->create();
        $response = $this->get(sprintf("/article/%s", $article->id));
        $response->assertStatus(200);
    }
}
