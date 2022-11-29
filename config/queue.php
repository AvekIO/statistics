<?php
declare(strict_types=1);

return [
    'default' => env('QUEUE_CONNECTION'),
    'connections' => [
        'sync' => [
            'driver' => 'sync',
        ],
        'rabbitmq' => [
            'host' => env('RABBITMQ_HOST'),
            'port' => env('RABBITMQ_PORT'),
            'login' => env('RABBITMQ_LOGIN'),
            'password' => env('RABBITMQ_PASSWORD'),
        ],
    ],
];
