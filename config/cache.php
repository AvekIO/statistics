<?php
declare(strict_types=1);

return [
    'default' => 'redis',
    'stores' => [
        'redis' => [
            'driver' => 'redis',
            'connection' => 'cache',
            'lock_connection' => 'default',
        ],
    ],
    'prefix' => env('APP_ENV') . '_cache_',
];
