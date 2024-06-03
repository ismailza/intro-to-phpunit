<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test listing products via API
     * @return void
     */
    public function test_api_listing_products(): void
    {
        $product = Product::factory()->create();
        $response = $this->getJson('/api/products');

        $response->assertJson([$product->toArray()]);
    }

    /**
     * Test showing a product via API
     * @return void
     */
    public function test_api_show_product(): void
    {
        $product = Product::factory()->create();
        $response = $this->getJson('/api/products/' . $product->id);

        $response->assertJson($product->toArray());
    }

    /**
     * Test creating a product successful via API
     * @return void
     */
    public function test_api_create_product_successful(): void
    {
        $product = Product::factory()->create();
        $response = $this->postJson('/api/products', $product->toArray());

        $response->assertStatus(201);
        $response->assertJson(['message' => 'Product created successfully.']);
    }

    /**
     * Test updating a product successful via API
     * @return void
     */
    public function test_api_update_product_successful(): void
    {
        $product = Product::factory()->create();
        $response = $this->putJson('/api/products/' . $product->id, $product->toArray());

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Product updated successfully.']);
    }

    /**
     * Test deleting a product successful via API
     * @return void
     */
    public function test_api_delete_product_successful(): void
    {
        $product = Product::factory()->create();
        $response = $this->deleteJson('/api/products/' . $product->id);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Product deleted successfully.']);
    }
}
