<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Article;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_CheckIfReceiveAllEntryOfArticleInJsonFile()
    {
        Article::create([
            'name' => 'Apple',
            'section' => 'Fruits'
        ]);
        Article::create([
            'name' => 'Pear',
            'section' => 'Fruits'
        ]);
        $response = $this->get(route('apihome'));
        $response->assertStatus(200)
                 ->assertJsonCount(2);
    }

    public function test_CheckIfCanDeleteEntryInArticlesWithApi()
    {
        Article::create([
            'name' => 'Melon',
            'section' => 'Fruits'
        ]);
        Article::create([
            'name' => 'Grape',
            'section' => 'Fruits'
        ]);
        $response = $this->delete(route('apidestroy', 1));
        $this->assertDatabaseCount('articles', 1);
        $response = $this->get(route('apihome'));
        $response->assertJsonCount(1);
    }

    public function test_CheckIfCanCreateNewEntryInJournalWithJsonFile()
    {
        $response = $this->post(route('apistore'), [
            'name' => 'Peach',
            'section' => 'Fruits'
        ]);
        $response = $this->get(route('apihome'));
        $response->assertStatus(200)
                ->assertJsonCount(1);
    }
}
