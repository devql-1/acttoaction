<?php

namespace App\Providers;
use App\Models\ContactInfo;
use Illuminate\Support\Facades\Schema;
use App\Models\WorkshopAgeGroup;
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
        view()->composer('*', function ($view) {
            $view->with(
                'navAgeGroups',
                cache()->remember('nav_age_groups', now()->addMinutes(10), function () {
                    return WorkshopAgeGroup::active()
                        ->ordered()
                        ->with([
                            'cities' => fn($q) => $q->where('status', 1)->ordered(),
                        ])
                        ->get();
                }),
            );
        });

        if (Schema::hasTable('contact_infos')) {
            view()->share('contactInfo', ContactInfo::first());
        }
    }
}
