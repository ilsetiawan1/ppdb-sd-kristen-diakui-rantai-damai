<?php

namespace App\Providers;

use App\Models\tahunajar;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
     * Share active Tahun Ajaran to all views globally.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $aktivTahunAjaran = tahunajar::where('status', 'Berlangsung')->first()
                ?? tahunajar::where('status', 'Berakhir')->orderBy('updated_at', 'desc')->first();

            $view->with('aktivTahunAjaran', $aktivTahunAjaran);
        });
    }
}
