<?php
declare(strict_types=1);

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    private const ROUTES_MAP = [
        '' => 'routes/api.php',
    ];

    public function map(): void
    {
        foreach (self::ROUTES_MAP as $prefix => $filepath) {
            $this->app['router']->prefix($prefix)->group(base_path($filepath));
        }
    }

    public function boot(): void
    {
        $this->app['router']->patterns([
            'flow_id' => '[0-9]+',
            'command_id' => '[0-9]+',
            'block_id' => '[0-9]+',
            'telegram_user_id' => '[0-9]+',
        ]);
    }
}
