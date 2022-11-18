<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\FlowCommandsStatisticsDto;
use App\Http\Requests\FlowCommandsStatisticsIndexRequest;
use App\Services\FlowCommandsStatisticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FlowCommandsStatisticsController
{
    public function __construct(private readonly FlowCommandsStatisticsService $service)
    {
    }

    public function index(FlowCommandsStatisticsIndexRequest $request, int $flowId, int $commandId = null): JsonResponse
    {
        $collection = $this->service->getSummary($this->wrapIntoDto($flowId, $commandId, $request));

        return new JsonResponse($collection);
    }

    private function wrapIntoDto(int $flowId, ?int $commandId, Request $request): FlowCommandsStatisticsDto
    {
        return new FlowCommandsStatisticsDto(
            $flowId,
            $commandId,
            $request->input('triggered_at_from'),
            $request->input('triggered_at_to')
        );
    }
}
