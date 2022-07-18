<?php

namespace Tests\Feature;

use App\Models\Advertisement;
use App\Models\ImageLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class AdvertisementTest extends TestCase
{
    use RefreshDatabase;

     /** @test */
    public function a_user_can_create_advertisement()
    {
        $params = [
            "title" => "advt 1",
            "description" => "this is description of advt",
            "price" => 10.25,
            "image_links" => ["link1", "link2", "link3"]
        ];

        $response = $this->post(env('APP_URL').'/api/advertisement', $params)
            ->assertStatus(200)
            ->assertJson([
                'message' => 'created',
                'status_code' => 200
            ])->getOriginalContent();

        $this->assertDatabaseHas('advertisements', Arr::except($params, 'image_links'));

        $this->assertDatabaseHas('image_links', [
            'link' => $params['image_links'][0],
            'advertisement_id' => $response['id']
        ]);
    }

     /** @test */
    public function a_user_can_view_advertisement()
    {
        $advertisement = Advertisement::factory()
                            ->has(ImageLink::factory()->count(3))
                            ->create();

        $this->get(env('APP_URL').'/api/advertisement/'.$advertisement->id)
            ->assertStatus(200)
            ->assertJson($advertisement->load('imageLinks')->toArray());
    }
}
