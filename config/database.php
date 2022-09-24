<?php
declare(strict_types=1);

return [
    'default' => env('DB_CONNECTION'),
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'unix_socket' => env('DB_SOCKET'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],
    ],
    'migrations' => 'migrations',
    'redis' => [
        'client' => 'phpredis',
        'options' => [
            'cluster' => 'redis',
            'prefix' => env('APP_ENV') . '_' . '_database_',
        ],
        'cache' => [
            'url' => null,
            'host' => env('REDIS_HOST'),
            'username' => null,
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT'),
            'database' => '1',
        ],
    ],
];
