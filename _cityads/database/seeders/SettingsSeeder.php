<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            'website_name'      => 'My Website',
            'site_motto'        => 'Your Growth, Our Mission',
            'system_logo_white' => 'logo-white.png',
            'system_logo_black' => 'logo-black.png',
            'site_logo'         => 'site-logo.png',
            'login_page_image'  => 'login-page.png',
            'login_bg_image'    => 'login-bg.jpg',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
