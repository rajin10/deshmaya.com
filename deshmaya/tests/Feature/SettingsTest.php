<?php

namespace Tests\Feature;

use App\Services\SettingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_brand_color_change_reaches_the_page(): void
    {
        $this->seed(\Database\Seeders\SettingsSeeder::class);
        app(SettingService::class)->set('brand.primary', '#112233', 'color');

        $this->get('/')->assertOk()->assertSee('--brand-primary:#112233', false);
    }

    public function test_invalid_color_is_not_printed(): void
    {
        app(SettingService::class)->set('brand.primary', 'red;}</style><script>', 'color');

        $this->get('/')->assertOk()->assertDontSee('--brand-primary:red', false);
    }

    public function test_business_info_updates_footer(): void
    {
        app(SettingService::class)->set('contact.email_primary', 'hello@example.com');

        $this->get('/')->assertSee('hello@example.com');
    }
}
