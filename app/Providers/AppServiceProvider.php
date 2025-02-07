<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $locale = substr(Request::server('HTTP_ACCEPT_LANGUAGE'), 0, 2); // İlk iki harfi al (tr, en vb.)

        // Desteklenen diller listesi
        $supportedLocales = ['tr', 'en', 'de', 'fr'];

        // Kullanıcının dilini desteklenen dillerden biriyle eşleştir
        if (!in_array($locale, $supportedLocales)) {
            $locale = config('app.fallback_locale'); // Desteklenmiyorsa varsayılan dile düş
        }

        App::setLocale($locale);
    }
}
