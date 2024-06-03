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

}
