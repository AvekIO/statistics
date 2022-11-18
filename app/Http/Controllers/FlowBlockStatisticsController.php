<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\FlowBlockStatisticsDto;
use App\Http\Requests\FlowBlockStatisticsIndexRequest;
use App\Services\FlowBlockStatisticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FlowBlockStatisticsController
{
    public function __construct(private readonly FlowBlockStatisticsService $service)
    {
    }

    public function index(FlowBlockStatisticsIndexRequest $request, int $flowId, int $blockId = null): JsonResponse
    {
        $collection = $this->service->getSummary($this->wrapIntoDto($flowId, $blockId, $request));

        return new JsonResponse($collection);
    }

    private function wrapIntoDto(int $flowId, ?int $blockId, Request $request): FlowBlockStatisticsDto
    {
        return new FlowBlockStatisticsDto(
            $flowId,
            $blockId,
            $request->input('triggered_at_from'),
            $request->input('triggered_at_to')
        );
    }
}
