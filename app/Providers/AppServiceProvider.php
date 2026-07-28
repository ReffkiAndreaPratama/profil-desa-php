<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Use Tailwind CSS pagination views
        Paginator::useTailwind();

        // Set Carbon locale to Indonesian for translatedFormat()
        Carbon::setLocale('id');

        // Blade directive: @fotoUrl($foto) — resolves Storage path or external URL
        Blade::directive('fotoUrl', function ($expression) {
            return "<?php echo \\App\\Helpers\\FotoHelper::url($expression); ?>";
        });
    }
}
