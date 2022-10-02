<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\HealthCheckService;
use Illuminate\Http\JsonResponse;

class HealthCheckController
{
    public function __construct(private readonly HealthCheckService $service)
    {
    }

    public function __invoke(): JsonResponse
    {
        return new JsonResponse($this->service->getStatus());
    }
}
