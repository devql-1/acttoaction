<?php

namespace App\Providers;
use App\Models\AnnouncementBar;
use App\Models\ContactInfo;
use Illuminate\Support\Facades\Schema;
use App\Models\WorkshopAgeGroup;
use Illuminate\Support\ServiceProvider;
use App\Services\EmailService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(EmailService::class, function () {
            return new EmailService();
        });
    }

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
            $ci = ContactInfo::first();
            view()->share('contactInfo', $ci);
        }

        $correctPhone    = '+91 80790 34973';
        $correctWhatsapp = '+91 80790 34973';
        $correctEmail    = 'info@threatxpert.com';
        $correctAddress  = 'Rising Passion Studio, Hoshiar Singh Marg, Moti Nagar, Vaishali Nagar, Jaipur - 302021';

        view()->share([
            'phone'          => $correctPhone,
            'whatsapp'       => $correctWhatsapp,
            'email'          => $correctEmail,
            'address'        => $correctAddress,
            'mapLink'        => '',
            'fbUrl'          => 'https://www.facebook.com/threatexpert/',
            'instaUrl'       => 'https://www.instagram.com/threatexpert_',
            'linkedinUrl'    => 'https://www.linkedin.com/company/threatexpert/',
            'twitchUrl'      => 'https://www.twitch.tv/threatexpert_',
            'chatPhones'     => [$correctPhone],
            'workingHours'   => ['Mon - Sat: 10am - 7pm', 'Sunday: By Appointment Only'],
            'phoneDigits'    => preg_replace('/\D/', '', $correctPhone),
            'whatsappDigits' => preg_replace('/\D/', '', $correctWhatsapp),
            'isEmbedMap'     => false,
        ]);

        if (Schema::hasTable('announcement_bars')) {
            view()->share('activeAnnouncement', AnnouncementBar::active()->latest()->first());
        }
    }
}
