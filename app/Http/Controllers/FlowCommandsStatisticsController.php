<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\FlowCommandsStatisticsDto;
use App\Http\Requests\FlowCommandsStatisticsIndexRequest;
use App\Services\FlowCommandsStatisticsService;
use Illuminate\Http\JsonResponse;

class FlowCommandsStatisticsController
{
    public function __construct(private readonly FlowCommandsStatisticsService $service)
    {
    }

    public function index(FlowCommandsStatisticsIndexRequest $request): JsonResponse
    {
        $dto = FlowCommandsStatisticsDto::fromRequest($request);
        $collection = $this->service->getCollection($dto);

        return new JsonResponse($collection);
    }
}
