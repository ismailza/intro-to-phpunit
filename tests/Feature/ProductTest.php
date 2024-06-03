<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JsonException;
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

    /**
     * Test if the product creation page is displayed.
     * @return void
     */
    public function test_product_creation_page_is_displayed(): void
    {
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get('/products/create');

        $response->assertOk();
    }

    /**
     * Test if the product can be created.
     * @return void
     * @throws JsonException
     */
    public function test_product_can_be_created(): void
    {
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->post('/products', [
                'name' => 'Test Product',
                'description' => 'Test Product Description',
                'price' => 100,
                'stock' => 10,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/products');

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'Test Product Description',
            'price' => 100,
            'stock' => 10,
        ]);
    }

    /**
     * Test if the product can be updated.
     * @return void
     * @throws JsonException
     */
    public function test_product_can_be_updated(): void
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();
        $response = $this
            ->actingAs($user)
            ->patch('/products/' . $product->id, [
                'name' => 'Test Update Product',
                'description' => 'Test Update Product Description',
                'price' => 100,
                'stock' => 10,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/products');

        $product->refresh();

        $this->assertSame('Test Update Product', $product->name);
        $this->assertSame('Test Update Product Description', $product->description);
        $this->assertSame(100, $product->price);
        $this->assertSame(10, $product->stock);
    }
}
