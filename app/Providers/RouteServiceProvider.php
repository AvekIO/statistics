<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    private const ROUTES_MAP = [
        'api' => 'routes/api.php',
    ];

    public function map(): void
    {
        foreach (self::ROUTES_MAP as $prefix => $filepath) {
            $this->app['router']->prefix($prefix)->group(base_path($filepath));
        }
    }
}
