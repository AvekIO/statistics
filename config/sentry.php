<?php
declare(strict_types=1);

return [
    'dsn' => env('SENTRY_LARAVEL_DSN'),
    'breadcrumbs' => [
        'logs' => true,
        'sql_queries' => true,
        'sql_bindings' => true,
        'queue_info' => true,
        'command_info' => true,
    ],
    'tracing' => [
        'queue_job_transactions' => false,
        'queue_jobs' => true,
        'sql_queries' => true,
        'sql_origin' => true,
        'views' => true,
        'default_integrations' => true,
    ],
    'send_default_pii' => false,
    'traces_sample_rate' => (float) env('SENTRY_TRACES_SAMPLE_RATE'),
];
