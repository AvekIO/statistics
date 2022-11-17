<?php
declare(strict_types=1);

return [
    'default' => env('DB_CONNECTION'),
    'connections' => [
        'mysql' => [
            'driver' => env('MYSQL_DRIVER'),
            'host' => env('MYSQL_HOST'),
            'port' => env('MYSQL_PORT'),
            'database' => env('MYSQL_DATABASE'),
            'username' => env('MYSQL_USERNAME'),
            'password' => env('MYSQL_PASSWORD'),
            'charset' => env('MYSQL_CHARSET'),
            'collation' => env('MYSQL_COLLATION'),
        ],
        'sqlite' => [
            'driver' => env('SQLITE_DRIVER'),
            'database' => env('SQLITE_DATABASE'),
            'foreign_key_constraints' => (bool) env('SQLITE_FOREIGN_KEYS'),
        ],
    ],
    'migrations' => env('DB_MIGRATIONS_TABLE_NAME'),
    'redis' => [
        'client' => env('REDIS_CLIENT'),
        'options' => [
            'cluster' => env('REDIS_CLUSTER'),
            'prefix' => env('REDIS_PREFIX'),
        ],
        'cache' => [
            'host' => env('REDIS_HOST'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT'),
            'database' => env('REDIS_DATABASE'),
        ],
    ],
];
