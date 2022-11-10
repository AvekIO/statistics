<?php
declare(strict_types=1);

return [
    'default' => env('LOG_CHANNEL'),
    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => ['daily'],
        ],
        'daily' => [
            'driver' => 'daily',
            'path' => env('LOG_FILEPATH'),
            'level' => env('LOG_LEVEL'),
        ],
    ],
];
