<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_and_all_static_public_pages_render(): void
    {
        $this->get(route('home'))->assertOk()->assertSee('Delivered to the');
        $this->get(route('about'))->assertOk()->assertSee('Growing Bangladesh');
        $this->get(route('certification'))->assertOk()->assertSee('Documentation for every shipment');
        $this->get(route('how-we-export'))->assertOk()->assertSee('From farm to global market');
        $this->get(route('export-markets'))->assertOk()->assertSee('Our Market Reach');
        $this->get(route('quality-packaging'))->assertOk()->assertSeeText('Quality & Packaging');
    }

    public function test_products_list_and_single_product_details_are_dynamic(): void
    {
        $parentCategory = Category::create([
            'name' => 'Fresh Produce',
            'slug' => 'fresh-produce',
            'is_active' => true,
        ]);
        $category = Category::create([
            'parent_id' => $parentCategory->id,
            'name' => 'Fruits',
            'slug' => 'fruits',
            'is_active' => true,
        ]);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Fresh Mango',
            'slug' => 'fresh-mango',
            'short_description' => 'Premium seasonal mangoes for export.',
            'description' => 'Selected and packed to buyer requirements.',
            'specs' => ['Origin' => 'Bangladesh'],
            'is_active' => true,
            'is_featured' => true,
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Fresh Mango')
            ->assertSee(route('products.show', $product->slug), false);

        $this->get(route('products.category', $category->slug))
            ->assertOk()
            ->assertSee('Fresh Mango')
            ->assertSee('Premium seasonal mangoes for export.');

        $this->get(route('products.show', $product->slug))
            ->assertOk()
            ->assertSee('Selected and packed to buyer requirements.')
            ->assertSee('Bangladesh')
            ->assertSee(route('request-quote', ['product' => $product->slug]), false);
    }

    public function test_inactive_products_are_not_publicly_visible(): void
    {
        $category = Category::create([
            'name' => 'Vegetables',
            'slug' => 'vegetables',
            'is_active' => true,
        ]);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Hidden Product',
            'slug' => 'hidden-product',
            'is_active' => false,
        ]);

        $this->get(route('products.index'))->assertOk()->assertDontSee('Hidden Product');
        $this->get(route('products.show', $product->slug))->assertNotFound();
    }

    public function test_malformed_product_filter_falls_back_to_all_products(): void
    {
        $this->get(route('products.index').'?category[]=invalid')->assertOk();
    }
}
