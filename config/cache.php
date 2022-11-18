<?php
declare(strict_types=1);

return [
    'default' => env('CACHE_STORE'),
    'stores' => [
        'redis' => [
            'driver' => 'redis',
            'connection' => 'cache',
            'lock_connection' => 'default',
        ],
    ],
    'prefix' => env('CACHE_PREFIX'),
];
