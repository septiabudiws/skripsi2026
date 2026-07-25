<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
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
     */
    public function boot(): void
    {
        Blade::directive('rupiah', function ($expression) {
            return "<?php echo 'Rp. ' . number_format($expression, 0, ',', '.'); ?>";
        });

        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin') ? true : null;
        });
    }
}
