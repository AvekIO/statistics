<?php
declare(strict_types=1);

return [
    'default' => env('LOG_CHANNEL'),
    'deprecations' => [
        'channel' => 'null',
        'trace' => false,
    ],
    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['daily'],
            'ignore_exceptions' => false,
        ],
        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL'),
            'days' => 1,
        ],
    ],
];
