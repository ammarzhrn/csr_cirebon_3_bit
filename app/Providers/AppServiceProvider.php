<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

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
        $publicRoutes = ['home', 'tentang', 'kegiatan', 'statistik', 'sektor', 'laporan', 'mitra'];
        View::share('publicRoutes', $publicRoutes);
        Carbon::setLocale('id');
    }
}