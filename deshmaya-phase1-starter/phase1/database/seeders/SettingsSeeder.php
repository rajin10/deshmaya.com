<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        // Brand colors below are ESTIMATED from the design mockup. Replace with exact brand values.
        $defaults = [
            'brand' => ['color', [
                'primary' => '#145a32', 'primary_dark' => '#043f29', 'secondary' => '#0d4252', 'accent' => '#6fae44',
                'background' => '#ffffff', 'surface' => '#f4f8f4', 'text' => '#1f2a24', 'text_muted' => '#5f6b64',
                'border' => '#e3e8e4', 'success' => '#2e7d32', 'danger' => '#c62828',
            ]],
            'general' => ['text', [
                'site_name' => 'Deshmaya', 'tagline' => 'Global Agri Exporter', 'logo' => '', 'logo_dark' => '',
                'favicon' => '', 'footer_text' => 'Fresh Produce. Global Opportunities.', 'copyright_text' => '',
            ]],
            'contact' => ['text', [
                'phone_primary' => '', 'phone_secondary' => '', 'whatsapp' => '', 'email_primary' => '',
                'email_secondary' => '', 'address' => 'Dhaka, Bangladesh', 'map_embed' => '', 'working_hours' => '',
            ]],
            'social' => ['text', ['facebook' => '', 'instagram' => '', 'linkedin' => '', 'youtube' => '', 'x' => '', 'tiktok' => '']],
            'loader' => ['text', ['enabled' => '1', 'mode' => 'session', 'image' => '', 'background_color' => '#ffffff', 'min_ms' => '600', 'max_ms' => '3000']],
            'seo' => ['text', ['default_title' => 'Deshmaya | Global Agri Exporter', 'default_description' => '', 'og_image' => '', 'google_analytics_id' => '', 'meta_pixel_id' => '']],
            'mail' => ['text', ['notification_email' => '', 'from_name' => 'Deshmaya']],
        ];

        foreach ($defaults as $group => [$type, $items]) {
            foreach ($items as $key => $value) {
                // firstOrCreate: re-seeding never overwrites values edited in admin
                Setting::firstOrCreate(['group' => $group, 'key' => $key], ['value' => $value, 'type' => $type]);
            }
        }
    }
}
