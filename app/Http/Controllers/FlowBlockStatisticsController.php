<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\FlowBlockStatisticsDto;
use App\Http\Requests\FlowBlockStatisticsIndexRequest;
use App\Services\FlowBlockStatisticsService;
use Illuminate\Http\JsonResponse;

class FlowBlockStatisticsController
{
    public function __construct(private readonly FlowBlockStatisticsService $service)
    {
    }

    public function index(FlowBlockStatisticsIndexRequest $request): JsonResponse
    {
        $dto = FlowBlockStatisticsDto::fromRequest($request);
        $collection = $this->service->getCollection($dto);

        return new JsonResponse($collection);
    }
}
