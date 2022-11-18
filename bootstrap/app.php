<?php
declare(strict_types=1);

$singletons = [
    Illuminate\Contracts\Http\Kernel::class => App\Http\Kernel::class,
    Illuminate\Contracts\Console\Kernel::class => App\Console\Kernel::class,
    Illuminate\Contracts\Debug\ExceptionHandler::class => App\Exceptions\Handler::class,
];

$app = new Illuminate\Foundation\Application(dirname(__DIR__));

foreach ($singletons as $abstract => $concrete) {
    $app->singleton($abstract, $concrete);
}

return $app;
