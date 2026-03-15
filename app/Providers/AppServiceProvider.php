<?php

namespace App\Providers;
use App\Models\ContactInfo;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\ServiceProvider;
use App\Services\EmailService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(EmailService::class, function () {
            return new EmailService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (Schema::hasTable('contact_infos')) {
            view()->share('contactInfo', ContactInfo::first());
        }
    }
}
