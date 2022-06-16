<?php

namespace Tests\Feature;

// use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RestaurantTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fetchAllBooks()
    {
        $restaurant1 = factory(Restaurant::class)->create();
        $response = $this->get('/');

        // $restaurants = Restaurant::all();

        $response->assertStatus(200);
    }
}
