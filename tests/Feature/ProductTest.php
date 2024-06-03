<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the products page is displayed.
     * @return void
     */
    public function test_products_page_is_displayed(): void
    {
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get('/products');

        $response->assertOk();
    }

    /**
     * Test the products page with no products.
     * @return void
     */
    public function test_products_page_with_no_products(): void
    {
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get('/products');

        $response->assertSee(__('No products found!'));
    }

    /**
     * Test the products page with products.
     * @return void
     */
    public function test_products_page_with_products(): void
    {
        $user = User::factory()->create();
        Product::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get('/products');

        $response->assertDontSee(__('No products found!'));
    }

    /**
     * Test if the product page is displayed.
     * @return void
     */
    public function test_product_page_is_displayed(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get('/products/' . $product->id);

        $response->assertOk();
    }
}
