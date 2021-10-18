<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NewsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_main_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_one_news()
    {
        $response = $this->get(route('news.one', ['id' => mt_rand(1, 4)]));

        $response->assertStatus(404);
    }
}
