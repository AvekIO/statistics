<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\FlowBlocksStatisticsFiltersDto;
use App\Http\Requests\FlowBlocksStatisticsIndexRequest;
use App\Services\FlowBlocksStatisticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FlowBlocksStatisticsController
{
    public function __construct(private readonly FlowBlocksStatisticsService $service)
    {
    }

    public function index(FlowBlocksStatisticsIndexRequest $request, int $flowId, int $blockId = null): JsonResponse
    {
        $collection = $this->service->getSummary($this->wrapIntoDto($flowId, $blockId, $request));

        return new JsonResponse($collection);
    }

    private function wrapIntoDto(int $flowId, ?int $blockId, Request $request): FlowBlocksStatisticsFiltersDto
    {
        return new FlowBlocksStatisticsFiltersDto(
            $flowId,
            $blockId,
            $request->input('triggered_at_from'),
            $request->input('triggered_at_to')
        );
    }
}
