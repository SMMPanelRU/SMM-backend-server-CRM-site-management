<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use App\Models\Site;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsTest extends TestCase
{

    use  WithFaker;


    public function test_empty_header()
    {

        $response = $this->get(route('api.products'));

        $response->assertStatus(403);
    }

    public function test_wrong_api_key()
    {

        $apiKey   = '123456';
        $response = $this->get(route('api.products'), ['HTTP_Authorization' => 'Bearer ' . $apiKey]);

        $response->assertStatus(403);
    }

    public function test_index()
    {

        $site     = Site::query()->first();
        $response = $this->get(route('api.products'), ['HTTP_Authorization' => 'Bearer ' . $site->api_key]);

        $response->assertStatus(200);
    }

    public function test_for_site()
    {

        $site = Site::query()->first();

        $product = Product::factory()->create();

        /* @var \App\Models\Product $product */

        $product->sites()->sync([$site->id]);

        $response = $this->json('GET', route('api.products'), [], ['HTTP_Authorization' => 'Bearer ' . $site->api_key])->assertStatus(200)->assertJsonFragment(['id' => $product->id]);

    }
}
